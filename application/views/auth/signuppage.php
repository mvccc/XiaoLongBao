<form id="signUpForm" class="form-signin" method="post" accept-charset="utf-8" action="<?php echo site_url().'/auth/doLogin/'.$lang?>" />
  <h2 class="form-signin-heading"><?php echo $this->lang->line('auth_sign_up') ?></h2>
  <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('auth_first_name')?>" required autofocus>
  <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('auth_last_name')?>" required autofocus>
  <input type="text" class="form-control" placeholder="<?php echo $this->lang->line('auth_email')?>" required autofocus>
  <p>
    <div>
      <button type="button" class="btn btn-default"><?php echo $this->lang->line('auth_male') ?></button>
      <button type="button" class="btn btn-default"><?php echo $this->lang->line('auth_female') ?></button>
    </div>
  </p>
  <input type="password" class="form-control" placeholder="<?php echo $this->lang->line('auth_password')?>" required autofocus>
  <input type="password" class="form-control" placeholder="<?php echo $this->lang->line('auth_confirm_password')?>" required autofocus>
  <button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo $this->lang->line('auth_create_account') ?></button>
</form>
