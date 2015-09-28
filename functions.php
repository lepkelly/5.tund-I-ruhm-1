<?php
    //functions.php
    //siia tulevad funktsioonid
    function hello1 ($name, $age){
		echo "Tere ".$name. "kes on ".$age." aastat vana";
	}
    
	function hello2 ($name){
		return "Tere ".$name;
	}
	
	echo "<br>";
	hello1("Juku", 5);
	echo "<br>";
	echo hello2("Juhan");
?>