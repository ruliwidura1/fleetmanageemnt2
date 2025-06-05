<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <a id="" href="<?= base_url_admin('fleetmanagement/monitoring/') ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <a id="" href="<?= base_url_admin('fleetmanagement/monitoring/edit/' . $cmm->id) ?>" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li><a href="<?= base_url_admin("fleetmanagement/kendaraan/") ?>">Kendaraan</a></li>
        <li>Detail #<?= $cmm->id ?></li>
    </ul>
    <!-- END Static Layout Header -->

    <div class="block full">
      <div class="block-title">
          <h4><strong>Informasi Detail</strong></h4>
      </div>
        <div class="text-center image12">
            <img src="<?= base_url('media/group1.png') ?>" alt="Nature" class="responsive" width="330" height="130">
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><?= $cmm->integrasi_gps_tracking ?></h3>
          </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>:</td>
                            <td><?= $cmm->id ?></td>
                        </tr>
                        <tr>
                            <th>Keberadaan Kendaraan</th>
                            <td>:</td>
                            <td><?= $cmm->integrasi_gps_tracking ?></td>
                        </tr>
                        <tr>
                            <th>Jalur Yang di Tempuh</th>
                            <td>:</td>
                            <td><?= $cmm->pelacakan_posisi_realtime_kendaraan ?></td>
                        </tr>
                        <tr>
                            <th>Target Waktu</th>
                            <td>:</td>
                            <td><?= $cmm->riwayat_rute_perjalanan ?></td>
                        </tr>
                        <tr>
                            <th>Biaya Bahan Bakar</th>
                            <td>:</td>
                            <td><?= $cmm->alert_perjalanan_berlebih ?></td>
                        </tr>
                        <tr>
                            <th>Geofencing</th>
                            <td>:</td>
                            <td><?= $cmm->geofencing ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td><?= !empty($cmm->is_active) ? '<label class="label label-success">Aktif</label>' : '<label class="label label-default">Tidak Aktif</label>' ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
