<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    <a id="aback" href="<?= base_url_admin('fleetmanagement/kendaraan/'); ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li><a href="<?= base_url_admin("fleetmanagement/kendaraan/") ?>">Kendaraan</a></li>
        <li>Edit #<?= $avm->id ?></li>
    </ul>
    <!-- END Static Layout Header -->

    <!-- Content -->
    <div class="block full">
        <div class="block-title">
            <h4><strong>Form Edit Data</strong></h4>
        </div>
        <form id="fedit" action="<?= base_url_admin(); ?>" method="post" enctype="multipart/form-data" class="form-bordered form-horizontal" onsubmit="return false;">
            <div class="form-group">
                <div class="col-md-6">
                    <label for="ienama" class="control-label">Nama *</label>
                    <input id="ienama" type="text" class="form-control" name="nama" placeholder="Nama Kendaraan" required />
                </div>
                <div class="col-md-6">
                    <label for="ieutype" class="control-label">Tipe *</label>
                    <select id="ieutype" name="utype" class="form-control" required>
                        <option value="Pickup">Pickup</option>
                        <option value="Van">Van</option>
                        <option value="Box">Box</option>
                        <option value="Engkel">Engkel</option>
                        <option value="Double">Double</option>
                        <option value="Fuso">Fuso</option>
                        <option value="Tronton">Tronton</option>
                        <option value="Trintin">Trintin</option>
                        <option value="Trinton">Trinton</option>
                        <option value="Wingbox">Wing Box</option>
                        <option value="Trailer">Trailer</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4">
                    <label for="ieno_pol" class="control-label">Plat Nomor *</label>
                    <input id="ieno_pol" type="text" class="form-control" name="no_pol" placeholder="Plat Nomor Kendaraan" required />
                </div>
                <div class="col-md-4">
                    <label for="iemerk" class="control-label">Merk</label>
                    <input id="iemerk" type="text" class="form-control" name="merk" placeholder="Merk Kendaraan" />
                </div>
                <div class="col-md-4">
                    <label for="iewarna" class="control-label">Warna</label>
                    <input id="iewarna" type="text" class="form-control" name="warna" placeholder="Warna Kendaraan" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4">
                    <label for="iekapasitas_mesin" class="control-label">Kapasitas Mesin (cc)</label>
                    <input id="iekapasitas_mesin" type="text" class="form-control" name="kapasitas_mesin" placeholder="Kapasitas Kendaraan" required />
                </div>
                <div class="col-md-3">
                    <label for="iekapasitas_angkutan" class="control-label">Kapasitas Angkutan (kg)</label>
                    <input id="iekapasitas_angkutan" type="text" class="form-control" name="kapasitas_angkutan" placeholder="Kapasitas Kendaraan" required />
                </div>
                <div class="col-md-3">
                    <label for="ieavailability" class="control-label">Ketersediaan *</label>
                    <select id="ieavailability" name="availability" class="form-control" required>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Digunakan">Digunakan</option>
                        <option value="Diperbaiki">Diperbaiki</option>
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
