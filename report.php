<?php
//mengeksekusi file koneksi.php
	include ('koneksi.php');
	//mengeksekusi library dompdf
	require_once("dompdf/autoload.inc.php");
	use Dompdf\Dompdf;
	//membuat konstruktor
	$dompdf = new Dompdf();
	//membaca data dari database
	$query = mysqli_query($conn,"select * from tb_siswa");
	//membuat script html
	$html='<center><h3>Daftar Nama Siswa</h3></center><hr/><br/>';
	$html .='<table border="1" width="100%">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Kelas</th>
			<th>Alamat</th>
		</tr>';
	$no=1;
	//menuliskan data pada script html
	while ($row=mysqli_fetch_array($query)) {
		$html.="<tr>
		<td>".$no."</td>
		<td>".$row['nama']."</td>
		<td>".$row['kelas']."</td>
		<td>".$row['alamat']."</td>
		</tr>";
		$no++;
	}
	$html.="</html>";
	$dompdf->loadHtml($html);
	//setting ukuran dan orientasi kertas
	$dompdf->setPaper('A4','potrait');
	//rendering dari HTML ke PDF
	$dompdf->render();
	//melakukan output ke file PDF
	$dompdf->stream('laporan_siswa.pdf');
 ?>
