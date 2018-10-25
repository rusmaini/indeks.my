<?= $this->session->flashdata('notis');?>


<div class="row">
	
	<div class="col-sm-6">
		<h3><?=$item['nama']?> &mdash; <?=$item['syarikat']?></h3>
		<?=$item['imbuhan']?> / <?=$item['peringkat']?> / <?=$item['terma']?>
		<hr />
		<!--<h4>Keterangan</h4>-->
		<span class="pre">
		<?=$item['keterangan']?>
		</span>
		<br />
		<table class="table table-condensed">
			<tr>
				<th>Tarikh Tutup</th>
				<td>: <?=date('d-m-Y',strtotime($item['tarikh_tutup']))?></td>
				<th>Kekosongan</th>
				<td>: <?=$item['kekosongan']?></td>
			</tr>
			<tr>
				<th>Bidang/Pengkhususan</th>
				<td>: <?=$item['pengkhususan']?></td>
				<th>Industri</th>
				<td>: <?=$item['industri']?></td>
			</tr>
		</table>
				
		<div class="well well-sm">
			<?php $this->load->view('iklan_teks'); ?>
		</div>
	</div>
	<div class="col-sm-3">		
		<div class="well well-sm">
			<h4>
				<?=$item['syarikat']?> <?=($item['no_pendaftaran'])? '('.$item['no_pendaftaran'].')' : '';?>
			</h4>
			<p>
				<?=$item['alamat']?><br />
				<?=$item['poskod']?>, <?=$item['bandar']?><br />
				<?=$item['negeri']?>
			</p>
			
			<h4>Hubungi:</h4>
			<p>
				<?=($item['orang_dihubungi'])? $item['orang_dihubungi'].'<br />' : '';?>
				Telefon: <?=$item['telefon']?><br />
				<?=($item['faks'])? $item['faks'].'<br />' : '';?>
				<?=($item['faks'])? $item['faks'].'<br />' : '';?>
				<?=($item['laman_web'])? $item['laman_web'].'<br />' : '';?>
				<?=($item['emel'])? auto_link($item['emel']).'<br />' : '';?>
			</p>
			<small><i>Iklan oleh: <?=$item['username']?></i></small>
		</div>
		
		<p>
			<span class='st_facebook_large' displayText='Facebook'></span>
			<span class='st_twitter_large' displayText='Tweet'></span>
			<span class='st_email_large' displayText='Email'></span>
			<span class='st_googleplus_large' displayText='Google +'></span>
			<span class='st_linkedin_large' displayText='LinkedIn'></span>
			<span class='st__large' displayText=''></span>
		</p>
		
	</div>
	<div class="col-sm-3">
		<!-- iklan -->
		<?php $this->load->view('iklan_sidebar'); ?>
	</div>
</div>

<br />
<p>
	<a href="javascript:window.history.back();" class="btn btn-default">&larr; Kembali</a>
</p>