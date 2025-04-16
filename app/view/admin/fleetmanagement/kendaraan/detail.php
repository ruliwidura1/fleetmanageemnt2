<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <a id="" href="<?= base_url_admin('fleetmanagement/kendaraan/') ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <a id="" href="<?= base_url_admin('fleetmanagement/kendaraan/edit/' . $avm->id) ?>" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li><a href="<?= base_url_admin("fleetmanagement/kendaraan/") ?>">Kendaraan</a></li>
        <li>Detail #<?= $avm->id ?></li>
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
                            <td><?= $avm->id ?></td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td><?= $avm->nama ?></td>
                        </tr>
                        <tr>
                            <th>Tipe</th>
                            <td>:</td>
                            <td><?= $avm->utype ?></td>
                        </tr>
                        <tr>
                            <th>Plat Nomor</th>
                            <td>:</td>
                            <td><?= $avm->no_pol ?></td>
                        </tr>
                        <tr>
                            <th>Merk</th>
                            <td>:</td>
                            <td><?= $avm->merk ?></td>
                        </tr>
                        <tr>
                            <th>Warna</th>
                            <td>:</td>
                            <td><?= $avm->warna ?></td>
                        </tr>
                        <tr>
                            <th>Kapasitas</th>
                            <td>:</td>
                            <td><?= $avm->kapasitas_mesin ?></td>
                        </tr>
                        <tr>
                            <th>Kapasitas</th>
                            <td>:</td>
                            <td><?= $avm->kapasitas_angkutan ?></td>
                        </tr>
                        <tr>
                            <th>Ketersediaan</th>
                            <td>:</td>
                            <td><?= $avm->availability ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td><?= !empty($avm->is_active) ? '<label class="label label-success">Aktif</label>' : '<label class="label label-default">Tidak Aktif</label>' ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
