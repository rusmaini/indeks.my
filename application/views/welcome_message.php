<?= $this->session->flashdata('notice');?>
<div class="bg-malaysia">
<div class="row">
	<div class="col-sm-9">
		<h2><?=$title;?></h2>
		<p> <?=$slogan?></p>
	</div>
	<div class="col-sm-3">
	</div>
</div>
<br />
</div>


<?php $this->load->view('direktori/carian'); ?>

<p class="help-block">
	
</p>

<hr />

<div class="row">
	<div class="col-sm-6">
		<h3>Sedang mencari sesuatu?</h3>
		<p>
			Adakah anda sedang mencari rumah, homestay, kereta, motosikal, pakaian atau apa sahaja? <br />
			<?=$title;?> menyenaraikan bermacam jenis produk &amp; perkhidmatan yang mungkin anda cari.</p>
		<p>
			<?=anchor('direktori','Lihat senarai iklan',array('class'=>'btn btn-success'))?>
		</p>
		
		<!-- ?=anchor('direktori','Lihat senarai iklan',array('class'=>'btn btn-primary'))? -->
	</div>
	<div class="col-sm-6">
		<h3>Sedang mencari pelanggan? </h3>
		<p>Adakah anda mencari ruang untuk promosi atau mengiklankan produk anda di ineternet? <br />
			Iklankan di <?=$title;?>. Pendaftaran percuma. Tiada had iklan.</p>
		<p><?=anchor('register','Daftar sekarang',array('class'=>'btn btn-warning'))?></p>
		
	</div>
</div>

<br />

<div class="pull-left" style="margin:20px 0">
<!--script begin--><script type="text/javascript" src="http://circles66.com/cwidget/horizontal"></script><!--script end-->
</div>