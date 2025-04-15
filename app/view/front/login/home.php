<main class="login">
  <div class="container">
    <div class="row">
      <div class="col m6 offset-m3 s12">
        <div class="bungkus">
          <h1>Login</h1>
          <form id="flogin" action="<?=base_url()?>login/proses" method="post">

          <?php if(isset($sess->flash) && strlen($sess->flash)>0){ ?>
          <div class="row">
            <!-- Message Notification -->
            <div class="col s12 red darken-2">
              <p class="white-text"><b>Alert:</b> <?=$sess->flash?></p>
            </div>
          </div>
          <?php } ?>

            <div class="row">
              <div class="input-field col s12">
                <input class="validate" id="iemail" type="email" name="email" placeholder="Email" autocomplete="" required />
                <label for="iemail">Email *</label>
              </div>
            </div>
            <div class="row">
              <div class="input-field col s12">
                <input class="validate" id="ipassword" type="password" name="password" placeholder="Password" autocomplete="" required />
                <label for="ipassword">Password *</label>
              </div>

              <div class="col s12">
                <div class="mb-3 right-align">
                  <a href="<?=base_url()?>lupa" class="lupa">Lupa Password</a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col s12">
                <div class="center-align">
                  <button class="btn waves-effect waves-light" type="submit" name="action" style="width: 100%;">
                    Login <i class="material-icons right">send</i>
                  </button>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col s12">
                <div class="d-grid gap-2 center-align">
                  atau
                  <a href="<?=base_url()?>register" class="daftar">Daftar</a>
                </div>
              </div>
            </div>

          </div>

        </form>
      </div>

    </div>
  </div>
</main>