<?php
include ('include/initializer.inc.php');
include ('include/entete.inc.php');
	echo generationEntete("Page des utilisateurs", "Bonjour ".$_SESSION['Prenom']);
	include ("include/piedDePage.inc.php");
	$album= new photo();
 
?>
