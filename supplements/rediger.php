	
	<?php
	if ($Id=='OKDAK') {

		 include("../aqua_haut.htm");
 ?>
<style>
#outils	{
			width: 262px;
			background: buttonface;
			border-top: 1px solid buttonhighlight;
			border-left: 1px solid buttonhighlight;
			border-bottom: 1px solid buttonshadow;
			border-right: 1px solid buttonshadow;
			margin: 0;
			text-align:right;
		  	}
			
.out	{
			background: buttonface; 
			border: 1px solid buttonface;
			margin: 1; 
			}
			
.over	{ 
			background: buttonface;
			border-top: 1px solid buttonhighlight;
			border-left: 1px solid buttonhighlight;
			border-bottom: 1px solid buttonshadow;
			border-right: 1px solid buttonshadow;
			margin: 1;
			}
</style>


<script language="Javascript">
function format(f) {
  var str = document.selection.createRange().text;
  document.formulaire.texte.focus();
  var sel = document.selection.createRange();
  sel.text = "<" + f + ">" + str + "</" + f + ">";
  return;
}
function lien() {
  var str = document.selection.createRange().text;
  document.formulaire.texte.focus();
  var lien = prompt("URL:","http://");
  if (lien != null) {
    var sel = document.selection.createRange();
	sel.text = "<a href=\"" + lien + "\">" + str + "</a>";
  }
  return;
}
</script>



</HEAD>
<BODY BGCOLOR="#F2E000" link="#000066" vlink="#6666FF" alink="#000066">

    
    
            <form name="formulaire" action="../supplements/ajout_potin.php" method="post">
				<font face="Comic Sans MS,Courier New,Courier,Monaco">Indiquez votre nom </font><input type="nom" name="nom" size="24">
                      <center>
                        <textarea cols="90" rows="10" name="texte"></textarea>
                      </center>
			<p><input type="submit" name="Envoyer" value="Envoyer"></p>
              </div>
            </form>

</body>
<script>QBPATH='.'; VISUAL=1; FULLCTRL=1</script>
<script src='quickbuild.js'></script>
<!-- #EndTemplate -->

<?php include("../aqua_bas.htm");
} ?>