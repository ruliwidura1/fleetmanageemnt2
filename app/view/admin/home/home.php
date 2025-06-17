<div id="page-content">
	<!-- Dashboard 2 Header -->
	<div class="content-header content-header-media">
		<div class="header-section">
			<div class="row">
				<!-- Main Title (hidden on small devices for the statistics to fit) -->
				<div class="col-md-4 col-lg-6 hidden-xs hidden-sm">
					<h1>
						Halo <strong><?= $sess->admin->nama; ?></strong>
					</h1>
				</div>
				<!-- END Main Title -->

				<!-- Top Stats -->
				<div class="col-md-8 col-lg-6">
					<div class="row text-center">

						<div class="col-xs-12 col-sm-12">
							<h2 class="animation-hatch">
								<?= $this->tgl->convert('now', 'hari_tanggal') ?><br>
								<small><i class="fa fa-clock-o"></i> <span id="waktu_jam">00</span>:<span id="waktu_menit">00</span>:<span id="waktu_detik">00</span></small>
							</h2>
						</div>

					</div>
				</div>
				<!-- END Top Stats -->
			</div>
		</div>
		<!-- For best results use an image with a resolution of 2560x248 pixels (You can also use a blurred image with ratio 10:1 - eg: 1000x100 pixels - it will adjust and look great!) -->
		<img src="<?=base_url()?>skin/admin/img/placeholders/headers/dashboard_header.png" alt="header image" class="animation-pulseSlow">
	</div>
	<div class="row">
		<div class="col-sm-6 col-md-4">
			<!-- Widget -->
			<div class="widget">
				<div class="widget-simple">
					<a href="javascript:void(0)" class="widget-icon pull-left animation-fadeIn themed-background">
						<i class="gi gi-film"></i>
					</a>
					<h4 class="widget-content text-right animation-hatch">
						<a href="javascript:void(0)">+99 <strong>Digunakan</strong></a>
					</h4>
				</div>
			</div>
			<!-- END Widget -->
		</div>
		<div class="col-sm-6 col-md-4">
			<!-- Widget -->
			<div class="widget">
				<div class="widget-simple themed-background-dark">
					<a href="javascript:void(0)" class="widget-icon pull-left animation-fadeIn themed-background">
						<i class="gi gi-picture"></i>
					</a>
					<h4 class="widget-content widget-content-light text-right animation-hatch">
						<a href="javascript:void(0)">+99 <strong>Di Perbaiki</strong></a>
					</h4>
				</div>
			</div>
			<!-- END Widget -->
		</div>
		<div class="col-sm-6 col-md-4">
			<!-- Widget -->
			<div class="widget">
				<div class="widget-simple">
					<a href="javascript:void(0)" class="widget-icon pull-left animation-fadeIn themed-background-fire">
						<i class="gi gi-picture"></i>
					</a>
					<h4 class="widget-content text-right animation-hatch">
						<a href="javascript:void(0)">+99 <strong>Ready</strong></a>
					</h4>
				</div>
			</div>
			<!-- END Widget -->
		</div>



	</div>
</div>
<!-- END Dashboard 2 Header -->
