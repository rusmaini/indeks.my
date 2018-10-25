
<?php $this->load->view('iklan_header'); ?>

<div class="pull-right">
	<?=anchor('kerja/my_edit/0','<span class="glyphicon glyphicon-pencil"></span> Pos Iklan Percuma',array('class'=>'btn btn-danger btn-sm'))?>
</div>
<h3>Senarai Jawatan Kosong Terkini</h3>
<hr />

<?= $this->session->flashdata('notis');?>
<div class="row">
	<div class="col-sm-2">
		<ul class="nav">
		<?php
		foreach ($negeri_tepi as $row) {
			?>
			<li><?=anchor('kerja/n/'.$row['id'].'-'.$row['nama'],$row['nama']);?></li>
			<?php
		}
		?>
		</ul>
	</div>
	<div class="col-sm-10">
		<?php $this->load->view('kerja/senarai_skema'); ?>
		<?=$links?>
		<br />
		<?php $this->load->view('iklan_teks'); ?>	
	</div>
</div>

