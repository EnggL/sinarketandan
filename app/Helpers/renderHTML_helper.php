<?php
function renderHTML($view, $param)
{
	$parser = \Config\Services::parser();
	
	$data['title'] = isset($param['title']) ? $param['title']: '';
	$data['submenu'] = isset($param['submenu']) ? $param['submenu']: [];
	$data['js'] = isset($param['js']) ? $param['js']: [];
	$data['list_menu'] = list_submenu();

	$data['content'] = view($view, $param);

	echo view('V_Template_NiceAdmin', $data);
}

function list_submenu()
{
	$data = [
		[
			'name' => 'Daftar Anggota',
			'link' => 'daftar_anggota',
			'icon' => 'bi bi-person'
		],
		[
			'name' => 'Aset Pemuda',
			'link' => 'aset-pemuda',
			'icon' => 'bi bi-clipboard-check'
		],
		[
			'name' => 'Uang Kas',
			'link' => 'uang_kas',
			'icon' => 'bi bi-cash-coin'
		],
		[
			'name' => 'Kegiatan',
			'link' => 'kegiatan',
			'icon' => 'bi bi-calendar-check'
		]
	];

	$hak_akses = session()->hak_akses ?: [];/*array*/
	if(in_array('akun', $hak_akses)){
		$data[] = [
			'name' => 'Pengaturan Akun',
			'link' => 'akun',
			'icon' => 'bi bi-person-check'
		];
	}

	return $data;
}

function debug($data)
{
	echo "<pre>";
	print_r($data);
	exit;
}