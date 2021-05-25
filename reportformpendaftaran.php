<?php
//deklarasi variabel konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "latihan2";

//deklarasi varibel untuk koneksi database
$koneksi = mysqli_connect($servername, $username, $password, $dbname);

//cek Koneksi
if (!$koneksi) {
  die("Connection failed: " . mysqli_connect_error());
}

///mengeksekusi library dompdf
	require_once("dompdf/autoload.inc.php");
	use Dompdf\Dompdf;
	//membuat konstruktor
	$dompdf = new Dompdf();
	//membaca data dari database
	$query = mysqli_query($koneksi,"select * from pendaftaran");
	//membuat script HTML
	$html='<html><hr><center><h3>Daftar Nama Pendaftar</h3></center><hr/><br/>';
	$html .='<table border="1" width="100%" style="table-layout: fixed">
		<tr>
			<td>Jenis Pendafaran</td>
			<td>Tanggal Masuk</td>
			<td>NIS</td>
			<td>Nomor Peserta Ujian</td>
			<td>Pernah Paud?</td>
			<td>Pernah TK?</td>
			<td>No. SKHUN Sebelumnya</td>
			<td>No. Ijazah Sebelumnya</td>
			<td>Hobi</td>
			<td>Cita-Cita</td>
			<td>Nama Lengkap</td>
			<td>Jenis Kelamin</td>
			<td>No NISN</td>
			<td>No NIK</td>
			<td>Tempat Lahir</td>
			<td>Tanggal Lahir</td>
			<td>Agama</td>
			<td>Berkebutuhan Khusus</td>
			<td>Alamat</td>
			<td>RT</td>
			<td>RW</td>
			<td>Nama Dusun</td>
			<td>Nama Kelurahan/Desa</td>
			<td>Nama Kecamatan</td>
			<td>Kode Pos</td>
			<td>Tempat Tinggal</td>
			<td>Moda Transportasi</td>
			<td>No HP</td>
			<td>No Telp</td>
			<td>Email Pribadi</td>
			<td>Penerima KPS/PKH/KIP</td>
			<td>No KPS/PKH/KIP</td>
			<td>Kewarganegaraan</td>
		</tr>';
	$no=1;
	//menuliskan data pada script html
	while ($row=mysqli_fetch_array($query)) {
		$html.="<tr>
		<td>".$row['jenis_pendaftaran']."</td>
		<td>".$row['tanggal_masuk']."</td>
		<td>".$row['nis']."</td>
		<td>".$row['nomor_peserta']."</td>
		<td>".$row['paud']."</td>
		<td>".$row['tk']."</td>
		<td>".$row['no_skhun']."</td>
		<td>".$row['no_ijazah']."</td>
		<td>".$row['hobi']."</td>
		<td>".$row['cita_cita']."</td>
		<td>".$row['jenis_kelamin']."</td>
		<td>".$row['nama']."</td>
		<td>".$row['nisn']."</td>
		<td>".$row['nik']."</td>
		<td>".$row['tempat_lahir']."</td>
		<td>".$row['tanggal_lahir']."</td>
		<td>".$row['agama']."</td>
		<td>".$row['berkebutuhan_khusus']."</td>
		<td>".$row['alamat']."</td>
		<td>".$row['rt']."</td>
		<td>".$row['rw']."</td>
		<td>".$row['dusun']."</td>
		<td>".$row['kelurahan']."</td>
		<td>".$row['kecamatan']."</td>
		<td>".$row['kode_pos']."</td>
		<td>".$row['tempat_tinggal']."</td>
		<td>".$row['transportasi']."</td>
		<td>".$row['no_hp']."</td>
		<td>".$row['no_telp']."</td>
		<td>".$row['email']."</td>
		<td>".$row['penerima_kps']."</td>
		<td>".$row['no_kps']."</td>
		<td>".$row['kewarganegaraan']."</td>
		</tr>";
	}
	$html.="</html>";
	$dompdf->loadHtml($html);
	//setting ukuran dan orientasi kertas
	$dompdf->setPaper('A0','landscape');
	//rendering dari HTML ke PDF
	$dompdf->render();
	//melakukan output ke file PDF
	$dompdf->stream('laporan_pendaftaran_siswa.pdf');
?>
