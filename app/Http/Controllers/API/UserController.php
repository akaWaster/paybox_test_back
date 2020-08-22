<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addPhone(Request $request)
    {
        $user_id = $request->user()->id;
    }

    public function information()
    {

    }

    public function payments()
    {
        //TODO: Сделать реализацию все платежей по пользователю
    }
}
