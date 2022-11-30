@extends('layouts.app')

@section('title', 'Jenis Tes Psikologi')
@section('page', 'Pertanyaan Tes Psikologi')
@section('content')
<div class="container-fluid">
    @include('partials.alert')
    <div class="row">
        <div class="col-lg-12">
            <div class="conversation-list-card card">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <h5 class="mt-0 mb-1 text-truncate">{{ $psycholog }}</h5>
                        </div>
                        <a href="{{ route('admin.psycholog.question.create', $psycholog_id) }}" class="btn btn-success btn-sm px-1 py-0 waves-effect waves-light"><i class="mdi mdi-plus me-1"></i>Tambah Soal</a>
                    </div>
                    <hr class="my-1">
                    <div>
                        <ol class="conversation-list slimscroll" type="1" style="max-height: 70vh;" data-simplebar>
                            @forelse ($questions as $question)
                                <li>
                                    {{ $question->soal }}
                                    <p class="fw-bold text-dark">Jawaban</p>
                                    @foreach ($question->answers as $answer)
                                    <div class="form-check form-check-success">
                                        <input type="radio" name="{{ $question->uuid }}" id="{{ $answer->uuid }}" value="{{ $answer->uuid }}"
                                                class="form-check-input">
                                        <label for="{{ $answer->uuid }}" class="form-label">
                                            {{ $answer->jawaban }} <strong>({{ $answer->poin }} Poin)</strong>
                                        </label>
                                    </div>
                                    @endforeach
                                    <a href="{{ route('admin.psycholog.question.edit', [$psycholog_id, $question->uuid]) }}" class="btn btn-warning btn-sm px-1 py-0 waves-effect waves-light"><i class="mdi mdi-pencil me-1"></i>Edit</a>
                                    <form action="{{ route('admin.psycholog.question.destroy', [$psycholog_id, $question->uuid]) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm px-1 py-0 waves-effect waves-light"><i class="mdi mdi-pencil me-1"></i>Hapus</button>
                                    </form>
                                </li>
                                <hr>
                            @empty
                                <li class="text-center">
                                    <h3>Tidak ada pertanyaan untuk {{ $psycholog }}!</h3>
                                </li>
                            @endforelse
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    
</div>
@endsection