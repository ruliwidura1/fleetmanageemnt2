<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <a id="" href="<?= base_url_admin('fleetmanagement/acservice/') ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li><a href="<?= base_url_admin("fleetmanagement/acservice/") ?>">Pemeliharaan Dan Service</a></li>
        <li>Detail #<?= $cam->id ?></li>
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
            <h3><?= $cam->pelanggan_nama ?></h3>
          </div>
        </div>
        <div class="row"  style="border-top: 1px solid #eee;">
            <div class="col-md-9">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>:</td>
                            <td><?= $cam->id ?></td>
                        </tr>
                        <tr>
                            <th>Nama Pelanggan</th>
                            <td>:</td>
                            <td><?= $cam->pelanggan_nama ?></td>
                        </tr>
                        <tr>
                            <th>nomor Telepon Pelanggan</th>
                            <td>:</td>
                            <td><?= $cam->telp ?></td>
                        </tr>
                        <tr>
                            <th>PK</th>
                            <td>:</td>
                            <td><?= $cam->pk ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Service</th>
                            <td>:</td>
                            <td><?= $cam->tanggal_perbaikan ?></td>
                        </tr>
                        <tr>
                            <th>Deskripsi kerusakan</th>
                            <td>:</td>
                            <td><?= $cam->deskripsi_kerusakan ?></td>
                        </tr>
                        <tr>
                            <th>Teknisi (1)</th>
                            <td>:</td>
                            <td><?= $cam->teknisi_1_nama ?></td>
                        </tr>
                        <tr>
                            <th>Teknisi (2)</th>
                            <td>:</td>
                            <td><?= $cam->teknisi_2_nama ?></td>
                        </tr>
                        <tr>
                            <th>Teknisi (3)</th>
                            <td>:</td>
                            <td><?= $cam->teknisi_3_nama ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
