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
        <li>Kendaraan</li>
        <li>Tambah</li>
    </ul>
    <!-- END Static Layout Header -->

    <!-- Content -->
    <div class="block full row">
        <div class="block-title">
            <h4><strong>Form Tambah Data</strong></h4>
        </div>
        <form id="ftambah" action="<?= base_url_admin(); ?>" method="post" enctype="multipart/form-data" class="form-bordered form-horizontal" onsubmit="return false;">
            <div class="form-group">
                <div class="col-md-6">
                    <label for="inama" class="control-label">Nama *</label>
                    <input id="inama" type="text" class="form-control" name="nama" placeholder="Nama Kendaraan" required />
                </div>
                <div class="col-md-6">
                    <label for="iutype" class="control-label">Tipe *</label>
                    <select id="iutype" name="utype" class="form-control input-select2" required>
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
                    <label for="ino_pol" class="control-label">Plat Nomor *</label>
                    <input id="ino_pol" type="text" class="form-control" name="no_pol" placeholder="Plat Nomor Kendaraan" required />
                </div>
                <div class="col-md-4">
                    <label for="imerk" class="control-label">Merk</label>
                    <input id="imerk" type="text" class="form-control" name="merk" placeholder="Merk Kendaraan" />
                </div>
                <div class="col-md-4">
                    <label for="iwarna" class="control-label">Warna</label>
                    <input id="iwarna" type="text" class="form-control" name="warna" placeholder="Warna Kendaraan" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4">
                    <label for="ikapasitas_mesin" class="control-label">Kapasitas Mesin (cc)</label>
                    <input id="ikapasitas_mesin" type="text" class="form-control" name="kapasitas_mesin" placeholder="Kapasitas Kendaraan" required />
                </div>
                
                <div class="col-md-2">
                    <label for="iis_active" class="control-label">Status</label>
                    <select id="iis_active" class="form-control" name="is_active">
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
