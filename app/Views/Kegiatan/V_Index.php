<?php if($punya_akses): ?>
	<div id="btnAddKegiatan" class="col text-center" style="margin-bottom: 10px;">
		<a href="<?= site_url('kegiatan/tambah') ?>" class="btn btn-success">
			<i class="fas fa-plus"></i> Tambah
		</a>
	</div>
<?php endif ?>
<div class="col">
	<?php foreach ($list as $key): ?>
		<div class="col-md-6">
			<div class="anggota-card">
				<table style="width: 100%;">
					<tr>
						<td class="kegiatan-text">
							<b><?= $key->nama_kegiatan ?></b>
						</td>
					</tr>
					<tr>
						<td class="kegiatan-text kegiatan-waktu">
							<div class="text-scroll-phone">
								<?= $key->final_waktu ?>
							</div>
						</td>
					</tr>
					<tr>
						<td class="kegiatan-text">
							<?= $key->lokasi ?>
						</td>
					</tr>
					<tr>
						<td class="kegiatan-action">
							<a href="kegiatan/lihat/<?= simple_encrypt($key->id_kegiatan) ?>" class="btn btn-primary">
								Lihat <i class="far fa-arrow-alt-circle-right"></i>
							</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
	<?php endforeach ?>
</div>