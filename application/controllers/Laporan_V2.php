<?php
class Laporan_V2 extends CI_Controller
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
		$this->load->view('laporan_v2/index', $data);
		$this->load->view('template/footer', $data);
    }

    function cetak_penjualan_cabang_v2()
    {
        $start = $this->input->post('tgl1');
        $end = $this->input->post('tgl2');
        $namabarang = $this->input->post('nama') ?? '';
        $kategori_param = $this->input->post('kategori') ?? 'UMUM';

        if($namabarang == "") {
            $namabarang == "%%";
        } else {
            $namabarang = str_replace('*','%',$namabarang);
        }
        
        
        $data['start'] = $start;
        $data['end'] = $end;
        
        $mkategori = $this->m_kategori->getKategoriByName($kategori_param);
		$kategori = 0;
		if($mkategori != null) {
			$kategori = $mkategori->kategori_id;
		}
        $result = $this->m_laporan->laporan_rekap_penjualan($start, $end, $namabarang, $kategori);
        
        $data['data'] = $result;
        $this->load->view('laporan_v2/cetak_rekap_penjualan', $data);
    }

    function cetak_pembelian_cabang_v2()
    {
        $start = $this->input->post('tgl1');
        $end = $this->input->post('tgl2');
        $namabarang = $this->input->post('nama') ?? '';
        $kategori_param = $this->input->post('kategori') ?? 'UMUM';

        if($namabarang == "") {
            $namabarang == "%%";
        } else {
            $namabarang = str_replace('*','%',$namabarang);
        }
        
        
        $data['start'] = $start;
        $data['end'] = $end;
        
        $mkategori = $this->m_kategori->getKategoriByName($kategori_param);
		$kategori = 0;
		if($mkategori != null) {
			$kategori = $mkategori->kategori_id;
		}
        $result = $this->m_laporan->laporan_rekap_pembelian($start, $end, $namabarang, $kategori);
        
        $data['data'] = $result;
        $this->load->view('laporan_v2/cetak_rekap_pembelian', $data);
    }
}