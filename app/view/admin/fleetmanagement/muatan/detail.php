<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-6">
                <div class="btn-group">
                    <a id="" href="<?= base_url_admin('fleetmanagement/muatan/') ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <a id="" href="<?= base_url_admin('fleetmanagement/muatan/edit/' . $cmm->id) ?>" class="btn btn-info"><i class="fa fa-edit"></i> Edit</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li><a href="<?= base_url_admin("fleetmanagement/muatan/") ?>">Muatan</a></li>
        <li>Detail #<?= $cmm->id ?></li>
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
                            <td><?= $cmm->id ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>:</td>
                            <td><?= $this->__dateIndonesia($cmm->cdate, 'hari_tanggal') ?></td>
                        </tr>
                        <tr>
                            <th>Driver</th>
                            <td>:</td>
                            <td><?= $bdm->nama ?></td>
                        </tr>
                        <tr>
                            <th>Jenis - No Pol Kendaraan</th>
                            <td>:</td>
                            <td><?= $avm->utype . ' - ' . $avm->no_pol ?></td>
                        </tr>
                        <tr>
                            <th>Nama Barang</th>
                            <td>:</td>
                            <td><?= $cmm->barang ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah Muatan</th>
                            <td>:</td>
                            <td><?= $cmm->jumlah_muatan ?></td>
                        </tr>
                        <tr>
                            <th>Satuan Barang</th>
                            <td>:</td>
                            <td><?= $cmm->satuan ?></td>
                        </tr>
                        <tr>
                            <th>Berat</th>
                            <td>:</td>
                            <td><?= $cmm->berat ?></td>
                        </tr>
                        <tr>
                            <th>Kapasitas</th>
                            <td>:</td>
                            <td><?= $cmm->kapasitas_kendaraan ?></td>
                        </tr>
                        <tr>
							<th>Status</th>
							<td>:</td>
							<td><?=!empty($cmm->is_active) ? '<label class="label label-success">Aktif</label>': '<label class="label label-default">Tidak Aktif</label>'?></td>
						</tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
