<form action="#" id="form" class="form-horizontal">
    <input type="hidden" name="id_petugas" value="<?= $detail->id_petugas; ?>">
    <div class="form-body">
        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Nama Petugas</label>
            <div class="col-md-12">
                <input name="nama_petugas" id="nama_petugas" placeholder="Isi Nama Petugas ..." class="form-control" type="text" value="<?= $detail->nama_petugas; ?>">
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Tanggal Lahir</label>
            <div class="col-md-12">
                <input name="tanggal_lahir" id="tanggal_lahir" placeholder="Isi Tanggal Lahir Petugas ..." class="form-control" type="date" value="<?= $detail->tanggal_lahir; ?>">
                <span class="help-block"></span>
            </div>
        </div>

         <div class="form-group p-md-2">
            <label class="control-label col-md-12">Alamat Petugas</label>
            <div class="col-md-12">
                <input name="alamat_petugas" id="alamat_petugas" placeholder="Isi Alamat Petugas ..." class="form-control" type="text" value="<?= $detail->alamat_petugas; ?>">
                <span class="help-block"></span>
            </div>
        </div>
        
        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Nohp</label>
            <div class="col-md-12">
                <input name="nohp" id="nohp" placeholder="Isi Nohp Petugas ..." class="form-control" type="text"  value="<?= $detail->nohp; ?>">
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
            url: "<?= site_url('petugas/update')?>",
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