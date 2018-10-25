
<?=$id;?>

<?= $this->session->flashdata('notice');?>
<div class="row">
	
	<div class="col-sm-2">
		<img class="img-responsive img-thumbnail" src="<?= $this->gravatar->get_gravatar($user['email']); ?>?s=200" />	
	</div>
	<div class="col-sm-10">
		<table class="table table-condensed">
			<tr>
				<th>Nama</th>
				<td width="70%"><?=$user['username']?></td>
			</tr>
			<tr>
				<th>E-mel</th>
				<td><?=auto_link($user['email'])?></td>
			</tr>
			<tr>
				<th>Tarikh daftar</th>
				<td><?=$user['created_on']?></td>
			</tr>
			<tr>
				<th>Tarikh akhir login</th>
				<td><?=$user['last_login']?></td>
			</tr>
			<tr>
				<th>Grup</th>
				<td><?=$user['group_id']?></td>
			</tr>
			<tr>
				<th>Kata laluan</th>
				<td><?=anchor('profile/edit','Tukar kata laluan',array('class'=>'btn btn-primary'))?></td>
			</tr>
		</table>
	</div>
</div>






