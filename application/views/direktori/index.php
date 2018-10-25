<h3>Direktori</h3>
<hr />
<?= $this->session->flashdata('notis');?>

<div class="row">
	<div class="col-sm-2">
		
		<ul class="nav">
		<?php
		foreach ($negeri_tepi as $row) {
			?>
			<li><?=anchor('direktori/n/'.$row['id'].'-'.$row['nama'],$row['nama']);?></li>
			<?php
		}
		?>
		</ul>
	</div>
	<div class="col-sm-10">
		<div class="row">
			<?php $this->load->view('iklan_header'); ?>
			<div class="col-sm-12"><?php $this->load->view('direktori/carian'); ?></div>
		</div>
		
		<hr />
		<p class="pull-right"><?=anchor('direktori/senarai','Papar semua',array('class'=>'btn btn-primary'))?></p>
		<h4>Senarai Terkini</h4>
		<?php $this->load->view('direktori/senarai_skema'); ?>
	</div>
</div>

