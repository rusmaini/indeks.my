
<h3>Kumpulan Pengguna</h3>
<hr />

<?= $this->session->flashdata('notice');?>
 
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Id Kumpulan</th>
        <th>Nama</th>
        <th>Keterangan</th>
        <th><?=anchor('group/edit','Baru',array('class'=>'btn btn-primary'))?></th>
      </tr>
    </thead>
    <tbody>
    	<?php foreach($group as $row): ?>
	      <tr>
	        <td><?=$row['id']?></td>
	        <td><?=$row['name']?></td>
	        <td><?=$row['description']?></td>
	        <td><?=anchor('group/edit/'.$row['id'],'Edit',array('class'=>'btn btn-default btn-sm'))?>
	        	<?=anchor('group/delete/'.$row['id'],'Buang',array('class'=>'btn btn-default btn-sm','onclick'=>'return confirm(\'Data ini akan dibuang. Teruskan?\');'))?>
	        </td>
	      </tr>
      	<?php endforeach; ?>
    </tbody>
</table>
<?php if(!$group): ?>
	<p class="alert alert-warning">Tiada data</p>
<?php endif; ?>