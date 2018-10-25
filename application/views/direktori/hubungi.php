

<!-- hubungi pengiklan -->
<div class="row" style="border: 1px solid #e1e1e1; padding: 10px;">
	<div class="col-sm-12">
		<a name="hubungi"></a> 
		
		<h3>Hubungi <?=$item['nama']?></h3>
		<hr />
		
		<?=($item['telefon'])? '<h4>Telefon:</h4> '.$item['telefon'].'':'';?>
		<hr />
		<?php
		if($item['emel']):
		?>
		<h4>Emel:</h4>
		<?=form_open('direktori/hubungi/'.$url,array('class'=>'form form-horizontal')); ?>
		<fieldset>
		  <?= $this->session->flashdata('notice');?>
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Nama Anda</label>
		    <div class="col-sm-9">
		      <input type="text" name="nama" id="nama" class="form-control" value="<?=($this->session->userdata('username'))? $this->session->userdata('username') : set_value('nama')?>">
		      <?= form_error('nama'); ?>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Emel Anda</label>
		    <div class="col-sm-9">
		      <input type="text" name="email" id="email" class="form-control" value="<?=($this->session->userdata('email'))? $this->session->userdata('email') : set_value('email')?>">
		      <?= form_error('email'); ?>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Subjek</label>
		    <div class="col-sm-9">
		      <input type="text" name="subjek" id="subjek" class="form-control" value="RE: <?=$item['perkara']?>">
		      <?= form_error('subjek'); ?>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Mesej</label>
		    <div class="col-sm-9">
				<?= form_textarea(array(	'name'=>'mesej',
											'class'=>'form-control',
											'rows'=>'5',
											'value'=>set_value('description'))); ?>
		 		<?= form_error('mesej'); ?>
		    </div>
		  </div>
		 
		  <div class="col-sm-9 col-sm-offset-3">
		  	<?=form_hidden('emel_penerima',$item['emel'])?>
		    <button type="submit" class="btn btn-primary">Hantar</button>
		    <br />
		  </div>
		</fieldset>
		
		
		<?=form_close(); ?>

		<?php
		else:
			?>
			Maaf, pengiklan ini tidak sertakan maklumat emel mereka.
			<?php
		endif;
		?>

	</div>
</div>

<br />


		<p>
			<a href="javascript:window.history.back();" class="btn btn-default">&larr; Kembali</a>
		</p>

