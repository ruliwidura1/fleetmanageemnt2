<style>
.panel {
	padding: 0 1em;
}
.panel h1, .panel h4, .panel p {
	text-align: right;
}
.panel h1 {
	font-size: 2em;
	font-weight: bold;
}
.panel h4 {
	font-size: 1.2em;
	font-weight: 100;
}
.panel p {
	font-size: 0.8em;
	line-height: 1;
	font-style: italic;
}
.panel.panel-success {
	background-color: #d6e9c6;
}
.panel.panel-info {
	background-color: #bce8f1;
}
.panel.panel-warning {
	background-color: #faebcc;
}
.panel.panel-danger {
	background-color: #ebccd1;
}
.panel.panel-default {
	background-color: #dddddd;
}
</style>
<div id="page-content">
	<!-- Static Layout Header -->
	<ul class="breadcrumb breadcrumb-top">
		<li>Admin</li>
		<li>Laporan</li>
		<li>Pengiriman</li>
	</ul>
	<!-- END Static Layout Header -->

	<!-- Content -->
	<div class="block full">
		<div class="block-title">
			<h2><strong>Laporan Pengiriman Barang</strong></h2>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-muted" style="margin-bottom: 0px;">
					<div class="form-group">
						<div class="col-md-4">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input id="fl_mindate" type="text" class="form-control input-datepicker" data-date-format="yyyy-mm-dd" placeholder="Mulai Tgl" value="<?=date("Y-m-",strtotime("-1 month"))?>26" />
							</div>
						</div>
						<div class="col-md-4">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input id="fl_maxdate" type="text" class="form-control input-datepicker" data-date-format="yyyy-mm-dd" placeholder="Sampai Tgl" value="<?=date("Y-m-")?>25" />
							</div>
						</div>
						<div class="col-md-4">
							<div class="btn-group pull-right">
								<button id="btn_dlxls" type="button" class="btn btn-success btn-submit"> <i class="fa fa-download"></i> XLS <i class="icon-submit fa"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>