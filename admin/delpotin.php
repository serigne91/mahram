<?php 
include ("../conex.inc");



 $query_string = getenv("QUERY_STRING");
 
 $env_array = split("&", $query_string);
 
 while (list($key, $val) = each($env_array)) {
	 list($name, $value) = split("=", $val);
 
     $name = urldecode($name);
     $value = urldecode($value);
 
     $$name = trim($value) ;
     //echo "<br>".$name."<br>".$value."<br>";
     if($value=="ON") {
	    //echo "jefface";
	    $sqlDel = "DELETE FROM potins WHERE Id='$name'"; 
	    //echo $sqlDel;
		$DELRes = mysql_query($sqlDel,$conexion);
     	mysql_query($DELRes);
     } else {
	     //echo "lefface pas";
     }
  }
header("location:indexsa.php?potins=oui");
?> 