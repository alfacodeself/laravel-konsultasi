@extends('layouts.app')

@section('title', 'Dashboard Pengguna')
@section('page', 'Dashboard Pengguna')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        @include('partials.alert')
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-1">Tes Psikologi</h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2 text-end">
                                {{-- <span class="badge bg-success rounded-pill float-start mt-3">32 Soal <i
                                        class="mdi mdi-help-circle-outline"></i> </span> --}}
                                <h2 class="fw-normal mb-1"> {{ $tests }} </h2>
                                <p class="text-muted">Total Tes Psikologi Diikuti</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-1">Konseling</h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2 text-end">
                                {{-- <span class="badge bg-danger rounded-pill float-start mt-3">32 Jadwal <i
                                        class="mdi mdi-help-circle-outline"></i> </span> --}}
                                <h2 class="fw-normal mb-1"> {{ $schedules }} </h2>
                                <p class="text-muted">Total Jadwal Disetujui</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-1">Transaksi</h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2 text-end">
                                {{-- <span class="badge bg-info rounded-pill float-start mt-3">300.000.000 <i
                                        class="mdi mdi-currency-usd"></i> </span> --}}
                                <h2 class="fw-normal mb-1"> {{ $trx1 }} </h2>
                                <p class="text-muted">Total Transaksi Berhasil</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-1">Pengeluaran</h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2 text-end">
                                {{-- <span class="badge bg-info rounded-pill float-start mt-3">300.000.000 <i
                                        class="mdi mdi-currency-usd"></i> </span> --}}
                                <h2 class="fw-normal mb-1"> {{ 'Rp.' . number_format($jml) }} </h2>
                                <p class="text-muted">Total Pembayaran Berhasil</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 justify-content-center">
            <h4 class="mb-3">Data Paket Konseling</h4>
            {{-- @dd($pricings[0]->uuid) --}}
            @forelse ($pricings as $paket)
                <div class="col-3 mb-2 bg-white shadow mx-2 p-2 rounded">
                    <h4 class="card-title text-center">{{ $paket->nama_paket }}</h4>
                    <hr>
                    <div class="text-start text-capitalize">
                        <b class="text-dark">Sesi</b>
                        <p class="text-muted font-13 text-dark">
                            <span class="ms-2">
                                {{ $paket->sesi }} Sesi
                            </span>
                        </p>
                    </div>
                    <div class="text-start text-capitalize">
                        <b class="text-dark">Harga</b>
                        <p class="text-muted font-13 text-dark">
                            <span class="ms-2">
                                {{ 'Rp.' . number_format($paket->harga_paket) }}
                            </span>
                        </p>
                    </div>
                    <div class="text-start text-capitalize">
                        <b class="text-dark">Fitur</b>
                        @foreach ($paket->fitur_paket as $f)
                            <p class="text-muted font-13 text-dark">
                                <span class="ms-2">
                                    {{ $f }}
                                </span>
                            </p>
                        @endforeach
                    </div>
                    <a href="{{ route('user.konseling.create', $paket->uuid) }}" class="btn btn-success d-block mb-auto">Beli Paket</a>
                </div>
            @empty
                <div class="col-xl-12">
                    <div class="card" style="height: 70vh">
                        <h3 class="text-center mt-5">Tidah ada paket sesi!</h3>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="row">
            <h4 class="mb-3">Kegiatan</h4>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3">Jadwal Konseling Hari Ini</h4>

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Paket Sesi</th>
                                        <th>Jam Konseling</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwal as $j)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $j->pricing->nama_paket }}</td>
                                        <td>{{ $j->jadwal_konseling }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div><!-- end col -->
        </div>

    </div> <!-- container-fluid -->
@endsection
