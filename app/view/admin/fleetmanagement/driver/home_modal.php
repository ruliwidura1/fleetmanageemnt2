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
                        <a id="aedit" href="#" class="btn btn-info" style="text-align: left;"><i class="fa fa-pencil"></i> Edit</a>
                        <button id="ahapus" type="button" class="btn btn-danger btn-submit" style="text-align: left;"><i class="fa fa-trash-o icon-submit"></i> Hapus</button>
                    </div>
                </div>
                <div class="row" style="margin-top: 1em; ">
                    <div class="col-md-12" style="border-top: 1px #afafaf dashed;">&nbsp;</div>
                    <div class="col-xs-12 btn-group-vertical" style="">
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
                            <label class="col-md-4 control-label" for="inama">Nama Driver *</label>
                            <div class="col-md-8">
                                <input id="inama" type="text" name="nama" class="form-control" minlength="2" maxlength="" placeholder="Nama Driver" autocomplete="off" required />
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
                            <label class="col-md-4 control-label" for="ienama">Driver *</label>
                            <div class="col-md-8">
                                <input type="hidden" id="ieid" value="" />
                                <input id="ienama" type="text" name="nama" class="form-control" minlength="2" maxlength="" placeholder="Nama Driver" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="iesim">SIM*</label>
                            <div class="col-md-8">
                                <select id="iesim" name="sim" class="form-control" required>
                                    <option value="SIM A">SIM A</option>
                                    <option value="SIM B1">SIM B1</option>
                                    <option value="SIM B2">SIM B2</option>
                                    <option value="SIM C">SIM C</option>
                                    <option value="SIM C1">SIM C1</option>
                                    <option value="SIM C2">SIM C2</option>
                                    <option value="SIM D">SIM D</option>
                                    <option value="SIM A Umum">SIM A Umum</option>
                                    <option value="SIM B1 Umum">SIM B1 Umum</option>
                                    <option value="SIM B2 Umum">SIM B2 Umum</option>
                                    <option value="SIM Internasional">SIM Internasional</option>
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
