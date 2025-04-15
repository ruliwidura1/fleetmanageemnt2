<?php
	$admin_name = $sess->admin->username ?? '';
	if(isset($sess->admin->nama)) if(strlen($sess->admin->nama)>1) $admin_name = $sess->admin->nama;
	if(!isset($this->current_page)) $this->current_page = "";
	if(!isset($this->current_parent)) $this->current_parent = "";
	$current_page = $this->current_page;
	$current_parent = $this->current_parent;
	$parent = array();
	foreach(($sess->admin->menus->left ?? []) as $key=>$v){
		$parent[$v->identifier] = 0;
		if(count($v->childs)>0){
			foreach($v->childs as $f){
				if($current_page==$f->identifier){
					$current_page = $v->identifier;
					$parent[$v->identifier] = 1;
				}
			}
		}
	}
	$admin_foto = '';
	if(isset($sess->admin->foto))$admin_foto = $sess->admin->foto;
	if(empty($admin_foto)) $admin_foto = 'media/user-default.png';
	$admin_foto = $this->cdn_url($admin_foto);
    $admin_logo_url = '';
    if (isset($this->config->semevar->admin_logo) && strlen($this->config->semevar->admin_logo) > 4) {
        $admin_logo_url = $this->cdn_url($this->config->semevar->admin_logo);
    }
?>
<div id="sidebar">
	<!-- Wrapper for scrolling functionality -->
	<div id="sidebar-scroll">
		<!-- Sidebar Content -->
		<div class="sidebar-content">
			<!-- Brand -->
			<a href="<?=base_url_admin(); ?>" class="sidebar-brand">
				<img src="<?=$admin_logo_url?>" onerror="this.onerror=null;this.src='';" style="width: 90%;" />
			</a>
			<!-- END Brand -->
			<!-- User Info -->
			<div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
				<div class="sidebar-user-avatar">
					<a href="<?=base_url_admin('profil'); ?>">
						<img src="<?=$admin_foto?>" alt="avatar" onerror="this.onerror=null;this.src='https://seme-framework-storage.b-cdn.net/images/user-default.png';" />
					</a>
				</div>
				<div class="sidebar-user-name"><?=$admin_name; ?></div>
				<div class="sidebar-user-links">
					<a href="<?=base_url_admin('profil'); ?>" data-toggle="tooltip" data-placement="bottom" title="Profile"><i class="gi gi-user"></i></a>
					<a href="<?=base_url_admin("logout"); ?>" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="gi gi-exit"></i></a>
				</div>
			</div>
			<!-- END User Info -->
			<!-- Sidebar Navigation -->
			<ul class="sidebar-nav">
				<li class="">
					<a href="<?=base_url_admin('')?>" class=" ">
						<i class=" sidebar-nav-mini-hide"></i>
						<i class="fa fa-home sidebar-nav-icon"></i>
						<span class="sidebar-nav-mini-hide">Dashboard</span>
					</a>
				</li>
				<li class="">
					<a href="#" class="sidebar-nav-menu ">
						<i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
						<i class="fa fa-cog fa-spin sidebar-nav-icon"></i>
						<span class="sidebar-nav-mini-hide">Perusahaan</span>
					</a>
					<ul class="">
						<li>
							<a href="<?=base_url_admin('perusahaan/master/')?>" class="">
								Data Master Perusahaan
							</a>
						</li>
					</ul>
				</li>
			</ul>
			<!-- END Sidebar Navigation -->
		</div>
		<!-- END Sidebar Content -->
	</div>
	<!-- END Wrapper for scrolling functionality -->
</div>