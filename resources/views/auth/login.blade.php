@extends('layouts.app')
@section('content')
<style>
    .alert-danger {
    color: #ffffff;
    background-color: rgba(238, 37, 88, 0.8);
    padding-top: .9rem;
    padding-bottom: .9rem;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card-body p-0">
                <form method="POST" action="{{ route('agent-tl-login') }}" class="login-form" style="padding: 28px;    margin: 20% 0;">
                    @csrf
                    <div class="logo text-center">
                    <div class="login-heading" style="font-size: 27px; font-weight: 700; color: #525151;">Agent Login</div>
                        <img src="{{ asset('Cargo-icon.png') }}" alt="" id="login-logo" style="width:50%;"><br>
                        @error('email')
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>

                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text" for="email" class="col-md-4 col-form-label text-md-end"><img
                                    alt="" id="profile"><i class="fa fa-user"></i></span>
                        </div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" for="password"
                                class="col-md-4 col-form-label text-md-end"><img alt="" id="profile"><i
                                    class=" fa fa-lock"></i> </span>
                        </div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <i id="togglePassword" class="fa fa-eye" aria-hidden="true" onclick="togglePasswordVisibility()"></i>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <div class="p-2">
                        <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    value="{{ old('remember') ? 'checked' : '' }}">

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="p-2 ">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                    </div>
                </form>
                <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
    </div>

    <script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var toggleIcon = document.getElementById("togglePassword");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        }
    }
</script>

    @endsection