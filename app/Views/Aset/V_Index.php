<div class="col">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">Daftar Aset Muda Mudi Sinar Ketandan</h5>
			<?php if ($punya_akses): ?>
				<div class="col text-center" style="margin-bottom: 30px;">
					<span class="btn btn-success" id="btnAddAset">
						<i class="fas fa-plus"></i> Tambah
					</span>	
				</div>
			<?php endif ?>
			<table class="table table-hover ">
				<thead class="table-primary">
					<tr>
						<th style="text-align: left;">Aset</th>
						<th style="text-align: left;">Jumlah</th>
						<th style="text-align: left;">Lokasi</th>
					</tr>
				</thead>
				<tbody>
					<?php $x = 1; foreach ($list as $key): ?>
						<tr class="showDetailAset" id="<?= simple_encrypt($key->id) ?>">
							<td><?= $key->nama_aset ?></td>
							<td><?= $key->jumlah_aset ?> <?= $key->satuan_aset ?></td>
							<td><?= $key->lokasi_aset ?></td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			<h5 class="card-title">Daftar History Peminjaman Aset</h5>
			<?php if ($punya_akses): ?>
				<div class="col text-center" style="margin-bottom: 30px;">
					<span class="btn btn-success" id="btnAddHistoryAset">
						<i class="fas fa-plus"></i> Tambah
					</span>	
				</div>
			<?php endif ?>
			<div class="table-responsive">
				<table class="table table-hover table-history-aset">
					<thead class="table-primary">
						<tr>
							<th style="width: 50px; text-align: left;">No</th>
							<th style="text-align: left;">Aset</th>
							<th style="text-align: left;">Jumlah</th>
							<th style="text-align: left;">Peminjam</th>
							<th style="text-align: left;">Dari</th>
							<th style="text-align: left;">Sampai</th>
							<th style="text-align: left;">Estimasi Biaya</th>
						</tr>
					</thead>
					<tbody>
						<?php $x = 1; foreach ($history as $key): ?>
							<tr class="<?= $punya_akses ? 'editHistoryPinjam':'' ?>" data-id="<?= simple_encrypt($key->id) ?>">
								<td class="one-line"><?= $x++ ?></td>
								<td class="one-line"><?= $key->nama_aset ?></td>
								<td class="one-line"><?= $key->jumlah_aset ?> <?= $key->satuan_aset ?></td>
								<td><?= $key->peminjam ?></td>
								<td class="one-line">
									<?= date('d F Y', strtotime($key->dari)) ?>
								</td>
								<td class="one-line">
									<?php if ($key->sampai): ?>
										<?= date('d F Y', strtotime($key->sampai)) ?>
									<?php else: ?>
										-
									<?php endif ?>
								</td>
								<td>Rp <?= number_format($key->biaya, 0, ',', '.') ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalAset" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog modal-xl modal-fullscreen">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Akun</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				
			</div>
		</div>
	</div>
</div>