<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <a id="" href="<?= base_url_admin('fleetmanagement/bahanbakar/') ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
                <div class="btn-group">
                    <a id="btn-cetak" href="#" onclick="window.print();" class="btn btn-primary"><i class="fa fa-print"></i> Cetak</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li><a href="<?= base_url_admin("fleetmanagement/bahanbakar/") ?>">Bahan Bakar</a></li>
        <li>Detail #<?= $bbm->id ?></li>
    </ul>
    <!-- END Static Layout Header -->

    <div class="block full">
        <div class="block-title">
            <h4><strong>Informasi Detail</strong></h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>:</td>
                            <td><?= $bbm->id ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Beli</th>
                            <td>:</td>
                            <td><?= $this->__dateIndonesia($bbm->tgl_beli, 'hari_tanggal') ?></td>
                        </tr>
                        <tr>
                            <th>Nama Kendaraan</th>
                            <td>:</td>
                            <td><?= $avm->nama ?></td>
                        </tr>
                        <tr>
                            <th> Jenis</th>
                            <td>:</td>
                            <td><?= $bbm->jenis ?></td>
                        </tr>
                        <tr>
                            <th> Kapasitas </th>
                            <td>:</td>
                            <td><?= $bbm->kapasitas . ' Liter' ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah Liter</th>
                            <td>:</td>
                            <td><?= $bbm->jumlah_beli . ' Liter' ?></td>
                        </tr>
                        <tr>
                            <th> Harga</th>
                            <td>:</td>
                            <td>Rp<?= number_format($bbm->harga, 0, ',', '.') ?></td>
                        </tr>
                        <tr>
                            <th> Total Pembelian</th>
                            <td>:</td>
                            <td>Rp<?= number_format($bbm->total_harga, 0, ',', '.') ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
