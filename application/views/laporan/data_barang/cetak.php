<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>laporan data barang</title>
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
                        <h4>LAPORAN DATA BARANG</h4>
                    </center><br />
                </td>
            </tr>

        </table>

        <table border="0" align="center" style="width:900px;border:none;">
            <tr>
                <th style="text-align:left"></th>
            </tr>
        </table>

        <table border="1" align="center" style="width:900px;margin-bottom:20px;">
            <tr>
                <td><b>Kategori: <?= $data['kategori_nama'] ?></b></td>
            </tr>
            <thead>
                <tr>
                    <td>No.</td>
                    <td>Nama Barang</td>
                    <td>Satuan</td>
                    <td>Harga Jual</td>
                    <td>Stok</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $urut = 0;
                $nomor = 0;
                $group = '-';
                foreach ($data as $d) {
                    $nomor++;
                    $urut++;

                    $nomor = 1;
                    // }
                    // $group = $d['kategori_nama'];
                    // if ($urut == 500) {
                    //     $nomor = 0;
                    //     echo "<div class='pagebreak'> </div>";
                    // }
                ?>
                    <tr>
                        <td style="text-align:center;vertical-align:center;text-align:center;"><?php echo $nomor; ?></td>
                        <td style="vertical-align:center;padding-left:5px;"><?php echo $d['barang_nama']; ?></td>
                        <td style="vertical-align:center;text-align:center;"><?php echo $d['barang_satuan']; ?></td>
                        <td style="vertical-align:center;padding-right:5px;text-align:right;"><?php echo 'Rp ' . number_format($d['barang_harjul']); ?></td>
                        <td style="vertical-align:center;text-align:center;text-align:center;"><?php echo $d['barang_stok']; ?></td>
                    </tr>


                <?php
                }
                ?>
            </tbody>

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
                <td align="right">( <?php echo $this->session->userdata('nama'); ?> )</td>
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