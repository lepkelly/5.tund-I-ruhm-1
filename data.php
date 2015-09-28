<?php
    // k??mis seotud andmetabeliga, lisamine ja tabeli kujul esitamine
	require_once("functions.php");
	
	//kui kasutaja on sisse logitud, suuna teisele lehele
	//kontrollin kas sessiooni muutuja on olemas
	if(!isset($_SESSION['logged_in_user_id'])){
		header("Location: data.php");
	}
	
	//aadressireale tekkis ?logout=1
	if(isset($_GET["logout"])){
		//kustutame sessiooni muutjad
		session_destroy();
		header("Location: login.php");
	}

?>

Tere, <?=$_SESSION['logged_in_user_id'];?> 
<a href="?logout=1">Logi välja</a>