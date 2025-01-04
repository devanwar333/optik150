<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Laporan Penjualan Kasir</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/laporan.css') ?>" />
    <style>


    </style>
</head>

<body onload="window.print()">
    <div id="laporan">
        

        <?php
        $cabang = "";
        $no = 0;
        $grandtotal = 0;
        foreach ($data as $key=> $item) {
            
        ?>
            <?php
            if ($cabang!=$item['cabang']) {
                $cabang = $item['cabang'];
                $no = 0;
                $grandtotal = 0;
            ?>
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
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>SubTotal</th>
                    </tr>
                </thead>
                <tbody>
            <?php }?>
            <?php
            if ($cabang==$item['cabang']) {
                
                $no++;
                $nofak = $item['jual_nofak'];
                $tgl = $item['jual_tanggal'];
                $keterangan = $item['jual_keterangan'].'-'.$i['jual_keterangan2'];
                $total = $item['total'];
                $grandtotal += $total;
            ?>
            
             
                
                    <tr>
                        <td style="text-align:center;"><?php echo $no; ?></td>
                        <td style="padding-left:5px;"><?php echo $nofak; ?></td>
                       
                        <td style="text-align:center;"><?php echo $tgl; ?></td>
                        <td style="text-align:right;"><?php echo $keterangan; ?></td>
                        <td style="text-align:right;"><?php echo 'Rp ' . number_format($total); ?></td>
                    </tr>
            <?php }?>
        

            <?php
            
            if (($key + 1) == count($data) || $data[$key+1]['cabang']!=$cabang) {
              
            ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" style="text-align:center;"><b>Total</b></td>
                            <td style="text-align:right;"><b><?php echo 'Rp ' . number_format($grandtotal); ?></b></td>
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
                <?php
                    if (($key + 1) < count($data) ) {
                ?>
                <div class="page-break"></div>
                
                
        <?php } } } ?>
    </div>
</body>

</html>