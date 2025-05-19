<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                    <a id="aback" href="<?= base_url_admin('fleetmanagement/pemeliharaanservice/'); ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li>Pemeliharaan Service</li>
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
                <div class="col-md-4">
                    <label class="control-label" for="ijenis_kendaraan">Jenis Kendaraan *</label>
                    <input id="ijenis_kendaraan" name="jenis_kendaraan" type="text" class="form-control" placeholder="Nama Barang yang dimuat" required />
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="itanggal_perbaikan">Tgl Perbaikan</label>
                    <input id="itanggal_perbaikan" name="tanggal_perbaikan" type="text" class="form-control input-datepicker" value="<?= date("Y-m-d") ?>" data-date-format="yyyy-mm-dd" autocomplete="off" />
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="ideskripsi_kerusakan">Deskripsi Kerusakan *</label>
                    <input id="ideskripsi_kerusakan" name="deskripsi_kerusakan" type="text" class="form-control" placeholder="Nama Barang yang dimuat" required />
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="itindakan_perbaikan">Tindakan Perbaikan *</label>
                    <input id="itindakan_perbaikan" name="tindakan_perbaikan" type="text" class="form-control input-datepicker" value="<?= date("Y-m-d") ?>" data-date-format="yyyy-mm-dd" autocomplete="off" />
                </div>
                <div class="col-md-6">
                    <label class="control-label" for="ibiaya_perbaikan">Biaya Perbaikan *</label>
                    <input id="ibiaya_perbaikan" name="biaya_perbaikan" type="text" class="form-control" placeholder="Nama Barang yang dimuat" required />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <label for="iis_active">Status</label>
                    <select id="iis_active" name="is_active" class="form-control">
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
