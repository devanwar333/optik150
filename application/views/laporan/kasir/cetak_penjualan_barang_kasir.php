<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
	<title>Laporan Penjualan Kasir</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/laporan.css') ?>" />
	<style>
		.mt-30 {
			margin-top: 30px !important;
		}

		/* table{
			border-collapse: collapse;
		}
		table tr th, table tr td{
			padding: 10px;
		} */
	</style>
</head>

<body onload="window.print()">
	<div id="laporan">
		<table align="center" style="width:1200px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">

		</table>

		<table border="0" align="center" style="width:1000px; border:none;margin-top:5px;margin-bottom:0px;">
			<tr>
				<td colspan="2" style="width:1000px;padding-left:20px;">
					<center>
						<h4>LAPORAN PENJUALAN KASIR PER BARANG</h4>
					</center><br />
				</td>
			</tr>
		</table>
        <table border="0" align="center" style="width:1200px;border:none;">
			<tr>
				<th style="text-align:left"></th>
			</tr>
		</table>
        <div class="mt-30">
			<table border="1" align="center" style="width:1200px;margin-bottom:20px;">
				<thead>
					<?php 
						$count = count($data['keys'])+2;
					?>
					<tr>
						<th colspan="<?php echo $count; ?>" style="text-align:left;">
							Nama Toko: <?=	$nama_toko  ?><br>
						</th>
					</tr>
					<tr>
						<th colspan="<?php echo $count; ?>" style="text-align:left;">
							Periode: <?= date('d M Y', strtotime($start)); ?> - <?= date('d M Y', strtotime($end)); ?><br>
						</th>
					</tr>

					<tr>
						<th style="width:200px;">Nama Barang</th>
						<?php
							foreach($data['keys'] as $column) {
						?>
							<th style="width: 100px;"><?php echo $column; ?></th>
						<?php }?>
						<th style="width:200px;">Total</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no=0;
					$alltotal=[];
					
					foreach ($data['data'] as $i) {
						$no++;
						$row = $i;
						$total = 0;
						?>
						<tr>
							<td style="text-align:center;"><?php echo $row['nama_barang']; ?></td>
							<?php 
								$total = 0;
								
								foreach($data['keys'] as $column) {	
									$alltotal[$column] += (int)$row[$column];			
									$total+=$row[$column];				
							?>
								<td style="text-align:center;"><?php echo $row[$column]; ?></td>
							<?php 
								}
								$alltotal['total']+= $total;
							?>
							<td style="text-align:center;"><?php echo $total; ?></td>
						</tr>
					<?php }?>
					<tr>
						<td style="text-align:center;"><b>Total</b></td>
						<?php 
							foreach($data['keys'] as $column) {								
							?>
								<td style="text-align:center;"><b><?php echo $alltotal[$column];?></b></td>
						<?php }?>
						<td style="text-align:center;"><b><?php echo $alltotal['total'];?></b></td>
					</tr>
				</tbody>
				
			</table>
		</div>
	</div>
</body>

</html>