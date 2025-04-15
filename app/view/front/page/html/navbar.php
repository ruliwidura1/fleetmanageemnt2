<nav>
  <div class="nav-wrapper">
    <a href="#" class="brand-logo">Logo</a>
    <a href="#" data-target="mobile-demo" class="sidenav-trigger">
      <i class="material-icons">menu</i>
    </a>
    <ul class="right hide-on-med-and-down">
      <li><a href="<?=base_url()?>">Homepage</a></li>
      <?php if(isset($sess->user->id)){ ?>
      <li><a href="<?=base_url('logout')?>">Logout</a></li>
      <?php } else { ?>
      <li><a href="<?=base_url('login')?>">Login</a></li>
      <li><a href="<?=base_url('register')?>">Register</a></li>
      <?php } ?>
    </ul>
  </div>
</nav>

<ul class="sidenav" id="mobile-demo">
  <li><a href="<?=base_url()?>">Homepage</a></li>
  <?php if(isset($sess->user->id)){ ?>
  <li><a href="<?=base_url('logout')?>">Logout</a></li>
  <?php } else { ?>
  <li><a href="<?=base_url('login')?>">Login</a></li>
  <li><a href="<?=base_url('register')?>">Register</a></li>
  <?php } ?>
</ul>