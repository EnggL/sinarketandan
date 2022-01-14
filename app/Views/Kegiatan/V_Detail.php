<?php
    $classSaran = $punya_akses ? 'removeSaranKegiatan':'';
    $classFoto = $punya_akses ? 'removeImageKegiatan':'';
    $classApprove = $akses_approve ? 'approvePresensi':'';
?>
<script>
    const id_kegiatan = "<?= simple_encrypt($kegiatan->id_kegiatan) ?>";
</script>
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title-custom text-center">
                <?= $kegiatan->nama_kegiatan; ?>
            </h2>
            <div class="bold">Waktu :</div>
            <div class="text-scroll-phone">
                <?= $kegiatan->final_waktu ?> WIB
            </div>
            <br>
            <div class="bold">Tempat :</div>
            <div>
                <?= $kegiatan->lokasi ?>
            </div>
            <br>
            <div class="bold">Acara :</div>
            <div>
                <?= $kegiatan->acara ?>
            </div>
            <div class="col" style="margin-top: 30px;">
                <b>Peserta</b>
                <table class="table">
                    <?php $x = 1; foreach ($peserta as $key): ?>
                        <tr>
                            <td>
                                <?= $key->nama ?>
                                <br>
                                <?php
                                    $presensi = $key->waktu_hadir ?: false;
                                    $verifikasi = $key->approved ?: false;

                                    if (!$presensi) {
                                        $badge = '<span class="badge bg-secondary">Belum hadir</span>';
                                    }elseif ($verifikasi) {
                                        $badge = '<span class="badge bg-success ">'.$key->waktu_hadir.'</span>';
                                    }else{
                                        $badge = '<span class="badge bg-secondary '.$classApprove.'" data-id="'.simple_encrypt($key->id_peserta).'" peserta="'.$key->nama.'">'.$key->waktu_hadir.'</span>';
                                    }
                                ?>

                                <?= $badge ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
            <br>
            <div class="col text-center">
                <span class="btn btn-success" id="btnPresensi">
                    <i class="fas fa-clipboard-check"></i> Presensi
                </span>
            </div>

            <?php if ($punya_akses): ?>
                <br><br>
                <div class="col text-center">
                    <a href="<?= site_url('kegiatan/edit/'.simple_encrypt($kegiatan->id_kegiatan)) ?>" class="btn btn-primary">
                        <i class="far fa-edit"></i> Edit
                    </a>
                    <button class="btn btn-danger" id="btnDelKegiatan" value="<?= simple_encrypt($kegiatan->id_kegiatan) ?>" Kegiatan="<?= $kegiatan->nama_kegiatan; ?>">
                        <i class="far fa-trash-alt"></i> Hapus
                    </button>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <form method="post" action="<?= site_url('kegiatan/tambah/saran') ?>">
                <h5 class="card-title-custom text-center">Kritik / Saran</h5>
                <textarea class="form-control" name="saran" placeholder="Kritik / Saran untuk kegiatan ini" required=""></textarea>
                <div class="col text-center" style="margin-top: 10px;">
                    <button class="btn btn-success disableOnSubmit" name="kegiatan_id" value="<?= simple_encrypt($kegiatan->id_kegiatan) ?>">
                        Submit
                    </button>
                </div>
            </form>
            <br>
            <table class="table">
                <?php foreach ($saran as $s): ?>
                    <tr class="<?= $classSaran ?>" id="<?= simple_encrypt($s->id) ?>">
                        <td>
                            <?= $s->saran ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <form method="post" action="<?= site_url('kegiatan/tambah/foto') ?>" enctype="multipart/form-data">
                <h5 class="card-title-custom text-center">Foto Kegiatan</h5>
                <input type="file" name="foto" class="form-control" placeholder="Foto kegiatan" required="">
                <div class="col text-center" style="margin-top: 10px;">
                    <button class="btn btn-success disableOnSubmit" name="kegiatan_id" value="<?= simple_encrypt($kegiatan->id_kegiatan) ?>">
                        <i class="fas fa-plus"></i> Upload Foto
                    </button>
                </div>
            </form>
            <br>
            <?php foreach ($lampiran as $l): ?>
                <img src="<?= $l->lampiran ?>" class="img img-fluid rounded <?= $classFoto ?>" id="<?= simple_encrypt($l->id) ?>">
            <?php endforeach ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPresensi" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-xl modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Presensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="col text-center">
                        <b>Sebagai</b>
                    </div>
                    <div class="col">
                        <select class="form-control" id="slc_peserta" name="peserta">
                            <option></option>
                        </select>
                    </div>
                    <br>
                    <div class="col text-center">
                        <span class="btn btn-success" id="btnPresensiSekarang">
                            <i class="fas fa-file-signature"></i> Presensi sekarang
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalApprove" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-xl modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Presensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="post" action="<?= site_url('kegiatan/approve/presensi') ?>">
                        <div class="col">
                            <b>Peserta :</b>
                        </div>
                        <div class="col" id="namaPeserta">
                            
                        </div>
                        <br>
                        <div class="col">
                            <b>Waktu :</b>
                        </div>
                        <div class="col">
                            <input type="text" name="time" class="form-control" id="Waktu_presensi">
                        </div>
                        <br>
                        <br>
                        <div class="col text-center">
                            <button class="btn btn-success" id="btnApprove" name="id">
                                <i class="fas fa-user-check"></i> Approve
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>