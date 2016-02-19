<?php
include("../aqua_haut.htm");
?>

	<!--<a href="indexsa.php?trombibox=<?php if ($trombibox=='oui') { echo 'non'; } else { echo 'oui'; } ?>&coordosbox=<?php echo $coordosbox ?>&conexbox=<?php echo $conexbox ?>"><img src="../images/creermini.gif" border="0"><font color="green" size="2"> Trombinoscope</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
	<a href="indexsa.php?conexbox=<?php if ($conexbox=='oui') { echo 'non'; } else { echo 'oui'; } ?>&coordosbox=<?php echo $coordosbox ?>&trombibox=<?php echo $trombibox ?>"><img src="../images/conexmini.gif" border="0"><font color="green" size="2"> Connexion</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="../deconex.php"><img src="../images/deconexmini.gif" border="0"><font color="green" size="2"> Deconex</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="indexsa.php?potins=<?php if ($potins=='oui') { echo 'non'; } else { echo 'oui'; } ?>"><img src="../images/listmini.gif" border="0"><font color="green" size="2"> Potins</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
</font>

<?php

include ("../aqua_bas.htm");
?>