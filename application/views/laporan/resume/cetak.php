<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>RESUME KEUANGAN</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/laporan.css') ?>" />
</head>

<body>
    <div id="laporan">
        <table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">

        </table>

        <table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
            <tr>
                <td colspan="2" style="width:800px;padding-left:20px;">
                    <center>
                        <h4>RESUME KEUANGAN </h4>
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

        ?>
        <table border="1" align="center" style="width:900px;margin-bottom:20px;">
            <thead>
                <tr>
                    <th colspan="11" style="text-align:left;">Periode : <?= $start; ?> - <?= $end; ?> <br> Saldo : Rp.  <?= number_format($saldo) ?> </th>
                </tr>
                <tr>
                    <th style="width:50px;">No</th>
                    <th>Metode Penjualan</th>
                    <th style="width:250px;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                               $totalPenjualan = 0;
                foreach ($getPenjualan as $value) {
$totalPenjualan += $value['total'];
                ?>
                    <tr>
                        <td style="text-align:center;"><?= $no++ ?></td>
                        <td style="text-align:left;">
                             <?= ($value['method_types']) ?> 
                        <td style="text-align:right;">Rp.
                            <?= number_format($value['total']) ?>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
            <tfoot>
  		 <tr>
                    <td colspan="2">Total Sisa DP</td>
                                      <td style="text-align:right;">Rp.
                        <?= number_format($getSisaDP->total * 1)?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Total Pengeluaran</td>
                                      <td style="text-align:right;">Rp.
                        <?= number_format($pengeluaran->pengeluaran)?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">Total Di Kasir</td>
                                          <td style="text-align:right;">Rp.
                            <?php $wes = 0;
						$wes = $saldo + $cashKasir['cash'] - $pengeluaran->pengeluaran; ?>
                         <?= number_format($wes); ?></td>
                        </td>
                </tr>
                <tr>
					<td colspan="2">Total Keseluruhan Penjualan </td>
					<td align="right">Rp. <?= number_format($totalPenjualan+ ($getSisaDP->total * 1) )?></td>
				</tr>
            </tfoot>
        </table>
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