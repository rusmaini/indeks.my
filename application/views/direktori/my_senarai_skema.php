<?php if($direktori): ?>
<table class="table table-striped  table-hover">
	<thead>
		<tr>
				<td>
					<div class="row">
						<div class="col-sm-1">
								
						</div>	
						<div class="col-lg-4">
							
						</div>
						<div class="col-lg-2">
							
						</div>
						<div class="col-sm-2">
							Tarikh Daftar
						</div>
						<div class="col-sm-1">
							Status
						</div>
						
					</div>
				</td>
			</tr>
	</thead>
	
	<tbody>
		<?php 
		$bil = 0;
		foreach($direktori as $row):
			$bil++;
			
			$slug = str_replace(' ', '-', $row['perkara']);
			$slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug); // Removes special chars.
			$slug = preg_replace('/-+/', '-', $slug); // Replaces multiple hyphens with single one.
   
			?>
			<tr>
				<td>
					<div class="row">
						<div class="col-sm-1">
							<?php 								
							if($row['gambar']):
								$img_dir = base_url().'images/'.$row['gambar'];
							else:
								$img_dir = base_url().'assets/img/no-image.png';
							endif; 
							?>
							<?=anchor('direktori/p/'.$row['id'].'-'.$slug,'<img class="img-responsive img-thumbnail" src="'.$img_dir.'" /> ',array('title'=>$row['perkara']))?>
						
						</div>	
						<div class="col-lg-4">
							<?=anchor('direktori/p/'.$row['id'].'-'.$slug,$row['perkara'],array('title'=>$row['perkara']))?><br />
							<?=$row['kategori']?> - <?=$row['negeri']?>
						</div>
						<div class="col-lg-2">
							RM <?=number_format($row['harga'], 2, '.', '');?><br />
							<?php
							echo $row['jenisurusniaga'];
							if($row['jenisurusniaga_id']==2): //2: untuk sewa
								echo ' - '.$row['jenistempoh'];
							endif;
							?>
						</div>
						<div class="col-sm-2">
							<?=date('d/m/Y h:i a',strtotime($row['created_at']))?>
						</div>
						<div class="col-sm-1">
							<?=$row['status']?>
						</div>
						<div class="col-sm-2" align="right">
							<?=anchor('direktori/my_edit/'.$row['id'],'<span class="glyphicon glyphicon-edit"></span> Edit',array('class'=>'btn btn-primary btn-sm'))?> &nbsp; 
							<?=anchor('direktori/my_delete/'.$row['id'],'<span class="glyphicon glyphicon-trash"></span> Padam',array('class'=>'btn btn-primary btn-sm','onclick'=>'return confirm(\'Data akan dihapuskan dari pangkalan data. Teruskan?\')'))?>
						</div>
					</div>
				</td>
			</tr>
			<?php
		endforeach;
		?>
	</tbody>
</table>
<?php else: ?>
	<em>Tiada data..</em>
<?php endif; ?>