<!doctype html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="http://localhost/cms/public/dashboard/assets/" data-template="vertical-menu-template"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Forgot Password Cover</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="http://localhost/cms/public/dashboard/assets/img/favicon/favicon.ico" />
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
                    <img src="http://localhost/cms/public/dashboard/assets/img/illustrations/auth-forgot-password-illustration-light.png"
                        alt="auth-forgot-password-cover" class="my-5 auth-illustration d-lg-block d-none"
                        data-app-light-img="illustrations/auth-forgot-password-illustration-light.png"
                        data-app-dark-img="illustrations/auth-forgot-password-illustration-dark.png" />

                    <img src="http://localhost/cms/public/dashboard/assets/img/illustrations/bg-shape-image-light.png"
                        alt="auth-forgot-password-cover" class="platform-bg"
                        data-app-light-img="illustrations/bg-shape-image-light.png"
                        data-app-dark-img="illustrations/bg-shape-image-dark.png" />
                </div>
            </div>
            <!-- Forgot Password -->
            <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6">
                <div class="w-px-400 mx-auto mt-12 mt-5">
                    <h4 class="mb-1">Forgot Password? 🔒</h4>
                    <p class="mb-6">Enter your email and we'll send you instructions to reset your password</p>
                    
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-6">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                            <i class="ti ti-chevron-left scaleX-n1-rtl me-1_5"></i>
                            Back to login
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Forgot Password -->
        </div>
    </div>

    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/popper/popper.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/js/bootstrap.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script
        src="http://localhost/cms/public/dashboard/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="http://localhost/cms/public/dashboard/assets/vendor/libs/@form-validation/auto-focus.js"></script>

    <!-- Main JS -->
    <script src="http://localhost/cms/public/dashboard/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="http://localhost/cms/public/dashboard/assets/js/pages-auth.js"></script>
</body>

</html>