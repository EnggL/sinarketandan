<div class="col">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">Daftar Akun</h5>
			<div class="col-md-12 text-end">
				<button class="btn btn-success" id="btn-add-akun">
					<i class="fas fa-plus"></i> Tambah Akun
				</button>
			</div>
			<div class="col-md-12" style="margin-top: 30px;">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead class="table-primary">
							<tr>
								<th style="width: 50px; text-align: left;">No</th>
								<th style="text-align: left;">Username</th>
								<th style="text-align: left;">Display Name</th>
								<th style="text-align: center;">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $x=1; foreach ($list as $key): ?>
							<tr>
								<td><?= $x ?></td>
								<td>
									<?= $key->username ?>
								</td>
								<td>
									<?= $key->display_name ?>
								</td>
								<td style="text-align: center; white-space: nowrap;" username="<?= $key->username ?>">
									<button class="btn btn-primary btnEditAkun" value="<?= $x-1 ?>">
										<i class="far fa-edit"></i> Edit
									</button>
									<button class="btn btn-danger btnDeleteAkun" value="<?= $x-1 ?>">
										<i class="fas fa-trash"></i> Delete
									</button>
								</td>
							</tr>
							<?php $x++; endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?= $render ?>
<div class="modal fade" id="modalAddAkun" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
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