<form method="post" action="<?= base_url('daftar_anggota/update') ?>">
	<div class="container-fluid">
		<div class="col text-center">
			<b>Nama</b>
		</div>
		<div class="col">
			<input type="text" name="nama" class="form-control text-uppercase" placeholder="Nama" required="" value="<?= $anggota->nama ?>">
		</div>
		<br>
		<div class="col text-center">
			<b>Jenis Kelamin</b>
		</div>
		<div class="col">
			<select name="gender" class="form-control select2Basic" placeholder="nama" required="" data-placeholder="Jenis Kelamin">
				<option></option>
				<?php foreach ($list_gender as $key): ?>
					<option <?= ($key == $anggota->gender) ? 'selected':'' ?>>
						<?= $key ?>
					</option>
				<?php endforeach ?>
			</select>
		</div>
		<br>
		<div class="col text-center">
			<b>Asal</b>
		</div>
		<div class="col">
			<input type="text" name="asal" class="form-control text-uppercase" placeholder="Asal" required="" value="<?= $anggota->asal ?>">
		</div>
		<br>
		<div class="col text-center">
			<button class="btn btn-success" type="submit" name="id" value="<?= simple_encrypt($anggota->id) ?>">
				<i class="far fa-save"></i> Submit
			</button>
			<span id="<?= simple_encrypt($anggota->id) ?>" class="btnDelAnggota btn btn-danger" nama="<?= $anggota->nama ?>">
				<i class="far fa-trash-alt"></i> Hapus Anggota
			</span>
		</div>
	</div>	
</form>
