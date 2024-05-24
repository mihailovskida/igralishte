@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="vh-100" style="background-image: linear-gradient(to bottom, rgb(255, 220, 225) 10%, white);">

        <div class="text-center" style="margin-bottom: 200px; ">
            <img src="{{ asset('images/logo-login.png') }}" alt="Logo" style="width: 180px; height: 38.50px; margin-top: 100px;">
        </div>

        <div class="col-8 mx-auto pb-5">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row mb-3 col-11 mx-auto">
                    <label for="email" class="col-md-4 col-form-label text-md-end" style="font-size: 15px; font-weight: bold;">{{ __('Email адреса') }}</label>
    
                    <div class="col-md-5">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="igralishtesk@gmail.com">
    
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
    
                <div class="row mb-2 col-11 mx-auto">
                    <label for="password" class="col-md-4 col-form-label text-md-end" style="font-size: 15px; font-weight: bold;">{{ __('Лозинка') }}</label>
    
                    <div class="col-md-5">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="********">
    
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
    
                <div class="row col-11 mx-auto">
                    <div class="col-12">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link p-0 pb-4" style="font-size: 12px; color: #79964b;" href="{{ route('password.request') }}">
                                {{ __('Ја заборави лозинката?') }}
                            </a>
                        @endif
                    </div>
                </div>
                
                <div class="row mb-5">
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark fw-bold" style="width: 220px; height: 40px; border-radius: 10px;">
                            {{ __('Логирај се') }}
                        </button>
                    </div>
                </div> 
            </form>
        </div>

        <div class="row pt-2">
            <div class="mx-auto" style="width: 191px; height: 10px;">
                <p style="font-weight: 8px; font-size: 8px; line-height: 9.68px;">Сите права задржани <span>&#169</span> Игралиште Скопје</p>
            </div>
        </div>
    </div>


@endsection
