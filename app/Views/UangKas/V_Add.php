<form method="post" action="<?= base_url('uang_kas/save') ?>">
	<div class="container-fluid">
		<div class="col text-center">
			<b>Tanggal</b>
		</div>
		<div class="col">
			<input type="text" name="tanggal" class="form-control basicDatePicker" placeholder="Tanggal" required="">
		</div>
		<br>
		<div class="col text-center">
			<b>Keterangan</b>
		</div>
		<div class="col">
			<div class="col">
				<input type="text" name="keterangan" class="form-control text-uppercase" placeholder="Keterangan" required="">
			</div>
		</div>
		<br>
		<div class="col text-center">
			<b>Pemasukan / Pengeluaran</b>
		</div>
		<div class="col">
			<input type="number" name="uang" class="form-control text-uppercase" placeholder="Pemasukan / Pengeluaran" required="">
		</div>
		<br>
		<div class="col text-center">
			<button class="btn btn-success" type="submit">
				<i class="far fa-save"></i> Submit
			</button>
		</div>
	</div>	
</form>
