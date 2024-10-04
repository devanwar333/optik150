<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Barang_Import extends CI_Controller
{

    function __construct()
	{
		parent::__construct();

		
		$this->load->model('m_import');
		$this->load->library('rabbitmq');
		
		
		if ($this->session->userdata('level') != TRUE) {
            redirect(base_url());
        }
	}

    public function index()
	{
		$data['title'] = "Barang";
		// $data['data'] = $this->m_barang->tampil_barang();
		// $data['kat'] = $this->m_kategori->tampil_kategori();
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('template/topbar', $data);
		$this->load->view('barang_import/index', $data);
		$this->load->view('template/footer', $data);
	}

	public function list_ajax()
	{
		$role = $this->session->userdata('level');
	
		$list = $this->m_import->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {

			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $value->file;
			$row[] = $value->proceed;
			$row[] = $value->size;
			$row[] = $value->status;
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"data" => $data,
			"recordsTotal" => $this->m_import->count_all(),
			"recordsFiltered" => $this->m_import->count_filtered(),
			
		);
		echo json_encode($output);
	}

	public function submit() {
		$failedKodebarang=[];
		
		if (isset($_FILES["fileExcel"]["name"])) {
			$exchange = 'import';
			$routing_key = 'import';
			$message = array('message' => 'Hello RabbitMQ');
			
			$this->rabbitmq->publish_message($exchange, $routing_key, $message);
			
			// $path = $_FILES["fileExcel"]["tmp_name"];
			// $object = PHPExcel_IOFactory::load($path);
			// foreach ($object->getWorksheetIterator() as $worksheet) {
			// 	$highestRow = $worksheet->getHighestRow();
			// 	$highestColumn = $worksheet->getHighestColumn();
			// 	for ($row = 4; $row <= $highestRow; $row++) {
			// 		$barang_id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
			// 		$barang_nama = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
			// 		$barang_satuan = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
			// 		$barang_harpok  = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
			// 		$barang_harjul  = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
			// 		$barang_harga_cabang  = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
			// 		$barang_stok  = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
			// 		$barang_min_stok  = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
			// 		$barang_tgl_input  = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
			// 		$barang_tgl_last_update = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
			// 		$barang_kategori_id = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
			// 		$serial_number  = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
			// 		$newData= array(
			// 			'barang_id'	=> $barang_id,
			// 			'barang_nama'	=> $barang_nama,
			// 			'barang_satuan'	=> $barang_satuan,
			// 			'barang_harpok'	=> $barang_harpok,
			// 			'barang_harjul'	=> $barang_harjul,
			// 			'barang_harga_cabang'	=> $barang_harga_cabang,
			// 			'barang_stok'	=> $barang_stok,
			// 			'barang_min_stok'	=> $barang_min_stok,
			// 			'barang_tgl_input'	=> $barang_tgl_input,
			// 			'barang_tgl_last_update'	=> $barang_tgl_last_update,
			// 			'barang_kategori_id'	=> $barang_kategori_id,
			// 			'serial_number'	=> $serial_number,
			// 		);
					
			// 		try {
			// 			$exist = $this->m_barang->get_barang1($barang_id)->row();
			// 			if($exist!=null) {
			// 				log_message('error', 'IMPORT - update - '.$barang_id." - ".$barang_stok);

			// 				$this->db->where('barang_id',$barang_id);
			// 				$this->db->update('tbl_barang', $newData);
			// 			} else {
			// 				log_message('error', 'IMPORT -insert - '.$barang_id." - ".$barang_stok);

			// 				$this->db->insert('tbl_barang', $newData);
			// 			}
			// 		} catch (Exception $e) {
			// 			array_push($failedKodebarang,$barang_id);
			// 		}
					
			// 	}
			// }
			// if(count($failedKodebarang)>0) {
			// 	$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan pada '.implode(', ',$failedKodebarang));

			// }else {
			// 	$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import ke Database');
			// }
			// redirect($_SERVER['HTTP_REFERER']);
			
		} else {
			echo "Tidak ada file yang masuk";
		}
	}
}