<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Resources\Error;
use App\Http\Resources\UserCollection;
use App\Roles;
use App\Todos;
use App\User;
use DB;

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
        DB::beginTransaction();
        try {
            $user = User::create($data);
            $user->role()->create(['role' => Roles::USER_ROLE]);
        } catch (\Exception $exception) {
            DB::rollBack();

            return response('User did not created', 500);
        }

        DB::commit();

        return ['token' => $user->createToken('token')->accessToken, 'role' => $user->role()];
    }


    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (!\Hash::check($data['password'], $user->password)) {
            return response(['aaa' => 'aaa'], 403);
        }

        $token = $user->createToken('Token')->accessToken;

        return ['token' => $token, 'role' => $user->roles->role];
    }
}
