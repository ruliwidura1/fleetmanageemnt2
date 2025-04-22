<?php
	$admin_foto = '';
	if(isset($sess->admin->foto))$admin_foto = $sess->admin->foto;
	if(empty($admin_foto)) $admin_foto = 'media/user-default.png';
	$admin_foto = base_url($admin_foto);
?>
<div id="page-content">
	<!-- Static Layout Header -->
	<div class="content-header">
		<div class="row">
			<div class="col-md-6">
				<div class="btn-group">
					<a id="aback" href="<?=base_url_admin(''); ?>" class="btn btn-default"><i class="fa fa-chevron-left"></i> Kembali</a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="btn-group pull-right">
					<button type="button" id="bprofil_foto" href="#" class="btn btn-info" data-toggle="tooltip" title="Change Display Picture" data-original-title="Change Display Picture"><i class="fa fa-file-image-o"></i> Ganti Foto Profil</button>
					<button type="button" id="bprofil" href="#" class="btn btn-info" data-toggle="tooltip" title="Edit Profile" data-original-title="Edit Profil"><i class="fa fa-edit"></i> Edit Profil</button>
					<button type="button" id="bpassword_change" href="#" class="btn btn-info" data-toggle="tooltip" title="Change Password" data-original-title="Change Password"><i class="fa fa-key"></i> Ganti Password</button>
				</div>
			</div>
		</div>
	</div>
	<ul class="breadcrumb breadcrumb-top">
		<li>Dashboard</li>
		<li>Profil Saya</li>
	</ul>
	<!-- END Static Layout Header -->

	<!-- Content -->
	<?php if(isset($notif)){ ?>
	<div class="alert alert-info" role="alert">
		<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		<?=$notif?>
	</div>
	<?php } ?>
	<div class="block full row">
		<div class="block-title">
			<h2><strong>Profil</strong></h2>
		</div>
		<div class="form-group">
			<div class="col-md-3">
				<img src="<?=$admin_foto?>" style="width: 100%;" class="img-responsive" />
			</div>
			<div class="col-md-3">&nbsp;</div>
			<div class="col-md-6">
				<div class="table-responsive">
				<table class="table">
					<tr>
						<th>Nama</th>
						<td>:</td>
						<td><?=$sess->admin->nama?></td>
					</tr>
					<tr>
						<th>Username</th>
						<td>:</td>
						<td><?=$sess->admin->username?></td>
					</tr>
					<tr>
						<th>Email</th>
						<td>:</td>
						<td><?=$sess->admin->email?></td>
					</tr>
				</table>
				</div>
			</div>
		</div>
	</div>

	<!-- END Content -->
</div>
