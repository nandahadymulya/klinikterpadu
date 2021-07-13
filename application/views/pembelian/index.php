<div class="main pt-4">
	<h5 class="display-6"><?php echo $pageheader; ?></h5>
	<p>Halaman ini memuat semua data pembelian terhadap barang.</p>

	<div class="page-header">
		<button type="button" name="add" id="add-form" data-toggle="modal" data-target="#modalForm" class="add btn btn-success text-white">
			<i class="fa fa-plus"></i>Tambah Pembelian
		</button>
	</div>
	<hr/>

	<table id="data_table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>No</th>
				<th>No Faktur</th>
				<th>Tanggal</th>
				<th>ID Supplier</th>
				<th>Total</th>
				<th>DP</th>
				<th>Jatuh Tempo</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody></tbody>
		<tfoot>
			<tr>
				<th width="2%">No</th>
				<th>No Faktur</th>
				<th>Tanggal</th>
				<th>ID Supplier</th>
				<th>Total</th>
				<th>DP</th>
				<th>Jatuh Tempo</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</tfoot>
	</table>

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

<!-- <script type="text/javascript">
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
					"url": "<?php echo site_url('supplier/ajax') ?>",
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
			url: '<?php echo site_url('supplier/add'); ?>',
			method: 'post',
			data: {
				aksi: aksi
			},
			success: function(data) {
				$('#modalForm').modal("show");
				$('#tampil_modal').html(data);
				document.getElementById("judul").innerHTML = 'Tambah Data';

			}
		});
	});

	function edit_data(id_supplier)
	{
		$.ajax({
			url: '<?php echo base_url('supplier/edit'); ?>',
			method: 'post',
			data: {id_supplier:id_supplier},
			success:function(data){
				$('#modalForm').modal("show");
				$('#tampil_modal').html(data);
				document.getElementById("judul").innerHTML='Edit Data Supplier';  
			}
		});
	}

	function delete_data(id_supplier)
	{
		$.ajax({
			url: "<?php echo site_url('supplier/delete')?>",
			type: "POST",
			data: {"id_supplier":id_supplier},
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
</script> -->