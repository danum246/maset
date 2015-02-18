<?php

function hari($day){
	$days = array(
	'Sunday' => 'Minggu',
	'Monday' => 'Senin',
	'Tuesday' => 'Selasa',
	'Wednesday' => 'Rabu',
	'Thursday' => 'Kamis',
	'Friday' => 'Jumat',
	'Saturday' => 'Sabtu'
	);
	return $days[$day];
}

function total($kd_keluhan,$flag){
	if($flag=='all'){
		$sql = mysql_query("select count(*) as total from tbl_keluhan_pasien where kd_keluhan='$kd_keluhan'");
	}else{
		$sql = mysql_query("select count(*) as total from tbl_keluhan_pasien where kd_keluhan='$kd_keluhan' and status_pasien='$flag'");
	}
	$row = mysql_fetch_array($sql);
	return $row['total'];
}

function  indodate($tgl){
$tanggal  =  substr($tgl,8,2);
$bulan	=  getBulan(substr($tgl,5,2));
$tahun	=  substr($tgl,0,4);
return  $tanggal.' '.$bulan.' '.$tahun;
}

function  getBulan($bln){
switch  ($bln){
case  1:
return  "Januari";
break;
case  2:
return  "Februari";
break;
case  3:
return  "Maret";
break;
case  4:
return  "Maret";
break;
case  5:
return  "Mei";
break;
case  6:
return  "Juni";
break;
case  7:
return  "Juli";
break;
case  8:
return  "Agustus";
break;
case  9:
return  "September";
break;
case  10:
return  "Oktober";
break;
case  11:
return  "November";
break;
case  12:
return  "Desember";
break;
}
}

function show_pgn($kodes){
$pgn = explode(',',$kodes);
$plength = sizeof($pgn)-1;
for($n = 0; $n <= $plength; $n++){
$sql = mysql_query("select pangan from tbl_pangan where kd_pangan = '".$pgn[$n]."'");
$row = mysql_fetch_array($sql);
$pangan[] = $row['pangan'];
}
return implode(', ',$pangan);
}

$rowdata = $this->db->query("SELECT c.lembaga,d.kabupaten_kota,d.kelurahan,d.provinsi,d.kecamatan,d.id_kelurahan AS kelid,TIME(a.waktu_lapor) AS wkt,DAYNAME(a.waktu_lapor) AS hari,DATE(a.waktu_lapor) AS tgl,b.nama,b.hp,b.alamat,a.* FROM tbl_resume_keluhan a 
JOIN tbl_karyawan b ON a.`nik_pelapor` = b.`nik` 
JOIN tbl_lembaga c ON c.`id_lembaga` = a.`lembaga_id` 
join view_daerah d on d.`id_kelurahan` = a.`kelurahan_id`
where a.kd_keluhan = '$kode'")->row();

$pdf = new FPDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(190,10,'FORMULIR PENCATATAN',0,1,'C');
$pdf->Ln(0.3);
$pdf->Cell(190,10,'LAPORAN KEWASPADAAN KERACUNAN PANGAN',0,1,'C');
$pdf->Ln();

$pdf->SetFont('Arial','',11);

$pdf->Cell(70,10,'Nama Pelapor',0,0,'L');
$pdf->Cell(5,10,':',0,0,'C');
$pdf->Cell(100,10,$rowdata->nama,0,1,'L');
$pdf->Ln(0.1);
$pdf->Cell(70,10,'Nomor Telp',0,0,'L');
$pdf->Cell(5,10,':',0,0,'C');
$pdf->Cell(100,10,$rowdata->hp,0,1,'L');
$pdf->Ln(0.1);
$pdf->Cell(70,10,'Alamat',0,0,'L');
$pdf->Cell(5,10,':',0,0,'C');
$pdf->Cell(100,10,$rowdata->alamat,0,1,'L');
$pdf->Ln();

$pdf->MultiCell(190,10,'Melaporkan pada hari '.hari($rowdata->hari).', tanggal '.indodate($rowdata->tgl).' jam '.$rowdata->wkt.', terdapat kejadian keracunan pangan :');
$pdf->Ln(1);

$pdf->Cell(70,10,'Lokasi / Tempat Kejadian',0,0,'L');
$pdf->Cell(5,10,':',0,0,'C');
$pdf->Cell(100,10,$rowdata->kelurahan,0,1,'L');
$pdf->Ln(0.1);
$pdf->Cell(70,10,'Desa / Kelurahan',0,0,'L');
$pdf->Cell(5,10,':',0,0,'C');
$pdf->Cell(100,10,$rowdata->kelurahan,0,1,'L');
$pdf->Ln(0.1);
$pdf->Cell(70,10,'Kecamatan',0,0,'L');
$pdf->Cell(5,10,':',0,0,'C');
$pdf->Cell(100,10,$rowdata->kecamatan,0,1,'L');
$pdf->Ln(0.1);
$pdf->Cell(70,10,'Kabupaten / Kota',0,0,'L');
$pdf->Cell(5,10,':',0,0,'C');
$pdf->Cell(100,10,$rowdata->kabupaten_kota,0,1,'L');
$pdf->Ln(0.1);
$pdf->Cell(70,10,'Provinsi',0,0,'L');
$pdf->Cell(5,10,':',0,0,'C');
$pdf->Cell(100,10,$rowdata->provinsi,0,1,'L');
$pdf->Ln(0.1);
$pdf->Cell(70,10,'Pangan Diduga Penyebab',0,0,'L');
$pdf->Cell(5,10,':',0,0,'C');
$pdf->Cell(100,10,show_pgn($rowdata->pangan_umum),0,1,'L');
$pdf->Ln(4);

$pdf->Cell(3,10,'a.',0,0,'C');
$pdf->Cell(80,10,'Jumlah Korban Sakit '.total($rowdata->kd_keluhan,'1').' orang',0,1,'L');
$pdf->Ln(0.1);
$pdf->Cell(3,10,'b.',0,0,'C');
$pdf->Cell(80,10,'Jumlah Korban Meninggal '.total($rowdata->kd_keluhan,'2').' orang',0,1,'L');
$pdf->Ln(4);

$pdf->Cell(100,10,'Gejala - gejala yang ditemui adalah antara lain :',0,1,'L');
$pdf->Ln(0.1);

$gejala = $this->db->query("select gejala_umum from tbl_resume_keluhan where kd_keluhan = '".$rowdata->kd_keluhan."'")->row()->gejala_umum;
$kd_gjl = explode(',',$gejala);
$lgejala = sizeof($kd_gjl)-1;
for($n = 0; $n<= $lgejala; $n++){
		$pdf->Cell(60,10,$this->db->query("select gejala from tbl_gejala where kd_gejala = '".$kd_gjl[$n]."'")->row()->gejala,0,0,'L');
		$pdf->Cell(5,10,'('.$this->db->query("select count(*) as total from tbl_keluhan_pasien where kd_keluhan = '$rowdata->kd_keluhan' and kd_gejala like '%$kd_gjl[$n]%' ")->row()->total.')',0,0,'C');
		if(($n+1)%2==0){
			$pdf->Ln(10);
		}else{
			$pdf->Cell(3,10,' ',0,0,'C');
		}
}

/*$pdf->Cell(60,10,'Pusing',0,0,'L');
$pdf->Cell(5,10,'(12)',0,0,'C');
$pdf->Cell(3,10,' ',0,0,'C');
$pdf->Cell(60,10,'Mual',0,0,'L');
$pdf->Cell(5,10,'(12)',0,1,'C');
$pdf->Ln(0.1);
$pdf->Cell(60,10,'Kejang',0,0,'L');
$pdf->Cell(5,10,'(12)',0,0,'C');
$pdf->Cell(3,10,' ',0,0,'C');
$pdf->Cell(60,10,'Pingsan',0,0,'L');
$pdf->Cell(5,10,'(12)',0,1,'C');
$pdf->Ln(1);*/
$pdf->Ln(10);

$pdf->Cell(60,10,'Demikian catatan ini dibuat.',0,1,'L');
$pdf->Ln();

$pdf->Cell(145,10,$rowdata->kelurahan,0,0,'R');
$pdf->Cell(2,10,'/',0,0,'C');
$pdf->Cell(60,10,indodate($rowdata->tgl),0,1,'L');
$pdf->Ln();

$pdf->Cell(170,10,$rowdata->nama,0,1,'R');
$pdf->Ln(0.1);
$pdf->Cell(170,10,$rowdata->lembaga,0,1,'R');

$pdf->Output('FORM 1.pdf','D');

?>