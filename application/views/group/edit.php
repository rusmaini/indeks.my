
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
    	<?=form_open('group/edit/'.$id,array('class'=>'form form-horizontal')); ?>
        <fieldset>
          <legend>Lengkapkan Maklumat Kumpulan Pengguna</legend>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama kumpulan</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="name" id="name" value="<?=($group)?$group['name']:set_value('name')?>">
              <?= form_error('name'); ?>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Keterangan</label>
            <div class="col-sm-9">
            	<?= form_textarea(array(	'name'=>'description',
            								'class'=>'form-control',
            								'rows'=>'3',
            								'value'=>($group)?$group['description']:set_value('description'))); ?>
             	<?= form_error('description'); ?>
            </div>
          </div>
         
          <div class="col-sm-9 col-sm-offset-3">
          	<?=form_hidden('id',$id)?>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <?=anchor('group','Kembali',array('class'=>'btn btn-default'))?>
          </div>
        </fieldset>
		<?=form_close(); ?>
    	
    </div>
</div>