
<h3>Had Capaian - Admin Sahaja</h3>
<hr />

<?= $this->session->flashdata('notice');?>
 
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Kumpulan Pengguna</th>
        <th>Modul</th>
        <th><?=anchor('permission/edit','Baru',array('class'=>'btn btn-primary'))?></th>
      </tr>
    </thead>
    <tbody>
    	<?php foreach($permission as $row): ?>
	      <tr>
	        <td><?=$row['id']?></td>
	        <td><p><?=$row['group_name']?> <br /><small><?=$row['group_desc']?></small></p></td>
	        <td><p><?=$row['mod_name']?> <br /><small><?=$row['mod_desc']?></small></p></td>
	        <td><?=anchor('permission/edit/'.$row['id'],'Edit',array('class'=>'btn btn-default btn-sm'))?>
	        	<?=anchor('permission/delete/'.$row['id'],'Buang',array('class'=>'btn btn-default btn-sm','onclick'=>'return confirm(\'Data ini akan dibuang. Teruskan?\');'))?>
	        </td>
	      </tr>
      	<?php endforeach; ?>
    </tbody>
</table>
<?php if(!$permission): ?>
	<p class="alert alert-warning">Tiada data</p>
<?php endif; ?>