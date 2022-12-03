@extends('layouts.app')

@section('title', 'Hasil Tes Psikologi')
@section('page', 'Buat Hasil Tes Psikologi')
@section('content')
    <div class="container-fluid">
        @include('partials.alert')
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-xl-3 bg-white shadow mx-1 p-3 rounded">
                <h4 class="card-title text-center">{{ $pricing->nama_paket }}</h4>
                <hr>
                <div class="text-start text-capitalize">
                    <b class="text-dark">Sesi</b>
                    <p class="text-muted font-13 text-dark">
                        <span class="ms-2">
                            {{ $pricing->sesi }} Sesi
                        </span>
                    </p>
                </div>
                <div class="text-start text-capitalize">
                    <b class="text-dark">Harga</b>
                    <p class="text-muted font-13 text-dark">
                        <span class="ms-2">
                            {{ 'Rp.' . number_format($pricing->harga_paket) }}
                        </span>
                    </p>
                </div>
                <div class="text-start text-capitalize">
                    <b class="text-dark">Fitur</b>
                    @foreach ($pricing->fitur_paket as $f)
                        <p class="text-muted font-13 text-dark">
                            <span class="ms-2">
                                {{ $f }}
                            </span>
                        </p>
                    @endforeach
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('user.konseling.store', $pricing->uuid) }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-xl-8">
                                    <div class="mb-1">
                                        <label class="form-label">Rencana Jadwal Konseling</label>
                                        <input class="form-control" type="datetime-local" name="jadwal"
                                            placeholder="Keterangan" class="input-mini form-control" />
                                    </div>
                                </div>
                                <div class="col-xl-4">
                                    <div class="mb-1">
                                        <label class="form-label">Aksi</label><br>
                                        <button type="submit" class="btn btn-success waves-effect d-block waves-light">
                                            <i class="mdi mdi-plus me-1"></i>
                                            Buat Jadwal Konseling
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div><!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection