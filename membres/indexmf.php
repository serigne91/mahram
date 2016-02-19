<?php
	
	require ("fonctions.inc");
	include ("../conex.inc");
	
	
$potinbox = getHTTPVars("potinbox", $_POST, $_GET);
$rediger = getHTTPVars("rediger", $_POST, $_GET);
$mailnaissbox = getHTTPVars("mailnaissbox", $_POST, $_GET);
$inscripts = getHTTPVars("inscripts", $_POST, $_GET);
$photos = getHTTPVars("photos", $_POST, $_GET);
$listbox = getHTTPVars("listbox", $_POST, $_GET);
$trombibox = getHTTPVars("trombibox", $_POST, $_GET);
$reftrombi = getHTTPVars("reftrombi", $_POST, $_GET);

$Id = $_COOKIE['Id'];
	
if ($Id=='OKDAK') {
	//setcookie('Id', 'OKDAK', mktime(0,0,0,1,1,2010));

?>
<html>
	<head>
		<title>Tr@mbyn</title>
				<link rel="SHORCUT ICON" href="https://zitounquat.free.fr/zitoun/trombyn/membres/favicon.ico">

		<script language="javascript">
			function showhide(what,what2) {
				if (what.style.display=='none') {
					what.style.display='';
				} else {
					what.style.display='none';
				}
			}

			
			function choisir(ModifPass,ModifId) {
				window.open('modif_fiche.php?ModifId='+FormName.ModifId.value+'&ModifPass='+FormName.ModifPass.value,'','location=0,status=0, width=400, height=550, scrollbars=0')
			}
		</script>
		
	</head>
	<body bgcolor="#C0C0C0">
		<img src="../images/logotrombyn.gif" style="width:100%">

<?php
$lekey=3;
	include("menumf.php");
?>	
				
<TABLE WIDTH="100%" border="0">
<TR>
<TD valign="top">

<?php

if ($potinbox=="oui") {
	include("../supplements/listepotin.php");
}

if ($rediger=="oui") {
	include("../supplements/rediger.php");
}

if ($mailnaissbox=="oui") {
	include("listmail.php");
}


if ($inscripts=="oui") {
	include("form.php");
}

if ($photos=="oui") {
	include("galerie/index.php");
}

?>
</TD>
<TD valign="top">
<?php				
if ($listbox=="oui") {
	include ("liste_inscrits.php");
}
?>		
</TD>
</TR>
<?php
if ($trombibox=="oui") {
	echo "<tr><td colspan=2>";
	include ("../trombi/indtrombi.php");
	echo "</td></tr>";
}
?>
</TABLE>
		
	</body>
</html>

<?php } else {
	
	header("Location: ../index.php"); }
	