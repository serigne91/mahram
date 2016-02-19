<?php

if ($id_key_refinscript<>'') {


$naiss=$anaiss."-".$mnaiss."-".$jnaiss;

switch ($RefInscript) {
	case "pere":
		include ("inscriptpere.php");
		break;
	case "mere":
		include("inscriptmere.php");
		break;
	case "enfant":
		include("inscriptenfant.php");
		break;
	case "conjoint":
		include("inscriptconjoint.php");
		break;
	case "cousin":
		include("___.php");
		break;
	case "gmere":
		include("___.php");
		break;
	case "gpere":
		include("___.php");
		break;
	default:
		include("___.php");
}


} else {
$msg="Vous devez voisir un parent dans la liste ci-contre";
?>

<script>
javascript:history.back();
</script>

<?php
}
?>
