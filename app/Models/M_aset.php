<?php 
namespace App\Models;
use CodeIgniter\Model;

class M_aset extends Model
{
	
	function __construct()
	{
		$this->db = \Config\Database::connect('default', false);
		$this->tb_aset = $this->db->table('aset_pemuda');
		$this->tb_history_aset = $this->db->table('history_pinjam_aset');

	}

	function getAllAsetPemuda()
	{
		$this->tb_aset->orderBy('nama_aset');
		$query = $this->tb_aset->get()->getResult();
		return $query;
	}

	function getAsetPemudaByID($id)
	{
		$this->tb_aset->where('id', $id);
		$query = $this->tb_aset->get()->getRow();
		return $query;
	}

	function getAllHistoryPeminjaman()
	{
		$sql = "SELECT h.*, a.nama_aset, a.satuan_aset from history_pinjam_aset h
				left join aset_pemuda a on a.id = h.aset_id order by h.dari";
		return $this->db->query($sql)->getResult();
	}

	function getHistoryPeminjamanByID($id)
	{
		$sql = "SELECT h.*, a.nama_aset, a.satuan_aset from history_pinjam_aset h
				left join aset_pemuda a on a.id = h.aset_id
				where h.id = ?";
		return $this->db->query($sql, [$id])->getRow();
	}

	function insertAset($data)
	{
		$this->tb_aset->insert($data);
		return $this->db->affectedRows();
	}

	function getAsetByID($id)
	{
		$this->tb_aset->where('id', $id);
		return $this->tb_aset->get()->getRow();
	}

	function deleteAsetByID($id)
	{
		$this->tb_aset->where('id', $id);
		$this->tb_aset->delete();

		return $this->db->affectedRows();
	}

	function updateAset($data, $id)
	{
		$this->tb_aset->where('id', $id);
		$this->tb_aset->update($data);

		return $this->db->affectedRows();
	}

	function insertHistoryAset($data)
	{
		$this->tb_history_aset->insert($data);
		return $this->db->affectedRows();
	}

	function updeteHistoryAset($data, $id)
	{
		$this->tb_history_aset->where('id', $id);
		$this->tb_history_aset->update($data);
		return $this->db->affectedRows();
	}

	function deleteHistory($id)
	{
		$this->tb_history_aset->where('id', $id);
		$this->tb_history_aset->delete();
		return $this->db->affectedRows();
	}

	function updateNullKembali($id)
	{
		$this->tb_history_aset->where('id', $id);
		$this->tb_history_aset->set('sampai', NULL);

		return $this->db->affectedRows();
	}
}