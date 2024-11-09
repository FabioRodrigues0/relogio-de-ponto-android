<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view("auth.login");
    }

    public function register(){
        $sendUserType = $this->userType();
        return view("auth.register", compact('sendUserType'));

    }

    public function userType(){
        $userType = DB::table('users_type')
                   ->get();
        return($userType);
    }

    public function createUser(Request $request){
        $request->validate([
            'name' =>  'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'users_type_id' => 'required|exists:users_type,id',
            'setor' => 'required|string'
        ]);

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto' => $request->foto,
            'users_type_id' => $request->users_type_id,
            'setor' => $request->setor
        ]);

        return redirect()->route('users.home')->with('message', 'Contact added successfully!');
    }
}
