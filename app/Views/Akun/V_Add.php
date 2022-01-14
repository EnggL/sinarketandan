<form method="post" action="<?= base_url('akun/save') ?>">
	<div class="container-fluid">
		<div class="col text-center">
			<b>Username</b>
		</div>
		<div class="col">
			<input type="text" name="username" class="form-control" placeholder="username" required="">
		</div>
		<br>
		<div class="col text-center">
			<b>Display Name</b>
		</div>
		<div class="col">
			<input type="text" name="name" class="form-control" placeholder="nama" required="">
		</div>
		<br>
		<div class="col text-center">
			<b>Password</b>
		</div>
		<div class="col">
			<input type="password" name="password" class="form-control" placeholder="Password" required="">
		</div>
		<br>
		<div class="col text-center">
			<b>Hak Akses</b>
		</div>
		<div class="col">
			<select type="text" name="hak_akses[]" class="form-control select2Basic" placeholder="Hak Akses" multiple="" style="width: 100%;" data-placeholder="Hak Akses">
				<?php foreach ($list_akses as $key): ?>
					<option value="<?= $key ?>" ><?= $key ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<br>
		<div class="col text-center">
			<button class="btn btn-success" type="submit">
				<i class="far fa-save"></i> Submit
			</button>
		</div>
	</div>	
</form>
