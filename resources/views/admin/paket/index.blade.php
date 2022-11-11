@extends('layouts.app')

@section('title', 'Paket Konseling')
@section('page', 'Data Paket Konseling')
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-md-4">
                                <div class="mt-3 mt-md-0">
                                    <button type="button" class="btn btn-success waves-effect waves-light"
                                        data-bs-toggle="modal" data-bs-target="#add-modal"><i
                                            class="mdi mdi-plus-circle me-1"></i> Buat Paket Konseling</button>
                                </div>
                            </div><!-- end col-->
                            <div class="col-md-8">
                                <form class="d-flex flex-wrap align-items-center justify-content-sm-end">
                                    <label for="inputPassword2" class="visually-hidden">Search</label>
                                    <div>
                                        <input type="search" class="form-control my-1 my-md-0" id="inputPassword2"
                                            placeholder="Search...">
                                    </div>
                                </form>
                            </div>
                        </div> <!-- end row -->
                    </div>
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row -->
        <div class="row">
            @forelse ($pricings as $paket)
                <div class="col-xl-3 bg-white shadow p-3 rounded">
                    {{-- <div class="card" style=""> --}}
                        {{-- <div class="text-center card-body"> --}}
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical text-dark"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <button 
                                        type="button" 
                                        class="dropdown-item" 
                                        data-bs-toggle="modal"
                                        data-bs-target="#edit-modal"
                                        data-nama="{{ $paket->nama_paket }}"
                                        data-sesi="{{ $paket->sesi }}"
                                        data-harga="{{ $paket->harga_paket }}"
                                        data-route="{{ route('admin.pricing.update', $paket->uuid) }}"
                                        data-fitur="{{ implode('|', $paket->fitur_paket) }}">Edit Paket</button>
                                    <form action="{{ route('admin.pricing.destroy', $paket->uuid) }}" class="d-inline" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="dropdown-item">{{ $paket->status == 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}</button>
                                    </form>
                                </div>
                            </div>

                            <div>
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
                                    @foreach ($paket->fitur_paket as $paket)
                                    <p class="text-muted font-13 text-dark">
                                        <span class="ms-2">
                                            {{ $paket }}
                                        </span>
                                    </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-xl-12">
                    <div class="card" style="height: 70vh">
                        <h3 class="text-center mt-5">Tidah ada data paket sesi!</h3>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel">Buat Paket Sesi Baru</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.pricing.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-2">
                                <label for="nama_paket" class="form-label">Nama Paket</label>
                                <input type="text" class="form-control" id="nama_paket" name="nama_paket"
                                    placeholder="Nama Paket" value="{{ old('nama_paket') }}">
                                @error('nama_paket')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="sesi" class="form-label">Jumlah Sesi</label>
                                <input type="number" class="form-control" id="sesi" name="sesi"
                                    placeholder="Jumlah Sesi" value="{{ old('sesi') }}">
                                @error('sesi')
                                    <small class="text-danger">{{ $message }}</small>
                                @else
                                    <small class="text-info">Satu sesi adalah 60 menit!</small>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="harga_paket" class="form-label">Harga Paket (Rp)</label>
                                <input type="number" class="form-control" id="harga_paket" name="harga_paket"
                                    placeholder="Harga Paket" value="{{ old('harga') }}">
                                @error('harga')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="fitur" class="form-label">Fitur</label>
                                <br>
                                <table class="fitur-field">
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light"
                                data-bs-dismiss="modal">Tutup</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel">Edit Paket Sesi</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="modal-route" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-2">
                                <label for="nama_paket" class="form-label">Nama Paket</label>
                                <input type="text" class="form-control modal-nama" id="nama_paket" name="nama_paket"
                                    placeholder="Nama Paket" value="{{ old('nama_paket') }}">
                                @error('nama_paket')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="sesi" class="form-label">Jumlah Sesi</label>
                                <input type="number" class="form-control modal-sesi" id="sesi" name="sesi"
                                    placeholder="Jumlah Sesi" value="{{ old('sesi') }}">
                                @error('sesi')
                                    <small class="text-danger">{{ $message }}</small>
                                @else
                                    <small class="text-info">Satu sesi adalah 60 menit!</small>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="harga_paket" class="form-label">Harga Paket (Rp)</label>
                                <input type="number" class="form-control modal-harga" id="harga_paket" name="harga_paket"
                                    placeholder="Harga Paket" value="{{ old('harga') }}">
                                @error('harga')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="fitur" class="form-label">Fitur</label>
                                <br>
                                <table class="fitur-field">
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Ubah Paket</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light"
                                data-bs-dismiss="modal">Tutup</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        // ==================> Tambah Script <================
        $('#add-modal').on('show.bs.modal', function(event) {
            $('.fitur-field').empty();
            var html = '';
            html += '<tr>';
            html += '<td width="100%"><input type="text" class="form-control" name="fitur[]"></td>';
            html +=
                '<td><button class="btn btn-info waves-effect waves-light" type="button" id="add_btn"><i class="mdi mdi-plus-box"></i></button></td>';
            html += '</tr>';
            $('.fitur-field').html(html);
        });
        $(document).on('click', '#add_btn', function() {
            var html = '';
            html += '<tr>';
            html += '<td width="100%"><input type="text" class="form-control" name="fitur[]"></td>';
            html +=
                '<td><button class="btn btn-danger" type="button" id="remove_btn"><i class="ti-trash"></i></button></td>';
            html += '</tr>';
            $('.fitur-field').append(html)
        });
        $(document).on('click', '#remove_btn', function() {
            $(this).closest('tr').remove();
        });
        // ========================> Edit Script <=======================
        $(document).on('click', '#add_btn_edit', function() {
            var html = '';
            html += '<tr>';
            html += '<td width="100%"><input type="text" class="form-control" name="fitur[]"></td>';
            html +=
                '<td><button class="btn btn-danger" type="button" id="remove_btn"><i class="ti-trash"></i></button></td>';
                html += '</tr>';
                $('.fitur-field').append(html)
            });
        $(document).on('click', '#remove_btn_edit', function() {
            $(this).closest('tr').remove();
        });
        $('#edit-modal').on('show.bs.modal', function(e) {
            const button = $(e.relatedTarget);

            let nama = button.data('nama');
            let sesi = button.data('sesi');
            let harga = button.data('harga');
            let route = button.data('route');
            let fitur = button.data('fitur').split('|');

            let modal = $(this);
            modal.find('.modal-nama').val(nama);
            modal.find('.modal-sesi').val(sesi);
            modal.find('.modal-route').attr('action', route);
            modal.find('.modal-harga').val(harga);
            modal.find('.modal-title').text('Edit ' + nama);
            var html = '';
            fitur.forEach((e, k) => {
                if (k == 0) {
                    html += '<tr>';
                        html += '<td width="100%"><input type="text" class="form-control" name="fitur[]" value="'+e+'"></td>';
                        html += '<td><button class="btn btn-info" type="button" id="add_btn_edit"><i class="ti-plus"></i></button></td>';
                        html += '</tr>';
                }else {
                    html += '<tr>';
                    html += '<td width="100%"><input type="text" class="form-control" name="fitur[]" value="'+e+'"></td>';
                    html += '<td><button class="btn btn-danger" type="button" id="remove_btn_edit"><i class="ti-trash"></i></button></td>';
                    html += '</tr>';
                }
            });
            // console.log(html);
            $('.fitur-field').html(html)
        })
    </script>
@endpush
