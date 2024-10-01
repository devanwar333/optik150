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
        <table align="center" style="width:500px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">

        </table>

        <table border="0" align="center" style="width:500px; border:none;margin-top:5px;margin-bottom:0px;">
            <tr>

            </tr>

        </table>
        <?php
        
        ?>
        <table border="0" align="center" style="width:500px;border:none;">
            <?php
            $data1 = $this->db->query("select * from tbl_setting where id=2")->row_array();
            $data2 = $this->db->query("select * from tbl_setting where id=3")->row_array();
            $data3 = $this->db->query("select * from tbl_setting where id=4")->row_array();
            $data4 = $this->db->query("select * from tbl_setting where id=5")->row_array();
            ?>
            <center><img src="<?= base_url('assets/logo/') ?><?= $data4['fitur']; ?>" alt="logo" width="130px"></center>
            <center>
                <h4 style="font-size:15pt"><?= $data1['fitur']; ?></h4>
            </center>
            <center style="font-size:15pt"><?= $data2['fitur']; ?></center>
            <center style="font-size:15pt"><?= $data3['fitur']; ?></center>
            <br>
            <hr style="width:500px">
            <br>
            
            <tr>
                <th style="text-align:left;font-size:15pt">No Faktur Beli</th>
                <th style="text-align:left;font-size:15pt">: <?php echo $header['d_beli_nofak']; ?></th>

            </tr>
            <tr>
                <th style="text-align:left;font-size:15pt">Tanggal</th>
                <th style="text-align:left;font-size:15pt">: <?= $header['beli_tanggal']
                                                ?></th>
            </tr>
            <?php

            ?>
            <tr>
                <th style="text-align:left;font-size:15pt">Nama Supplier</th>
                <th style="text-align:left;font-size:15pt">: <?php echo $header['suplier_nama']; ?></th>

            </tr>


            <tr>
                <td><br></td>
            </tr>

        </table>

        <table border="0" align="center" style="width:500px;margin-bottom:20px;border:none;">
            <thead>

                <tr>
                    <th style="width:25px;font-size:15pt">No</th>
                    <th style="width:25px;font-size:15pt">Nama Barang</th>
                    <th style="width:25px;font-size:15pt">Qty</th>
                    <th style="width:25px;font-size:15pt">Keterangan</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;
                foreach ($data as $i) {
                    $no++;

                    $nabar = $i['barang_nama'];
                    
                    $qty = $i['d_beli_jumlah'];
                    $keterangan = $i['keterangan'];
                    
                ?>
                    <tr>
                        <td style="text-align:center;font-size:15pt"><?php echo $no; ?></td>
                        <td style="text-align:center;font-size:15pt"><?php echo $nabar; ?></td>
                        <td style="text-align:center;font-size:15pt"><?php echo $qty; ?></td>
                        <td style="text-align:center;font-size:15pt"><?php echo $keterangan; ?></td>
                      
                    </tr>
                <?php } ?>
            </tbody>
            <br>
            <hr style="width:500px">
            <br>
        </table>

        <table align="center" style="width:500px; border:none;margin-top:5px;margin-bottom:20px;">


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

     
    </div>
</body>

</html>