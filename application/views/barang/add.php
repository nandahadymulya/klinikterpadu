<form action="#" id="form" class="form-horizontal">
    <div class="form-body">
        <div class="form-group">
            <label class="control-label col-md-12">Nama Barang</label>
            <div class="col-md-12">
                <input name="nama_barang" id="nama_barang" placeholder="Isi Nama Barang ..." class="form-control" type="text">
                <span class="help-block"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-12">Satuan Barang</label>
            <div class="col-md-12">
                <input name="satuan_barang" id="satuan_barang" placeholder="Isi Satuan Barang ..." class="form-control" type="text">
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
                url: "<?php echo site_url("barang/save"); ?>",
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