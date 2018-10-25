<?= $this->session->flashdata('notice');?>
<div class="row">
	<div class="col-sm-2">
		<img class="img-responsive img-thumbnail" src="<?= $this->gravatar->get_gravatar($user['email']); ?>?s=200" />	
	</div>
	<div class="col-sm-10">
		<h4><?=$user['username']?></h4>
		<p><?=auto_link($user['email'])?></p>
		<hr />
		
		<div class="row">
			<div class="col-sm-12">
				<?php if($bio): ?>
					<h4><?=$bio['nama_penuh']?></h4>
					<p>
						<?=$bio['alamat']?><br />
						<?=$bio['poskod']?>, <?=$bio['bandar']?><br />
						<?=$bio['negeri']?>
					</p>
					<?php if($bio['no_telefon']): ?>
					<p>
						Tel: <?=$bio['no_telefon']?>
					</p>				
					<?php endif; ?>
					<?php if($bio['url']): ?>
					<p>
						Laman web: <?=auto_link($bio['url'])?>
					</p>				
					<?php endif; ?>
					<?php if($bio['pekerjaan']): ?>
					<p>
						Pekerjaan: <?=$bio['pekerjaan']?>
					</p>				
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
		
		
		
	</div>
</div>






