
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
    	
    	<?=form_open('profile/edit/',array('class'=>'form form-horizontal')); ?>
        <fieldset>
          <legend>Tukar kata laluan</legend>
          <?= $this->session->flashdata('notice');?>
          <div class="form-group">
            <label class="col-sm-3">Emel</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="email" id="email" readonly="readonly" value="<?=($user)?$user['email']:set_value('email')?>">
              <?= form_error('email'); ?>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3">Nama pengguna</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="username" id="username" readonly="readonly" value="<?=($user)?$user['username']:set_value('username')?>">
              <?= form_error('username'); ?>
            </div>
          </div>
          
          
          <div class="form-group">
            <label class="col-sm-3"></label>
            <div class="col-sm-9">
            	Masukkan kata laluan yang baru.
            </div>
          </div>
          
          
          <div class="form-group">
            <label class="col-sm-3">Kata laluan</label>
            <div class="col-sm-9">
            	<input type="password" class="form-control" name="password" id="password">
              <?= form_error('password'); ?>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3">Pengesahan kata laluan</label>
            <div class="col-sm-9">
            	<input type="password" class="form-control" name="passconf" id="passconf">
              <?= form_error('passconf'); ?>
            </div>
          </div>
          
          <div class="col-sm-9 col-sm-offset-3">
          	<?=form_hidden('id',$id)?>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <?=anchor('profile','Kembali',array('class'=>'btn btn-default'))?>
          </div>
        </fieldset>
		<?=form_close(); ?>
    	
    </div>
</div>