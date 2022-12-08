@extends('layouts.app')

@section('title', 'Pasien')
@section('page', 'Data Pasien')
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
                                    <button type="button" class="btn btn-success waves-effect waves-light"
                                        data-bs-toggle="modal" data-bs-target="#add-modal"><i
                                            class="mdi mdi-plus-circle me-1"></i> Tambahkan Data Pasien</button>
                                </div>
                            </div><!-- end col-->
                            <div class="col-md-8">
                                <form class="d-flex flex-wrap align-items-center justify-content-sm-end" method="GET">
                                    <label for="inputPassword2" class="visually-hidden">Search</label>
                                    <div>
                                        <input type="search" class="form-control my-1 my-md-0" name="search" value="{{ old('search', request()->search) }}" placeholder="Search...">
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
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3">Data Pasien</h4>

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Foto</th>
                                        <th>Nama Pasien</th>
                                        <th>Email</th>
                                        <th>Tanggal Mendaftar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pasien as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($user->foto == null)
                                                    No-Pict
                                                @else
                                                    <img src="{{ url($user->foto) }}" class="rounded-circle img-thumbnail avatar-md" alt="Foto Pasien">
                                                @endif
                                            </td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                                            <td>
                                                <button 
                                                    type="button" 
                                                    class="btn btn-warning btn-sm waves-effect waves-light" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#edit-modal" 
                                                    data-route="{{ route('admin.pasien.update', $user->uuid) }}">
                                                    <i class="mdi mdi-account-key me-1"></i> 
                                                    Ganti Password
                                                </button>
                                                <form action="{{ route('admin.pasien.destroy', $user->uuid) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm waves-effect waves-light">
                                                        <i class="mdi mdi-trash-can me-1"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data pasien!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <br>
                            <div class="float-end">
                                {{ $pasien->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel">Tambah Data Pasien</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.pasien.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-2">
                                <label for="foto" class="form-label">Foto Pasien</label>
                                <input type="file" class="form-control" id="foto" name="foto">
                                @error('foto')
                                    <small class="text-danger">{{ $message }}</small>
                                @else
                                    <small class="text-info">*Opsional</small>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="nama" class="form-label">Nama Pasien</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Nama Pasien" value="{{ old('nama') }}">
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="email" class="form-label">Email Pasien</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email Pasien" autocomplete="off" value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                    placeholder="Konfirmasi Password">
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Tambahkan Pasien</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light"
                                data-bs-dismiss="modal">Tutup</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h4 class="modal-title" id="myCenterModalLabel">Ubah Password Pasien</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" class="modal-route" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-2">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                    placeholder="Konfirmasi Password">
                            </div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Ganti Password Pasien</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light"
                                data-bs-dismiss="modal">Tutup</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#edit-modal').on('show.bs.modal', function(e) {
            const button = $(e.relatedTarget);
            let route = button.data('route');

            let modal = $(this);
            modal.find('.modal-route').attr('action', route)
        })
    </script>
@endpush
