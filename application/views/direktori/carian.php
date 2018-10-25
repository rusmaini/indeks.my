<?=form_open('direktori/c/',array('class'=>'form form-inline'))?>
	<h4>Buat carian </h4>
	<div class="form-group">
		<input type="text" class="form-control" name="cari" id="cari" value="<?=(isset($_GET['cari']))?$_GET['cari']:set_value('cari')?>" placeholder="Teks carian">
		<?=form_dropdown('kategori_id',$kategori,(isset($_GET['k']))?$_GET['k']:set_value('kategori_id'),' class="form-control"')?>
		<?=form_dropdown('negeri_id',$negeri,(isset($_GET['n']))?$_GET['n']:set_value('negeri_id'),' class="form-control"')?> 
		<?= form_error('cari'); ?>
	</div>
	<button type="submit" class="btn btn-primary">CARI</button>
<?=form_close();