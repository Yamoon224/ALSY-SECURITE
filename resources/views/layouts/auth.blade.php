<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'ALSY SECURITE') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" sizes="32x32" href="{{ asset('images/favicon.ico') }}">
        <!--plugins-->
        <link href="{{ asset('admin/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
        <!-- loader-->
        <link href="{{ asset('admin/css/pace.min.css') }}" rel="stylesheet" />
        <script src="{{ asset('admin/js/pace.min.js') }}"></script>
        <!-- Bootstrap CSS -->
        <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/css/bootstrap-extended.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/css/icons.css') }}" rel="stylesheet">
        @stack('links')
    </head>
    <body class="bg-auth">
        <!--wrapper-->
        <div class="wrapper">
            <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
                <div class="container">
                    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-{{ $size }}">
                        <div class="col mx-auto">
                            <div class="card border-dark border-bottom border-top border-5 mb-0">
                                <div class="card-body">
                                    <div class="p-4">
                                        <div class="mb-3 text-center">
                                            <x-app-logo></x-app-logo>
                                        </div>
                                        
                                        {{ $slot }}

                                        <div class="login-separater text-center mb-2"> 
                                            <span>Copyright &copy; {{ env('APP_NAME') }} {{ date('Y') }}</span>
                                            <hr/>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
        <!--end wrapper-->
        <!-- Bootstrap JS -->
        <script src="{{ asset('admin/js/bootstrap.bundle.min.js') }}"></script>
        <!--plugins-->
        <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/simplebar/js/simplebar.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/metismenu/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('admin/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
        <!--Password show & hide js -->
        <script src="{{ asset('js/pwdx.js') }}"></script>
        <script src="{{ asset('admin/js/app.js') }}"></script>
    </body>
</html>
