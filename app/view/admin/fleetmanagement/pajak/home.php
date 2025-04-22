<div id="page-content">
	<!-- Static Layout Header -->
	<div class="content-header">
		<div class="row" style="padding: 0.5em 2em;">
			<div class="col-md-6"></div>
			<div class="col-md-6">
				<div class="btn-group pull-right">
					<a id="atambah" href="#" class="btn btn-info"><i class="fa fa-plus"></i> Baru</a>
				</div>
			</div>
		</div>
	</div>
	<ul class="breadcrumb breadcrumb-top">
		<li>Admin</li>
		<li>Fleet Management</li>
		<li>Pajak</li>
	</ul>

	<!-- END Static Layout Header -->

    <div class="block full">
        <div class="row">
            <div class="col-md-3">
                <label for="fl_utype">Tipe Kendaraan</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                    <select id="fl_utype" class="form-control input-select2">
                        <option value="">Pilih Jenis Kendaraan</option>
                        <option value="Pickup">Pickup</option>
                        <option value="Van">Van</option>
                        <option value="Box">Box</option>
                        <option value="Engkel">Engkel</option>
                        <option value="Double">Diesel</option>
                        <option value="Fuso">Fuso</option>
                        <option value="Tronton">Tronton</option>
                        <option value="Trintin">Trintin</option>
                        <option value="Trinton">Trinton</option>
                        <option value="Wingbox">Wingbox</option>
                        <option value="Trailer">Trailer</option>
                    </select>
                </div>
            </div>
            <div class="col-md-9">
                <br />
                <div class="btn-group pull-right">
                    <a id="fl_do" href="#" class="btn btn-default"><i class="fa fa-filter"> Filter</i></a>
                </div>
            </div>
        </div>
    </div>

	<!-- Content -->
	<div class="block full">

		<div class="block-title">
			<h2><strong>Data Pajak</strong></h2>
		</div>
    <div class="table-responsive">

  		<table id="drTable" class="table table-vcenter table-condensed table-bordered">
  			<thead>
  				<tr>
					<th class="text-center">ID</th>
                    <th>Nama</th>
                    <th>Jenis Kendaraan</th>
                    <th>Plat Nomor</th>
                    <th>Tahun Pembuatan</th>
                    <th>Berlaku PN</th>
					<th>Nominal Pajak</th>
                    <th>Perpanjang Pajak</th>
                    <th>Status</th>
                    
  				</tr>
  			</thead>
  			<tbody>
  			</tbody>
  		</table>
  	</div>
  </div>
</div>