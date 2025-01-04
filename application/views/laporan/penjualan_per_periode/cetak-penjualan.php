<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
	<title>Laporan Penjualan Kasir</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?php echo base_url('assets/admin/css/laporan.css') ?>" />
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
		<table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">

		</table>

		<table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
			<tr>
				<td colspan="2" style="width:800px;padding-left:20px;">
					<center>
						<h4>LAPORAN PENJUALAN KASIR</h4>
					</center><br />
				</td>
			</tr>

		</table>

		<table border="0" align="center" style="width:900px;border:none;">
			<tr>
				<th style="text-align:left"></th>
			</tr>
		</table>
		<?php
		$b = 0;
		?>

		<!-- Tampilan Laporan jika tidak dicentang -->
		<div class="mt-30">
			<table border="1" align="center" style="width:900px;margin-bottom:20px;">
				<thead>
					<tr>
						<th colspan="11" style="text-align:left;">Periode : <?= date('d M Y', strtotime($tanggal1)); ?> - <?= date('d M Y', strtotime($tanggal2)); ?><br></th>
					</tr>

					<tr>
						<th style="width:50px;">No</th>
						<th>No Faktur</th>
						<th>Customer</th>
						<th>No Hp</th>
						<th>Tanggal</th>
						<th>Keterangan</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 0;
					// $data_tes = $dt->items;
					$grandtotal = 0;
					foreach ($data as $idx => $i) {
						$no++;
						$nofak = $i['jual_nofak'];
						$nama = $i['nama'];
						$tgl = $i['jual_tanggal'];
						$nohp = $i['no_hp'];
						$total = $i['total'];
						$keterangan = $i['jual_keterangan'] . "-".$i['jual_keterangan2'];
						$grandtotal += $total;
					?>
						<tr>
							<td style="text-align:center;"><?php echo $no; ?></td>
							<td style="padding-left:5px;"><?php echo $nofak; ?></td>
							<td style="padding-left:5px;"><?php echo $nama; ?></td>
							<td style="padding-left:5px;"><?php echo $nohp; ?></td>
							<td style="text-align:center;"><?php echo $tgl; ?></td>
							
							<td style="text-align:left;"><?php echo nl2br(htmlspecialchars( $keterangan)); ?></td>
							<td style="text-align:left;"><?php echo  'Rp ' . number_format($total);  ?></td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>

					<tr>
						<td colspan="6" style="text-align:center;"><b>Total Penjualan</b></td>
						<td style="text-align:right;"><b><?php echo 'Rp ' . number_format($grandtotal); ?></b></td>
					</tr>
				</tfoot>
			</table>
		</div>

		<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
			<tr>
				<td></td>
		</table>
		<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
			<tr>
				<td align="right">Medan, <?php echo date('d-M-Y') ?></td>
			</tr>
			<tr>
				<td align="right"></td>
			</tr>

			<tr>
				<td><br /><br /><br /><br /></td>
			</tr>
			<tr>
				<td align="right"><pre>(                )</pre></td>
			</tr>
			<tr>
				<td align="center"></td>
			</tr>
		</table>
		<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
			<tr>
				<th><br /><br /></th>
			</tr>
			<tr>
				<th align="left"></th>
			</tr>
		</table>
	</div>
</body>

</html>