<?php if($kerja):?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Jawatan Kosong</th>
			<th>Terma</th>
			<th>Gaji</th>
			<th>Lokasi</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($kerja as $row): ?>
		<tr>
			<td>
				<p>
				<b><?=anchor('kerja/p/'.$row['id'].'-'.url_title($row['nama']),$row['nama'],array('title'=>'Jawatan Kosong: '.$row['nama']))?></b><br>
				<?=$row['syarikat']?>
				</p>
				<small>
				Tarikh Tutup: <?=date('d-m-Y',strtotime($row['tarikh_tutup']))?>
				</small>
			</td>
			<td><?=$row['terma']?></td>
			<td><?=$row['imbuhan']?></td>
			<td><?=$row['negeri']?>
				<!--?=anchor('kerja/n/'.$row['negeri_id'].'-'.url_title($row['negeri']),$row['negeri'],array('title'=>'Jawatan kosong di '.$row['negeri']))?-->
			</td>
			<td align="right">
				<?=anchor('kerja/my_edit/'.$row['id'],'<span class="glyphicon glyphicon-edit"></span> Edit',array('class'=>'btn btn-primary btn-sm'))?> &nbsp; 
				<?=anchor('kerja/my_delete/'.$row['id'],'<span class="glyphicon glyphicon-trash"></span> Padam',array('class'=>'btn btn-primary btn-sm','onclick'=>'return confirm(\'Data akan dihapuskan dari pangkalan data. Teruskan?\')'))?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>