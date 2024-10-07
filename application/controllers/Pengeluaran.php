<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {

    function __construct(){
		    parent::__construct();
         $this->load->helper('pagination_helper'); // Load the helper
         $this->load->model('M_pengeluaran');  
         $this->load->library('pagination');
    }
    
    function index(){
        $data['title']="Data Pengeluaran Toko"; 
        $search =  $this->input->get('search') ?? "" ;
        
        $this->load->model('M_karyawan');
        $data['karyawan'] = $this->M_karyawan->tampil_karyawan();
        $config['total_rows'] =  $this->M_pengeluaran->count_all($search); // Assuming this method returns total rows
        $config['per_page'] = 10; // Number of items per page
        $config['uri_segment'] = 3;
        $config['base_url'] = base_url('Pengeluaran/index');

        initialize_pagination($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['data'] = $this->M_pengeluaran->tampilDataByPage($config['per_page'], $page, $search);
        
        $data['links'] = $this->pagination->create_links();
        $data['jenis_pengeluaran'] = ['Listrik','Uang Makan','Gaji Karyawan','Lain-Lain'];
        $data['search'] = $search;

        $this->load->view('template/header',$data);
        $this->load->view('template/sidebar',$data);
        $this->load->view('template/topbar',$data);
        $this->load->view('pengeluaran/index',$data);
        $this->load->view('template/footer',$data);
    }

    function tambah_data(){
      $this->M_pengeluaran->tambahData();
      $this->session->set_flashdata('msg','Data berhasil ditambahkan');
      redirect('pengeluaran');
    }

    function edit_data(){
      $this->M_pengeluaran->editData();
      $this->session->set_flashdata('msg','Data berhasil diubah');
      redirect('pengeluaran');
    }

    function hapus_data(){
      $id=$this->input->post('id');
      $this->M_pengeluaran->hapusData($id);
      $this->session->set_flashdata('msg','Data berhasil dihapus');
      redirect('pengeluaran');
    }

}