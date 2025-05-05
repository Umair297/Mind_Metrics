<!doctype html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="http://localhost/cms/public/dashboard/assets/" data-template="vertical-menu-template"
    data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Login Mind-Metrics</title>
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
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row w-100">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-lg p-4">
                <div class="card-header text-center bg-primary text-white fw-bold">
                    {{ __('Reset Password') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ $email ?? old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required>
                            @error('password')
                                <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
