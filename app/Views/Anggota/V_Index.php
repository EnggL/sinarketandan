<?php if($punya_akses = cekHakAkses(AKSES)): ?>
	<div id="btnAddAnggota" class="col text-center" style="margin-bottom: 10px;">
		<button class="btn btn-success">
			<i class="fas fa-plus"></i> Tambah
		</button>
	</div>
<?php endif ?>
<div class="col">
	<?php foreach ($list as $key): ?>
		<div class="col-md-6">
			<div class="anggota-card <?= $punya_akses ? 'edit-anggota':'' ?>" id="<?= simple_encrypt($key['id']) ?>">
				<table style="width: 100%;">
					<tr>
						<td rowspan="3" class="card-table-profile">
							<img src="assets/image/logo.jpeg">
						</td>
						<td class="card-table-title">
							<?= $key['nama'] ?>
						</td>
					</tr>
					<tr>
						<td class="card-table-detail">
							<?= $key['gender'] ?>
						</td>
					</tr>
					<tr>
						<td class="card-table-detail">
							<?= $key['asal'] ?>
						</td>
					</tr>
				</table>
			</div>
		</div>
	<?php endforeach ?>
</div>

<div class="modal fade" id="modalAddAnggota" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-fullscreen-sm-down">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				...
			</div>
		</div>
	</div>
</div>