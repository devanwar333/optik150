<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Laporan</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- FLASH DATA -->
            <?php
            $dat = $this->session->flashdata('msg');
            if ($dat != "") { ?>
                <div id="notifikasi" class="alert alert-success"><strong>Sukses! </strong> <?= $dat; ?></div>
            <?php } ?>
            <?php
            $dat1 = $this->session->flashdata('error');
            if ($dat1 != "") { ?>
            <div id="notifikasi" class="alert alert-danger"><strong>Gagal </strong> <?= $dat1; ?></div>
            <?php } ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            
                            <th>Laporan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
              
                    <tbody>
                        <?php if ($this->session->userdata('level') == 'penjualan') { ?>
                            <tr>
                                
                                <td style="vertical-align:middle;">Rekap Penjualan</td>
                                <td style="text-align:center;">
                                    <a class="btn btn-sm btn-primary" href="#lap_penjualan" data-toggle="modal"><span class="fa fa-print"></span> Cetak</a>

                                </td>
                            </tr>
                        <?php } ?>
                        <?php if ($this->session->userdata('level') == 'pembelian') { ?>
                            <tr>
                                
                                <td style="vertical-align:middle;">Rekap Pembelian</td>
                                <td style="text-align:center;">
                                    <a class="btn btn-sm btn-primary" href="#lap_pembelian" data-toggle="modal"><span class="fa fa-print"></span> Cetak</a>

                                </td>
                            </tr>
                        <?php } ?>
                
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>

<!-- End of Main Content -->

<div class="modal fade" id="lap_penjualan">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Penjualan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <?php echo form_open('Laporan_V2/cetak_penjualan_cabang_v2',array("target"=>"_blank")) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-xs-3">Tanggal Awal</label>
                    <div class="col-xs-9">
                        <input type="date" class="form-control" name="tgl1" id="tgl1" value="" placeholder="Tanggal" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-3">Tanggal Akhir</label>
                    <div class="col-xs-9">
                        <input type="date" class="form-control" name="tgl2" id="tgl2" value="" onchange="listCustomer()" placeholder="Tanggal" required>
                    </div>
                </div>  
                <div class="form-group ">
                    <label class="control-label col-xs-3">Nama Barang</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="nama" placeholder="Search * Applicable" require>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="control-label col-xs-3">Kategori Barang</label>
                    <div class="col-xs-9">
                        <select class="form-control" name="kategori">
                            <option value="UMUM" selected>UMUM</option>
                            <option value="LG" >LG</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button class="btn btn-success"><span class="fa fa-print"></span> Print</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="lap_pembelian">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Pembelian</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <?php echo form_open('Laporan_V2/cetak_pembelian_cabang_v2',array("target"=>"_blank")) ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-xs-3">Tanggal Awal</label>
                    <div class="col-xs-9">
                        <input type="date" class="form-control" name="tgl1" id="tgl1" value="" placeholder="Tanggal" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-xs-3">Tanggal Akhir</label>
                    <div class="col-xs-9">
                        <input type="date" class="form-control" name="tgl2" id="tgl2" value="" onchange="listCustomer()" placeholder="Tanggal" required>
                    </div>
                </div>  
                
                <div class="form-group ">
                    <label class="control-label col-xs-3">Nama Barang</label>
                    <div class="col-xs-9">
                        <input type="text" class="form-control" name="nama" placeholder="Search * Applicable" require>
                    </div>
                </div>
                <div class="form-group ">
                    <label class="control-label col-xs-3">Kategori Barang</label>
                    <div class="col-xs-9">
                        <select class="form-control" name="kategori">
                            <option value="UMUM" selected>UMUM</option>
                            <option value="LG" >LG</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button class="btn btn-success"><span class="fa fa-print"></span> Print</button>
            </div>
            </form>
        </div>
    </div>
</div>
