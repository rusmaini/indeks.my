<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
    	<?=form_open('register/',array('class'=>'form form-horizontal')); ?>
        <fieldset>
        <legend>Daftar Akaun</legend>
        <?= $this->session->flashdata('notice');?>
		
		<div class="form-group">
			<label class="col-sm-3 control-label">Nama Panggilan</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="username" id="username" value="<?=set_value('username')?>">
				<?= form_error('username'); ?>
				<p class="help-block">
					Akan dipaparkan pada setiap pos anda. Nama panggilan adalah unik dan tidak boleh ditukar.
				</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label">Emel</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="email" id="email" value="<?=set_value('email')?>">
				<?= form_error('email'); ?>
				<p class="help-block">
					Emel akan digunakan untuk log masuk.
				</p>
			</div>
		</div>
          
		<div class="form-group">
			<label class="col-sm-3 control-label">Kata laluan</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" name="password" id="password" value="<?=set_value('password')?>">
				<?= form_error('password'); ?>
				<p class="help-block">
					Sekurang-kurangnya 6 aksara.
				</p>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-sm-3 control-label">Ulang kata laluan</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" name="repassword" id="repassword" value="<?=set_value('repassword')?>">
				<?= form_error('repassword'); ?>
				<p class="help-block">
					Masukkan kata laluan anda sekali lagi.
				</p>
			</div>
		</div>
         
          <div class="col-sm-9 col-sm-offset-3">
            <button type="submit" class="btn btn-primary">Daftar</button>
            <button type="reset" class="btn">Isi semula</button>
          </div>
        </fieldset>
		<?=form_close(); ?>
	</div>
</div>