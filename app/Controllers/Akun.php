<?php

namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\M_akun;
use App\Models\M_login;

class Akun extends BaseController
{
    function __construct()
    {
        helper(['ceksesi', 'renderHTML', 'enkripsi']);
        $this->request = service('request');
        $this->M_akun = new M_akun();
        $this->M_login = new M_login();
        $this->parser = \Config\Services::parser();

        $this->js = [
            'akun.js'
        ];

        define('AKSES', 'akun');
        
    }

    public function index()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');

        $data['title'] = 'Pengaturan Akun';
        $data['js'] = $this->js;
        $data['list'] = $this->M_akun->getAllAkun();
        $data['list_render'] = $this->filterArrayAkun($data['list']);
        $data['render'] = $this->parser->setData($data)->render('Akun/V_Render');

        // debug($data['render']);
        renderHTML('Akun/V_Index', $data);
    }

    function filterArrayAkun($data)
    {
        if(!$data) return [];
        $x = 0;
        foreach ($data as $key) {
           $new_data[$x++]['id'] = simple_encrypt($key->id);
        }

        return $new_data;
    }

    function delete()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');

        if(!$_POST) return redirect()->to('akun');

        $id = $this->request->getPost('id');
        $id = simple_decrypt($id);
        try {
            if(!$id) throw new \Exception("Invalid ID", 1);

            $deleteAkses = $this->M_akun->deleteHakAksesByAkun(['akun_id' => $id]);
            if(!$deleteAkses) throw new \Exception("Gagal Delete Akses", 1);

            $deleteAkun = $this->M_akun->deleteAkun(['id' => $id]);
            if(!$deleteAkun) throw new \Exception("Gagal Delete Akun", 1);
           
           $ret['error'] = 0;
            $ret['desc'] = "Berhasil Hapus Akun"; 
        } catch (\Exception $e) {
            $ret['error'] = 1;
            $ret['desc'] = $e->getMessage();
        }

        echo json_encode($ret);
    }

    function modal_add()
    {
        $data['list_akses'] = $this->M_akun->getAllHakAkses();
        return view('Akun/V_Add', $data);
    }

    function save()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');

        try {
            $this->verifikasiInputAkun();

            $username = $this->request->getPost('username');
            $name = $this->request->getPost('name');
            $password = $this->request->getPost('password');
            $hak_akses = $this->request->getPost('hak_akses');
            
            $data_akun = [
                'username'      =>  $username,
                'display_name'  =>  $name,
                'password'      =>  password_hash($password, PASSWORD_DEFAULT),
            ];

            $id_akun = $this->M_akun->saveAkun($data_akun);

            $this->insertHakAkses($hak_akses, $id_akun);

            return redirect()->to('akun');
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            die($msg);
        }
    }

    function insertHakAkses($data, $id_akun)
    {
        if (!$data) return false;

        foreach ($data as $key) {
            $array = [
                'akun_id'   =>  $id_akun,
                'hak_akses' =>  $key,
            ];

            $this->M_akun->insertHakAksesAkun($array);
        }

        return true;
    }

    function validasiUsername($username)
    {
        return $username && preg_match('/^[a-zA-Z0-9]{3,}$/', $username);
    }

    function verifikasiInputAkun()
    {
        $username = $this->request->getPost('username');
        if(!$this->validasiUsername($username))
            throw new \Exception("Invalid Username", 1);

        $name = $this->request->getPost('name');
        if(!$name)
            throw new \Exception("Invalid Display Name", 1);

        $password = $this->request->getPost('password');
        if(!$password)
            throw new \Exception("Invalid Display Password", 1);
    }

    function verifikasiInputAkun2()
    {
        $username = $this->request->getPost('username');
        if(!$this->validasiUsername($username))
            throw new \Exception("Invalid Username", 1);

        $name = $this->request->getPost('name');
        if(!$name)
            throw new \Exception("Invalid Display Name", 1);
    }

    function modal_edit()
    {
        $id = $this->request->getGet('id');
        $id = simple_decrypt($id);
        if(!$id) die("Data tidak di temukan!");

        $data['akun'] = $this->M_akun->getAkunByID($id);
        $data['hak_akses'] = $this->M_login->getHakAksesAkunByAkunID($id);
        $data['list_akses'] = $this->M_akun->getAllHakAkses();
        // debug($data);
        return view('Akun/V_Edit', $data);
    }

    function update()
    {
        if(!cekHakAkses(AKSES)) return redirect()->to('logout');

        try {
            $this->verifikasiInputAkun2();

            $username = $this->request->getPost('username');
            $name = $this->request->getPost('name');
            $password = $this->request->getPost('password');
            $hak_akses = $this->request->getPost('hak_akses');
            $id = $this->request->getPost('id');

            $id = simple_decrypt($id);
            if(!$id) throw new \Exception("Invalid ID", 1);
            
            $data_akun = [
                'username'      =>  $username,
                'display_name'  =>  $name,
            ];
            if($password)
                $data_akun['password'] = password_hash($password, PASSWORD_DEFAULT);

            $update = $this->M_akun->updateAkunByID($data_akun, $id);

            $where['akun_id'] = $id;
            $this->M_akun->deleteHakAksesByAkun($where);
            $this->insertHakAkses($hak_akses, $id);

            return redirect()->to('akun');
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            die($msg);
        }
    }
}
