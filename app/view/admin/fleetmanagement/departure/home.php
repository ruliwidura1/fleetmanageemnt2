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
        <li>Departure</li>
    </ul>
    <!-- END Static Layout Header -->

    <!-- Content -->
    <div class="block full">
        <div class="block-title">
            <h2><strong>Data Departure</strong></h2>
        </div>
        <div class="row row-filter">
            <div class="col-md-3">
                <label>&nbsp;</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input id="fl_sdate" type="text" class="form-control input-datepicker" placeholder="dari tgl" data-date-format="yyyy-mm-dd" value="<?= date('Y-m-') . '01' ?>" />
                </div>
            </div>
            <div class="col-md-3">
                <label>&nbsp;</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input id="fl_edate" type="text" class="form-control input-datepicker" placeholder="s.d tgl" data-date-format="yyyy-mm-dd" value="<?= date('Y-m-t') ?>" />
                </div>
            </div>
            <div class="col-md-4">
                <label for="fl_is_departure">Status</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-podcast"></i>
                    </div>
                    <select id="fl_is_departure" class="form-control">
                        <option value="">-- Semua --</option>
                        <option value="0">Perjalanan</option>
                        <option value="1">Selesai</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <label>&nbsp;</label>
                <button id="fl_button" class="btn btn-default btn-block btn-submit"><i class="fa fa-filter icon-submit"></i></button>
            </div>
        </div>
        <div class="table-responsive">
            <table id="drTable" class="table table-vcenter table-condensed table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Tanggal Keberangkatan</th>
                        <th>Driver</th>
                        <th>Kendaraan</th>
                        <th>Jam Keluar</th>
                        <th>Jumlah Tujuan</th>
                        <th>Area Tujuan</th>
                        <th>Status Keberangkatan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>