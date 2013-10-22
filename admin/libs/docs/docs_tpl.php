<div align="center" style="width:95%;margin:0 auto;">
<br>
<?php
	echo $menuadmin;

	if($erreur1!=""){
echo'
	<div class="alert alert-error" style="width:400px;">
	'.$erreur1.'
	</div>
	';
	}
	include("assets/fichiers/index.php");
?>