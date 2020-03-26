@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Settings</div>

                    <div class="card-body">

                        Your current overdraft is
                        {{ numfmt_format_currency(config('global.fmt'), $user->overdraftLimit, 'GBP')}}.

                        Your saving warning is set to £4000,00.

                </div>
            </div>
        </div>
    </div>
@endsection
