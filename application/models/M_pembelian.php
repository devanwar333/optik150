<?php
class M_pembelian extends CI_Model
{

	function simpan_pembelian($nofak, $tglfak, $suplier)
	{

		$this->db->query("INSERT INTO tbl_beli (beli_nofak,beli_tanggal,beli_suplier_id,status) VALUES ('$nofak','$tglfak','$suplier','COMPLETE')");
		foreach ($this->cart->contents() as $item) {
			$data = array(
				'd_beli_nofak' 		=>	$nofak,
				'd_beli_barang_id'	=>	$item['id'],
				'd_beli_barang_nama' => $item['name'],
				'd_beli_harga'		=>	$item['price'],
				'd_beli_jumlah'		=>	$item['qty'],
				'd_beli_total'		=>	$item['subtotal'],
				'keterangan'		=>  $item['keterangan']
			);
			$this->db->insert('tbl_detail_beli', $data);
			$this->db->query("update tbl_barang set barang_stok=barang_stok+'$item[qty]',barang_harpok='$item[price]' where barang_id='$item[id]'");
			log_message('error', 'simpan_pembelian - '. $item['id'].'-'.$item['qty']);

		}
		return true;
	}

	function get_kobel()
	{
		$q = $this->db->query("SELECT MAX(RIGHT(beli_nofak,6)) AS kd_max FROM tbl_beli");
		$kd = "";
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $k) {
				$tmp = ((int)$k->kd_max) + 1;
				$kd = sprintf("%06s", $tmp);
			}
		} else {
			$kd = "000001";
		}
		return "Bl-" . $kd;
	}

	
	function get_history_pembelian_by_nofak($id) 
	{
		return $this->db->select('*')->from('tbl_beli')->where('beli_nofak', $id)->get()->row();
	}

	function get_detail_pembelian_by_nofak($id)
	{
		$data = $this->db->select('*')
		->from('tbl_detail_beli')
		->where('d_beli_nofak', $id)
		->join('tbl_beli', 'tbl_beli.beli_nofak=tbl_detail_beli.d_beli_nofak')
		->join('tbl_suplier', 'tbl_suplier.suplier_id = tbl_beli.beli_suplier_id')
		->join('tbl_barang', 'tbl_barang.barang_id=tbl_detail_beli.d_beli_barang_id')
		->get()->result_array();
		return $data;
	}

	function update_pembelian_by_nofak($id, $data)	{
		$this->db->where('beli_nofak', $id);
		$this->db->update('tbl_beli', $data);
		return $this->db->affected_rows();

	}
}
