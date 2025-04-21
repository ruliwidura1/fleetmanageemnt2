<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    <a id="aback" href="<?= base_url_admin('fleetmanagement/tujuanpengiriman/'); ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li>Tujuan Pengiriman</li>
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
                <div class="col-md-3">
                    <label class="control-label" for="icdate">Tgl Pengiriman</label>
                    <input id="icdate" name="cdate" type="text" class="form-control input-datepicker" value="<?= date("Y-m-d") ?>" data-date-format="yyyy-mm-dd" autocomplete="off" />
                </div>
                <div class="col-md-5">
                    <label class="control-label" for="ikode">SKU*</label>
                    <input id="ikode" type="text" name="kode" class="form-control" minlength="2" maxlength="16" placeholder="huruf, angka, titik, strip(-)" autocomplete="off" required />
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="ic_muatan_id">Barang *</label>
                    <select id="ic_muatan_id" name="c_muatan_id" class="form-control input-select2" required>
                        <option value="">-- Pilih Barang --</option>
                        <?php if (isset($barang_list)) {
                            foreach ($barang_list as $d) { ?>
                                <option value="<?= $d->id ?>"><?= $d->barang ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label" for="itujuan">Tujuan Pengiriman *</label>
                    <input id="itujuan" name="tujuan" type="text" class="form-control" placeholder="cnth: PT. Mitra Utama" required />
                </div>
            </div>

            <div class="block full row">
                <div class="block-title">
                    <h2><strong>Kontak</strong></h2>
                </div>
                <div class="col-md-12">
                    <label class="control-label" for="ialamat">Alamat</label>
                    <input id="ialamat" name="alamat" type="text" class="form-control" minlength="1" />
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="inegara">Negara *</label>
                    <select id="inegara" name="negara" type="text" class="form-control input-select2" required>
                        <option value="Indonesia">Indonesia</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="iprovinsi">Provinsi *</label>
                    <select id="iprovinsi" name="provinsi" type="text" class="form-control input-select2" required>
                        <option value="">-- Pilih --</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="ikabkota">Kab / Kota *</label>
                    <select id="ikabkota" name="kabkota" type="text" class="form-control input-select2" required>
                        <option value="">-- Pilih --</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="ikecamatan">Kecamatan </label>
                    <select id="ikecamatan" name="kecamatan" type="text" class="form-control input-select2">
                        <option value="">-- Pilih --</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="ikelurahan">Kelurahan</label>
                    <select id="ikelurahan" name="kelurahan" type="text" class="form-control input-select2">
                        <option value="">-- Pilih --</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="ikodepos">Kodepos</label>
                    <input id="ikodepos" name="kodepos" type="text" class="form-control" minlength="4">
                </div>
                <div class="form-group">
                    <div class="col-md-12"><br></div>
                </div>
            </div>

            <div class="block full row">
                <div class="block-title">
                    <h2><strong>Status</strong></h2>
                </div>
                <div class="form-group">
                    <div class="col-md-4">
                        <label for="iis_delivered">Status Pengiriman</label>
                        <select id="iis_delivered" name="is_delivered" class="form-control">
                            <option value="1">Diterima</option>
                            <option value="0">Dikirim</option>
                            <option value="2">Batal</option>
                        </select>
                    </div>
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
