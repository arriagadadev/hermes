<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUserInformation(Request $request){
    	return [
    		"name" => $request->user()->name,
    		"email" => $request->user()->email
    	];
    }

    public function updateUserInformation(Request $request){
    	$validatedData = $request->validate([
    		'name' => 'required'
    	]);

    	$user = $request->user();
    	$user->name = $validatedData['name'];
    	$user->save();
    	return [
    		"user" => $user
    	];
    }

    public function changePassword(Request $request){
        $validatedData = $request->validate([
            'password' => 'required|confirmed|min:8'
        ]);

        $user = $request->user();
        $user->password = Hash::make($validatedData['password']);
        $user->save();
        return [
            "user" => $user
        ];
    }
}
