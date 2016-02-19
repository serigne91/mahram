<?php
	include ("../conex.inc");
	
	function getHHTPVars($name, $POST, $GET)
{
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
$trombibox = getHHTPVars('trombibox', $_POST, $_GET);
$potins = getHHTPVars('potins', $_POST, $_GET);
$conexbox = getHHTPVars('conexbox', $_POST, $_GET);

	
if ($Id=='ADMIN') {

?>
<html>
	<head>
		<title>Tr@mbyn</title>
				<link rel="Shortcut Icon" href="http://elzitoun.free.fr/trombyn/favicon.ico">

	</head>
	<body bgcolor="#C0C0C0">
		<img src="../images/logotrombyn.gif">

<?php
$lekey=3;
	include("menusa.php");
?>	
				
<TABLE WIDTH="100%" border="0">
<TR>
<TD valign="top">
		
</TD>
</TR>
<?php
if ($potins=="oui") {
	echo "<tr><td colspan=2>";
	include ("potins.php");
	echo "</td></tr>";
}
if ($conexbox=="oui") {
	include ("etat_conex.php");
}
?>
</TABLE>
		
	</body>
</html>

<?php } else {
	
	header("Location: ../index.php"); }