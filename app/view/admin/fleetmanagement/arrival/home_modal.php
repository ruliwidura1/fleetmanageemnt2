<!--Modal Option-->
<div id="modal_option" class="modal fade " tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title">Pilihan</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 btn-group-vertical ">
                        <a id="adetail" href="#" class="btn btn-info" style="text-align: left;"><i class="fa fa-info-circle"></i> Detail</a>
                        <a id="aedit" href="#" class="btn btn-info" style="text-align: left;"><i class="fa fa-pencil"></i> Edit</a>
                        <button id="ahapus" type="button" class="btn btn-danger btn-submit" style="text-align: left;"><i class="fa fa-trash-o icon-submit"></i> Hapus</button>
                    </div>
                </div>
                <div class="row" style="margin-top: 1em; ">
                    <div class="col-md-12" style="border-top: 1px #afafaf dashed;">&nbsp;</div>
                    <div class="col-xs-12 btn-group-vertical">
                        <button type="button" class="btn btn-default btn-block text-left" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    </div>
                </div>
                <!-- END Modal Body -->
            </div>
        </div>
    </div>
</div>

<!-- modal tambah -->
<div id="modal_tambah" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title">Tambah</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="ftambah" action="<?= base_url_admin(); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="icdate">Tanggal Keberangkatan</label>
                            <div class="col-md-8">
                                <input id="icdate" name="cdate" type="text" class="form-control input-datepicker" value="<?= date("Y-m-d") ?>" data-date-format="yyyy-mm-dd" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ib_driver_id">Driver *</label>
                            <div class="col-md-8">
                                <select id="ib_driver_id" name="b_driver_id" class="form-control input-select2" required>
                                    <option value="">-- Pilih Driver --</option>
                                    <?php if (isset($driver_list)) {
                                        foreach ($driver_list as $d) { ?>
                                            <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ia_vehicle_id">Kendaraan *</label>
                            <div class="col-md-8">
                                <select id="ia_vehicle_id" name="a_vehicle_id" class="form-control input-select2" required>
                                    <option value="">-- Pilih Kendaraan --</option>
                                    <?php if (isset($vehicle_list)) {
                                        foreach ($vehicle_list as $v) { ?>
                                            <option value="<?= $v->id ?>"><?= $v->nama ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ijam_masuk">Jam Masuk *</label>
                            <div class="col-md-8">
                                <input id="ijam_masuk" name="jam_masuk" type="time" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="idestination">Kembali Dari *</label>
                            <div class="col-md-8">
                                <input id="idestination" name="destination" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="iis_completed">Status Kedatangan *</label>
                            <div class="col-md-8">
                                <select id="iis_completed" name="is_completed" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="0">Perjalanan</option>
                                    <option value="1">Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="iis_active">Status *</label>
                            <div class="col-md-8">
                                <select id="iis_active" name="is_active" class="form-control" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group form-actions">
                            <div class="col-xs-12 text-right">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save icon-submit"></i> Simpan</button>
                            </div>
                        </div>
                </form>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>

<!-- modal edit -->
<div id="modal_edit" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title">Edit</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="fedit" action="<?= base_url_admin(); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" onsubmit="return false;">
                    <fieldset>
                    <div class="form-group">
                            <label class="col-md-4 control-label" for="iecdate">Tanggal Keberangkatan</label>
                            <div class="col-md-8">
                                <input id="iecdate" name="cdate" type="text" class="form-control input-datepicker" value="<?= date("Y-m-d") ?>" data-date-format="yyyy-mm-dd" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ieb_driver_id">Driver *</label>
                            <div class="col-md-8">
                                <select id="ieb_driver_id" name="b_driver_id" class="form-control" required>
                                    <?php if (isset($driver_list)) {
                                        foreach ($driver_list as $d) { ?>
                                            <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="iea_vehicle_id">Kendaraan *</label>
                            <div class="col-md-8">
                                <select id="iea_vehicle_id" name="a_vehicle_id" class="form-control" required>
                                    <?php if (isset($vehicle_list)) {
                                        foreach ($vehicle_list as $v) { ?>
                                            <option value="<?= $v->id ?>"><?= $v->nama ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="iejam_masuk">Jam Masuk *</label>
                            <div class="col-md-8">
                                <input id="iejam_masuk" name="jam_masuk" type="time" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="iedestination">Kembali Dari *</label>
                            <div class="col-md-8">
                                <input id="iedestination" name="destination" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ieis_completed">Status Kedatangan *</label>
                            <div class="col-md-8">
                                <select id="ieis_completed" name="is_completed" class="form-control" required>
                                    <option value="0">Perjalanan</option>
                                    <option value="1">Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ieis_active">Status *</label>
                            <div class="col-md-8">
                                <select id="ieis_active" name="is_active" class="form-control" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save icon-submit"></i> Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>