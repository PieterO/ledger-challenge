<?php

namespace App\Http\Controllers;

use App\Transactions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TransactionsController extends Controller
{
    /**
     * Show the form for creating a new withdrawal.
     */
    public function createWithdrawal(Request $request): View
    {
        $user = Auth::user();
        return view('transactions.withdraw', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new deposit.
     */
    public function createDeposit(Request $request): View
    {
        $user = Auth::user();
        return view('transactions.deposit', [
            'user' => $user
        ]);
    }

    /**
     * deposit the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|between:0,99999',
            'time' => 'required|date',
        ]);

        $this->store($request);
        return redirect('/deposit')->with('success', 'transaction made');
    }

    /**
     * withdraw the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|between:0,99999',
            'time' => 'required|date',
        ]);

        $request['amount'] = -($request->input('amount'));
        $user = Auth::user();



        if ($this->checkWithdrawalIsOutsideOverdraft(
            $request['amount'],
            $user->balance,
            $user->overdraftLimit
            )) {
            return redirect('/withdraw')->with('failure', 'outside overdraft');
        }

        $this->store($request);
        return redirect('/withdraw')->with('success', 'transaction made');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): bool
    {
        $transaction = new Transactions();
        $transaction->amount = $request->input('amount');
        $transaction->time = $request->input('time');
        $transaction->user_id = Auth::id();
        $transaction->save();

        return true;
    }

    /**
     * To prevent going outside overdraft.
     *
     * @param $withdrawalAmount
     * @param $currentBalance
     * @param $overdraftLimit
     * @return bool
     */
    private function checkWithdrawalIsOutsideOverdraft(
        $withdrawalAmount,
        $currentBalance,
        $overdraftLimit
    ): bool
    {
        $newBalance = $currentBalance + $withdrawalAmount;

        if ($newBalance < - (float) $overdraftLimit)
        {
            return true;
        }

        return false;
    }
}
