<?php

//echo "--".$lekeyref."--".$valid."--".$err."--";

setcookie('lekey', $lekeyref,  time() + 60*60*24*30, '/');

if ($lekeyref=='3') {
header("location:../superadmin/indexsa.php?coordosbox=oui");
} else {
	
header("location:indexmf.php?coordosbox=oui");
}
?>