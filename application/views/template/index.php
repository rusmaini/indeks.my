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
      	<iframe width="100%" height="20" scrolling="no" frameborder="0" marginheight="5" marginwidth="0" src="https://wapps.uthm.edu.my/my/crockcms/hit/counter/perjawatan"></iframe>
      </p>
		
      <br />
      <br />
    </div>
</div>
<?php $this->load->view('template/footer'); ?>