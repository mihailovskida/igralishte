@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="vh-100 d-flex justify-content-center"  style="background-image: linear-gradient(to bottom, rgb(255, 220, 225) 10%, white);">
    <div class="container">
        <div class="text-center" style="margin-bottom: 200px; ">
            <img src="{{ asset('images/logo-login.png') }}" alt="Logo" style="width: 180px; height: 38.50px; margin-top:100px;">
        </div>
        
        <div class="col-8 mx-auto">
            <div class="card">
                <div class="card-header">{{ __('Промени лозинка') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email адреса') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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
