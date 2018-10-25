
<div class="row">
	<div class="col-sm-12">
		<p>
			<?=anchor($this->session->userdata('username'),'Paparan Umum',array('target'=>'_blank'))?>
			 | 
			<?=anchor('biodata/edit','Edit Biodata')?>
			
		</p>
		<hr />
	</div>
</div>

<?php $this->load->view('profile/profile')?>