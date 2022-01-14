<?php

namespace App\Controllers;
use App\Models\M_uangkas;
use App\Models\M_anggota;
use App\Models\M_kegiatan;

class Home extends BaseController
{
    function __construct()
    {
        helper(['ceksesi', 'renderHTML', 'enkripsi']);
        cek_session_login();

        $this->M_uangkas = new M_uangkas();
        $this->M_anggota = new M_anggota();
        $this->M_kegiatan = new M_kegiatan();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['uang_kas'] = $this->M_uangkas->getTotalUangKas();
        $data['anggota'] = $this->M_anggota->getAllAnggota();
        $data['kas'] = $this->getUangkas12BulanTerakhir();
        $data['kegiatan'] = $this->M_kegiatan->getAllKegiatanHome();
        // debug($data);

        renderHTML('V_Dashboard', $data);
    }

    function getUangkas12BulanTerakhir()
    {
        $now = date("Y-m-d");
        $start = $month = strtotime($now.' -5 month');
        $end = strtotime($now);
        while($month <= $end)
        {
            $periode = date('Y-m', $month);
            $data['bulan'][] = date('M Y', $month);
            $data['pemasukan'][] = $this->M_uangkas->getJumlahUangKasPerBulan($periode);

            $month = strtotime("+1 month", $month);
        }

        return $data;
   }
}
