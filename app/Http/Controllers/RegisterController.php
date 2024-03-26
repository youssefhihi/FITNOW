<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
   

    public function store(RegisterRequest $request)
{
    $userData = $request->validated();
    $userData['password'] = Hash::make($request->password);
    
    $user = User::create($userData);
     
    
    return response()->json([
        'status' => 200,
        'message' => 'You have registered successfully.'
    ]);
}

}
