<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Ajax extends CI_Controller
{


	function __construct()
	{
		parent::__construct();

		$this->load->library('Excel');
		$this->load->model('m_barang');

	}
	public function Saldo()
	{
		$this->session->unset_userdata('saldo');
		$saldo = $this->input->post('saldo');
		$url_base = $this->input->post('url_base');
		// echo '<script>
		// sessionStorage.setItem("saldo", ' . $saldo . ')

		// </script>';
		$this->session->set_userdata(['saldo' => $saldo]);
		// redirect($url_base);
	}
	public function getJual1()
	{
		$date = date('Y-m-d');
		$data = $this->db->select('*,count(d_jual_qty) as total_qty')->from('tbl_jual')->group_by('d_jual_barang_id')->where('DATE(jual_tanggal)', $date)->join('tbl_detail_jual', 'tbl_detail_jual.d_jual_nofak=tbl_jual.jual_nofak')->get()->result_array();
		ob_start();
?>
		<?php $i = 1;
		$total = 0;
		$kolom = 3;
		?>
		<?php foreach ($data as $items) :

			$total += ($items['total_qty']);
		?>
			<?php if (($i) % $kolom == 1) { ?>
				<div class="row">
				<?php } ?>
				<div class="col-sm-4"><?= ($items['d_jual_barang_nama']) . " <label style='color:red'>Qty: " . ($items['total_qty']) . "</label>"  ?></div>
				<?php if (($i) % $kolom == 0) { ?>
				</div>
			<?php } ?>
			<?php $i++; ?>
		<?php endforeach; ?>
	<?php
		$konten = ob_get_contents();
		return $konten;
	}
	public function getJual()
	{
		$date = date('Y-m-d');
		$data = $this->db->select('*,sum(d_jual_qty) as total_qty')->from('tbl_jual')->group_by('d_jual_barang_id')->where('DATE(jual_tanggal)', $date)
		->where('jual_user_id', "!=",null)->where('cabang', "")->join('tbl_detail_jual', 'tbl_detail_jual.d_jual_nofak=tbl_jual.jual_nofak')->get()->result_array();

		ob_start();
	?>
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead class="thead-light">
				<tr>
					<th>Nama Barang</th>
					<th>Qty</th>
				</tr>
			</thead>

			<tbody>
				<?php $i = 1;
				$total = 0;
				$kolom = 3;
				?>
				<?php foreach ($data as $items) :

					$total += ($items['total_qty']);
				?>
					<?php if (($i) % $kolom == 1) { ?>
						<tr>
						<?php } ?>
						<td><?= ($items['d_jual_barang_nama']); ?></td>
						<td><?= number_format($items['total_qty']); ?></td>
						<?php if (($i) % $kolom == 0) { ?>
						</tr>
					<?php } ?>
					<?php $i++; ?>
				<?php endforeach; ?>
			</tbody>
			<tfoot class="bg-primary text-white font-weight-bold">
				<tr>
					<td colspan="5">Total :</td>
					<td><?= number_format($total) ?></td>
				</tr>
			</tfoot>
		</table>

	<?php
		$konten = ob_get_contents();
		return $konten;
	}

	public function getDataBarang()
	{
		$this->db->select('barang_nama as label, CONCAT(barang_harjul, "#", barang_id, "#", barang_satuan, "#", barang_stok) as value');
		$this->db->from('tbl_barang');
		$this->db->like('barang_nama', $this->input->post("search"));
		$dt = $this->db->get()->result_array();
		$html = "";
		foreach ($dt as $v) {
			$response[] = array("value" => $v['value'], "label" => $v['label']);
			$html .= "<li data-value='$v[value]'>$v[label]</li>";
		}



		echo json_encode($response);
	}


	public function getDataCustomer()
	{
		$this->db->select('barang_nama as label, CONCAT(barang_harjul, "#", barang_id, "#", barang_satuan, "#", barang_stok) as value');
		$this->db->from('tbl_barang');
		$this->db->like('barang_nama', $this->input->post("search"));
		$dt = $this->db->get()->result_array();

		foreach ($dt as $v) {
			$response[] = array("value" => $v['value'], "label" => $v['label']);
		}
		echo json_encode($response);
	}

	public function queryResume($date)
	{
		$this->db->select('*,sum(amount) as total');
		$this->db->from('tbl_resume');
		$this->db->where('DATE(created_at) >=', $date);
		$this->db->where('DATE(created_at) <=', $date);
		$this->db->where('tbl_resume.amount >=', '0');
		$this->db->where('tbl_resume.method_types !=', "");
		$this->db->group_by('method_types');
		$res = $this->db->get()->result_array();
		return $res;
	}
	public function queryResumeCash($date)
	{
		$this->db->select('*,sum(amount) as cash');
		$this->db->from('tbl_resume');
		$this->db->where('DATE(created_at) >=', $date);
		$this->db->where('DATE(created_at) <=', $date);
		$this->db->where('method_types', 'Cash');
		$this->db->group_by('method_types');
		$res = $this->db->get()->row_array();
		return $res;
	}
	public function queryResumePenjualanSisaDp($date)
	{
		$res = $this->db->query("select sum(a.total) as total from (SELECT tbl_jual.jual_total- sum(amount) as total FROM `tbl_resume` inner join tbl_jual on tbl_resume.resume_nofak= tbl_jual.jual_nofak WHERE DATE(created_at)>='$date' and DATE(created_at)<='$date' and tbl_jual.tipe='DP' and tbl_jual.status='DP' group by resume_nofak) as a")->row();
	
		return $res;
	}	
	public function queryPengeluaran($date)
	{
		$this->db->select('*,sum(nominal) as pengeluaran');
		$this->db->from('pengeluaran');
		$this->db->where('DATE(tanggal) >=', $date);
		$this->db->where('DATE(tanggal) <=', $date);
		$res = $this->db->get()->row();
		return $res;
	}

	public function getResume()
	{
		$date = date('Y-m-d');
		$saldo = $this->session->userdata('saldo');
		$queryPengeluaran = $this->queryPengeluaran($date);
		$queryCash = $this->queryResumeCash($date);
		$querySisaDp = $this->queryResumePenjualanSisaDp($date);
		$query = $this->queryResume($date);
		$res = new stdClass();
		$res->saldo = number_format($saldo);
		ob_start();

	?>
		<input type="hidden" id="saldo_response" value="<?= number_format($saldo) ?>" />
		<table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
			<thead class="thead-light">
				<tr>
					<th style="width:50px;">#</th>
					<th>Metode Pembayaran</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				<?php
				$i = 0;
				$total = 0;
				$no = 1;
				?>
				<?php foreach ($query as $items) :
					$total += $items['total'];
				?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= ($items['method_types']); ?></td>
						<td><?= number_format($items['total']); ?></td>
					</tr>

					<?php $i++; ?>
				<?php endforeach; ?>
			</tbody>
			<tfoot>
				<tr class="bg-danger text-white font-weight-bold">
					<td colspan="2">Sisa DP </td>
					<td><?= number_format($querySisaDp->total) ?> </td>
				</tr>
				<tr class="bg-danger text-white font-weight-bold">
					<td colspan="2">Pengeluaran </td>
					<td><?= number_format($queryPengeluaran->pengeluaran) ?> </td>
				</tr>
				<tr class="bg-primary text-white font-weight-bold">
					<td colspan="2">Total Di Kasir </td>
					<td><?php
						$wes = 0;
						$wes = $saldo + $queryCash['cash'] - $queryPengeluaran->pengeluaran;
						?> <?= number_format($wes); ?></td>
				</tr>
				<tr class="bg-success text-white font-weight-bold">
					<td colspan="2">Total Keseluruhan Penjualan </td>
					<td><?= number_format($total + ($querySisaDp->total )) ?></td>
				</tr>
			</tfoot>
		</table>
<?php
		// $konten = ob_get_contents();
		// $res->html = $konten;
		// echo json_encode($res);
	}

	public function generateExportExcel()
	{

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = [
			'font' => ['bold' => true], // Set font nya jadi bold
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]
		];

		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = [
			'alignment' => [
				'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
			],
			'borders' => [
				'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
				'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
				'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
				'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
			]
		];

		$sheet->setCellValue('A1', "DATA BARANG"); // Set kolom A1 dengan tulisan "DATA SISWA"
		$sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
		$sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1

		// Buat header tabel nya pada baris ke 3
		$sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
		$sheet->setCellValue('B3', "ID BARANG"); // Set kolom B3 dengan tulisan "NIS"
		$sheet->setCellValue('C3', "NAMA BARANG"); // Set kolom C3 dengan tulisan "NAMA"
		$sheet->setCellValue('D3', "SATUAN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
		$sheet->setCellValue('E3', "HARGA POKOK"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('F3', "HARGA JUAL"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('G3', "HARGA JUAL CABANG"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('H3', "BARANG STOK"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('I3', "BARANG MINIMAL STOK"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('J3', "TANGGAL INPUT"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('K3', "TANGGAL UPDATE"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('L3', "ID KATEGORI"); // Set kolom E3 dengan tulisan "ALAMAT"
		$sheet->setCellValue('M3', "SERIAL NUMBER"); // Set kolom E3 dengan tulisan "ALAMAT"

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$sheet->getStyle('A3')->applyFromArray($style_col);
		$sheet->getStyle('B3')->applyFromArray($style_col);
		$sheet->getStyle('C3')->applyFromArray($style_col);
		$sheet->getStyle('D3')->applyFromArray($style_col);
		$sheet->getStyle('E3')->applyFromArray($style_col);
		$sheet->getStyle('F3')->applyFromArray($style_col);
		$sheet->getStyle('G3')->applyFromArray($style_col);
		$sheet->getStyle('H3')->applyFromArray($style_col);
		$sheet->getStyle('I3')->applyFromArray($style_col);
		$sheet->getStyle('J3')->applyFromArray($style_col);
		$sheet->getStyle('K3')->applyFromArray($style_col);
		$sheet->getStyle('L3')->applyFromArray($style_col);
		$sheet->getStyle('M3')->applyFromArray($style_col);

		// Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
		$dataBarangs = $this->m_barang->getToExcel();

		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach ($dataBarangs as $data) { // Lakukan looping pada variabel siswa
			$sheet->setCellValue('A' . $numrow, $no);
			$sheet->setCellValue('B' . $numrow, $data->barang_id);
			$sheet->setCellValue('C' . $numrow, $data->barang_nama);
			$sheet->setCellValue('D' . $numrow, $data->barang_satuan);
			$sheet->setCellValue('E' . $numrow, $data->barang_harpok);
			$sheet->setCellValue('F' . $numrow, $data->barang_harjul);
			$sheet->setCellValue('G' . $numrow, $data->barang_harga_cabang);
			$sheet->setCellValue('H' . $numrow, $data->barang_stok);
			$sheet->setCellValue('I' . $numrow, $data->barang_min_stok);
			$sheet->setCellValue('J' . $numrow, $data->barang_tgl_input);
			$sheet->setCellValue('K' . $numrow, $data->barang_tgl_last_update);
			$sheet->setCellValue('L' . $numrow, $data->barang_kategori_id);
			$sheet->setCellValue('M' . $numrow, $data->serial_number);

			// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
			$sheet->getStyle('A' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('K' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('L' . $numrow)->applyFromArray($style_row);
			$sheet->getStyle('M' . $numrow)->applyFromArray($style_row);

			$no++; // Tambah 1 setiap kali looping
			$numrow++; // Tambah 1 setiap kali looping
		}

		// Set width kolom
		$sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
		$sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
		$sheet->getColumnDimension('C')->setWidth(40); // Set width kolom C
		$sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
		$sheet->getColumnDimension('E')->setWidth(20); // Set width kolom E
		$sheet->getColumnDimension('F')->setWidth(20); // Set width kolom E
		$sheet->getColumnDimension('G')->setWidth(20); // Set width kolom E
		$sheet->getColumnDimension('H')->setWidth(20); // Set width kolom E
		$sheet->getColumnDimension('I')->setWidth(20); // Set width kolom E
		$sheet->getColumnDimension('J')->setWidth(20); // Set width kolom E
		$sheet->getColumnDimension('K')->setWidth(20); // Set width kolom E
		$sheet->getColumnDimension('L')->setWidth(20); // Set width kolom E
		$sheet->getColumnDimension('M')->setWidth(20); // Set width kolom E

		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$sheet->getDefaultRowDimension()->setRowHeight(-1);

		// Set orientasi kertas jadi LANDSCAPE
		$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

		// Set judul file excel nya
		$sheet->setTitle("DATA BARANG");

		// Proses file excel
		// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		// header('Content-Disposition: attachment; filename="Data Barang.xlsx"'); // Set nama file excel nya
		// header('Cache-Control: max-age=0');

		$writer = new Xlsx($spreadsheet);
		$url = 'C:\xampp\htdocs\kasir\assets\backup\backup-'. date("Y-m-d").'.xls';
		$writer->save($url);
		echo json_encode("success");

	}
}
