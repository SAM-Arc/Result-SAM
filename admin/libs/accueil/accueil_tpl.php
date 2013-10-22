<div align="center" style="width:95%;margin:0 auto;">
<br>
<br>
<?php
	if($erreur1!=""){
echo'
	<div class="alert alert-error" style="width:400px;">
	'.$erreur1.'
	</div>
	';
	}
?>

<?php if ($_SESSION["est_logge"]!=1){ ?>
<form action="index.php?p=accueil" method="post">
	<span style="font-size:20px;margin-right:20px;">Mot de passe</span> <input type="password" name="motdepasse"><br/>
	<input type="submit" name="envoi" class="btn btn-large btn-success" value="Accéder à l'interface">
</form>
<?php } 
else {
	echo $menuadmin;
	echo $pageaccueilcontent;
}
?>
</div>