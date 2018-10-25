<?php $this->load->view('template/header'); ?>
<!--?php $this->load->view('template/menu'); ?-->
<!--?php $this->load->view('template_admin/masthead'); ?-->
<div class="container">
  	 <div class="row">
  	 	<!-- main -->
  	 	<div class="col-sm-8 blog-main">
		  	 		
			<div class="blog-header">
				<h1 class="blog-title"><?=$title?></h1>
				<p class="lead blog-description"><?=$slogan?></p>
			</div>
  	 		<div class="blog-post">
  	 			<?php $this->load->view($content); ?>
  	 		</div>
  	 	</div>
  	 	<!-- sidebar -->
  	 	<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
  	 		<?php $this->load->view('template/menu'); ?>
  	 	</div>
  	 </div>
	
</div>
<?php $this->load->view('template/footer'); ?>