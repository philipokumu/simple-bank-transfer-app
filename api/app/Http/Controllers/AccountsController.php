<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AccountsController extends Controller
{
    public function show($id)
    {
        $account = DB::table('accounts')
            ->where('user_id', '=', $id)
            ->get();

        return $account;
    }
}
