<div <?php if($_GET['/'] == ''){ echo "hidden";} else { echo "";}?>><br>
	<form action="" method="post">
		<div class="card-body">
	        <b>- Persyaratan & biaya Kursus <?php if($_GET['/'] == 'komreg'){ echo "Komputer Reguler";} if($_GET['/'] == 'kompri'){ echo "Komputer Privat";} if($_GET['/'] == 'tek'){ echo "Teknisi Komputer";} if($_GET['/'] == 'komdg'){ echo "Desain Grafis";} if($_GET['/'] == '6'){ echo "Mengemudi Mobil 6 Jam";}if($_GET['/'] == '8'){ echo "Mengemudi Mobil 8 Jam";}if($_GET['/'] == '10'){ echo "Mengemudi Mobil 10 Jam";}if($_GET['/'] == '12'){ echo "Mengemudi Mobil 12 Jam";}?></b><br> 
	        1. Mengisi Formulir Pendaftaran <br>
	        2. Membawa Pas foto uk. 3x4 (3 lembar) <br>
	        3. Foto Copy KTP 1 Lembar ( bagi yang sudah mempunyai Ktp)<br>
	        4. Jadwal Kursus di tentukan oleh Pihak LPK prima ( berlaku kursus komp. reguler)<br>
	        5. Jadwal Kursus Bebas Di tentukan Oleh Siswa Kursus ( Berlaku kursus Komp. Privat & Mengemudi)<br>
	        6. Biaya Kursus <?php if($_GET['/'] == 'komreg'){ echo "Komputer Reguler <b>Rp. 500.000</b>";} if($_GET['/'] == 'kompri'){ echo "Komputer Privat <b>Rp. 750.000</b>";} if($_GET['/'] == 'tek'){ echo "Teknisi Komputer <b>Rp. 1.200.000</b>";} if($_GET['/'] == 'komdg'){ echo "Desain Grafis <b>Rp. 950.000</b>";} if($_GET['/'] == '6'){ echo "Mengemudi Mobil 6 Jam <b>Rp. 525.000</b>";}if($_GET['/'] == '8'){ echo "Mengemudi Mobil 8 Jam <b>Rp. 680.000</b>";}if($_GET['/'] == '10'){ echo "Mengemudi Mobil 10 Jam <b>Rp. 825.000</b>";}if($_GET['/'] == '12'){ echo "Mengemudi Mobil 12 Jam <b>Rp. 940.000</b>";}?><br>
	        7. Jika ingin mendapatkan promo silahkan datang langsung ke LPK PRIMA. Dan masukan kode promo tersebut dibawah ini !!<p><center><input type="text" name="kodepromo" id="kodepromo" onkeyup="cek()" placeholder="Masukan Kode Promo" class="form-control"></center><hr><b>- Biodata Calon Peserta Kursus</b><br> 
	        <input type="text" name="nama" onkeyup="cek()" placeholder="Masukan Nama Lengkap" class="form-control mt-2" required>
	        <input type="text" name="tptlhr" placeholder="Masukan Tempat Lahir" class="form-control mt-1">
	        <input type="text" name="tgllhr" placeholder="Masukan Tanggal Lahir" class="form-control mt-1" onfocus="(this.type='date')">
	        <input type="text" name="ortu" placeholder="Masukan Nama Orang Tua" class="form-control mt-1">
	        <select name="jk" class="form-control mt-1" >
	           <option> -- Pilih Jenis Kelamin -- </option>
	           <option value="Laki-laki">Laki-laki</option>
	           <option value="Perempuan">Perempuan</option>
	         </select>                           
	         <select name="agama" class="form-control mt-1" >
	           <option> -- Pilih Agama -- </option>
	           <option value="Islam">Islam</option>
	           <option value="Kristen">Kristen</option>
	           <option value="Protestan">Protestan</option>
	           <option value="Katolik">Katolik</option>
	           <option value="Hindu">Hindu</option>
	           <option value="Buddha">Buddha</option>
	           <option value="Khonghucu">Khonghucu</option>
	         </select>                                                  
	          <input type="text" name="pekerjaan" placeholder="Masukan Pekerjaan" class="form-control mt-1">
	          <input type="text" name="pendter" placeholder="Masukan Pendidikan Terakhir" class="form-control mt-1">
	          <textarea placeholder="Masukan Alamat" name="alamat" class="form-control mt-1" rows="5"></textarea> 
	          <input type="text" name="nohp" placeholder="Masukan Nomor Handphone" class="form-control mt-1">
	        <?php  include '../kon.php'; $nosiswa = mysqli_query($kon, "SELECT * FROM peserta"); $datapeserta = mysqli_num_rows($nosiswa); $pangid =($datapeserta+1); $idkursuspang = "ID-" . sprintf("%04s", $pangid);?> 
	        <input type="hidden" name="idkursus" value="<?php echo $idkursuspang; ?>">
	        <input type="hidden" name="untuk" value="<?php echo $_GET['/']; ?>">
	        <input type="hidden" name="stp" id="stp">
	        <input type="hidden" name="biaya" value="<?php if($_GET['/'] == 'komreg'){ echo "500000";} if($_GET['/'] == 'kompri'){ echo "750000";} if($_GET['/'] == 'tek'){ echo "1200000";} if($_GET['/'] == 'komdg'){ echo "950000";} if($_GET['/'] == '6'){ echo "525000";}if($_GET['/'] == '8'){ echo "680000";}if($_GET['/'] == '10'){ echo "825000";}if($_GET['/'] == '12'){ echo "940000";}?>">
	        <hr><b>- Rincian</b><br> 
	          1. Foto atau screenshot pada bagian lingkaran hijau dihalaman dibawah ini untuk menyimpan ID Kursus<br>
		      2. Langsung lakukan pembayaran ke LPK Prima untuk menyelesaikan pendaftaran<br>
		      3. Biaya bisa berubah menjadi biaya awal jika diskon telah berakhir<br><br>
		      <div style="border-color: #0AFF2D; border-style: outset; border-radius: 10px;";>
		        <table width="100%">
		          <tr><td colspan="2" align="center"><br><h2>ID PESERTA : <?php echo $idkursuspang; ?></h2><br></td></tr>
		          <tr><td colspan="2"><hr color="#0AFF2D" size="10px"></td></tr>
		          <tr><td width="20%">&nbsp;&nbsp;Keterangan Diskon</td><td><b id="ket"></b></td></tr>
		          <tr>
		            <td width="20%">&nbsp;&nbsp;Total Biaya Pembayaran</td>
		            <td><b id="hilang" ><?php if($_GET['/'] == 'komreg'){ echo "<b>Rp. 500.000</b>";} if($_GET['/'] == 'kompri'){ echo "<b>Rp. 750.000</b>";} if($_GET['/'] == 'tek'){ echo "<b>Rp. 1.200.000</b>";} if($_GET['/'] == 'komdg'){ echo "<b>Rp. 950.000</b>";} if($_GET['/'] == '6'){ echo " <b>Rp. 525.000</b>";}if($_GET['/'] == '8'){ echo " <b>Rp. 680.000</b>";}if($_GET['/'] == '10'){ echo " <b>Rp. 825.000</b>";}if($_GET['/'] == '12'){ echo " <b>Rp. 940.000</b>";}?></b><b id="bayar"></b></td>
		          </tr>
		          <tr><td colspan="2"><hr color="#0AFF2D" size="10px"></td></tr>
		        </table>
		      </div>
		      <br><center><button class="btn btn-info" name="daftar" type="submit">Daftar Kursus</button></center>
	    </div>
	</form>
</div>