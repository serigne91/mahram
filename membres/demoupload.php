<HTML><BODY><CENTER>

<?
// Taille max des fichiers (octets)
$MFS=1024000;
// Répertoire de stockage
$rep="upload/";

if(isset($_FILES['userfile'])) {
if($_FILES['userfile']['size']>0) {
   $savefile= $rep.$_FILES['userfile']['name'];
   $temp = $_FILES['userfile']['tmp_name'];
   if (move_uploaded_file($temp, $savefile)) { ?>
      <b>Votre fichier a bien été enregistré !</b>
<BR>Nom : <?echo $_FILES['userfile']['name'];?>
<BR>Taille : <?echo $_FILES['userfile']['size'];?> o
<BR>Type : <?echo $_FILES['userfile']['type'];?>
<?   } else { ?>
      <b>Erreur d'enregistrement !</b>
   <? }

} else { ?>
   <b>Trop gros fichier !</b>
   <i>( <? echo $MFS;?> octets max.)</i>
<? } 
} ?>
   
<FORM METHOD="POST"
      ENCTYPE="multipart/form-data">
   <INPUT TYPE=HIDDEN NAME=MAX_FILE_SIZE
      VALUE=<? echo $MFS;?>>
   <INPUT TYPE=FILE NAME="userfile"><BR>
   <INPUT TYPE=SUBMIT value="Enregistrer le fichier">
</FORM>

LISTE DES FICHIERS TELECHARGES
<BR><TABLE border>
<? $dir = opendir($rep);

while ($f = readdir($dir))
   if(is_file($rep.$f)) { ?>
      <TR>
         <TH>
            <A href="<? echo $rep.$f; ?>"
               target="_blank"><? echo $f; ?></A>
         </TH>
         <TD align=right><? echo filesize($rep.$f); ?></TD>
         <TD>
            <? echo date("d/m/Y H:i:s",filectime($rep.$f)); ?>
         </TD></TR>
   <? }

closedir($dir); ?>
</TABLE>

</CENTER></BODY></HTML>