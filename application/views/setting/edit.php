
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
    	<?=form_open('setting/',array('class'=>'form form-horizontal')); ?>
        <fieldset>
          <legend>Seting </legend>
          <?= $this->session->flashdata('notice');?>
          <?php
          foreach ($setting as $row):
          ?>
			<div class="form-group">
			<label class="col-sm-3 control-label"><?=$row['title']?></label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="<?=$row['slug']?>" id="<?=$row['slug']?>" value="<?=$row['value']?>">
				</div>
			</div>    
          <?php
		  endforeach;
          ?>
          <div class="col-sm-9 col-sm-offset-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </fieldset>
		<?=form_close(); ?>
    	
    </div>
</div>