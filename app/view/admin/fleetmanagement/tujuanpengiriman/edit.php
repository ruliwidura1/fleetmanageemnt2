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
        <li><a href="<?= base_url_admin("fleetmanagement/tujuanpengiriman/") ?>">Tujuan Pengiriman</a></li>
        <li>Edit #<?= $dpm->id ?></li>
    </ul>
    <!-- END Static Layout Header -->

    <!-- Content -->
    <div class="block full row">
        <div class="block-title">
            <h4><strong>Form Edit Data</strong></h4>
        </div>
        <form id="fedit" action="<?= base_url_admin(); ?>" method="post" enctype="multipart/form-data" class="form-bordered form-horizontal" onsubmit="return false;">
            <div class="form-group">
                <div class="col-md-3">
                    <label class="control-label" for="iecdate">Tgl Pengiriman</label>
                    <input id="iecdate" name="cdate" type="text" class="form-control input-datepicker" value="<?= date("Y-m-d") ?>" data-date-format="yyyy-mm-dd" autocomplete="off" />
                </div>
                <div class="col-md-5">
                    <label class="control-label" for="iekode">SKU*</label>
                    <input id="iekode" type="text" name="kode" class="form-control" minlength="2" maxlength="16" placeholder="huruf, angka, titik, strip(-)" autocomplete="off" required />
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="iec_muatan_id">Barang *</label>
                    <select id="iec_muatan_id" name="c_muatan_id" class="form-control" required>
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
                <div class="col-md-8">
                    <label class="control-label" for="ietujuan">Tujuan Pengiriman *</label>
                    <input id="ietujuan" name="tujuan" type="text" class="form-control" placeholder="cnth: PT. Mitra Utama" required />
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="ieis_delivered">Status Pengiriman</label>
                    <select id="ieis_delivered" name="is_delivered" class="form-control">
                        <option value="1">Diterima</option>
                        <option value="0">Dikirim</option>
                        <option value="2">Batal</option>
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