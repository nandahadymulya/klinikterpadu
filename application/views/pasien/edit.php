<form action="#" id="form" class="form-horizontal">
	<input type="hidden" name="kode_barang" value="<?php echo $detail->kode_barang; ?>">
    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-12">Nama Barang</label>
            <div class="col-md-12">
                <input name="nama_barang" id="nama_barang" placeholder="Isi Nama Barang ..." class="form-control" type="text" value="<?php echo $detail->nama; ?>">
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-12">Satuan Barang</label>
            <div class="col-md-12">
                <input name="satuan_barang" id="satuan_barang" placeholder="Isi Satuan Barang ..." class="form-control" type="text" value="<?php echo $detail->satuan; ?>">
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
            url: "<?php echo site_url('barang/update')?>",
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