<?php
    //loome AB ühenduse
    /*  
        // config_global.php
        $servername = "";
        $server_username = "";
        $server_password = "";
    
    */
    require_once("../config_global.php");
    $database = "kelllep";
	
	//paneme sessiooni serveris tööle, saaame kasutada SESSION[]
    session_start();
   
	function logInUser($email, $hash){
		
		//GLOBALS saab kätte kõik muutujad mis kasutusel		
		//muutuja väljaspool funktsiooni
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
        $stmt->bind_param("ss", $email, $hash);
        $stmt->bind_result($id_from_db, $email_from_db);
        $stmt->execute();
        if($stmt->fetch()){
			//saime andmed kätte
			
			
			echo "Kasutaja logis sisse id=".$id_from_db;
			
			//sessioon, salvestatakse serveros
			$_SESSION['logged_in_user_id'] = $id_from_db;
			$_SESSION['logged_in_user_email'] = $email_from_db;
			
			//suuname kasutaja teisele lehele
			header("Location: data.php");
			
        }else{
            echo "Wrong credentials!";
        }
        $stmt->close();
		$mysqli->close();
		
	}
	
	function createUser($create_email, $hash){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?,?)");
        $stmt->bind_param("ss", $create_email, $hash);
        $stmt->execute();
        $stmt->close();
		
		$mysqli->close();	
	}
	
	function createCarPlate($plate, $car_color) {
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
        $stmt = $mysqli->prepare("INSERT INTO car_plates (user_id, number_plate, color) VALUES (?,?,?)");
        // i - on user_id INT
        $stmt->bind_param("iss", $_SESSION['logged_in_user_id'], $plate, $car_color);
        
		
		$message = "";
		if ($stmt->execute()){
			//õnnestus
			$message = "edukalt andmebaasi salvestatud!";
			
		}
		$stmt->close();
        
        $mysqli->close();
		
		//saadan sõnumi tagasi
		return $message;
	}
	
	function getAllData(){
		
		$mysqli = new mysqli($GLOBALS["servername"])
		
		$stmt = $mysqli->prepare("SELECT id, user_id, number")
		$stmt->bind_param($id_from_db, $user_id_from_db, $number)
	}
	
	
?>