<div id="page-content">
  <!-- Static Layout Header -->
  <div class="content-header">
    <div class="row">
      <div class="col-md-12">
        <div class="btn-group">
          <a id="aback" href="<?= base_url_admin('fleetmanagement/monitoring/'); ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
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
          <label class="control-label" for="iintegrasi_gps_tracking">Keberadaan Kendaraan *</label>
          <input id="iintegrasi_gps_tracking" name="integrasi_gps_tracking" type="text" class="form-control" placeholder="" required />
        </div>
        <div class="col-md-4">
          <label class="control-label" for="ipelacakan_posisi_realtime_kendaraan">Jalur Yang Di Tempuh *</label>
          <input id="ipelacakan_posisi_realtime_kendaraan" name="pelacakan_posisi_realtime_kendaraan" type="text" class="form-control" placeholder="" required />
        </div>
        <div class="col-md-4">
          <label class="control-label" for="iriwayat_rute_perjalanan">Target Waktu *</label>
          <input id="iriwayat_rute_perjalanan" name="riwayat_rute_perjalanan" type="text" class="form-control" placeholder="" required />
        </div>
        <div class="col-md-4">
          <label class="control-label" for="ialert_perjalanan_berlebih">Biaya Bahan Bakar *</label>
          <input id="ialert_perjalanan_berlebih" name="alert_perjalanan_berlebih" type="text" class="form-control" placeholder="" required />
        </div>
        <div class="col-md-4">
          <label class="control-label" for="igeofencing">Geofencing *</label>
          <input id="igeofencing" name="geofencing" type="text" class="form-control" placeholder="" required />
        </div>
        <div class="col-md-4">
          <label class="control-label" for="iis_active">Status</label>
          <select id="iis_active" name="is_active" class="form-control">
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
              Simpan <i class="fa fa-save icon-submit"></i>
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
