<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Surat Jalan Barang</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/laporan.css') ?>" />
    <style>
        
        </style>
</head>

<body onload="window.print()">
<!-- <body > -->
    <div id="laporan">
        <table align="center" style="width:302px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">

        </table>

        <table border="0" align="center" style="width:302px; border:none;margin-top:5px;margin-bottom:0px;">
            <tr>

            </tr>

        </table>
        <?php
        $b = $data->row_array();
        ?>
        <table border="0" align="center" style="width:302px;border:none;">
            <?php
            $data1 = $this->db->query("select * from tbl_setting where id=2")->row_array();
            $data2 = $this->db->query("select * from tbl_setting where id=3")->row_array();
            $data3 = $this->db->query("select * from tbl_setting where id=4")->row_array();
            $data4 = $this->db->query("select * from tbl_setting where id=5")->row_array();
            ?>
            <center><img src="<?= base_url('assets/logo/') ?><?= $data4['fitur']; ?>" alt="logo" width="130px"></center>
            <center>
                <h4 style="font-size:10pt"><?= $data1['fitur']; ?></h4>
            </center>
            <center style="font-size:10pt"><?= $data2['fitur']; ?></center>
            <center style="font-size:10pt"><?= $data3['fitur']; ?></center>
            <br>
            <hr style="width:302px">
            <br>
            <tr>
                <th style="text-align:left;font-size:10pt">Surat Jalan</th>
                <th style="text-align:left;font-size:10pt">: <?php echo $b['surat_jalan']; ?></th>

            </tr>
            <tr>
                <th style="text-align:left;font-size:10pt">No Faktur</th>
                <th style="text-align:left;font-size:10pt">: <?php echo $b['jual_nofak']; ?></th>

            </tr>
            <tr>
                <th style="text-align:left;font-size:10pt">Tanggal</th>
                <th style="text-align:left;font-size:10pt">: <?= $b['jual_tanggal']
                                                ?></th>
            </tr>
            <?php

            ?>
            <tr>
                <th style="text-align:left;font-size:10pt">Nama Cabang</th>
                <th style="text-align:left;font-size:10pt">: <?php echo $b['cabang']; ?></th>

            </tr>


            <tr>
                <td><br></td>
            </tr>

        </table>

        <table border="0" align="center" style="width:302px;margin-bottom:20px;border:none;">
            <thead>

                <tr>
                    <th style="width:25px;font-size:10pt">No</th>
                    <th style="width:25px;font-size:10pt">Nama Barang</th>
                    <th style="width:25px;font-size:10pt">Qty</th>
                    <th style="width:25px;font-size:10pt">Keterangan</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data->result_array() as $i) {
                    $no++;

                    $nabar = $i['d_jual_barang_nama'];
                    $satuan = $i['d_jual_barang_satuan'];
                    $qty = $i['d_jual_qty'];
                    $diskon = $i['d_jual_diskon'];
                    $total = $i['d_jual_total'];
                ?>
                    <tr>
                        <td style="text-align:center;font-size:10pt"><?php echo $no; ?></td>
                        <td style="text-align:center;font-size:10pt"><?php echo $nabar; ?></td>


                        <td style="text-align:center;font-size:10pt"><?php echo $qty; ?></td>
                        <td style="text-align:left;font-size:10pt"><?php echo nl2br(htmlspecialchars( $diskon)); ?></td>
                      
                    </tr>
                <?php } ?>
            </tbody>
            <br>
            <hr style="width:302px">
            <br>
        </table>

        <table align="center" style="width:302px; border:none;margin-top:5px;margin-bottom:20px;">

            <tr>
                <th style="text-align:left;font-size:12pt">Keterangan</th>
                <th style="text-align:left;font-size:12pt">: <?php echo $b['diskon']; ?></th>
            </tr>

           
        </table>
        <table align="center" style="width:302px; border:none;margin-top:5px;margin-bottom:20px;">


            <tr>
                <td align="right"></td>
            </tr>

            <tr>
                <td><br /><br /><br /><br /></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td align="center"><b>----TERIMA KASIH----</b></td>
            </tr>
            <tr>
                <td align="center"></td>
            </tr>
        </table>
        <table align="center" style="width:302px; border:none;margin-top:5px;margin-bottom:20px;">
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