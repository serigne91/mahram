<?php
$Id = $_COOKIE['Id'];
	
if ($Id=='OKDAK') {
	

?><html>
<title>C@ll.net</title>



<body bgcolor="#00CC99">

<table width="100%"><tr><td width=50%>
<?php

include("lectdir.php");
echo "</td><td valign=top>";
include("upload2.php");
?>
</tr></table>

<?php
} else {
	header('location:index.php');
}?>