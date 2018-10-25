<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?=$slogan?>">
    <meta name="author" content="rusmaini">
    <link rel="shortcut icon" href="<?=base_url()?>assets/ico/favicon.ico">

    <title><?=$title?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=base_url()?>assets/css/blog.css" rel="stylesheet">
	
	<style>
	
	
	@media print {
		p#cetak {
			display: none;
		}
		p.cetak {
			display: none;
		}
		
		a[href]:after {
		    /*content: " (" attr(href) ")";*/
		    content: "";
		  }
		.page-break	{ display: block; page-break-before: always; }
	}
	
	table {page-break-after:auto}
	</style>
	
  </head>

  <body>
	<div class="container">
	  	 <div class="row">
	  	 	<!-- main -->
	  	 	<div class="col-sm-12 blog-main">
	  	 		<div style="margin: 20px 0">
	  	 			
	  	 			<p id="cetak">
						<a href="javascript:window.print();" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-print"></span> Cetak</a> 
						<a href="javascript:window.close();" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-remove"></span> Tutup</a>
					</p>
					
	  	 			<?php $this->load->view($content); ?>
	  	 		</div>
	  	 	</div>
	  	 </div>
	</div>

  </body>
</html>
