<HTML>
<HEAD>
<TITLE>Insertion d'images</TITLE>

<STYLE TYPE="text/css">
 BODY   {margin-left:10; font-family:Verdana; font-size:12; background:menu}
 BUTTON {width:5em}
 P      {text-align:center}
 TABLE  {cursor:hand}
</STYLE>

<SCRIPT LANGUAGE=JavaScript FOR=ColorTable EVENT=onclick>
  SelColor.value = event.srcElement.title;
</SCRIPT>

<SCRIPT LANGUAGE=JavaScript FOR=ColorTable EVENT=onmouseover>
  text = event.srcElement.title;
  var idx = text.lastIndexOf('/') ;
  var idx1 = text.lastIndexOf('.') ;
  text= text.substring(idx+1,idx1) ;

  RGB.innerText = text;
</SCRIPT>

<SCRIPT LANGUAGE=JavaScript FOR=ColorTable EVENT=onmouseout>
  RGB.innerText = " ";
</SCRIPT>

<SCRIPT LANGUAGE=JavaScript FOR=Ok EVENT=onclick>
  window.returnValue = SelColor.value;
  window.close();
</SCRIPT>

</HEAD>

<body bgcolor="#ff9933" text="#FFFFFF">
<br>
<P>

<TABLE ID=ColorTable BORDER=1
 BORDERCOLOR=SILVER BORDERCOLORLIGHT=WHITE BORDERCOLORDARK=BLACK
 CELLSPACING=0 CELLPADDING=0>
 
<? $rep = "../galerie/uploadimg/";
$dir = opendir($rep); ?>

<? function dd($date) {
   return date("d/m/Y H:i:s",$date);
}
$i=0;
while ($f = readdir($dir)) {
   if(is_file($rep.$f)) {
	   if ($i=='4') {
	   		echo "</tr><tr>";
	   		echo "<td><img src='../galerie/uploadimg/".$f."' width='50' title='../galerie/uploadimg/".$f."'></td>";
	   		$i=0;
   	   } else {
	   		echo "<td><img src='../galerie/uploadimg/".$f."' width='50' title='../galerie/uploadimg/".$f."'></td>";
       }
       $i=$i+1;
   }
} ?>
 
</table>
<? closedir($dir); ?>


<P>
<LABEL FOR=SelColor>Image</LABEL>
<INPUT TYPE=TEXT SIZE=20 ID=SelColor>
<BR>
<SPAN ID=RGB>&nbsp;</SPAN>

<P>
	<BUTTON ID=Ok TYPE=SUBMIT>OK</BUTTON>
	<BUTTON ONCLICK="window.close();">Cancel</BUTTON>
<hr>
<?php
if ($varclose=="choix") {
	?>
	<script>
		window.close();
	</script>
	<?php
} else { ?>

	<body bgcolor="#ff9933" text="#FFFFFF">
	<form action="image2.php3" method="post" enctype="multipart/form-data">

	   <input type="hidden" name="MAX_FILE_SIZE" value="1000000"> 
	   <input type="hidden" name="varclose" value="choix"> 
	   <input type="file" name="toto" size="40" maxlength="80"> 
	   <input type="submit" value="Envoyer" onclick=""> 
	   <BUTTON ONCLICK="window.close();">Cancel</BUTTON>
		<BUTTON ONCLICK="document.refresh();">Reload</BUTTON>
	</form>
<?php } ?>

<?php 
if(isset ($toto)) 
{ 
   copy($toto, "fichiers//$toto_name");

} 
?> 
</BODY>
</HTML>
  