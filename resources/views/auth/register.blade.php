@extends('auth.layouts.app', ['title' => '-'.__('Header.Register')])
<style>
    .backgroundGreen{
        background: linear-gradient(270deg, #5E9B47 0%, #247B3D 100%);
    }
</style>
@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="exampleInputName1" class="form-label">@lang('users.Name')</label>
            <input type="name" name="name" value="{{ old('name') }}" required autofocus
                class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="exampleInputName1">
            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">@lang('users.Email')</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="exampleInputEmail1">
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
            <a class="underline text-sm text-primary hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                @lang('users.Already registered?')
            </a>

            <button class="ml-4 btn btn-primary mx-2">
                @lang('Header.Register')
            </button>
        </div>
    </form>
@endsection
