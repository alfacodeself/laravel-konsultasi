@extends('layouts.app')

@section('title', 'Detail Transaksi')
@section('page', 'Detail Transaksi')
@section('content')
    <div class="container-fluid">
        @include('partials.alert')
        <div class="row">
            <div class="col-xl-7">
                <div class="card">
                    <div class="card-header">
                        Detail Transaksi
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">ID {{ $detail->reference }}</h5>
                        <table>
                            <tr>
                                <th width="40%">Produk</th>
                                <td width="40%">{{ $detail->order_items[0]->name }}</td>
                                <td width="20%" rowspan="6">
                                    <strong class="text-uppercase px-3 py-2 font-18  badge bg-info">{{ $detail->status }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <th width="40%">Qty</th>
                                <td width="40%">{{ $detail->order_items[0]->quantity }}</td>
                            </tr>
                            <tr>
                                <th width="40%">Sub Total</th>
                                <td width="40%">{{ 'Rp.' . number_format($detail->order_items[0]->subtotal) }}</td>
                            </tr>
                            <tr>
                                <th width="40%">Metode Pembayaran</th>
                                <td width="40%">{{ $detail->payment_name }}</td>
                            </tr>
                            <tr>
                                <th width="40%">Nama Pelanggan</th>
                                <td width="40%">{{ $detail->customer_name }}</td>
                            </tr>
                            <tr>
                                <th width="40%">Email Pelanggan</th>
                                <td width="40%">{{ $detail->customer_email }}</td>
                            </tr>
                        </table>

                        
                        <hr>
                    </div>
                </div>
            </div>
            {{-- @dd($detail->status == 'REFUND') --}}
            @if ($detail->status == 'UNPAID')
            <div class="col-xl-5">
                <div class="card">
                    <div class="card-header">
                        Instruksi Pembayaran
                    </div>
                    <div class="card-body">
                        @foreach ($detail->instructions as $instruction)
                            <button type="button" style="width: 100%" class="btn mb-2 btn-dark dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $instruction->title }} <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu p-3 text-muted" style="max-width: 500px;">
                                <ol type="1">
                                    @foreach ($instruction->steps as $step)
                                        <li>
                                            {!! $step !!}
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
