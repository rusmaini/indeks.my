
<br />
<!--<div class="sidebar-module sidebar-module-inset">-->	
	<!-- Menu Admin : Mula -->
	<?php if($this->session->userdata('logged_in') && $this->session->userdata('group_id')==1): ?>
		<ul class="nav">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin <b class="caret"></b></a>
				<ul class="dropdown-menu" id="swatch-menu">
					<li><?=anchor('home/informasi','Informasi')?></li>
					<li><?=anchor('permission','Had Capaian')?></li>
					<li><?=anchor('user','Pengguna')?></li>
					<li><?=anchor('group','Kumpulan Pengguna')?></li>
					<li><?=anchor('module','Modul')?></li>
					<li><?=anchor('setting','Seting')?></li>
				</ul>
			</li>
		</ul>
	<?php endif; ?>
	<!-- MODUL BIODATA -->
	<?php if($this->session->userdata('logged_in')): ?>
		<ul class="nav">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">Biodata <b class="caret"></b></a>
				<ul class="dropdown-menu" id="swatch-menu">
					<li><?=anchor('biodata/','Papar')?></li>
					<li><?=anchor('biodata/edit','Edit')?></li>
					<li><?=anchor('map/setlatlon','Set Lokasi')?></li>
				</ul>
			</li>
		</ul>
    <?php endif; ?>
     <!-- MODUL PROJEK-->
    <?php if($this->session->userdata('logged_in')): ?>
    	<ul class="nav">
    		<li><?=anchor('projek/','Projek')?></li>
    	</ul>
    <?php endif; ?>
<!--</div>-->
    
        
        
       
       
        
     