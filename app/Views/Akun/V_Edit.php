<form method="post" action="<?= base_url('akun/update') ?>">
	<div class="container-fluid">
		<div class="col text-center">
			<b>Username</b>
		</div>
		<div class="col">
			<input type="text" name="username" class="form-control" placeholder="username" required="" value="<?= $akun->username ?>">
		</div>
		<br>
		<div class="col text-center">
			<b>Display Name</b>
		</div>
		<div class="col">
			<input type="text" name="name" class="form-control" placeholder="nama" required="" value="<?= $akun->display_name ?>">
		</div>
		<br>
		<div class="col text-center">
			<b>Password</b>
		</div>
		<div class="col">
			<input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin di ubah" autocomplete="off">
		</div>
		<br>
		<div class="col text-center">
			<b>Hak Akses</b>
		</div>
		<div class="col">
			<select type="text" name="hak_akses[]" class="form-control select2Basic" placeholder="Hak Akses" multiple="" style="width: 100%;" data-placeholder="Hak Akses">
				<?php foreach ($list_akses as $key): ?>
					<option <?= in_array($key, $hak_akses) ? 'selected':'' ?> value="<?= $key ?>" ><?= $key ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<br>
		<div class="col text-center">
			<button class="btn btn-success" type="submit" name="id" value="<?= simple_encrypt($akun->id) ?>">
				<i class="far fa-save"></i> Update
			</button>
		</div>
	</div>	
</form>
