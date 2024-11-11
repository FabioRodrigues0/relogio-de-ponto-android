<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
=======
use Carbon\Carbon;
>>>>>>> 8b50b1e126fa07bd56be6fe16c04f7796e3503e5
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function index(){

        $search = request()->query('search') ? request()->query('search') : null;
<<<<<<< HEAD

        if($search){
            $showUsers = $this->findUsers($search);
=======
        $type = request()->query('type') ? request()->query('type') : null;

        if($search){
            $showUsers = $this->findUsers($search, $type);
>>>>>>> 8b50b1e126fa07bd56be6fe16c04f7796e3503e5
        }
        else{
            $showUsers = $this->getUsers();
        }

        return view('pages.users', compact('showUsers'));
    }

    public function home(){
        $userTime = $this->getLastEntrance();
        $allUserData = $this->getAllPresences();
<<<<<<< HEAD

=======
>>>>>>> 8b50b1e126fa07bd56be6fe16c04f7796e3503e5
        return view('pages.home', compact('userTime', 'allUserData'));
    }

    public function viewContact($id){
        $ourUser = User::where('id', $id)->first();
        return view('pages.viewUsers', compact('ourUser'));
    }

    public function updateUser(Request $request){
        User::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.home')->with('message', 'Contacto atualizado com sucesso!');
    }


<<<<<<< HEAD
=======
    public function deleteUser($id){
        User::where('id', $id)->delete();
        return back();
    }

>>>>>>> 8b50b1e126fa07bd56be6fe16c04f7796e3503e5
    public function getUsers(){
        $allUsers = DB::table('users')
                           ->join('users_type', 'users.users_type_id', '=', 'users_type.id')
                           ->select('users.*', 'users_type.type')
<<<<<<< HEAD
                           ->get();
        return($allUsers);
    }

    public function findUSers($search){
        $users = DB::table('users');
            $users = $users->where('name', 'LIKE', "%{$search}%")
            ->orWhere('email', $search)
            ->join('users_type', 'users.users_type_id', '=', 'users_type.id')
            ->select('users.*', 'users_type.type')
            ->get();
=======
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
            //QUERY NAO ESTA A FUNCIONAR CORRETAMENTE!!!!
>>>>>>> 8b50b1e126fa07bd56be6fe16c04f7796e3503e5
            return $users;
    }


    public function getLastEntrance(){
        $id = Auth::user()->id;

        $checkTime = DB::table('presence_record')
        ->where('user_id', $id)
        ->select('date', 'entry_time', 'exit_time')
        ->orderBy('date', 'desc')
        ->first();

<<<<<<< HEAD
=======
        if($checkTime && $checkTime->entry_time && $checkTime->exit_time) {
            $entryTime = Carbon::parse($checkTime->entry_time);
            $exitTime = Carbon::parse($checkTime->exit_time);
            $checkTime->total_time = $exitTime->diff($entryTime)->format('%H:%I');
        }

>>>>>>> 8b50b1e126fa07bd56be6fe16c04f7796e3503e5
        return($checkTime);
    }

    public function getAllPresences(){
        $id = Auth::user()->id;
        $checkAllFields = DB::table('presence_record')
        ->where('user_id', $id)
        ->join('attendance_mode', 'presence_record.attendance_mode_id', '=', 'attendance_mode.id')
        ->select('presence_record.date', 'presence_record.entry_time', 'presence_record.exit_time', 'attendance_mode.description')
        ->orderBy('date', 'desc')
        ->cursorPaginate(5);

<<<<<<< HEAD
=======
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


>>>>>>> 8b50b1e126fa07bd56be6fe16c04f7796e3503e5
        return($checkAllFields);
    }
}
