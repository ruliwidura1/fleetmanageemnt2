<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    <a id="aback" href="<?= base_url_admin('fleetmanagement/acservice/'); ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li><a href="<?= base_url_admin("fleetmanagement/kendaraan/") ?>">Kendaraan</a></li>
        <li>Edit #<?= $apm->id ?></li>
    </ul>
    <!-- END Static Layout Header -->

    <!-- Content -->
    <div class="block full">
        <div class="block-title">
            <h4><strong>Form Edit Data</strong></h4>
        </div>
        <form id="fedit" action="<?= base_url_admin(); ?>" method="post" enctype="multipart/form-data" class="form-bordered form-horizontal" onsubmit="return false;">
            <div class="form-group">
              <div class="col-md-4">
                  <label for="ienama" class="control-label">Nama *</label>
                  <input id="ienama" type="text" class="form-control" name="nama" placeholder="Nama Anda" required />
              </div>
                <div class="col-md-4">
                    <label for="iejenis_kendaraan" class="control-label">Jenis Kendaraan *</label>
                    <input id="iejenis_kendaraan" type="text" class="form-control" name="jenis_kendaraan" placeholder="Nama Kendaraan" required />
                </div>
                <div class="col-md-4">
                    <label for="ietanggal_perbaikan" class="control-label">Tanggal Perbaikan *</label>
                    <input id="ietanggal_perbaikan" type="text" class="form-control" name="tanggal_perbaikan" placeholder="Plat Nomor Kendaraan" required />
                </div>
                <div class="col-md-12">
        					<label for="iedeskripsi_kerusakan">Deskripsi Kerusakan *</label>
        					<textarea id="iedeskripsi_kerusakan" name="deskripsi_kerusakan" type="text" class="form-control" placeholder="Keluhan"></textarea>
        				</div>
                <div class="col-md-4">
                    <label for="ietindakan_perbaikan" class="control-label">Tindakan Perbaikan</label>
                    <input id="ietindakan_perbaikan" type="text" class="form-control" name="tindakan_perbaikan" placeholder="Warna Kendaraan" />
                </div>
                <div class="col-md-4">
                    <label for="iebiaya_perbaikan" class="control-label">Biaya Perbaikan</label>
                    <input id="iebiaya_perbaikan" type="text" class="form-control" name="biaya_perbaikan" placeholder="Kapasitas Kendaraan" required />
                </div>
                <div class="col-md-2">
                  <label class="control-label" for="ieperbaikan">Perbaikan</label>
                  <select id="ieperbaikan" name="perbaikan" class="form-control">
                    <?php $this->getThemeElement('page/components/option_status_perbaikan');?>
                  </select>
                </div>
                <div class="col-md-2">
                    <label for="ieis_active" class="control-label">Status</label>
                    <select id="ieis_active" class="form-control" name="is_active">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <div class="form-group">

            </div>
            <div class="form-group form-actions">
                <div class="col-xs-12 text-right">
                    <div class="btn-group pull-right">
                        <button type="submit" class="btn btn-primary btn-submit">
                            Simpan Perubahan <i class="fa fa-save icon-submit"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
