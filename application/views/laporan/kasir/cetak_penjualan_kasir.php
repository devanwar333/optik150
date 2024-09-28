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
						<h4>LAPORAN PENJUALAN KASIR</h4>
					</center><br />
				</td>
			</tr>
		</table>
        <table border="0" align="center" style="width:1000px;border:none;">
			<tr>
				<th style="text-align:left"></th>
			</tr>
		</table>
        <div class="mt-30">
			<table border="1" align="center" style="width:1000px;margin-bottom:20px;">
				<thead>
					<?php 
						$count = count($data['keys'])+2;
					?>
					<tr>
						<th colspan="<?php echo $count; ?>" style="text-align:left;">
							Periode: <?= date('d M Y', strtotime($start)); ?> - <?= date('d M Y', strtotime($end)); ?><br>
						</th>
					</tr>

					<tr>
						
						
						<?php
							foreach($data['keys'] as $column) {
								
								$output = str_replace(['_','count'], ' ', ucwords($column));
						?>
							<th style="width: 100px;"><?php echo $output; ?></th>
						<?php }?>
                        <th style="width: 100px;">Total</th>
						<!-- <th style="width: 100px;">DP</th> -->
						
					</tr>
				</thead>
				<tbody>
				<?php
					$no=0;
					$alltotal=[];
					
					foreach ($data['data'] as $i) {
						$no++;
						$row = $i;
						
						?>

						
						<tr>

							<?php 
								$total = 0;
								foreach($data['keys'] as $column) {
								
									$cell = "";
									if($column != 'tanggal') {
										$alltotal[$column] += $row[$column];
										$total += $row[$column];
										$cell = number_format((int) $row[$column]);
									}else {
										$cell = $row['tanggal'];
									}
								
								
							?>
								<td style="text-align:center;"><?php echo $cell; ?></td>
							<?php 
								}
								$alltotal['DP_count'] += $row['DP_count']; 
								$alltotal['total']+=$total;
							?>
							<td style="text-align:center;"><?php echo number_format((int) $total);?></td>
							<!-- <th style="width: 100px;"><?php echo number_format($row['DP_count']);?></th> -->
						</tr>
					<?php }?>
					
					<tr>	
						<?php 
							foreach($data['keys'] as $column) {
								$count = "";
								if($column  == 'tanggal') {
									$count = "Total";
								} else {
									$count = number_format((int)$alltotal[$column]);
								}
								
							?>

								<td style="text-align:center;"><b><?php echo $count;?></b></td>
						<?php }?>
						<td style="text-align:center;"><b><?php echo number_format((int)$alltotal['total']);?></b></td>
						<!-- <td style="text-align:center;"><b><?php echo number_format((int)$alltotal['DP_count']);?></b></td> -->
					</tr>
				</tbody>
				
			</table>
		</div>
	</div>
</body>

</html>