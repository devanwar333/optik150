<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
	<title>Laporan Remaing Stock</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/css/laporan.css')?>"/>
</head>
<body>
<div id="laporan">
	
		<table  border="1"  class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size:20px">
			<thead class="thead-light">
<tr>
						<th colspan="3" style="text-align:left;">Periode : <?= date('d M Y'); ?> <br></th>
					</tr>
				<tr>
					<th >Nama Barang</th>
					<th >Stock</th>				
					<th >Min Stock</th>
				</tr>
			</thead>

			<tbody>
				<?php $i = 1;
				$total = 0;
				$kolom = 3;
				
				?>
				<?php foreach ($data as $items) :
					
					$total += (int)($items->barang_stok);
				?>
					<tr>
						
						<td><?= $items->barang_nama ?></td>
						<td><?= $items->barang_stok ?></td>
						<td><?= $items->barang_min_stok ?></td>
					</tr>
				<?php endforeach; ?>
	
			<tfoot class="bg-primary text-white font-weight-bold">
				<tr>
					<td >Total :</td>
					<td><?= number_format($total) ?></td>
					<td></td>
				</tr>
			</tfoot>
		</table>

	
</div>
</body>
</html>
