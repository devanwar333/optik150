<?php
class Laporan_Kasir extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_laporan');
        $this->load->model('m_setting');
        $this->load->model('m_kategori');
    }

    function index(){
        
        $data= [];
      

		$this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('laporan/kasir/index', $data);
		$this->load->view('template/footer', $data);
    }

    function cetak_penjualan_kasir()
    {

        $start = $this->input->post('tgl1');
        $end = $this->input->post('tgl2');
       
        
        $data['start'] = $start;
        $data['end'] = $end;
        
        $result = $this->m_laporan->laporan_jumlah_penjualan_kasir($start, $end);
        $setting = $this->m_setting->get_setting_by_name("Nama Toko");
        
        $data['nama_toko'] = $setting==null ? "" : $setting->fitur;
        $data['data'] = $result;
        
        $this->load->view('laporan/kasir/cetak_penjualan_kasir', $data);
    
    }

    function cetak_penjualan_barang_kasir()
    {

        $start = $this->input->post('tgl1');
        $end = $this->input->post('tgl2');
        $namabarang = $this->input->post('nama') ?? '';

        if($namabarang == "") {
            $namabarang == "%%";
        } else {
            $namabarang = str_replace('*','%',$namabarang);
        }
        
        
        $data['start'] = $start;
        $data['end'] = $end;
        
        $lgKategori = $this->m_kategori->getKategoriByName("LG");
		$lgKategoriId = 0;
		if($lgKategori != null) {
			$lgKategoriId = $lgKategori->kategori_id;
		}

        $result = $this->m_laporan->laporan_jumlah_penjualan_barang_kasir($start, $end, $namabarang, $lgKategoriId);
        $setting = $this->m_setting->get_setting_by_name("Nama Toko");
        
        $data['nama_toko'] = $setting==null ? "" : $setting->fitur;
        $data['data'] = $result;
       
        $this->load->view('laporan/kasir/cetak_penjualan_barang_kasir', $data);
    
    }
}