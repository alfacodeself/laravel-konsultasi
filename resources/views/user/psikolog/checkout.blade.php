@extends('layouts.app')

@section('title', 'Metode Pembayaran')
@section('page', 'Pilih Metode Pembayaran')
@section('content')
<div class="container-fluid">
    @include('partials.alert')
    <div class="row bg-light p-3">
        <div class="col-xl-8">
            <div class="row">
                {{-- @dd($payments) --}}
                @foreach ($payments as $payment)
                <div class="col-md-4">
                    <form action="{{ route('user.transaksi.psycholog.store', $psycholog_user->uuid) }}" method="POST">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="method" value="{{ $payment->code }}">
                        <button type="submit" class="card p-2 shadow-lg" style="height: 11rem; width:100%; cursor: pointer;">
                            <img class="card-img-top" src="{{ url($payment->icon_url) }}" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{ $payment->name }}</h5>
                            </div>
                        </button>
                    </form>
                </div>
                @endforeach
            </div>
        </div><!-- end col -->
        <div class="col-xl-4">
            <div class="card px-3 shadow-lg">
                <img class="card-img-top" src="{{ url($psycholog->gambar) }}" alt="">
                <h4 class="card-title text-center">{{ $psycholog->judul }}</h4>
                <small class="text-mute text-center">{{ $psycholog->deskripsi }}</small>
                <hr>
                <div class="text-start text-capitalize">
                    <b class="text-dark">Soal</b>
                    <p class="text-muted font-13 text-dark">
                        <span class="ms-2">
                            {{ $psycholog->questions->count() }} Soal
                        </span>
                    </p>
                </div>
                <div class="text-start text-capitalize">
                    <b class="text-dark">Harga</b>
                    <p class="text-muted font-13 text-dark">
                        <span class="ms-2">
                            Rp. {{ number_format($psycholog->harga) }}
                        </span>
                    </p>
                </div>
                <div class="text-start text-capitalize">
                    <b class="text-dark">Atas Nama</b>
                    <p class="text-muted font-13 text-dark">
                        <span class="ms-2">
                            {{ $psycholog_user->user->nama }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection