<?php 
namespace App\Models;
use CodeIgniter\Model;

class M_uangkas extends Model
{
	
	function __construct()
	{
		$this->db = \Config\Database::connect('default', false);
		$this->tb_kas = $this->db->table('uang_kas');
	}

	function getAllUangKas()
	{
		$this->tb_kas->orderBy('tanggal', 'desc');
		$query = $this->tb_kas->get()->getResult();
		return $query;
	}

	function getUangKasByID($id)
	{
		$this->tb_kas->where('id', $id);
		return $this->tb_kas->get()->getRow();
	}

	function getTotalUangKas()
	{
		$sql = "SELECT sum(uang) total from uang_kas";
		return $this->db->query($sql)->getRow()->total;
	}

	function insertUangKas($data)
	{
		$this->tb_kas->insert($data);

		return $this->db->affectedRows();
	}

	function updateUangKasByID($data, $id)
	{
		$this->tb_kas->where('id', $id);
		$this->tb_kas->update($data);

		return $this->db->affectedRows();
	}

	function deleteKasByID($id)
	{
		$this->tb_kas->where('id', $id);
		$this->tb_kas->delete();

		return $this->db->affectedRows();
	}

	function getJumlahUangKasPerBulan($periode)
	{
		/*periode ex: 2021-01*/
		$sql = "SELECT
					ifnull(sum(uang), 0) uang
				from
					uang_kas uk
				where
					DATE_FORMAT(tanggal , '%Y-%m') = '$periode'";
		return $this->db->query($sql)->getRow()->uang;
	}
}