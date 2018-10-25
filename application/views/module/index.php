
<h3>Modul</h3>
<hr />

<?= $this->session->flashdata('notice');?>
 
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Id Modul</th>
        <th>Nama</th>
        <th>Keterangan</th>
        <th><?=anchor('module/edit','Baru',array('class'=>'btn btn-primary'))?></th>
      </tr>
    </thead>
    <tbody>
    	<?php foreach($module as $row): ?>
	      <tr>
	        <td><?=$row['id']?></td>
	        <td><?=$row['name']?></td>
	        <td><?=$row['description']?></td>
	        <td><?=anchor('module/edit/'.$row['id'],'Edit',array('class'=>'btn btn-default btn-sm'))?>
	        	<?=anchor('module/delete/'.$row['id'],'Buang',array('class'=>'btn btn-default btn-sm','onclick'=>'return confirm(\'Data ini akan dibuang. Teruskan?\');'))?>
	        </td>
	      </tr>
      	<?php endforeach; ?>
    </tbody>
</table>
<?php if(!$module): ?>
	<p class="alert alert-warning">Tiada data</p>
<?php endif; ?>