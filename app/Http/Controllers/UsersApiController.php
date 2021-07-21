<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersApiController extends Controller
{

    public function index(){

        if(request()->has('id')){
            return User::where('id',request('id'))->get();
        }

        if(request()->has('name')){
            return User::where('name',request('name'))->get();
        }

        return User::all();
    }

    public function specificId(int $id){
        return User::where('id',$id)->get();
    }

    public function specificName(string $name){
        return User::where('name',$name)->get();
    }

    public function store(){
        request()->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
        ]);

        return User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
        ]);
    }

    public function update(User $user){
        
        request()->validate([
            'name' => 'nullable|min:1|unique:users',
            'email' => 'nullable|email:rfc,dns',
            'password' => 'nullable|min:5',
        ]);


        if(request()->has('name')){
            $user->name = request('name');
        }

        if(request()->has('email')){
            $user->email = request('email');
        }

        if(request()->has('password')){
            $user->password = Hash::make(request('password'));
        }
        
        $user->save();
        return [
            'success' => True
        ];
    }

    
    public function delete(User $user){
        $success = $user->delete();

        return [
            'success' => $success
        ];
    }

}
