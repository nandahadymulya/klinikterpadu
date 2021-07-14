<div class="main pt-4">
	<div class="page-header mb-4">
		<h3 class="header"><?php echo $pageheader; ?></h3>
    	<p class="sub-header">Halaman ini memuat semua data <?= $pageheader; ?>.</p>
	</div>
	<hr/>

	<button type="button" name="add" id="add-form" data-toggle="modal" data-target="#modalForm" class="add btn btn-sm fw-bold btn-success mb-3">
		<i class="fa fa-plus"></i>Tambah Data <?= $pageheader; ?>
	</button>

	<div class="card shadow mb-4">
    	<div class="card-header py-3">
			<h6 class="m-0 fw-bold table-name">Tabel <?= $pageheader; ?> </h6>
		</div>

		<div class="card-body">
			<table id="data_table" class="table table-responsive table-striped table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode Aset</th>
						<th>Nama Aset</th>
						<th>Tanggal Beli</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot>
					<tr>
						<th width="2%">No</th>
						<th>Kode Aset</th>
						<th>Nama Aset</th>
						<th>Tanggal Beli</th>
						<th width="5%">Action</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
	
	<!-- Modal -->
	<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="judul"></h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div id="tampil_modal"></div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(function() {
		$(document).ready(function() {
			data_table = $('#data_table').DataTable({
				"processing": true, 
				"serverSide": true, 
				"language": {
					"processing": '<i class="fa fa-circle-o-notch fa-spin fa-3x"></i><span class="sr-only"> Memuat Data...</span>'
				},
				"searching": true,
				"aLengthMenu": [
					[10, 40, 60, -1],
					[10, 40, 60, "All"]
				],
				"iDisplayLength": 10,
				"order": [],  
				// Load data for the table's content from an Ajax source
				"ajax": {
					"url": "<?php echo site_url('aset/ajax') ?>",
					"type": "POST",
					"data": function(data) {
						null
					},
				},
				"columnDefs": [{
					"targets": [0], 
					"orderable": false, 
					},],
			});
		});
	});

	$('.add').click(function() {
		var aksi = 'Add';
		$.ajax({
			url: '<?php echo site_url('aset/add'); ?>',
			method: 'post',
			data: {
				aksi: aksi
			},
			success: function(data) {
				$('#modalForm').modal("show");
				$('#tampil_modal').html(data);
				document.getElementById("judul").innerHTML = 'Tambah Data Aset';

			}
		});
	});

	function edit_data(id_pasien)
	{
		$.ajax({
			url: '<?php echo base_url('aset/edit'); ?>',
			method: 'post',
			data: {id_pasien:id_pasien},
			success:function(data){
				$('#modalForm').modal("show");
				$('#tampil_modal').html(data);
				document.getElementById("judul").innerHTML='Edit Data Aset';  
			}
		});
	}

	function delete_data(id_pasien)
	{
		$.ajax({
			url: "<?php echo site_url('aset/delete')?>",
			type: "POST",
			data: {"id_pasien":id_pasien},
			dataType:"JSON",
			error: function() {
				alert('Terjadi Kesalahan, silahkan ulangi kembali');
			},
			success: function(data) {
				if(data.status)
				{
					$('#modalForm').modal('hide');
					data_table.ajax.reload();
					alert('Data berhasil dihapus');
				}
				else
				{
					alert('Terjadi Kesalahan, silahkan ulangi kembali');
				}
			}
		});
	}
</script>