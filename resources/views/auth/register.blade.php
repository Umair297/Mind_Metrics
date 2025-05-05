<!doctype html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="http://localhost/cms/public/dashboard/assets/" data-template="vertical-menu-template"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Register Mind-Metrics</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="http://localhost/cms/public/dashboard/assets/img/favicon/favicon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/fonts/flag-icons.css" />
    <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/css/rtl/core.css"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/css/rtl/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/css/demo.css" />
    <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet"
        href="http://localhost/cms/public/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet"
        href="http://localhost/cms/public/dashboard/assets/vendor/libs/@form-validation/form-validation.css" />
    <link rel="stylesheet" href="http://localhost/cms/public/dashboard/assets/vendor/css/pages/page-auth.css" />
    <script src="http://localhost/cms/public/dashboard/assets/vendor/js/helpers.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/js/template-customizer.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/js/config.js"></script>
    <style>
    .btn-primary{
        background-color: #EE2D7B !important;
        border: none;
    }
    .btn-primary:hover{
        background-color: #EE2D7B !important;
        border: none;
    }
    .form-control:focus {
    border-color: #EE2D7B !important;
    box-shadow: 0 0 5px rgba(238, 45, 123, 0.5);
}
@media screen and (max-width: 767px) {
    img[src="http://localhost/cms/public/dashboard/assets/img/favicon/favicon.png"] {
      display: none;
    }
  }
</style>
</head>

<body>
    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <img src="http://localhost/cms/public/dashboard/assets/img/branding/logo.png" alt="Logo" style="width: 170px; height: auto;
      margin-left: 20px; margin-top: 0px;">
        <!-- /Logo -->
        <div class="authentication-inner row m-0">
            <div class="d-none d-lg-flex col-lg-8 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="http://localhost/cms/public/dashboard/assets/img/illustrations/auth-register-illustration-light.png"
                        alt="auth-register-cover" class="my-5 auth-illustration"
                        data-app-light-img="illustrations/auth-register-illustration-light.png"
                        data-app-dark-img="illustrations/auth-register-illustration-dark.png" />
                    <img src="http://localhost/cms/public/dashboard/assets/img/illustrations/bg-shape-image-light.png"
                        alt="auth-register-cover" class="platform-bg"
                        data-app-light-img="illustrations/bg-shape-image-light.png"
                        data-app-dark-img="illustrations/bg-shape-image-dark.png" />
                </div>
            </div>
            <!-- Register -->
            <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-18 p-6">
                <div class="w-px-400 mx-auto mt-12 pt-5">
                    <h4 class="mb-1">Adventure starts here 🚀</h4>
                    <p class="mb-6">Make your app management easy and fun!</p>
                    <form id="formAuthentication" class="mb-6" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-6">
                            <label for="username" class="form-label">{{ __('Username') }}</label>
                            <input id="name" type="text" class="form-control  @error('name') is-invalid @enderror" id="username" name="name"
                            value="{{ old('name') }}"  required autocomplete="name" placeholder="Enter your username" autofocus />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email" />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-6 form-password-toggle">
                            <label class="form-label" for="password">{{ __('Password') }}</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-6">
            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
                        <div class="mb-6 mt-8">
                            <div class="form-check mb-8 ms-2">
                                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                                <label class="form-check-label" for="terms-conditions">
                                    I agree to
                                    <a href="#" style="color: #EE2D7B;">privacy policy & terms</a>
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary d-grid w-100">Sign up</button>
                    </form>
                    <p class="text-center">
                        <span>Already have an account?</span>
                        <a href="{{ route('login') }}">
                            <span style="color: #EE2D7B;">Sign in instead</span>
                        </a>
                    </p>

                </div>
            </div>
        </div>
    </div>

    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/popper/popper.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/js/bootstrap.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/js/menu.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/@form-validation/auto-focus.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/js/main.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/js/pages-auth.js"></script>
</body>
</html>