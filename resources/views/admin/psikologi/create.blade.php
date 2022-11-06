@extends('layouts.app')

@section('title', 'Tes Psikologi')
@section('page', 'Buat Tes Psikologi')
@section('content')
<div class="container-fluid">
    @include('partials.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.psycholog.question.store', $psycholog_id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <div class="controls">
                                        <label class="form-label">Pertanyaan</label>
                                        <textarea class="input-large form-control" name="pertanyaan" id="message1" rows="12" placeholder="Tulis Pertanyaan ..."></textarea>
                                        @error('pertanyaan')
                                            <small class="text-danger fw-bold">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
    
                            <div class="col-xl-6">
                                <div class="mb-1">
                                    <label class="form-label">Jawaban / Poin</label>
                                    <div class="row fitur-field">
                                        <div class="col-md-8">
                                            <input class="form-control" type="text" name="jawaban[]" placeholder="Jawaban" class="input-mini form-control"/>
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <input class="form-control" type="number" name="poin[]" placeholder="Poin" class="input-mini form-control"/>
                                            
                                        </div>
                                    </div>
                                    @error('jawaban')
                                        <small class="text-danger fw-bold">{{ $message }}</small>
                                    @enderror
                                    @error('poin')
                                        <small class="text-danger fw-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="button" id="add_btn" class="btn btn-success btn-sm waves-effect waves-light"><i class="mdi mdi-plus me-1"></i>Tambah Kolom Jawaban</button>
                                <button type="button" id="remove_btn" class="btn btn-danger btn-sm waves-effect waves-light"><i class="mdi mdi-trash-can-outline me-1"></i>Reset Kolom Jawaban</button>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-info waves-effect waves-light mb-1 me-1">Submit Pertanyaan</button>
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
        $(document).on('click', '#add_btn', function(){
            var html = '<div class="col-md-8 mt-1">';
                html += '<input class="form-control" type="text" name="jawaban[]" placeholder="Jawaban" class="input-mini form-control"/>';
                html += '</div>';
                html += '<div class="col-md-4 mt-1">';
                html += '<input class="form-control" type="number" name="poin[]" placeholder="Poin" class="input-mini form-control"/>';
                html += '</div>';
            $('.fitur-field').append(html);
        });
        $(document).on('click', '#remove_btn', function(){
            $('.fitur-field').empty();
            var html = '<div class="col-md-8">';
                html += '<input class="form-control" type="text" name="jawaban[]" placeholder="Jawaban" class="input-mini form-control"/>';
                html += '</div>';
                html += '<div class="col-md-4">';
                html += '<input class="form-control" type="number" name="jawaban[]" placeholder="Poin" class="input-mini form-control"/>';
                html += '</div>';
            $('.fitur-field').html(html);
        });
    </script>
@endpush