<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
}
