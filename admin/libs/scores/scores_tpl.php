<div align="center" style="width:95%;margin:0 auto;">
<br>
<?php
	if ($_SESSION["est_logge"]==1 && $_SESSION["est_admin"]==1){ 
		echo $menuadmin;
		
	if($erreur1!=""){
echo'
	<div class="alert alert-error" style="width:400px;">
	'.$erreur1.'
	</div>
	';
	}
	//var_dump($_SESSION);

?>

<h3>Liste des archers</h3>

<table class="table table-striped">
	<thead>
	<tr>
		<td>Volée</td>
		<td>Score</td>
		<td>Action</td>
	</tr>
	</thead>
	<tbody>
	<?php 
	
	if(mysql_num_rows($resultatSelectArcher)==0){
	?>
		<tr>
			<td colspan="9" style="text-align:center;">Aucun résultat n'a été enregistré pour le moment</td>
		</tr>
	<?php
	}
	
	while ($score=mysql_fetch_array($resultatSelectArcher)){
		//var_dump($score);
		//$r=array_map("stripslashes",$score);
		$id_archer1=$_GET["id"];
		$id_compet1=$score["id_compet"];
		$volee1=$score["volee"];
		$score1=$score["score"];
		$id_categorie1=$score["id_categorie"];
		$type_compet1=$score["type_compet"];

	?>
	<form action="index.php?p=scores&id=<?php echo $id_archer1; ?>&idmod=<?php echo $id_archer1; ?>" method="post">
	<input type="hidden" name="id_compet" value="<?php echo $id_compet1; ?>">
	<input type="hidden" name="id_categorie" value="<?php echo $id_categorie1; ?>">
	<input type="hidden" name="type_compet" value="<?php echo $type_compet1; ?>">
	<input type="hidden" name="volee" value="<?php echo $volee1; ?>">
	<tr>
		<td>Volée n°<?php echo $volee1; ?></td>
		<td><input type="text" name="score" value="<?php echo $score1; ?>"></td>
		<td><input type="submit" name="envoi" class="btn btn-primary" value="Modifier ce score">
		<button class="btn btn-danger" type="button" alt="Supprimer le score" title="Supprimer le score" onclick=" javascript:afficherConfirmationSupprimerScore(<?php echo $id_archer1; ?>,<?php echo $volee1; ?>);">x</button>
			
		</td>
	</tr>
	</form>
	<?php } ?>
	</tbody>
</table>

<?php
	}
?>