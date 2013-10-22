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
		$nom="";
		$lieu="";
		$date="";
		$nbre_cibles="";
		$jours="";
		$labelboutonvalider="Ajouter cette compétition";
	
	if(isset($_GET["mod"]) && $_GET["mod"]>0 && !isset($_POST["envoi"])){
		$r=array_map("stripslashes",$competAMod);
		
		$nom=stripslashes($competAMod["nom"]);
		$lieu=stripslashes($competAMod["lieu"]);
		$date=stripslashes($competAMod["date"]);
		$id=stripslashes($competAMod["id"]);
		$nbre_cibles=stripslashes($competAMod["nbre_cibles"]);
		$jours=stripslashes($competAMod["jours"]);
		
		$labelboutonvalider="Modifier cette compétition";
		$suffixmod="&mod=".$id;
	}
	if(isset($_POST["envoi"]) && $_POST["envoi"]=="Modifier cette compétition"){
		$labelboutonvalider="Ajouter cette compétition";
		$suffixmod="";
	}
	
?>

<form action="index.php?p=competitions<?php echo $suffixmod; ?>" method="post" class="well">
<table>
	<tr>
		<td colspan="2">
			<h1>Ajoutez/modifiez une compétition</h1>
			<h5>Remplissez les champs et validez pour ajouter/modifier une compétition</h5>
			<small>* Les données marquées de cette astérisque sont obligatoires</small>
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Nom de la compétition *</span>
		</td>
		<td>	
			<input type="text" name="nom" value="<?php echo $nom; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Lieu de la compétition</span>
		</td>
		<td>	
			<input type="text" name="lieu" value="<?php echo $lieu; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Date du début de la compétition</span>
		</td>
		<td>	
			<input type="text" name="date" value="<?php echo $date; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Durée de la compétition (en jours)*</span>
		</td>
		<td>	
			<input type="text" name="jours" value="<?php echo $jours; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Nombre de cibles *</span>
		</td>
		<td>	
			<input type="text" name="nbre_cibles" value="<?php echo $nbre_cibles; ?>">
		</td>
	</tr>
	<tr>
		<td colspan="2" class='centre'>
			<br/>
			<input type="submit" name="envoi" class="btn btn-large btn-success" value="<?php echo $labelboutonvalider; ?>">
		</td>
	</tr>
</table>
</form>

<h3>Liste des compétitions</h3>

<table class="table table-striped">
	<thead>
	<tr>
		<td>Id</td>
		<td>Nom</td>
		<td>Lieu</td>
		<td>Date de début</td>
		<td>Nombre de jours</td>
		<td>Nombre de cibles</td>
		<td>&nbsp;</td>
	</tr>
	</thead>
	<tbody>
	<?php 
	
	if(mysql_num_rows($resultatSelectCompet)==0){
	?>
		<tr>
			<td colspan="7" style="text-align:center;">Aucune compétition n'a été enregistrée pour le moment</td>
		</tr>
	<?php
	}
	
	while ($compet=mysql_fetch_array($resultatSelectCompet)){
		$r=array_map("stripslashes",$compet);
		$id=stripslashes($compet["id"]);
		$nom=stripslashes($compet["nom"]);
		$lieu=stripslashes($compet["lieu"]);
		$date=stripslashes($compet["date"]);
		$jours=stripslashes($compet["jours"]);
		$nbre_cibles=stripslashes($compet["nbre_cibles"]);
	?>
	<tr>
		<td>#<?php echo $id; ?></td>
		<td><?php echo $nom; ?></td>
		<td><?php echo $lieu; ?></td>
		<td><?php echo $date; ?></td>
		<td><?php echo $jours; ?></td>
		<td><?php echo $nbre_cibles; ?></td>
		<td>
			<button class="btn btn-danger" type="button" alt="Supprimer la compétition" title="Supprimer la compétition" onclick=" javascript:afficherConfirmationSupprimerCompet(<?php echo $id; ?>);">x</button>
			<button class="btn btn-primary" type="button" alt="Modifier la compétition" title="Modifier la compétition" onclick="document.location.href='index.php?p=competitions&mod=<?php echo $id; ?>';">Modifier</button>
		</td>
	</tr>
	<?php } ?>
	</tbody>
</table>

<?php
	}
?>