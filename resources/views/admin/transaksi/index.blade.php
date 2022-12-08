@extends('layouts.app')

@section('title', 'Histori Transaksi Berhasil')
@section('page', 'Histori Transaksi Berhasil')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        @include('partials.alert')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span class="text-capitalize">
                                                    {{ $transaction->transactionable->user->nama }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ $transaction->transactionable->psycholog->judul ?? $transaction->transactionable->pricing->nama_paket }}
                                            </td>
                                            <td>{{ 'Rp.' . number_format($transaction->total_amount) }}</td>
                                            <td>
                                                <a href="{{ route('admin.transaksi.show', $transaction->reference) }}"
                                                    class="btn btn-outline-success py-0">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            <div class="float-end">
                                {{ $transactions->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- end col -->
        </div>

    </div> <!-- container-fluid -->
@endsection
