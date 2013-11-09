
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="mvccc,church, mountain view, 山景城中國基督教會, 教會">

    <title>MVCCC Login</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container">
      <form class="form-signin">
        <h2 class="form-signin-heading">請登錄</h2>
        <input type="text" class="form-control" placeholder="郵件地址" required autofocus>
        <input type="password" class="form-control" placeholder="密碼" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> 記住我
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">登錄</button>
      </form>
    </div> <!-- /container -->
  </body>
</html>

