<div id="page-content">
	<!-- Static Layout Header -->
	<div class="content-header">
		<div class="row" style="padding: 0.5em 2em;">
			<div class="col-md-6"></div>
			<div class="col-md-6">
				<div class="btn-group pull-right">
					<a id="button_ke_halaman_buat_baru" href="<?=base_url_admin('fleetmanagement/bahanbakar/baru')?>" class="btn btn-info"><i class="fa fa-plus"></i> Baru</a>
				</div>
			</div>
		</div>
	</div>
	<ul class="breadcrumb breadcrumb-top">
		<li>Admin</li>
		<li>Fleet Management</li>
		<li>Pembelian BBM</li>
	</ul>
	<!-- END Static Layout Header -->

	<!-- Content -->
	<div class="block full">

		<div class="block-title">
			<h2><strong>List Data</strong></h2>
		</div>
    <div class="table-responsive">

  		<table id="drTable" class="table table-vcenter table-condensed table-bordered">
  			<thead>
  				<tr>
					<th class="text-center">ID</th>
					<th>Tanggal Pembelian</th>
					<th>Kendaraan</th>
					<th>Driver</th>
					<th>Jenis BBM</th>
                    <th>Jumlah Pembelian</th>
  				</tr>
  			</thead>
  			<tbody>
  			</tbody>
  		</table>
  	</div>
  </div>
</div>
