<form action="#" id="form" class="form-horizontal">
    <div class="form-body">
        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Nama Pasien</label>
            <div class="col-md-12">
                <input name="nama" id="nama" placeholder="Isi Nama Pasien ..." class="form-control" type="text">
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Alamat Pasien</label>
            <div class="col-md-12">
                <input name="alamat" id="alamat" placeholder="Isi Alamat Pasien ..." class="form-control" type="text">
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Penyakit Pasien</label>
            <div class="col-md-12">
                <input name="penyakit" id="penyakit" placeholder="Isi Penyakit Pasien ..." class="form-control" type="text">
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Jenis Rawat Pasien</label>
            <div class="col-md-12">
                <!-- <select name="jenis_rawat" id="jenis_rawat" class="form-control">Pilih
                    <option value="Inap">Rawat Inap</option>
                    <option value="Jalan">Rawat Jalan</option>
                </select> -->
                
                <input name="jenis_rawat" id="jenis_rawat" placeholder="Isi Jenis Rawat Pasien ..." class="form-control" type="text">
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Status BPJS Pasien</label>
            <div class="col-md-12">
                 <!-- <select name="status_bpjs" id="status_bpjs" class="form-control">Pilih
                    <option value="1">Pasien BPJS</option>
                    <option value="0">Pasein Non BPJS</option>
                </select> -->
                <input name="status_bpjs" id="status_bpjs" placeholder="Isi Status BPJS Pasien ..." class="form-control" type="text">
                <span class="help-block"></span>
            </div>
        </div>

        <hr/>
        <button type="button" class="btn btn-primary" name="btnSave" id="btnSave" onclick="save()" >Simpan</button>
    </div>
</form>

<script type="text/javascript">
    $("input").change(function(){
        $(this).parent().parent().removeClass('text-danger');
        $(this).next().empty();
    });
    
    function save()
    {
        $('#btnSave').text('Proses Penyimpanan...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var data = $('#form').serialize();
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url("pasien/save"); ?>",
                data: data,
                dataType: 'json',
                cache: false,
                success: function(data) {
                    if (data.status) 
                    {
                        $('#modalForm').modal("hide");
                        data_table.ajax.reload();
                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('text-danger'); 
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); 
                        }
                    }
                    $('#btnSave').text('Simpan'); 
                    $('#btnSave').attr('disabled', false); 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error Proses Penyimpanan Data');
                    $('#btnSave').text('Simpan'); 
                    $('#btnSave').attr('disabled',false); 
                }
            });
    }
</script>