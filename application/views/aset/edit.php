<form action="#" id="form" class="form-horizontal">
    <input type="hidden" name="kd_aset" value="<?= $detail->kd_aset; ?>">
    <div class="form-body">
        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Nama Aset</label>
            <div class="col-md-12">
                <input name="nama_aset" id="nama_aset" placeholder="Isi Nama Aset ..." class="form-control" type="text" value="<?= $detail->nama_aset; ?>">
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group p-md-2">
            <label class="control-label col-md-12">Tanggal Beli</label>
            <div class="col-md-12">
                <input name="tanggal_beli" id="tanggal_beli" placeholder="Isi Tanggal Lahir Aset ..." class="form-control" type="date" value="<?= $detail->tanggal_beli; ?>">
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
            url: "<?= site_url('aset/update')?>",
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