<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" id="AutoNumber1">
  <tr>
    <td width="50%">Sexe</td>
    <td width="50%">
    	<?php if ($sexe=="F") {
	    	echo "M<input type=hidden name=sexeC value=M>";
	    } else {
		    echo "F<input type=hidden name=sexeC value=F>";
		} ?>
	</td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD"><font color="red">*</font>Nom</td>
    <td width="50%" bgcolor="#CDCDCD"><input type="text" value="" name="nomC"></td>
  </tr>
  <tr>
    <td width="50%"><font color="red">*</font>Prenom</td>
    <td width="50%"><input type="text" value="" name="prenomC"></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD">Adresse</td>
    <td width="50%" bgcolor="#CDCDCD"><input type="text" value="" name="adresseC"></td>
  </tr>
  <tr>
    <td width="50%">Code Postal</td>
    <td width="50%"><input type="text" value="" name="cpC"></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD">Ville</td>
    <td width="50%" bgcolor="#CDCDCD"><input type="text" value="" name="villeC"></td>
  </tr>
  <tr>
    <td><font color="red">*</font>Date de Naissance</td>
    <td>J<input type="text" value="" name="jnaissC" size=2 maxlength=2>M<input type="text" value="" name="mnaissC" size=2 maxlength=2>A<input type="text" value="" name="anaissC" size=4 maxlength=4></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD"><font color="red">*</font>Email</td>
    <td width="50%" bgcolor="#CDCDCD"><input type="text" value="" name="mailC"></td>
  </tr>
  <tr>
    <td width="50%">Téléphone</td>
    <td width="50%"><input type="text" value="" name="foneC"></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD">Activité</td>
    <td width="50%" bgcolor="#CDCDCD"><input type="text" value="" name="activC"></td>
  </tr>
  <tr>
    <td width="50%">Autre</td>
    <td width="50%"><input type="text" value="" name="autreC"></td>
  </tr>
  <tr>
    <td width="50%" bgcolor="#CDCDCD"><font color="red">*</font>Mot de passe</td>
    <td width="50%" bgcolor="#CDCDCD"><input type="text" value="" name="passC"></td>
  </tr>
  <tr>
      <td valign="top">
    
<input type=hidden name="max_file_size" value="256000">
	Photo <input type=file name="userfileC"><br>
</td>
</tr>
</table>
