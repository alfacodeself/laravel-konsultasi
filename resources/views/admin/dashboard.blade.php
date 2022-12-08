@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page', 'Dashboard Admin')
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
                                <span class="badge bg-success rounded-pill float-start mt-3">{{ $soal }} Soal <i class="mdi mdi-help-circle-outline"></i> </span>
                                <h2 class="fw-normal mb-1"> {{ $tes }} </h2>
                                <p class="text-muted">Total Tes Psikologi</p>
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
                                <span class="badge bg-danger rounded-pill float-start mt-3">{{ $jadwal }} Jadwal <i class="mdi mdi-help-circle-outline"></i> </span>
                                <h2 class="fw-normal mb-1"> {{ $konsel }} </h2>
                                <p class="text-muted">Total Pasien</p>
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
                                <span class="badge bg-info rounded-pill float-start mt-3">{{ number_format($jumlah) }} <i class="mdi mdi-currency-usd"></i> </span>
                                <h2 class="fw-normal mb-1"> {{ $trx }} </h2>
                                <p class="text-muted">Total Transaksi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-1">Paket Sesi</h4>

                        <div class="widget-box-2">
                            <div class="widget-detail-2 text-end">
                                <span class="badge bg-warning text-dark rounded-pill float-start mt-3">{{ $paketAkt }} Aktif <i class="mdi mdi-check-all"></i> </span>
                                <h2 class="fw-normal mb-1"> {{ $paket }} </h2>
                                <p class="text-muted">Total Paket</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3">Jadwal Konseling Hari Ini</h4>
    
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Pasien</th>
                                    <th>Paket Sesi</th>
                                    <th>Jam Konseling</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jdw as $j)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-capitalize">{{ $j->user->nama }}</td>
                                        <td>{{ $j->pricing->nama_paket }}</td>
                                        <td>{{ $j->jadwal_konseling }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>
               
            </div>
        </div>  
    </div>
@endsection
