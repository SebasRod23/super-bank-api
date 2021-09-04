<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountsController extends Controller
{
    /**
     * Creates account
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req) {
        $data = $req->validate(['name' => 'required']);
        $data['user_id'] = auth()->user()->id;

        Account::create($data);
        
        return response()->json([
            'message' => 'Successfully created account'
        ], 201);
    }

    /**
     * Retrieves the account information
     *
     * @return \Illuminate\Http\Response
     */
    public function getAccount(Request $request)
    {
        $account = DB::table('accounts')->get()->where('account_number', $request->route('account'))->first();
        return response()->json($account);
    }
}
