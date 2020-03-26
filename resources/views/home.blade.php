@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Welcome!
                </div>

                Your current balance is
                {{ numfmt_format_currency(config('global.fmt'), $user->balance, 'GBP')}}.
                <br>
                @if($user->isOverSavingsThreshold())
                    You have a large amount in your account, you might want to consider moving this into a different savings account.
                @endif

                @if($user->isInOverdraft())
                    <div class="alert alert-warning" role="alert">
                        Uh oh, you're in the overdraft, (stop eating avocados, heating your home, something something bootstraps).
                    </div>
                @endif

                @if($user->isInUnplannedOverdraft())
                    <div class="alert alert-danger" role="alert">
                        You're outside the overdraft, this is something which should never happen, please contact us immediately.
                    </div>
                @endif

                <br>
                <table>
                    <thead>
                        <tr>
                            <td class="th">Type of transaction</td>
                            <td class="th">Date</td>
                            <td class="th">Amount</td>

                        </tr>
                    </thead>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->type}}</td>
                        <td>{{ $transaction->time }}</td>
                        <td> {{ numfmt_format_currency(config('global.fmt'), abs($transaction->amount), 'GBP')}}</td>
                    </tr>
                    @endforeach
                </table>

                <a class="navbar-brand" href="{{ url('/deposit') }}">
                    Deposit money into your account.
                </a>

                <a class="navbar-brand" href="{{ url('/withdraw') }}">
                    Withdraw money from your account.
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
