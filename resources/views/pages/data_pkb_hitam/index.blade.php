@extends('layouts.app')

@section('title', 'Data PKB')

@section('title-widget')
<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-file-pdf fa-sm text-white-50 mr-2"></i>
    Data PKB
</a>
@endsection

@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data PKB</h6>
    </div>
    <div class="card-body">
        <button class="btn btn-outline-primary btn-sm" title="Tambah Data" data-toggle="modal"
            data-target="#modalContainer" data-title="Tambah Data" href="{{ route('data_pkb_hitam.create') }}"><i
                class="fa fa-plus fa-fw"></i>
            Tambah
            Data</button>
        <button class="btn btn-primary btn-sm" title="Import Data" data-toggle="modal" data-target="#modalContainer"
            data-title="Import Data" href="{{ route('data_pkb_hitam.upload') }}"><i class="fa fa-upload fa-fw"></i>
            Import
            Data</button>
        <form id="search-form" class="form-inline mt-5">
            <div class="form-group mr-2">
                <select name="status_kendaraan" class="form-control">
                    <option selected="" value="Semua">-- Semua Status --</option>
                    @foreach ($status_kendaraan as $status)
                    <option value="{{ $status->status_kendaraan }}">{{ $status->status_kendaraan }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-filter fa-fw"></i> Filter</button>
        </form>
        <div class="table-responsive mt-3">
            <table id="data_pkb_hitamTable" class="table table-sm table-bordered table-hover" width="100%"
                cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th>#</th>
                        <th>Nomor Polisi</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jenis Kendaraan</th>
                        <th>Merk Kendaraan</th>
                        <th>Mesin Kendaraan</th>
                        <th>Status Kendaraan</th>
                        <th>Nomor Handphone</th>
                        <th>Pokok PKB</th>
                        <th>Denda PKB</th>
                        <th>Akhir PKB</th>
                        <th>Akhir STNK</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modalContainer" data-backdrop="static" data-keyboard="false" role="dialog"
    aria-labelledby="modalContainer" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Title</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-white">
                ...
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    tableDokumen = $('#data_pkb_hitamTable').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: { 
            url: '{!! route('data_pkb_hitam.index') !!}',
            data: function (d) {
                d.status_kendaraan = $('select[name=status_kendaraan]').val();
            }
        },
        columns: [
            { data: 'action', name: 'action', className: 'text-nowrap text-center', width: '1%', orderable: false, searchable: false },
            { data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', width: '1%' , searchable: false, orderable: false},
            { data: 'no_pol', name: 'no_pol' },
            { data: 'nama', name: 'nama' },
            { data: 'alamat', name: 'alamat' },
            { data: 'jenis_kendaraan', name: 'jenis_kendaraan' },
            { data: 'merk_kendaraan', name: 'merk_kendaraan' },
            { data: 'mesin_kendaraan', name: 'mesin_kendaraan' },
            { data: 'status_kendaraan', name: 'status_kendaraan' },
            { data: 'no_hp', name: 'no_hp' },
            { data: 'nilai_pokok_pkb', name: 'nilai_pokok_pkb', render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { data: 'nilai_denda_pkb', name: 'nilai_denda_pkb', render: $.fn.dataTable.render.number('.', ',', 0, '') },
            { data: 'tgl_akhir_pkb', name: 'tgl_akhir_pkb' },
            { data: 'tgl_akhir_stnk', name: 'tgl_akhir_stnk' },
        ],
    });
    $('#search-form').on('submit', function(e) {
        tableDokumen.draw();
        e.preventDefault();
    });
</script>
@endpush