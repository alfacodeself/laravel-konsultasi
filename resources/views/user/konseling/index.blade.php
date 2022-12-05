@extends('layouts.app')

@section('title', 'Jadwal Konseling')
@section('page', 'Konseling')
@section('content')
    <div class="container-fluid">
        @include('partials.alert')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3">Histori Konseling Anda</h4>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Paket</th>
                                        <th>Waktu Konseling</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                        <th>Chat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($schedules as $schedule)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td class="text-capitalize">{{ $schedule->pricing->nama_paket }}</td>
                                            <td>{{ $schedule->jadwal_konseling }}</td>
                                            <td class="text-center p-1">
                                                @if ($schedule->status_pembayaran == 'lunas')
                                                    <i class="mdi mdi-cash-check font-28 text-success"></i>
                                                @else
                                                    <i class="mdi mdi-cash-remove font-28 text-danger"></i>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($schedule->status == 'proses')
                                                    <div class="badge bg-warning text-uppercase text-dark py-1 px-2">
                                                        {{ $schedule->status }}
                                                    </div>
                                                @elseif ($schedule->status == 'terima')
                                                    <div class="badge bg-info text-uppercase py-1 px-2">
                                                        {{ $schedule->status }}
                                                    </div>
                                                @elseif ($schedule->status == 'selesai')
                                                    <div class="badge bg-success text-uppercase py-1 px-2">
                                                        {{ $schedule->status }}
                                                    </div>
                                                @elseif ($schedule->status == 'batal')
                                                    <div class="badge bg-danger text-uppercase py-1 px-2">
                                                        {{ $schedule->status }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- Kalau lunas --}}
                                                @if ($schedule->status_pembayaran == 'lunas')
                                                    {{-- Kalau lunas dan diterima --}}
                                                    @if ($schedule->status == 'terima')
                                                        <a href="{{ route('user.konseling.chat', $schedule->uuid) }}" class="btn btn-outline-info btn-sm py-0">
                                                            <i class="mdi mdi-chat-plus me-1"></i>
                                                            Mulai Konseling
                                                        </a>
                                                        {{-- Kalau lunas dan selesai --}}
                                                    @elseif ($schedule->status == 'selesai')
                                                        <a href="{{ route('user.konseling.chat', $schedule->uuid) }}" class="btn btn-outline-success btn-sm py-0">
                                                            <i class="mdi mdi-chat-processing me-1"></i>
                                                            Histori Konseling
                                                        </a>
                                                    @elseif ($schedule->status == 'proses')
                                                        <a href="{{ route('user.konseling.chat', $schedule->uuid) }}" class="btn btn-outline-warning btn-sm py-0">
                                                            <i class="mdi mdi-chat-remove me-1"></i>
                                                            Konseling Belum Disetujui
                                                        </a>
                                                    @endif
                                                    {{-- Kalau belum lunas --}}
                                                @else
                                                    <button class="btn btn-outline-danger btn-sm py-0">
                                                        <i class="mdi mdi-chat-remove me-1"></i>
                                                        Konseling Belum Aktif
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($schedule->status_pembayaran == 'lunas')
                                                    <a href="{{ route('user.transaksi.show', $schedule->transaction->reference) }}"
                                                        class="btn btn-outline-info btn-sm py-0">
                                                        <i class="mdi mdi-clipboard-check-multiple-outline me-1"></i>
                                                        Bukti Transaksi
                                                    </a>
                                                @else
                                                    @if ($schedule->status != 'batal')
                                                        <a href="{{ route('user.konseling.checkout', $schedule->uuid) }}"
                                                            class="btn btn-outline-info btn-sm py-0">
                                                            <i class="mdi mdi-credit-card-sync me-1"></i>
                                                            Bayar
                                                        </a>
                                                        <form action="{{ route('user.konseling.cancel', $schedule->uuid) }}" method="post" class="d-inline">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit" class="btn btn-outline-danger btn-sm py-0">
                                                                <i class="mdi mdi-close-box-multiple me-1"></i>
                                                                Batalkan
                                                            </button>
                                                        </form>
                                                    @else
                                                        Jadwal dibatalkan
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>

                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
