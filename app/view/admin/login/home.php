<!-- Login Full Background -->
<!-- For best results use an image with a resolution of 1280x1280 pixels (prefer a blurred image for smaller file size) -->
<img src="https://seme-framework-storage.b-cdn.net/images/background-login-3.jpg" alt="Login Full Background" class="full-bg animation-pulseSlow">
<!-- END Login Full Background -->

<!-- Login Container -->
<div id="login-container" class="animation-fadeIn">
    <!-- Login Title -->
    <div class="login-title text-center">
        <img src="https://seme-framework-storage.b-cdn.net/images/seme-framework-logo.png" class="img-responsive" />
    </div>
    <!-- END Login Title -->

    <!-- Login Block -->
    <div class="block push-bit">
        <div id="flogin_info" class="alert alert-info" role="alert" style="<?php if(!isset($login_message)) echo 'display:none'; ?>"><?php if(isset($login_message)) echo $login_message; ?></div>
        <!-- Login Form -->
        <form action="<?=base_url_admin("login/authentication/"); ?>" method="post" id="form-login" class="form-horizontal form-bordered form-control-borderless">
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-user"></i></span>
                        <input type="text" id="iusername" name="username" class="form-control input-lg" placeholder="Username" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                        <input type="password" id="ipassword" name="password" class="form-control input-lg" placeholder="Password">
                        <input type="hidden" id="ireff" name="reff" value="<?=$reff ?? ''?>" />
                    </div>
                </div>
            </div>
            <div class="form-group form-actions">
                <div class="col-xs-6">
                    <?=$this->config_semevar('admin_site_title')?> <label class="" style="color: grey; font-weight: lighter; font-size: smaller;">version <?=$this->config_semevar('site_version')?></label>
                </div>
                <div class="col-xs-6 text-right">
                    <button type="submit" class="btn btn-sm btn-primary btn-submit">Login <i id="icon-submit" class="fa fa-angle-right"></i></button>
                </div>
            </div>
        </form>
        <!-- END Login Form -->
    </div>
    <!-- END Login Block -->
</div>
<!-- END Login Container -->