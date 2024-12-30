<?php
defined('BASEPATH') or exit('No direct script access allowed');

class History_pembelian extends CI_Controller
{
    private $session_key = "EDITPEMBELIAN_";
    function __construct()
    {
        parent::__construct();

        $this->load->model('m_pembelian');
        $this->load->model('m_suplier');
        $this->load->model('m_barang');
        if ($this->session->userdata('level') != TRUE) {
            redirect(base_url());
        }
    }

    function index()
    {
        $data['title'] = "Data History Pembelian";

        $data['data'] = $this->db->select('*')->from('tbl_beli')->order_by('beli_tanggal', "DESC")->get()->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('history_pembelian/index', $data);
        $this->load->view('template/footer', $data);
    }

    function edit($id)
    {
		$data['title'] = 'Edit History Pembelian';
		$data['sup'] = $this->m_suplier->tampil_suplier();

        $data['data'] = $this->db->query("select a.beli_tanggal, a.beli_nofak, b.suplier_nama, b.suplier_id, a.status from tbl_beli a left join tbl_suplier b
                                             on a.beli_suplier_id=b.suplier_id where a.beli_nofak='$id'")->row_array();
        $data['nofak'] = $id;
        if($data['data']['status']=="CANCEL") {
            $this->session->set_flashdata('error', 'Tidak dapat mengubah Karena Transaksi No Faktur '.$id .' sudah dibatalkan');

            redirect('history_pembelian');

        }
        
        if (!$this->session->has_userdata($this->session_key.$id)) {
            $data['updated'] = false;
            $data['barang'] = $this->m_pembelian->get_detail_pembelian_by_nofak($id);
            $total = 0;
            foreach ($data['barang'] as $key => $value) {
                $total += $value['d_beli_total'];
            }
            $data['total'] =$total;
        } else {
            $data['updated'] = true;
            $data['barang'] = $this->session->userdata($this->session_key.$id);
            $total = 0;
            foreach ($data['barang'] as $key => $value) {
                $total += $value['d_beli_total'];
            }
            $data['total'] =$total;

        }
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('history_pembelian/edit', $data);
        $this->load->view('template/footer', $data);
    }

    function in_detail($id)
    {
        $data['title'] = "Detail Pembelian";

        $data['data'] = $this->db->query("select a.beli_tanggal, a.beli_nofak, b.suplier_nama from tbl_beli a left join tbl_suplier b
                                             on a.beli_suplier_id=b.suplier_id where a.beli_nofak='$id'")->row_array();

        $data['barang'] = $this->db->query("select a.d_beli_harga, a.d_beli_jumlah, a.d_beli_total, b.barang_nama, a.keterangan from tbl_detail_beli a 
                                                    left join tbl_barang b on a.d_beli_barang_id=b.barang_id where a.d_beli_nofak='$id'")->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('history_pembelian/detail_pembelian', $data);
        $this->load->view('template/footer', $data);
    }

    function batal($id) {
        $data = [
            'status' => "CANCEL",
        ];
        try {
            $history = $this->m_pembelian->get_history_pembelian_by_nofak($id);
            if($history->status=="CANCEL") {
                $this->session->set_flashdata('error', 'Gagal Membatalkan Karena Transaksi No Faktur '.$id .' sudah dibatalkan');

                redirect('history_pembelian');
            }
            $this->db->trans_begin();
            $this->m_pembelian->update_pembelian_by_nofak($id, $data);
            
            $item =  $this->m_pembelian->get_detail_pembelian_by_nofak($id);
            foreach ($item as $dt) {
                $qty = (int)$dt['d_beli_jumlah'];
                $this->db->query("update tbl_barang set barang_stok=barang_stok-'$qty' where barang_id='$dt[d_beli_barang_id]'");
            }
            

            if ($this->db->trans_status() === FALSE)
            {
                $this->session->set_flashdata('error', 'Gagal Membatalkan Transaksi No Faktur '.$id);

                $this->db->trans_rollback();
            }
            else
            {
                $this->session->set_flashdata('sukses', 'Berhasil Membatalkan Transaksi No Faktur '.$id );
                $this->db->trans_commit();
            }
            redirect('history_pembelian');
        }
        catch (Exception $e) {
            $this->session->set_flashdata('error', 'Terjadi kesalahan pada sistem');
            $this->db->trans_rollback();
            redirect('history_pembelian');
        }
    }
    private function checkAndUpdateChanges($nomor_faktur) {
        if (!$this->session->has_userdata($this->session_key.$nomor_faktur)) {
            $item =  $this->m_pembelian->get_detail_pembelian_by_nofak($nomor_faktur);
            $newData = array();
            foreach ($item as $key => $value) {
                
                $temp = [
                    'd_beli_id' =>  $value['d_beli_id'],
                    'd_beli_nofak' =>  $value['d_beli_nofak'],
                    'd_beli_barang_id' =>  $value['d_beli_barang_id'],
                    'd_beli_barang_nama' =>  $value['d_beli_barang_nama']=="" ? $value['barang_nama']:$value['d_beli_barang_nama'],
                    'barang_satuan' =>  $value['barang_satuan'] ,
                    'd_beli_harga' =>  $value['d_beli_harga'] ,
                    'd_beli_jumlah' =>   $value['d_beli_jumlah'] ,
                    'd_beli_total' =>   $value['d_beli_total'] ,
                    'keterangan' =>  $value['keterangan'] ,
                ];
                $newData[] = $temp;
            }
           
            $this->session->set_userdata($this->session_key.$nomor_faktur,  $newData);
        }
    }
    function remove_item($id){
        $nomor_faktur = $_GET["nofak"];
        $this->checkAndUpdateChanges($nomor_faktur);

        $currentData = $this->session->userdata($this->session_key.$nomor_faktur);

        $newData = array();
        foreach ($currentData as $key => $value) {
            
            if($value['d_beli_barang_id'] == $id){
                continue;
            }
            $newData[] = $value;
        }
        if(count($newData)==0) {
            $this->session->set_flashdata('error', 'Gagal Hapus Barang, Transaksi Wajib Memiliki 1 Barang');
            redirect('history_pembelian/edit/' . $nomor_faktur);

        }
        $this->session->set_userdata($this->session_key.$nomor_faktur,$newData);

        redirect('history_pembelian/edit/' . $nomor_faktur);
    }

    function add_to_cart() {
       $kodebarang = $this->input->post('kode_brg');
       $nomor_faktur = $this->input->post('nofak');
       $this->checkAndUpdateChanges($nomor_faktur);

       $produk = $this->m_barang->get_barang_by_kode($kodebarang)->row_array();
       $harga = $this->input->post('harpok');
       $qty = $this->input->post('jumlah');
       $keterangan = $this->input->post('keterangan');
       $currentData = $this->session->userdata($this->session_key.$nomor_faktur);
       
       $updated = false;
       $newData = array();
       foreach ($currentData as $key => $value) {
           
           if($value['d_beli_barang_id'] == $kodebarang){
               $value['d_beli_harga'] = $harga;
               $value['d_beli_jumlah'] +=$qty;
               $value['keterangan'] = $keterangan;
               $value['d_beli_total'] = $value['d_beli_jumlah'] *  $harga;
               $updated = true;
           }
           $newData[] = $value;
       }
       if($produk == null) {
            $this->session->set_flashdata('error', 'Produk tidak ditemukan.');
       }
       if(!$updated && $produk != null) {
           $newData[] = [
               
               'd_beli_id' =>  '',
               'd_beli_nofak' =>  $nomor_faktur,
               'd_beli_barang_id' =>  $kodebarang,
               'barang_satuan' => $produk['barang_satuan'],
               'd_beli_barang_nama' =>  $produk['barang_nama'],
               'd_beli_harga' =>  $harga ,
               'd_beli_jumlah' =>  $qty,
               'd_beli_total' =>  (int)$qty *(int) $harga ,
               'keterangan' =>   $keterangan ,
             
           ];
       }
      
       $this->session->set_userdata($this->session_key.$nomor_faktur,$newData);
       redirect('history_pembelian/edit/' . $nomor_faktur);
    }

    function edit_to_cart($kodebarang) {
        $produk = $this->m_barang->get_barang1($kodebarang);
        $nomor_faktur =  $this->input->post('nomorfaktur');
        $keterangan =  $this->input->post('keterangan');
        $harga = $this->input->post('d_beli_harga');
        $qty_baru = $this->input->post('d_beli_jumlah');
        $i = $produk->row_array();
        $this->checkAndUpdateChanges($nomor_faktur);
        
        if($i==null) {
            $this->session->set_flashdata('error', 'Gagal ubah, Barang '.$kodebarang.' tidak ditemukan');
            redirect('history_pembelian/edit/' . $nomor_faktur);
        }
       
        if($qty_baru<=0) {
            $this->session->set_flashdata('error', 'Gagal ubah, Jumlah Qty Barang '.$kodebarang.' harus lebih besar dari 0');
            redirect('history_pembelian/edit/' . $nomor_faktur);
        }
        $currentData = $this->session->userdata($this->session_key.$nomor_faktur);

        $newData = array();
        foreach ($currentData as $key => $value) {
            
            if($value['d_beli_barang_id'] == $kodebarang){
                $value['d_beli_harga'] = $harga;
                $value['d_beli_jumlah'] = $qty_baru;
                $value['keterangan'] = $keterangan;
                $value['d_beli_total'] = $value['d_beli_jumlah'] *  $value['d_beli_harga'];
            }
            $newData[] = $value;
        }
        $this->session->set_userdata($this->session_key.$nomor_faktur,$newData);

        redirect('history_pembelian/edit/' .$nomor_faktur);
    }

    function hapus_perubahan($nofaktur) {
        if (!$this->session->has_userdata($this->session_key.$nofaktur)) {
            $this->session->set_flashdata('error', "Tidak ada perubahan pada transaksi penjualan ini.");

        }else {
            $this->session->unset_userdata($this->session_key.$nofaktur);

        }
        redirect('history_pembelian/edit/' . $nofaktur);

    }

    function simpan_perubahan($nofaktur){
        
        $data =  $this->input->post();
        $nomor_faktur = $nofaktur;
        $currentData = $this->session->userdata($this->session_key.$nomor_faktur);
        if($this->session->has_userdata($this->session_key.$nomor_faktur)){
            if(count($currentData)<=0) {
                $this->session->set_flashdata('error', "Gagal Edit Pembelian, Barang Pembelian Wajib 1 Barang");
                redirect('history_pembelian/edit/' . $nomor_faktur);
    
            }
        }
    
        try {
            $this->db->trans_begin();
            $newdata = [
                'beli_suplier_id' =>  $data['suplier'],
                'beli_tanggal' => $data['tgl'],
            ];
            $this->db->where('beli_nofak', $nomor_faktur);
            $this->db->update('tbl_beli', $newdata);

            if($this->session->has_userdata($this->session_key.$nomor_faktur)){
                $olditem = $this->m_pembelian->get_detail_pembelian_by_nofak( $nomor_faktur);
                foreach ($olditem as $key => $value) 
                {
                    $barang_id =  $value['d_beli_barang_id'];
                    $qtyOld = $value['d_beli_jumlah'];
                    $this->db->query("UPDATE tbl_barang SET barang_stok=barang_stok - '$qtyOld' WHERE barang_id='$barang_id'");
                    $this->db->where('d_beli_id', $value['d_beli_id']);
                    $this->db->delete('tbl_detail_beli');
                    
                }

                foreach ($currentData as $key => $value) {
                    $harga = $value['d_beli_harga'];
                    $barang_id =  $value['d_beli_barang_id'];
                    $qtyOld = $value['d_beli_jumlah'];
                    unset($value['barang_satuan']);
                    $this->db->query("UPDATE tbl_barang SET barang_stok=barang_stok + '$qtyOld', barang_harpok='$harga' WHERE barang_id='$barang_id'");
                    $this->db->insert('tbl_detail_beli', $value); 
                }
            }
            
            if(!$this->db->trans_status()) {
                $this->session->set_flashdata('error', "Gagal Edit Pembelian, Terjadi kesalahan ketika penyimpan data");

                $this->db->trans_rollback();
            }else {
                $this->session->set_flashdata('sukses', "Berhasil menyimpan perubahan");

                $this->db->trans_commit();
                $this->session->unset_userdata($this->session_key.$nomor_faktur);

            }
        } catch (\Throwable $th) {
            $this->session->set_flashdata('error', "Gagal Edit Pembelian, Terjadi kesalahan pada sistem");

            $this->db->trans_rollback();
        }
        
        redirect('history_pembelian/edit/' . $nomor_faktur);
    }
}
