<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
	<title>Laporan Penjualan Pertanggal</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/css/laporan.css')?>"/>
</head>
<body>
<div id="laporan">
		
		<table  border="1"  class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:20px">
			<thead class="thead-light">
				<tr>
				<th colspan="3" style="text-align:left;">Nama Toko : <?= $nama_toko ?> <br></th>

				</tr>
					<tr>
						<th colspan="3" style="text-align:left;">Periode : <?= date('d M Y', strtotime($tanggal)); ?> <br></th>
					</tr>
				<tr>
					<th >Nama Barang</th>
					<th >Qty</th>
					<th >Keterangan</th>
				</tr>
			</thead>

			<tbody>
				<?php $i = 1;
				$total = 0;
				$kolom = 3;
				$totalBayar = 0;
				?>
				<?php foreach ($data as $items) :

					$total += ($items['total_qty']);
					$totalBayar += $items['total_bayar'];
				?>
					<tr>
						
						<td><?= ($items['d_jual_barang_nama']); ?></td>
						<td><?= number_format($items['total_qty']); ?></td>
						<td><?= $items['description'] ?></td>
					</tr>
				<?php endforeach; ?>
	
			<tfoot class="bg-primary text-white font-weight-bold">
				<tr>
					<td >Total :</td>
					<td><?= number_format($total) ?></td>
					<td></td>
				</tr>
				<tr>
					<td >Total Penjualan :</td>
					<td><?= number_format($totalBayar) ?></td>
					<td></td>
				</tr>
			</tfoot>
		</table>

	
</div>
</body>
</html>
