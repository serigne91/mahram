<?php


setcookie('lekey', $lekey,  time() + 60*60*24*30, '/');

header("location:indexmf.php");

?>