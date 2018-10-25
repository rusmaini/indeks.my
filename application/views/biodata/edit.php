<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
    	
    	<?=form_open('biodata/edit',array('class'=>'form form-horizontal')); ?>
    	<legend>Kemaskini Biodata Anda</legend>
        <?= $this->session->flashdata('notice');?>
    	
    	
    	<div class="form-group">
			<label class="col-sm-3">Gambar Profail</label>
			<div class="col-sm-9">
				<img src="<?= $this->gravatar->get_gravatar($user['email']); ?>?s=80" />
				<p class="help-block">
					<small>
					Untuk menetapkan gambar profail, sila muat naik gambar anda melalui aplikasi Gravatar di <?=anchor('gravatar.com','gravatar.com',array('target','_blank'))?>.
					</small>
				</p>
			</div>
		</div>
		
    	<div class="form-group">
			<label class="col-sm-3">Nama Penuh</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="nama_penuh" id="nama_penuh" class="span5" value="<?=($bio)?$bio['nama_penuh']:set_value('nama_penuh')?>">
				<?= form_error('nama_penuh'); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3">Alamat</label>
			<div class="col-sm-9">
				<textarea name="alamat" class="form-control" rows="3" class="span5"><?=($bio)?$bio['alamat']:set_value('alamat')?></textarea>
				<?= form_error('alamat'); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3">Poskod</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="poskod" id="poskod" class="span2" value="<?=($bio)?$bio['poskod']:set_value('poskod')?>">
				<?= form_error('poskod'); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3">Bandar</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="bandar" id="bandar" class="span5" value="<?=($bio)?$bio['bandar']:set_value('bandar')?>">
				<?= form_error('bandar'); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3">Negeri</label>
			<div class="col-sm-9">
				<?php $js = '  class="form-control"' ?>
				<?=form_dropdown('negeri',$negeri,($bio)?$bio['negeri']:set_value('negeri'),$js)?>
				<?= form_error('negeri'); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3">No. Telefon</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="no_telefon" id="no_telefon" class="span2" value="<?=($bio)?$bio['no_telefon']:set_value('no_telefon')?>">
				<?= form_error('no_telefon'); ?>
			</div>
		</div>
		
    	<div class="form-group">
			<label class="col-sm-3">Tarikh Lahir</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="tarikh_lahir" id="tarikh_lahir" class="span2" value="<?=($bio)?date('d/m/Y',strtotime($bio['tarikh_lahir'])):set_value('tarikh_lahir')?>">
				<?= form_error('tarikh_lahir'); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3">Laman Web</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="url" id="url" class="span5" value="<?=($bio)?$bio['url']:set_value('url')?>">
				<?= form_error('url'); ?>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3">Pekerjaan</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="pekerjaan" id="pekerjaan" class="span5" value="<?=($bio)?$bio['pekerjaan']:set_value('pekerjaan')?>">
				<?= form_error('pekerjaan'); ?>
			</div>
		</div>
				
		<div class="col-sm-9 col-sm-offset-3">
			<button type="submit" class="btn btn-primary">Simpan</button>
			<button type="reset" class="btn">Isi semula</button>
		</div>
		<?=form_close(); ?>
	</div>
</div>


<script language="javascript">
$(document).ready(function() {	
//popup kalendar
	$("#tarikh_lahir").datepicker({ 
		dateFormat: 'dd/mm/yy',
      	changeMonth: true,
      	changeYear: true });
});
</script>