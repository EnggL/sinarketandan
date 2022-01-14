<?php

namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\M_uangkas;

class UangKas extends BaseController
{

    function __construct()
    {
        $this->M_uangkas = new M_uangkas();
        // print_r(session());exit();
        $this->js = [
            'uang-kas.js'
        ];
        define('AKSES', 'uang_kas');
    }

    public function index()
    {
        $data['title'] = 'Uang Kas';
        $data['list'] = $this->M_uangkas->getAllUangKas();
        $data['total'] = $this->M_uangkas->getTotalUangKas();
        $data['js'] = $this->js;

        renderHTML('UangKas/V_Index', $data);
    }

    function modal_add()
    {
        return view('UangKas/V_Add');
    }

    function modal_edit()
    {
        $id = $this->request->getGet('id');
        $id = simple_decrypt($id);
        if (!$id) {
            return 'Invalid ID';
            die();
        }

        $data['data'] = $this->M_uangkas->getUangKasByID($id);
        return view('UangKas/V_Edit', $data);
    }

    function save()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');
        // debug($_POST);

        $tanggal    = $this->request->getPost('tanggal');
        $keterangan = $this->request->getPost('keterangan');
        $uang       = $this->request->getPost('uang');

        try {
            $data = [
                'tanggal'   =>  $tanggal,
                'keterangan'   =>  $keterangan,
                'uang'   =>  $uang,
            ];

            $this->verifikasiInputUangKas($data);

            $insert = $this->M_uangkas->insertUangKas($data);

            return redirect()->to('uang_kas');
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    function update()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');

        $tanggal    = $this->request->getPost('tanggal');
        $keterangan = $this->request->getPost('keterangan');
        $uang       = $this->request->getPost('uang');
        
        $id         = $this->request->getPost('id');
        $id         = simple_decrypt($id);

        try {
            if(!$id) throw new \Exception("Invalid ID", 1);
            
            $data = [
                'tanggal'   =>  $tanggal,
                'keterangan'   =>  $keterangan,
                'uang'   =>  $uang,
            ];

            $this->verifikasiInputUangKas($data);

            $update = $this->M_uangkas->updateUangKasByID($data, $id);

            return redirect()->to('uang_kas');
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    function delete()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');
        
        $id = $this->request->getGet('id');
        $id = simple_decrypt($id);
        if (!$id) {
            die("Invalid ID");
        }

        $delete = $this->M_uangkas->deleteKasByID($id);

        return redirect()->to('uang_kas');
    }

    function verifikasiInputUangKas($data)
    {
        if(!$data['tanggal'] && !validateDate($data['tanggal']))
            throw new \Exception("Invalid Date", 1);
            
        if(!$data['keterangan'])
            throw new \Exception("Keterangan Tidak Boleh Kosong", 1);
            
        if(!$data['uang'] && !is_numeric($data['uang']))
            throw new \Exception("Invalid Nominal Uang", 1);
    }
}
