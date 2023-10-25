<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Laporan Penjualan Kasir DP</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/laporan.css') ?>" />
</head>

<body onload="window.print()">
    <div id="laporan">
        <table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">

        </table>

        <table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
            <tr>
                <td colspan="2" style="width:800px;padding-left:20px;">
                    <center>
                        <h4>LAPORAN PENJUALAN KASIR DP</h4>
                    </center><br />
                </td>
            </tr>

        </table>

        <table border="0" align="center" style="width:900px;border:none;">
            <tr>
                <th style="text-align:left"></th>
            </tr>
        </table>
      <!-- Perulangan Customer -->
	  	<div class="mt-30">
		  <table border="1" align="center" style="width:900px;margin-bottom:20px;">
					<thead>
						<tr>
							<?php if ($nama == "") { ?>
								<th colspan="8" style="text-align:left;">Periode : <?= date('d M Y', strtotime($tanggal1)); ?> - <?= date('d M Y', strtotime($tanggal2)); ?><br></th>
							<?php } else { ?>
								<th colspan="8" style="text-align:left;">Periode : <?= date('d M Y', strtotime($tanggal1)); ?> - <?= date('d M Y', strtotime($tanggal2)); ?><br>Nama Customer / No. Hp : <?= $dt->nama . " - " . $dt->no_hp ?></th>
							<?php } ?>
						</tr>

						<tr>
							<th style="width:50px;">No</th>
							<th>No Faktur</th>
							<th>Customer</th>
							<th>Tanggal</th>
							<th>Total Penjualan</th>
							<th>Total Pembayaran</th>
							<th>Sisa Pembayaran</th>
							<th>Tanggal Transaksi Terakhir</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 0;
					
						$grandtotal = 0;
						foreach ($data as $idx => $i) {
							$no++;
							$nofak = $i['jual_nofak'];
							$nama = $i['nama'];
							$tgl = $i['jual_tanggal'];
							$total_penjualan = $i['jual_total'];
							$total_pembayaran = $i['total_pembayaran'];
							$sisa_pembayaran = $total_penjualan - $total_pembayaran ;
							$tgltransaksiterakhir = $i['tgl_pelunasan'];
							$grandtotal += $sisa_pembayaran;
						?>
							<tr>
								<td style="text-align:center;"><?php echo $no; ?></td>
								<td style="padding-left:5px;"><?php echo $nofak; ?></td>
								<td style="padding-left:5px;"><?php echo $nama; ?></td>
								<td style="text-align:center;"><?php echo $tgl; ?></td>
								<td style="text-align:right;"><?php echo 'Rp ' . number_format($total_penjualan); ?></td>
								<td style="text-align:right;"><?php echo 'Rp ' . number_format($total_pembayaran);?></td>
								<td style="text-align:right;"><?php echo 'Rp ' . number_format($sisa_pembayaran); ?></td>
								<td style="text-align:right;"><?php echo date('d M Y h:m', strtotime($tgltransaksiterakhir)); ?></td>
							</tr>
						<?php } ?>
					</tbody>
					<tfoot>

						<tr>
							<td colspan="6" style="text-align:center;"><b>Total</b></td>
							<td style="text-align:right;"><b><?php echo 'Rp ' . number_format($grandtotal); ?></b></td>
							<td style="text-align:center;"></td>
						</tr>
					</tfoot>
				</table>
		</div>
		<!-- End Perulangan Customer -->

		<!-- End Perulangan Barang -->
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
                <td align="right">( <?php echo $this->session->userdata('username'); ?> )</td>
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