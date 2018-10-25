<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?=$slogan?>">
    <meta name="author" content="rusmaini">
    <link rel="shortcut icon" href="<?=base_url()?>assets/ico/favicon.ico">

    <title><?=(isset($title_page))? $title_page.' &mdash; ':''; ?> <?=$title?> </title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>assets/<?=$theme?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=base_url()?>assets/bootstrap/css/navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?=base_url()?>assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
    <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
	<script src="<?=base_url()?>assets/ui/js/jquery-ui.js"></script>
	<script src="<?=base_url()?>assets/ui/js/jquery-ui-timepicker.js"></script>
	<link rel="stylesheet" href="<?=base_url()?>assets/ui/css/jquery-ui.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/ui/css/ui-timepicker.css">
	
	<!-- Custom styles for this template Edisi MAINI -->
    <link href="<?=base_url()?>assets/my/css/style.css" rel="stylesheet">

	<script src="<?=base_url()?>assets/nicedit/nicEdit.js" type="text/javascript"></script>
	

	<!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">-->
	<!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
	<!--<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>-->
	
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  
  </head>

  <body>
	<?php
	$active = '';
	$uri1 = $this->uri->segment(1,'');
	$uri2 = $this->uri->segment(2,'');
	?>
	<!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
           <?=anchor('',$title,array("class"=>'navbar-brand'))?>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
           	<li <?=(($uri1=='direktori' && $uri2=='') || ($uri1=='direktori' && $uri2=='index'))? 'class="active"':''?>><?=anchor('direktori','Direktori')?></li>
           	<li <?=(($uri1=='kerja' && $uri2=='') || ($uri1=='kerja' && $uri2=='index'))? 'class="active"':''?>><?=anchor('kerja','Jawatan Kosong')?></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          	<!-- Logged in user : START -->
          	<?php if($this->session->userdata('logged_in') && $this->session->userdata('group_id')==1): ?>
            <!-- Admin untuk modul direktori -->
            <li class="dropdown">
            	<?php
				//$list_admin = array('permission','user','group','module','setting');
				?>
					
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><?=anchor('home/informasi','Informasi')?></li>
                <li class="divider"></li>
                <li class="dropdown-header">Direktori</li>
                <li <?=($uri1=='direktori' && ($uri2=='urus' || $uri2=='urus_edit'))? 'class="active"':''?>><?=anchor('direktori/urus','Urus Direktori')?></li>
           
                <li class="divider"></li>
                <li class="dropdown-header">Pengguna</li>
				<li><?=anchor('permission','Had Capaian')?></li>
				<li><?=anchor('user','Pengguna')?></li>
				<li><?=anchor('group','Kumpulan Pengguna')?></li>
				<li><?=anchor('module','Modul')?></li>
                <li class="divider"></li>
				<li><?=anchor('setting','Seting')?></li>
              </ul>
            </li>
       		<?php endif; ?>
          	<?php if($this->session->userdata('logged_in')): ?>
             	<li <?=($uri1=='kerja' && ($uri2=='my' || $uri2=='my_edit'))? 'class="active"':''?>><?=anchor('kerja/my','My Perjawatan')?></li>
             	<li <?=($uri1=='direktori' && ($uri2=='my' || $uri2=='my_edit'))? 'class="active"':''?>><?=anchor('direktori/my','My Direktori')?></li>
	          	<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">My Biodata <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><?=anchor('biodata/','Papar')?></li>
						<li><?=anchor('biodata/edit','Edit')?></li>
					</ul>
				</li>
	          	<li <?=($uri1=='profile')? 'class="active"':''?>><?=anchor('profile','Akaun ['.$this->session->userdata('username').']')?></li>
	          	<li <?=($uri1=='auth')? 'class="active"':''?>><?=anchor('auth/logout','Log keluar')?></li>
          	<?php else: ?>
	          	<li <?=($uri1=='auth')? 'class="active"':''?>><?=anchor('auth/login','Log masuk')?></li>
	          	<li <?=($uri1=='register')? 'class="active"':''?>><?=anchor('register','Daftar')?></li>
          	<?php endif; ?>
			<!-- Logged in user : END -->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    
    
