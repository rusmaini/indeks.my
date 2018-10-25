<?php if($atribut):?>
<?=($atribut['jeniskediaman'])? '<p><label>Jenis Kediaman:</label> '.$atribut['jeniskediaman'].'</p>':''; ?>
<?=($atribut['saiz'])? '<p><label>Saiz:</label> '.$atribut['saiz'].'</p>':''; ?>
<?=($atribut['kemudahan'])? '<p><label>Kemudahan:</label> <span class="pre">'.$atribut['kemudahan'].'</span></p>':''; ?>
<?=($atribut['bil_bilik'])? '<p><label>Bil. Bilik:</label> '.$atribut['bil_bilik'].'</p>':''; ?>
<?=($atribut['bil_bilikmandi'])? '<p><label>Bil. Bilik Mandi:</label> '.$atribut['bil_bilikmandi'].'</p>':''; ?>
<?=($atribut['kelengkapan'])? '<p><label>Kelengkapan:</label> '.$atribut['kelengkapan'].'</p>':''; ?>

<?php endif; ?>