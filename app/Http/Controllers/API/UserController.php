<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentCollection;
use App\models\Payments;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function payments(Request $request)
    {
        $request->validate([
            'page' => 'required|integer',
        ]);

        $payments = Payments::where('user_id', $request->user()->id)
            ->limit(10)
            ->offset(($request->input('page') - 1) * 10)
            ->get();

        return new PaymentCollection($payments);
    }
}
