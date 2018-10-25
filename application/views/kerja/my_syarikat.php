<?= $this->session->flashdata('notis_upload');?>
<?= $this->session->flashdata('notis');?>


<p class="pull-right">
	<?=anchor('kerja/my','&larr; Senarai Perjawatan',array('class'=>'btn btn-default'))?>
	<?=anchor('kerja/my_edit/0','Tambah Perjawatan &rarr;',array('class'=>'btn btn-success'))?>
</p>

<div class="row">
	<div class="col-sm-8">
		<!-- heading -->
		<h4><?=$title_page?></h4>
		
		<hr />
		<?=form_open('kerja/my_syarikat/'.$id,array('class'=>'form form-horizontal')); ?>  
	 
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Nama Syarikat <span class="merah">*</span></label>
		    <div class="col-sm-9">
		      <input name="nama" class="form-control" value="<?=(isset($item))?$item['nama']:set_value('nama')?>">
		      <?= form_error('nama'); ?>
		    </div>
		  </div>
		
		  <div class="form-group">
		    <label class="col-sm-3 control-label">No. Pendaftaran Syarikat</label>
		    <div class="col-sm-4">
		      <input name="no_pendaftaran" class="form-control" value="<?=(isset($item))?$item['no_pendaftaran']:set_value('no_pendaftaran')?>">
		      <?= form_error('no_pendaftaran'); ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Alamat <span class="merah">*</span></label>
		    <div class="col-sm-9">
		      <textarea name="alamat" class="form-control" rows="3"><?=(isset($item))?$item['alamat']:set_value('alamat')?></textarea>
		      <?= form_error('alamat'); ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Poskod <span class="merah">*</span></label>
		    <div class="col-sm-4">
		      <input name="poskod" class="form-control" value="<?=(isset($item))?$item['poskod']:set_value('poskod')?>">
		      <?= form_error('poskod'); ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Kawasan / Bandar <span class="merah">*</span></label>
		    <div class="col-sm-4">
		      <input name="bandar" class="form-control" value="<?=(isset($item))?$item['bandar']:set_value('bandar')?>">
		      <?= form_error('bandar'); ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Negeri <span class="merah">*</span></label>
		    <div class="col-sm-4">
		      <?=form_dropdown('negeri_id',$negeri,(isset($item))?$item['negeri_id']:set_value('negeri_id'),' class="form-control"')?>
              <?= form_error('negeri_id'); ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Emel <span class="merah">*</span></label>
		    <div class="col-sm-5">
		      <input name="emel" class="form-control" value="<?=(isset($item))?$item['emel']:set_value('emel')?>">
		      <?= form_error('emel'); ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Telefon <span class="merah">*</span></label>
		    <div class="col-sm-5">
		      <input name="telefon" class="form-control" value="<?=(isset($item))?$item['telefon']:set_value('telefon')?>">
		      <?= form_error('telefon'); ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Faks</label>
		    <div class="col-sm-5">
		      <input name="faks" class="form-control" value="<?=(isset($item))?$item['faks']:set_value('faks')?>">
		      <?= form_error('faks'); ?>
		    </div>
		  </div>
			
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Laman Web</label>
		    <div class="col-sm-9">
		      <input name="laman_web" class="form-control" value="<?=(isset($item))?$item['laman_web']:set_value('laman_web')?>">
		      <?= form_error('laman_web'); ?>
		    </div>
		  </div>
			
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Individu Untuk Dihubungi <span class="merah">*</span></label>
		    <div class="col-sm-5">
		      <input name="orang_dihubungi" class="form-control" value="<?=(isset($item))?$item['orang_dihubungi']:set_value('orang_dihubungi')?>">
		      <?= form_error('orang_dihubungi'); ?>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <div class="col-sm-offset-3 col-sm-9">
				<a href="javascript:window.history.back();" class="btn btn-default">&larr; Kembali</a>
		      	<button type="submit" class="btn btn-primary">Simpan</button>
		      	<?=form_hidden('id',$id)?>
		      	<?=form_hidden('user_id',$this->session->userdata('user_id'))?>
		    </div>
		  </div>
		<?=form_close(); ?>
		<p>
			<span class="merah">*</span> Setiap maklumat ini wajib diisi.
		</p>

	</div>
	
</div>

