
<?= $this->session->flashdata('notice');?>

<div class="row">
	<div class="col-sm-8">
				
		<!-- heading -->
		<h4><?=$item['kategori']?> di <?=$item['negeri']?></h4>
		<hr />
		
		
		<h3><?=$item['perkara']?></h3>
		<p>
			Oleh <?=anchor($item['nama'],$item['nama'])?> pada <?=date('d/m/Y h:i a',strtotime($item['created_at']))?>
		</p>

		<!-- gambar utama -->
		<div class="row" align="center">
			<div class="col-sm-12">
				<img id="gambar_utama" class="img-responsive img-thumbnail" src="<?=base_url()?>images/<?=$item['gambar']?>" />				
			</div>
		</div>
		
		<!-- gambar -->
		<?php if($gambar):?>
		<br />
		<div class="row" align="center">
			<div class="col-sm-2 pull-left">
				<!-- gambar utama -->
				<a href="javascript:void(0)" onclick="switchImg('<?=base_url()?>images/<?=$item['gambar']?>')">
					<img class="img-responsive img-thumbnail" src="<?=base_url()?>images/<?=$item['gambar']?>" />
				</a>
			</div>
			<!-- gambar lain lebih dari satu -->
			<?php foreach($gambar as $g): ?>
				<div class="col-sm-2 pull-left">
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
					<?=($item['keterangan'])? $item['keterangan']:'<small><em>tiada maklumat diberikan</em></small>'; ?>
				</div>
			</div>
			<div class="col-sm-5" style="border-left: 1px solid #e1e1e1">
				<div class="pre">
				<?=($item['telefon'])? '<b>Telefon:</b> <br>'.$item['telefon'].'<br>':'';?>
				<?=($item['alamat'])? 	'<b>Alamat:</b> <br>'.$item['alamat']:''; ?>
				<?=($item['poskod'])? 	'<br>'.$item['poskod']:''; ?>
				<?=($item['kawasan'])? 	$item['kawasan']:''; ?>
				<?=($item['negeri'])? 	'<br>'.$item['negeri']:''; ?>
				</div>
				<hr />
				<?php $this->load->view($atribut_view); ?>
			</div>
		</div>
		<br />
		
		<p>
			<a href="javascript:window.history.back();" class="btn btn-default">&larr; Kembali</a>
		</p>
	</div>
	<div class="col-sm-4">
		<p>
			<small>
				-ads-
			</small>
		</p>
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

