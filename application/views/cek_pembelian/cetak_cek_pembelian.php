<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
	<title>Cetak Cek Stok</title>
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
						<h4>CETAK CEK STOK</h4>
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
					
					<tr>
						<th colspan="7" style="text-align:left;">
							Nama Toko: <?=	$nama_toko  ?><br>
						</th>
					</tr>
					<tr>
						<th colspan="7" style="text-align:left;">
							Periode: <?= date('d M Y', strtotime($start)); ?> - <?= date('d M Y', strtotime($end)); ?><br>
						</th>
					</tr>

					<tr>
						<th style="width:200px;">Nama Barang</th>
						<th style="width:200px;">Keterangan</th>
                        <th style="width:200px;">Nama Supplier</th>
                        <th style="width:200px;">Tanggal</th>
                        <th style="width:200px;">No Faktur</th>
                        <th style="width:200px;">Qty</th>
                        
						
					</tr>
				</thead>
				<tbody>
                    <?php 
                        $total = 0;
                        foreach($data as $item) {
                            $total += $item['qty'];
                    ?>
                        <tr>
                            <td style="text-align:center;"><?php echo $item['barang_nama']; ?></td>
                            <td style="text-align:center;"><?php echo $item['keterangan']; ?></td>
                            <td style="text-align:center;"><?php echo $item['suplier_nama']; ?></td>
                            <td style="text-align:center;"><?php echo $item['beli_tanggal']; ?></td>
                            <td style="text-align:center;">
                                <a href="<?= base_url() ?>/history_pembelian/in_detail/<?php echo $item['d_beli_nofak'];?>">
                                    <?php echo $item['d_beli_nofak']; ?>
                                </a>
                            </td>
                            <td style="text-align:center;"><?php echo $item['qty']; ?></td>
                           
                        </tr>
                    <?php }?>
                    <tr>
                        <td style="text-align:center;" colspan="5"><b>Total</b></td>
                        <td style="text-align:center;"><?php echo $total; ?></td>
                        
                    </tr>
				</tbody>
				
			</table>
		</div>
	</div>
</body>

</html>