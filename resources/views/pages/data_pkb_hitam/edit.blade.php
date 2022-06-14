<form action="{{ route('data_pkb_hitam.update', $item->id) }}" accept-charset="UTF-8" class="form needs-validation"
    id="editForm" autocomplete="off">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col">
            <div class="form-group">
                <label class="font-weight-semibold">No. Polisi</label>
                <input value="{{ $item->no_pol }}" type="text" name="no_pol" class="form-control" />
            </div>
            <div class="form-group">
                <label class="font-weight-semibold">Nama</label>
                <input value="{{ $item->nama }}" type="text" name="nama" class="form-control" />
            </div>
            <div class="form-group">
                <label class="font-weight-semibold">Alamat</label>
                <textarea name="alamat" class="form-control">{{ $item->alamat }}</textarea>
            </div>
            <div class="form-group">
                <label class="font-weight-semibold">Jenis Kendaraan</label>
                <input value="{{ $item->jenis_kendaraan }}" type="text" name="jenis_kendaraan" class="form-control" />
            </div>
            <div class="form-group">
                <label class="font-weight-semibold">Merk Kendaraan</label>
                <input value="{{ $item->merk_kendaraan }}" type="text" name="merk_kendaraan" class="form-control" />
            </div>
            <div class="form-group">
                <label class="font-weight-semibold">Mesin Kendaraan</label>
                <input value="{{ $item->mesin_kendaraan }}" type="text" name="mesin_kendaraan" class="form-control" />
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="font-weight-semibold">Status</label>
                <input value="{{ $item->status_kendaraan }}" type="text" name="status_kendaraan" class="form-control" />
            </div>
            <div class="form-group">
                <label class="font-weight-semibold">No. Handphone</label>
                <input value="{{ $item->no_hp }}" type="text" name="no_hp" class="form-control" />
            </div>
            <div class="form-group">
                <label class="font-weight-semibold">Pokok PKB</label>
                <input value="{{ $item->nilai_pokok_pkb }}" type="number" name="nilai_pokok_pkb" class="form-control" />
            </div>
            <div class="form-group">
                <label class="font-weight-semibold">Denda PKB</label>
                <input value="{{ $item->nilai_denda_pkb }}" type="number" name="nilai_denda_pkb" class="form-control" />
            </div>
            <div class="form-group">
                <label class="font-weight-semibold">Akhir PKB</label>
                <input value="{{ $item->tgl_akhir_pkb }}" type="date" name="tgl_akhir_pkb" class="form-control" />
            </div>
            <div class="form-group">
                <label class="font-weight-semibold">Akhir STNK</label>
                <input value="{{ $item->tgl_akhir_stnk }}" type="date" name="tgl_akhir_stnk" class="form-control" />
            </div>
        </div>
    </div>

    <div class="form-group row text-right">
        <div class="col-12">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        </div>
    </div>

</form>

<script type="text/javascript">
    $("#editForm").on('submit', function(event) {
        event.preventDefault();
        var form = $(this);
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.status == 'success')
                {
                    $("#modalContainer").modal('hide');
                    tableDokumen.ajax.reload(null, false);
                    showAlert(response.message, 'success')
                } else {
                    showAlert(response.message, 'warning')
                }
            }
        });
        return false;
    });
</script>