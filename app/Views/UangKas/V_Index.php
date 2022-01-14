<?php
	$hak_akses = session()->hak_akses ?: [];
	$punya_akses = in_array(AKSES, $hak_akses);
?>
<div class="col">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">Pengeluaran & Pemasukan Uang Kas</h5>
			<?php if ($punya_akses): ?>
				<div class="col text-center" style="padding: 10px;">
					<button class="btn btn-success" id="btnAddUangKas">
						<i class="fas fa-plus"></i> Tambah
					</button>
				</div>				
			<?php endif ?>
			<h4><b>Total Uang Kas : Rp <?= number_format($total, 0, ',', '.') ?></b></h4>
			<div class="table-responsive">
				<table class="table table-hover ">
					<thead class="table-primary">
						<tr>
							<th style="text-align: left;">Keterangan</th>
							<th style="text-align: left;">Uang</th>
						</tr>
					</thead>
					<tbody>
						<?php $x = 1; foreach ($list as $key): ?>
							<tr class="<?= $punya_akses ? 'edit-kas':'' ?>" id="<?= simple_encrypt($key->id) ?>">
								<td>
									<b><?= $key->keterangan ?></b>
									<p class="tanggal-uang-kas">
										<?= date("d F Y", strtotime($key->tanggal)) ?>
									</p>
								</td>
								<td class="<?= ($key->uang > 0) ? 'rp-green':'rp-red' ?>" style="white-space: nowrap;">
									Rp <?= number_format($key->uang, 0, ',', '.') ?>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalUangKas" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-fullscreen">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Pemasukan atau Pengeluaran Uang Kas</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				...
			</div>
		</div>
	</div>
</div>