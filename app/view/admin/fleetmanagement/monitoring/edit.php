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
        <li><a href="<?= base_url_admin("fleetmanagement/kendaraan/") ?>">Kendaraan</a></li>
        <li>Edit #<?= $cmm->id ?></li>
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
                    <label for="ieintegrasi_gps_tracking" class="control-label">Keberadaan Kendaraan *</label>
                    <input id="ieintegrasi_gps_tracking" type="text" class="form-control" name="integrasi_gps_tracking" placeholder="Nama Kendaraan" required />
                </div>
                <div class="col-md-4">
                    <label for="iepelacakan_posisi_realtime_kendaraan" class="control-label">Jalur Yang Di Tempuh *</label>
                    <input id="iepelacakan_posisi_realtime_kendaraan" type="text" class="form-control" name="pelacakan_posisi_realtime_kendaraan" placeholder="Plat Nomor Kendaraan" required />
                </div>
                <div class="col-md-4">
                    <label for="ieriwayat_rute_perjalanan" class="control-label">Target Waktu</label>
                    <input id="ieriwayat_rute_perjalanan" type="text" class="form-control" name="riwayat_rute_perjalanan" placeholder="Merk Kendaraan" />
                </div>
                <div class="col-md-4">
                    <label for="iealert_perjalanan_berlebih" class="control-label">Biaya Bahan Bakar</label>
                    <input id="iealert_perjalanan_berlebih" type="text" class="form-control" name="alert_perjalanan_berlebih" placeholder="Warna Kendaraan" />
                </div>
                <div class="col-md-4">
                    <label for="iegeofencing" class="control-label">Biaya Perbaikan</label>
                    <input id="iegeofencing" type="text" class="form-control" name="geofencing" placeholder="Kapasitas Kendaraan" required />
                </div>
                <div class="col-md-4">
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
