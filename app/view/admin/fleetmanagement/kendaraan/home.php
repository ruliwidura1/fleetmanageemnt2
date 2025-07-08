<style>
    .nm {
        margin: 0;
    }

    .bl {
        font-size: 1.3em;
        font-weight: bolder;
    }

    .sml {
        font-size: 1em;
        font-weight: 100;
    }

    .panel {
        padding: 0 1em;
    }

    .panel h1,
    .panel h4 {
        text-align: right;
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
</style>
<div id="page-content">
    <!-- Static Layout Header -->
    <div class="content-header">
        <div class="row">
            <div class="col-md-6">&nbsp;</div>
            <div class="col-md-6">
                <div class="btn-group pull-right">
                    <button id="btn_dlxls" type="button" class="btn btn-warning btn-submit"> <i class="fa fa-download"></i> Download XLS <i class="icon-submit fa"></i></button>
                    <a id="" href="<?= base_url_admin('fleetmanagement/kendaraan/baru/') ?>" class="btn btn-info"><i class="fa fa-plus"></i> Baru</a>
                </div>
            </div>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Admin</li>
        <li>Fleet Management</li>
        <li>Kendaraan</li>
    </ul>
    <!-- END Static Layout Header -->

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-info">
                <h1 id="kendaraan_tersedia">0</h1>
                <h4>Tersedia</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-success">
                <h1 id="kendaraan_digunakan">0</h1>
                <h4>Digunakan</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-warning">
                <h1 id="kendaraan_diperbaiki">0</h1>
                <h4>Diperbaiki</h4>
            </div>
        </div>
    </div>

    <div class="block full">
        <div class="row">
            <div class="col-md-4">
                <label for="fl_is_active">Tipe Kendaraan</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-tags"></i></span>
                    <select id="fl_is_active" class="form-control input-select2">
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
            <div class="col-md-2">
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
            <h4><strong>Data Kendaraan</strong></h4>
        </div>
        <div class="table-responsive">
            <table id="drTable" class="table table-vcenter table-condensed table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Nama Kendaraan</th>
                        <th>Tipe</th>
                        <th>Plat Nomor</th>
                        <th>Merk</th>
                        <th>Warna</th>
                        <th>Kapasitas Mesin (CC)</th>
                        <th>Kapasitas Angkutan (KG)</th>
                        <th>Ketersediaan</th>
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