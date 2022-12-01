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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.psycholog.result.store', $psycholog->uuid) }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="fitur-field">
                                @forelse ($psycholog->psychological_test_results as $key => $result)
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div class="mb-1">
                                                <label class="form-label">Poin Minimum</label>
                                                <input class="form-control" type="number" name="minimum[]"
                                                    placeholder="Poin Minimum" class="input-mini form-control"
                                                    value="{{ $result->poin_minimum }}" />
                                            </div>
                                        </div>

                                        <div class="col-xl-2">
                                            <div class="mb-1">
                                                <label class="form-label">Poin Maksimum</label>
                                                <input class="form-control" type="number" name="maksimum[]"
                                                    placeholder="Poin Maksimum" class="input-mini form-control" value="{{ $result->poin_maksimum }}"/>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-1">
                                                <label class="form-label">Keterangan</label>
                                                <input class="form-control" type="text" name="keterangan[]"
                                                    placeholder="Keterangan" class="input-mini form-control" value="{{ $result->keterangan }}"/>
                                            </div>
                                        </div>
                                        <div class="col-xl-2">
                                            <div class="mb-1">
                                                <label class="form-label">Aksi</label><br>
                                                @if ($key == 0)
                                                    <button type="button" id="add_btn"
                                                        class="btn btn-success waves-effect waves-light"><i
                                                            class="mdi mdi-plus me-1"></i>Tambah</button>
                                                @else
                                                    <button type="button" id="remove_btn"
                                                        class="btn btn-danger waves-effect waves-light"><i
                                                            class="mdi mdi-trash-can-outline me-1"></i>Hapus</button>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                @empty
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <div class="mb-1">
                                                <label class="form-label">Poin Minimum</label>
                                                <input class="form-control" type="number" name="minimum[]"
                                                    placeholder="Poin Minimum" class="input-mini form-control" />
                                            </div>
                                        </div>

                                        <div class="col-xl-2">
                                            <div class="mb-1">
                                                <label class="form-label">Poin Maksimum</label>
                                                <input class="form-control" type="number" name="maksimum[]"
                                                    placeholder="Poin Maksimum" class="input-mini form-control" />
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="mb-1">
                                                <label class="form-label">Keterangan</label>
                                                <input class="form-control" type="text" name="keterangan[]"
                                                    placeholder="Keterangan" class="input-mini form-control" />
                                            </div>
                                        </div>
                                        <div class="col-xl-2">
                                            <div class="mb-1">
                                                <label class="form-label">Aksi</label><br>
                                                <button type="button" id="add_btn"
                                                    class="btn btn-success waves-effect waves-light"><i
                                                        class="mdi mdi-plus me-1"></i>Tambah</button>
                                            </div>
                                        </div>

                                    </div>
                                @endforelse
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-info waves-effect waves-light mb-1 me-1">Submit
                                        Hasil Tes</button>
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
@push('js')
    <script>
        $(document).on('click', '#add_btn', function() {
            var html = '<div class="row">';
            html += '<div class="col-xl-2">';
            html += '<div class="mb-1">';
            html += '<label class="form-label">Poin Minimum</label>';
            html +=
                '<input class="form-control" type="number" name="minimum[]" placeholder="Poin Minimum" class="input-mini form-control"/>';
            html += '</div>';
            html += '</div>';
            // =========================================
            html += '<div class="col-xl-2">';
            html += '<div class="mb-1">';
            html += '<label class="form-label">Poin Maksimum</label>';
            html +=
                '<input class="form-control" type="number" name="maksimum[]" placeholder="Poin Maksimum" class="input-mini form-control"/>';
            html += '</div>';
            html += '</div>';
            // =========================================
            html += '<div class="col-xl-6">';
            html += '<div class="mb-1">';
            html += '<label class="form-label">Keterangan</label>';
            html +=
                '<input class="form-control" type="text" name="keterangan[]" placeholder="Keterangan" class="input-mini form-control"/>';
            html += '</div>';
            html += '</div>';
            // =========================================
            html += '<div class="col-xl-2">';
            html += '<div class="mb-1">';
            html += '<label class="form-label">Aksi</label><br>';
            html +=
                '<button type="button" id="remove_btn" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-trash-can-outline me-1"></i>Hapus</button>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            // =========================================

            $('.fitur-field').append(html);
        });
        $(document).on('click', '#remove_btn', function() {
            $(this).closest('.row').remove();
        });
    </script>
@endpush
