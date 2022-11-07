@extends('layouts.app')

@section('title', 'Profil')
@section('page', 'Profil')
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        @include('partials.alert')
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center">Profil</h3>
                    <div class="card-body">
                        <form action="{{ route('admin.pengaturan.profil.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <center>
                                @if (auth('admin')->user()->foto == null)
                                    <p class="text-mute">Belum ada foto</p>
                                @else
                                    <img class="avatar-xl rounded-circle" src="{{ url(auth('admin')->user()->foto) }}">
                                @endif
                            </center>
                            <div class="mb-1">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" name="foto" id="foto" class="form-control">
                                @error('foto')
                                    <small class="text-danger fw-bold">{{ $message }}</small>
                                @else
                                    <small class="text-info fw-bold">Kosongkan jika tidak ingin mengubah foto</small>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    placeholder="Masukkan Nama"
                                    value="{{ old('nama', Auth::guard('admin')->user()->nama) }}">
                                @error('nama')
                                    <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="Masukkan Email"
                                    value="{{ old('email', Auth::guard('admin')->user()->email) }}">
                                @error('email')
                                    <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-info">Ubah Profil</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center">Akun Kredensial</h3>
                    <div class="card-body">
                        <form action="{{ route('admin.pengaturan.profil.account') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="mb-2">
                                <label for="old_password" class="form-label">Password Lama</label>
                                <input type="password" name="old_password" id="old_password" class="form-control"
                                    placeholder="Password lama">
                                @error('old_password')
                                    <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="new_password" class="form-label">Password Baru</label>
                                <input type="password" name="new_password" id="new_password" class="form-control"
                                    placeholder="Password baru">
                                @error('new_password')
                                    <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="new_password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                    class="form-control" placeholder="Konfirmasi passsword baru">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-info">Ganti Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
