<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <a id="" href="<?= base_url_admin('fleetmanagement/tujuanpengiriman/') ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <a id="" href="<?= base_url_admin('fleetmanagement/tujuanpengiriman/edit/' . $dpm->id) ?>" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li><a href="<?= base_url_admin("fleetmanagement/tujuanpengiriman/") ?>">Tujuan Pengiriman</a></li>
        <li>Detail #<?= $dpm->id ?></li>
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
                            <td><?= $dpm->id ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Pengiriman</th>
                            <td>:</td>
                            <td><?= $this->__dateIndonesia($dpm->cdate, 'hari_tanggal') ?></td>
                        </tr>
                        <tr>
                            <th>Kode</th>
                            <td>:</td>
                            <td><?= $dpm->kode ?></td>
                        </tr>
                        <tr>
                            <th>Barang</th>
                            <td>:</td>
                            <td><?= $cmm->barang ?></td>
                        </tr>
                        <tr>
                            <th>Tujuan Pengiriman</th>
                            <td>:</td>
                            <td><?= $dpm->tujuan ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>
                                <?php
                                if ($dpm->is_delivered == 1) {
                                    echo '<label class="label label-success">Diterima</label>';
                                } elseif ($dpm->is_delivered == 0) {
                                    echo '<label class="label label-warning">Dikirim</label>';
                                } elseif ($dpm->is_delivered == 2) {
                                    echo '<label class="label label-danger">Batal</label>';
                                }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Customer Addresses Block -->
    <div class="block">
        <!-- Customer Addresses Title -->
        <div class="block-title">
            <h2><i class="fa fa-map-signs"></i> <strong>Alamat</strong> Pengiriman</h2>
        </div>
        <!-- END Customer Addresses Title -->

        <!-- Customer Addresses Content -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Billing Address Block -->
                <div class="block">
                    <!-- Billing Address Title -->
                    <div class="block-title">
                        <h2>Alamat utama</h2>
                    </div>
                    <!-- END Billing Address Title -->

                    <!-- Billing Address Content -->
                    <address>
                        <?= $dpm->alamat ?><br>
                        Kec: <?= $dpm->kecamatan ?>, Kab/Kota: <?= $dpm->kabkota ?><br>
                        Provinsi: <?= $dpm->provinsi ?>, <?= $dpm->kodepos ?>
                    </address>
                    <!-- END Billing Address Content -->
                </div>
                <!-- END Billing Address Block -->
            </div>
            <?php if (isset($dpm_alamat)) {
                foreach ($dpm_alamat as $da) { ?>
                    <div class="col-lg-6">
                        <!-- Billing Address Block -->
                        <div class="block">
                            <!-- Billing Address Title -->
                            <div class="block-title">
                                <h2><?= $da->nama_alamat ?></h2>
                            </div>
                            <!-- END Billing Address Title -->

                            <!-- Billing Address Content -->
                            <address>
                                <?= $da->alamat ?><br>
                                <?= $da->kecamatan ?>, <?= $da->kabkota ?><br>
                                <?= $da->provinsi ?>, <?= $da->kodepos ?>
                            </address>
                            <!-- END Billing Address Content -->
                        </div>
                        <!-- END Billing Address Block -->
                    </div>
            <?php }
            } ?>
        </div>
        <!-- END Customer Addresses Content -->
    </div>
    <!-- END Customer Addresses Block -->
</div>