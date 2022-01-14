<form method="post" action="<?= base_url('aset-pemuda/save') ?>" enctype="multipart/form-data" >
	<div class="container-fluid">
		<div class="col text-left">
			<b>Nama Aset :</b>
		</div>
		<div class="col">
			<?= $aset->nama_aset ?>
		</div>
		<br>
		<div class="col text-left">
			<b>Jumlah :</b>
		</div>
		<div class="col">
			<div class="col">
				<?= $aset->jumlah_aset ?>
			</div>
		</div>
		<br>
		<div class="col text-left">
			<b>Satuan :</b>
		</div>
		<div class="col">
			<div class="col">
				<?= $aset->satuan_aset ?>
			</div>
		</div>
		<br>
		<div class="col text-left">
			<b>Lokasi :</b>
		</div>
		<div class="col">
			<?= $aset->lokasi_aset ?>
		</div>
		<br>
		<div class="col text-left">
			<b>Foto :</b>
		</div>
		<div class="col">
			<a href="<?= $aset->foto_aset ?>" target="_blank">
				<?= $aset->foto_aset ?>
			</a>
		</div>
		<br>
		<div class="col text-left">
			<b>Keterangan :</b>
		</div>
		<div class="col">
			<?= $aset->keterangan ?>
		</div>
		<?php if ($punya_akses): ?>
			<br>
			<br>
			<div class="col text-center">
				<span class="btn btn-primary btn-editAset" id="<?= simple_encrypt($aset->id) ?>" data-aset="<?= $aset->nama_aset ?>">
					<i class="far fa-edit"></i> Edit
				</span>
				<span class="btn btn-danger btn-delAset" id="<?= simple_encrypt($aset->id) ?>" data-aset="<?= $aset->nama_aset ?>">
					<i class="far fa-trash-alt"></i> Hapus
				</span>
			</div>
		<?php endif ?>
	</div>	
</form>
