<!-- modal tambah -->
<div id="baru_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header text-center">
				<h2 class="modal-title">Data Baru</h2>
			</div>
			<!-- END Modal Header -->

			<!-- Modal Body -->
			<div class="modal-body">
				<form id="baru_modal_form" action="<?=base_url_admin(); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
					<fieldset>
						<!--<div class="form-group">
							<label class="col-md-4 control-label" for="ination_code">Nation Code*</label>
							<div class="col-md-8">
								<input id="ination_code" type="number" value="65" name="nation_code" class="form-control" minlength="2" maxlength="" placeholder="" required />
							</div>
						</div>-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="iusername">Username*</label>
							<div class="col-md-8">
								<input id="iusername" type="text" name="username" class="form-control" minlength="4" maxlength="" placeholder="username untuk login, min 4 char" required />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="inama">Nama *</label>
							<div class="col-md-8">
								<input id="inama" type="text" name="nama" class="form-control" minlength="1" placeholder="Nama Lengkap" required />
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="iemail">Email*</label>
							<div class="col-md-8">
								<input id="iemail" type="text" name="email" class="form-control" minlength="4" placeholder="bisa digunakan untuk login" required />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="ipassword">Password*</label>
							<div class="col-md-8">
								<input id="ipassword" type="password" name="password" class="form-control" minlength="5" placeholder="kata sandi, minimal 6 char" required />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="irepassword">Ulangi Password*</label>
							<div class="col-md-8">
								<input id="irepassword" type="password" class="form-control" minlength="1" placeholder="konfirmasi kata sandi" required />
							</div>
						</div>
					</fieldset>
					<fieldset>
						<div class="form-group">
							<label class="col-md-4 control-label" for="iis_active">Status*</label>
							<div class="col-md-8">
								<select id="iis_active" name="is_active" class="form-control" required>
									<option value="1">Aktif</option>
									<option value="0">Tidak Aktif</option>
								</select>
							</div>
						</div>
					</fieldset>
					<fieldset>
						<div class="modal-body">
							<label class="col-md-4 control-label" for="iprofil_foto">Cari Foto*</label>
							<div class="col-md-8">
								<input id="iprofil_foto" type="file" name="foto" class="form-control" accept="image/x-png,image/png,image/jpeg,image/jpg" />
							</div>
						</div>
					</fieldset>
					<div class="form-group form-actions">
						<div class="col-xs-12 text-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    <i class="fa fa-times"></i>
                                    Tutup
                                </button>
                                <button type="submit" id="baru_modal_form_submit_button" class="btn btn-primary btn-submit">
                                    Simpan
                                    <i class="fa fa-save icon-submit"></i>
                                </button>
                            </div>

						</div>
					</div>
				</form>
			</div>
			<!-- END Modal Body -->
		</div>
	</div>
</div>

<!-- modal edit -->
<div id="edit_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header text-center">
				<h2 class="modal-title">Edit Data #<span id="edit_modal_judul_id"></span></h2>
			</div>
			<!-- END Modal Header -->

			<!-- Modal Body -->
			<div class="modal-body">
				<form id="edit_modal_form" action="<?=base_url_admin(); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" onsubmit="return false;">
					<fieldset>
						<input type="hidden" id="ieid1" name="id" value="" />
						<!--<div class="form-group">
							<label class="col-md-4 control-label" for="ienation_code">Nation Code*</label>
							<div class="col-md-8">
								<input id="ienation_code" type="number" name="nation_code" class="form-control" minlength="2" maxlength="" placeholder="" required />
							</div>
						</div>-->
						<div class="form-group">
							<label class="col-md-4 control-label" for="ieusername">Username*</label>
							<div class="col-md-8">
								<input id="ieusername" type="text" name="username" class="form-control" minlength="4" maxlength="" placeholder="" required />
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="ieemail">Email*</label>
							<div class="col-md-8">
								<input id="ieemail" type="text" name="email" class="form-control" minlength="4" placeholder="" required />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="ienama">Name</label>
							<div class="col-md-8">
								<input id="ienama" type="text" name="nama" class="form-control" minlength="1" placeholder="" />
							</div>
						</div>
					</fieldset>
					<fieldset>
						<div class="form-group">
							<label class="col-md-4 control-label" for="ieis_active">Status*</label>
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
                            <div class="btn-group">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    <i class="fa fa-times"></i>
                                    Tutup
                                </button>
                                <button id="bhapus" type="button" class="btn btn-danger btn-submit">
                                    <i class="fa fa-trash-o icon-submit"></i>
                                    Hapus
                                </button>
                                <button type="submit" class="btn btn-primary btn-submit">
                                    Simpan Perubahan
                                    <i class="fa fa-save icon-submit"></i>
                                </button>
                            </div>
						</div>
					</div>
				</form>
			</div>
			<!-- END Modal Body -->
		</div>
	</div>
</div>

<!-- modal edit welcome message -->
<div id="edit_modal_wm" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header text-center">
				<h2 class="modal-title">Edit Welcome Message</h2>
			</div>
			<!-- END Modal Header -->

			<!-- Modal Body -->
			<div class="modal-body">
				<form id="fewm" action="<?=base_url_admin(); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" onsubmit="return false;">
					<fieldset>
						<input id="fewm_id" name="id" type="hidden" value="" />
						<input id="fewm_nation_code" name="nation_code" type="hidden" value="" />
						<div class="form-group">
							<label class="col-md-4 control-label" for="iewelcome_message">Welcome Message*</label>
							<div class="col-md-8">
								<input id="fewm_welcome_message" type="text" name="welcome_message" class="form-control" minlength="" maxlength="" placeholder="" required />
							</div>
						</div>
					</fieldset>
					<div class="form-group form-actions">
						<div class="col-xs-12 text-right">
							<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-sm btn-primary">Simpan Perubahan</button>
						</div>
					</div>
				</form>
			</div>
			<!-- END Modal Body -->
		</div>
	</div>
</div>

<!--modal edit password-->
<div id="edit_modal_password" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<!-- Modal Header -->
			<div class="modal-header text-center">
				<h2 class="modal-title">Ganti Password</h2>
			</div>
			<!-- END Modal Header -->

			<!-- Modal Body -->
			<div class="modal-body">
				<form id="fpe" action="<?=base_url_admin(); ?>" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" onsubmit="return false;">
					<fieldset>
						<input type="hidden" id="fpe_id" name="id" />
						<input type="hidden" id="fpe_nation_code" name="nation_code" />
						<div class="form-group">
							<label class="col-md-4 control-label" for="inewpassword">Password*</label>
							<div class="col-md-8">
								<input id="fpe_newpassword" type="password" name="password" class="form-control" minlength="5" placeholder="" required />
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label" for="irepassword">Ulangi Password*</label>
							<div class="col-md-8">
								<input id="fpe_renewpassword" type="password" class="form-control" minlength="5" placeholder="" required />
							</div>
						</div>
					</fieldset>
					<div class="form-group form-actions">
						<div class="col-xs-12 text-right">
							<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-sm btn-primary">Simpan Perubahan</button>
						</div>
					</div>
				</form>
			</div>
			<!-- END Modal Body -->
		</div>
	</div>
</div>

<!--Modal Option-->
<div id="option_modal" class="modal fade " tabindex="-1" role="dialog" aria-hidden="true">
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
						<a id="aedit" href="#" class="btn btn-info btn-left"><i class="fa fa-pencil"></i> Edit</a>
						<a id="aedit_password" href="#" class="btn btn-info btn-left"><i class="fa fa-pencil"></i> Ganti Password</a>
						<a id="bprofil_foto" href="#" class="btn btn-info btn-left"><i class="fa fa-pencil"></i> Ganti Foto Profil</a>
						<!--<a id="aedit_wm" href="#" class="btn btn-info btn-left"><i class="fa fa-pencil"></i> Edit Welcome Message</a>-->
						<button id="ahak_akses" type="button" class="btn btn-info btn-left"><i class="fa fa-key"></i> Hak Akses</button>
						<button id="hapus_button" type="button" class="btn btn-danger btn-left btn-submit"><i class="fa fa-trash-o icon-submit"></i> Hapus</button>
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

<!--modal foto-->
<div id="modal_profil_foto" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header text-center">
				<h2 class="modal-title">Ganti Foto Profil</h2>
			</div>
			<!-- END Modal Header -->

			<div class="modal-body">
				<form id="fef" method="post" enctype="multipart/form-data" action="<?=base_url_admin('akun/pengguna/edit_foto')?>">
					<div class="form-group">
						<input id="fef_id" name="id" type="hidden" class="form-control" required />
						<input id="fef_foto" type="file" name="foto" class="form-control" accept="image/png, image/jpeg" required />
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="btn-group pull-right">
								<button id="btn_foto_reset" type="button" class="btn btn-default"> Reset</button>
								<button type="submit" class="btn btn-success"><i class="fa fa-upload"></i> Upload</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!--modal hak akses-->
<div id="modal_hak_akses" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header text-center">
				<h2 class="modal-title">Hak Akses <span id="fha_a_pengguna_username"></span></h2>
			</div>
			<!-- END Modal Header -->

			<!-- Modal Body -->
			<div class="modal-body">
				<form id="form_hak_akses" method="post" enctype="multipart/form-data" action="<?=base_url_admin('akun/pengguna/hak_akses/')?>">
					<table width="100%" cellpadding="0" cellspacing="0">
						<?=$access;?>
					</table>
					<input type="hidden" id="fha_a_pengguna_id" name="a_pengguna_id" />
				</form>
			</div>
			<!-- END Modal Body -->


			<!-- Modal Footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
				<button type="button" id="btambah_access" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
			</div>
			<!-- END Modal Footer -->
		</div>
	</div>
</div>