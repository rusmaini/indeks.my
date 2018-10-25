<div class="contentbox">

	<?= $this->session->flashdata('notice');?>
	
	<h3>Informasi</h3>
	
	
	<p>Panduan tambah modul:</p>
	
	<ul>
		<li>Tambah modul di menu Konfigurasi &rArr; Modul dan klik butang Baru.</li>
		<li>Simpan ID modul.</li>
		<li>Bina fail Controller baru bagi mewakili modul baru di application/controllers/.</li>
		<li>Pada function __construct, tambahkan kod berikut:<br />
			<code>
			//check permission<br />
			//id modul baru = ?<br />
			if(!$this->Mpermission->check($this->session->userdata('group_id'),?)) redirect('home/noaccess');
			</code>
		</li>
		<li>Gantikan tanda soal (?) dengan ID modul baru.</li>
		<li>Tetapkan Had Capaian bagi modul tersebut di Konfigurasi &rArr; Had Capaian (Hanya Admin sahaja).</li>
	</ul>
</div>