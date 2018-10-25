<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
    	<?=form_open('auth/lupa',array('class'=>'form form-horizontal')); ?>
        <fieldset>
          <legend>Lupa Kata Laluan</legend>
          <?= $this->session->flashdata('notice');?>
          <div class="form-group">
            <label class="col-sm-3 control-label">Emel</label>
            <div class="col-sm-9">
              <input type="text" name="email" id="email" class="form-control" value="<?=set_value('email')?>">
              <?= form_error('email'); ?>
            </div>
          </div>
          
         
          <div class="col-sm-9 col-sm-offset-3">
            <button type="submit" class="btn btn-primary">Reset Kata Laluan</button>
            <button type="reset" class="btn">Isi semula</button>
            <br />
            <p>
            	<ul class="nav">
            		<li>Masukkan emel anda untuk menerima kata laluan yang baru.</li>
            	</ul>
            </p>
	        
          </div>
        </fieldset>
		<?=form_close(); ?>
		
	</div>
</div>