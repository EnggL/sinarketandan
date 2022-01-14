<?php

namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\M_login;

class Login extends BaseController
{
    function __construct()
    {
        helper(['ceksesi', 'renderHTML', 'enkripsi']);
        $this->request = service('request');
        $this->M_login = new M_login();
    }

    public function index()
    {
        // echo password_hash('1234567897', PASSWORD_DEFAULT);exit();
        if(session()->username) return redirect()->to('dashboard');

        return view('V_Login');
    }

    function auth()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        try {
            if(!login($username, $password)) throw new \Exception("Username atau Password Salah", 1);
            

            return redirect()->to('dashboard');
        } catch (\Exception $e) {
            session()->setFlashdata('alert', $e->getMessage());
            return redirect()->to('login');
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('dashboard');
    }
}
