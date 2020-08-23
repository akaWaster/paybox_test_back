<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


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
