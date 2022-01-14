<form method="post" action="<?= base_url('aset-pemuda/modal/history/update') ?>" enctype="multipart/form-data" >
	<div class="container-fluid">
		<div class="col text-center">
			<b>Nama Aset</b>
		</div>
		<div class="col">
			<select class="form-control select2Basic" name="aset" style="width: 100%;" required="" data-placeholder="Aset yang di pinjam">
				<option></option>
				<?php foreach ($aset as $key): ?>
					<option value="<?= $key->id ?>" <?= ($key->id == $history->aset_id) ? 'selected':'' ?>>
						<?= $key->nama_aset ?>
					</option>
				<?php endforeach ?>
			</select>
		</div>
		<br>
		<div class="col text-center">
			<b>Jumlah Dipinjam</b>
		</div>
		<div class="col">
			<div class="col">
				<input type="number" name="jumlah" class="form-control" placeholder="Jumlah Dipinjam" required="" value="<?= $history->jumlah_aset ?>">
			</div>
		</div>
		<br>
		<div class="col text-center">
			<b>Peminjam</b>
		</div>
		<div class="col">
			<input type="text" name="peminjam" class="form-control text-upper" placeholder="Peminjam" required="" value="<?= $history->peminjam ?>">
		</div>
		<br>
		<div class="col text-center">
			<b>Dari</b>
		</div>
		<div class="col">
			<input type="text" name="dari" class="form-control basicDatePicker" placeholder="Dari" value="<?= $history->dari ?>">
		</div>
		<br>
		<div class="col text-center">
			<b>Sampai</b>
		</div>
		<div class="col">
			<input type="text" name="sampai" class="form-control basicDatePicker" placeholder="Sampai" required="" id="pinjam-sampai" value="<?= $history->sampai ?>" value="<?= $history->sampai ?>"  <?= !$history->sampai ? 'disabled':'' ?>>
			<label class="fw-bold">
				<input type="checkbox" class="ick" id="belum-kembali" <?= !$history->sampai ? 'checked':'' ?>/> Belum Kembali
			</label>
		</div>
		<br>
		<div class="col text-center">
			<b>Estimasi Biaya</b>
		</div>
		<div class="col">
			<input type="number" name="biaya" class="form-control" placeholder="Estimasi Biaya" required="" value="<?= $history->biaya ?>">
		</div>
		<br>
		<div class="col text-center">
			<button class="btn btn-success" type="submit" value="<?= simple_encrypt($history->id) ?>" name="id">
				<i class="far fa-save"></i> Submit
			</button>
			<span class="btn btn-danger btnDelHistoryAset" id="<?= simple_encrypt($history->id) ?>">
				<i class="far fa-trash-alt"></i> Hapus
			</span>
		</div>
	</div>	
</form>
