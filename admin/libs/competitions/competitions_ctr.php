<?php
//var_dump($_POST);
	$erreur1="";
	if($_SESSION["est_admin"]==1){
	
		if(isset($_GET["del"]) && $_GET["del"]>0){		//Si on veut supprimer un joueur
			//Suppression vendeurs
			$sql2="DELETE FROM arc_competition WHERE id='".$_GET["del"]."'";
			$result2=mysql_query($sql2);
		}
		
		if(isset($_GET["mod"]) && $_GET["mod"]>0){
			$requeteSelect1="SELECT * FROM arc_competition WHERE id='".$_GET["mod"]."'";
			$resultatSelect1=mysql_query($requeteSelect1);
			$competAMod=mysql_fetch_array($resultatSelect1);
				// MODIFS JOUEURS
				if(isset($_POST["envoi"]) && $_POST["envoi"]=="Modifier cette compétition"){
					$id=$_GET["mod"];
					$nom=$_POST["nom"];
					$lieu=$_POST["lieu"];
					$date=$_POST["date"];
					$nbre_cibles=$_POST["nbre_cibles"];
					$jours=$_POST["jours"];
					
					$sql3="UPDATE arc_competition SET nom='".mysql_real_escape_string($nom)."', lieu='".mysql_real_escape_string($lieu)."', date='".mysql_real_escape_string($date)."', nbre_cibles='".mysql_real_escape_string($nbre_cibles)."', jours='".mysql_real_escape_string($jours)."' WHERE id='".$id."'";
					$result3=mysql_query($sql3);
				}	
		}
	
		$menuadmin='
			<div class="navbar">
  				<div class="navbar-inner">
    				<a class="brand" href="#">Tir à l\'Arc</a>
    				<ul class="nav">
      					<li><a href="index.php">Accueil</a></li>
      					<li class="active"><a href="index.php?p=competitions">Gérer les compétitions</a></li>
      					<li><a href="index.php?p=archers">Gérer les archers</a></li>
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
		if(isset($_POST["envoi"]) && $_POST["envoi"]=="Ajouter cette compétition"){	
		
			$nom=$_POST["nom"];
			$lieu=$_POST["lieu"];
			$date=$_POST["date"];
			$nbre_cibles=$_POST["nbre_cibles"];
			$jours=$_POST["jours"];
		
		if(isset($_POST["nom"]) && $_POST["nom"]!="" && isset($_POST["nbre_cibles"]) && $_POST["nbre_cibles"]!="" && isset($_POST["jours"]) && $_POST["jours"]!=""){
			//Si on a ce dont on a besoin on enregistre tout dans la base de données
			//on ajoute à la base de données tout cela
			$sql="INSERT INTO arc_competition (nom,lieu,date,nbre_cibles,jours) VALUES('".mysql_real_escape_string($nom)."','".mysql_real_escape_string($lieu)."','".mysql_real_escape_string($date)."','".mysql_real_escape_string($nbre_cibles)."','".mysql_real_escape_string($jours)."')";
			$result=mysql_query($sql);
		}
		else{
			$erreur1="Une donnée obligatoire n'est pas remplie";
		}
		}
		$requeteSelectCompet="SELECT * FROM arc_competition ORDER BY id DESC";
		$resultatSelectCompet=mysql_query($requeteSelectCompet);
	}

?>