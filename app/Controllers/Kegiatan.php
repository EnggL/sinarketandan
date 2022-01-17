<?php

namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\M_kegiatan;
use App\Models\M_anggota;


class Kegiatan extends BaseController
{
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');

        helper(['ceksesi', 'renderHTML', 'enkripsi']);
        $this->request = service('request');
        $this->M_kegiatan = new M_kegiatan();
        $this->M_anggota = new M_anggota();

        $this->js = [
            'kegiatan.js'
        ];

        define('AKSES', 'event');
        define('AKSES_APPROVE', 'absen');
        
    }

    public function index()
    {
        $data['title'] = 'Kegiatan';
        $data['list'] = $this->M_kegiatan->getAllKegiatanFilterTgl();
        $data['js'] = $this->js;
        $data['punya_akses'] = $this->punya_akses();

        // debug($data);

        renderHTML('Kegiatan/V_Index', $data);
    }

    function lihat($id = false)
    {
        try {
            $id = simple_decrypt($id);

            if(!$id) throw new \Exception("Invalid ID", 1);
            
            $data['title'] = 'Kegiatan';
            $data['js'] = $this->js;
            $data['sub_title1'] = "Lihat";
            $data['punya_akses'] = $this->punya_akses();
            $data['akses_approve'] = $this->akses_approve();
            $data['kegiatan'] = $this->M_kegiatan->getKegiatanByID($id);
            $data['peserta'] = $this->M_kegiatan->getPesertaKegiatan($id);
            $data['saran'] = $this->M_kegiatan->getAllSaranByKegiatanID($id);
            $data['lampiran'] = $this->M_kegiatan->getAllLampiranByKegiatanID($id);
            // debug($data);
            renderHTML('Kegiatan/V_Detail', $data);
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    function edit($id = false)
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');

        $id = simple_decrypt($id);
        if(!$id) die("Invalid ID");

        $data['title'] = 'Kegiatan';
        $data['sub_title1'] = 'Tambah Kegiatan';
        $data['js'] = $this->js;

        $data['anggota'] = $this->M_anggota->getAllAnggota();
        $data['kegiatan'] = $this->M_kegiatan->getKegiatanByID2($id);
        $data['peserta'] = $this->M_kegiatan->getPesertaKegiatanListID($id);

        // debug($data);
        renderHTML('Kegiatan/V_Edit', $data);
    }

    function tambah()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');

        $data['title'] = 'Kegiatan';
        $data['sub_title1'] = 'Tambah Kegiatan';
        $data['anggota'] = $this->M_anggota->getAllAnggota();
        $data['js'] = $this->js;

        // debug($data);
        renderHTML('Kegiatan/V_Tambah', $data);
    }

    function add()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');

        $nama_kegiatan  = $this->request->getPost('nama_kegiatan');
        $waktu_mulai    = $this->request->getPost('waktu_mulai');
        $waktu_selesai  = $this->request->getPost('waktu_selesai');
        $lokasi         = $this->request->getPost('lokasi');
        $acara          = $this->request->getPost('acara');
        $peserta        = $this->request->getPost('peserta');

        try {
            $this->isValidKegiatanAdd();

            $data = [
                'nama_kegiatan'     =>  $nama_kegiatan,
                'waktu_mulai'       =>  $waktu_mulai,
                'lokasi'            =>  $lokasi,
                'acara'             =>  $acara,
            ];

            if($waktu_selesai)
                $data['waktu_selesai'] = $waktu_selesai;

            $insert = $this->M_kegiatan->insertKegiatan($data);

            $this->insertPesertaKegiatan($peserta, $insert);

            return redirect()->to('kegiatan');
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    function insertPesertaKegiatan($data, $id)
    {
        if(!$data) return false;

        foreach ($data as $key) {
            $array[] = [
                'id_kegiatan'  =>  $id,
                'id_anggota'   =>  $key,
            ];
        }

        $insert = $this->M_kegiatan->insertPesertaKegiatanBatch($array);
        return true;
    }

    function punya_akses()
    {
        return in_array(AKSES, session()->hak_akses ?: []);
    }

    function akses_approve()
    {
        return in_array(AKSES_APPROVE, session()->hak_akses ?: []);
    }

    function isValidKegiatanAdd()
    {
        return $this->validate([
            'nama_kegiatan' => 'required|alpha_space',
            'waktu_mulai'   => 'required|valid_date[Y-m-d H:i]',
            'waktu_selesai' => 'permit_empty|valid_date[Y-m-d H:i]',
            'lokasi'        => 'required|alpha_space',
            'acara'         => 'required|alpha_space',
        ]);
    }

    function update()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');
        // debug($_POST);
        $nama_kegiatan  = $this->request->getPost('nama_kegiatan');
        $waktu_mulai    = $this->request->getPost('waktu_mulai');
        $waktu_selesai  = $this->request->getPost('waktu_selesai');
        $lokasi         = $this->request->getPost('lokasi');
        $acara          = $this->request->getPost('acara');
        $peserta        = $this->request->getPost('peserta');
        $id        = $this->request->getPost('id');

        try {
            $this->isValidKegiatanAdd();
            $id = simple_decrypt($id);
            if(!$id) throw new \Exception("Invalid ID", 1);
            
            $data = [
                'nama_kegiatan'     =>  $nama_kegiatan,
                'waktu_mulai'       =>  $waktu_mulai,
                'lokasi'            =>  $lokasi,
                'acara'             =>  $acara,
            ];

            if($waktu_selesai)
                $data['waktu_selesai'] = $waktu_selesai;
            else
                $update_null = $this->M_kegiatan->updateNullWaktuSelesai($id);

            $update = $this->M_kegiatan->updateKegiatan($data, $id);

            $this->updatePesertaKegiatan($peserta, $id);

            return redirect()->to('kegiatan');
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function updatePesertaKegiatan($data, $id)
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');
        if(!$data) return false;

        $delete = $this->M_kegiatan->deletePesertaNotIn($data, $id);

        foreach ($data as $key) {
            $ada_peserta = $this->M_kegiatan->cekPesertaKegiatan($key, $id);
            if(!$ada_peserta){
                $array[] = [
                    'id_kegiatan'  =>  $id,
                    'id_anggota'   =>  $key,
                ];
            }
        }

        if(isset($array))
            $insert = $this->M_kegiatan->insertPesertaKegiatanBatch($array);
        
        return true;
    }

    function delete($id = false)
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');
        $id = simple_decrypt($id);
        if(!$id) die("Invalid ID");

        $delete = $this->M_kegiatan->deleteKegiatanByID($id);

        return redirect()->to('kegiatan');
    }

    function tambah_saran()
    {
        // debug($_POST);
        $saran = $this->request->getPost('saran');
        $kegiatan_id = $this->request->getPost('kegiatan_id');
        $kegiatan_id = simple_decrypt($kegiatan_id);
        if(!$kegiatan_id) die('Invalid ID');

        $data['saran'] = $saran;
        $data['id_kegiatan'] = $kegiatan_id;

        $insert = $this->M_kegiatan->insertSaran($data);

        $id_encrypt = simple_encrypt($kegiatan_id);
        return redirect()->to('kegiatan/lihat/'.$id_encrypt);
    }

    function tambah_foto()
    {
        $kegiatan_id = $this->request->getPost('kegiatan_id');
        $kegiatan_id = simple_decrypt($kegiatan_id);
        if(!$kegiatan_id) die('Invalid ID');

        $path = $_FILES['foto']['tmp_name'];
        if(!isValidImage($path)) die('File Bukan Gambar');

        $content = file_get_contents($path);
        $base64 = base64_encode($content);


        $data['lampiran'] = upload_imgbb($base64);
        $data['id_kegiatan'] = $kegiatan_id;

        $insert = $this->M_kegiatan->insertLampiran($data);

        $id_encrypt = simple_encrypt($kegiatan_id);
        return redirect()->to('kegiatan/lihat/'.$id_encrypt);
    }

    function delete_image()
    {
        $id = $this->request->getPost('id');
        $id = simple_decrypt($id);
        if(!$id) die('Invalid ID');

        $delete = $this->M_kegiatan->deleteImageByID($id);

        echo "success";
    }

    function delete_saran()
    {
        $id = $this->request->getPost('id');
        $id = simple_decrypt($id);
        if(!$id) die('Invalid ID');

        $delete = $this->M_kegiatan->deleteSaranByID($id);

        echo "success";
    }

    function json_peserta_kegiatan()
    {
        $text = $this->request->getGet('q');
        $id_kegiatan = $this->request->getGet('id_kegiatan');
        $id_kegiatan = simple_decrypt($id_kegiatan);
        try {
            if(!$id_kegiatan) throw new \Exception("Invalid ID", 1);
            
            $data_awal = $this->M_kegiatan->getPesertaKegiatanFilterNama($id_kegiatan, $text);
            if(!$data_awal) throw new \Exception("Data Kosong", 1);
            
            foreach ($data_awal as $key) {
                $key->id_peserta = simple_encrypt($key->id_peserta);
                $data[] = $key;
            }
        } catch (\Exception $e) {
            $data = [];
        }

        echo json_encode($data);
    }

    function presensi()
    {
        $id = $this->request->getPost('id');
        $id_peserta = simple_decrypt($id);

        try {
            if(!$id_peserta) throw new Exception("Invalid ID", 1);
            
            $data['waktu_hadir'] = date("Y-m-d H:i:s");
            $absen = $this->M_kegiatan->updatePesertaByID($data, $id_peserta);
            if(!$absen) throw new Exception("Data tidak ditemukan", 1);

            $ret['error'] = 0;
            $ret['desc'] ="Berhasil Presensi";
        } catch (\Exception $e) {
            $ret['error'] = 1;
            $ret['desc'] = $e->getMessage();
        }

        echo json_encode($ret);
    }

    function approve_presensi()
    {
        $id = $this->request->getPost('id');
        $time = $this->request->getPost('time');
        $id_peserta = simple_decrypt($id);

        try {
            if(!$id_peserta) throw new Exception("Invalid ID", 1);
            
            $data['waktu_hadir'] = $time;
            $data['approved'] = 1;
            $absen = $this->M_kegiatan->updatePesertaByID($data, $id_peserta);
            if(!$absen) throw new Exception("Data tidak ditemukan", 1);

            $ret['error'] = 0;
            $ret['desc'] ="Berhasil Presensi";

            $id_kegiatan = $this->M_kegiatan->getPesertaByID($id_peserta)->id_kegiatan;
            return redirect()->to('kegiatan/lihat/'.simple_encrypt($id_kegiatan));
        } catch (\Exception $e) {
            $ret['error'] = 1;
            $ret['desc'] = $e->getMessage();

            echo "<pre>";
            print_r($ret);
            // return redirect()->to('kegiatan');
        }
    }

    function aktifkan_kegiatan($id = false)
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');
        $id = simple_decrypt($id);
        if(!$id) die("Invalid ID");

        $data['status_kegiatan'] = 1;
        $this->M_kegiatan->updateKegiatan($data, $id);

        return redirect()->to('kegiatan/lihat/'.simple_encrypt($id));
    }

    function nonaktifkan_kegiatan($id = false)
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');
        $id = simple_decrypt($id);
        if(!$id) die("Invalid ID");

        $data['status_kegiatan'] = '0';
        $this->M_kegiatan->updateKegiatan($data, $id);

        return redirect()->to('kegiatan/lihat/'.simple_encrypt($id));
    }
}
