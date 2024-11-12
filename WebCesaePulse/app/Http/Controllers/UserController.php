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
        $userTime = $this->getLastEntrance();
        $allUserData = $this->getAllPresences();
        return view('pages.home', compact('userTime', 'allUserData'));
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
        User::where('id', $id)->delete();
        return back();
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

   
}
