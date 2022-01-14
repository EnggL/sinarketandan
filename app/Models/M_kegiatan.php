<?php 
namespace App\Models;
use CodeIgniter\Model;

class M_kegiatan extends Model
{
	
	function __construct()
	{
		$this->db = \Config\Database::connect('default', false);
		$this->tb_kegiatan = $this->db->table('kegiatan');
		$this->tb_kegiatan_peserta = $this->db->table('kegiatan_peserta');
		$this->tb_saran = $this->db->table('kegiatan_saran');
		$this->tb_lampiran = $this->db->table('kegiatan_lampiran');
	}

	function getAllKegiatan()
	{
		$this->tb_kegiatan->orderBy('waktu_mulai', 'DESC');
		return $this->tb_kegiatan->get()->getResult();
	}

	function getAllKegiatanHome()
	{
		$this->tb_kegiatan->orderBy('waktu_mulai', 'DESC');
		$this->tb_kegiatan->limit(5);;
		return $this->tb_kegiatan->get()->getResult();
	}

	function getAllKegiatanFilterTgl()
	{
		return $this->filterTanggal(
			$this->getAllKegiatan()
		);
	}

	function filterTanggal($data)
	{
		foreach ($data as $key) {
			$mulai 		= $key->waktu_mulai;
			$selesai 	= $key->waktu_selesai;

			if ($selesai) {
				$tgl_mulai = date("ymd", strtotime($mulai));
				$tgl_selesai = date("ymd", strtotime($selesai));
				
				if ($tgl_mulai == $tgl_selesai) {
					$text_sd = date("H:i:s", strtotime($selesai));
				}else{
					$text_sd = date("D", strtotime($selesai)).', '.date("d F Y H:i:s", strtotime($selesai));
				}

				$final_waktu = date("D", strtotime($mulai)).', '.date("d F Y H:i:s", strtotime($mulai)).' s.d.'.$text_sd;
			}else{
				$final_waktu = date("D", strtotime($mulai)).', '.date("d F Y H:i:s", strtotime($mulai));
			}

			$key->final_waktu = monthEngToInd(
				dayEngSingkatToInd($final_waktu)
			);

			$new_data[] = $key;
		}

		return $new_data;
	}

	function getKegiatanByID2($id)
	{
		$this->tb_kegiatan->where('id_kegiatan', $id);
		$data = $this->tb_kegiatan->get()->getRow();

		return $data;
	}

	function getKegiatanByID($id)
	{
		$this->tb_kegiatan->where('id_kegiatan', $id);
		$data = $this->tb_kegiatan->get()->getResult();

		return count($data) ? $this->filterTanggal($data)[0]:[];
	}

	function insertKegiatan($data)
	{
		$this->tb_kegiatan->insert($data);
		return $this->db->insertID();
	}

	function insertPesertaKegiatanBatch($data)
	{
		$this->tb_kegiatan_peserta->insertBatch($data);
	}

	function getPesertaKegiatan($id)
	{
		$sql = "select
					*
				from
					kegiatan_peserta kp
				left join daftar_anggota da on
					da.id = kp.id_anggota
				where
					id_kegiatan = $id
				order by case when waktu_hadir is null then 1 else 0 end,
				approved ;";
		return $this->db->query($sql)->getResult();
	}

	function getPesertaKegiatanFilterNama($id, $text)
	{
		$text = strtoupper($text);
		$sql = "select
					*
				from
					kegiatan_peserta kp
				left join daftar_anggota da on
					da.id = kp.id_anggota
				where
					id_kegiatan = $id
					and kp.waktu_hadir is null
					and da.nama like '%$text%';";
		return $this->db->query($sql)->getResult();
	}

	function getPesertaKegiatanListID($id)
	{
		$data = $this->getPesertaKegiatan($id);
		return array_column($data, 'id_anggota');
	}

	function updateKegiatan($data, $id)
	{
		$this->tb_kegiatan->where('id_kegiatan', $id);
		$this->tb_kegiatan->update($data);
		return $this->db->affectedRows();
	}

	function deletePesertaNotIn($list_peserta_id, $id_kegiatan)
	{
		$this->tb_kegiatan_peserta->where('id_kegiatan', $id_kegiatan);
		$this->tb_kegiatan_peserta->whereNotIn('id_peserta', $list_peserta_id);
		$this->tb_kegiatan_peserta->delete();

		return $this->db->affectedRows();
	}

	function cekPesertaKegiatan($id_peserta, $id_kegiatan)
	{
		$this->tb_kegiatan_peserta->where('id_kegiatan', $id_kegiatan);
		$this->tb_kegiatan_peserta->where('id_peserta', $id_peserta);

		return $this->tb_kegiatan_peserta->get()->getRow();
	}

	function updateNullWaktuSelesai($id)
	{
		$this->tb_kegiatan->where('id_kegiatan', $id);
		$this->tb_kegiatan->set('waktu_selesai', NULL);
		return $this->db->affectedRows();
	}

	function deleteKegiatanByID($id)
	{
		$this->tb_kegiatan->where('id_kegiatan', $id);
		$this->tb_kegiatan->delete();

		return $this->db->affectedRows();
	}

	function insertSaran($data)
	{
		$this->tb_saran->insert($data);
		return $this->db->affectedRows();
	}

	function getAllSaranByKegiatanID($id_kegiatan)
	{
		$this->tb_saran->where('id_kegiatan', $id_kegiatan);
		return $this->tb_saran->get()->getResult();
	}

	function insertLampiran($data)
	{
		$this->tb_lampiran->insert($data);
		return $this->db->affectedRows();
	}

	function getAllLampiranByKegiatanID($id_kegiatan)
	{
		$this->tb_lampiran->where('id_kegiatan', $id_kegiatan);
		return $this->tb_lampiran->get()->getResult();
	}

	function deleteImageByID($id)
	{
		$this->tb_lampiran->where('id', $id);
		$this->tb_lampiran->delete();

		return $this->db->affectedRows();
	}

	function deleteSaranByID($id)
	{
		$this->tb_saran->where('id', $id);
		$this->tb_saran->delete();

		return $this->db->affectedRows();
	}

	function updatePesertaByID($data, $id_peserta)
	{
		$this->tb_kegiatan_peserta->where('id_peserta', $id_peserta);
		$this->tb_kegiatan_peserta->update($data);

		return $this->db->affectedRows();
	}

	function getPesertaByID($id_peserta)
	{
		$this->tb_kegiatan_peserta->where('id_peserta', $id_peserta);
		return $this->tb_kegiatan_peserta->get()->getRow();
	}
}