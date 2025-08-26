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
                            <label class="col-md-4 control-label" for="itgl_beli">Tanggal Beli</label>
                            <div class="col-md-8">
                                <input id="itgl_beli" name="tgl_beli" type="text" class="form-control input-datepicker" value="<?= date("Y-m-d") ?>" data-date-format="yyyy-mm-dd" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ia_vehicle_id">Nama kendaraan *</label>
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
                            <label class="col-md-4 control-label" for="ijenis">Jenis Bahan Bakar </label>
                            <div class="col-md-8">
                                <select id="ijenis" name="jenis" class="form-control" required>
                                    <option value="Pertalite">Pertalite</option>
                                    <option value="Pertamax">Pertamax</option>
                                    <option value="Solar">Solar</option>
                                    <option value="Dextile Plus">Dextile Plus</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="idriver">Driver </label>
                            <div class="col-md-8">
                                <input id="idriver" type="text" name="driver" class="form-control" placeholder="Jumlah Liter" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ijumlah_beli">Jumlah Liter</label>
                            <div class="col-md-8">
                                <input id="ijumlah_beli" type="text" name="jumlah_beli" class="form-control" placeholder="Jumlah Liter" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="iharga">Harga Per Liter</label>
                            <div class="col-md-8">
                                <input id="iharga" type="text" name="harga" class="form-control" required />
                                <input id="ihharga" type="hidden" name="harga" class="form-control" value="0" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="itotal_harga">Total Harga </label>
                            <div class="col-md-8">
                                <input id="itotal_harga" type="text" name="total_harga" class="form-control" required />
                                <input id="ihtotal_harga" type="hidden" name="total_harga" class="form-control" value="0" />
                            </div>
                        </div>
                    </fieldset>
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
                            <label class="col-md-4 control-label" for="ietgl_beli">Tanggal Beli</label>
                            <div class="col-md-8">
                                <input id="ietgl_beli" name="tgl_beli" type="text" class="form-control input-datepicker" value="<?= date("Y-m-d") ?>" data-date-format="yyyy-mm-dd" autocomplete="off" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="iea_vehicle_id">Nama kendaraan *</label>
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
                            <label class="col-md-4 control-label" for="iejenis">Jenis Bahan Bakar </label>
                            <div class="col-md-8">
                                <select id="iejenis" name="jenis" class="form-control" required>
                                    <option value="Pertalite">Pertalite</option>
                                    <option value="Pertamax">Pertamax</option>
                                    <option value="Solar">Solar</option>
                                    <option value="Dextile Plus">Dextile Plus</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="iedriver">Driver </label>
                            <div class="col-md-8">
                                <input id="iedriver" type="text" name="driver" class="form-control" placeholder="Jumlah Liter" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="iejumlah_beli">Jumlah Liter</label>
                            <div class="col-md-8">
                                <input id="iejumlah_beli" type="text" name="jumlah_beli" class="form-control" placeholder="Jumlah Liter" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ieharga">Harga Per Liter</label>
                            <div class="col-md-8">
                                <input id="ieharga" type="text" name="harga" class="form-control" placeholder="" required />
                                <input id="iehharga" type="hidden" name="harga" class="form-control" placeholder="harga" value="0" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="ietotal_harga">Total Harga </label>
                            <div class="col-md-8">
                                <input id="ietotal_harga" type="text" name="total_harga" class="form-control" required />
                                <input id="iehtotal_harga" type="hidden" name="total_harga" class="form-control" value="0" />
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