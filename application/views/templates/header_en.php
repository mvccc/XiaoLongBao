<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="mvccc,church, mountain view, 山景城中國基督教會, 教會">

    <title>MVCCC ENGLISH</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <!-- use below for release version -->
    <!-- link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" -->

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/mvccc.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/datepicker.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="top">
        <div class="container">         
            <ul class="loginbar pull-right">  
                <?php
                  $logged_in = $this->session->userdata('logged_in');
                  if(isset($logged_in) && $logged_in == TRUE)
                  {
                    $url = site_url() . '/auth/doLogout/en';
                    printf("<li><a href=\"%s\">Logout</a></li>", $url);
                  }
                  else
                  {
                    $url = site_url() . '/auth/login/loginpage/en';
                    printf("<li><a href=\"%s\">Login</a></li>", $url);
                  }
                ?>  
                <li class="devider"></li>   
                <li><a href="<?php echo site_url(); ?>/pages/index/ch">中文網站</a></li>   
            </ul>
        </div>      
    </div>

    <div class="navbar navbar-inverse navbar-static-top mvccc-navbar" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand mvccc-brand" href="#">MVCCC</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right mvccc-nav">
            <li class="active"><a href="<?php echo site_url(); ?>/pages/index/en">Home</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Church<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url(); ?>/pages/church/introduction/en">Introduction</a></li>
                <li><a href="<?php echo site_url(); ?>/pages/church/faith-statement/en">Faith Statement</a></li>
                <li><a href="<?php echo site_url(); ?>/pages/pastors/en">Our Staff</a></li>
                <li><a href="#">Schedule</a></li>
                <li><a href="#">Departments</a></li>
                <li><a href="#">Church History</a></li>
                <li><a href="#">Contact Us</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Worship<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Sermon Videos</a></li>
                <li><a href="#">Service Times</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Activities<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url(); ?>/pages/fellowship/sister/en">Fellowships</a></li>
                <li><a href="<?php echo site_url(); ?>/pages/activities/sundaySchoolAdults/en">Sunday Schools</a></li>
                <li><a href="#">Choir</a></li>
                <!--<li><a href="#">信仰討論</a></li>
                <li><a href="#">禱告會</a></li>
                <li><a href="#">預查</a></li> -->
                <li><a href="#">AWANA</a></li>
              </ul>
            </li>
            <li><a href="<?php echo site_url(); ?>/events/eventList/en">Events</a></li>
            <li><a href="#">Prayer Requests</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Resources<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url(); ?>/pages/resources/links/en">Links</a></li>
                <li><a href="#">Photos</a></li>
                <li><a href="#">Videos</a></li>
              </ul>
            </li>
            <?php
              $logged_in = $this->session->userdata('logged_in');
              if(isset($logged_in) && $logged_in == TRUE)
              {
                printf('<li class="dropdown">');
                printf('<a href="#" class="dropdown-toggle" data-toggle="dropdown">Member<b class="caret"></b></a>');
                printf('<ul class="dropdown-menu">');
                printf('<li><a href="%s">Missionary</a></li>', site_url()."/pages/missions/en");
                printf('</ul>');
                printf('</li>');
              } 
            ?>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->

    <div class="container">