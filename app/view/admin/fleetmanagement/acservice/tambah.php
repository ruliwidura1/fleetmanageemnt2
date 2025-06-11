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
    <li>AC Service</li>
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
        <div class="col-md-5">
          <label class="control-label" for="ipelanggan_nama">Nama Pelanggan *</label>
          <input id="ipelanggan_nama" name="pelanggan_nama" type="text" class="form-control" placeholder="Masukan Nama anda" required />
        </div>
        <div class="col-md-5">
          <label class="control-label" for="itelp">Nomor Hp Pelanggan *</label>
          <input id="itelp" name="telp" type="text" class="form-control" placeholder="Masukan No telepon anda" required />
        </div>
        <div class="col-md-2">
          <label class="control-label" for="ipk">PK *</label>
          <input id="ipk" name="pk" type="text" class="form-control" placeholder="Masukan No telepon anda" required />
        </div>

        <div class="col-md-5">
          <label class="control-label" for="iteknisi_1_nama">Teknisi 1 *</label>
          <input id="iteknisi_1_nama" name="teknisi_1_nama" type="text" class="form-control" placeholder="Masukan No telepon anda" required />
        </div>
        <div class="col-md-5">
          <label class="control-label" for="iteknisi_2_nama">Teknisi 2 *</label>
          <input id="iteknisi_2_nama" name="teknisi_2_nama" type="text" class="form-control" placeholder="Masukan No telepon anda" required />
        </div>
        <div class="col-md-2">
          <label class="control-label" for="itanggal_perbaikan">Tanggal Service</label>
          <input id="itanggal_perbaikan" name="tanggal_perbaikan" type="text" class="form-control input-datepicker" value="<?= date("Y-m-d") ?>" data-date-format="yyyy-mm-dd" autocomplete="off" />
        </div>
        <div class="col-md-4">
          <label class="control-label" for="iteknisi_3_nama">Teknisi 3 *</label>
          <input id="iteknisi_3_nama" name="teknisi_3_nama" type="text" class="form-control" placeholder="Masukan No telepon anda" required />
        </div>
      </div>

      <div class="form-group">
        <div class="col-md-12">
					<label for="ideskripsi_kerusakan">Deskripsi Service AC *</label>
					<textarea id="ideskripsi_kerusakan" name="deskripsi_kerusakan" type="text" class="form-control" placeholder=""></textarea>
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
