<?php

namespace App\Controllers;
use App\Models\M_aset;
use CodeIgniter\HTTP\IncomingRequest;

class Aset extends BaseController
{
    function __construct()
    {
        $this->M_aset = new M_aset();
        $this->encrypter = \Config\Services::encrypter();
        $this->js = [
            'aset.js'
        ];

        $this->form_validasi = \Config\Services::validation();
    
        define('AKSES', 'aset_pemuda');
    }

    public function index()
    {
        $data['title'] = 'Aset Pemuda';
        $data['list'] = $this->M_aset->getAllAsetPemuda();
        $data['history'] = $this->M_aset->getAllHistoryPeminjaman();
        $data['js'] = $this->js;
        $data['punya_akses'] = $this->punya_akses();
        // print_r($data);exit();

        renderHTML('Aset/V_Index', $data);
    }

    function punya_akses()
    {
        $hak_akses = session()->hak_akses ?: [];
        return in_array(AKSES, $hak_akses);
    }

    function modal_add()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');
        return view('Aset/V_Add');
    }

    function save()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');

        $aset = $this->request->getPost('aset');
        $jumlah = $this->request->getPost('jumlah');
        $satuan = $this->request->getPost('satuan');
        $lokasi = $this->request->getPost('lokasi');
        $aset = $this->request->getPost('aset');
        $keterangan = $this->request->getPost('keterangan');
        
        try {
            $data = [
                'nama_aset'          =>  strtoupper($aset),
                'jumlah_aset'        =>  $jumlah,
                'satuan_aset'        =>  strtoupper($satuan),
                'lokasi_aset'        =>  strtoupper($lokasi),
                'keterangan'         =>  $keterangan,
            ];

            if($_FILES && $_FILES['foto']['name'])
                $data['foto_aset'] = $this->uploadFoto();

            $insert = $this->M_aset->insertAset($data);

            return redirect()->to('aset-pemuda');
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    function uploadFoto()
    {
        $path = $_FILES['foto']['tmp_name'];
        $data = file_get_contents($path);
        $base64 = base64_encode($data);

        return upload_imgbb($base64);
    }

    function modal_view()
    {
        $id = $this->request->getGet('id');
        $id = simple_decrypt($id);

        try {
            if(!$id) throw new \Exception("Invalid ID", 1);
            
            $data['aset'] = $this->M_aset->getAsetByID($id);
            $data['punya_akses'] = $this->punya_akses();

            return view('Aset/V_View', $data);
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    function delete($id = false)
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');

        $id = simple_decrypt($id);
        try {
            if(!$id || !is_numeric($id))
                throw new \Exception("Invalid ID", 1);
                
            $delete = $this->M_aset->deleteAsetByID($id);

            return redirect()->to('aset-pemuda');
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    function modal_edit($id = false)
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');

        $id = simple_decrypt($id);
        try {
            if(!$id || !is_numeric($id))
                throw new \Exception("Invalid ID", 1);
                
            $data['aset'] = $this->M_aset->getAsetPemudaByID($id);

            return view('Aset/V_Edit', $data);
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    function update()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');

        $aset = $this->request->getPost('aset');
        $jumlah = $this->request->getPost('jumlah');
        $satuan = $this->request->getPost('satuan');
        $lokasi = $this->request->getPost('lokasi');
        $aset = $this->request->getPost('aset');
        $keterangan = $this->request->getPost('keterangan');
        $id = $this->request->getPost('id');
        $id = simple_decrypt($id);
        
        try {
            if(!$id || !is_numeric($id))
                throw new Exception("Invalid ID", 1);

            $data = [
                'nama_aset'          =>  strtoupper($aset),
                'jumlah_aset'        =>  $jumlah,
                'satuan_aset'        =>  strtoupper($satuan),
                'lokasi_aset'        =>  strtoupper($lokasi),
                'keterangan'         =>  $keterangan,
            ];

            if($_FILES && $_FILES['foto']['name'])
                $data['foto_aset'] = $this->uploadFoto();

            $insert = $this->M_aset->updateAset($data, $id);

            return redirect()->to('aset-pemuda');
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    function modal_add_history()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');

        $data['aset'] = $this->M_aset->getAllAsetPemuda();
        // debug($data);
        return view('Aset/V_HistoryAdd', $data);
    }

    function save_history()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');
        try {
            if(!$this->isValidHistoryAdd())
                throw new \Exception($this->form_validasi->listErrors(), 1);
                
            $aset       = $this->request->getPost('aset');
            $jumlah     = $this->request->getPost('jumlah');
            $peminjam   = $this->request->getPost('peminjam');
            $dari       = $this->request->getPost('dari');
            $sampai     = $this->request->getPost('sampai');
            $biaya      = $this->request->getPost('biaya');

            $data = [
                'aset_id'       =>  $aset,
                'jumlah_aset'   =>  $jumlah,
                'peminjam'      =>  $peminjam,
                'dari'          =>  $dari,
                'biaya'         =>  $biaya,
            ];

            if($sampai)
                $data['sampai'] = $sampai;

            $insert = $this->M_aset->insertHistoryAset($data);

            return redirect()->to('aset-pemuda');
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        debug($_POST);
    }

    function isValidHistoryAdd()
    {
        return $this->validate([
            'aset'      => 'required|numeric',
            'jumlah'    => 'required|numeric',
            'peminjam'  => 'required|alpha_space',
            'dari'      => 'required|valid_date[Y-m-d]',
            'sampai'    => 'permit_empty|valid_date[Y-m-d]',
            'biaya'     => 'required|numeric',
        ]);
    }

    function modal_edit_history($id = false)
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');
        try {
            $id = simple_decrypt($id);
            if(!$id || !is_numeric($id)) throw new \Exception("Invalid ID", 1);

            $data['aset'] = $this->M_aset->getAllAsetPemuda();
            $data['history'] = $this->M_aset->getHistoryPeminjamanByID($id);

            return view('Aset/V_HistoryEdit', $data);
        } catch (\Exception $e) {
            die($e->getMessage());   
        }
    }

    function update_history()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');

        try {
            if(!$this->isValidHistoryAdd())
                throw new \Exception($this->form_validasi->listErrors(), 1);
                
            $aset       = $this->request->getPost('aset');
            $jumlah     = $this->request->getPost('jumlah');
            $peminjam   = $this->request->getPost('peminjam');
            $dari       = $this->request->getPost('dari');
            $sampai     = $this->request->getPost('sampai');
            $biaya      = $this->request->getPost('biaya');
            $id         = $this->request->getPost('id');

            $id = simple_decrypt($id);
            if(!$id)
                throw new \Exception("Invalid ID", 1);
                
            $data = [
                'aset_id'       =>  $aset,
                'jumlah_aset'   =>  $jumlah,
                'peminjam'      =>  $peminjam,
                'dari'          =>  $dari,
                'biaya'         =>  $biaya,
            ];

            if($sampai)
                $data['sampai'] = $sampai;
            else
                $update_null = $this->M_aset->updateNullKembali($id);

            $insert = $this->M_aset->updeteHistoryAset($data, $id);

            return redirect()->to('aset-pemuda');
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        debug($_POST);
    }

    function delete_history($id = false)
    {
        $id = simple_decrypt($id);
        if(!$id) die("Invalid ID");

        $delete = $this->M_aset->deleteHistory($id);
        return redirect()->to('aset-pemuda');
    }
}
