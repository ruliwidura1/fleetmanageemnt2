<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    <a id="anchor_kembali" href="<?= base_url_admin('fleetmanagement/kendaraan/'); ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li>Kendaraan</li>
        <li>Edit</li>
        <li># <?=$current_data->id?></li>
    </ul>
    <!-- END Static Layout Header -->

    <!-- Content -->
    <div class="block full row">
        <div class="block-title">
            <h4><strong>Form Edit Data</strong></h4>
        </div>
        <form id="form_input_data_edit" action="<?= base_url_admin(); ?>" method="post" enctype="multipart/form-data" class="form-bordered form-horizontal" onsubmit="return false;">
            <div class="form-group">
                <div class="col-md-3 col-sm-5">
                    <label for="ieplat_nomor" class="control-label">Plat Nomor *</label>
                    <input id="ieplat_nomor" type="text" class="form-control" name="plat_nomor" placeholder="Plat Nomor Kendaraan" required />
                </div>
                <div class="col-md-6 col-sm-7">
                    <label for="ienama" class="control-label">Nama Kendaraan*</label>
                    <input id="ienama" type="text" class="form-control" name="nama" placeholder="Nama Kendaraan" required />
                </div>
                <div class="col-md-3 col-sm-6">
                    <label for="ieutype" class="control-label">Tipe *</label>
                    <select id="ieutype" name="utype" class="form-control input-select2" required>
                        <?php $this->getThemeElement('page/components/kendaraan_tipe_options', $__forward); ?>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <label for="iemerk" class="control-label">Merk</label>
                    <select id="iemerk" name="merk" class="form-control input-select2">
                        <?php $this->getThemeElement('page/components/kendaraan_merk_options', $__forward); ?>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <label for="iewarna" class="control-label">Warna</label>
                    <select id="iewarna" name="warna" class="form-control input-select2">
                        <?php $this->getThemeElement('page/components/warna_options', $__forward); ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-2">
                    <label for="iejumlah_roda" class="control-label">Jumlah Roda</label>
                    <input id="iejumlah_roda" type="text" class="form-control" name="jumlah_roda" placeholder="Jumlah Roda" />
                </div>
                <div class="col-md-2">
                    <label for="iekapasitas_mesin" class="control-label">Kapasitas Mesin (cc)</label>
                    <input id="iekapasitas_mesin" type="text" class="form-control" name="kapasitas_mesin" placeholder="Kapasitas Kendaraan" />
                </div>
                <div class="col-md-2">
                    <label for="iekapasitas_angkutan" class="control-label">Kapasitas Angkutan (kg)</label>
                    <input id="iekapasitas_angkutan" type="text" class="form-control" name="kapasitas_angkutan" placeholder="Kapasitas Kendaraan" />
                </div>
                <div class="col-md-2">
                    <label for="ieavailability" class="control-label">Ketersediaan *</label>
                    <select id="ieavailability" name="availability" class="form-control" required>
                        <?php $this->getThemeElement('page/components/ketersediaan_options', $__forward); ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="ieis_active" class="control-label">Status *</label>
                    <select id="ieis_active" class="form-control" name="is_active" required>
                        <?php $this->getThemeElement('page/components/is_active_options', $__forward); ?>
                    </select>
                </div>
            </div>

            <div class="form-group form-actions">
                <div class="col-xs-12 text-right">
                    <div class="btn-group pull-right">
                        <?php $this->getThemeElement('page/components/button_simpan_perubahan', $__forward); ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
