<?php

namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\M_anggota;

class Anggota extends BaseController
{
    function __construct()
    {
        helper(['ceksesi', 'renderHTML', 'enkripsi']);
        $this->M_anggota = new M_anggota();
        $this->encrypter = \Config\Services::encrypter();
        $this->js = [
            'anggota.js'
        ];

        define("AKSES", 'daftar_anggota');
    }

    public function index()
    {
        $data['title'] = 'Daftar Anggota';
        $data['list'] = $this->dataListAnggota();
        $data['js'] = $this->js;

        renderHTML('Anggota/V_Index', $data);
    }

    function dataListAnggota()
    {
        $data = $this->M_anggota->getAllAnggota();
        $new_data = [];

        foreach ($data as $key) {
            $key['id_encrypt'] = base64_encode($this->encrypter->encrypt($key['id']));
            $key['id_decript'] = $this->encrypter->decrypt(base64_decode($key['id_encrypt']));
            $new_data[] = $key;
        }
        return $new_data;
    }

    function modal_add()
    {
        return view('Anggota/V_Add');
    }

    function save()
    {
        // debug($_POST);
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');

        try {
            $this->validasiSaveAnggota();

            $nama = strtoupper($this->request->getPost('nama'));
            $gender = $this->request->getPost('gender');
            $asal = strtoupper($this->request->getPost('asal'));

            $data = [
                'nama'  =>  $nama,
                'gender'  =>  $gender,
                'asal'  =>  $asal,
            ];

            $insert = $this->M_anggota->insertAnggota($data);

            return redirect()->to('daftar_anggota');;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    function validasiSaveAnggota()
    {
        $nama = $this->request->getPost('nama');
        if(!$nama) throw new \Exception("Nama Tidak Boleh Kosong", 1);
        
        $gender = $this->request->getPost('gender');
        if(!$gender) throw new \Exception("Gender Tidak Boleh Kosong", 1);

        $asal = $this->request->getPost('asal');
        if(!$asal) throw new \Exception("Asal Tidak Boleh Kosong", 1);
    }

    function modal_edit()
    {
        $id = $this->request->getGet('id');
        $id = simple_decrypt($id);
        if(!$id) die('Invalid ID');

        $data['anggota'] = $this->M_anggota->getAnggotaByID($id);
        $data['list_gender'] = $this->M_anggota->genderAviable($id);
        return view('Anggota/V_Edit', $data);
    }

    function update()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');

        try {
            $this->validasiSaveAnggota();

            $id = $this->request->getPost('id');
            $id = simple_decrypt($id);
            if(!$id) throw new \Exception("Invalid ID", 1);
            
            $nama = strtoupper($this->request->getPost('nama'));
            $gender = $this->request->getPost('gender');
            $asal = strtoupper($this->request->getPost('asal'));

            $data = [
                'nama'  =>  $nama,
                'gender'  =>  $gender,
                'asal'  =>  $asal,
            ];

            $update = $this->M_anggota->updateanggota($data, $id);

            return redirect()->to('daftar_anggota');
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    function delete()
    {
        // debug($_GET);
        try {
            $id = $this->request->getGet('id');
            $id = simple_decrypt($id);
            if(!$id) throw new \Exception("Invalid ID", 1);
            
            $delete = $this->M_anggota->deleteAnggota($id);

            return redirect()->to('daftar_anggota');
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}
