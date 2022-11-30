@extends('layouts.app')

@section('title', 'Hasil Tes Psikologi')
@section('page', 'Tes Psikologi')
@section('content')
<div class="container-fluid">
    @include('partials.alert')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-3">Hasil Tes Psikologi Anda</h4>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Jenis Tes Psikolog</th>
                                <th>Mengikuti Atas Nama</th>
                                <th>Tanggal Tes</th>
                                <th>Hasil</th>
                                <th>Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($psycholog_users as $pu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pu->psycholog->judul }}</td>
                                    <td>{{ $pu->user->nama }}</td>
                                    <td>{{ $pu->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        @if ($pu->status == 'belum lunas')
                                        <a href="{{ route('user.psycholog.checkout', [$pu->psycholog->uuid, $pu->uuid]) }}" class="btn btn-outline-danger btn-sm py-0"><i class="mdi mdi-lock-remove me-1"></i>Buka Hasil</a>
                                        @else
                                            {{ $pu->point }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($pu->status == 'belum lunas')
                                            -
                                        @else
                                            {{ $pu->point }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
           
        </div><!-- end col -->
    </div>  
</div>
@endsection