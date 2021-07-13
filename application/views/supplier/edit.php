<form action="#" id="form" class="form-horizontal">
	<input type="hidden" name="id_supplier" value="<?php echo $detail->id_supplier; ?>">
    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-12">Nama Supplier</label>
            <div class="col-md-12">
                <input name="nama" id="nama" placeholder="Isi Nama Supplier ..." class="form-control" type="text" value="<?php echo $detail->nama; ?>">
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-12">Alamat Supplier</label>
            <div class="col-md-12">
                <input name="alamat" id="alamat" placeholder="Isi Alamat Supplier ..." class="form-control" type="text" value="<?php echo $detail->alamat; ?>">
                <span class="help-block"></span>
            </div>
        </div>
        
         <div class="form-group">
            <label class="control-label col-md-12">Telp Supplier</label>
            <div class="col-md-12">
                <input name="telp" id="telp" placeholder="Isi Telp Supplier ..." class="form-control" type="text" value="<?php echo $detail->telp; ?>">
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
            url: "<?php echo site_url('supplier/update')?>",
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