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
                            @foreach ($chats as $chat)
                            <li class="{{ $chat->type == 'user' ? 'odd' : '' }}">
                                <div class="message-list">
                                    <div class="chat-avatar">
                                        <img src="{{ asset($chat->chatable->foto) }}" alt="">
                                    </div>
                                    <div class="conversation-text">
                                        <div class="ctext-wrap">
                                            <span class="user-name text-capitalize font-16">{{ $chat->chatable->nama }}</span>
                                            <p class="font-14">
                                                {{ $chat->pesan }}
                                            </p>
                                        </div>
                                        <span class="time">{{ $chat->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @if ($schedule->status == 'terima')
                <div class="p-3 conversation-input border-top">
                    <form action="{{ route('admin.konsultasi.chat.store', $schedule->uuid) }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col">
                                <div>
                                    <input type="text" name="pesan" class="form-control" value="{{ old('pesan') }}" placeholder="Enter Message...">
                                    @error('pesan')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-info chat-send width-md waves-effect waves-light"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>

    </div>
    <!-- end row -->
</div>
@endsection