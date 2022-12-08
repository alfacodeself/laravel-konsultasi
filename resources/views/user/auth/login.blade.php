
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <title>Log In | Laravel Konsultasi</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

		<!-- App css -->

		<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

		<!-- icons -->
		<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body class="loading authentication-bg authentication-bg-pattern">

        <div class="account-pages my-5">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="text-center">   
                            <a href="#">
                                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="22" class="mx-auto">
                            </a>
                            <p class="text-muted mt-2 mb-4">Laravel Konsultasi</p>

                        </div>
                        <div class="card">
                            <div class="card-body p-4">
                                @include('partials.alert')
                                
                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0">Sign In</h4>
                                </div>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    @method('POST')
                                    <div class="">
                                        <label for="emailaddress" class="form-label">Email address</label>
                                        <input class="form-control" type="email" id="emailaddress" value="{{ old('email') }}" name="email" required="" placeholder="Enter your email">
                                        @error('email')
                                            <small class="text-danger fw-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="">
                                        <label for="password" class="form-label">Password</label>
                                        <input class="form-control" type="password" required="" name="password" id="password" placeholder="Enter your password">
                                        @error('password')
                                            <small class="text-danger fw-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="my-3 d-grid text-center">
                                        <button class="btn btn-primary" type="submit"> Log In </button>
                                    </div>
                                </form>
                                <p>Belum punya akun? Daftar <a href="{{ route('register') }}">Disini</a></p>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="#" class="text-muted ms-1"><i class="fa fa-lock me-1"></i>Forgot your password?</a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor -->
        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
        
    </body>
</html>