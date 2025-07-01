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
        <li><a href="<?= base_url_admin("fleetmanagement/kendaraan/") ?>">Kendaraan</a></li>
        <li>Edit #<?= $cam->id ?></li>
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
                    <label for="iepelanggan_nama" class="control-label">Nama Pelanggan *</label>
                    <input id="iepelanggan_nama" type="text" class="form-control" name="pelanggan_nama" placeholder="Nama Anda" required />
                </div>
                <div class="col-md-6">
                    <label for="ietelp" class="control-label">Nomor Telepon Pelanggan *</label>
                    <input id="ietelp" type="text" class="form-control" name="telp" placeholder="Telepon/Hp" required />
                </div>
                <div class="col-md-3">
                    <label class="control-label" for="iemerk_ac">Merk AC</label>
                    <select id="iemerk_ac" name="merk_ac" type="text" class="form-control">
                        <option value="lainnya">lainnya</option>
                        <option value="Panasonic CS/CU-XPU5XKJ">Panasonic CS/CU-XPU5XKJ</option>
                        <option value="Daikin FTC15NV14">Daikin FTC15NV14</option>
                        <option value="Sharp AH-X6ZY">Sharp AH-X6ZY</option>
                        <option value="LG H05TN4">LG H05TN4</option>
                        <option value="Samsung AR-05TGHQ">Samsung AR-05TGHQ</option>
                        <option value="Changhong CSC-05NVB">Changhong CSC-05NVB</option>
                        <option value="Midea MSAF-05CRN2">Midea MSAF-05CRN2</option>
                        <option value="Mitsubishi MS-JR10 VF">Mitsubishi MS-JR10 VF</option>
                        <option value="Denpoo DDS-199CI">Denpoo DDS-199CI</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="control-label" for="ieremot_jenis">Remot jenis</label>
                    <select id="ieremot_jenis" name="remot_jenis" type="text" class="form-control">
                        <option value="Original">Original</option>
                        <option value="Tidak Original">Tidak Original</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="control-label" for="ieremot_kode">Remot Kode</label>
                    <input id="ieremot_kode" name="remot_kode" type="text" class="form-control" placeholder="Remot Kode" />
                </div>
                
                <div class="col-md-3">
                    <label for="iepk" class="control-label">PK *</label>
                    <input id="iepk" type="text" class="form-control" name="pk" placeholder="Pk" required />
                </div>
                <div class="col-md-12">
                    <label for="iedeskripsi_kerusakan">Deskripsi Kerusakan *</label>
                    <textarea id="iedeskripsi_kerusakan" name="deskripsi_kerusakan" type="text" class="form-control" placeholder="Deskripsi Kerusakan"></textarea>
                </div>
                <div class="col-md-4">
                    <label for="ieteknisi_1_nama" class="control-label">Teknisi (1) *</label>
                    <input id="ieteknisi_1_nama" type="text" class="form-control" name="teknisi_1_nama" placeholder="Nama Teknisi 1" required />
                </div>
                <div class="col-md-4">
                    <label for="ieteknisi_2_nama" class="control-label">Teknisi (2) </label>
                    <input id="ieteknisi_2_nama" type="text" class="form-control" name="teknisi_2_nama" placeholder="Nama Teknisi 2" />
                </div>
                <div class="col-md-4">
                    <label for="ieteknisi_3_nama" class="control-label">Teknisi (3) </label>
                    <input id="ieteknisi_3_nama" type="text" class="form-control" name="teknisi_3_nama" placeholder="Nama Teknisi 3" />
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="ietanggal_perbaikan">Tanggal Service</label>
                    <input id="ietanggal_perbaikan" name="tanggal_perbaikan" type="text" class="form-control input-datepicker" value="<?= date("Y-m-d") ?>" data-date-format="yyyy-mm-dd" autocomplete="off" />
                </div>
                <div class="col-md-4">
                    <label class="control-label" for="ieis_proses">Status</label>
                    <select id="ieis_proses" name="is_proses" class="form-control">
                        <option value="1">Dalam Proses</option>
                        <option value="0">Selesai</option>
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
