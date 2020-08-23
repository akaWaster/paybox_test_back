<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Payment;
use App\Http\Resources\Payments;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users(Request $request)
    {
        $request->validate([
            'page' => 'required|integer',
        ]);

        return User::limit(10)
            ->offset(($request->input('page') - 1) * 10)
            ->get();

    }
}
