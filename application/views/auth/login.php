<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
    	<?=form_open('auth/login',array('class'=>'form form-horizontal')); ?>
        <fieldset>
          <legend>Log Masuk</legend>
          <?= $this->session->flashdata('notice');?>
          <div class="form-group">
            <label class="col-sm-3 control-label">Emel</label>
            <div class="col-sm-9">
              <input type="text" name="email" id="email" class="form-control" value="<?=set_value('email')?>">
              <?= form_error('email'); ?>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Kata laluan</label>
            <div class="col-sm-9">
              <input type="password" name="password" id="password" class="form-control" value="<?=set_value('password')?>">
              <?= form_error('password'); ?>
            </div>
          </div>
         
          <div class="col-sm-9 col-sm-offset-3">
            <button type="submit" class="btn btn-primary">Log masuk</button>
            <button type="reset" class="btn">Isi semula</button>
            <br />
            <p>
            	<ul class="nav">
            		<li><?=anchor('auth/lupa/','Lupa kata laluan? ')?></li>
            		<li><?=anchor('register/','Belum menjadi ahli? Daftar di sini. PERCUMA!')?></li>
            	</ul>
            </p>
	        
          </div>
        </fieldset>
        
		
		<?=form_close(); ?>
		
	</div>
</div>