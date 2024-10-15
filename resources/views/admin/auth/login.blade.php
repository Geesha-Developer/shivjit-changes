<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>Super Admin Dashboard</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('fav.jpg') }}" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ url('') }}/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('') }}/assets/css/style.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/account.css') }}">
</head>
<style>
    .copyright {
        font-size: 17px;
        margin-top: 82px;
    }
    body {
    font-family: 'poppins-bold', sans-serif !important;
}
/* login button hover start */
.nav .fas{
    margin-right: 10px;
}
.nav .fa{
    margin-right: 10px;  
}
.nav li a {
    background: #555;
    color: #fff;
    padding: 10px 20px;
    margin: 0px 10px;
    border-radius: 28px;
    text-decoration: none;
    font-size: 18px;
}
.nav li a:hover {
    background: #62830b !important;
}
.nav{
    margin-top: 20px;
}
/* login button hover end */
</style>

<body class="theme-blush"
style="background-image: url('{{ asset('bg.png') }}'); background-repeat: no-repeat; background-size: cover; width:100%;">
    <div class="container">
        <div class="row d-flex justify-content-end" style="margin-bottom: 34px;">
            <ul class="nav mr-3">
                    <li class="nav-item">
                        <a href="{{ route('account.login') }}"><i class="fa fa-book-reader text-white"></i>Account</a>
                    </li>
                    <li class="nav-item">
                        <a href="/"><i class="fa fa-truck text-white"></i>Broker</a>
                    </li>
                </ul>
        </div>
    </div>
    <scetion class="account-login py-4">
        <div class="main py-$">
           <div class="container">
           <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card-body p-0">
                    <form class="card auth_form login-form" method="post" action="" style="padding: 28px;    margin: 20% 0;">
                        @csrf
                        <div class="header">
                        <div class="login-heading" style="font-size: 27px; font-weight: 700; color: #525151;">Admin Login</div>
                          <img src="{{ asset('Cargo-icon.png') }}" alt="" id="login-logo" style="width:50%;">
                            @if(session()->has('error'))
                            <div class="alert alert-danger">{{ session()->get('error') }}</div>
                            @endif
                        </div>
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="email" class="form-control" name="email" placeholder="Email">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                            <i class="fa fa-eye" id="togglePassword"></i>
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="forgot-password.html" class="forgot"
                                            title="Forgot Password"><i class="fa fa-lock"
                                                style="    color: #495057;"></i></a></span>
                                </div>
                                <input type="password" class="form-control" name="password" id="passwordField" placeholder="Password">

                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
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
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="font-weight: 400;color: #007bff;text-decoration: none;font-size: 1rem;">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">Sign In</button>
                    </form>
                   </div>
                </div>
            </div>
           </div>
           <div class="text-center copyright">
               <?php
           $date =  date('Y');
           ?>
                               &#169;Copyright <?php echo $date ?> by <a href="https://geeshasolutions.com/">Geesha Solutions PVT
                                   LTD</a>
   
           </div>
        </div>
        </section>

        <!-- Jquery Core Js -->
        <script src="{{ url('') }}/assets/bundles/libscripts.bundle.js"></script>
        <script src="{{ url('') }}/assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
</body>
<script>
    // Get references to the password field and the toggle icon
    var passwordField = document.getElementById('passwordField');
    var togglePassword = document.getElementById('togglePassword');

    // Add click event listener to the toggle icon
    togglePassword.addEventListener('click', function() {
        // Toggle the type attribute of the password field between 'password' and 'text'
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            // Change the icon to hide the password
            togglePassword.classList.remove('fa-eye');
            togglePassword.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            // Change the icon to show the password
            togglePassword.classList.remove('fa-eye-slash');
            togglePassword.classList.add('fa-eye');
        }
    });
</script>
</html>