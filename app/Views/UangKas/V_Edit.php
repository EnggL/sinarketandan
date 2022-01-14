<form method="post" action="<?= base_url('uang_kas/update') ?>">
	<div class="container-fluid">
		<div class="col text-center">
			<b>Tanggal</b>
		</div>
		<div class="col">
			<input type="text" name="tanggal" class="form-control basicDatePicker" placeholder="Tanggal" required="" value="<?= $data->tanggal ?>">
		</div>
		<br>
		<div class="col text-center">
			<b>Keterangan</b>
		</div>
		<div class="col">
			<div class="col">
				<input type="text" name="keterangan" class="form-control text-uppercase" placeholder="Keterangan" required="" value="<?= $data->keterangan ?>">
			</div>
		</div>
		<br>
		<div class="col text-center">
			<b>Pemasukan / Pengeluaran</b>
		</div>
		<div class="col">
			<input type="number" name="uang" class="form-control text-uppercase" placeholder="Pemasukan / Pengeluaran" required="" value="<?= $data->uang ?>">
		</div>
		<br>
		<div class="col text-center">
			<button class="btn btn-success" type="submit" name="id" value="<?= simple_encrypt($data->id) ?>">
				<i class="far fa-save"></i> Submit
			</button>
			<span class="btn btn-danger btnDelKas" data-id="<?= simple_encrypt($data->id) ?>" data-keterangan="<?= $data->keterangan ?>">
				<i class="far fa-trash-alt"></i> Hapus
			</span>
		</div>
	</div>	
</form>
