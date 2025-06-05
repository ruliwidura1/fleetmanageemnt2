<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <a id="" href="<?= base_url_admin('fleetmanagement/jenismerkkendaraan/') ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li><a href="<?= base_url_admin("fleetmanagement/jenismerkkendaraan/") ?>">Pemeliharaan Dan Service</a></li>
        <li>Detail #<?= $ajmm->id ?></li>
    </ul>
    <!-- END Static Layout Header -->

    <div class="block full">
      <div class="block-title">
          <h4><strong>Informasi Detail</strong></h4>
      </div>
        <div class="text-center image12">
            <img src="<?= base_url('media/group1.png') ?>" alt="Nature" class="responsive" width="330" height="100">
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <h3><?= $ajmm->nama ?></h3>
          </div>
        </div>
        <div class="row"  style="border-top: 1px solid #eee;">
            <div class="col-md-12">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>:</td>
                            <td><?= $ajmm->id ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kendaraan</th>
                            <td>:</td>
                            <td><?= $ajmm->utype ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Perbaikan</th>
                            <td>:</td>
                            <td><?= $ajmm->no_pol ?></td>
                        </tr>
                        <tr>
                            <th>Deskripsi Kerusakan</th>
                            <td>:</td>
                            <td><?= $ajmm->kapasitas_mesin ?></td>
                        </tr>
                        <tr>
                            <th>Tindakan Perbaikan</th>
                            <td>:</td>
                            <td><?= $ajmm->warna ?></td>
                        </tr>
                        <tr>
                            <th>Tindakan Perbaikan</th>
                            <td>:</td>
                            <td><?= $ajmm->merk ?></td>
                        </tr>


                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>
                                <?php
                                if ($ajmm->is_active == 1) {
                                    $ajmm->is_active = '<label class="label label-success">Selesai</label>';
                                } elseif ($ajmm->is_active == 2) {
                                    $ajmm->is_active = '<label class="label label-danger">Proses Pembayaran</label>';
                                } else {
                                    $ajmm->is_active = '<label class="label label-default">belum bayar</label>';
                                }
                                ?>
                                <?= $ajmm->is_active ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
