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
                                                        <a href="{{ route('chat', $schedule->uuid) }}"
                                                            class="btn btn-outline-info btn-sm py-0">
                                                            <i class="mdi mdi-chat-plus me-1"></i>
                                                            Mulai Konseling
                                                        </a>
                                                        {{-- Kalau lunas dan selesai --}}
                                                    @elseif ($schedule->status == 'selesai')
                                                        <a href="{{ route('chat', $schedule->uuid) }}"
                                                            class="btn btn-outline-success btn-sm py-0">
                                                            <i class="mdi mdi-chat-processing me-1"></i>
                                                            Histori Konseling
                                                        </a>
                                                    @elseif ($schedule->status == 'proses')
                                                        <a href="{{ route('chat', $schedule->uuid) }}"
                                                            class="btn btn-outline-warning btn-sm py-0">
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
                                                    <button type="button" class="btn btn-outline-info btn-sm py-0"
                                                        data-bs-toggle="modal" data-bs-target="#bukti-modal"
                                                        data-bukti="{{ json_encode($schedule->transactions) }}">
                                                        <i class="mdi mdi-clipboard-check-multiple-outline me-1"></i>
                                                        Bukti Transaksi
                                                    </button>
                                                @else
                                                    @if ($schedule->status != 'batal')
                                                        <a href="{{ route('user.konseling.checkout', $schedule->uuid) }}"
                                                            class="btn btn-outline-info btn-sm py-0">
                                                            <i class="mdi mdi-credit-card-sync me-1"></i>
                                                            Bayar
                                                        </a>
                                                        <form
                                                            action="{{ route('user.konseling.cancel', $schedule->uuid) }}"
                                                            method="post" class="d-inline">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit"
                                                                class="btn btn-outline-danger btn-sm py-0">
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

    <div class="modal fade" id="bukti-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title" id="myCenterModalLabel">Bukti Pembayaran</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode Reference</th>
                                    <th>Total Bayar</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="bukti-bayar">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#bukti-modal').on('show.bs.modal', function(e) {
            const button = $(e.relatedTarget);
            let bukti = button.data('bukti');
            let modal = $(this);
            var html = '';
            bukti.forEach((e, k) => {
                var url = '{{ route('user.transaksi.detail', "~id") }}';
                url = url.replace("~id", e.reference)
                console.log(url);
                html += '<tr>';
                html += '<td>' + (k + 1) + '</td>';
                html += '<td>' + e.reference + '</td>';
                html += '<td>' + e.total_amount + '</td>';
                html += '<td class="text-uppercase">' + e.status + '</td>';
                html += '<td>' + e.created_at + '</td>';
                html += '<td><a href="'+url+'" class="btn btn-outline-success py-0">Detail</a></td>';
                html += '</tr>';
                $('#bukti-bayar').html(html)
            })
        })
    </script>
@endpush
