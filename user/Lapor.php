<?php include 'header.php'; ?>
<button style="margin-bottom:10px" style="align:right" data-toggle="modal" data-target="#modal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-print"></span>Cetak</button>

<div id="modal" class="modal fade">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Cetak</h4>
		</div>
		<div class="modal-body">
			<form action="lap_barang.php" method="post">
				<div class="form-group">
					<label>Dari Tanggal </label>
					<input name="start_date" type="date" class="form-control">
				</div>
				<div class="form-group">
					<label>Sampai Tanggal </label>
					<input name="end_date" type="date" class="form-control">
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<input type="submit" class="btn btn-primary" value="cetak">
			</div>
		</form>
	</div>
</div>
</div>
<?php include 'footer.php'?>