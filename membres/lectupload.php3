	<body bgcolor="#ff9933" text="#FFFFFF">
<?php
$rep = "fichiers/";
$dir = opendir($rep); ?>
 

<? function dd($date) {
   return date("d/m/Y H:i:s",$date);
}

while ($f = readdir($dir)) {
   if(is_file($rep.$f)) {
      echo "<li>Nom : <a href=fichiers/".$f.">".$f."</a>";
      echo "<li>Taille : ".filesize($rep.$f)." octets";
      echo "<li>Cr�ation : ".dd(filectime($rep.$f));
      echo "<li>Modification : ".dd(filemtime($rep.$f));
      echo "<li>Dernier acc�s : ".dd(fileatime($rep.$f));
      echo "<br><br>";
   }
} ?>
 

<? closedir($dir); ?>
 
