@extends('layouts.app')

@section('title', 'Konseling')
@section('page', 'Konseling')
@section('content')
    <div class="container-fluid">
        @include('partials.alert')
        <div class="row">
            <div class="col-lg-12">
                <div class="conversation-list-card card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5 class="mt-0 mb-1 text-truncate">{{ $schedule->pricing->nama_paket }}</h5>
                                {{-- <p class="font-13 text-muted mb-0"><i class="mdi mdi-circle text-success me-1 font-11"></i> Active</p> --}}
                                <p class="font-13 text-muted mb-0">{{ $schedule->pricing->sesi }} Sesi</p>
                            </div>
                        </div>
                        <hr class="my-3">

                        <div>
                            <ul class="conversation-list slimscroll" style="max-height: 410px;" data-simplebar>
                                <li>
                                    <div class="chat-day-title">
                                        <span class="title">------- Mulai Bimbingan Konseling -------</span>
                                    </div>
                                </li>
                                <div id="body-chat"></div>
                            </ul>
                        </div>
                    </div>
                    @if ($schedule->status == 'terima')
                        <div class="p-3 conversation-input border-top">
                            <div class="row">
                                <div class="col">
                                    <div>
                                        <input type="text" name="pesan" id="chat" class="form-control"
                                            value="{{ old('pesan') }}" placeholder="Enter Message...">
                                        <small class="text-danger" id="err-pesan"></small>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" onclick="store()"
                                        class="btn btn-info chat-send width-md waves-effect waves-light">
                                        <span class="d-none d-sm-inline-block me-2">Send</span>
                                        <i class="mdi mdi-send"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
        <!-- end row -->
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function(){
            index()
        })
        function store() {
            $('#err-pesan').text('')
            let url = '{{ route('chat.store', $schedule->uuid) }}';
            let token = '{{ csrf_token() }}';
            let chat = $('#chat').val();
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    _token: token,
                    pesan: chat 
                },
                success: function(data) {
                    $('#chat').val('');
                    index()
                },
                error: function(err) {
                    $('#err-pesan').text(err.responseJSON.message)
                }
            })
        }
        function index() {
            let url = '{{ route('chat.index', $schedule->uuid) }}';
            $.get(url, {}, function (data, status) {
                $('#body-chat').html(data);
            })
        }
        setInterval(() => {
            index()
        }, 1000);
    </script>
@endpush
