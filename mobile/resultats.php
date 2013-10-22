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
    body { 
    	padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      	background-image:url("assets/img/resultat.png");
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
    <!--<h1 style="background-color:#fff;">Result'SAM</h1>-->
    	<?php
    		if(isset($_GET['depart'])){
				$depart=$_GET["depart"];
				$cible=$_GET["cible"];
				$requeteSelectArcher="SELECT * FROM arc_archer WHERE cible='".$cible."' AND depart='".$depart."'";
					$resultatSelectArcher=mysql_query($requeteSelectArcher);
					$archerA;
					$archerB;
					$archerC;
					$archerD;
					while($archer=mysql_fetch_array($resultatSelectArcher)){
						if($archer["lettre"]=="A"){
							$archerA=$archer;
						}
						else if($archer["lettre"]=="B"){
							$archerB=$archer;
						}
						else if($archer["lettre"]=="C"){
							$archerC=$archer;
						}
						else if($archer["lettre"]=="D"){
							$archerD=$archer;
						}
					}
			}
			
    		if(isset($_POST["reg"]) && $_POST["reg"]=="1"){
    			//On a bien envoyé les résultats
    			$depart=$_POST["depart"];
    			$cible=$_POST["cible"];
    			$volee=intval($_POST["volee"]);
    			$volee1="";
    			$volee2="";
    			$volee3="";
    			$volee4="";
    			$volee5="";
    			$volee6="";
    			$volee7="";
    			$volee8="";
    			$volee9="";
    			$volee10="";
    			$volee11="";
    			$volee12="";
    			$voleesuivante=$volee+1;
    			$voleesuiv="volee".$voleesuivante;
    			$$voleesuiv=" SELECTED";
    			$a=$_POST["a"];
    			$b=$_POST["b"];
    			$c=$_POST["c"];
    			$d=$_POST["d"];
    			$requeteSelectCompet="SELECT * FROM arc_competition ORDER BY id DESC";
				$resultatSelectCompet=mysql_query($requeteSelectCompet);
				$dernierecompetition=mysql_fetch_array($resultatSelectCompet);
				
					$requeteSelectArcher="SELECT * FROM arc_archer WHERE cible='".$cible."' AND depart='".$depart."'";
					$resultatSelectArcher=mysql_query($requeteSelectArcher);
					$archerA;
					$archerB;
					$archerC;
					$archerD;
					while($archer=mysql_fetch_array($resultatSelectArcher)){
						if($archer["lettre"]=="A"){
							$archerA=$archer;
						}
						else if($archer["lettre"]=="B"){
							$archerB=$archer;
						}
						else if($archer["lettre"]=="C"){
							$archerC=$archer;
						}
						else if($archer["lettre"]=="D"){
							$archerD=$archer;
						}
					}
				
    			if(is_numeric($depart) && is_numeric($cible) && is_numeric($volee)){
//&& $archerA['id']!=0 && $archerB['id']!=0 && $archerC['id']!=0 && $archerD['id']!=0
					
					if(!is_numeric($a)){
						$a=0;
					}
					
					if(!is_numeric($b)){
						$b=0;
					}
					
					if(!is_numeric($c)){
						$c=0;
					}
					
					if(!is_numeric($d)){
						$d=0;
					}
					
					$requeteSelectScoreA="SELECT * FROM arc_scores WHERE id_archer='".$archerA['id']."' AND id_compet='".$dernierecompetition['id']."' AND volee='".$volee."'";
					$resultatSelectScoreA=mysql_query($requeteSelectScoreA);
					
					$requeteSelectScoreB="SELECT * FROM arc_scores WHERE id_archer='".$archerB['id']."' AND id_compet='".$dernierecompetition['id']."' AND volee='".$volee."'";
					$resultatSelectScoreB=mysql_query($requeteSelectScoreB);
					
					$requeteSelectScoreC="SELECT * FROM arc_scores WHERE id_archer='".$archerC['id']."' AND id_compet='".$dernierecompetition['id']."' AND volee='".$volee."'";
					$resultatSelectScoreC=mysql_query($requeteSelectScoreC);
					
					$requeteSelectScoreD="SELECT * FROM arc_scores WHERE id_archer='".$archerD['id']."' AND id_compet='".$dernierecompetition['id']."' AND volee='".$volee."'";
					$resultatSelectScoreD=mysql_query($requeteSelectScoreD);
					
					
					/*if(mysql_num_rows($resultatSelectScoreA)>0 || mysql_num_rows($resultatSelectScoreB)>0 || mysql_num_rows($resultatSelectScoreC)>0 || mysql_num_rows($resultatSelectScoreD)>0){
						echo '
						<div class="alert">
  							<a href="#" class="close" data-dismiss="alert">&times;</a>
  							<strong>Erreur,</strong> les résultats de cette volée ont déjà été saisis - Veuillez contacter l\'organisation.
						</div>'; 
					}
					else{*/
						/*if($volee>=7){
							$requeteSelectScoreA="SELECT * FROM arc_scores WHERE id_archer='".$archerA['id']."' AND id_compet='".$dernierecompetition['id']."' AND volee='6'";
							$resultatSelectScoreA=mysql_query($requeteSelectScoreA);
							$archerScoreA=mysql_fetch_array($resultatSelectScoreA);
							$a=$a+$archerScoreA["score"];
							
							$requeteSelectScoreB="SELECT * FROM arc_scores WHERE id_archer='".$archerB['id']."' AND id_compet='".$dernierecompetition['id']."' AND volee='6'";
							$resultatSelectScoreB=mysql_query($requeteSelectScoreB);
							$archerScoreB=mysql_fetch_array($resultatSelectScoreB);
							$b=$b+$archerScoreB["score"];
					
							$requeteSelectScoreC="SELECT * FROM arc_scores WHERE id_archer='".$archerC['id']."' AND id_compet='".$dernierecompetition['id']."' AND volee='6'";
							$resultatSelectScoreC=mysql_query($requeteSelectScoreC);
							$archerScoreC=mysql_fetch_array($resultatSelectScoreC);
							$c=$c+$archerScoreC["score"];
					
							$requeteSelectScoreD="SELECT * FROM arc_scores WHERE id_archer='".$archerD['id']."' AND id_compet='".$dernierecompetition['id']."' AND volee='6'";
							$resultatSelectScoreD=mysql_query($requeteSelectScoreD);
							$archerScoreD=mysql_fetch_array($resultatSelectScoreD);
							$d=$d+$archerScoreD["score"];
						}*/
					
    					//On a bien que des valeurs numériques pour les données entrées
    					//Alors on enregistre dans la base de données les scores
    					if($archerA["id"]!=0){
    						$sql="INSERT INTO arc_scores (id_archer,id_compet,volee,score,id_categorie,type_compet) VALUES('".mysql_real_escape_string($archerA["id"])."','".mysql_real_escape_string($dernierecompetition['id'])."','".mysql_real_escape_string($volee)."','".mysql_real_escape_string($a)."','".mysql_real_escape_string($archerA["categorie"])."','".mysql_real_escape_string($archerA["type_compet"])."')";
							$result=mysql_query($sql);
						}
						if($archerB["id"]!=0){
							$sql="INSERT INTO arc_scores (id_archer,id_compet,volee,score,id_categorie,type_compet) VALUES('".mysql_real_escape_string($archerB["id"])."','".mysql_real_escape_string($dernierecompetition['id'])."','".mysql_real_escape_string($volee)."','".mysql_real_escape_string($b)."','".mysql_real_escape_string($archerB["categorie"])."','".mysql_real_escape_string($archerB["type_compet"])."')";
							$result=mysql_query($sql);
						}
						if($archerC["id"]!=0){
							$sql="INSERT INTO arc_scores (id_archer,id_compet,volee,score,id_categorie,type_compet) VALUES('".mysql_real_escape_string($archerC["id"])."','".mysql_real_escape_string($dernierecompetition['id'])."','".mysql_real_escape_string($volee)."','".mysql_real_escape_string($c)."','".mysql_real_escape_string($archerC["categorie"])."','".mysql_real_escape_string($archerC["type_compet"])."')";
							$result=mysql_query($sql);
						}
						if($archerD["id"]!=0){
							$sql="INSERT INTO arc_scores (id_archer,id_compet,volee,score,id_categorie,type_compet) VALUES('".mysql_real_escape_string($archerD["id"])."','".mysql_real_escape_string($dernierecompetition['id'])."','".mysql_real_escape_string($volee)."','".mysql_real_escape_string($d)."','".mysql_real_escape_string($archerD["categorie"])."','".mysql_real_escape_string($archerD["type_compet"])."')";
							$result=mysql_query($sql);
						}
					//}
    			}
    			else{
    				echo '
    					<div class="alert">
  							<a href="#" class="close" data-dismiss="alert">&times;</a>
  							<strong>Erreur,</strong> vérifiez que les résultats sont bien au format numérique et que tous les archers de la cible sont bien inscrits.
						</div>
    				';
    			}
    		}
    	?>
    	<form action="resultats.php" method="post">
    	<input type="hidden" name="reg" value="1">
    		<table width="100%">
				<tr>
					<td width="50%"><label style="background-color:#fff;">N° Départ : </label></td>
					<td width="50%"><label style="background-color:#fff;">N° Cible : </label></td>
				</tr>
				<tr>
					<td width="50%">
					<SELECT name="depart" id="depart" style="width:110px;" onchange="window.location.href='resultats.php?cible='+document.getElementById('cible').value+'&depart='+this.value;">
					<?php
						$k=1;
						for($k=1;$k<4;$k++){
							$nomdepart="depart".$k;
							if($depart==$k){
								$$nomdepart=" selected";
							}
							else{
								$$nomdepart="";
							}
							echo '<OPTION VALUE="'.$k.'"'.$$nomdepart.'>Départ n°'.$k.'</OPTION>';
						}
					?>
					</SELECT>
					</td>
					<td width="50%">
					<!-- onchange="this.form.submit()" -->
					<SELECT name="cible" id="cible" style="width:130px;" onchange="window.location.href='resultats.php?cible='+this.value+'&depart='+document.getElementById('depart').value;">
					<?php
						$k=1;
						for($k=1;$k<25;$k++){
							$nomcible="cible".$k;
							if($cible==$k){
								$$nomcible=" selected";
							}
							else{
								$$nomcible="";
							}
							echo '<OPTION VALUE="'.$k.'"'.$$nomcible.'>Cible n°'.$k.'</OPTION>';
						}
					?>
					</SELECT>
					
					</td>
				</tr>
    		</table>
    		
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
		<table width="100%">
		<tr>
			<td width="50%"><span style="background-color:#fff;">A<br><?php echo $archerA["nom"]; ?></span></td>
			<td width="50%"><span style="background-color:#fff;">B<br><?php echo $archerB["nom"]; ?></span></td>
		</tr>
		<tr>
			<td><input type="tel" name="a" style="width:80px;"></td>
			<td><input type="tel" name="b" style="width:80px;"></td>
		</tr>
		<tr>
			<td><span style="background-color:#fff;">C<br><?php echo $archerC["nom"]; ?></span></td>
			<td><span style="background-color:#fff;">D<br><?php echo $archerD["nom"]; ?></span></td>
		</tr>
		<tr>
			<td><input type="tel" name="c" style="width:80px;"></td>
			<td><input type="tel" name="d" style="width:80px;"></td>
		</tr>
		</table>
		<input type="submit" value="Enregistrer" class="btn btn-success"><br>
		<!--<a class="btn btn-info" style="" href="classementpartiel.php?volee=<?php echo $volee; ?>">-->
		<a class="btn btn-info" style="" href="typecompet.html">
          Classement Provisoire
      	</a><br>
		<a class="btn btn-warning" style="" href="index.html">
          Retour accueil
      	</a>
      	
    	</form>
    </div>
    <style>
      
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
    </script>
    <script src="assets/js/bootstrap.js">
    </script>
  </body>
</html>
