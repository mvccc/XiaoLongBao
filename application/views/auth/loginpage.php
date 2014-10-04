<div class="container">
  <div class="well well-half">
    <form class="form-signin" method="post" action="<?php echo site_url().'/auth/loginForm/'.$lang?>">
      <h2 class="form-signin-heading"><?php echo $this->lang->line('auth_title_sign_in') ?></h2>
      <div class="form-group has-error">
        <label class="help-block"><?php if (isset($_REQUEST['login_error'])) {echo $_REQUEST['login_error'];}?></label>
      </div>

      <!-- sign in -->
      <div class="form-group">
        <div class="form-group has-error">
        <label class="help-block">
          <?php echo form_error('username'); ?>
          <?php echo form_error('password'); ?>
        </label>
        </div>
        <input type="text" name="username" class="form-control" value="<?php echo set_value('username');?>" placeholder="<?php echo $this->lang->line('auth_email')?>" autofocus>
        <input type="password" name="password" class="form-control" value="<?php echo set_value('password');?>" placeholder="<?php echo $this->lang->line('auth_password')?>" >
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
</div>