<!DOCTYPE html>
<html lang="zh">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="mvccc,church, mountain view, 山景城中國基督教會, 教會">

    <title>MVCCC</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <!-- use below for release version -->
    <!-- link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" -->

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/mvccc.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-static-top mvccc-nav " role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">山景城中國基督教會</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?php echo site_url(); ?>/pages/index">教會首頁</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">教會介紹<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url(); ?>/pages/church/introduction">教會簡介</a></li>
                <li><a href="<?php echo site_url(); ?>/pages/church/bylaw">教會會章</a></li>
                <li><a href="<?php echo site_url(); ?>/pages/pastors">教牧同工</a></li>
                <li><a href="<?php echo site_url(); ?>/pages/church/schedule">聚會時間</a></li>
                <li><a href="<?php echo site_url(); ?>/pages/calendar">日歷事件</a></li>
                <li><a href="#">事工部門</a></li>
                <li><a href="<?php echo site_url(); ?>/pages/church/history">教會歷史</a></li>
                <li><a href="#">地址電話</a></li>
              </ul>
            </li>
            <li><a href="<?php echo site_url(); ?>/pages/worship">主日崇拜</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">教會生活<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url(); ?>/pages/fellowships">團契生活</a></li>
                <li><a href="<?php echo site_url(); ?>/pages/activities/sundaySchoolAdults">主日學</a></li>
                <li><a href="<?php echo site_url(); ?>/pages/activities/choir">詩班</a></li>
                <li><a href="#">信仰討論</a></li>
                <li><a href="#">AWANA</a></li>
              </ul>
            </li>
            <li><a href="<?php echo site_url(); ?>/pages/prayer">代禱贊美</a></li>
            <li><a href="<?php echo site_url(); ?>/pages/missions">差傳事工</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">資源中心<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">重要鏈接</a></li>
                <li><a href="#">照片集錦</a></li>
                <li><a href="#">錄音錄像</a></li>
              </ul>
            </li>

            <?php
              $logged_in = $this->session->userdata('logged_in');
              if(isset($logged_in) && $logged_in == TRUE)
              {
                $url = site_url() . '/auth/doLogout/ch';
                printf("<li><a href=\"%s\">會員注銷</a></li>", $url);
              }
              else
              {
                $url = site_url() . '/auth/login';
                printf("<li><a href=\"%s\">會員登錄</a></li>", $url);
              }
            ?>

            <li><a href="<?php echo site_url(); ?>/pages/index/en">English</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->

    <div class="container">
