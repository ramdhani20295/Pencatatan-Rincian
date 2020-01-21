<?php
include 'config.php';

require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");


$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->Image('../logo/malasngoding.png',1,1,2,2);
$pdf->SetX(4);            
$pdf->MultiCell(19.5,0.5,'KIOS MALASNGODING',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Telpon : 0038XXXXXXX',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'JL. KIOS MALASNGODING',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'website : www.malasngoding.com email : malasngoding@gmail.com',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"Laporan Data Barang",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'tanggal', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Suplier', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'harga', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'qty', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'satuan', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'subtotal', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$query=mysql_query("SELECT * FROM barang WHERE tanggal BETWEEN '$start_date' AND '$end_date'");
while($lihat=mysql_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(2.5, 0.8, $lihat['tanggal'], 1, 0,'C');
	$pdf->Cell(5, 0.8, $lihat['nama'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['suplier'],1, 0, 'C');
	$pdf->Cell(2.5, 0.8, $lihat['harga'], 1, 0,'C');
	$pdf->Cell(1.5, 0.8, $lihat['qty'],1, 0, 'C');
	$pdf->Cell(2.5, 0.8, $lihat['satuan'], 1, 0,'C');
	$pdf->Cell(3, 0.8, $lihat['subtotal'], 1,1,'C');
	$no++;
	$total1 = $lihat['subtotal'];
$total[] = $total1;
$total_nilai = array_sum($total);
}
$pdf->SetFont('Arial','',10);
$pdf->Cell(18,0.8, 'Total',1,0,'C');
$pdf->Cell(3,0.8, $total_nilai,1,1,'C');

// $start_date = $_POST['start_date'];
// $end_date = $_POST['end_date'];
// $conn = mysql_connect('localhost','root','','malasngoding_kios');
// $query = mysql_query($conn, "SELECT * FROM barang WHERE tanggal BETWEEN '$start_date' AND '$end_date'");
// while($lihat = mysql_fetch_array($query)){
// 	$total = array_sum($lihat['subtotal']);
// 	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
// 	$pdf->Cell(2.5, 0.8, $lihat['tanggal'], 1, 0,'C');
// 	$pdf->Cell(5, 0.8, $lihat['nama'],1, 0, 'C');
// 	$pdf->Cell(3, 0.8, $lihat['suplier'],1, 0, 'C');
// 	$pdf->Cell(2.5, 0.8, $lihat['harga'], 1, 0,'C');
// 	$pdf->Cell(1.5, 0.8, $lihat['qty'],1, 0, 'C');
// 	$pdf->Cell(2.5, 0.8, $lihat['satuan'], 1, 0,'C');
// 	$pdf->Cell(3, 0.8, $lihat['subtotal'], 1,1,'C');
// 	$pdf->Cell(4, 0.8, $total, 1,1,'C');
// 	$no++;
// }


$pdf->Output("laporan_buku.pdf","I");

?>

