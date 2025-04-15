<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar" aria-expanded="true" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div id="navbar" class="collapse navbar-collapse" >
      <ul class="nav navbar-nav">
        <li class="active">
          <a href="#" class="btn-sidebar-toggle"><i class="fa fa-list"></i></a>
        </li>
      </ul>
      <form id="form_module_search" action="<?=base_url_admin("modules")?>" method="get" class="navbar-form navbar-left">
        <div class="form-group">
          <input id="fmsfilter" name="filter" type="text" class="form-control" placeholder="Cari Modul" minlength="0" />
        </div>
        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="fa fa-bell-o"></i> Pemberitahuan <label class="label label-info">0</label></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?=$sess->admin->nama?>  <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?=base_url_admin("profil")?>" title="Lihat profil saya">Profil</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?=base_url_admin("logout")?>" title="Keluar dari <?=$this->site_name_admin?>">Logout</a></li>
          </ul>
        </li>
        <li><a id="btn-header-show" href="#" ><i class="fa fa-ravelry"></i></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>