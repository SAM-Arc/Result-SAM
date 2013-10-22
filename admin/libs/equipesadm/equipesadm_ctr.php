<?php
//var_dump($_POST);
	$erreur1="";
	
	//On va extraire le prochain identifiant disponible dans la base
	
	if($_SESSION["est_admin"]==1){
		$menuadmin='
			<div class="navbar">
  				<div class="navbar-inner">
    				<a class="brand" href="#">Administrateur</a>
    				<ul class="nav">
      					<li><a href="index.php">Accueil</a></li>
      					<li class="active"><a href="index.php?p=equipesadm">Gérer les équipes</a></li>
      					<li><a href="index.php?p=joueursadm">Gérer les joueurs</a></li>
      					<li><a href="index.php?p=docs">Documents utiles</a></li>
      					<li><a href="index.php?deconnecter=1">Déconnecter la session</a></li>
    				</ul>
  				</div>
			</div>
			';
			$pageaccueilcontent='
			<div>
				<h2>Tableau de bord prochainement ici</h2>
			</div>
			';
		if(isset($_GET["del"]) && $_GET["del"]>0){		//Si on veut supprimer une equipe
			//Suppression joueurs de l'equipe
			$sql2="DELETE FROM joueurs WHERE id_equipe='".$_GET["del"]."'";
			$result2=mysql_query($sql2);
			//Suppression de l'equipe
			$sql2="DELETE FROM equipes WHERE id_equipe='".$_GET["del"]."'";
			$result2=mysql_query($sql2);
		}	
		
		if(isset($_GET["mod"]) && $_GET["mod"]>0){
			$requeteSelect1="SELECT * FROM equipes WHERE id_equipe='".$_GET["mod"]."'";
			$resultatSelect1=mysql_query($requeteSelect1);
			$equipeAMod1=mysql_fetch_array($resultatSelect1);
			//Modifications de l'equipe
			if(isset($_POST["envoi"]) && $_POST["envoi"]=="Modifier cette équipe"){
				$sql2="UPDATE equipes SET passalumni='".$_POST["passalumni"]."', alumni='".$_POST["alumni"]."', a_paye='".$_POST["a_paye"]."', nom='".$_POST["nom"]."', ecole='".$_POST["ecole"]."', site='".$_POST["site"]."', type='".$_POST["type"]."', sexe='".$_POST["sexe"]."', motdepasse='".$_POST["motdepasse"]."'  WHERE id_equipe='".$_GET["mod"]."'";
				$result2=mysql_query($sql2);
			}
		}
		
	}
	else if($_SESSION["est_admin"]==0){
			$sql="SELECT * FROM equipes WHERE id_equipe='".$_SESSION["id_equipe"]."'";
			$result=mysql_query($sql);
			$equipeAMod1=mysql_fetch_array($result);
			//Modifications de l'equipe
			if(isset($_POST["envoi"]) && $_POST["envoi"]=="Modifier cette équipe"){
				$sql2="UPDATE equipes SET passalumni='".$_POST["passalumni"]."', alumni='".$_POST["alumni"]."', ecole='".$_POST["ecole"]."', site='".$_POST["site"]."'  WHERE id_equipe='".$_SESSION["id_equipe"]."'";
				$result2=mysql_query($sql2);
				
				$sql="SELECT * FROM equipes WHERE id_equipe='".$_SESSION["id_equipe"]."'";
				$result=mysql_query($sql);
				$equipeAMod1=mysql_fetch_array($result);
			}
		
		$menuadmin='
			<div class="navbar">
  				<div class="navbar-inner">
    				<a class="brand" href="#">'.$equipeAMod1["nom"].'</a>
    				<ul class="nav">
      					<li><a href="index.php">Accueil</a></li>
      					<li class="active"><a href="index.php?p=equipesadm">Infos sur l\'équipe</a></li>
      					<li><a href="index.php?p=joueursadm">Gérer les joueurs</a></li>
      					<li><a href="index.php?p=docs">Documents utiles</a></li>
      					<li><a href="index.php?deconnecter=1">Déconnecter la session</a></li>
    				</ul>
  				</div>
			</div>
			';
			$pageaccueilcontent='
			<div>
				<h2>Tableau de bord prochainement ici</h2>
			</div>
			';
	}
	if(!isset($_GET["mod"]) && isset($_POST["nom"]) && $_POST["nom"]!="" && isset($_POST["ecole"]) && $_POST["ecole"]!="" && isset($_POST["motdepasse"]) && $_POST["motdepasse"]!=""){
		//Si on a ce dont on a besoin on enregistre tout dans la base de données
		
		$sql="INSERT INTO equipes (a_paye,alumni,nom,ecole,site,type,sexe,motdepasse,passalumni) VALUES('".$_POST['a_paye']."','".mysql_real_escape_string($_POST['alumni'])."','".mysql_real_escape_string($_POST['nom'])."','".mysql_real_escape_string($_POST['ecole'])."','".mysql_real_escape_string($_POST['site'])."','".mysql_real_escape_string($_POST['type'])."','".mysql_real_escape_string($_POST['sexe'])."','".mysql_real_escape_string($_POST['motdepasse'])."','".mysql_real_escape_string($_POST['passalumni'])."')";
		$result=mysql_query($sql);
	}
	
	$requeteSelect="SELECT * FROM equipes ORDER BY nom ASC";
	$resultatSelect=mysql_query($requeteSelect);
	
	$resultat=mysql_query("SELECT * FROM equipes ORDER BY id_equipe DESC");//On releve les données commentaires 
	if(mysql_num_rows($resultat)>0){
		$derniereEquipe=mysql_fetch_array($resultat);
	}
	else{
		$derniereEquipe=0;
	}
	$dernierIdDispo=$derniereEquipe["id_equipe"]+1;
	
	$tableauMdp=array("retiere","ntamak","castaignede","michalak","beauxis","nicolasmas","lievremont","skrela","imanol","saintandre","melee","rucking","cuillere","tampon","plaquage","cadrage","traille","drop","penalite");
	$tirageAuSort=rand(0,count($tableauMdp)-1);
	if($dernierIdDispo>9){
		$mdpPropose=$tableauMdp[$tirageAuSort].$dernierIdDispo;
	}
	else{
		$mdpPropose=$tableauMdp[$tirageAuSort]."0".$dernierIdDispo;
	}
	
?>