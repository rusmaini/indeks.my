
<?php $this->load->view('iklan_header'); ?>

<h3>Senarai Jawatan Kosong</h3>
<hr />

<?= $this->session->flashdata('notis');?>
<div class="row">

	<div class="col-sm-12">
		<p class="pull-right"><?=anchor('kerja/index','Papar semua',array('class'=>'btn btn-primary'))?></p>
		<?php $this->load->view('kerja/senarai_skema'); ?>
		<?=$links?>
		<br />
		<?php $this->load->view('iklan_teks'); ?>	
	</div>
</div>

