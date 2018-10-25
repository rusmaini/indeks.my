
<h3><?=$title_page?></h3>
<hr />
<?= $this->session->flashdata('notis');?>
<div class="pull-right">
	<?=anchor('kerja/my_syarikat/','<span class="glyphicon glyphicon-pencil"></span> Maklumat Majikan',array('class'=>'btn btn-default btn-sm'))?>
	<?=anchor('kerja/my_edit/0','<span class="glyphicon glyphicon-plus"></span> Tambah Perjawatan',array('class'=>'btn btn-danger btn-sm'))?>
</div>
<?php $this->load->view('kerja/my_senarai_skema'); ?>
<?=$links?>