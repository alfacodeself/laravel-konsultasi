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
                    <form action="{{ route('user.transaksi.schedule.store', $schedule->uuid) }}" method="POST">
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
        <div class="col-xl-3 bg-white shadow mx-1 p-3 rounded">
            <h4 class="card-title text-center">{{ $schedule->pricing->nama_paket }}</h4>
            <hr>
            <div class="text-start text-capitalize">
                <b class="text-dark">Sesi</b>
                <p class="text-muted font-13 text-dark">
                    <span class="ms-2">
                        {{ $schedule->pricing->sesi }} Sesi
                    </span>
                </p>
            </div>
            <div class="text-start text-capitalize">
                <b class="text-dark">Harga</b>
                <p class="text-muted font-13 text-dark">
                    <span class="ms-2">
                        {{ 'Rp.' . number_format($schedule->pricing->harga_paket) }}
                    </span>
                </p>
            </div>
            <div class="text-start text-capitalize">
                <b class="text-dark">Fitur</b>
                @foreach ($schedule->pricing->fitur_paket as $f)
                    <p class="text-muted font-13 text-dark">
                        <span class="ms-2">
                            {{ $f }}
                        </span>
                    </p>
                @endforeach
            </div>
        </div>
    </div>  
</div>
@endsection