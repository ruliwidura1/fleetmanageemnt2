<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <a id="anchor_kembali" href="<?= base_url_admin('fleetmanagement/bahanbakar/') ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
                <div class="btn-group">
                    <?php $this->getThemeElement('page/components/button_print'); ?>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li><a href="<?= base_url_admin("fleetmanagement/bahanbakar/") ?>">Bahan Bakar</a></li>
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
                            <th>Tanggal Beli</th>
                            <td>:</td>
                            <td><?= $this->__dateIndonesia($current_data->created_at, 'hari_tanggal') ?></td>
                        </tr>
                        <tr>
                            <th> Jenis BBM</th>
                            <td>:</td>
                            <td><?= $current_data->jenis ?></td>
                        </tr>
                        <tr>
                            <th> Total Pembelian</th>
                            <td>:</td>
                            <td><?= $current_data->total_pembelian ?></td>
                        </tr>
                        <tr>
                            <th>Nama Kendaraan</th>
                            <td>:</td>
                            <td><?= $current_data->kendaraan ?></td>
                        </tr>
                        <tr>
                            <th>Driver</th>
                            <td>:</td>
                            <td><?= $current_data->driver ?></td>
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
