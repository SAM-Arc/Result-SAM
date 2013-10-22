<?php
//var_dump($_POST);
	$erreur1="";
	if($_SESSION["est_admin"]==1){
	
		if(isset($_GET["del"]) && $_GET["del"]>0){		//Si on veut supprimer un joueur
			//Suppression vendeurs
			$sql2="DELETE FROM arc_archer WHERE id='".$_GET["del"]."'";
			$result2=mysql_query($sql2);
			
			$sql2="DELETE FROM arc_scores WHERE id_archer='".$_GET["del"]."'";
			$result2=mysql_query($sql2);
		}
		
		if(isset($_GET["mod"]) && $_GET["mod"]>0){
			$requeteSelect1="SELECT * FROM arc_archer WHERE id='".$_GET["mod"]."'";
			$resultatSelect1=mysql_query($requeteSelect1);
			$archerAMod=mysql_fetch_array($resultatSelect1);
				// MODIFS JOUEURS
				if(isset($_POST["envoi"]) && $_POST["envoi"]=="Modifier cet archer"){
					$id=$_GET["mod"];
					$nom=$_POST["nom"];
					$prenom=$_POST["prenom"];
					$club=$_POST["club"];
					$categorie=$_POST["categorie"];
					$type_compet=$_POST["type_compet"];
					$depart=$_POST["depart"];
					$cible=$_POST["cible"];
					$lettre=strtoupper($_POST["lettre"]);
					$sql3="UPDATE arc_archer SET nom='".mysql_real_escape_string($nom)."', prenom='".mysql_real_escape_string($prenom)."', club='".mysql_real_escape_string($club)."', categorie='".mysql_real_escape_string($categorie)."', type_compet='".mysql_real_escape_string($type_compet)."', depart='".mysql_real_escape_string($depart)."', cible='".mysql_real_escape_string($cible)."', lettre='".mysql_real_escape_string($lettre)."' WHERE id='".$id."'";
					$result3=mysql_query($sql3);
				}	
		}
	
		$menuadmin='
			<div class="navbar">
  				<div class="navbar-inner">
    				<a class="brand" href="#">Tir à l\'Arc</a>
    				<ul class="nav">
      					<li><a href="index.php">Accueil</a></li>
      					<li><a href="index.php?p=competitions">Gérer les compétitions</a></li>
      					<li class="active"><a href="index.php?p=archers">Gérer les archers</a></li>
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
		if(isset($_POST["envoi"]) && $_POST["envoi"]=="Ajouter cet archer"){	
		
			$nom=$_POST["nom"];
			$prenom=$_POST["prenom"];
			$club=$_POST["club"];
			$categorie=$_POST["categorie"];
			$type_compet=$_POST["type_compet"];
			$depart=$_POST["depart"];
			$cible=$_POST["cible"];
			$lettre=strtoupper($_POST["lettre"]);
					
					
		if(isset($_POST["nom"]) && $_POST["nom"]!="" && isset($_POST["prenom"]) && $_POST["prenom"]!="" && isset($_POST["categorie"]) && $_POST["categorie"]!="" && isset($_POST["type_compet"]) && $_POST["type_compet"]!=""){
			//Si on a ce dont on a besoin on enregistre tout dans la base de données
			//on ajoute à la base de données tout cela
			$sql="INSERT INTO arc_archer (nom,prenom,club,categorie,type_compet,depart,cible,lettre) VALUES('".mysql_real_escape_string($nom)."','".mysql_real_escape_string($prenom)."','".mysql_real_escape_string($club)."','".mysql_real_escape_string($categorie)."','".mysql_real_escape_string($type_compet)."','".mysql_real_escape_string($depart)."','".mysql_real_escape_string($cible)."','".mysql_real_escape_string($lettre)."')";
			$result=mysql_query($sql);
		}
		else{
			$erreur1="Une donnée obligatoire n'est pas remplie";
		}
		}
		
		if(!isset($_GET["tri"]) || $_GET["tri"]=="")
		{
			$tri="id";
			$ordretri="DESC";
		}
		else{
			if($_GET["tri"]=="cible"){
				$tri="ABS(depart) ASC, ABS(cible) ASC, lettre";
			}
			else if($_GET["tri"]=="nom"){
				$tri=$_GET["tri"];
			}
			else if($_GET["tri"]=="prenom"){
				$tri=$_GET["tri"];
			}
			else if($_GET["tri"]=="club"){
				$tri=$_GET["tri"];
			}
			else if($_GET["tri"]=="depart"){
				$tri="ABS(".$_GET["tri"].")";
			}
			$ordretri="ASC";
		}
		
		$requeteSelectArcher="SELECT * FROM arc_archer ORDER BY ".$tri." ".$ordretri;
		$resultatSelectArcher=mysql_query($requeteSelectArcher);
		
		$requeteSelectCategorie="SELECT * FROM arc_categories ORDER BY id DESC";
		$resultatSelectCategorie=mysql_query($requeteSelectCategorie);
	}

?>