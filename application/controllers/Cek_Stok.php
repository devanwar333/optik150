<?php
class Cek_Stok extends CI_Controller
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
		$this->load->view('cek_stok/index', $data);
		$this->load->view('template/footer', $data);
    }

    function cetak_cek_stok()
    {
        

        $data = [];
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
        
        $setting = $this->m_setting->get_setting_by_name("Nama Toko");
        $data['nama_toko'] = $setting==null ? "" : $setting->fitur;
        
        $result = $this->m_laporan->cetak_cek_stok($start, $end, $namabarang);
    
        $data['data'] = $result;
        
        $this->load->view('cek_stok/cetak_cek_stok', $data);
    }

}