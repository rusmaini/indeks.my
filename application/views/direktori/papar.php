<?= $this->session->flashdata('notis');?>

<div class="row">
	<div class="col-sm-9">
				
		<!-- heading -->
		<h4><?=$item['kategori']?> di <?=$item['negeri']?></h4>
		<hr />
		
		
		<h3><?=$item['perkara']?></h3>
		<p>
			Oleh <?=anchor($item['nama'],$item['nama'])?> pada <?=date('d/m/Y h:i a',strtotime($item['created_at']))?>
		</p>

		<!-- gambar utama -->
		<?php 								
		if($item['gambar']):
			$img_dir = base_url().'images/'.$item['gambar'];
		else:
			$img_dir = base_url().'assets/img/no-image.png';
		endif; 
		?>
		<div class="row" align="center">
			<div class="col-sm-10 col-sm-offset-1">
				<img id="gambar_utama" class="img-responsive img-thumbnail" src="<?=$img_dir?>" />				
			</div>
		</div>
		
		<!-- gambar -->
		<?php if($gambar):?>
		<br />
		<div class="row" align="center">
			<div class="col-sm-2 pull-left img-extra-thumb">
				<!-- gambar utama -->
				<a href="javascript:void(0)" onclick="switchImg('<?=$img_dir?>')">
					<img class="img-responsive img-thumbnail" src="<?=$img_dir?>" />
				</a>
			</div>
			<!-- gambar lain lebih dari satu -->
			<?php foreach($gambar as $g): ?>
				<div class="col-sm-2 pull-left img-extra-thumb">
				<a href="javascript:void(0)" onclick="switchImg('<?=base_url()?>images/<?=$g['gambar']?>')">
					<img class="img-responsive img-thumbnail" src="<?=base_url()?>images/<?=$g['gambar']?>" />
				</a>
				</div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
		<br />
		
		<!-- harga & contact -->
		<div class="row" style="border: 1px solid #e1e1e1; padding: 10px;">
			<div class="col-sm-6">
				<center>
					<h4>RM <?=number_format($item['harga'], 2, '.', '');?><br /></h4>
					<span class="label label-default">
					<?php
					echo $item['jenisurusniaga'];
					if($item['jenisurusniaga_id']==2): //2: untuk sewa
						echo ' - '.$item['jenistempoh'];
					endif;
					?>
					</span>
				</center>
			</div>
			<div class="col-sm-6" style="border-left: 1px solid #e1e1e1">
				<center>
					<?=anchor('direktori/hubungi/'.$url,'Hubungi Pengiklan',array('class'=>'btn btn-primary'))?>
				</center>
			</div>
		</div>
		<br />
		
		<!-- Keterangan -->
		<div class="row" style="border: 1px solid #e1e1e1; padding: 10px;">
			<div class="col-sm-7">
				<div class="pre">
					<?=($item['keterangan'])? auto_link($item['keterangan']):'<small><em>'.$item['perkara'].'</em></small>'; ?>
				</div>
			</div>
			<div class="col-sm-5" style="border-left: 1px solid #e1e1e1">
				<div>
				<?=($item['telefon'])? '<b>Telefon:</b> <br>'.$item['telefon'].'<br>':'';?>
				<?=($item['alamat'])? 	'<b>Alamat:</b> <br>'.$item['alamat']:''; ?>
				<?=($item['poskod'])? 	'<br>'.$item['poskod']:''; ?>
				<?=($item['kawasan'])? 	$item['kawasan']:''; ?>
				<?=($item['negeri'])? 	'<br>'.$item['negeri']:''; ?>
				</div>
				<hr />
				<?php 
				if(isset($atribut_view)):
				$this->load->view($atribut_view); 
				endif;
				?>
			</div>
		</div>
		<br />
		
		<p>
			<a href="javascript:window.history.back();" class="btn btn-default">&larr; Kembali</a>
		</p>
	</div>
	<div class="col-sm-3" style="border-left: 1px solid #ccc;">
		<?php $this->load->view('iklan_sidebar'); ?>
	</div>
</div>

<script>

//
function switchImg(i){
	//document.images["gambar_utama"].src = i;
	document.getElementById("gambar_utama").src = i;
	//alert(i);
}
</script>
