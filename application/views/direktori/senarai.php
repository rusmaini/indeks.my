
<?php $this->load->view('iklan_header'); ?>
<?= $this->session->flashdata('notis');?>
<div class="well well-sm">
<?php $this->load->view('direktori/carian'); ?>
</div>

<h3><?= (isset($negeri_display))? 'Senarai item di '.$negeri_display : 'Senarai semua item';?></h3>

<?php if(isset($cari)):?>
<p>Menemui <strong><?=$jumlah_carian?></strong> rekod hasil carian <strong><?=$cari?></strong></p>
<?php endif; ?>

<?php $this->load->view('direktori/senarai_skema'); ?>
<?=$links?>

<hr />
<a href="javascript:window.history.back();" class="btn btn-default">&larr; Kembali</a>