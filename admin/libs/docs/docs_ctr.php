<?php
//var_dump($_POST);

if($_SESSION["est_logge"]==1){	
	if($_SESSION["est_admin"]=="1"){
		$nom="Administrateur";
	}
	else{
		$sql="SELECT * FROM equipes WHERE id_equipe='".$_SESSION["id_equipe"]."'";
		$result=mysql_query($sql);
		$equipe=mysql_fetch_array($result);
		$nom=$equipe["nom"];
	}
			
			
			$menuadmin='
			<div class="navbar">
  				<div class="navbar-inner">
    				<a class="brand" href="#">'.$nom.'</a>
    				<ul class="nav">
      					<li><a href="index.php">Accueil</a></li>
      					<li><a href="index.php?p=equipesadm">Infos sur l\'équipe</a></li>
      					<li><a href="index.php?p=joueursadm">Gérer les joueurs</a></li>
      					<li class="active"><a href="index.php?p=docs">Documents utiles</a></li>
      					<li><a href="index.php?deconnecter=1">Déconnecter la session</a></li>
    				</ul>
  				</div>
			</div>
			';
}
?>