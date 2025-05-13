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
                    <label class="control-label" for="icdate">Jadwal Pemeliharaan Rutin</label>
                    <input id="icdate" name="cdate" type="text" class="form-control input-datepicker"  data-date-format="yyyy-mm-dd" autocomplete="on" />
                </div>
                <div class="col-md-5">
                    <label class="control-label" for="ipermintaan_perbaikan">Permintaan Perbaikan*</label>
                    <input id="ipermintaan_perbaikan" type="text" name="kode" class="form-control" placeholder="Masukan apa yang hasur di perbaiki" autocomplete="off" required />
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="ibiaya_perawatan">Biaya Perawatan*</label>
                    <input id="ibiaya_perawatan" type="text" name="kode" class="form-control" placeholder="Masukan apa yang hasur di perbaiki" autocomplete="off" required />
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <label class="control-label" for="itujuan">Tujuan Pengiriman *</label>
                    <input id="itujuan" name="tujuan" type="text" class="form-control" placeholder="cnth: PT. Mitra Utama" required />
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
