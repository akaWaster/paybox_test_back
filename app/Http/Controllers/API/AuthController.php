<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\Error;
use App\Http\Resources\UserCollection;
use App\Todos;
use App\User;

class AuthController extends Controller
{

    public function register(RegistrationRequest $request)
    {
        $data = $request->validated();

        $isCreatedUser = !empty(User::where('email', $data['email'])->first()) ?? true;

        if ($isCreatedUser) {
            return ['error' => true, 'message' => 'User already exists'];
        }

        $data['password'] = \Hash::make($data['password']);

        $user = User::create($data);

        return ['token' => $user->createToken('token')->accessToken];
    }


    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (!\Hash::check($data['password'], $user->password)) {
            return response(['aaa' => 'aaa'], 403);
        }

        $token = $user->createToken('token')->accessToken;

        return ['token' => $token];
    }
}
