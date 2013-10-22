<?php
//var_dump($_POST);
	$erreur1="";
	if($_SESSION["est_admin"]==1){
		
		if(isset($_GET["idmod"]) && $_GET["idmod"]>0){
				// MODIFS Score
				if(isset($_POST["envoi"]) && $_POST["envoi"]=="Modifier ce score"){
				
					$id_archer=$_GET["idmod"];
					$id_compet=$_POST["id_compet"];
					$volee=$_POST["volee"];
					$score=$_POST["score"];
					$id_categorie=$_POST["id_categorie"];
					$type_compet=$_POST["type_compet"];
					$sql3="UPDATE arc_scores SET score='".mysql_real_escape_string($score)."' WHERE id_archer='".$id_archer."' AND id_compet='".$id_compet."' AND volee='".$volee."' AND id_categorie='".$id_categorie."' AND type_compet='".$type_compet."'";
					$result3=mysql_query($sql3);
					//echo $sql3;
				}	
		}
		
		if(isset($_GET["iddel"]) && $_GET["iddel"]>0 && $_GET["voleedel"]>0){
			$sql2="DELETE FROM arc_scores WHERE id_archer='".$_GET["iddel"]."' AND volee='".$_GET["voleedel"]."'";
			$result2=mysql_query($sql2);
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
		$requeteSelectArcher="SELECT * FROM arc_scores WHERE id_archer='".$_GET["id"]."' order by volee ASC";
		$resultatSelectArcher=mysql_query($requeteSelectArcher);
	}

?>