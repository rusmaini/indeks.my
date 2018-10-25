<?php $this->load->view('template/header'); ?>
<!--?php $this->load->view('template/menu'); ?-->
<!--?php $this->load->view('template_admin/masthead'); ?-->
<div class="container">
  	 <div class="row">
  	 	<!-- main -->
  	 	<div class="col-sm-12 blog-main">
  	 		<div style="margin: 20px 0">
  	 			<?php $this->load->view($content); ?>
  	 		</div>
  	 	</div>
  	 </div>
  	 <hr />
	<div class="footer">
      <p class="pull-right">
        <a href="#">Back to top</a>
      </p>
      <p>
      	Powered by: <?=anchor_popup('http://rusmaini.com/blog/category/crock-cms/','CrockCMS')?>
      	
      </p>
		
      <br />
      <br />
    </div>
</div>
<?php $this->load->view('template/footer'); ?>