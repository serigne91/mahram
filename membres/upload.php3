<body bgcolor="#ff9933" text="#FFFFFF">
	<form action="upload.php3" method="post" 
enctype="multipart/form-data"> 

   <input type="hidden" name="MAX_FILE_SIZE" value="100000"> 
   <input type="file" name="toto" size="40" maxlength="80"> 
   <input type="submit" value="Envoyer"> 

</form>


<?php 
if(isset ($toto)) 
{ 
   copy($toto, "fichiers//$toto_name"); 
} 
?> 