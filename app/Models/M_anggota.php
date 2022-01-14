<?php 
namespace App\Models;
use CodeIgniter\Model;

class M_anggota extends Model
{
	
	function __construct()
	{
		$this->db = \Config\Database::connect('default', false);
		$this->tb_anggota = $this->db->table('daftar_anggota');
	}

	function getAllAnggota()
	{
		$this->tb_anggota->orderBy('nama', 'asc');
		$query = $this->tb_anggota->get();

		return $this->autoNomor($query);
	}

	function getAnggotaByID($id)
	{
		$this->tb_anggota->where('id', $id);
		return $this->tb_anggota->get()->getRow();
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

	function insertAnggota($data)
	{
		$this->tb_anggota->insert($data);
		return $this->db->insertID();
	}

	function updateanggota($data, $id)
	{
		$this->tb_anggota->where('id', $id);
		$this->tb_anggota->update($data);
		return $this->db->affectedRows();
	}

	function deleteAnggota($id)
	{
		$this->tb_anggota->where('id', $id);
		$this->tb_anggota->delete();
		return $this->db->affectedRows();
	}

	function genderAviable()
	{
		return [
			'LAKI-LAKI',
			'PEREMPUAN'
		];
	}
}