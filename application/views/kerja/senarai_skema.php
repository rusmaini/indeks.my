<?php if($kerja):?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Jawatan Kosong</th>
			<th>Terma</th>
			<th>Gaji</th>
			<th>Lokasi</th>
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
				<!--?=anchor('kerja/n/'.$row['negeri_id'].'-'.url_title($row['negeri']),$row['negeri'],array('title'=>'Jawatan kosong di '.$row['negeri']))?--></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php else: ?>
	<p><em>Tiada data..</em></p>
<?php endif; ?>