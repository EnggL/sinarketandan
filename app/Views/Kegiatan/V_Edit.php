<form method="post" action="<?= site_url() ?>kegiatan/update">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tambah Event Kegiatan</h5>
                <div class="mb-3">
                    <div class="col">
                        <label class="col-form-label">Nama Kegiatan :</label>
                    </div>
                    <div class="col">
                        <input type="text" name="nama_kegiatan" class="form-control" placeholder="Nama Kegiatan" required="" value="<?= $kegiatan->nama_kegiatan ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <div class="col">
                        <label class="col-form-label">Waktu Mulai :</label>
                    </div>
                    <div class="col">
                        <input type="text" name="waktu_mulai" class="form-control basicDatePickerTime" placeholder="Waktu Mulai Kegiatan" required="" value="<?= $kegiatan->waktu_mulai ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <div class="col">
                        <label class="col-form-label">Waktu Selesai :</label>
                    </div>
                    <div class="col">
                        <input type="text" name="waktu_selesai" class="form-control basicDatePickerTime" placeholder="Waktu Selesai Kegiatan" id="waktuSelesai" value="<?= $kegiatan->waktu_selesai ?>" <?= !$kegiatan->waktu_selesai ? 'disabled':'' ?>>
                    </div>
                    <div class="col">
                        <label>
                            <input type="checkbox" name="tidak_tentu" id="chkTidakTentu" class="ick" <?= !$kegiatan->waktu_selesai ? 'checked':'' ?>> Tidak Pasti
                        </label>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="col">
                        <label class="col-form-label">Lokasi Kegiatan :</label>
                    </div>
                    <div class="col">
                        <input type="text" name="lokasi" class="form-control" placeholder="Lokasi Kegiatan" required value="<?= $kegiatan->lokasi ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <div class="col">
                        <label class="col-form-label">Acara :</label>
                    </div>
                    <div class="col">
                        <textarea name="acara" class="form-control" placeholder="Detail Acara" required><?= $kegiatan->acara ?></textarea>
                    </div>
                </div>

                <div class="col" style="margin-top: 30px;">
                    <b>Peserta</b>
                    <table class="table table-bordered">
                        <tr>
                            <td style="width: 30px;">
                                <input type="checkbox" class="ick chkAllPeserta">
                            </td>
                            <td style="text-align: center;">
                                <b>Anggota</b>
                            </td>
                        </tr>
                        <?php foreach ($anggota as $key): ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="ick chkPeserta" value="<?= $key['id'] ?>" name="peserta[]" <?= in_array($key['id'], $peserta) ? 'checked':'' ?>>
                                </td>
                                <td>
                                    <?= $key['nama'] ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>

                <div class="col text-center" style="margin-top: 50px;">
                    <button class="btn btn-success btn-lg" name="id" value="<?= simple_encrypt($kegiatan->id_kegiatan) ?>">
                        <i class="far fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>