@extends('layouts.app')

@section('title', 'Jenis Tes Psikologi')
@section('page', 'Tes Psikologi')
@section('content')
<div class="container-fluid">
    @include('partials.alert')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-md-4">
                            <div class="mt-3 mt-md-0">
                                <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add-modal"><i class="mdi mdi-plus-circle me-1"></i> Buat Tes Psikolog</button>
                            </div>
                        </div><!-- end col-->
                        <div class="col-md-8">
                            <form class="d-flex flex-wrap align-items-center justify-content-sm-end">
                                <label for="inputPassword2" class="visually-hidden">Search</label>
                                <div>
                                    <input type="search" class="form-control my-1 my-md-0" id="inputPassword2" placeholder="Search...">
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
        @forelse ($psychologs as $psycholog)
        <div class="col-xl-4">
            <div class="card" style="height: 35rem">
                <div class="text-center card-body">
                    <div class="dropdown float-end">
                        <a href="#" class="dropdown-toggle arrow-none card-drop"  data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-dots-vertical"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <button 
                                type="button" 
                                class="dropdown-item" 
                                data-bs-toggle="modal" 
                                data-bs-target="#edit-modal"
                                data-judul="{{ $psycholog->judul }}"
                                data-deskripsi="{{ $psycholog->deskripsi }}"
                                data-harga="{{ $psycholog->harga }}"
                                data-route="{{ route('admin.psycholog.update', $psycholog->uuid) }}"
                                >Edit</button> 
                            <form action="{{ route('admin.psycholog.status', $psycholog->uuid) }}" class="d-inline" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="dropdown-item">{{ $psycholog->status == 'nonaktif' ? 'Aktifkan' : 'Nonaktifkan' }}</button>
                            </form>
                        </div>
                    </div>
                    
                    <div>
                        <img src="{{ url($psycholog->gambar) }}" class="mb-1" style="width: 100%; height: 200px;" alt="profile-image">
                        <h4 class="card-title">{{ $psycholog->judul }}</h4>
                        <p class="text-muted font-13">
                            {{ Str::limit($psycholog->deskripsi, 50, '.....') }}
                        </p>
                        <div class="text-start text-capitalize">
                            <p class="text-muted font-13 text-dark"><strong>Soal :</strong> <span class="ms-2">{{ $psycholog->questions_count }} Soal</span></p>

                            <p class="text-muted font-13 text-dark"><strong>Diikuti :</strong><span class="ms-2">{{ $psycholog->psycholog_users_count }} Orang</span></p>
                            <p class="text-muted font-13 text-dark"><strong>Status :</strong><span class="ms-2">{{ $psycholog->status }}</span></p>
                            <p class="text-muted font-13 text-dark"><strong>Harga :</strong><span class="ms-2">{{ 'Rp.' . number_format($psycholog->harga) }}</span></p>
                        </div>
                        <a href="{{ route('admin.psycholog.question.index', $psycholog->uuid) }}" class="btn btn-warning rounded-pill waves-effect waves-light">Lihat Tes Psikolog</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <div class="col-xl-12">
                <div class="card" style="height: 70vh">
                    <h3 class="text-center mt-5">Tidah ada data tes psikolog!</h3>
                </div>
            </div>
        @endforelse
    </div>

    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title" id="myCenterModalLabel">Buat Tes Psikologi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.psycholog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="mb-2">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="gambar">
                            @error('gambar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="judul" class="form-label">Nama Tes Psikolog</label>
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="Nama Tes Psikolog" value="{{ old('judul') }}">
                            @error('judul')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="deskripsi" class="form-label">Deskripsi Tes Psikolog</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="5" placeholder="Deskripsi Tes Psikologi">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="harga" class="form-label">Harga (Rp)</label>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga" value="{{ old('harga') }}">
                            @error('harga')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Simpan</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title" id="myCenterModalLabel">Edit Tes Psikologi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="modal-route" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control" id="gambar" name="gambar">
                            <small class="text-primary fw-bold">Kosongkan jika tidak ingin mengubah gambar</small>
                            @error('gambar')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="judul" class="form-label">Nama Tes Psikolog</label>
                            <input type="text" class="form-control modal-judul" id="judul" name="judul" placeholder="Nama Tes Psikolog" value="{{ old('judul') }}">
                            @error('judul')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="deskripsi" class="form-label">Deskripsi Tes Psikolog</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control modal-deskripsi" rows="5" placeholder="Deskripsi Tes Psikologi">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label for="harga" class="form-label">Harga (Rp)</label>
                            <input type="number" class="form-control modal-harga" id="harga" name="harga" placeholder="Harga" value="{{ old('harga') }}">
                            @error('harga')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light" data-bs-dismiss="modal">Tutup</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
@endsection
@push('js')
    <script>
        $('#edit-modal').on('show.bs.modal', function(e){
            const button = $(e.relatedTarget);

            let judul = button.data('judul');
            let deskripsi = button.data('deskripsi');
            let harga = button.data('harga');
            let route = button.data('route');

            let modal = $(this);
            modal.find('.modal-judul').val(judul)
            modal.find('.modal-deskripsi').val(deskripsi)
            modal.find('.modal-harga').val(harga)
            modal.find('.modal-route').attr('action', route)
        })
    </script>
@endpush