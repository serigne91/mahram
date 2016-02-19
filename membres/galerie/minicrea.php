<?php
	

$nomfoto = $_GET["nomfoto"];

//création de la miniature
					//creation du nouveau nom
					$new_image_name="mini_".$nomfoto;
					//creation d'une image php assopciée à l'image jpeg parent du site
					$new_image=imagecreatefromjpeg("uploadimg/".$nomfoto);
					
					//rapport de taille pour avoir une largeur constante de 50 pixels
					$rapport = imagesx($new_image)/50;
					//echo $rapport;
					
					//creation du canvas du thumbnail
					$new_thumb=imagecreatetruecolor(imagesx($new_image)/$rapport,imagesy($new_image)/$rapport);
					
					

					
					//copie de l'image dans le thumbnail
					imagecopyresized($new_thumb,$new_image,0,0,0,0,imagesx($new_image)/$rapport,imagesy($new_image)/$rapport,imagesx($new_image),imagesy($new_image));
					
					//finalisation de la creation du thmbnail
					imagejpeg($new_thumb, "uploadmini/".$new_image_name, 50);
					
					 header("Location: ../indexmf.php?photos=oui"); 

		


?>