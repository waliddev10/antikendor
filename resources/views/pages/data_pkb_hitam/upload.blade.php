<form action="{{ route('data_pkb_hitam.import') }}" accept-charset="UTF-8" class="form needs-validation" id="createForm"
    autocomplete="off">
    @csrf
    <div class="alert alert-warning" role="alert">
        Download form input berikut. Isi sesuai dengan template yang ada.
        <br />
        <a href="{{ asset('form/Form-input-data-kendaraan.xlsx') }}" class="btn btn-sm btn-info"><i
                class="fa fa-download"></i>
            Download Form</a>
    </div>
    <div class="form-group">
        <label class="font-weight-semibold">Upload Berkas</label>
        <input type="file" name="file" class="form-control"
            accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
    </div>

    <div class="form-group row text-right">
        <div class="col-12">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Import</button>
        </div>
    </div>

</form>

<script type="text/javascript">
    $("#createForm").on('submit', function(event) {
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
                }else{
                    showAlert(response.message, 'warning')
                }
            }
        });
        return false;
    });
</script>