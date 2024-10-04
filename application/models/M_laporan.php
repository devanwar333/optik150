<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_laporan extends CI_Model
{
	private $tb_jual = "tbl_jual";

	function get_stok_barang()
	{
		$hsl = $this->db->query("SELECT kategori_id,kategori_nama,barang_nama,barang_stok FROM tbl_kategori JOIN tbl_barang ON kategori_id=barang_kategori_id GROUP BY kategori_id,barang_nama");
		return $hsl;
	}
	// task ahmad
	function get_data_barang()
	{

		$hsl = $this->db->query("SELECT kategori_id,barang_id,kategori_nama,barang_nama,barang_satuan,barang_harjul,barang_stok FROM tbl_kategori JOIN tbl_barang ON kategori_id=barang_kategori_id GROUP BY kategori_id,barang_nama");
		return $hsl;
	}
	function get_data_barang_by($input_kategori, $input_barang)
	{
		$this->db->select('*');
		$this->db->from('tbl_kategori');
		if (!$input_kategori) {
			$this->db->where('kategori_nama', $input_kategori);
		}
		if (!$input_barang) {
			$this->db->where('barang_nama', $input_barang);
		}
		$this->db->join('tbl_barang', 'tbl_barang.barang_kategori_id=tbl_kategori.kategori_id');
		// $this->db->group_by('kategori_id,barang_nama');
		$res = $this->db->get()->result_array();
		return $res;
	}

	function total_penjualan($start, $end)
	{
		$res =	$this->db->select('*,sum(jual_total) as total_semua')->from($this->tb_jual)->where('DATE(jual_tanggal) >=', $start)->where('DATE(jual_tanggal) <=', $end)->get()->result();
		return $res;
	}
	function penjualan_by_metode($start, $end)
	{
		$this->db->select('*,sum(jual_jml_uang) as total_semua,sum(jual_jml_uang2) as total_semua2');
		$this->db->from($this->tb_jual);
		$this->db->where('DATE(jual_tanggal) >=', $start);
		$this->db->where('DATE(jual_tanggal) <=', $end);
		// $this->db->group_by(array('jual_keterangan', 'jual_keterangan2'));
		$this->db->group_by(array("jual_keterangan", "jual_keterangan"));
		$res = $this->db->get()->result();
		return $res;
	}

	// task ahmad
	function get_lap_hutang_karyawan()
	{
		return $this->db->query("SELECT a.id AS id_karyawan, a.nama AS nama_karyawan , b.nominal, b.jumlah_bayar, b.keterangan, b.status, b.tanggal FROM karyawan a LEFT JOIN hutang_karyawan b ON a.id=b.id_karyawan WHERE b.status='BelumLunas'");
	}

	function get_data_penjualan()
	{
		$hsl = $this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
		return $hsl;
	}

	function get_total_penjualan()
	{
		$hsl = $this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,jual_total,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,sum(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak ORDER BY jual_nofak DESC");
		return $hsl;
	}

	// Laporan penjualan per periode
	function get_data_jual_periode($tanggal1, $tanggal2, $nama_customer, $nama_barang)
	{
		if ($nama_customer == "" && $nama_barang == "") {
			$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_customer.nama FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' ORDER BY jual_nofak DESC");
		} elseif ($nama_customer == "") {
			$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_customer.nama FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_detail_jual.d_jual_barang_id='$nama_barang' ORDER BY jual_nofak DESC");
		} elseif ($nama_barang == "") {
			$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_customer.nama FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.no_hp='$nama_customer' ORDER BY jual_nofak DESC");
		} else {
			$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_customer.nama FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_customer.no_hp='$nama_customer' AND tbl_detail_jual.d_jual_barang_id='$nama_barang' ORDER BY jual_nofak DESC");
		}
		return $hsl;
	}
	function laporan_penjualan_kasir($tanggal1, $tanggal2,$id_customer)
	{
		$query = "SELECT jual_nofak, tbl_customer.nama, tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,sum(tbl_detail_jual.d_jual_total) as total, tbl_jual.jual_keterangan , tbl_jual.jual_keterangan2 FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak and tbl_jual.status in ('COMPLETE','KREDIT','DP') JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND cabang=''";
		if($id_customer!="") {
			$query .= " AND tbl_customer.id =".$id_customer;
		}
		$query .= " GROUP BY jual_nofak";
		$query .= " ORDER BY jual_nofak asc";
		$hsl = $this->db->query($query);
		return $hsl;
	}

	function laporan_penjualan_kasir_all($tanggal1, $tanggal2,$nama_barang,$nama_customer,$kategori_brg,$cara_bayar)
	{
		$query = "SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_customer.nama FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND cabang=''";
		if($nama_barang != ""){
			$query .= "  AND tbl_detail_jual.d_jual_barang_id='$nama_barang'";
		}
		if($nama_customer != ""){
			$query .= " AND tbl_customer.no_hp='$nama_customer' ";
		}
		if($kategori_brg != ""){
			$query .= "  AND tbl_detail_jual.d_jual_barang_kat_id='$kategori_brg'";
		}
		if($cara_bayar != ""){
			$query .= " AND (tbl_jual.jual_keterangan='$cara_bayar' OR tbl_jual.jual_keterangan2='$cara_bayar')";
		}
		$query .= " ORDER BY jual_nofak DESC";
		$hsl = $this->db->query($query);
		return $hsl;
	}
	function laporan_penjualan_kasir_customer($tanggal1, $tanggal2, $nama_customer)
	{
		if ($nama_customer == "") {
			$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_customer.nama FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND cabang='' ORDER BY jual_nofak DESC");
		} else {
			$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_customer.nama FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_customer.no_hp='$nama_customer' AND cabang='' ORDER BY jual_nofak DESC");
		}

		return $hsl;
	}
	function laporan_penjualan_kasir_barang($tanggal1, $tanggal2, $nama_barang)
	{
		if ($nama_barang == "") {
			$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_customer.nama FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND cabang='' ORDER BY jual_nofak DESC");
		} else {
			$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_customer.nama FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_detail_jual.d_jual_barang_nama='$nama_barang' AND cabang='' ORDER BY jual_nofak DESC");
		}

		return $hsl;
	}
	function laporan_penjualan_kasir_cara_bayar($tanggal1, $tanggal2, $cara_bayar = "all")
	{
		if ($cara_bayar == "all") {
			$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_customer.nama,tbl_jual.jual_keterangan,tbl_jual.jual_keterangan2 FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND cabang='' ORDER BY jual_nofak DESC");
		} else {

			$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_customer.nama,tbl_jual.jual_keterangan,tbl_jual.jual_keterangan2  FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND (tbl_jual.jual_keterangan='$cara_bayar' OR tbl_jual.jual_keterangan2='$cara_bayar') AND cabang='' ORDER BY jual_nofak DESC");
		}

		return $hsl;
	}
	function laporan_penjualan_kasir_kategori_barang($tanggal1, $tanggal2, $kategori = "")
	{
		if ($kategori == "") {

			$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_customer.nama,tbl_jual.jual_keterangan,tbl_jual.jual_keterangan2,tbl_detail_jual.d_jual_barang_kat_id FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND cabang='' ORDER BY jual_nofak DESC");
		} else {
			$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_customer.nama,tbl_jual.jual_keterangan,tbl_jual.jual_keterangan2,tbl_detail_jual.d_jual_barang_kat_id  FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_detail_jual.d_jual_barang_kat_id='$kategori' AND cabang='' ORDER BY jual_nofak DESC");
		}

		return $hsl;
	}
	function get_penjualan_kasir_dp($tanggal1, $tanggal2)
	{
		
		$query = "select tbl_resume.resume_nofak as jual_nofak, tbl_customer.nama, DATE_FORMAT(tbl_jual.jual_tanggal,'%d %M %Y') as jual_tanggal, tbl_jual.jual_total, (select sum(amount) from tbl_resume where resume_nofak=tbl_jual.jual_nofak ) as total_pembayaran,(select created_at from tbl_resume as tr where resume_nofak= tbl_jual.jual_nofak order by created_at desc limit 1) as tgl_pelunasan from tbl_resume inner join tbl_jual on tbl_jual.jual_nofak=tbl_resume.resume_nofak and tbl_jual.tipe='DP' inner join tbl_customer on tbl_customer.no_hp=tbl_jual.no_hp where DATE(tbl_resume.created_at) >='$tanggal1' and DATE(tbl_resume.created_at)<='$tanggal2' group by tbl_resume.resume_nofak";

	
		$query .= " ORDER BY tbl_jual.jual_nofak asc";

		$hsl = $this->db->query($query);
		
		return $hsl;
	}
	function get_penjualan_dp($tanggal1, $tanggal2, $nama_customer, $nama_barang, $kategori_brg = "")
	{
		$query = "SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_customer.nama,tbl_detail_jual.d_jual_barang_kat_id FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.status='DP'";

		if ($nama_customer != "") {
			$query .= " AND tbl_jual.no_hp='$nama_customer'";
		}

		if ($nama_barang != "") {
			$query .= " AND tbl_detail_jual.d_jual_barang_id='$nama_barang'";
		}

		if ($kategori_brg != "") {
			$query .= " AND tbl_detail_jual.d_jual_barang_kat_id='$kategori_brg'";
		}

		$query .= " ORDER BY jual_nofak DESC";
		$hsl = $this->db->query($query);
		return $hsl;
	}
	function get_penjualan_cabang_cetak($tanggal1, $tanggal2, $cabang)
	{
		$query = "SELECT jual_nofak,cabang,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal, tbl_jual.jual_keterangan, tbl_jual.jual_keterangan2 ,sum(d_jual_total) as  total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND cabang!=''";
		if ($cabang != "") {
			$query .= " AND tbl_jual.cabang='$cabang'";
		}
		$query .= " GROUP BY jual_nofak";
		$query .= " ORDER BY cabang asc, jual_nofak asc ";
		$hsl = $this->db->query($query);
	
		return $hsl;
	}
	function get_penjualan_cabang($tanggal1, $tanggal2, $cabang, $nama_barang, $kategori = "")
	{
		$query = "SELECT jual_nofak,cabang,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_detail_jual.d_jual_barang_kat_id FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND cabang!=''";
		if ($cabang != "") {
			$query .= " AND tbl_jual.cabang='$cabang'";
		}

		if ($kategori != "") {
			$query .= " AND tbl_detail_jual.d_jual_barang_kat_id='$kategori'";
		}

		if ($nama_barang != "") {

			$query .= "AND tbl_detail_jual.d_jual_barang_nama='$nama_barang' OR tbl_detail_jual.d_jual_barang_id='$nama_barang'";
		}

		// if ($cabang == "" && $nama_barang == "") {
		// 	$hsl = $this->db->query("SELECT jual_nofak,cabang,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.cabang!='' ORDER BY jual_nofak DESC");
		// } elseif ($cabang == "" && $nama_barang != "") {
		// 	$hsl = $this->db->query("SELECT jual_nofak,cabang,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.cabang!='' AND tbl_detail_jual.d_jual_barang_id='$nama_barang' ORDER BY jual_nofak DESC");
		// } elseif ($nama_barang == "" && $cabang != "") {
		// 	$hsl = $this->db->query("SELECT jual_nofak,cabang,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.cabang!='' AND tbl_jual.cabang='$cabang' ORDER BY jual_nofak DESC");
		// } elseif ($kategori != "") {
		// 	$hsl = $this->db->query("SELECT jual_nofak,cabang,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_detail_jual.d_jual_barang_kat_id FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.cabang!='' AND tbl_detail_jual.d_jual_barang_kat_id='$kategori' ORDER BY jual_nofak DESC");
		// } elseif ($kategori == "") {
		// 	$hsl = $this->db->query("SELECT jual_nofak,cabang,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total,tbl_detail_jual.d_jual_barang_kat_id FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.cabang!='' AND tbl_detail_jual.d_jual_barang_kat_id='$kategori' ORDER BY jual_nofak DESC");
		// }else {
		// 	$hsl = $this->db->query("SELECT jual_nofak,cabang,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,d_jual_total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.cabang!='' AND tbl_jual.cabang='$cabang' AND tbl_detail_jual.d_jual_barang_id='$nama_barang'  ORDER BY jual_nofak DESC");
		// }
		$hsl = $this->db->query($query);
		return $hsl;
	}
	function get_cabang()
	{
		$this->db->select('*');
		$this->db->from('tbl_jual');
		$this->db->where('cabang !=', '');
		$this->db->group_by('tbl_jual.cabang');
		$res = $this->db->get()->result();
		return $res;
	}
	function listPenjualan_cabang($tanggal1, $tanggal2)
	{
		$this->db->select('*');
		$this->db->from('tbl_jual');
		$this->db->where('jual_tanggal >=', date('Y-m-d', strtotime($tanggal1)));
		$this->db->where('jual_tanggal <=', date('Y-m-d', strtotime($tanggal2)));
		$this->db->where('cabang !=', '');
		$this->db->join('tbl_detail_jual', 'tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak');
		$this->db->join('tbl_barang', 'tbl_detail_jual.d_jual_barang_id=tbl_barang.barang_id');
		$this->db->group_by('tbl_jual.cabang');
		$res = $this->db->get()->result();
		return $res;
	}
	function listPenjualan_cabangBarang($cabang)
	{
		$this->db->select('*');
		$this->db->from('tbl_jual');
		$this->db->where('cabang', $cabang);
		$this->db->join('tbl_detail_jual', 'tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak');
		$this->db->join('tbl_barang', 'tbl_detail_jual.d_jual_barang_id=tbl_barang.barang_id');
		$this->db->group_by('tbl_jual.cabang');
		$res = $this->db->get()->result();
		return $res;
	}

	function get_pembelian($tanggal1, $tanggal2, $supplier, $nama_barang)
	{
		$this->db->select('*');
		$this->db->from('tbl_beli');
		$this->db->where('beli_tanggal >=', date('Y-m-d', strtotime($tanggal1)));
		$this->db->where('beli_tanggal <=', date('Y-m-d', strtotime($tanggal2)));
		$this->db->join('tbl_detail_beli', 'tbl_beli.beli_nofak=tbl_detail_beli.d_beli_nofak');
		$this->db->join('tbl_barang', 'tbl_detail_beli.d_beli_barang_id=tbl_barang.barang_id');
		$this->db->join('tbl_suplier', 'tbl_beli.beli_suplier_id=tbl_suplier.suplier_id');
		if ($supplier) {
			$this->db->where('tbl_beli.beli_suplier_id', $supplier);
		}
		if ($nama_barang) {
			$this->db->where('tbl_detail_beli.d_beli_barang_id', $nama_barang);
		}
		$res = $this->db->get()->result();
		return $res;
	}
	function get_pembelian_cetak($tanggal1, $tanggal2, $supplier)
	{
		$this->db->select("*");
		$this->db->select("sum(tbl_detail_beli.d_beli_total) as total");
		$this->db->from('tbl_beli');
		$this->db->where('beli_tanggal >=', date('Y-m-d', strtotime($tanggal1)));
		$this->db->where('beli_tanggal <=', date('Y-m-d', strtotime($tanggal2)));
		$this->db->join('tbl_detail_beli', 'tbl_beli.beli_nofak=tbl_detail_beli.d_beli_nofak');
		$this->db->join('tbl_barang', 'tbl_detail_beli.d_beli_barang_id=tbl_barang.barang_id');
		$this->db->join('tbl_suplier', 'tbl_beli.beli_suplier_id=tbl_suplier.suplier_id');
		if ($supplier) {
			$this->db->where('tbl_beli.beli_suplier_id', $supplier);
		}
		$this->db->group_by('tbl_beli.beli_nofak'); 
		$this->db->order_by("tbl_suplier.suplier_id", "asc");
		$this->db->order_by("tbl_beli.beli_nofak", "asc");
		$res = $this->db->get()->result();
		return $res;
	}
	function listSupplier_pembelian($tanggal1, $tanggal2)
	{
		$this->db->select('*');
		$this->db->from('tbl_beli');
		$this->db->where('beli_tanggal >=', date('Y-m-d', strtotime($tanggal1)));
		$this->db->where('beli_tanggal <=', date('Y-m-d', strtotime($tanggal2)));
		$this->db->join('tbl_suplier', 'tbl_beli.beli_suplier_id=tbl_suplier.suplier_id');
		$this->db->join('tbl_detail_beli', 'tbl_beli.beli_nofak=tbl_detail_beli.d_beli_nofak');
		$this->db->join('tbl_barang', 'tbl_detail_beli.d_beli_barang_id=tbl_barang.barang_id');
		$this->db->group_by('tbl_beli.beli_suplier_id');
		$res = $this->db->get()->result();
		return $res;
	}
	function listSupplier_pembelianBarang($supplier)
	{
		$this->db->select('*');
		$this->db->from('tbl_beli');
		$this->db->where('beli_suplier_id', $supplier);
		$this->db->join('tbl_suplier', 'tbl_beli.beli_suplier_id=tbl_suplier.suplier_id');
		$this->db->join('tbl_detail_beli', 'tbl_beli.beli_nofak=tbl_detail_beli.d_beli_nofak');
		$this->db->join('tbl_barang', 'tbl_detail_beli.d_beli_barang_id=tbl_barang.barang_id');
		$this->db->group_by('tbl_barang.barang_id');
		$res = $this->db->get()->result();
		return $res;
	}
	function get_pembelian_total($tanggal1, $tanggal2, $supplier, $nama_barang)
	{
		if ($supplier == "" && $nama_barang == "") {
			$hsl = $this->db->query("SELECT beli_nofak,DATE_FORMAT(beli_tanggal,'%d %M %Y') AS beli_tanggal,d_beli_id, d_beli_nofak, d_beli_barang_id, d_beli_harga, d_beli_jumlah, SUM(d_beli_total) as total FROM tbl_beli JOIN tbl_detail_beli ON beli_nofak=d_beli_nofak WHERE DATE(tbl_beli.beli_tanggal) between '$tanggal1' AND '$tanggal2' ORDER BY beli_nofak DESC");
		} elseif ($nama_barang == "") {
			$hsl = $this->db->query("SELECT beli_nofak,DATE_FORMAT(beli_tanggal,'%d %M %Y') AS beli_tanggal,d_beli_id, d_beli_nofak, d_beli_barang_id, d_beli_harga, d_beli_jumlah, SUM(d_beli_total) as total FROM tbl_beli JOIN tbl_detail_beli ON beli_nofak=d_beli_nofak WHERE DATE(tbl_beli.beli_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_beli.beli_suplier_id='$supplier' ORDER BY beli_nofak DESC");
		} elseif ($supplier == "") {
			$hsl = $this->db->query("SELECT beli_nofak,DATE_FORMAT(beli_tanggal,'%d %M %Y') AS beli_tanggal,d_beli_id, d_beli_nofak, d_beli_barang_id, d_beli_harga, d_beli_jumlah, SUM(d_beli_total) as total FROM tbl_beli JOIN tbl_detail_beli ON beli_nofak=d_beli_nofak WHERE DATE(tbl_beli.beli_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_detail_beli.d_beli_barang_id='$nama_barang' ORDER BY beli_nofak DESC");
		} else {
			$hsl = $this->db->query("SELECT beli_nofak,DATE_FORMAT(beli_tanggal,'%d %M %Y') AS beli_tanggal,d_beli_id, d_beli_nofak, d_beli_barang_id, d_beli_harga, d_beli_jumlah, SUM(d_beli_total) as total FROM tbl_beli JOIN tbl_detail_beli ON beli_nofak=d_beli_nofak WHERE DATE(tbl_beli.beli_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_beli.beli_suplier_id='$supplier' AND tbl_detail_beli.d_beli_barang_id='$nama_barang' ORDER BY beli_nofak DESC");
		}
		return $hsl;
	}
	function get_penjualan_kwitansi($tanggal1, $tanggal2)
	{
		$this->db->select('*');
		$this->db->from('tbl_kwitansi');
		$this->db->where('date_created >=', date('Y-m-d', strtotime($tanggal1)));
		$this->db->where('date_created <=', date('Y-m-d', strtotime($tanggal2)));
		$res = $this->db->get()->result();
		return $res;
	}
	function get_penjualan_kwitansi_total($tanggal1, $tanggal2)
	{
		$this->db->select('*');
		$this->db->select_sum('harga_jual');
		$this->db->from('tbl_kwitansi');
		$this->db->where('date_created >=', date('Y-m-d', strtotime($tanggal1)));
		$this->db->where('date_created <=', date('Y-m-d', strtotime($tanggal2)));
		$res = $this->db->get()->row_array(); // Produces: SELECT SUM(age) as age FROM members
		return $res;
	}

	function get_total_penjualan_cabang($tanggal1, $tanggal2, $cabang, $nama_barang)
	{
		if ($cabang == "") {
			$hsl = $this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.cabang!='' AND tbl_detail_jual.d_jual_barang_id='$nama_barang' ORDER BY jual_nofak DESC");
		} elseif ($nama_barang == "") {
			$hsl = $this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.cabang!='' AND tbl_jual.cabang='$cabang' ORDER BY jual_nofak DESC");
		} elseif ($cabang == "" && $nama_barang == "") {
			$hsl = $this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.cabang!='' ORDER BY jual_nofak DESC");
		} else {
			$hsl = $this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.cabang!='' AND tbl_jual.cabang='$cabang' AND tbl_detail_jual.d_jual_barang_id='$nama_barang' ORDER BY jual_nofak DESC");
		}
		return $hsl;
	}
	function get_data__total_jual_periode($tanggal1, $tanggal2, $nama_customer, $nama_barang)
	{
		if ($nama_customer == "" &&  $nama_barang == "") {
			$hsl = $this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(jual_tanggal) between '$tanggal1' AND '$tanggal2' ORDER BY jual_nofak DESC");
		} elseif ($nama_customer == "") {
			$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,tbl_customer.nama,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_detail_jual.d_jual_barang_nama='$nama_barang' ORDER BY jual_nofak DESC");
		} elseif ($nama_barang == "") {
			$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon, SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.no_hp='$nama_customer' ORDER BY jual_nofak DESC");
		} else {
			$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,tbl_customer.nama, SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.no_hp='$nama_customer' AND tbl_detail_jual.d_jual_barang_nama='$nama_barang' ORDER BY jual_nofak DESC");
		}
		return $hsl;
	}
	function get_total_penjualan_dp($tanggal1, $tanggal2, $nama_customer, $nama_barang)
	{
		$query = "SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.status='DP'";

		if ($nama_customer != "") {
			$query .= " AND tbl_jual.no_hp='$nama_customer'";
		}

		if ($nama_barang != "") {
			$query .= " AND tbl_detail_jual.d_jual_barang_nama='$nama_barang'";
		}
		$query .= " ORDER BY jual_nofak DESC";
		// if ($nama_customer == "" &&  $nama_barang == "") {
		// 	$hsl = $this->db->query("SELECT jual_nofak,DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.status='DP' ORDER BY jual_nofak DESC");
		// } elseif ($nama_customer == "") {
		// 	$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_detail_jual.d_jual_barang_nama='$nama_barang' AND tbl_jual.status='DP' ORDER BY jual_nofak DESC");
		// } elseif ($nama_barang == "") {
		// 	$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon, SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.no_hp='$nama_customer' AND tbl_jual.status='DP' ORDER BY jual_nofak DESC");
		// } else {
		// 	$hsl = $this->db->query("SELECT jual_nofak,tbl_jual.no_hp, DATE_FORMAT(jual_tanggal,'%d %M %Y') AS jual_tanggal,d_jual_barang_id,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,d_jual_qty,d_jual_diskon,SUM(d_jual_total) as total FROM tbl_jual JOIN tbl_detail_jual ON tbl_jual.jual_nofak=tbl_detail_jual.d_jual_nofak JOIN tbl_customer ON tbl_jual.no_hp=tbl_customer.no_hp WHERE DATE(tbl_jual.jual_tanggal) between '$tanggal1' AND '$tanggal2' AND tbl_jual.no_hp='$nama_customer' AND tbl_detail_jual.d_jual_barang_nama='$nama_barang' AND tbl_jual.status='DP' ORDER BY jual_nofak DESC");
		// }
		$hsl = $this->db->query($query);
		return $hsl;
	}
	// 

	//  Laporan penjualan per barang
	function get_data_jual_barang($barang)
	{
		return $this->db->query("SELECT a.d_jual_nofak, a.d_jual_barang_id , a.d_jual_barang_nama, a.d_jual_barang_satuan, a.d_jual_barang_harjul, a.d_jual_qty, a.d_jual_diskon, a.d_jual_total,
									b.jual_tanggal,b.jual_nofak FROM tbl_detail_jual a LEFT JOIN tbl_jual b on a.d_jual_nofak = b.jual_nofak WHERE a.d_jual_barang_id='$barang' ORDER BY b.jual_nofak DESC");
	}
	// 

	//  Laporan penjualan per kategori barang
	function get_data_jual_kat_barang($kat_barang)
	{
		return $this->db->query("SELECT a.d_jual_nofak, a.d_jual_barang_id , a.d_jual_barang_nama, a.d_jual_barang_satuan, a.d_jual_barang_harjul, a.d_jual_qty, a.d_jual_diskon, a.d_jual_total,
									b.jual_tanggal,b.jual_nofak FROM tbl_detail_jual a LEFT JOIN tbl_jual b on a.d_jual_nofak = b.jual_nofak WHERE a.d_jual_barang_kat_id='$kat_barang' ORDER BY b.jual_nofak DESC");
	}

	// 

	//=========Laporan Laba rugi============
	function get_lap_laba_rugi($tanggal1, $tanggal2)
	{
		$hsl = $this->db->query("SELECT DATE_FORMAT(jual_tanggal,'%d %M %Y') as jual_tanggal,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,(d_jual_barang_harjul-d_jual_barang_harpok) AS keunt,d_jual_qty,d_jual_diskon,((d_jual_barang_harjul-d_jual_barang_harpok)*d_jual_qty)-(d_jual_qty*d_jual_diskon) AS untung_bersih FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(jual_tanggal) between '$tanggal1' AND '$tanggal2'");
		return $hsl;
	}

	function get_total_lap_laba_rugi($tanggal1, $tanggal2)
	{
		$hsl = $this->db->query("SELECT DATE_FORMAT(jual_tanggal,'%d %M %Y') AS bulan,d_jual_barang_nama,d_jual_barang_satuan,d_jual_barang_harpok,d_jual_barang_harjul,(d_jual_barang_harjul-d_jual_barang_harpok) AS keunt,d_jual_qty,d_jual_diskon,SUM(((d_jual_barang_harjul-d_jual_barang_harpok)*d_jual_qty)-(d_jual_qty*d_jual_diskon)) AS total FROM tbl_jual JOIN tbl_detail_jual ON jual_nofak=d_jual_nofak WHERE DATE(jual_tanggal) between '$tanggal1' AND '$tanggal2'");
		return $hsl;
	}

	function get_laporan_pengeluaran($tanggal1, $tanggal2)
	{
		return $this->db->query("select a.jenis_pengeluaran, a.nominal, a.tanggal, a.keterangan, b.nama from pengeluaran a left join karyawan b
									on a.penerima=b.id where tanggal between '$tanggal1' AND '$tanggal2' order by a.id desc")->result_array();
	}


	function group_by_table($tbl, $col, $as = "")
	{
		// alias
		if ($as == "") {
			return $this->db->query("SELECT $col FROM $tbl GROUP BY $col")->result_array();
		} else {
			return $this->db->query("SELECT $col as $as FROM $tbl GROUP BY $col")->result_array();
		}
	}
	public function queryResume($start, $end)
	{
		$this->db->select('*,sum(amount) as total');
		$this->db->from('tbl_resume');
		$this->db->where('DATE(created_at) >=', $start);
		$this->db->where('DATE(created_at) <=', $end);
		// $this->db->where('method_types !=', "Cash");
		$this->db->group_by('method_types');
		$res = $this->db->get()->result_array();
		return $res;
	}
	public function queryResumePenjualanDPBayar($start, $end)
	{
		$this->db->select('sum(amount) as total');
		$this->db->from('tbl_resume');
		$this->db->join('tbl_jual', 'tbl_jual.jual_nofak=tbl_resume.resume_nofak');
		$this->db->where('DATE(tbl_resume.created_at) >=', $start);
		$this->db->where('DATE(tbl_resume.created_at) <=', $end);
		$this->db->where('tbl_jual.status =', 'DP');
		$this->db->where('tbl_resume.amount >=', 0);
		
		$res = $this->db->get()->row();
	
		return $res;
	}
	public function queryResumePenjualanDPUtang($start, $end)
	{
		$res = $this->db->query("select sum(a.total) as total from (SELECT tbl_jual.jual_total- sum(amount) as total FROM `tbl_resume` inner join tbl_jual on tbl_resume.resume_nofak= tbl_jual.jual_nofak WHERE DATE(created_at)>='$start' and DATE(created_at)<='$end' and tbl_jual.tipe='DP' and tbl_jual.status='DP' group by resume_nofak) as a")->row();
		return $res;
	}
	public function queryResumePenjualan($start, $end)
	{
		$this->db->select('*,sum(tbl_resume.amount) as total');
		$this->db->from('tbl_resume');
		$this->db->where('DATE(tbl_resume.created_at) >=', $start);
		$this->db->where('DATE(tbl_resume.created_at) <=', $end);
		$this->db->where('tbl_resume.amount >=', '0');
		$this->db->where('method_types !=', "");
		$this->db->group_by('method_types');
		$res = $this->db->get()->result_array();
		return $res;
	}
	
	public function queryResumeCash($start, $end)
	{
		$this->db->select('*,sum(amount) as cash');
		$this->db->from('tbl_resume');
		$this->db->where('DATE(created_at) >=', $start);
		$this->db->where('DATE(created_at) <=', $end);
		$this->db->where('method_types', 'Cash');
		$this->db->group_by('method_types');
		$res = $this->db->get()->row_array();
		return $res;
	}
	public function queryPengeluaran($start, $end)
	{
		$this->db->select('*,sum(nominal) as pengeluaran');
		$this->db->from('pengeluaran');
		$this->db->where('DATE(tanggal) >=', $start);
		$this->db->where('DATE(tanggal) <=', $end);
		$res = $this->db->get()->row();
		return $res;
	}

	public function laporan_jumlah_penjualan_kasir($start, $end) 
	{
		$cara_bayar = $this->db->query("
		select DISTINCT cara_bayar from (SELECT DISTINCT tbl_jual.jual_keterangan as cara_bayar FROM tbl_jual
		WHERE Date(tbl_jual.jual_tanggal) between '".$start."' and '".$end."'  and tbl_jual.cabang=''
		GROUP BY tbl_jual.jual_keterangan 
		union 
		select DISTINCT tbl_jual.jual_keterangan2 as cara_bayar from tbl_jual 
		WHERE Date(tbl_jual.jual_tanggal) between '".$start."' and '".$end."'  and tbl_jual.cabang=''
		 group by tbl_jual.jual_keterangan2)
         as data         
		ORDER BY 
			CASE 
				WHEN cara_bayar = 'CASH' THEN 1
				WHEN cara_bayar = 'BANK BCA' THEN 2
				ELSE 3 
			END;")
		->result_array();
		
		$header = ['tanggal'];
		$type = "";
		foreach ($cara_bayar as $key => $value) {
			if($value['cara_bayar'] == "") {
				continue;
			}

			
			$name = strtolower(str_replace(' ', '_', $value['cara_bayar']))."_count";
			$header[] = $name;
			$type .= ",((SELECT COALESCE(SUM(t1.jual_jml_uang),0) FROM tbl_jual t1 WHERE t1.jual_keterangan = '".$value['cara_bayar']."'AND t1.cabang='' AND t1.status='COMPLETE' AND Date(t1.jual_tanggal) = Date(jual.jual_tanggal)) + 
			(SELECT COALESCE(SUM(t1.jual_jml_uang2),0) FROM tbl_jual t1 WHERE t1.jual_keterangan2 = '".$value['cara_bayar']."'AND t1.cabang='' AND t1.status='COMPLETE' AND Date(t1.jual_tanggal) = Date(jual.jual_tanggal)) ) AS ".$name;
		}
		
		$type .= ",((SELECT COALESCE(SUM(t1.jual_jml_uang),0) FROM tbl_jual t1 WHERE t1.status = 'DP' AND t1.cabang='' AND t1.status='COMPLETE' AND Date(t1.jual_tanggal) = Date(jual.jual_tanggal)) + 
		(SELECT COALESCE(SUM(t1.jual_jml_uang2),0) FROM tbl_jual t1 WHERE t1.status = 'DP' AND t1.cabang='' AND t1.status='COMPLETE' AND Date(t1.jual_tanggal) = Date(jual.jual_tanggal)) ) AS DP_count";

		$res = $this->db->query(
			"SELECT Date(jual.jual_tanggal) as tanggal ".$type."
				
			FROM tbl_jual as jual 
			
			WHERE 
			Date(jual.jual_tanggal) between '".$start."' and '".$end."' 
			AND jual.cabang=''
			AND jual.status='COMPLETE'
			GROUP BY 
			Date(jual.jual_tanggal) 
			ORDER BY Date(jual.jual_tanggal)"
		)->result_array();
	
		 $result =[
			'keys' => $header,
			'data' => $res
		 ];
		return $result;
	}

	public function laporan_jumlah_penjualan_barang_kasir($start, $end, $nama_barang, $lgKategoriId) 
	{
		
		
		$dateRange = $this->generateDateRange($start, $end);
		
		$type = "";
		foreach ($dateRange as $key => $value) {
		
			$type .= ",(SELECT count(*) FROM tbl_jual as t1 inner join tbl_detail_jual as t2 on t1.jual_nofak=t2.d_jual_nofak WHERE Date(t1.jual_tanggal) = '".$value."'AND t1.cabang='' AND t1.status='COMPLETE'  AND t2.d_jual_barang_id = d_jual.d_jual_barang_id
				and  if(d_jual.d_jual_barang_kat_id = '".$lgKategoriId."', t2.d_jual_diskon = d_jual.d_jual_diskon, true)
			) as  '".$value."'";
		}
		
		$res = $this->db->query(
			"SELECT DISTINCT d_jual.d_jual_barang_id,
			d_jual.d_jual_barang_nama as nama_barang ,
			if(d_jual.d_jual_barang_kat_id = '".$lgKategoriId."', d_jual.d_jual_diskon, '') as keterangan ".$type."
			FROM  tbl_detail_jual d_jual  
			inner join tbl_jual as jual
			on jual.jual_nofak = d_jual.d_jual_nofak
			WHERE
			jual.cabang=''
			AND jual.status='COMPLETE'
			and
			Date(jual.jual_tanggal) between '".$start."' and '".$end."' 
			and 
			d_jual.d_jual_barang_nama like '".$nama_barang."'		
			GROUP BY 
			d_jual.d_jual_barang_id,
			if(d_jual.d_jual_barang_kat_id = '2', d_jual.d_jual_diskon, '')
			ORDER BY d_jual.d_jual_barang_id"
		)->result_array();
		

		 $result =[
			'keys' => $dateRange,
			'data' => $res
		 ];
		return $result;
	}

	function generateDateRange($startDate, $endDate) {
		$start = new DateTime($startDate);
		$end = new DateTime($endDate);
		$end = $end->modify('+1 day'); // Include the end date in the range
	
		$dateRange = [];
		while ($start < $end) {
			$dateRange[] = $start->format('Y-m-d'); // Format the date as needed
			$start->modify('+1 day'); // Move to the next day
		}
	
		return $dateRange;
	}
}
