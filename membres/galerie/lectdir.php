<script>

// Script Source: CodeLifter.com
// Copyright 2003
// Do not remove this notice.

// SETUPS:
// ===============================

// Set the horizontal and vertical position for the popup

PositionX = 100;
PositionY = 100;

// Set these value approximately 20 pixels greater than the
// size of the largest image to be used (needed for Netscape)

defaultWidth  = 500;
defaultHeight = 500;

// Set autoclose true to have the window close automatically
// Set autoclose false to allow multiple popup windows

var AutoClose = true;

// Do not edit below this line...
// ================================
if (parseInt(navigator.appVersion.charAt(0))>=4){
var isNN=(navigator.appName=="Netscape")?1:0;
var isIE=(navigator.appName.indexOf("Microsoft")!=-1)?1:0;}
var optNN='scrollbars=no,width='+defaultWidth+',height='+defaultHeight+',left='+PositionX+',top='+PositionY;
var optIE='scrollbars=no,width=150,height=100,left='+PositionX+',top='+PositionY;
function popImage(imageURL,imageTitle){
if (isNN){imgWin=window.open('about:blank','',optNN);}
if (isIE){imgWin=window.open('about:blank','',optIE);}
with (imgWin.document){
writeln('<html><head><title>Loading...</title><style>body{margin:0px;}</style>');writeln('<sc'+'ript>');
writeln('var isNN,isIE;');writeln('if (parseInt(navigator.appVersion.charAt(0))>=4){');
writeln('isNN=(navigator.appName=="Netscape")?1:0;');writeln('isIE=(navigator.appName.indexOf("Microsoft")!=-1)?1:0;}');
writeln('function reSizeToImage(){');writeln('if (isIE){');writeln('window.resizeTo(100,100);');
writeln('width=100-(document.body.clientWidth-document.images[0].width);');
writeln('height=100-(document.body.clientHeight-document.images[0].height);');
writeln('window.resizeTo(width,height);}');writeln('if (isNN){');       
writeln('window.innerWidth=document.images["George"].width;');writeln('window.innerHeight=document.images["George"].height;}}');
writeln('function doTitle(){document.title="'+imageTitle+'";}');writeln('</sc'+'ript>');
if (!AutoClose) writeln('</head><body bgcolor=000000 scroll="no" onload="reSizeToImage();doTitle();self.focus()">')
else writeln('</head><body bgcolor=000000 scroll="no" onload="reSizeToImage();doTitle();self.focus()" onblur="self.close()">');
writeln('<img name="George" src='+imageURL+' style="display:block"></body></html>');
close();		
}}

</script>

<?php
$Id = $_COOKIE['Id'];
	
if ($Id=='OKDAK') {

	

include("../aqua_haut.htm");
include ("../conex.inc");

?>

<div align="left"><font size="5" color="#44efi"><b>Galerie</b></font></div>
<font size=2 color=purple><i><b>Cliquez sur l'image pour la voir en grand !</font>
<?php


echo "<table width=100%>";

			$ligne=1;
				$i=0;
				
					$count=0;
				
				$query = "SELECT * FROM foto GROUP BY id desc LIMIT $count, 10";
				//echo $query;
				$result = mysql_query($query);
				// tant qu'il y a des fiches
				while ($val = mysql_fetch_array($result)) {
					$i=$i+1;
				$limag = urlencode($val["url"]);
				$lacateg = urlencode($val["categorie"]);	
				?>
						<tr>
							<td align="left"bgcolor="<?php	if ($ligne==1) { echo "#E4E4E4"; } else {  echo "";  } ?>"  width="10%"><a href=javascript:popImage('galerie/uploadimg/<?php echo $limag; ?>','<?php echo $lacateg; ?>')><img src="galerie/uploadmini/<?php echo "mini_".$limag; ?>" border="0" width="70"></a></td>
							<td align="right"bgcolor="<?php	if ($ligne==1) { echo "#E4E4E4"; } else {  echo "";  } ?>"  width="10%"><font face="Trebuchet MS, Comic Sans MS" size=2 color="black"><b><i><?php echo $val["categorie"]; ?></i></b></font></td>
							<td align=center bgcolor="<?php	if ($ligne==1) { echo "#E4E4E4"; } else {  echo "";  } ?>" width="70%" colspan="2"><font face="Trebuchet MS, Comic Sans MS" size=2 color="black"><?php echo $val["description"]; ?></font></td>
						</tr>
				<?php

					if ($ligne==1) {
						$ligne=0;
					} else {
						$ligne=1;
					}
				}
echo "</table>";
include("../aqua_bas.htm");


} else {
	echo "non autorisé";
}?>