<h3>My Direktori &mdash; Senarai Item</h3>
<?php if(isset($cari)):?>
<p>Hasil carian <strong><?=$cari?></strong></p>
<?php endif; ?>

<?= $this->session->flashdata('notis_upload');?>
<?= $this->session->flashdata('notis');?>
<div class="pull-right">
	<?=anchor('direktori/my_edit/0','<span class="glyphicon glyphicon-plus"></span> Tambah Item',array('class'=>'btn btn-primary btn-sm'))?>
</div>
<?php $this->load->view('direktori/my_senarai_skema'); ?>
<?=$links?>

<hr />
<a href="javascript:window.history.back();" class="btn btn-default">&larr; Kembali</a>