<?= $this->session->flashdata('notis_upload');?>
<?= $this->session->flashdata('notis');?>

<div class="row">
	<div class="col-sm-8">
		<!-- heading -->
		<h4><?=$title_page?></h4>
		
		<hr />
		<?=form_open('kerja/my_edit/'.$id,array('class'=>'form form-horizontal')); ?>  
	  	
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Jawatan <span class="merah">*</span></label>
		    <div class="col-sm-9">
		      <input name="nama" class="form-control" value="<?=(isset($item))?$item['nama']:set_value('nama')?>">
		      <?= form_error('nama'); ?>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Peringkat <span class="merah">*</span></label>
		    <div class="col-sm-4">
		      <?=form_dropdown('peringkat_id',$peringkat,(isset($item))?$item['peringkat_id']:set_value('peringkat_id'),' class="form-control"')?>
              <?= form_error('peringkat_id'); ?>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Pengkhususan <span class="merah">*</span></label>
		    <div class="col-sm-4">
		      <?=form_dropdown('pengkhususan_id',$pengkhususan,(isset($item))?$item['pengkhususan_id']:set_value('pengkhususan_id'),' class="form-control"')?>
              <?= form_error('pengkhususan_id'); ?>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Industri <span class="merah">*</span></label>
		    <div class="col-sm-4">
		      <?=form_dropdown('industri_id',$industri,(isset($item))?$item['industri_id']:set_value('industri_id'),' class="form-control"')?>
              <?= form_error('industri_id'); ?>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Keterangan <span class="merah">*</span></label>
		    <div class="col-sm-9">
		      <textarea name="keterangan" class="form-control" rows="10"><?=(isset($item))?$item['keterangan']:set_value('keterangan')?></textarea>
		      <?= form_error('keterangan'); ?>
		      <p class="help-block">
		      	Sila nyatakn bidang tugas yang akan dilakukan, kemahiran yang diperlukan oleh calon dan cara memohon jawatan tersebut.
		      </p>
		    </div>
		  </div>
		  
		  
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Imbuhan / Gaji <span class="merah">*</span></label>
		    <div class="col-sm-4">
		      <?=form_dropdown('imbuhan_id',$imbuhan,(isset($item))?$item['imbuhan_id']:set_value('imbuhan_id'),' class="form-control"')?>
              <?= form_error('imbuhan_id'); ?>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Terma<span class="merah">*</span></label>
		    <div class="col-sm-4">
		      <?=form_dropdown('terma_id',$terma,(isset($item))?$item['terma_id']:set_value('terma_id'),' class="form-control"')?>
              <?= form_error('terma_id'); ?>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Kekosongan</label>
		    <div class="col-sm-4">
		      <input name="kekosongan" class="form-control" value="<?=(isset($item))?$item['kekosongan']:set_value('kekosongan')?>">
		      <?= form_error('kekosongan'); ?>
		    </div>
		  </div>
		 
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Tarikh Tutup <span class="merah">*</span></label>
		    <div class="col-sm-4">
		      <input name="tarikh_tutup" id="tarikh_tutup" class="form-control" value="<?=(isset($item))?date('d/m/Y',strtotime($item['tarikh_tutup'])):set_value('tarikh_tutup')?>">
		      <?= form_error('tarikh_tutup'); ?>
		    </div>
		  </div>
		  	  
			
		  <div class="form-group">
		    <div class="col-sm-offset-3 col-sm-9">
				<a href="javascript:window.history.back();" class="btn btn-default">&larr; Kembali</a>
		      	<button type="submit" class="btn btn-primary">Simpan</button>
		      	<?=form_hidden('id',$id)?>
		      	<?=form_hidden('syarikat_id',$syarikat['id'])?>
		      	<?=form_hidden('user_id',$this->session->userdata('user_id'))?>
		    </div>
		  </div>
		<?=form_close(); ?>
		<p>
			<span class="merah">*</span> Setiap maklumat ini wajib diisi.
		</p>

	</div>
	<div class="col-lg-4">
		
		<?php $this->load->view('kerja/syarikat'); ?>
	</div>
</div>

<script language="javascript">
$(document).ready(function() {	
//popup kalendar
	$("#tarikh_tutup").datepicker({ 
		dateFormat: 'dd/mm/yy',
      	changeMonth: true,
      	changeYear: true });
});
</script>

<!--
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
-->