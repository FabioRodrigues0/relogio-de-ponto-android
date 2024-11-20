<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(){

        $search = request()->query('search') ? request()->query('search') : null;
        $type = request()->query('type') ? request()->query('type') : null;

        if($search){
            $showUsers = $this->findUsers($search, $type);
        }
        else{
            $showUsers = $this->getUsers();
        }

        return view('pages.users', compact('showUsers'));
    }

    public function home(){
        $performance = $this->userPerformance();
        $userTime = $this->getLastEntrance();

        $allUserData = $this->getAllPresences();

        return view('pages.home', compact('userTime', 'allUserData', 'performance'));
    }

    public function viewContact($id){
        $ourUser = User::where('id', $id)->first();
        return view('pages.viewUsers', compact('ourUser'));
    }

    public function updateUser(Request $request){
        $photo = null;

        if($request->hasFile('photo')){
            $photo = Storage::putFile('uploadedImages', $request->photo);

        }

        User::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto' => $photo
        ]);

        return redirect()->route('users.home')->with('message', 'Contacto atualizado com sucesso!');
    }


    public function deleteUser($id){

        DB::table('presence_record')->where('user_id', $id)->delete();
        User::where('id', $id)->delete();
        return back();
    }

    public function showUserProfile($id){


        $userInfo = DB::table('users')->where('id', $id)->first();
                    return view('pages.profile', compact('userInfo'));
    }

    public function getUsers(){
        $allUsers = DB::table('users')
                           ->join('users_type', 'users.users_type_id', '=', 'users_type.id')
                           ->select('users.*', 'users_type.type')
                           ->orderBy('users.id')
                           ->cursorPaginate(5);
        return($allUsers);
    }

    public function findUSers($search, $type){
        $users = DB::table('users');
            $users = $users->where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('users_type_id', '=', $type)
            ->join('users_type', 'users.users_type_id', '=', 'users_type.id')
            ->select('users.*', 'users_type.type')
            ->orderBy('id')
            ->simplePaginate(5);

            return $users;
    }

    public function getLastEntrance(){
        $id = Auth::user()->id;

        $checkTime = DB::table('presence_record')
        ->where('user_id', $id)
        ->select('date', 'entry_time', 'exit_time')
        ->orderBy('date', 'desc')
        ->first();

        if($checkTime && $checkTime->entry_time && $checkTime->exit_time) {
            $entryTime = Carbon::parse($checkTime->entry_time);
            $exitTime = Carbon::parse($checkTime->exit_time);
            $checkTime->total_time = $exitTime->diff($entryTime)->format('%H:%I');
        }

        return($checkTime);
    }


    //PRESENÇAS -----------------------------------------------------------------

    public function getAllPresences(){
        $id = Auth::user()->id;
        $checkAllFields = DB::table('presence_record')
        ->where('user_id', $id)
        ->join('attendance_mode', 'presence_record.attendance_mode_id', '=', 'attendance_mode.id')
        ->select('presence_record.date', 'presence_record.entry_time', 'presence_record.exit_time', 'attendance_mode.description')
        ->orderBy('date', 'desc')
        ->cursorPaginate(5);

        foreach ($checkAllFields as $presence){
            $entryTime = Carbon::parse($presence->entry_time);
            $exitTime = Carbon::parse($presence->exit_time);

            if($presence->exit_time){
                $presence->total_time = $entryTime->diff($exitTime)->format('%H:%I');
            }
            else{
                $presence->total_time = 'Ainda sem dados';
            }
        }


        return($checkAllFields);
    }



    public function userPerformance(){
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();
        $id = Auth::user()->id;

        $entrances = DB::table('presence_record')
            ->join('users', 'users.id', '=', 'presence_record.user_id')
            ->where('user_id', $id)
            ->whereBetween('presence_record.entry_time', [$monthStart, $monthEnd])
            ->select('users.name',
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, presence_record.entry_time, presence_record.exit_time)) as total_minutes'),
                DB::raw('
                100 - (AVG(ABS(
                    (HOUR(presence_record.entry_time) * 60 + MINUTE(presence_record.entry_time))
                    - (HOUR(presence_record.entry_time) * 60)
                )) / 60) * 100 AS punctuality_percentage
            ')
            )
            ->groupBy('users.name')
            ->first();





            $hours = floor($entrances->total_minutes / 60);
            $minutes = $entrances->total_minutes % 60;
            $entrances->total_hours = sprintf("%02d:%02d", $hours, $minutes);


        return $entrances;
    }

    public function passwordRequest(){
        DB::table('password_request')->insert([
            'users_id' => auth::user()->id,
            'status'=> 'pending',
            'created_at' => now(),
        ]);

        return redirect()->back()->with('message', 'Solicitação de alteração de palavra-passe enviada com sucesso!');
    }
}
