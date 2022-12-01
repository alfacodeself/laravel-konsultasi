@extends('layouts.app')

@section('title', 'Hasil Tes Psikologi')
@section('page', 'Tes Psikologi')
@section('content')
    <div class="container-fluid">
        @include('partials.alert')
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mt-0 mb-3">Hasil Tes Psikologi Anda</h4>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Jenis Tes Psikolog</th>
                                        <th>Mengikuti Atas Nama</th>
                                        <th>Tanggal Tes</th>
                                        <th>Hasil</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($psycholog_users as $pu)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pu->psycholog->judul }}</td>
                                            <td class="text-capitalize">{{ $pu->user->nama }}</td>
                                            <td>{{ $pu->created_at->format('Y-m-d H:i:s') }}</td>
                                            <td>
                                                @if ($pu->status == 'belum lunas')
                                                    <a href="{{ route('user.psycholog.checkout', [$pu->psycholog->uuid, $pu->uuid]) }}"
                                                        class="btn btn-outline-danger btn-sm py-0"><i
                                                            class="mdi mdi-lock-remove me-1"></i>Buka Hasil</a>
                                                @else
                                                    {{ $pu->nilai }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($pu->status == 'belum lunas')
                                                    -
                                                @else
                                                    <button 
                                                        type="button"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#show-modal"
                                                        class="btn btn-outline-info btn-sm py-0"
                                                        data-nama="{{ $pu->user->nama }}"
                                                        data-psycholog="{{ $pu->psycholog->judul }}"
                                                        data-poin="{{ $pu->nilai }}"
                                                        data-date="{{ $pu->created_at->format('Y-m-d H:i:s') }}"
                                                        data-result="{{ $pu->result }}">
                                                        <i class="mdi mdi-eye me-1"></i>
                                                        Detail
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- =====================> MODAL <==================== --}}
    <div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-top">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title" id="myCenterModalLabel">Hasil Tes Psikolog Anda</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <h3>Poin anda adalah <span class="modal-poin"></span></h3>
                    <span>Menurut hasil tes psikolog dari <strong class="modal-psycholog"></strong> yang saudara <strong class="modal-nama text-capitalize"></strong> ikuti pada tanggal <strong class="modal-date"></strong> menunjukkan hasil bahwa <strong class="modal-result"></strong>.</span>
                </div>
                <div class="modal-footer">
                    <small class="modal-psycholog"></small>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('#show-modal').on('show.bs.modal', function(e) {
            const button = $(e.relatedTarget);

            let nama = button.data('nama');
            let psycholog = button.data('psycholog');
            let date = button.data('date');
            let poin = button.data('poin');
            let result = button.data('result');

            let modal = $(this);
            modal.find('.modal-nama').text(nama);
            modal.find('.modal-psycholog').text(psycholog);
            modal.find('.modal-date').text(date);
            modal.find('.modal-poin').text(poin);
            modal.find('.modal-result').text(result);
        })
    </script>
@endpush
