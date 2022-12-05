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
                        <h4 class="header-title mt-0 mb-3">Daftar Konseling</h4>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Paket</th>
                                        <th>Pasien</th>
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
                                            <td class="text-capitalize">{{ $schedule->user->nama }}</td>
                                            <td>{{ $schedule->jadwal_konseling }}</td>
                                            <td>
                                                <a href="{{ route('user.transaksi.show', $schedule->transaction->reference) }}"
                                                    class="btn btn-outline-info btn-sm py-0">
                                                    <i class="mdi mdi-clipboard-check-multiple-outline me-1"></i>
                                                    Bukti
                                                </a>
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
                                                        <a href="{{ route('admin.konsultasi.chat', $schedule->uuid) }}" class="btn btn-outline-info btn-sm py-0">
                                                            <i class="mdi mdi-chat-plus me-1"></i>
                                                            Mulai Konseling
                                                        </a>
                                                        {{-- Kalau lunas dan selesai --}}
                                                    @elseif ($schedule->status == 'selesai')
                                                        <a href="{{ route('admin.konsultasi.chat', $schedule->uuid) }}" class="btn btn-outline-success btn-sm py-0">
                                                            <i class="mdi mdi-chat-processing me-1"></i>
                                                            Histori Konseling
                                                        </a>
                                                    @elseif ($schedule->status == 'proses')
                                                        <a href="{{ route('admin.konsultasi.chat', $schedule->uuid) }}" class="btn btn-outline-warning btn-sm py-0">
                                                            <i class="mdi mdi-chat-remove me-1"></i>
                                                            Belum Disetujui
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
                                                @if ($schedule->status == 'proses')
                                                    <form action="{{ route('admin.konsultasi.store', $schedule->uuid) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="btn btn-outline-info btn-sm py-0">
                                                            <i class="mdi mdi-check me-1"></i>
                                                            Setuju
                                                        </button>
                                                    </form>
                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#add-modal"
                                                        class="btn btn-outline-warning btn-sm py-0"
                                                        data-jadwal="{{ $schedule->jadwal_konseling }}"
                                                        data-route="{{ route('admin.konsultasi.store', $schedule->uuid) }}">
                                                        <i class="mdi mdi-pencil me-1"></i>
                                                        Ubah
                                                    </button>
                                                @elseif ($schedule->status == 'terima')
                                                    <form action="{{ route('admin.konsultasi.finish', $schedule->uuid) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="btn btn-outline-success btn-sm py-0">
                                                            <i class="mdi mdi-check-all me-1"></i>
                                                            Selesai
                                                        </button>
                                                    </form>
                                                @elseif ($schedule->status == 'selesai')
                                                    Konseling Selesai
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada pengajuan jadwal konseling!
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title">Ubah Jadwal Konseling</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" class="modal-route">
                        @csrf
                        @method('POST')
                        <div class="mb-2">
                            <label for="jadwal" class="form-label">Ubah Jadwal</label>
                            <input type="datetime-local" class="form-control modal-jadwal" id="jadwal" name="jadwal"
                                placeholder="Nama Paket" value="{{ old('jadwal') }}">
                        </div>
                        <button type="submit" class="btn btn-info waves-effect waves-light">Setujui</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light"
                            data-bs-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#add-modal').on('show.bs.modal', function(e) {
            const button = $(e.relatedTarget);
            let jadwal = button.data('jadwal');
            let route = button.data('route');

            let modal = $(this);
            modal.find('.modal-route').attr('action', route);
            modal.find('.modal-jadwal').val(jadwal);
        })
    </script>
@endpush
