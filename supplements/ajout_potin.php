<?php


//récupérations des variables
function getHTTPVars($name, $POST, $GET) {
 $value='';    
 if (isset($POST[$name])) {
  $value = $POST[$name];
 } elseif (isset($GET[$name])) {
  $value = $GET[$name];
 } else {
  $value = '';
 }
 return $value;
}


$Id = $_COOKIE['Id'];
if ($Id=='OKDAK') {
	
	
	
	include ("../conex.inc");

$potin = getHTTPVars("texte", $_POST, $_GET);
$nom = getHTTPVars("nom", $_POST, $_GET);

$potin=htmlentities($potin);
$nom=htmlentities($nom);

$dataj=Date("j/m/y");



   $query = "INSERT INTO potins (Date,Potins,nom) VALUES('$dataj','$potin','$nom')"; 
   $result = mysql_query($query);
	@mysql_query($result);
header("Location: ../membres/indexmf.php?potinbox=oui"); 
}
?>