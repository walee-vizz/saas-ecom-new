@php
    $adminSetting = getSuperAdminAllSetting();
    config([
        'captcha.secret' => $adminSetting['NOCAPTCHA_SECRET'] ?? '',
        'captcha.sitekey' => $adminSetting['NOCAPTCHA_SITEKEY'] ?? '',
        'options' => [
            'timeout' => 30,
        ],
    ]);
@endphp

@extends('layouts.guest')

@section('page-title')
    {{ __('Register') }}
@endsection



@if ($adminSetting['cust_darklayout'] == 'on')
    <style>
        .g-recaptcha {
            filter: invert(1) hue-rotate(180deg) !important;
        }
    </style>
@endif

@section('content')
    <div class="">
        @if (session('status'))
            <div class="mb-4 font-medium text-lg text-green-600 text-danger">
                {{ session('status') ?? __('Email SMTP settings does not configured so please contact to your site admin.') }}
            </div>
        @endif
        <h2 class="mb-3 f-w-600">Register</h2>
    </div>
    <div class="">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label" for="name">{{ __('Name') }}</label>
                <input id="name" class="form-control" type="text" name="name" :value="old('name')" required
                placeholder="{{ __('Enter Name') }}" autofocus />
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="name">{{ __('Store name') }}</label>
                <input id="name" class="form-control" type="text" name="store_name" :value="old('store_name')"
                placeholder="{{ __('Enter Store name') }}" required autofocus />
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="email">{{ __('Email') }}</label>
                <input id="email" class="form-control" type="email" name="email" :value="old('email')" placeholder="{{ __('Enter Email') }}" required />
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="password">{{ __('Password') }}</label>
                <input id="password" class="form-control" type="password" name="password" placeholder="{{ __('Enter Password') }}" required
                    autocomplete="new-password" />
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation"
                placeholder="{{ __('Confirm Password') }}" required />
            </div>

            @if (isset($adminSetting['RECAPTCHA_MODULE']) && $adminSetting['RECAPTCHA_MODULE'] == 'yes')
                <div class="form-group col-lg-12 col-md-12 mt-3">
                    {!! NoCaptcha::display() !!}
                    @error('g-recaptcha-response')
                        <span class="error small text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            @endif

            <div class="d-grid">
                <button class="btn btn-primary btn-block mt-2" type="submit"> {{ __('Register') }} </button>
            </div>
        </form>
    </div>
    <p class="mb-2 text-center">
        Already have an account?
        <a href="{{ route('login') }}" class="f-w-400 text-primary">Signin</a>
    </p>
@endsection



@if (isset($adminSetting['RECAPTCHA_MODULE']) && $adminSetting['RECAPTCHA_MODULE'] == 'yes')
    {!! NoCaptcha::renderJs() !!}
@endif
