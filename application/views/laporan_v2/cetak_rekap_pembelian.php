<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
	<title>Rekap Penjualan Kasir</title>
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
						<h4>REKAP PEMBELIAN</h4>
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
						$count = count($data['keys'])+3;
						if($kategori == "LG") {
							$count += 1;
						}
					?>
					
					<tr>
						<th colspan="<?php echo $count; ?>" style="text-align:left;">
							Periode: <?= date('d M Y', strtotime($start)); ?> - <?= date('d M Y', strtotime($end)); ?><br>
						</th>
					</tr>

					<tr>
                        <th style="width: 100px;">NAMA BARANG</th>
						<?php 
								if($kategori == "LG") {
							?>
							<th style="width: 100px;">KETERANGAN</th>
						<?php } ?>
							
						
						<?php
							foreach($data['keys'] as $column) {
								
								$output = str_replace(['_','count'], ' ', ucwords($column));
						?>
							<th style="width: 100px;"><?php echo $output; ?></th>
						<?php }?>
                        
                        <th style="width: 100px;">TOTAL</th>
						<!-- <th style="width: 100px;">DP</th> -->
						
					</tr>
				</thead>
				<tbody>
				<?php
                        $allTotal = [];
                        foreach($data['data'] as $item) {
                            $total = 0;
                    ?>
                        <tr>
                            <td style="width: 100px;"><?php echo $item['nama_barang']; ?></td>
							<?php 
								if($kategori == "LG") {
							?>
								<td style="width: 100px;"><?php echo nl2br(htmlspecialchars( $item['keterangan'])); ?></td>
							<?php } ?>
							
                            <?php
                                foreach($data['keys'] as $column) {
                                     
                                    
                                    $output = str_replace(" ", '_', strtolower($column));
									$value = $item[$output] ?? 0;
                                    $total+= $value;
                                    $allTotal[$output] += $value;
                            ?>
                                <td style="width: 100px;text-align:center"><?php echo $value; ?></td>
                            <?php }?>

                            <td style="width: 100px; text-align:center"><?php echo $total; ?></td>
                        </tr>
                    <?php }?>
					<tr>
						<?php 
							$coltotal = 1;
							if($kategori == "LG") {
								$coltotal += 1;
							}
						?>
                        <td style="width: 100px;" colspan="<?php echo $coltotal; ?>">Total</td>
                        <?php
                                $total = 0;
                                foreach($data['keys'] as $column) {
                                    $output = str_replace(" ", '_', strtolower($column));
                                    $total += $allTotal[$output];
                            ?>
                                <td style="width: 100px;  text-align:center"><?php echo $allTotal[$output]; ?></td>
                        <?php }?>
                        <?php
                            $total += $allTotal['return_count'];
                        ?>
                        
                        <td style="width: 100px;  text-align:center"><?php echo $total; ?></td>
                    </tr>
				</tbody>
				
			</table>
		</div>
	</div>
</body>

</html>