
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8" />
        <title>Laravel Konsultasi | Question Psycholog</title>
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

    <body class="loading" style="background:linear-gradient(rgba(30, 112, 108, 0.9), rgba(3, 22, 54, 0.9)) fixed center center;">

        <div class="account-pages my-5">
            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('tes', $psycholog->uuid) }}" method="POST">
                            @csrf
                            <div class="conversation-list-card card">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h5 class="mt-0 mb-1 text-truncate">{{ $psycholog->judul }}</h5>
                                        </div>
                                    </div>
                                    <hr class="my-3">
                                    <div>
                                        <ol class="conversation-list slimscroll" type="1" style="max-height: 410px;" data-simplebar>
                                            @foreach ($psycholog->questions as $question)
                                            <li>
                                                <span class="text-dark fw-bold">{{ $loop->iteration }}. </span>
                                                {{ $question->soal }}
                                                
                                                @foreach ($question->answers as $answer)
                                                <div class="form-check form-check-success">
                                                    <input type="radio" name="jawaban[{{ $question->uuid }}]" id="{{ $answer->uuid }}" value="{{ $answer->uuid }}"
                                                            class="form-check-input" >
                                                    <label for="{{ $answer->uuid }}" class="form-label">
                                                        {{ $answer->jawaban }}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </li>
                                            <hr>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                                <div class="p-3 conversation-input border-top">
                                    <div class="row">
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-info chat-send width-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Kirim Jawaban</span> <i class="mdi mdi-send"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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