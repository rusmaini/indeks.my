
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
    	<?=form_open('permission/edit/'.$id,array('class'=>'form form-horizontal')); ?>
        <fieldset>
          <legend>Sila Pilih Had Capaian Bagi Kumpulan Pengguna</legend>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama kumpulan pengguna</label>
            <div class="col-sm-9">
              <?=form_dropdown('group_id',$group,($permission)?$permission['group_id']:'',' class="form-control"')?>
              <?= form_error('group_id'); ?>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label">Nama modul</label>
            <div class="col-sm-9">
              <?=form_dropdown('module_id',$module,($permission)?$permission['module_id']:'',' class="form-control"')?>
              <?= form_error('module_id'); ?>
            </div>
          </div>
         
         <div class="col-sm-9 col-sm-offset-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <?=anchor('permission','Kembali',array('class'=>'btn btn-default'))?>
          	<?=form_hidden('id',$id)?>
          </div>
        </fieldset>
		<?=form_close(); ?>
    	
    </div>
</div>