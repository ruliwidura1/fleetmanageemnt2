<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    <a id="anchor_kembali" href="<?= base_url_admin('fleetmanagement/bahanbakar/'); ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li>Bahan Bakar</li>
        <li>Baru</li>
    </ul>
    <!-- END Static Layout Header -->

    <!-- Content -->
    <div class="block full row">
        <div class="block-title">
            <h4><strong>Form Input Data Baru</strong></h4>
        </div>
        <form id="form_input_data_baru" action="<?= base_url_admin(); ?>" method="post" enctype="multipart/form-data" class="form-bordered form-horizontal" onsubmit="return false;">
            <div class="form-group">
                <div class="col-md-3">
                    <label for="ijenis" class="control-label">Jenis BBM*</label>
                    <select id="ijenis" name="jenis" class="form-control input-select2" required>
                        <?php $this->getThemeElement('page/components/bbm_options', $__forward); ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="ikendaraan" class="control-label">Kendaraan *</label>
                    <input id="ikendaraan" type="text" class="form-control" name="kendaraan" placeholder="contoh: Truk Fuso 6x4 Hijau" required />
                </div>
                <div class="col-md-3">
                    <label for="idriver" class="control-label">Driver</label>
                    <input id="idriver" type="text" class="form-control" name="driver" placeholder="Nama Driver, tidak wajib" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12"><div class="alert alert-info">** Pilih salah satu antara <code>Jumlah Pembelian Per Liter</code> atau <code>Jumlah total nominal pembelian BBM</code></div></div>
                <div class="col-md-4">
                    <label for="iharga_per_liter" class="control-label">Harga Per Liter</label>
                    <input id="iharga_per_liter" type="number" step="1" min="0" class="form-control" name="harga_per_liter" />
                </div>
                <div class="col-md-4">
                    <label for="itotal_pembelian_per_liter" class="control-label">Jumlah Pembelian Per Liter **</label>
                    <input id="itotal_pembelian_per_liter" type="number" step="1" min="0" class="form-control" name="total_pembelian_per_liter" />
                </div>
                <div class="col-md-4">
                    <label for="itotal_pembelian_harga" class="control-label">Jumlah total nominal pembelian BBM **</label>
                    <input id="itotal_pembelian_harga" type="number" step="1" min="0" class="form-control" name="total_pembelian_harga" />
                </div>
            </div>

            <div class="form-group form-actions">
                <div class="col-xs-12 text-right">
                    <div class="btn-group pull-right">
                        <?php $this->getThemeElement('page/components/button_simpan', $__forward); ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
