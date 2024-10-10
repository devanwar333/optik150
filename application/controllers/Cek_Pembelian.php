<?php
class Cek_Pembelian extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_laporan');
        $this->load->model('m_setting');
    }

    function index(){
        
        
        $data = [];

		$this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('cek_pembelian/index', $data);
		$this->load->view('template/footer', $data);
    }

    function cetak_cek_pembelian()
    {
        

        $data = [];
        $start = $this->input->post('tgl1');
        $end = $this->input->post('tgl2');
        $namabarang = $this->input->post('nama') ?? '';
        $keterangan = $this->input->post('keterangan') ?? '';
        
        
        if($namabarang == "") {
            $namabarang == "%%";
        } else {
            $namabarang = str_replace('*','%',$namabarang);
        }

        if($keterangan == "") {
            $keterangan == "%%";
        } else {
            $keterangan = str_replace('*','%',$keterangan);
        }
        
        
        $data['start'] = $start;
        $data['end'] = $end;
        
        $setting = $this->m_setting->get_setting_by_name("Nama Toko");
        $data['nama_toko'] = $setting==null ? "" : $setting->fitur;
        
        $result = $this->m_laporan->cetak_cek_pembelian($start, $end, $namabarang, $keterangan);
    
        $data['data'] = $result;
        
        $this->load->view('cek_pembelian/cetak_cek_pembelian', $data);
    }

}