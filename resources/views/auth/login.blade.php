{{-- @extends('layouts.app')
@section('title', 'Đăng nhập')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends("layouts.main")
@section("tiltle", "Đăng nhập")
@section("content")
<div id="wrapper" class="container p-5 mt-5 bg-white rounded">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group mb-4">
            <label for="email" class="pb-2">Email</label>
            <input type="text" id="email" class="form-control email  @error('email') is-invalid @enderror" name="email" placeholder="Nhập email..." value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password" class="pb-2">Mật khẩu</label>
            <input type="password" id="password" class="form-control password @error('password') is-invalid @enderror" name="password" placeholder="Nhập mật khẩu..." required autocomplete="current-password">
        </div>
        <div class="form-group mt-3">
            <input type="checkbox" id="remember" class="form-check-input mt-0" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember" class="pb-0 form-check-label">Ghi nhớ</label>
        </div>
        <input type="submit" class="btn-sub mt-2 form-control" name="btn-submit" value="Đăng nhập">
        <div class="form-group mt-3 text-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
            @endif
        </div>
        <div class="form-group mt-3 text-center">
            Bạn có tài khoản chưa?<a href="{{ route('register') }}"> Đăng ký</a>
        </div>
    </form>
</div>
@endsection
