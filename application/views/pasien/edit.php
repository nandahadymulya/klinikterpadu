<form action="#" id="form" class="form-horizontal">
    <input type="hidden" name="id_pasien" value="<?= $detail->id_pasien; ?>">
    <div class="form-body">
        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Nama Pasien</label>
            <div class="col-md-12">
                <input name="nama" id="nama" placeholder="Isi Nama Pasien ..." class="form-control" type="text" value="<?= $detail->nama; ?>">
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Alamat Pasien</label>
            <div class="col-md-12">
                <input name="alamat" id="alamat" placeholder="Isi Alamat Pasien ..." class="form-control" type="text" value="<?= $detail->alamat; ?>">
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Tempat Lahir</label>
            <div class="col-md-12">
                <input name="tempat_lahir" id="tempat_lahir" placeholder="Isi Tempat Lahir Pasien ..." class="form-control" type="text" value="<?= $detail->tempat_lahir; ?>">
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Tanggal Lahir</label>
            <div class="col-md-12">
                <input name="tanggal_lahir" id="tanggal_lahir" placeholder="Isi Tanggal Lahir Pasien ..." class="form-control" type="date" value="<?= $detail->tanggal_lahir; ?>">
                <span class="help-block"></span>
            </div>
        </div>
        
        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Nohp</label>
            <div class="col-md-12">
                <input name="nohp" id="nohp" placeholder="Isi Nohp Pasien ..." class="form-control" type="text"  value="<?= $detail->nohp; ?>">
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Jenis Rawat Pasien</label>
            <div class="col-md-12">
                <select name="jenis_rawat" id="jenis_rawat" class="form-control">
                    <option value="<?= $detail->jenis_rawat; ?>"><?= $detail->jenis_rawat; ?></option>
                    <option value="Rawat Inap">Rawat Inap</option>
                    <option value="Rawat Jalan">Rawat Jalan</option>
                </select>
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Status BPJS Pasien</label>
            <div class="col-md-12">
                <select name="status_bpjs" id="status_bpjs" class="form-control">Pilih
                    <option value="<?= $detail->status_bpjs; ?>"><?= $detail->status_bpjs; ?></option>
                    <option value="BPJS">Pasien BPJS</option>
                    <option value="Non BPJS">Pasien Non BPJS</option>
                </select>
                <span class="help-block"></span>
            </div>
        </div>

         <hr/>
        <button type="button" class="btn btn-primary" name="btnSave" id="btnSave" onclick="update()" >Simpan</button>
    </div>
</form>

<script type="text/javascript">

	$("input").change(function(){
        $(this).parent().parent().removeClass('text-danger');
        $(this).next().empty();
    });
    
	function update()
	{
		$('#btnSave').text('Proses Penyimpanan...'); 
        $('#btnSave').attr('disabled',true);
        var data = $('#form').serialize();
        $.ajax({
            url: "<?= site_url('pasien/update')?>",
            type: "POST",
            data: data,
            dataType:"JSON",
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