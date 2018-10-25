<?= $this->session->flashdata('notis_upload');?>
<?= $this->session->flashdata('notis');?>

<div class="row">
	<div class="col-sm-8">
		<!-- heading -->
		<?= ($id==0)? '<h4>My Direktori - Tambah Item</h4>':'<h4>My Direktori - Edit Item</h4>'; ?>
		
		<hr />
		<?=form_open_multipart('direktori/my_edit/'.$id,array('class'=>'form form-horizontal')); ?>  
	  	<div class="form-group">
		    <label class="col-sm-3 control-label">Kategori <span class="merah">*</span></label>
		    <div class="col-sm-6">
		      <?=form_dropdown('kategori_id',$kategori,(isset($item))?$item['kategori_id']:set_value('kategori_id'),' class="form-control"')?>
              <?= form_error('kategori_id'); ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Status <span class="merah">*</span></label>
		    <div class="col-sm-3">
		      <?=form_dropdown('status',$status,(isset($item))?$item['status']:set_value('status'),' class="form-control"')?>
              <?= form_error('status'); ?>
		    </div>
		  </div>
		  
		  <hr />
		  
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Jenis Urusniaga <span class="merah">*</span></label>
		    <div class="col-sm-4">
		      <?=form_dropdown('jenisurusniaga_id',$jenisurusniaga,(isset($item))?$item['jenisurusniaga_id']:set_value('jenisurusniaga_id'),' class="form-control"')?>
              <?= form_error('jenisurusniaga_id'); ?>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Jenis Tempoh <span class="merah">*</span></label>
		    <div class="col-sm-4">
		      <?=form_dropdown('jenistempoh_id',$jenistempoh,(isset($item))?$item['jenistempoh_id']:set_value('jenistempoh_id'),' class="form-control"')?>
              <?= form_error('jenistempoh_id'); ?>
		    </div>
		  </div>
		  
		  <hr />
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Gambar Utama</label>
		    <div class="col-sm-9">
		    	<input type="file" name="userfile" />	
		    	<p class="help-block">
		    		Format fail/gambar yang dibenarkan: gif, jpg &amp; png. <br />
		    		Saiz gambar mestilah tidak melebihi 3mb. <br /> 
		    		Saiz panjang/lebar maksimum tidak melebihi 1600px.
		    	</p>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Perkara <span class="merah">*</span></label>
		    <div class="col-sm-9">
		      <input name="perkara" class="form-control" value="<?=(isset($item))?$item['perkara']:set_value('perkara')?>">
		      <?= form_error('perkara'); ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Keterangan <span class="merah">*</span></label>
		    <div class="col-sm-9">
		      <textarea name="keterangan" class="form-control" rows="10"><?=(isset($item))?$item['keterangan']:set_value('keterangan')?></textarea>
		      <?= form_error('keterangan'); ?>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="col-sm-3 control-label">Harga</label>
		    <div class="col-sm-4">
		      <input name="harga" class="form-control" value="<?=(isset($item))?number_format($item['harga'],2):set_value('harga')?>">
		      <?= form_error('harga'); ?>
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
		      <input name="kawasan" class="form-control" value="<?=(isset($item))?$item['kawasan']:set_value('kawasan')?>">
		      <?= form_error('kawasan'); ?>
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
		    <label class="col-sm-3 control-label">Emel</label>
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
	<div class="col-sm-4">
		<h4>Padam / Muatnaik Gambar</h4>
		<hr />
		<!-- gambar -->
		<!-- gambar utama -->
		<?php if(isset($item)):?>
			<!-- Gambar Utama -->
			<?php if($item['gambar']): ?>
				<p>Gambar Utama:</p>
				<div class="row" align="center">
					<div class="col-sm-8">	
						<img id="gambar_utama" class="img-responsive img-thumbnail" src="<?=base_url()?>images/<?=$item['gambar']?>" />
					</div>
					<div class="col-sm-4">
						<?=anchor('direktori/my_gambarutama_delete/'.$id,'<span class="glyphicon glyphicon-trash"></span> Padam',array('onclick'=>'return confirm(\'Gambar akan dihapuskan. Teruskan?\')'))?>
					</div>
				</div>
			<?php endif; ?>	
			<br />
			<!-- Muat naik gambar extra - kalau data direktori dah ada -->
			<p>Gambar Tambahan:</p>
			<?=form_open_multipart('direktori/my_upload_gambar/'.$id,array('name'=>'formupload','class'=>'form form-inline')); ?>  
			<div class="form-group">
			    <input type="file" name="userfile" />
		      	<?=form_hidden('id',$id)?>
			</div>
			<button type="submit" class="btn btn-primary btn-sm">Muatnaik</button>
			</form>
			<p class="help-block">
	    		Format fail/gambar yang dibenarkan: gif, jpg &amp; png. <br />
	    		Saiz gambar mestilah tidak melebihi 3mb. <br /> 
	    		Saiz panjang/lebar maksimum tidak melebihi 1600px.
	    	</p>
			<br />	
			<?php if(isset($gambar)):?>
				<br />
				<!-- Gambar Extra / gambar lain lebih dari satu -->
				<?php foreach($gambar as $g): ?>
					
					<div class="row" align="center">
						<div class="col-sm-8">
							<img class="img-responsive img-thumbnail" src="<?=base_url()?>images/<?=$g['gambar']?>" />
						</div>
						<div class="col-sm-4">
							<?=anchor('direktori/my_gambarextra_delete/'.$id.'/'.$g['id'],'<span class="glyphicon glyphicon-trash"></span> Padam',array('onclick'=>'return confirm(\'Gambar akan dihapuskan. Teruskan?\')'))?>
						</div>
					</div>
					<br />
				<?php endforeach; ?>
			<?php endif; ?>
		<?php else: ?>	
			<p>Anda boleh memuatnaik gambar tambahan selepas item anda disimpan.</p>
		<?php endif; ?>	
	</div>
</div>

