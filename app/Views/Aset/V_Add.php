<form method="post" action="<?= base_url('aset-pemuda/save') ?>" enctype="multipart/form-data" >
	<div class="container-fluid">
		<div class="col text-center">
			<b>Nama Aset</b>
		</div>
		<div class="col">
			<input type="text" name="aset" class="form-control text-uppercase" placeholder="Nama Aset" required="">
		</div>
		<br>
		<div class="col text-center">
			<b>Jumlah</b>
		</div>
		<div class="col">
			<div class="col">
				<input type="number" name="jumlah" class="form-control text-uppercase" placeholder="Jumlah" required="">
			</div>
		</div>
		<br>
		<div class="col text-center">
			<b>Satuan</b>
		</div>
		<div class="col">
			<div class="col">
				<input type="text" name="satuan" class="form-control text-uppercase" placeholder="Satuan" required="">
			</div>
		</div>
		<br>
		<div class="col text-center">
			<b>Lokasi</b>
		</div>
		<div class="col">
			<input type="text" name="lokasi" class="form-control text-uppercase" placeholder="Lokasi" required="">
		</div>
		<br>
		<div class="col text-center">
			<b>Foto</b>
		</div>
		<div class="col">
			<input type="file" name="foto" class="form-control" placeholder="Foto Aset">
		</div>
		<br>
		<div class="col text-center">
			<b>Keterangan</b>
		</div>
		<div class="col">
			<input type="text" name="keterangan" class="form-control" placeholder="Keterangan" required="">
		</div>
		<br>
		<div class="col text-center">
			<button class="btn btn-success" type="submit">
				<i class="far fa-save"></i> Submit
			</button>
		</div>
	</div>	
</form>
