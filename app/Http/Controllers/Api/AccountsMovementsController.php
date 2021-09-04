<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Movement;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountsMovementsController extends Controller
{
    /**
     * Stores the movement
     *
     * @param Request $req
     * @param Account $account
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $data = $request->validate(['amount' => 'required|numeric', 'description' => 'nullable']);
        $amount = $data['amount'] * 100;

        $account = auth()->user()->accounts()->where('account_number', $request->route('account'))->first();
        Movement::Register($account, $amount, $data['description']);
        
        return response()->json([
            'message' => 'Successfully created movement'
        ], 201);
    }
}
