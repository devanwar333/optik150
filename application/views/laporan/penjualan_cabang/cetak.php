<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Laporan Penjualan Kasir</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/laporan.css') ?>" />
</head>

<body onload="window.print()">
    <div id="laporan">
        <table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">
        </table>

        <table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
            <tr>
                <td colspan="2" style="width:800px;padding-left:20px;">
                    <center>
                        <h4>LAPORAN PENJUALAN CABANG</h4>
                    </center><br />
                </td>
            </tr>

        </table>

        <table border="0" align="center" style="width:900px;border:none;">
            <tr>
                <th style="text-align:left"></th>
            </tr>
        </table>

        <!-- Perulangan Cabang -->
        <?php
        if ($percabang) {
        ?>
            <h2 style="text-align:center;">Per Cabang</h2>
            <?php
            foreach ($data1 as $data) {
                $cabang = $data->cabang;
            ?>
                <table border="1" align="center" style="width:900px;margin-bottom:20px;">
                    <thead>
                        <tr>
                            <?php if ($barang == "") { ?>
                                <th colspan="11" style="text-align:left;">Periode : <?= date('d M Y', strtotime($tanggal1)); ?> - <?= date('d M Y', strtotime($tanggal2)); ?><br>Nama Cabang : <?= $cabang; ?></th>
                            <?php } else { ?>
                                <th colspan="11" style="text-align:left;">Periode : <?= date('d M Y', strtotime($tanggal1)); ?> - <?= date('d M Y', strtotime($tanggal2)); ?><br></th>
                            <?php  } ?>
                        </tr>

                        <tr>
                            <th style="width:50px;">No</th>
                            <th>No Faktur</th>
                            <th>Cabang</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Harga Jual</th>
                            <th>Qty</th>
                            <th>Keterangan</th>
                            <th>SubTotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $grandtotal = 0;
                        foreach ($data->items as $i) {
                            $no++;
                            $nofak = $i['jual_nofak'];
                            $cabang = $i['cabang'];
                            $tgl = $i['jual_tanggal'];
                            $nabar = $i['d_jual_barang_nama'];
                            $satuan = $i['d_jual_barang_satuan'];
                            $harjul = $i['d_jual_barang_harjul'];
                            $qty = $i['d_jual_qty'];
                            $diskon = $i['d_jual_diskon'];
                            $total = $i['d_jual_total'];
                            $grandtotal += $total;
                        ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $no; ?></td>
                                <td style="padding-left:5px;"><?php echo $nofak; ?></td>
                                <td style="padding-left:5px;"><?php echo $cabang; ?></td>
                                <td style="text-align:center;"><?php echo $tgl; ?></td>
                                <td style="text-align:left;"><?php echo $nabar; ?></td>
                                <td style="text-align:left;"><?php echo $satuan; ?></td>
                                <td style="text-align:right;"><?php echo 'Rp ' . number_format($harjul); ?></td>
                                <td style="text-align:center;"><?php echo $qty; ?></td>
                                <td style="text-align:left;"><?php echo nl2br(htmlspecialchars( $diskon)); ?></td>
                                <td style="text-align:right;"><?php echo 'Rp ' . number_format($total); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>

                        <tr>
                            <td colspan="9" style="text-align:center;"><b>Total</b></td>
                            <td style="text-align:right;"><b><?php echo 'Rp ' . number_format($grandtotal); ?></b></td>
                        </tr>
                    </tfoot>
                </table>
        <?php }
        } ?>

        <!-- Perulangan Barang -->
        <?php
        if ($perbarang) {
        ?>

            <h2 style="text-align:center;">Per Barang</h2>
            <?php
            foreach ($data2 as $data) {
                $barang = $data->barang;
            ?>
                <table border="1" align="center" style="width:900px;margin-bottom:20px;">
                    <thead>
                        <tr>
                            <?php if ($barang != "") { ?>
                                <th colspan="11" style="text-align:left;">Periode : <?= date('d M Y', strtotime($tanggal1)); ?> - <?= date('d M Y', strtotime($tanggal2)); ?><br>Nama Barang : <?= $barang; ?></th>
                            <?php } else { ?>
                                <th colspan="11" style="text-align:left;">Periode : <?= date('d M Y', strtotime($tanggal1)); ?> - <?= date('d M Y', strtotime($tanggal2)); ?><br></th>
                            <?php  } ?>
                        </tr>

                        <tr>
                            <th style="width:50px;">No</th>
                            <th>No Faktur</th>
                            <th>Cabang</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Harga Jual</th>
                            <th>Qty</th>
                            <th>Keterangan</th>
                            <th>SubTotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $grandtotal = 0;
                        foreach ($data->items as $i) {
                            $no++;
                            $nofak = $i['jual_nofak'];
                            $cabang = $i['cabang'];
                            $tgl = $i['jual_tanggal'];
                            $nabar = $i['d_jual_barang_nama'];
                            $satuan = $i['d_jual_barang_satuan'];
                            $harjul = $i['d_jual_barang_harjul'];
                            $qty = $i['d_jual_qty'];
                            $diskon = $i['d_jual_diskon'];
                            $total = $i['d_jual_total'];
                            $grandtotal += $total;
                        ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $no; ?></td>
                                <td style="padding-left:5px;"><?php echo $nofak; ?></td>
                                <td style="padding-left:5px;"><?php echo $cabang; ?></td>
                                <td style="text-align:center;"><?php echo $tgl; ?></td>
                                <td style="text-align:left;"><?php echo $nabar; ?></td>
                                <td style="text-align:left;"><?php echo $satuan; ?></td>
                                <td style="text-align:right;"><?php echo 'Rp ' . number_format($harjul); ?></td>
                                <td style="text-align:center;"><?php echo $qty; ?></td>
                                <td style="text-align:right;"><?php echo nl2br(htmlspecialchars( $diskon)); ?></td>
                                <td style="text-align:right;"><?php echo 'Rp ' . number_format($total); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>

                        <tr>
                            <td colspan="9" style="text-align:center;"><b>Total</b></td>
                            <td style="text-align:right;"><b><?php echo 'Rp ' . number_format($grandtotal); ?></b></td>
                        </tr>
                    </tfoot>
                </table>
        <?php }
        } ?>

        <!-- Perulangan Kategori Barang -->
        <?php
        if ($perkatbarang) {
        ?>
            <h2 style="text-align:center;">Per Kategori</h2>
            <?php
            foreach ($data3 as $data) {
                $kategori = $data->kategori;
            ?>
                <table border="1" align="center" style="width:900px;margin-bottom:20px;">
                    <thead>
                        <tr>
                            <?php if ($kategori != "") { ?>
                                <th colspan="11" style="text-align:left;">Periode : <?= date('d M Y', strtotime($tanggal1)); ?> - <?= date('d M Y', strtotime($tanggal2)); ?><br>Kategori : <?= $kategori; ?></th>
                            <?php } else { ?>
                                <th colspan="11" style="text-align:left;">Periode : <?= date('d M Y', strtotime($tanggal1)); ?> - <?= date('d M Y', strtotime($tanggal2)); ?><br></th>
                            <?php  } ?>
                        </tr>

                        <tr>
                            <th style="width:50px;">No</th>
                            <th>No Faktur</th>
                            <th>Cabang</th>
                            <th>Tanggal</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Harga Jual</th>
                            <th>Qty</th>
                            <th>Keterangan</th>
                            <th>SubTotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $grandtotal = 0;
                        foreach ($data->items as $i) {
                            $no++;
                            $nofak = $i['jual_nofak'];
                            $cabang = $i['cabang'];
                            $tgl = $i['jual_tanggal'];
                            $nabar = $i['d_jual_barang_nama'];
                            $satuan = $i['d_jual_barang_satuan'];
                            $harjul = $i['d_jual_barang_harjul'];
                            $qty = $i['d_jual_qty'];
                            $diskon = $i['d_jual_diskon'];
                            $total = $i['d_jual_total'];
                            $grandtotal += $total;
                        ?>
                            <tr>
                                <td style="text-align:center;"><?php echo $no; ?></td>
                                <td style="padding-left:5px;"><?php echo $nofak; ?></td>
                                <td style="padding-left:5px;"><?php echo $cabang; ?></td>
                                <td style="text-align:center;"><?php echo $tgl; ?></td>
                                <td style="text-align:left;"><?php echo $nabar; ?></td>
                                <td style="text-align:left;"><?php echo $satuan; ?></td>
                                <td style="text-align:right;"><?php echo 'Rp ' . number_format($harjul); ?></td>
                                <td style="text-align:center;"><?php echo $qty; ?></td>
                                <td style="text-align:right;"><?php echo nl2br(htmlspecialchars( $diskon)); ?></td>
                                <td style="text-align:right;"><?php echo 'Rp ' . number_format($total); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>

                        <tr>
                            <td colspan="9" style="text-align:center;"><b>Total</b></td>
                            <td style="text-align:right;"><b><?php echo 'Rp ' . number_format($grandtotal); ?></b></td>
                        </tr>
                    </tfoot>
                </table>
        <?php }
        } ?>


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