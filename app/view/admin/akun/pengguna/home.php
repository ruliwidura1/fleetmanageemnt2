<div id="page-content">
	<!-- Static Layout Header -->
	<div class="content-header">
		<div class="row">
			<div class="col-md-6">

			</div>
			<div class="col-md-6">
				<div class="btn-group pull-right">
					<button type="button" id="baru_button" class="btn btn-info btn-submit">
                        <i class="fa fa-plus icon-submit"></i> Baru
                    </button>
				</div>
			</div>
		</div>
	</div>
	<ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
		<li>Akun</li>
		<li>Pengguna</li>
	</ul>
	<!-- END Static Layout Header -->

	<!-- Content -->
	<div class="block full">

		<div class="block-title">
			<h2><strong>Pengguna</strong></h2>
		</div>
		<div class="row row-filter">
			<div class="col-md-7">&nbsp;</div>
			<div class="col-md-3">
				<label for="filter_is_active">Status</label>
				<select id="filter_is_active" class="form-control">
					<option value="">-- Semua --</option>
					<option value="1">Aktif</option>
					<option value="0">Tidak Aktif</option>
				</select>
			</div>
			<div class="col-md-2">
				<br />
                <div class="btn-group pull-right">
                    <button id="filter_button" type="button" class="btn btn-info btn-alt btn-submit">
                        <i class="fa fa-filter icon-submit"></i> Filter
                    </button>
                </div>

			</div>
		</div>

		<div class="table-responsive">
			<table id="drTable" class="table table-vcenter table-condensed table-bordered">
				<thead>
					<tr>
						<th class="text-center">ID</th>
						<th class="text-center">Foto</th>
						<th class="text-center">Username</th>
						<th>Email</th>
						<th>Nama</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>

	</div>
	<!-- END Content -->
</div>