<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function index(){

        $search = request()->query('search') ? request()->query('search') : null;

        if($search){
            $showUsers = $this->findUsers($search);
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
        User::where('id', $request->id)
        ->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.home')->with('message', 'Contacto atualizado com sucesso!');
    }


    public function getUsers(){
        $allUsers = DB::table('users')
                           ->join('users_type', 'users.users_type_id', '=', 'users_type.id')
                           ->select('users.*', 'users_type.type')
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
            return $users;
    }


    public function getLastEntrance(){
        $id = Auth::user()->id;

        $checkTime = DB::table('presence_record')
        ->where('user_id', $id)
        ->select('date', 'entry_time', 'exit_time')
        ->orderBy('date', 'desc')
        ->first();

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

        return($checkAllFields);
    }
}
