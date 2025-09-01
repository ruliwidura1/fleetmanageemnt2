<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <a id="anchor_kembali" href="<?= base_url_admin('fleetmanagement/kendaraan/') ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <?php $this->getThemeElement('page/components/button_print'); ?>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li><a href="<?= base_url_admin("fleetmanagement/kendaraan/") ?>">Kendaraan</a></li>
        <li>Detail #<?= $current_data->id ?></li>
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
                            <td><?= $current_data->id ?></td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td><?= $current_data->nama ?></td>
                        </tr>
                        <tr>
                            <th>Tipe</th>
                            <td>:</td>
                            <td><?= $current_data->utype ?></td>
                        </tr>
                        <tr>
                            <th>Plat Nomor</th>
                            <td>:</td>
                            <td><?= $current_data->plat_nomor ?></td>
                        </tr>
                        <tr>
                            <th>Merk</th>
                            <td>:</td>
                            <td><?= $current_data->merk ?></td>
                        </tr>
                        <tr>
                            <th>Warna</th>
                            <td>:</td>
                            <td><?= $current_data->warna ?></td>
                        </tr>
                        <tr>
                            <th>Kapasitas Mesin</th>
                            <td>:</td>
                            <td><?= $current_data->kapasitas_mesin ?></td>
                        </tr>
                        <tr>
                            <th>Kapasitas Angkut (KG)</th>
                            <td>:</td>
                            <td><?= $current_data->kapasitas_angkutan ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah Roda</th>
                            <td>:</td>
                            <td><?= $current_data->jumlah_roda ?></td>
                        </tr>
                        <tr>
                            <th>Ketersediaan</th>
                            <td>:</td>
                            <td><?= $current_data->availability ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>:</td>
                            <td><?= !empty($current_data->is_active) ? '<label class="label label-success">Aktif</label>' : '<label class="label label-default">Tidak Aktif</label>' ?></td>
                        </tr>
                        <tr>
                            <th>Terakhir diperbarui</th>
                            <td>:</td>
                            <td><?= !is_null($current_data->updated_at) ? $this->__dateIndonesia($current_data->updated_at, 'hari_tanggal_jam') : '-' ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
