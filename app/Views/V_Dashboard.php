<div class="col row">
	<div class="col-md-8">
		<div class="col row">
			<div class="col-md-6">
				<div class="card info-card revenue-card">
					<div class="card-body">
						<h5 class="card-title">Total Uang Kas</h5>

						<div class="d-flex align-items-center">
							<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
								<i class="bi bi-currency-dollar"></i>
							</div>
							<div class="ps-3">
								<h6>Rp <?= number_format($uang_kas, 0, ',', '.') ?></h6>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="card info-card customers-card">
					<div class="card-body">
						<h5 class="card-title">Jumlah Anggota</h5>

						<div class="d-flex align-items-center">
							<div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
								<i class="bi bi-people"></i>
							</div>
							<div class="ps-3">
								<h6><?= count($anggota) ?> Orang</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">Reports <span> | Uang Kas</span></h5>

					<!-- Line Chart -->
					<div id="reportsChart"></div>

					<script>
						document.addEventListener("DOMContentLoaded", () => {
							new ApexCharts(document.querySelector("#reportsChart"), {
								series: [{
									name: 'Pemasukan Kas',
									data: [<?= implode(', ', $kas['pemasukan']) ?>],
								}],
								chart: {
									height: 350,
									type: 'area',
									toolbar: {
										show: false
									},
								},
								markers: {
									size: 4
								},
								colors: ['#4154f1', '#2eca6a', '#ff771d'],
								fill: {
									type: "gradient",
									gradient: {
										shadeIntensity: 1,
										opacityFrom: 0.3,
										opacityTo: 0.4,
										stops: [0, 90, 100]
									}
								},
								dataLabels: {
									enabled: false
								},
								stroke: {
									curve: 'smooth',
									width: 2
								},
								xaxis: {
									type: 'date',
									categories: ["<?= implode('", "', $kas['bulan']) ?>"]
								},
								tooltip: {
									x: {
										format: 'Y-m'
									},
								}
							}).render();
						});
					</script>
					<!-- End Line Chart -->
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title">Kegiatan Terkini</h5>
				<div class="activity">
					<?php foreach ($kegiatan as $key): ?>
						<div class="activity-item d-flex">
							<div class="activite-label">
								<?= date("d F Y", strtotime($key->waktu_mulai)) ?>
							</div>
							<i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
							<div class="activity-content">
								<a class="fw-bold text-dark">
									<?= $key->nama_kegiatan ?>
								</a>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>