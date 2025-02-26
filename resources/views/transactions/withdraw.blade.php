@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Deposit') }}</div>

                    <div class="card-body">
                        Your current balance is
                        {{ numfmt_format_currency(config('global.fmt'), $user->balance, 'GBP')}}.
                        <form method="POST" action="{{ route('withdraw') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount you would like to withdraw') }}</label>

                                <div class="col-md-6">
                                    <input id="amount" type="number" min="0" step=".01" class="form-control @error('number') is-invalid @enderror" name="amount" required autofocus>

                                    @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('When the withdrawal should be made') }}</label>

                                <div class="col-md-6">
                                    <input id="time" type="datetime-local" class="form-control @error('datetime') is-invalid @enderror" name="time" required>

                                    @error('datetime')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Withdraw') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
