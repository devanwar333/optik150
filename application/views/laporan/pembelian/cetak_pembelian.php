<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <title>Laporan data Pembelian</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/css/laporan.css') ?>" />

</head>

<body onload="window.print()">
    <div id="laporan">
     

        <?php
        $suplier = "";
        $no = 0;
        $grandtotal = 0;
        foreach ($data as $key=> $item) {
            
        ?>
            <?php
                if ($suplier!=$item->suplier_id) {
                    $suplier = $item->suplier_id;
                    $no = 0;
                    $grandtotal = 0;
            ?>
   <table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">
        </table>

        <table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
            <tr>
                <td colspan="2" style="width:800px;padding-left:20px;">
                    <center>
                        <h4>LAPORAN PEMBELIAN</h4>
                    </center><br />
                </td>
            </tr>
        </table>
            <table border="1" align="center" style="width:900px;margin-bottom:20px;">
                <thead>
                    <tr>
                        <th colspan="11" style="text-align:left;">Periode : <?= date('d M Y', strtotime($tanggal1)); ?> - <?= date('d M Y', strtotime($tanggal2)); ?><br>Nama Supplier : <?= $item->suplier_nama; ?></th>
                    </tr>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>No Faktur</th>
                        <th>Tanggal</th>
                    
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
            <?php }?>
            <?php
                if ($suplier==$item->suplier_id) {
                    $no++;
                    $grandtotal += $item->total;
            ?>
                    <tr>
                        <td style="text-align:center;"><?= $no; ?></td>
                        <td style="text-align:center;"><?= $item->beli_nofak; ?></td>
                        <td style="text-align:center;"><?= date('d-M-Y', strtotime($item->beli_tanggal)); ?></td>
                    
                        <td style="text-align:right;"><?= 'Rp ' . number_format($item->total); ?></td>
                    </tr>
            <?php } ?>
            <?php
            
            if (($key + 1) == count($data) || $data[$key+1]->suplier_id!=$suplier) {
              
            ?>
                    </tbody>
                    <tfoot>
                        
                        <tr>
                            <td colspan="3" style="text-align:center;"><b>Total</b></td>
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
                        <td align="right">Medan, <?= date('d-M-Y') ?></td>
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