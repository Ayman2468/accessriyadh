@extends('auth.layouts.app', ['title' => '-' . __('Header.Reset Password')])

@section('content')
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">@lang('general.Email')</label>
            <input type="email" name="email" value="{{ request()->email }}" required autofocus
                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="exampleInputEmail1"
                aria-describedby="emailHelp" readonly>
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <!-- Password -->
        <div class="mb-4 position-relative">
            <label for="Password" class="form-label">@lang('users.Password')</label>
            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="Password"
                name="password" required>
            <a class="show-pass d-block" href="#"><i class="fa-solid fa-eye"></i></a>
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="mb-4 position-relative">
            <label for="Password_Confirmation" class="form-label">@lang('users.Password_Confirmation')</label>
            <input type="password" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="Password_Confirmation"
                name="password_confirmation" required>
            <a class="show-pass d-block" href="#"><i class="fa-solid fa-eye"></i></a>
            @if ($errors->has('password_confirmation'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>

        <div class="flex items-center justify-end mt-4">
            <button class="ml-4 btn btn-primary mx-2">
                {{ __('Header.Reset Password') }}
            </button>
        </div>
    </form>
@endsection
