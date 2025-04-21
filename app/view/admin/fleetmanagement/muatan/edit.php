<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    <a id="aback" href="<?= base_url_admin('fleetmanagement/muatan/'); ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li><a href="<?= base_url_admin("fleetmanagement/muatan/") ?>">Muatan</a></li>
        <li>Edit #<?= $cmm->id ?></li>
    </ul>
    <!-- END Static Layout Header -->

    <!-- Content -->
    <div class="block full row">
        <div class="block-title">
            <h4><strong>Form Edit Data</strong></h4>
        </div>
        <form id="fedit" action="<?= base_url_admin(); ?>" method="post" enctype="multipart/form-data" class="form-bordered form-horizontal" onsubmit="return false;">
            <div class="form-group">
                <div class="col-md-4">
                    <label class="control-label" for="iecdate">Tgl Muat Barang</label>
                    <input id="iecdate" name="cdate" type="text" class="form-control input-datepicker" value="<?= date("Y-m-d") ?>" data-date-format="yyyy-mm-dd" autocomplete="off" />
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="ieb_driver_id">Driver *</label>
                    <select id="ieb_driver_id" name="b_driver_id" type="text" class="form-control" required>
                        <?php if (isset($driver_list)) {
                            foreach ($driver_list as $d) { ?>
                                <option value="<?= $d->id; ?>" <?php if ($d->id == $cmm->b_driver_id) echo 'selected'; ?>><?= $d->nama; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="iea_vehicle_id">Jenis - No Pol Kendaraan *</label>
                    <select id="iea_vehicle_id" name="a_vehicle_id" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <?php if (isset($utype_list) && isset($nopol_list)) {
                            foreach ($utype_list as $utype) {
                                foreach ($nopol_list as $nopol) {
                                    if ($utype->id == $nopol->id) {
                        ?>
                                        <option value="<?= $utype->id ?>"><?= $utype->utype ?> - <?= $nopol->no_pol ?></option>
                        <?php
                                    }
                                }
                            }
                        } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6">
                    <label class="control-label" for="iebarang">Nama Barang *</label>
                    <input id="iebarang" name="barang" type="text" class="form-control" placeholder="Nama Barang yang dimuat" required />
                </div>
                <div class="col-md-3">
                    <label class="control-label" for="iejumlah_muatan">Jumlah Muatan *</label>
                    <input id="iejumlah_muatan" name="jumlah_muatan" type="text" class="form-control" placeholder="Jumlah Muatan Barang" required />
                </div>
                <div class="col-md-3">
                    <label class="control-label" for="iesatuan">Satuan *</label>
                    <input id="iesatuan" name="satuan" type="text" class="form-control" placeholder="Satuan Barang" required />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <label class="control-label" for="ieberat">Berat *</label>
                    <input id="ieberat" name="berat" type="number" class="form-control" placeholde="Berat Muatan" required />
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="iekapasitas_kendaraan">Kapasitas Kendaraan *</label>
                    <select id="iekapasitas_kendaraan" name="kapasitas_kendaraan" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        <option value="2">Kurang</option>
                        <option value="1">Sesuai</option>
                        <option value="3">Lebih</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="ieis_active">Status</label>
                    <select id="ieis_active" name="is_active" class="form-control">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <div class="form-group form-actions">
                <div class="col-xs-12 text-right">
                    <div class="btn-group pull-right">
                        <button type="submit" class="btn btn-primary btn-submit">
                            Simpan <i class="fa fa-save icon-submit"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
