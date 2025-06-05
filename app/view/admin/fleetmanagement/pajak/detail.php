<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <a id="" href="<?= base_url_admin('fleetmanagement/pajak/') ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li><a href="<?= base_url_admin("fleetmanagement/pajak/") ?>">Pajak</a></li>
        <li>Detail #<?= $bpm->id ?></li>
    </ul>
    <!-- END Static Layout Header -->

    <div class="block full">
      <div class="text-center image12">
        <img src="<?= base_url('media/group1.png') ?>" alt="Nature" class="responsive" width="330" height="130">
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <h3><?= $avm->nama ?></h3>
        </div>
      </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <td>:</td>
                            <td><?= $bpm->id ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kendaraan</th>
                            <td>:</td>
                            <td><?= $avm->utype ?></td>
                        </tr>
                        <tr>
                            <th>Plat Nomor</th>
                            <td>:</td>
                            <td><?= $avm->no_pol ?></td>
                        </tr>
                        <tr>
                            <th>Tahun Pembuatan</th>
                            <td>:</td>
                            <td><?= $bpm->tahun_pembuatan ?></td>
                        </tr>
                        <tr>
                            <th>Berlaku PN</th>
                            <td>:</td>
                            <td><?= $bpm->berlaku ?></td>
                        </tr>
                        <tr>
                            <th>Nominal Pajak</th>
                            <td>:</td>
                            <td>Rp<?= number_format($bpm->nominal_pajak, 0, ',', '.') ?></td>

                        </tr>
                        <tr>
                            <th>Perpanjang Pajak</th>
                            <td>:</td>
                            <td><?= $bpm->perpanjang_pajak ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td>
                                <?php
                                if ($bpm->is_active == 1) {
                                    $bpm->is_active = '<label class="label label-success">Selesai</label>';
                                } elseif ($bpm->is_active == 2) {
                                    $bpm->is_active = '<label class="label label-danger">Proses Pembayaran</label>';
                                } else {
                                    $bpm->is_active = '<label class="label label-default">belum bayar</label>';
                                }
                                ?>
                                <?= $bpm->is_active ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
