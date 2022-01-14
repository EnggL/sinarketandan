<?php
use App\Models\M_login;

function cek_session_login()
{
	if(session()->username){
		$username = session()->username;
		$password = session()->password;

		return login($username, $password);
	}

	return false;
}

function login($username, $password)
{
	$M_login = new M_login();

	try {
		if(!$username || !$password) throw new \Exception("Username atau Password Kosong!", 1);
		$akun = $M_login->getAkunByUsername($username);
		if(!$akun) throw new \Exception("Username tidak di temukan!", 1);
		if(!password_verify($password, $akun->password)) throw new \Exception("Password Salah!", 1);

		$data['username'] = $username;
		$data['akun_id'] = $akun->id;
		$data['password'] = $password;
		$data['display_name'] = $akun->display_name;
		$data['hak_akses'] = $M_login->getHakAksesAkunByAkunID($akun->id);

		session()->set($data);

		return true;
	} catch (\Exception $e) {
		return false;
	}
}

function cekHakAkses($hak_akses)
{
	/*hak_akses string*/
	$inSession = cek_session_login();
	$list_hak_akses = session()->hak_akses;

	return ($inSession && in_array($hak_akses, $list_hak_akses)) ?: false;
}