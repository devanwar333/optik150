<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_edit extends CI_Controller
{

    private $session_key='EDIT_';
    function __construct()
    {
        parent::__construct();

        $this->load->model('m_kategori');
        $this->load->model('m_barang');
        $this->load->model('m_suplier');
        $this->load->model('m_penjualan');
        $this->load->model('M_customer');
        $this->load->model('m_cara_bayar');
    }

    public function index()
    {
        $data['title'] = 'Penjualan';
        $data['barang'] = $this->m_barang->tampil_barang();
        $data['nohp'] = $this->M_customer->tampil_customer();
        $nofak =  $this->uri->segment(3);
        $data['nofak'] = $nofak;
       
        $data['penjualan'] = $this->m_penjualan->get_all_detail_penjualan( $this->uri->segment(3));
        $data["paket"] = $this->m_barang->getBarangPaket();
        $data['carabarang'] = $this->m_cara_bayar->list();
        if (!$this->session->has_userdata($this->session_key.$nofak)) {
            $data['updated'] = false;
            $data['items'] = $this->m_penjualan->get_all_detail_penjualan( $this->uri->segment(3));
        } else {
            $data['updated'] = true;
            $data['items'] = $this->session->userdata($this->session_key.$nofak);
        }
       
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('penjualan_edit/index', $data);
        $this->load->view('template/footer', $data);

    }

    public function tambah_data()
    {

        $this->form_validation->set_rules('no_hp', 'No Hp/Telp', 'required|trim|min_length[11]|is_unique[tbl_customer.no_hp]', [
            'is_unique' => 'No Hp/Telp ini sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Penjualan';
            $data['customer'] = $this->M_customer->tampilData();
            $data['kd_cus'] = $this->M_customer->getKodeCustomer();

            $this->session->set_flashdata('msg2', 'Data sudah ADA !');
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('penjualan/index', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->M_customer->tambah_data();
            $this->session->set_flashdata('sukses', 'Data Customer berhasil ditambahkan');

            redirect('penjualan');
        }
    }

    public function get_barang()
    {

        $kobar = $this->input->post('nabar');
        $x['brg'] = $this->m_barang->get_barang($kobar);
        $this->load->view('penjualan/detail_barang_jual', $x);
    }

    function get_autocomplete()
    {
        if (isset($_GET['term'])) {
            $result = $this->m_barang->search_barang($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'    => $row->barang_nama,

                    );
                echo json_encode($arr_result);
            }
        }
    }

    function get_autocomplete1()
    {
        if (isset($_GET['term'])) {
            $result = $this->M_customer->search_customer($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'    => $row->no_hp,
                    );
                echo json_encode($arr_result);
            }
        }
    }
    private function checkAndUpdateChanges($nomor_faktur) {
        if (!$this->session->has_userdata($this->session_key.$nomor_faktur)) {
            $item =  $this->m_penjualan->get_all_detail_penjualan($nomor_faktur);
            $newData = array();
            foreach ($item as $key => $value) {
                
                $temp = [
                    'd_jual_id' =>  $value['d_jual_id'],
                    'd_jual_nofak' =>  $value['d_jual_nofak'],
                    'd_jual_barang_id' =>  $value['d_jual_barang_id'],
                    'd_jual_barang_kat_id' =>  $value['d_jual_barang_kat_id'],
                    'd_jual_barang_nama' =>  $value['d_jual_barang_nama'],
                    'd_jual_barang_satuan' =>  $value['d_jual_barang_satuan'] ,
                    'd_jual_barang_harpok' =>  $value['d_jual_barang_harpok'],
                    'd_jual_barang_harjul' =>  $value['d_jual_barang_harjul'] ,
                    'd_jual_qty' =>   $value['d_jual_qty'] ,
                    'd_jual_diskon' =>   $value['d_jual_diskon'] ,
                    'd_jual_total' =>  $value['d_jual_total'] ,
                ];
                $newData[] = $temp;
            }
           
            $this->session->set_userdata($this->session_key.$nomor_faktur,  $newData);
        }
    }
    ///revisi baru 8/10/19
    function add_to_cart()
    {
        $kodebarang = $this->input->post('kode_brg_ket');
        $nomor_faktur = $this->input->post('nomor_faktur');
        $this->checkAndUpdateChanges($nomor_faktur);

        $produk = $this->m_barang->get_barang_by_kode($kodebarang)->row_array();
        $qty = $this->input->post('jumlah_ket');
        $keterangan = $this->input->post('keterangan');
        $currentData = $this->session->userdata($this->session_key.$nomor_faktur);
        
        $updated = false;
        $newData = array();
        foreach ($currentData as $key => $value) {
            
            if($value['d_jual_barang_id'] == $kodebarang){
                $value['d_jual_qty'] +=$qty;
                $value['d_jual_diskon'] = $keterangan;
                $value['d_jual_total'] = $value['d_jual_qty'] *  $value['d_jual_barang_harjul'];
                $updated = true;
            }
            $newData[] = $value;
        }
        if(!$updated) {
            $newData[count($newData)] = [
                
                'd_jual_id' =>  '',
                'd_jual_nofak' =>  $nomor_faktur,
                'd_jual_barang_id' =>  $kodebarang,
                'd_jual_barang_kat_id' =>  $produk['barang_kategori_id'],
                'd_jual_barang_nama' =>  $produk['barang_nama'],
                'd_jual_barang_satuan' =>  $produk['barang_satuan'] ,
                'd_jual_barang_harpok' =>  $produk['barang_harpok'],
                'd_jual_barang_harjul' =>  $produk['barang_harjul'] ,
                'd_jual_qty' =>   $qty ,
                'd_jual_diskon' =>   $keterangan ,
                'd_jual_total' =>  $produk['barang_harjul']*$qty ,
            ];
        }
       
        $this->session->set_userdata($this->session_key.$nomor_faktur,$newData);
        redirect('penjualan_edit/index/' . $nomor_faktur);

    }

    function remove_from_edit($kodebarang)
    {
        $nomor_faktur = $_GET["nofak"];
        $this->checkAndUpdateChanges($nomor_faktur);

        $currentData = $this->session->userdata($this->session_key.$nomor_faktur);

        $newData = array();
        foreach ($currentData as $key => $value) {
            
            if($value['d_jual_barang_id'] == $kodebarang){
                continue;
            }
            $newData[] = $value;
        }
        if(count($newData)==0) {
            $this->session->set_flashdata('error', 'Gagal Hapus Barang, Transaksi Wajib Memiliki 1 Barang');
            redirect('penjualan_edit/index/' . $nomor_faktur);

        }
        $this->session->set_userdata($this->session_key.$nomor_faktur,$newData);

        redirect('penjualan_edit/index/' . $nomor_faktur);
    }
    function update_qty_detail($kodebarang)
    {
        
        $produk = $this->m_barang->get_barang1($kodebarang);
        $nomor_faktur =  $this->input->post('nomorfaktur');
        $keterangan =  $this->input->post('d_jual_diskon');
        $kodebarang = $this->input->post('d_jual_barang_id');
        $i = $produk->row_array();
        $this->checkAndUpdateChanges($nomor_faktur);
        
        if($i==null) {
            $this->session->set_flashdata('error', 'Gagal ubah, Barang '.$kodebarang.' tidak ditemukan');
            redirect('penjualan_edit/index/' . $this->input->post('nomorfaktur'));
        }
        $qty_baru = $this->input->post('d_jual_qty');
        if($qty_baru<=0) {
            $this->session->set_flashdata('error', 'Gagal ubah, Jumlah Qty Barang '.$kodebarang.' harus lebih besar dari 0');
            redirect('penjualan_edit/index/' . $this->input->post('nomorfaktur'));
        }
        $currentData = $this->session->userdata($this->session_key.$nomor_faktur);

        $newData = array();
        foreach ($currentData as $key => $value) {
            
            if($value['d_jual_barang_id'] == $kodebarang){
                $value['d_jual_qty'] = $qty_baru;
                $value['d_jual_diskon'] = $keterangan;
                $value['d_jual_total'] = $value['d_jual_qty'] *  $value['d_jual_barang_harjul'];
            }
            $newData[] = $value;
        }
        $this->session->set_userdata($this->session_key.$nomor_faktur,$newData);

        redirect('penjualan_edit/index/' .$nomor_faktur);
    }
    function simpan_ulang()
    {
        $data =  $this->input->post();
        var_dump($data);
        $nomor_faktur = $data['jual_nofak'];
        $currentData = $this->session->userdata($this->session_key.$nomor_faktur);
        if(count($currentData)<=0) {
            $this->session->set_flashdata('error', "Gagal Edit Penjualan, Barang Penjualan Wajib 1 Barang");
            redirect('penjualan_edit/index/' . $nomor_faktur);

        }
        $totalJumlahUang = (int) $data['jual_jml_uang'] + (int) $data['jual_jml_uang2'];
        if($totalJumlahUang> (int)$data['jual_total']) {
            $this->session->set_flashdata('error', "Gagal Edit Penjualan, Pembayaran Tidak Boleh Lebih dari Total Penjualan");
            redirect('penjualan_edit/index/' . $nomor_faktur);
        }
        if($totalJumlahUang < (int)$data['jual_total']) {
            $this->session->set_flashdata('error', "Gagal Edit Penjualan, Pembayaran Tidak Boleh Kurang dari Total Penjualan");
            redirect('penjualan_edit/index/' . $nomor_faktur);
        }

        try {
            $this->db->trans_begin();
            $this->delete_resume($nomor_faktur);
          
            $this->db->where('jual_nofak', $nomor_faktur);
            $this->db->update('tbl_jual', $data);

            $this->db->where('d_jual_nofak', $nomor_faktur);
            $this->db->delete('tbl_detail_jual');


            $this->db->insert_batch('tbl_detail_jual', $currentData); 

            
            $biaya1 = $data['jual_jml_uang'] ;
            $biaya2 = $data['jual_jml_uang2'] ;
            $resume1 = [
                'resume_nofak' => $nomor_faktur,
                'method_types' => $data['jual_keterangan'],
                'amount' =>  $biaya1,
                'created_at' => $data['jual_tanggal']
            ];
            $resume2 = [
                'resume_nofak' => $nomor_faktur,
                'method_types' => $data['jual_keterangan2'],
                'amount' => $biaya2,
                'created_at' => $data['jual_tanggal']
            ];
            $this->db->insert('tbl_resume', $resume1);
            $this->db->insert('tbl_resume', $resume2);
            if(!$this->db->trans_status()) {
                $this->session->set_flashdata('error', "Gagal Edit Penjualan, Terjadi kesalahan ketika penyimpan data");

                $this->db->trans_rollback();
            }else {
                $this->session->set_flashdata('sukses', "Berhasil menyimpan perubahan");

                $this->db->trans_commit();
                $this->session->unset_userdata($this->session_key.$nomor_faktur);

            }
        } catch (\Throwable $th) {
            $this->session->set_flashdata('error', "Gagal Edit Penjualan, Terjadi kesalahan pada sistem");

            $this->db->trans_rollback();
        }
        
        redirect('penjualan_edit/index/' . $nomor_faktur);
    }
    function delete_resume($id)
    {
        return $this->db->select('*')->from('tbl_resume')->where('resume_nofak', $id)->delete('tbl_resume');
    }

    function add_to_cart_paket()
    {
        $kode_barang = $this->input->post('kode_barang');
        $nomor_faktur = $this->input->post('nomor_faktur');
        $this->checkAndUpdateChanges($nomor_faktur);

        $produk = $this->m_barang->get_barang_by_kode($kode_barang)->row_array();
        $qty = 1;
        $data = array(
            'd_jual_id' =>  '',
            'd_jual_nofak' => $nomor_faktur,
            'd_jual_barang_id' => $produk['barang_id'],
            'd_jual_barang_kat_id' => $produk['barang_kategori_id'],
            'd_jual_barang_nama'     => $produk['barang_nama'],
            'd_jual_barang_satuan'   => $produk['barang_satuan'],
            'd_jual_barang_harpok'   => $produk['barang_harpok'],
            'd_jual_barang_harjul'    => $produk['barang_harjul'],
            'd_jual_diskon' => "",
            'd_jual_qty'      =>  $qty,
            'd_jual_total'      =>  $qty * $produk['barang_harjul']
        );

        $currentData = $this->session->userdata($this->session_key.$nomor_faktur);

        $newData = array();
        foreach ($currentData as $key => $value) {
            $newData[] = $value;
        }
        $newData[count($newData)] = $data;
        $this->session->set_userdata($this->session_key.$nomor_faktur,$newData);
    
    }
    function remove()
    {
        $row_id = $this->uri->segment(3);
        $this->cart->update(array(
            'rowid'      => $row_id,
            'qty'     => 0
        ));
        redirect('penjualan');
    }


    function remove_paket()
    {
        $kode_barang = $this->input->post('kode_barang');
        $nomor_faktur = $this->input->post('nomor_faktur');
        $currentData = $this->session->userdata($this->session_key.$nomor_faktur);
        $this->checkAndUpdateChanges($nomor_faktur);

        $newData = array();
        foreach ($currentData as $key => $value) {
            
            if($value['d_jual_barang_id'] == $kode_barang){
                continue;
            }
            $newData[] = $value;
        }

        if(count($newData)==0) {
            $this->session->set_flashdata('error', 'Gagal Hapus Barang, Transaksi Wajib Memiliki 1 Barang');
            return false;
        }

        $this->session->set_userdata($this->session_key.$nomor_faktur,$newData);

    }
    function cetak_faktur()
    {
        $x['data'] = $this->m_penjualan->cetak_faktur();
        $this->load->view('laporan/v_faktur', $x);
        //$this->session->unset_userdata('nofak');
    }
    function cetak_faktur_cabang()
    {
        $x['data'] = $this->m_penjualan->cetak_faktur_cabang();
        $this->load->view('laporan/v_faktur_cabang', $x);
        //$this->session->unset_userdata('nofak');
    }

    function cetak_faktur_dp()
    {
        $x['data'] = $this->m_penjualan->cetak_faktur_dp();
        $this->load->view('laporan/v_faktur_dp', $x);
        //$this->session->unset_userdata('nofak');
    }

    function hapus_perubahan($nofaktur) {
        $this->session->unset_userdata($this->session_key.$nofaktur);
        redirect('penjualan_edit/index/' . $nofaktur);

    }
}
