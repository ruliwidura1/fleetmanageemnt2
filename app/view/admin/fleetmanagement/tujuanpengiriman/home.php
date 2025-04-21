<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-6">&nbsp;</div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <a id="" href="<?= base_url_admin('fleetmanagement/tujuanpengiriman/baru/') ?>" class="btn btn-info"><i class="fa fa-plus"></i> Baru</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li>Tujuan Pengiriman</li>
    </ul>
    <!-- END Static Layout Header -->

    <!-- Content -->
    <div class="block full">
        <div class="block-title">
            <h4><strong>Data Muatan</strong></h4>
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
                <label for="fl_is_delivered">Status</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-podcast"></i>
                    </div>
                    <select id="fl_is_delivered" class="form-control">
                        <option value="">-- Semua --</option>
                        <option value="1">Diterima</option>
                        <option value="0">Dikirim</option>
                        <option value="2">Batal</option>
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
                        <th>Tanggal Pengiriman</th>
                        <th>SKU</th>
                        <th>Barang</th>
                        <th>Tujuan</th>
                        <th>Kab/Kota</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>
    <!-- END Content -->
</div>
