<form method="post" action="<?= base_url('daftar_anggota/save') ?>">
	<div class="container-fluid">
		<div class="col text-center">
			<b>Nama</b>
		</div>
		<div class="col">
			<input type="text" name="nama" class="form-control text-uppercase" placeholder="Nama" required="">
		</div>
		<br>
		<div class="col text-center">
			<b>Jenis Kelamin</b>
		</div>
		<div class="col">
			<select name="gender" class="form-control select2Basic" placeholder="nama" required="" data-placeholder="Jenis Kelamin">
				<option></option>
				<option>LAKI-LAKI</option>
				<option>PEREMPUAN</option>
			</select>
		</div>
		<br>
		<div class="col text-center">
			<b>Asal</b>
		</div>
		<div class="col">
			<input type="text" name="asal" class="form-control text-uppercase" placeholder="Asal" required="">
		</div>
		<br>
		<div class="col text-center">
			<button class="btn btn-success" type="submit">
				<i class="far fa-save"></i> Submit
			</button>
		</div>
	</div>	
</form>
