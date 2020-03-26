<?php

namespace App\Http\Controllers;

use App\MoneyCountings\Balance;
use App\Transactions;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $transactions = Transactions::where('user_id', Auth::id())->latest('time')->get();

        $user = Auth::user();
        return view(
            'home'
        )->with(
            [
                'user' => $user,
                'transactions' => $transactions
            ]
        );
    }
}
