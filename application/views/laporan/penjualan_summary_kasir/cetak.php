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
						<th colspan="6" style="text-align:left;">Periode : <?= date('d M Y', strtotime($tanggal)); ?> <br></th>
					</tr>
				<tr>
					<th >Nama Barang</th>
					<th >Qty</th>
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
	
			<tfoot class="bg-primary text-white font-weight-bold">
				<tr>
					<td colspan="5">Total :</td>
					<td><?= number_format($total) ?></td>
				</tr>
			</tfoot>
		</table>

	
</div>
</body>
</html>
