@extends('layouts.app')

@section('title', 'Hasil Tes Psikologi')
@section('page', 'Tes Psikologi')
@section('content')
<div class="container-fluid">
    @include('partials.alert')
    <div class="row">
        @forelse ($psychologs as $psycholog)
        <div class="col-xl-4">
            <div class="card">
                <div class="text-center card-body">
                    <div>
                        <img src="{{ url($psycholog->gambar) }}" class="mb-1" style="width: 100%; height: 140px;" alt="profile-image">
                        <h4 class="card-title">{{ $psycholog->judul }}</h4>
                        <p class="text-muted font-13">
                            {{ $psycholog->deskripsi }}
                        </p>
                        <div class="text-start text-capitalize">
                            <p class="text-muted font-13 text-dark">
                                <strong>Diikuti :</strong> 
                                <span class="ms-2">{{ $psycholog->psycholog_users->where('user_id', auth('user')->id())->count() }} Kali
                                </span>
                            </p>
                        </div>
                        <a href="{{ route('user.psycholog.show', $psycholog->uuid) }}" class="btn btn-warning rounded-pill waves-effect waves-light">Lihat Hasil Tes Psikolog</a>
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
</div>
@endsection