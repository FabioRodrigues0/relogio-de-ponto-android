<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function login(){
        if (Auth::check()){
            return redirect()->route('home.page');
        }
        else{
        return view("auth.login");
        }
    }

    public function register(){
        $sendUserType = $this->userType();
        return view("auth.register", compact('sendUserType'));
<<<<<<< HEAD
=======

>>>>>>> 8b50b1e126fa07bd56be6fe16c04f7796e3503e5
    }


    public function userType(){
        $userType = DB::table('users_type')
                   ->get();
        return($userType);
    }

    public function createUser(Request $request){

        $photo = null;

        if($request->hasFile('foto')){
            $photo = Storage::putFile('uploadedImages', $request->foto);

        }

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
            'foto' => $photo,
            'users_type_id' => $request->users_type_id,
            'setor' => $request->setor
        ]);

        return redirect()->route('login')->with('message', 'Contact added successfully!');
    }
}
