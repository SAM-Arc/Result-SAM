<?php
//var_dump($_POST);
	$erreur1="";
	
	if(isset($_POST["motdepasse"]) && !empty($_POST["motdepasse"]) && $_POST["motdepasse"]!=""){
		//Ce n'est pas vide, un mot de passe a été entré
			if($_POST["motdepasse"]=="samarc"){
				$_SESSION["est_admin"]=1;
				$_SESSION["est_logge"]=1;
			}
			else{
			
				$erreur1="Ce mot de passe n'est pas connu, veuillez essayer à nouveau";
			}
	}
	else{
		//Traitement de l'erreur
		if($_POST["envoi"]!=""){
			$erreur1="Veuillez entrer un mot de passe SVP !";
		}
	}
	
	if(isset($_GET["deconnecter"]) && $_GET["deconnecter"]==1){
	//On déconnecte
		$_SESSION["est_admin"]=0;
		$_SESSION["est_logge"]=0;
	}
	
	if($_SESSION["est_admin"]==1){
		$sql="SELECT * FROM equipes";
		$result=mysql_query($sql);
		
		
		
		$menuadmin='
			<div class="navbar">
  				<div class="navbar-inner">
    				<a class="brand" href="#">Tir à l\'arc</a>
    				<ul class="nav">
      					<li class="active"><a href="index.php">Accueil</a></li>
      					<li><a href="index.php?p=competitions">Gérer les compétitions</a></li>
      					<li><a href="index.php?p=archers">Gérer les archers</a></li>
      					<li><a href="index.php?deconnecter=1">Déconnecter la session</a></li>
    				</ul>
  				</div>
			</div>
			';
			
			
			$pageaccueilcontent='
			<div style="text-align:left;" class="clearfix">
				<h2>Gestion de la compétitions</h2>
				
			</div>
			';
		
	}
?>