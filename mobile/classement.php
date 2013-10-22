<!DOCTYPE html>
<html lang="en">
<?php
  //Coordonnées de connection à la base de données
  	 $serveur="localhost";
	 $identifiant="root";
	 $motDePasse="";
	 
	 $nomBase="resultsam";
	
	 $connection=mysql_connect($serveur,$identifiant, $motDePasse);
	 $db=mysql_select_db($nomBase);
?>
  <head>
    <meta charset="utf-8">
    <title>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body { padding-top: 60px; /* 60px to make the container go all the way
      to the bottom of the topbar */ 
      <?php if (isset($_GET["compet"]) && !isset($_GET["arc"])){?>
      	background-image:url("assets/img/classement1.png");
      <?php } else{?>
      	background-image:url("assets/img/classement2.png");
      <?php } 
      if (isset($_GET["compet"]) && isset($_GET["arc"]) && isset($_GET["categorie"])){
      ?>
      	background-image:url("");
      <?php } ?>
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js">
      </script>
    <![endif]-->
    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
    <style>
    </style>
  </head>
  <body>
    <div class="container" style="text-align:center;">
    <!--<h1>Result'SAM</h1>--><br><br><br>
    <?php if (isset($_GET["compet"]) && !isset($_GET["arc"])){?>
    <!--<h5>Choisir le type d'arc</h5>--><br>
    	<a class="btn btn-success btn-large" style="height:60px;width:70%;vertical-align:middle;margin:20px;" href="classement.php?compet=<?php echo $_GET["compet"]; ?>&arc=CL"><br>
          Arc Classique
      	</a>
      	<a class="btn btn-success btn-large" style="height:60px;width:70%;vertical-align:middle;margin:20px;" href="classement.php?compet=<?php echo $_GET["compet"]; ?>&arc=CO"><br>
          Arc à Poulie
      	</a>
    <?php }
    	if (isset($_GET["compet"]) && isset($_GET["arc"]) && !isset($_GET["categorie"])){
    ?>  
    	<!--<h5>Choisir la catégorie désirée</h5><br>--><br><br>
    	<form action="classement.php" method="get">
    	<input type="hidden" name="compet" value="<?php echo $_GET["compet"]; ?>">
    	<input type="hidden" name="arc" value="<?php echo $_GET["arc"]; ?>">
    	<SELECT name="categorie" style="height:50px;">
				<OPTION VALUE="BF">Benjamin Femme</OPTION>
				<OPTION VALUE="BH">Benjamin Homme</OPTION>
				<OPTION VALUE="MF">Minime Femme</OPTION>
				<OPTION VALUE="MH">Minime Homme</OPTION>
				<OPTION VALUE="CF">Cadet Femme</OPTION>
				<OPTION VALUE="CH">Cadet Homme</OPTION>
				<OPTION VALUE="JF">Junior Femme</OPTION>
				<OPTION VALUE="JH">Junior Homme</OPTION>
				<OPTION VALUE="SF">Sénior Femme</OPTION>
				<OPTION VALUE="SH">Sénior Homme</OPTION>
				<OPTION VALUE="VF">Vétéran Femme</OPTION>
				<OPTION VALUE="VH">Vétéran Homme</OPTION>
				<OPTION VALUE="SVF">Super-Vétéran Femme</OPTION>
				<OPTION VALUE="SVH">Super-Vétéran Homme</OPTION>
		</SELECT>
		<SELECT name="volee">
				<OPTION VALUE="1"<?php echo $volee1; ?>>Volée n°1</OPTION>
				<OPTION VALUE="2"<?php echo $volee2; ?>>Volée n°2</OPTION>
				<OPTION VALUE="3"<?php echo $volee3; ?>>Volée n°3</OPTION>
				<OPTION VALUE="4"<?php echo $volee4; ?>>Volée n°4</OPTION>
				<OPTION VALUE="5"<?php echo $volee5; ?>>Volée n°5</OPTION>
				<OPTION VALUE="6"<?php echo $volee6; ?>>Volée n°6</OPTION>
				<OPTION VALUE="7"<?php echo $volee7; ?>>Volée n°7</OPTION>
				<OPTION VALUE="8"<?php echo $volee8; ?>>Volée n°8</OPTION>
				<OPTION VALUE="9"<?php echo $volee9; ?>>Volée n°9</OPTION>
				<OPTION VALUE="10"<?php echo $volee10; ?>>Volée n°10</OPTION>
				<OPTION VALUE="11"<?php echo $volee11; ?>>Volée n°11</OPTION>
				<OPTION VALUE="12"<?php echo $volee12; ?>>Volée n°12</OPTION>
		</SELECT>
		<input type="submit" value="Sélectionner" class="btn btn-success btn-large">
		</form>
    <?php }
    	if (isset($_GET["compet"]) && isset($_GET["arc"]) && isset($_GET["categorie"])){
    		//On affiche le classement
    		$requeteSelectClassement="SELECT * FROM arc_categories WHERE categorie='".$_GET["categorie"].$_GET["arc"]."' order by id DESC";
			$resultSelectClassement=mysql_query($requeteSelectClassement);
			$categorie=mysql_fetch_array($resultSelectClassement);
			$idcat=$categorie["id"];
			$arc="";
			$type="";
			
			if($_GET["arc"]=="CL"){
				$arc="Arc Classique";
			}
			else{
				$arc="Arc à Poulie";
			}
			
			if($_GET["categorie"]=="BF"){
				$type="Benjamin Femme";
			}
			else if($_GET["categorie"]=="BH"){
				$type="Benjamin Homme";
			}
			else if($_GET["categorie"]=="MF"){
				$type="Minime Femme";
			}
			else if($_GET["categorie"]=="MH"){
				$type="Minime Homme";
			}
			else if($_GET["categorie"]=="CF"){
				$type="Cadet Femme";
			}
			else if($_GET["categorie"]=="CH"){
				$type="Cadet Homme";
			}
			else if($_GET["categorie"]=="JF"){
				$type="Junior Femme";
			}
			else if($_GET["categorie"]=="JH"){
				$type="Junior Homme";
			}
			else if($_GET["categorie"]=="SF"){
				$type="Sénior Femme";
			}
			else if($_GET["categorie"]=="SH"){
				$type="Sénior Homme";
			}
			else if($_GET["categorie"]=="VF"){
				$type="Vétéran Femme";
			}
			else if($_GET["categorie"]=="VH"){
				$type="Vétéran Homme";
			}
			else if($_GET["categorie"]=="SVF"){
				$type="Super-Vétéran Femme";
			}
			else if($_GET["categorie"]=="SVH"){
				$type="Super-Vétéran Homme";
			}
			echo "Classement ".$arc. " ".$type."<br>";
	?>
	<table border="0" class="table table-striped">
    	<tr>
    		<td>Clt</td>
    		<td>Archer</td>
    		<td>Club</td>
    		<td>Score</td>
    	</tr>
    	<?php
    		if(isset($_GET["volee"])){
    		$volee=$_GET["volee"];
    		}
    		else{
    		$volee=12;
    		}
    				$requeteSelectScore="SELECT * FROM arc_archer WHERE categorie='".$idcat."' AND type_compet='".$_GET["compet"]."'";
					$resultatSelectScore=mysql_query($requeteSelectScore);

					$i=1;
					
					$joueurs = array();
					
					while($archer=mysql_fetch_array($resultatSelectScore)){
						$voleeencours=$volee;
						$points=0;
						while($voleeencours>0){
							$requeteSelectScoreBis="SELECT * FROM arc_scores WHERE volee='".$voleeencours."' AND id_archer='".$archer["id"]."' AND id_categorie='".$idcat."' AND type_compet='".$_GET["compet"]."'";
							$resultatSelectScoreBis=mysql_query($requeteSelectScoreBis);
							if(mysql_num_rows($resultatSelectScoreBis)>0){
								$dd=mysql_fetch_array($resultatSelectScoreBis);
								$points=$points+$dd["score"];
							}
							$voleeencours--;
						}
						$joueurs[] = array('id' => $archer["id"], 'points' => $points);
					}	
					
					$scores = array();
					foreach ($joueurs as $key => $row)
					{
    					$scores[$key] = $row['points'];
					}
					array_multisort($scores, SORT_DESC, $joueurs);
					//var_dump($joueurs);
						for ($i=0;$i<count($joueurs);$i++){
						
							$requeteSelectArcher="SELECT * FROM arc_archer WHERE id='".$joueurs[$i]["id"]."'";
							$resultatSelectArcher=mysql_query($requeteSelectArcher);
							$participant=mysql_fetch_array($resultatSelectArcher);
							echo "<tr>
    							<td>".($i+1)."</td>
    							<td>".$participant["nom"]." ".$participant["prenom"]."</td>
    							<td>".$participant["club"]."</td>
    							<td>".$joueurs[$i]["points"]."</td>
    						  </tr>";
    					}
    	
  
  		?>
  		</table>
	
	<?php
		}
    ?>
    <br>
    	<a class="btn btn-warning" style="width:70%;margin-bottom:10px;" onClick="history.go(-1);return true;">Retour</a><br>
		<a class="btn btn-warning" style="width:70%;margin-bottom:10px;" href="index.html">
          Retour accueil
      	</a>
    </div>

    <style>
      
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
    </script>
    <script src="assets/js/bootstrap.js">
    </script>
  </body>
</html>
