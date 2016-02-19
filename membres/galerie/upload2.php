<?php
$Id = $_COOKIE['Id'];
	
if ($Id=='OKDAK') {

include("../aqua_haut.htm");
?>

<form action="galerie/upload.php" method="post" enctype="multipart/form-data">

<input type=hidden name="max_file_size" value="1024000">
	<font size="5" color="#44efi"><b><b>Ajouter une image</font>
	<br><br>
	Catégorie : &nbsp;&nbsp;&nbsp;<input type="text" name="categ" size="50"><br>
	Description : <input type="text" name="descript" size="50"><br>
	Images : <input type=file name="userfile"><br><br>
	<input type=submit value="Ajouter"><br>
</form>
<font color=purple size=2><b><i>PS : le nom de l'image ne doit pas comporter d'espaces<br>ni de caractères spéciaux et doit peser moins d'1Mo</i></font>
<?php
include("../aqua_bas.htm");

//$im = ImageCreate(100,100);
//$noir = ImageColorAllocate($im, 0, 0, 0);
//$noir = ImageColorAllocate($im, 255, 255, 255);
//ImageGif($im);
}
?>