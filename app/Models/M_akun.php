<?php 
namespace App\Models;
use CodeIgniter\Model;

class M_akun extends Model
{
	
	function __construct()
	{
		$this->db = \Config\Database::connect('default', false);
		$this->tb_akun = $this->db->table('akun');
		$this->tb_hak_akses = $this->db->table('hak_akses');
	}

	function getAllAkun()
	{
		return $this->tb_akun->get()->getResult();
	}

	function getAkunByID($id)
	{
		return $this->tb_akun->where('id', $id)->get()->getRow();
	}

	function deleteHakAksesByAkun($where)
	{
		/*$where['akun_id'] = id*/
		$this->tb_hak_akses->delete($where);
		return true;
	}

	function deleteAkun($where)
	{
		$this->tb_akun->delete($where);
		return $this->db->affectedRows();
	}

	function getAllHakAkses()
	{
		return [
			'akun',
			'daftar_anggota',
			'aset_pemuda',
			'uang_kas',
			'event',
			'absen',
		];
	}

	function saveAkun($data)
	{
		$this->tb_akun->insert($data);
		return $this->db->insertID();
	}

	function insertHakAksesAkun($data)
	{
		$this->tb_hak_akses->insert($data);
		return $this->db->insertID();
	}

	function updateAkunByID($data_akun, $id)
	{
		$this->tb_akun->where('id', $id);
		$this->tb_akun->update($data_akun);
		return $this->db->affectedRows();
	}
}