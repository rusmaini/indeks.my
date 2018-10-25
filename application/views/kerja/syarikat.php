<div class="well well-sm">
	<h4>
		<?=$syarikat['nama']?> <?=($syarikat['no_pendaftaran'])? '('.$syarikat['no_pendaftaran'].')' : '';?>
	</h4>
	<p>
		<?=$syarikat['alamat']?><br />
		<?=$syarikat['poskod']?>, <?=$syarikat['bandar']?><br />
		<?=$syarikat['negeri']?>
	</p>
	
	<h4>Hubungi:</h4>
	<p>
		<?=($syarikat['orang_dihubungi'])? $syarikat['orang_dihubungi'].'<br />' : '';?>
		Telefon: <?=$syarikat['telefon']?><br />
		<?=($syarikat['faks'])? $syarikat['faks'].'<br />' : '';?>
		<?=($syarikat['faks'])? $syarikat['faks'].'<br />' : '';?>
		<?=($syarikat['laman_web'])? $syarikat['laman_web'].'<br />' : '';?>
		<?=($syarikat['emel'])? auto_link($syarikat['emel']).'<br />' : '';?>
	</p>
</div>