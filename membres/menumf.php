<SCRIPT language="javascript">
    function popup(page) {
      window.open(page,'popup','width=300,height=420,toolbar=false,scrollbars=false');
    }
    function popupIns(page) {
      window.open(page,'popup','width=400,height=575,toolbar=false,scrollbars=false');
    }
</SCRIPT>

<?php

include ("../aqua_haut.htm");

//echo $lekey;
?>

	<a href="indexmf.php?potinbox=<?php if ($listbox=='oui') { echo 'non'; } else { echo 'oui'; } ?>&mailnaissbox=<?php echo $mailnaissbox ?>&inscripts=<?php echo $inscripts ?>&trombibox=<?php echo $trombibox ?>"><img src="../images/listmini.gif" border="0"><font color="green" size="2"> Potins</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	<a href="indexmf.php?trombibox=<?php if ($trombibox=='oui') { echo 'non'; } else { echo 'oui'; } ?>&mailnaissbox=<?php echo $mailnaissbox ?>&inscripts=<?php echo $inscripts ?>&listbox=<?php echo $listbox ?>"><img src="../images/creermini.gif" border="0"><font color="green" size="2"> Trombinoscope</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<!--<a href="indexmf.php?inscripts=<?php if ($inscripts=='oui') { echo 'non'; } else { echo 'oui'; } ?>&trombibox=<?php echo $trombibox ?>&listbox=<?php echo $listbox ?>"><img src="../images/coordosmini.gif" border="0"><font color="green" size="2"> Inscription</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
	<!--<a href="indexmf.php?listbox=<?php if ($listbox=='oui') { echo 'non'; } else { echo 'oui'; } ?>&mailnaissbox=<?php echo $mailnaissbox ?>&inscripts=<?php echo $inscripts ?>&trombibox=<?php echo $trombibox ?>"><img src="../images/listmini.gif" border="0"><font color="green" size="2"> Liste des inscripts</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
	<a href="indexmf.php?mailnaissbox=<?php if ($mailnaissbox=='oui') { echo 'non'; } else { echo 'oui'; } ?>&conexbox=<?php echo $conexbox ?>&listbox=<?php echo $listbox ?>&inscripts=<?php echo $inscripts ?>&trombibox=<?php echo $trombibox ?>"><img src="../images/mailmini.gif" border="0"><font color="green" size="2"> Mail & Naiss</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="indexmf.php?photos=<?php if ($photos=='oui') { echo 'non'; } else { echo 'oui'; } ?>&conexbox=<?php echo $conexbox ?>&listbox=<?php echo $listbox ?>&inscripts=<?php echo $inscripts ?>&trombibox=<?php echo $trombibox ?>"><img src="../images/fotomini.gif" border="0"><font color="green" size="2"> Photos</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href=javascript:popup('password.php')><img src="images/pwmini.gif" border="0"><font size="2" color="green"> Mot de passe oublié ?</a></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href=javascript:popupIns('inscript/popup01.php')><img src="../images/coordosmini.gif" border="0"><font color="green" size="2"> Inscription</a></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="../deconex.php"><img src="../images/deconexmini.gif" border="0"><font color="green" size="2"> Deconex</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<U>
<SPAN STYLE='color:blue;cursor:hand;'onClick='window.external.AddFavorite(location.href, document.title);'><img src="../favicon.ico" height=20><font color="green" size="2">Ajouter ce site aux favoris
</font></U>
		
		
<?php

include ("../aqua_bas.htm");

?>