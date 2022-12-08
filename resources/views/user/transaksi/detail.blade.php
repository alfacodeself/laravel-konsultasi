@extends('layouts.app')

@section('title', 'Histori Transaksi')
@section('page', 'Histori Transaksi')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        @include('partials.alert')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="panel-body">
                            <div class="clearfix">
                                <div class="float-start">
                                    <h3>Konsultasi App</h3>
                                </div>
                                <div class="float-end">
                                    <h4>Invoice # <br>
                                        <strong>{{ $transaction->reference }}</strong>
                                    </h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="float-start mt-3">
                                        <address>
                                            <strong>Twitter, Inc.</strong><br>
                                            795 Folsom Ave, Suite 600<br>
                                            San Francisco, CA 94107<br>
                                            <abbr title="Phone">Telp:</abbr> (123) 456-7890
                                        </address>
                                    </div>
                                    <div class="float-end mt-3">
                                        <p>
                                            <strong>Order Date: </strong> {{ $transaction->created_at->format('Y-m-d') }}
                                        </p>
                                        <p class="m-t-10">
                                            <strong>Order Status: </strong> 
                                            <span class="label label-pink text-uppercase">{{ $transaction->status }}</span>
                                        </p>
                                        <p class="m-t-10">
                                            <strong>Order By: </strong> 
                                            <span class="label label-pink text-capitalize">{{ $transaction->user->nama }}</span>
                                        </p>

                                    </div>
                                </div><!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table mt-4">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $transaction->item }} <strong>({{ $transaction->type }})</strong></td>
                                                    <td>1</td>
                                                    <td>{{ $transaction->total_amount }}</td>
                                                    <td class="text-uppercase">{{ $transaction->status }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-6">
                                    <div class="clearfix mt-4">

                                    </div>
                                </div>
                                <div class="col-xl-3 col-6 offset-xl-3">
                                    <h3 class="text-end">Rp. {{ number_format($transaction->total_amount) }}</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="d-print-none">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-dark waves-effect waves-light"><i
                                            class="fa fa-print"></i> Cetak</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
