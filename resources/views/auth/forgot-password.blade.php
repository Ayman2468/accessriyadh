@extends('auth.layouts.app', ['title' => '-' . __('Header.Reset Password')])

@section('content')
    <div class="mb-4 text-sm text-gray-600">
        {{ __('general.Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">@lang('general.Email')</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="exampleInputEmail1"
                aria-describedby="emailHelp">
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="flex items-center justify-end mt-4">
            <button class="btn btn-success">
                {{ __('general.Email Password Reset Link') }}
            </button>
        </div>
    </form>
@endsection
