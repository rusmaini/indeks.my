
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
    	<?=form_open('user/edit/'.$id,array('class'=>'form form-horizontal')); ?>
        <fieldset>
          <legend>Lengkapkan Maklumat Pengguna </legend>
          <?= $this->session->flashdata('notice');?>
          <div class="form-group">
            <label class="col-sm-3 control-label">Emel</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="email" id="email" value="<?=($user)?$user['email']:set_value('email')?>">
              <?= form_error('email'); ?>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama pengguna</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="username" id="username" value="<?=($user)?$user['username']:set_value('username')?>">
              <?= form_error('username'); ?>
            </div>
          </div>
          
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Kumpulan</label>
            <div class="col-sm-9">
            	<?= form_dropdown('group_id',$group,($user)?$user['group_id']:set_value('group_id'),' class="form-control"') ?>
              	<?= form_error('group_id'); ?>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Aktif</label>
            <div class="col-sm-9">
            	<?= form_dropdown('active',$active,($user)?$user['active']:set_value('active'),' class="form-control"') ?>
              	<?= form_error('active'); ?>
            </div>
          </div>
          <hr />
          <!--
          <div class="form-group">
            <label class="col-sm-3 control-label" for="optionsCheckbox">Kemaskini kata laluan</label>
            <div class="col-sm-9">
              <label class="checkbox">
                <?= form_checkbox('updatepwd', '1', TRUE); ?>
                Kemaskini kata laluan
              </label>
            </div>
          </div>
          -->
          
          <div class="form-group">
            <label class="col-sm-3 control-label"></label>
            <div class="col-sm-9">
            	Masukkan kata laluan jika hendak ditukarkan kepada yang baru.
            </div>
          </div>
          
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Kata laluan</label>
            <div class="col-sm-9">
            	<input type="password" class="form-control" name="password" id="password">
              <?= form_error('password'); ?>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Pengesahan kata laluan</label>
            <div class="col-sm-9">
            	<input type="password" class="form-control" name="passconf" id="passconf">
              <?= form_error('passconf'); ?>
            </div>
          </div>
          
          <div class="col-sm-9 col-sm-offset-3">
          	<?=form_hidden('id',$id)?>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <?=anchor('user','Kembali',array('class'=>'btn btn-default'))?>
          </div>
        </fieldset>
		<?=form_close(); ?>
    	
    </div>
</div>