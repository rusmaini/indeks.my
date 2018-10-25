
<h3>Pengguna</h3>
<hr />

<?= $this->session->flashdata('notice');?>
 
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Kumpulan</th>
        <th>Aktif</th>
        <th>Tarikh daftar</th>
        <th>Lawatan akhir</th>
        <th><?=anchor('user/edit','Baru',array('class'=>'btn btn-primary'))?></th>
      </tr>
    </thead>
    <tbody>
    	<?php foreach($user as $row): ?>
	      <tr>
	        <td><?=$row['id']?></td>
	        <td><?=$row['username']?> <br />
	        	<?=$row['email']?></td>
	        <td><?=$row['name']?></td>
	        <td><?=$row['active']?></td>
	        <td><?=$row['created_on']?></td>
	        <td><?=$row['last_login']?></td>
	        <td><?=anchor('user/edit/'.$row['id'],'Edit',array('class'=>'btn btn-default btn-sm'))?>
	        	<?=anchor('user/delete/'.$row['id'],'Buang',array('class'=>'btn btn-default btn-sm','onclick'=>'return confirm(\'Data ini akan dibuang. Teruskan?\');'))?>
	        </td>
	      </tr>
      	<?php endforeach; ?>
    </tbody>
</table>
<?php if(!$user): ?>
	<p class="alert alert-warning">Tiada data</p>
<?php endif; ?>