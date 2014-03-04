<!-- form id="loginForm" class="form-signin" method="post" accept-charset="utf-8" action="<?php echo site_url().'/auth/doLogin/'.$lang?>" >
  <h2 class="form-signin-heading"><?php echo $this->lang->line('auth_title_sign_in') ?></h2>
  <input type="text" name="username" class="form-control" placeholder="<?php echo $this->lang->line('auth_email')?>" required autofocus>
  <input type="password" name="password" class="form-control" placeholder="<?php echo $this->lang->line('auth_password')?>" required>
  <label class="checkbox">
    <input type="checkbox" value="remember-me"> <?php echo $this->lang->line('auth_remember_me') ?>
  </label>
  <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $this->lang->line('auth_sign_in') ?></button>
  <p><?php echo $this->lang->line('auth_sign_up_mesg')?></p>
  <a href="<?php echo base_url().'index.php/auth/signup/'.$lang; ?>" class="btn btn-primary btn-lg btn-block" role="button"><?php echo $this->lang->line('auth_sign_up') ?></a>
</form-->

<div class="well well-half">
  <form class="form-signin" method="post" action="<?php echo site_url().'/auth/doLogin/'.$lang?>">
    <h2 class="form-signin-heading"><?php echo $this->lang->line('auth_title_sign_in') ?></h2>
    <div class="form-group has-error">
      <label class="help-block"><?php echo $this->session->flashdata('dologin_error')?></label>
    </div>

    <!-- sign in -->
    <div class="form-group">
      <input type="text" name="username" class="form-control" placeholder="<?php echo $this->lang->line('auth_email')?>" required autofocus>
      <input type="password" name="password" class="form-control" placeholder="<?php echo $this->lang->line('auth_password')?>" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo $this->lang->line('auth_sign_in') ?></button>
    </div>
    <br>
    
    <!-- sign up link -->
    <div class="form-group">
      <p><?php echo $this->lang->line('auth_sign_up_mesg')?></p>
      <a href="<?php echo base_url().'index.php/auth/signup/'.$lang; ?>" class="btn btn-primary btn-lg btn-block" role="button"><?php echo $this->lang->line('auth_sign_up') ?></a>
    </div>
  </form>
</div>