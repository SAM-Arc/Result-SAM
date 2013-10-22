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
		$prenom="";
		$club="";
		$categorie="";
		$type_compet="";
		$cible="";
		$depart="";
		$lettre="";
		$labelboutonvalider="Ajouter cet archer";
	
	if(isset($_GET["mod"]) && $_GET["mod"]>0 && !isset($_POST["envoi"])){
		$r=array_map("stripslashes",$archerAMod);
		
		$id=stripslashes($archerAMod["id"]);
		$nom=stripslashes($archerAMod["nom"]);
		$prenom=stripslashes($archerAMod["prenom"]);
		$club=stripslashes($archerAMod["club"]);
		$categorie=stripslashes($archerAMod["categorie"]);
		$type_compet=stripslashes($archerAMod["type_compet"]);
		
		$g=1;
		for($g=1;$g<29;$g++){
			$nomcat="cat".$g;
			if($categorie==$g){
				$$nomcat=" selected";
			}
			else{
				$$nomcat="";
			}
		}
		
		$compet_fita="";
		$compet_federal="";
		if($type_compet==1){
			$compet_federal=" selected";
		}
		else{
			$compet_fita=" selected";
		}
		
		$cible=stripslashes($archerAMod["cible"]);
		$depart=stripslashes($archerAMod["depart"]);
		$lettre=stripslashes($archerAMod["lettre"]);
		$labelboutonvalider="Modifier cet archer";
		$suffixmod="&mod=".$id;
	}
	if(isset($_POST["envoi"]) && $_POST["envoi"]=="Modifier cette compétition"){
		$labelboutonvalider="Ajouter cet archer";
		$suffixmod="";
	}
	
?>

<form action="index.php?p=archers<?php echo $suffixmod; ?>" method="post" class="well">
<table>
	<tr>
		<td colspan="2">
			<h1>Ajoutez/modifiez un profil d'archer</h1>
			<h5>Remplissez les champs et validez pour ajouter/modifier un archer</h5>
			<small>* Les données marquées de cette astérisque sont obligatoires</small>
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Nom de l'archer *</span>
		</td>
		<td>	
			<input type="text" name="nom" value="<?php echo $nom; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Prénom de l'archer *</span>
		</td>
		<td>	
			<input type="text" name="prenom" value="<?php echo $prenom; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Club</span>
		</td>
		<td>	
			<input type="text" name="club" value="<?php echo $club; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Catégorie</span>
		</td>
		<td>
			<SELECT name="categorie">
				<?php 
				while($categorie=mysql_fetch_array($resultatSelectCategorie)){
				$nomcat="cat".$categorie['id'];
				?>
				<OPTION VALUE="<?php echo $categorie['id']; ?>"<?php echo $$nomcat; ?>><?php echo $categorie['categorie']; ?></OPTION>
				<?php
				}
				?>
			</SELECT>
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Type de Compétition</span>
		</td>
		<td>
			<SELECT name="type_compet">
				<OPTION VALUE="1"<?php echo $compet_federal; ?>>Tir Fédéral</OPTION>
				<OPTION VALUE="2"<?php echo $compet_fita; ?>>Tir FITA</OPTION>
			</SELECT>
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Départ</span>
		</td>
		<td>	
			<input type="text" name="depart" value="<?php echo $depart; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Cible (chiffre)</span>
		</td>
		<td>	
			<input type="text" name="cible" value="<?php echo $cible; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Lettre (Majuscule)</span>
		</td>
		<td>	
			<input type="text" name="lettre" value="<?php echo $lettre; ?>">
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

<h3>Liste des archers</h3>

<table class="table table-striped">
	<thead>
	<tr>
		<td><a href="index.php?p=archers&tri=id">Id</a></td>
		<td><a href="index.php?p=archers&tri=nom">Nom</a></td>
		<td><a href="index.php?p=archers&tri=prenom">Prénom</a></td>
		<td><a href="index.php?p=archers&tri=club">Club</a></td>
		<td>Catégorie</td>
		<td>Type de Compétition</td>
		<td><a href="index.php?p=archers&tri=depart">Départ</a></td>
		<td><a href="index.php?p=archers&tri=cible">Cible (+lettre)</a></td>
		<td>&nbsp;</td>
	</tr>
	</thead>
	<tbody>
	<?php 
	
	if(mysql_num_rows($resultatSelectArcher)==0){
	?>
		<tr>
			<td colspan="9" style="text-align:center;">Aucun archer n'a été enregistré pour le moment</td>
		</tr>
	<?php
	}
	
	while ($archer=mysql_fetch_array($resultatSelectArcher)){
		$r=array_map("stripslashes",$archer);
		$id=stripslashes($archer["id"]);
		$nom=stripslashes($archer["nom"]);
		$prenom=stripslashes($archer["prenom"]);
		$club=stripslashes($archer["club"]);
		$lettre=stripslashes($archer["lettre"]);
		$cible=stripslashes($archer["cible"]);
		$depart=stripslashes($archer["depart"]);
		
		$requeteSelectCategorie1="SELECT * FROM arc_categories WHERE id='".stripslashes($archer["categorie"])."'";
		$resultatSelectCategorie1=mysql_query($requeteSelectCategorie1);
		$tab=mysql_fetch_array($resultatSelectCategorie1);
		$categorie=$tab["categorie"];
		
		if(stripslashes($archer["type_compet"])==1){
			$type_compet="Tir Fédéral";
		}
		else{
			$type_compet="Tir FITA";
		}
	?>
	<tr>
		<td>#<?php echo $id; ?></td>
		<td><?php echo $nom; ?></td>
		<td><?php echo $prenom; ?></td>
		<td><?php echo $club; ?></td>
		<td><?php echo $categorie; ?></td>
		<td><?php echo $type_compet; ?></td>
		<td><?php echo $depart; ?></td>
		<td><?php echo $cible.strtoupper($lettre); ?></td>
		<td>
			<button class="btn btn-danger" type="button" alt="Supprimer l'archer" title="Supprimer l'archer" onclick=" javascript:afficherConfirmationSupprimerArcher(<?php echo $id; ?>);">x</button>
			<button class="btn btn-primary" type="button" alt="Modifier l'archer" title="Modifier l'archer" onclick="document.location.href='index.php?p=archers&mod=<?php echo $id; ?>';">Modifier</button>
			<button class="btn btn-primary" type="button" alt="Modifier les scores" title="Modifier les scores" onclick="document.location.href='index.php?p=scores&id=<?php echo $id; ?>';">Scores</button>

		</td>
	</tr>
	<?php } ?>
	</tbody>
</table>

<?php
	}
?>