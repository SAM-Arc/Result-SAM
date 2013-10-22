<div align="center" style="width:95%;margin:0 auto;">
<br>
<?php
	if($erreur1!=""){
echo'
	<div class="alert alert-error" style="width:400px;">
	'.$erreur1.'
	</div>
	';
	}
	//var_dump($_SESSION);
?>

<?php if ($_SESSION["est_logge"]==1 && $_SESSION["est_admin"]==1){ 
	echo $menuadmin;
	$suffixeurl="";
	$nom="";
	$ecole="";
	$site="http://";
	$commerce="";
	$ingenieur="";
	$administration="";
	$masculin="";
	$feminin="";
	$motdepassemod="";
	$alumni="http://";
	$passalumni="";
	$a_payeoui="";
			$a_payenon="checked";
	$labelsubmit="Ajouter cette équipe";
	
	if(isset($_GET["mod"]) && $_GET["mod"]>0 && !isset($_POST["envoi"])){
		$suffixeurl="&mod=".$_GET["mod"];
		$nom=$equipeAMod1["nom"];
		$ecole=$equipeAMod1["ecole"];
		$site=$equipeAMod1["site"];
		$alumni=$equipeAMod1["alumni"];
		$passalumni=$equipeAMod1["passalumni"];
		$commerce="";
		$ingenieur="";
		$administration="";
		$externe="";
		if($equipeAMod1["type"]=="Administration"){
			$administration=" selected";
		}
		else if($equipeAMod1["type"]=="Ecole de commerce"){
			$commerce=" selected";
		}
		else if($equipeAMod1["type"]=="Externe"){
			$externe=" selected";
		}
		else{
			$ingenieur=" selected";
		}
		
		$masculin="";
		$feminin="";
		if($equipeAMod1["sexe"]=="Masculin"){
			$masculin=" selected";
		}
		else{
			$feminin=" selected";
		}
		
		$a_payeoui="";
		$a_payenon="";
		if($equipeAMod1["a_paye"]=="1"){
			$a_payeoui=" checked";
			$a_payenon="";
		}
		else{
			$a_payeoui="";
			$a_payenon="checked";
		}
		
		$motdepassemod=$equipeAMod1["motdepasse"];
		$mdpPropose=$motdepassemod;
		$labelsubmit="Modifier cette équipe";
	}
?>
<form action="index.php?p=equipesadm<?php echo $suffixeurl; ?>" method="post" class="well">
<table>
	<tr>
		<td colspan="2">
			<h1>Ajoutez/modifiez une équipe</h1>
			<h5>Remplissez les champs et validez pour ajouter/modifier une équipe</h5>
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Nom de l'équipe</span>
		</td>
		<td>	
			<input type="text" name="nom" value="<?php echo $nom; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Nom de l'école</span>
		</td>	
		<td>
			<input type="text" name="ecole"  value="<?php echo $ecole; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Adresse du site web de l'équipe</span>
		</td>
		<td>
			<input type="text" name="site" value="<?php echo $site; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Type d'école</span> 
		</td>
		<td>
			<SELECT name="type">
				<OPTION VALUE="Ecole de commerce"<?php echo $commerce; ?>>Ecole de commerce</OPTION>
				<OPTION VALUE="Ecole d'ingénieurs"<?php echo $ingenieur; ?>>Ecole d'ingénieur</OPTION>
				<OPTION VALUE="Administration"<?php echo $administration; ?>>Administration</OPTION>
				<OPTION VALUE="Externe"<?php echo $externe; ?>>Externe</OPTION>
			</SELECT>
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Site web de l'association des anciens élèves (ALUMNI)</span>
		</td>
		<td>
			<input type="text" name="alumni" value="<?php echo $alumni; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Identifiant et/ou mot de passe de l'annuaire des anciens élèves</span>
		</td>
		<td>
			<input type="text" name="passalumni" value="<?php echo $passalumni; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Catégorie</span>
		</td>
		<td>
			<SELECT name="sexe">
				<OPTION VALUE="Masculin"<?php echo $masculin; ?>>Masculins</OPTION>
				<OPTION VALUE="Féminin"<?php echo $feminin; ?>>Féminines</OPTION>
				<!--<OPTION VALUE="Mixte">Mixte</OPTION>-->
			</SELECT>
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Mot de passe attribué</span>
		</td>
		<td>
			<input type="text" name="motdepasse" value="<?php echo $mdpPropose; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Le paiement total de l'équipe a t'il été reçu ?</span>
		</td>
		<td>
			<input type="radio" name="a_paye" value="1"<?php echo $a_payeoui; ?>> Oui &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="a_paye" value="0"<?php echo $a_payenon; ?>> Non
		</td>
	</tr>
	<tr>
		<td colspan="2" class='centre'>
			<br/>
			<input type="submit" name="envoi" class="btn btn-large btn-success" value="<?php echo $labelsubmit; ?>">
		</td>
	</tr>
	
</table>
</form>



<table class="table table-striped">
	<thead>
	<tr>
		<td>Id.</td>
		<td>A Payé</td>
		<td>Nom de l'équipe</td>
		<td>Ecole représentée</td>
		<td>Type d'école</td>
		<td>Sites internet</td>
		<td>Capitaine</td>
		<td>Masculins/Féminines</td>
		<td>Mot de passe attribué</td>
		<td>Id et mot de passe alumni</td>
		<td>&nbsp;</td>
	</tr>
	</thead>
	<tbody>
	<?php 
	
	if(mysql_num_rows($resultatSelect)==0){
	?>
		<tr>
			<td colspan="10" style="text-align:center;">Aucun équipe n'a été enregistrée pour le moment</td>
		</tr>
	<?php
	}
	
	while ($equipe=mysql_fetch_array($resultatSelect)){
		$r=array_map("stripslashes",$equipe);
		$id_equipe=stripslashes($equipe["id_equipe"]);
		$nom=stripslashes($equipe["nom"]);
		$ecole=stripslashes($equipe["ecole"]);
		$site="<a href='".stripslashes($equipe["site"])."' target='_blank'>".stripslashes($equipe["site"])."</a>";
		$alumni="<a href='".stripslashes($equipe["alumni"])."' target='_blank'>".stripslashes($equipe["alumni"])."</a>";
		$id_respo=stripslashes($equipe["id_respo"]);
		$type=stripslashes($equipe["type"]);
		$sexe=stripslashes($equipe["sexe"]);
		$motdepasseeq=stripslashes($equipe["motdepasse"]);
		$passalumni=stripslashes($equipe["passalumni"]);
		if($equipe["a_paye"]=='1'){
			$couleurapaye='<button class="btn btn-success" type="button">&nbsp;</button>';
		}
		else{
			$couleurapaye='<button class="btn btn-danger" type="button">&nbsp;</button>';
		}
		$nom_responsable="Non désigné";
		
		if($id_respo!=0){
			$sql1="SELECT * FROM joueurs WHERE id_joueur='".$id_respo."'";
			$result1=mysql_query($sql1);
			$responsable=mysql_fetch_array($result1);
			$nom_responsable=$responsable["prenom"]." ".strtoupper($responsable["nom"]);
		}
		
		
	?>
	<tr>
		<td>#<?php echo $id_equipe; ?></td>
		<td><?php echo $couleurapaye; ?></td>
		<td><?php echo $nom; ?></td>
		<td><?php echo $ecole; ?></td>
		<td><?php echo $type; ?></td>
		<td><?php echo $site; ?><br>Alumni :<br/><?php echo $alumni; ?></td>
		<td><?php echo $nom_responsable; ?></td>
		<td><?php echo $sexe; ?></td>
		<td><i><?php echo $motdepasseeq; ?></i></td>
		<td><i><?php echo $passalumni; ?></i></td>
		<td><button class="btn btn-danger" type="button" alt="Supprimer l'équipe" title="Supprimer l'équipe" onclick=" javascript:afficherConfirmationSupprimerEquipe(<?php echo $id_equipe; ?>);">x</button>
		<button class="btn btn-primary" type="button" alt="Modifier l'équipe" title="Modifier l'equipe" onclick="document.location.href='index.php?p=equipesadm&mod=<?php echo $id_equipe; ?>';">Modifier</button>
		<button class="btn btn-warning" type="button" alt="XLS" title="XLS" onclick="document.location.href='libs/genxlsequipe/genxlsequipe_ctr.php?idequipe=<?php echo $id_equipe; ?>&mdp=ilovelarge';">XLS</button>
		</td>
	</tr>
	<?php } ?>
	</tbody>
</table>

<?php } 
else if ($_SESSION["est_logge"]==1 && $_SESSION["est_admin"]==0){ 
	echo $menuadmin;
	$suffixeurl="";
	$nom="";
	$ecole="";
	$site="http://";
	$commerce="";
	$ingenieur="";
	$administration="";
	$masculin="";
	$feminin="";
	$motdepassemod="";
	$alumni="http://";
	$passalumni="";
	$a_payeoui="";
	$a_payenon="checked";
	$labelsubmit="Modifier cette équipe";
	
		$suffixeurl="";
		$nom=$equipeAMod1["nom"];
		$ecole=$equipeAMod1["ecole"];
		$site=$equipeAMod1["site"];
		$alumni=$equipeAMod1["alumni"];
		$passalumni=$equipeAMod1["passalumni"];
		$commerce="";
		$ingenieur="";
		$administration="";
		$externe="";
		if($equipeAMod1["type"]=="Administration"){
			$administration=" selected";
		}
		else if($equipeAMod1["type"]=="Ecole de commerce"){
			$commerce=" selected";
		}
		else if($equipeAMod1["type"]=="Externe"){
			$externe=" selected";
		}
		else{
			$ingenieur=" selected";
		}
		
		$masculin="";
		$feminin="";
		if($equipeAMod1["sexe"]=="Masculin"){
			$masculin=" selected";
		}
		else{
			$feminin=" selected";
		}
		
		$a_payeoui="";
		$a_payenon="";
		if($equipeAMod1["a_paye"]=="1"){
			$a_payeoui=" checked";
			$a_payenon="";
		}
		else{
			$a_payeoui="";
			$a_payenon="checked";
		}
		
		$motdepassemod=$equipeAMod1["motdepasse"];
		$mdpPropose=$motdepassemod;
		$labelsubmit="Modifier cette équipe";
?>	
	<form action="index.php?p=equipesadm" method="post" class="well">
<table>
	<tr>
		<td colspan="2">
			<h1>Mettez à jour vos données</h1>
			<h5>Remplissez les champs et validez pour modifier vos données</h5>
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Nom de l'équipe</span>
		</td>
		<td>	
			<?php echo $nom; ?>
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Nom de l'école</span>
		</td>	
		<td>
			<input type="text" name="ecole"  value="<?php echo $ecole; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Adresse du site web de l'équipe</span>
		</td>
		<td>
			<input type="text" name="site" value="<?php echo $site; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Site web de l'association des anciens élèves (ALUMNI)</span>
		</td>
		<td>
			<input type="text" name="alumni" value="<?php echo $alumni; ?>">
		</td>
	</tr>
	<tr>
		<td class='droite'>
			<span style="font-size:20px;margin-right:20px;">Identifiant et/ou mot de passe de l'annuaire des anciens élèves</span>
		</td>
		<td>
			<input type="text" name="passalumni" value="<?php echo $passalumni; ?>">
		</td>
	</tr>
	<tr>
		<td colspan="2" class='centre'>
			<br/>
			<input type="submit" name="envoi" class="btn btn-large btn-success" value="<?php echo $labelsubmit; ?>">
		</td>
	</tr>
	
</table>
</form>
<?php	
}
?>
</div>