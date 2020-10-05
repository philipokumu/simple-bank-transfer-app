<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use DB;

class TransactionController extends Controller
{
    public function store(Request $request, $id)
    {
        $data = request()->validate([
            'amount'=>'required|numeric|min:1',
            'details'=>'required',
            'to'=>'required|numeric|not_in:'.$id,
        ]);

        
        $to = $request->input('to');
        $amount = $request->input('amount');
        $details = $request->input('details');

        $balanceFrom = floatval(DB::table('accounts')->where('user_id', '=', $id)->pluck('balance')->first());
        $balanceTo = floatval(DB::table('accounts')->where('user_id', '=', $to)->pluck('balance')->first());

        $account = DB::table('accounts')
            ->where('user_id', '=', $id)
            ->update(['balance' => $balanceFrom - $amount]);

        $account = DB::table('accounts')
            ->where('user_id', '=', $to)
            ->update(['balance' => $balanceTo + $amount]);

        DB::table('transactions')->insert(
            [
                'from' => $id,
                'to' => $to,
                'amount' => $amount,
                'details' => $details
            ]
        );
    }

    public function show($id)
    {
        $account = DB::table('transactions')
                ->where('from', '=', $id)
                ->orWhere('to', '=', $id)->get();

        return $account;

    }
}
