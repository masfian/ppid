<?php
	require '../../engine/db_config.php';

	$idartikel 	= $_POST['idart']; 
	$kat 		= $_POST['katskpd']; 
	$jd 		= $_POST['judul']; 
	$is 		= $_POST['isi']; 
	$ft 		= $_FILES['foto']['name'];
	$tm 		= $_FILES['foto']['tmp_name'];
	$us 		= $_POST['user'];

	$fotobaru 	= date('dmYHis').$ft;
	$path 		= '../../uploadimgartikel/'.$fotobaru;

	$fotosimpan ='./uploadimgartikel/'.$fotobaru;

	if(move_uploaded_file($tm, $path)){
		$response = array(
    		'status'=>'sukses', // Set status
    		'pesan'=>'Data berhasil disimpan' // Set pesan
   		);
	}else{
		$response = array(
    		'status'=>'gagal', // Set status
    		'pesan'=>'Data gagal disimpan' // Set pesan
   		);
	}

	echo json_encode($response);

	$timezone = "Asia/Singapore";
	date_default_timezone_set($timezone);
	$date = date('Y-m-d H:i:s');
	$sql = "UPDATE artikel SET  
		IDSKPD     = '".$kat."', 
		JUDULARTIKEL    = '".$jd."', 
		ISIARTIKEL = '".$is."', 
		IMG         = '".$fotosimpan."', 
		USER        = '".$us."', 
		DATECREATE = '".$date."' WHERE IDARTIKEL = '".$idartikel."'";
	$result = $mysqli->query($sql);
	$sql = "SELECT * FROM artikel WHERE IDARTIKEL = '".$idartikel."'"; 
	$result = $mysqli->query($sql);
	$data = $result->fetch_assoc();
	// echo json_encode($data);
	
?>