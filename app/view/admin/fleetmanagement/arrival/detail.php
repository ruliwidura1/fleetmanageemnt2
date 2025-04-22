<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <a id="" href="<?= base_url_admin('fleetmanagement/arrival/') ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li><a href="<?= base_url_admin("fleetmanagement/arrival/") ?>">Arrival</a></li>
        <li>Detail #<?= $cam->id ?></li>
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
                            <td><?= $cam->id ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Kedatangan</th>
                            <td>:</td>
                            <td><?= $this->__dateIndonesia($cam->cdate, 'hari_tanggal') ?></td>
                        </tr>
                        <tr>
                            <th>Driver</th>
                            <td>:</td>
                            <td><?= $bdm->nama ?></td>
                        </tr>
                        <tr>
                            <th>Kendaraan</th>
                            <td>:</td>
                            <td><?= $avm->nama ?></td>
                        </tr>
                        <tr>
                            <th>Jam Masuk</th>
                            <td>:</td>
                            <td><?= $cam->jam_masuk ?></td>
                        </tr>
                        <tr>
                            <th>Dari</th>
                            <td>:</td>
                            <td><?= $cam->destination ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td><?php
                                if ($cam->is_completed == 0) {
                                    echo '<label class="label label-warning">Perjalanan</label>';
                                } else {
                                    echo '<label class="label label-info">Selesai</label>';
                                }
                                echo  ' ';
                                if (!empty($cam->is_active)) {
                                    echo '<label class="label label-success">Aktif</label>';
                                } else {
                                    echo '<label class="label label-default">Tidak Aktif</label>';
                                }
                                ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>