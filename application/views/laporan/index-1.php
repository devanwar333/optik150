        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Data Laporan</h1>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <!-- FLASH DATA -->
                    <?php
                    $dat = $this->session->flashdata('msg');
                    if ($dat != "") { ?>
                        <div id="notifikasi" class="alert alert-success"><strong>Sukses! </strong> <?= $dat; ?></div>
                    <?php } ?>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Laporan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <!-- <tfoot>
                    <tr>
                    <th>No</th>
                      <th>Laporan</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot> -->
                            <tbody>

                                <tr>
                                    <td style="text-align:center;vertical-align:middle">1</td>
                                    <td style="vertical-align:middle;">Stok Barang</td>
                                    <td style="text-align:center;">
                                        <a class="btn btn-sm btn-success" href="#lap_data_barang" data-toggle="modal"><span class="fa fa-eye"></span> View</a>
                                        <!-- <a class="btn btn-sm btn-success" href="<?php echo site_url('laporan/lap_data_barang') ?>"><span class="fa fa-print"></span> View</a> -->
                                        <a class="btn btn-sm btn-success" href="<?php echo site_url('laporan/lap_data_barang_cetak') ?>" target="_blank"><span class="fa fa-print"></span> Print</a>
                                    </td>
                                </tr>

                                <!-- <tr>
                                    <td style="text-align:center;vertical-align:middle">2</td>
                                    <td style="vertical-align:middle;">Laporan Stok Barang</td>
                                    <td style="text-align:center;">
                                        <a class="btn btn-sm btn-success" href="<?php echo site_url('laporan/lap_stok_barang') ?>"><span class="fa fa-print"></span> View</a>
                                        <a class="btn btn-sm btn-success" href="<?php echo site_url('laporan/lap_stok_barang_cetak') ?>" target="_blank"><span class="fa fa-print"></span> Print</a>
                                    </td>
                                </tr> -->

                                <!-- <tr>
                                    <td style="text-align:center;vertical-align:middle">2</td>
                                    <td style="vertical-align:middle;">Laporan Penjualan</td>
                                    <td style="text-align:center;">
                                        <a class="btn btn-sm btn-success" href="<?php echo site_url('laporan/lap_data_penjualan') ?>"><span class="fa fa-print"></span> View</a>
                                        <a class="btn btn-sm btn-success" href="<?php echo site_url('laporan/lap_data_penjualan_cetak') ?>" target="_blank"><span class="fa fa-print"></span> Print</a>
                                    </td>
                                </tr> -->

                                <tr>
                                    <td style="text-align:center;vertical-align:middle">2</td>
                                    <td style="vertical-align:middle;">Laporan Penjualan Kasir</td>
                                    <td style="text-align:center;">
                                        <a class="btn btn-sm btn-success" href="#penjualan_kasir" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;vertical-align:middle">3</td>
                                    <td style="vertical-align:middle;">Laporan Penjualan Kasir DP</td>
                                    <td style="text-align:center;">
                                        <a class="btn btn-sm btn-success" href="#penjualan_kasir_dp" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="text-align:center;vertical-align:middle">4</td>
                                    <td style="vertical-align:middle;">Laporan Penjualan Cabang</td>
                                    <td style="text-align:center;">
                                        <a class="btn btn-sm btn-success" href="#penjualan_cabang" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="text-align:center;vertical-align:middle">5</td>
                                    <td style="vertical-align:middle;">Laporan Pembelian</td>
                                    <td style="text-align:center;">
                                        <a class="btn btn-sm btn-success" href="#laporan_pembelian" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;vertical-align:middle">6</td>
                                    <td style="vertical-align:middle;">Laporan Penjualan Kwitansi</td>
                                    <td style="text-align:center;">
                                        <a class="btn btn-sm btn-success" href="#penjualan_kwitansi" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                                    </td>
                                </tr>
                                <!-- <tr>
                                    <td style="text-align:center;vertical-align:middle">4</td>
                                    <td style="vertical-align:middle;">Laporan Penjualan Per Kategori Barang</td>
                                    <td style="text-align:center;">
                                        <a class="btn btn-sm btn-success" href="#lap_penjualan_kat_barang" data-toggle="modal"><span class="fa fa-eye"></span> View</a>
                                        <a class="btn btn-sm btn-success" href="#lap_penjualan_kat_barang_cetak" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                                    </td>
                                </tr> -->

                                <!-- <tr>
                                    <td style="text-align:center;vertical-align:middle">6</td>
                                    <td style="vertical-align:middle;">Laporan Laba/Rugi</td>
                                    <td style="text-align:center;">
                                        <a class="btn btn-sm btn-success" href="#lap_laba_rugi" data-toggle="modal"><span class="fa fa-print"></span> View</a>
                                        <a class="btn btn-sm btn-success" href="#lap_laba_rugi_cetak" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                                    </td>
                                </tr> -->

                                <tr>
                                    <td style="text-align:center;vertical-align:middle">7</td>
                                    <td style="vertical-align:middle;">Laporan Pengeluaran Toko</td>
                                    <td style="text-align:center;">
                                        <!-- <a class="btn btn-sm btn-success" href="#lap_pengeluaran_toko" data-toggle="modal"><span class="fa fa-eye"></span> View</a> -->
                                        <a class="btn btn-sm btn-success" href="#lap_pengeluaran_toko_cetak" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;vertical-align:middle">8</td>
                                    <td style="vertical-align:middle;">Resume Laporan Keuangan</td>
                                    <td style="text-align:center;">
                                        <!-- <a class="btn btn-sm btn-success" href="#lap_resume" data-toggle="modal"><span class="fa fa-eye"></span> View</a> -->
                                        <a class="btn btn-sm btn-success" href="#lap_resume_cetak" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

        </div>

        <!-- End of Main Content -->


        <!---------------------------------------------Laporan Data Barang--------------------------------------------->

        <div class="modal fade" id="lap_data_barang">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Pilih Kategori</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <?php echo form_open('Laporan/filter_barang_by_kategori') ?>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label col-xs-3">Kategori Barang</label>
                            <div class="col-xs-9">
                                <select class="form-control" name="kategori_nama">
                                    <option value="-" selected>Kategori Barang </option>
                                    <?php foreach ($listBarang as $value) { ?>
                                        <option value="<?= $value->kategori_id ?>"><?= $value->kategori_nama ?></option>
                                    <?php } ?>
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

        <!---------------------------------------------Laporan Penjualan KASIR--------------------------------------------->

        <div class="modal fade" id="penjualan_kasir">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Penjualan Kasir</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <?php echo form_open('Laporan/lap_penjualan_periode_cetak', 'target="_blank"') ?>
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

                        <label class="control-label col-xs-6">Nama Customer</label>
                        <div class="col-xs-9">
                            <select name="nama_customer" id="nama_customer" class="form-control" onchange="listCustomer_Barang()">
                                <option value="" selected>Customer</option>
                                <?php foreach ($customer->result() as $value) { ?>
                                    <option value="<?= $value->no_hp ?>"><?= $value->nama . " - " . $value->no_hp ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="control-label col-xs-6">Kategori Barang</label>
                        <div class="col-xs-9">
                            <select name="kategori_barang" class="form-control">
                                <option value="" selected>Kategori Barang</option>
                                <?php foreach ($kat->result() as $value) { ?>
                                    <option value="<?= $value->kategori_id ?>"><?= $value->kategori_nama ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="control-label col-xs-6">Barang</label>
                        <div class="col-xs-9">
                            <select name="nama_barang" id="nama_barang" class="form-control">
                                <option value="" selected>Barang</option>
                            </select>
                        </div>
                        <label class="control-label col-xs-6">Cara Bayar</label>
                        <div class="col-xs-9">
                            <select name="cara_bayar" id="cara_bayar" class="form-control">
                                <option value="all" selected>Cara Bayar</option>
                                <?php foreach ($cara_bayar as $value) { ?>
                                    <option value="<?= $value->cara_bayar ?>"><?= $value->cara_bayar ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="control-label col-xs-6 mt-3">Tampilkan</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="percustomer" name="percustomer" checked>
                            <label class="form-check-label" for="percustomer">
                                Per Customer
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="perkatbarang" name="perkatbarang" checked>
                            <label class="form-check-label" for="perkatbarang">
                                Per Kategori Barang
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="perbarang" name="perbarang" checked>
                            <label class="form-check-label" for="perbarang">
                                Per Barang
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="percarabayar" name="percarabayar" checked>
                            <label class="form-check-label" for="percarabayar">
                                Per Cara Bayar
                            </label>
                        </div>



                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-success"><span class="fa fa-print"></span> Cetak</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!---------------------------------------------Laporan Penjualan KASIR DP--------------------------------------------->

        <div class="modal fade" id="penjualan_kasir_dp">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Penjualan Kasir DP</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <form id="form_penjualan_kasir_dp" action="<?= base_url('Laporan/laporan_penjualan_kasir_dp') ?>" method="post" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3">Tanggal Awal</label>
                                <div class="col-xs-9">
                                    <input type="date" class="form-control" name="tgl1" value="" placeholder="Tanggal" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-xs-3">Tanggal Akhir</label>
                                <div class="col-xs-9">
                                    <input type="date" class="form-control" name="tgl2" value="" onchange="listCustomer_dp()" placeholder="Tanggal" required>
                                </div>
                            </div>

                            <label class="control-label col-xs-6">Nama Customer</label>
                            <div class="col-xs-9">
                                <select name="nama_customer" class="form-control" onchange="listCustomer_Barang_dp()">
                                    <option value="" selected>Customer</option>
                                    <?php foreach ($customer->result() as $value) { ?>
                                        <option value="<?= $value->no_hp ?>"><?= $value->nama . " - " . $value->no_hp ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label class="control-label col-xs-6">Kategori Barang</label>
                            <div class="col-xs-9">
                                <select name="kategori_barang" class="form-control">
                                    <option value="" selected>Kategori Barang</option>
                                    <?php foreach ($kat->result() as $value) { ?>
                                        <option value="<?= $value->kategori_id ?>"><?= $value->kategori_nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label class="control-label col-xs-6">Barang</label>
                            <div class="col-xs-9">
                                <select name="nama_barang" class="form-control">
                                    <option value="" selected>Barang</option>
                                </select>
                            </div>

                            <label class="control-label col-xs-6 mt-3">Tampilkan</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="percustomer2" name="percustomer" checked>
                                <label class="form-check-label" for="percustomer">
                                    Per Customer
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="perkatbarang2" name="perkatbarang" checked>
                                <label class="form-check-label" for="perkatbarang">
                                    Per Kategori Barang
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="perbarang2" name="perbarang" checked>
                                <label class="form-check-label" for="perbarang">
                                    Per Barang
                                </label>
                            </div>


                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button class="btn btn-success"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!---------------------------------------------Laporan Pembelian--------------------------------------------->
        <div class="modal fade" id="laporan_pembelian">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Laporan Pembelian</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <form id="form_laporan_pembelian" action="<?= base_url('Laporan/laporan_pembelian') ?>" method="post" target="_blank">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-xs-3">Tanggal Awal</label>
                                <div class="col-xs-9">
                                    <input type="date" class="form-control" name="tgl1" placeholder="Tanggal" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Tanggal Akhir</label>
                                <div class="col-xs-9">
                                    <input type="date" class="form-control" name="tgl2" value="" onchange="listSupplier_pembelian()" placeholder="Tanggal" required>
                                </div>
                            </div>
                            <label class="control-label col-xs-6">Supplier</label>
                            <div class="col-xs-9">
                                <select name="supplier" class="form-control" onchange="listSupplier_pembelianBarang()">
                                    <option value="-" selected>Supplier</option>
                                    <?php foreach ($supplier->result() as $value) { ?>
                                        <option value="<?= $value->suplier_id ?>"><?= $value->suplier_nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label class="control-label col-xs-6">Barang</label>
                            <div class="col-xs-9">
                                <select name="nama_barang" class="form-control">
                                    <option value="" selected>Barang</option>
                                </select>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button class="btn btn-success"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!---------------------------------------------Laporan Cabang--------------------------------------------->
        <div class="modal fade" id="penjualan_cabang">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Penjualan Cabang</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <form id="form_penjualan_cabang" action="<?= base_url('Laporan/penjualan_cabang') ?>" method="post" target="_blank">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-xs-3">Tanggal Awal</label>
                                <div class="col-xs-9">
                                    <input type="date" class="form-control" name="tgl1" placeholder="Tanggal" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Tanggal Akhir</label>
                                <div class="col-xs-9">
                                    <input type="date" class="form-control" name="tgl2" value="" onchange="listPenjualan_cabang()" placeholder="Tanggal" required>
                                </div>
                            </div>
                            <label class="control-label col-xs-6">Cabang</label>
                            <div class="col-xs-9">
                                <select name="cabang" class="form-control" onchange="listPenjualan_cabangBarang()">
                                    <option value="-" selected>Cabang</option>
                                    <?php foreach ($cabang as $value) { ?>
                                        <option value="<?= $value->nama_cabang ?>"><?= $value->nama_cabang ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label class="control-label col-xs-6">Kategori Barang</label>
                            <div class="col-xs-9">
                                <select name="kategori_barang" id="kategori_barang" class="form-control">
                                    <option value="" selected>Kategori Barang</option>
                                    <?php foreach ($kat->result() as $value) { ?>
                                        <option value="<?= $value->kategori_id ?>"><?= $value->kategori_nama ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <label class="control-label col-xs-6">Barang</label>
                            <div class="col-xs-9">
                                <select name="nama_barang" class="form-control">
                                    <option value="" selected>Barang</option>
                                </select>
                            </div>
                            <label class="control-label col-xs-6 mt-3">Tampilkan</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="percabang" name="percabang" checked>
                                <label class="form-check-label" for="percabang">
                                    Per Cabang
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="perkatbarang1" name="perkatbarang" checked>
                                <label class="form-check-label" for="perkatbarang1">
                                    Per Kategori Barang
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="perbarang1" name="perbarang" checked>
                                <label class="form-check-label" for="perbarang1">
                                    Per Barang
                                </label>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button class="btn btn-success"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!---------------------------------------------Laporan Penjualan Kwitansi--------------------------------------------->
        <div class="modal fade" id="penjualan_kwitansi">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Penjualan Kwitansi</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <form id="form_penjualan_kwitansi" action="<?= base_url('Laporan/penjualan_kwitansi') ?>" method="post" target="_blank">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label col-xs-3">Tanggal Awal</label>
                                <div class="col-xs-9">
                                    <input type="date" class="form-control" name="tgl1" placeholder="Tanggal" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-3">Tanggal Akhir</label>
                                <div class="col-xs-9">
                                    <input type="date" class="form-control" name="tgl2" value="" placeholder="Tanggal" required>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button class="btn btn-success"><span class="fa fa-print"></span> Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!---------------------------------------------Laporan Penjualan Barang--------------------------------------------->

        <div class="modal fade" id="lap_jual_barang">
            <div class="modal-dialog">

                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Pilih Barang</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <?php echo form_open('Laporan/lap_penjualan_barang') ?>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="Kategori">Barang : </label>
                            <select required name="barang" id="barang" class="form-control">
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($data->result_array() as $x) { ?>
                                    <option value="<?= $x['barang_id']; ?>"><?= $x['barang_nama']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-success"><span class="fa fa-print"></span> View</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="lap_jual_barang_cetak">
            <div class="modal-dialog">

                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Pilih Barang</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <?php echo form_open('Laporan/lap_penjualan_barang_cetak', 'target="_blank"') ?>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="Kategori">Barang : </label>
                            <select required name="barang" id="barang" class="form-control">
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($data->result_array() as $x) { ?>
                                    <option value="<?= $x['barang_id']; ?>"><?= $x['barang_nama']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-success"><span class="fa fa-print"></span> Cetak</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!---------------------------------------------Laporan Penjualan Kategori Barang--------------------------------------------->

        <div class="modal fade" id="lap_penjualan_kat_barang">
            <div class="modal-dialog">

                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Pilih Kategori Barang</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <?php echo form_open('Laporan/lap_penjualan_kat_barang') ?>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="Kategori">Barang : </label>
                            <select required name="kat_barang" id="kat_barang" class="form-control">
                                <option value="">-- Pilih Kategori Barang --</option>
                                <?php foreach ($kat->result_array() as $x) { ?>
                                    <option value="<?= $x['kategori_id']; ?>"><?= $x['kategori_nama']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-success"><span class="fa fa-print"></span> View</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="lap_penjualan_kat_barang_cetak">
            <div class="modal-dialog">

                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Pilih Kategori Barang</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <?php echo form_open('Laporan/lap_penjualan_kat_barang_cetak', 'target="_blank"') ?>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="Kategori">Barang : </label>
                            <select required name="kat_barang" id="kat_barang" class="form-control">
                                <option value="">-- Pilih Kategori Barang --</option>
                                <?php foreach ($kat->result_array() as $x) { ?>
                                    <option value="<?= $x['kategori_id']; ?>"><?= $x['kategori_nama']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-success"><span class="fa fa-print"></span> Cetak</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <!---------------------------------------------Laporan Penjualan Laba--------------------------------------------->
        <div class="modal fade" id="lap_laba_rugi">
            <div class="modal-dialog">

                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Pilih Periode</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <?php echo form_open('Laporan/lap_laba_rugi') ?>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label col-xs-3">Tanggal Awal</label>
                            <div class="col-xs-9">
                                <input type="date" class="form-control" name="tgl1" value="" placeholder="Tanggal" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Tanggal Akhir</label>
                            <div class="col-xs-9">
                                <input type="date" class="form-control" name="tgl2" value="" placeholder="Tanggal" required>
                            </div>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-success"><span class="fa fa-print"></span> View</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="lap_laba_rugi_cetak">
            <div class="modal-dialog">

                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Pilih Periode</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <?php echo form_open('Laporan/lap_laba_rugi_cetak', 'target="_blank"') ?>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label col-xs-3">Tanggal Awal</label>
                            <div class="col-xs-9">
                                <input type="date" class="form-control" name="tgl1" value="" placeholder="Tanggal" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Tanggal Akhir</label>
                            <div class="col-xs-9">
                                <input type="date" class="form-control" name="tgl2" value="" placeholder="Tanggal" required>
                            </div>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-success"><span class="fa fa-print"></span> Cetak</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!---------------------------------------------Laporan Resume--------------------------------------------->
        <div class="modal fade" id="lap_resume">
            <div class="modal-dialog">

                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Pilih Periode</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <?php echo form_open('Laporan/lap_resume') ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-xs-3">Tanggal Awal</label>
                            <div class="col-xs-9">
                                <input type="date" class="form-control" name="start" value="" placeholder="start" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Tanggal Akhir</label>
                            <div class="col-xs-9">
                                <input type="date" class="form-control" name="end" value="" placeholder="end" required>
                            </div>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-success"><span class="fa fa-print"></span> View</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="lap_resume_cetak">
            <div class="modal-dialog">

                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Pilih Periode</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <?php echo form_open('Laporan/lap_resume_cetak', 'target="_blank"') ?>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label col-xs-3">Saldo</label>
                            <div class="col-xs-9">
                                <input type="input" id="saldo" class="form-control" name="saldo" value="" placeholder="Saldo" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Tanggal Awal</label>
                            <div class="col-xs-9">
                                <input type="date" class="form-control" name="start" value="" placeholder="Tanggal" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3">Tanggal Akhir</label>
                            <div class="col-xs-9">
                                <input type="date" class="form-control" name="end" value="" placeholder="Tanggal" required>
                            </div>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-success"><span class="fa fa-print"></span> Cetak</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <!---------------------------------------------Laporan Pengeluaran Toko--------------------------------------------->
        <div class="modal fade" id="lap_pengeluaran_toko">
            <div class="modal-dialog">

                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Pilih Periode</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <?php echo form_open('Laporan/lap_pengeluaran_toko') ?>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label col-xs-3">Tanggal Awal</label>
                            <div class="col-xs-9">
                                <input type="date" class="form-control" name="tgl1" value="" placeholder="Tanggal" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Tanggal Akhir</label>
                            <div class="col-xs-9">
                                <input type="date" class="form-control" name="tgl2" value="" placeholder="Tanggal" required>
                            </div>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-success"><span class="fa fa-print"></span> View</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="lap_pengeluaran_toko_cetak">
            <div class="modal-dialog">

                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Pilih Periode</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <?php echo form_open('Laporan/lap_pengeluaran_toko_cetak', 'target="_blank"') ?>
                    <div class="modal-body">

                        <div class="form-group">
                            <label class="control-label col-xs-3">Tanggal Awal</label>
                            <div class="col-xs-9">
                                <input type="date" class="form-control" name="tgl1" value="" placeholder="Tanggal" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-xs-3">Tanggal Akhir</label>
                            <div class="col-xs-9">
                                <input type="date" class="form-control" name="tgl2" value="" placeholder="Tanggal" required>
                            </div>
                        </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button class="btn btn-success"><span class="fa fa-print"></span> Cetak</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#saldo').divide({
                    delimiter: ',',
                    divideThousand: true, // 1,000..9,999
                    delimiterRegExp: /[\.\,\s]/g
                });
            })

            function listBarang() {
                let select = $("#nama_barang");
                let start = $("#tgl1").val();
                let end = $("#tgl2").val();

                $.ajax({
                    url: "<?= base_url('Barang/listBarang') ?>",
                    method: "post",
                    dataType: "json",
                    data: {
                        start: start,
                        end: end
                    },
                    success: function(data) {
                        if (data) {
                            let html = '<option value="">Pilih Barang</option>';
                            $.each(data, function(index, value) {
                                html += '"<option value="' + value.d_jual_barang_nama + '">' + value.d_jual_barang_nama + '</option>';
                            });
                            $(select).html(html);

                        }
                    },
                    error: function(e) {
                        console.log(e);
                    }
                })
            }

            function listCustomer() {
                let select = $("#nama_customer");
                let select_barang = $("#nama_barang");
                let select2 = $("#nohp");
                let start = $("#tgl1").val();
                let end = $("#tgl2").val();
                $.ajax({
                    url: "<?= base_url('Customer/listCustomer') ?>",
                    method: "post",
                    dataType: "json",
                    data: {
                        tgl1: start,
                        tgl2: end
                    },
                    success: function(data) {
                        if (data) {
                            let html = '<option value="">Pilih Customer(opsional)</option>';
                            $.each(data, function(index, value) {
                                html += '"<option value="' + value.no_hp + '">' + value.nama + " - " + value.no_hp + '</option>';
                            });
                            $(select).html(html);
                            let html2 = '<option value="">Pilih Barang(opsional)</option>';
                            $.each(data, function(index, value) {
                                html2 += '"<option value="' + value.d_jual_barang_id + '">' + value.d_jual_barang_nama + '</option>';
                            });
                            $(select_barang).html(html2);
                        }
                    },
                    error: function(e) {
                        console.log(e);
                    }
                })
            }

            function listCustomer_dp() {
                let select = $("#form_penjualan_kasir_dp").find('select[name=nama_customer]');
                let select_barang = $("#form_penjualan_kasir_dp").find('select[name=nama_barang]');
                let start = $("#form_penjualan_kasir_dp").find('input[name=tgl1]').val();
                let end = $("#form_penjualan_kasir_dp").find('input[name=tgl2]').val();
                $.ajax({
                    url: "<?= base_url('Customer/listCustomer_dp') ?>",
                    method: "post",
                    dataType: "json",
                    data: {
                        tgl1: start,
                        tgl2: end
                    },
                    success: function(data) {
                        if (data) {
                            let html = '<option value="">Pilih Customer(opsional)</option>';
                            $.each(data, function(index, value) {
                                html += '"<option value="' + value.no_hp + '">' + value.nama + " - " + value.no_hp + '</option>';
                            });
                            $(select).html(html);
                            let html2 = '<option value="">Pilih Barang(opsional)</option>';
                            $.each(data, function(index, value) {
                                html2 += '"<option value="' + value.d_jual_barang_id + '">' + value.d_jual_barang_nama + '</option>';
                            });
                            $(select_barang).html(html2);
                        }
                    },
                    error: function(e) {
                        console.log(e);
                    }
                })
            }

            function listCustomer_Barang() {
                let select_barang = $("#nama_barang");
                let nama_customer = $("#nama_customer").val();
                let start = $("#tgl1").val();
                let end = $("#tgl2").val();
                $.ajax({
                    url: "<?= base_url('Customer/listCustomer_barang') ?>",
                    method: "post",
                    dataType: "json",
                    data: {
                        tgl1: start,
                        tgl2: end,
                        nama_customer: nama_customer,
                    },
                    success: function(data) {
                        if (data) {
                            let html2 = '<option value="">Pilih Barang(opsional)</option>';
                            $.each(data, function(index, value) {
                                html2 += '"<option value="' + value.d_jual_barang_id + '">' + value.d_jual_barang_nama + '</option>';
                            });
                            $(select_barang).html(html2);
                        }
                    },
                    error: function(e) {
                        console.log(e);
                    }
                })
            }

            function listCustomer_Barang_dp() {
                let nama_customer = $("#form_penjualan_kasir_dp").find('select[name=nama_customer]').val();
                let select_barang = $("#form_penjualan_kasir_dp").find('select[name=nama_barang]');
                let start = $("#form_penjualan_kasir_dp").find('input[name=tgl1]').val();
                let end = $("#form_penjualan_kasir_dp").find('input[name=tgl2]').val();
                $.ajax({
                    url: "<?= base_url('Customer/listCustomer_barang') ?>",
                    method: "post",
                    dataType: "json",
                    data: {
                        tgl1: start,
                        tgl2: end,
                        nama_customer: nama_customer,
                    },
                    success: function(data) {
                        if (data) {
                            let html2 = '<option value="">Pilih Barang(opsional)</option>';
                            $.each(data, function(index, value) {
                                html2 += '"<option value="' + value.d_jual_barang_id + '">' + value.d_jual_barang_nama + '</option>';
                            });
                            $(select_barang).html(html2);
                        }
                    },
                    error: function(e) {
                        console.log(e);
                    }
                })
            }

            function listPenjualan_cabang() {
                let start = $("#form_penjualan_cabang").find('input[name=tgl1]').val();
                let end = $("#form_penjualan_cabang").find('input[name=tgl2]').val();
                let select = $("#form_penjualan_cabang").find('select[name=cabang]');
                let nama_barang = $("#form_penjualan_cabang").find('select[name=nama_barang]');

                $.ajax({
                    url: "<?= base_url('Laporan/listPenjualan_cabang') ?>",
                    method: "post",
                    dataType: "json",
                    data: {
                        tgl1: start,
                        tgl2: end
                    },
                    success: function(data) {
                        console.log(data)
                        if (data) {
                            let html = '<option value="">Pilih Cabang(Opsional)</option>';
                            $.each(data, function(index, value) {
                                html += '"<option value="' + value.cabang + '">' + value.cabang + '</option>';
                            });
                            $(select).html(html);
                            let html2 = '<option value="">Pilih Barang(Opsional)</option>';
                            $.each(data, function(index, value) {
                                html2 += '"<option value="' + value.barang_id + '">' + value.barang_nama + '</option>';
                            });
                            $(nama_barang).html(html2);

                        }
                    },
                    error: function(e) {
                        console.log(e);
                    }
                })
            }

            function listPenjualan_cabangBarang() {
                let cabang = $("#form_penjualan_cabang").find('select[name=cabang]').val();
                let nama_barang = $("#form_penjualan_cabang").find('select[name=nama_barang]');
                console.log(cabang);
                $.ajax({
                    url: "<?= base_url('Laporan/listPenjualan_cabangBarang') ?>",
                    method: "post",
                    dataType: "json",
                    data: {
                        cabang: cabang,
                    },
                    success: function(data) {
                        console.log(data)
                        if (data) {
                            let html2 = '<option value="">Pilih Barang(Opsional)</option>';
                            $.each(data, function(index, value) {
                                html2 += '"<option value="' + value.barang_id + '">' + value.barang_nama + '</option>';
                            });
                            $(nama_barang).html(html2);

                        }
                    },
                    error: function(e) {
                        console.log(e);
                    }
                })
            }

            function listSupplier_pembelian() {
                let start = $("#form_laporan_pembelian").find('input[name=tgl1]').val();
                let end = $("#form_laporan_pembelian").find('input[name=tgl2]').val();
                let select = $("#form_laporan_pembelian").find('select[name=supplier]');
                let nama_barang = $("#form_laporan_pembelian").find('select[name=nama_barang]');

                $.ajax({
                    url: "<?= base_url('Laporan/listSupplier_pembelian') ?>",
                    method: "post",
                    dataType: "json",
                    data: {
                        tgl1: start,
                        tgl2: end
                    },
                    success: function(data) {
                        console.log(data)
                        if (data) {
                            let html = '<option value="">Pilih Supplier (Opsional)</option>';
                            $.each(data, function(index, value) {
                                html += '"<option value="' + value.beli_suplier_id + '">' + value.suplier_nama + '</option>';
                            });
                            $(select).html(html);
                            let html2 = '<option value="">Pilih Barang (Barang)</option>';
                            $.each(data, function(index, value) {
                                html2 += '"<option value="' + value.barang_id + '">' + value.barang_nama + '</option>';
                            });
                            $(nama_barang).html(html2);

                        }
                    },
                    error: function(e) {
                        console.log(e);
                    }
                })
            }

            function listSupplier_pembelianBarang() {
                let supplier = $("#form_laporan_pembelian").find('select[name=supplier]').val();
                let nama_barang = $("#form_laporan_pembelian").find('select[name=nama_barang]');

                $.ajax({
                    url: "<?= base_url('Laporan/listSupplier_pembelianBarang') ?>",
                    method: "post",
                    dataType: "json",
                    data: {
                        supplier: supplier,
                    },
                    success: function(data) {
                        console.log(data)
                        if (data) {
                            let html2 = '<option value="">Pilih Barang (Opsional)</option>';
                            $.each(data, function(index, value) {
                                html2 += '"<option value="' + value.barang_id + '">' + value.barang_nama + '</option>';
                            });
                            $(nama_barang).html(html2);

                        }
                    },
                    error: function(e) {
                        console.log(e);
                    }
                })
            }
        </script>
        <script>
            $(document).ready(function() {
                $('select').select2({
                    width: '300px',
                })

            });
        </script>