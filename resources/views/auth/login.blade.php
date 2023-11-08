@extends('auth.layouts.app', ['title' => '-'.__('Header.Log In')])

@section('content')
    <form method="POST" id="login-form" action="{{ route('login') }}">
        @csrf
        <h3>@lang('users.Welcome')</h3>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">@lang('users.Email')</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="exampleInputEmail1"
                aria-describedby="emailHelp">
            @if ($errors->has('email'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="mb-4 position-relative">
            <label for="myPassword" class="form-label">@lang('users.Password')</label>
            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="myPassword"
                name="password" required autocomplete="current-password">
            <a class="show-pass d-block" href="#"><i class="fa-solid fa-eye"></i></a>
            @if ($errors->has('password'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="mb-3">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-primary">@lang('users.did you forget your password?')</a>
            @endif
        </div>
        <div class="d-grid">
            <button class="btn btn-primary" id="login-btn" type="submit">@lang('Header.Log In')<i
                    class="fa-solid {{ 'fa-arrow-' . trans('general.arrow_right') }}"></i></button>
        </div>
        {{--        <div class="d-grid"> --}}
        {{--            <a href="/auth/google" class="btn btn-success">Google</a> --}}
        {{--        </div> --}}
        {{--        <div class="notes mt-5 pt-4 text-center"> --}}
        {{--            @lang('login.Don’t have an account?') <a class="text-primary" href="{{route("register")}}">@lang('login.Signup') </a> --}}
        {{--        </div> --}}
    </form>
@endsection

@section('js_code')
    <script>
        $(document).on('submit', '#login-form', function() {
            $('#login-btn').attr('disabled', 'disabled')
            $('#login-btn').addClass('disabled')
        })
    </script>
@endsection
