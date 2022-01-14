<?php 
namespace App\Models;
use CodeIgniter\Model;

class M_login extends Model
{
	
	function __construct()
	{
		$this->db = \Config\Database::connect('default', false);

		$this->tb_akun = $this->db->table('akun');
		$this->tb_hak_akses = $this->db->table('hak_akses');
	}

	function getAkunByUsername($username)
	{
		$query = $this->tb_akun->where('username', $username)->get()->getRow();
		return $query;
	}

	function autoNomor($query)
	{
		$data = [];
		$x = 1;
		foreach ($query->getResult('array') as $key) {
			$key['nomor'] = $x++;
			$data[] = $key;
		}

		return $data;
	}

	function getHakAksesAkunByAkunID($id)
	{
		$result = $this->tb_hak_akses->where('akun_id', $id)->get()->getResult('array');
		$data = [];
		foreach ($result as $key) {
			$data[] = $key['hak_akses'];
		}
		
		return $data;
	}
}