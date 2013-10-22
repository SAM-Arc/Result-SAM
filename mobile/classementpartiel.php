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
      to the bottom of the topbar */ }
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
    <h4>Classement (provisoire volée <?php echo $_GET["volee"]; ?>) </h4>
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
    				$requeteSelectScore="SELECT * FROM arc_scores WHERE volee='".$volee."' order by score DESC";
					$resultatSelectScore=mysql_query($requeteSelectScore);

					$i=1;
					while($archer=mysql_fetch_array($resultatSelectScore)){
						if($_GET["volee"]>=2){
							$requeteSelectScoreBis="SELECT * FROM arc_scores WHERE volee='".($volee-1)."' order by score DESC";
							$resultatSelectScoreBis=mysql_query($requeteSelectScoreBis);
							$j=1;
							$clt=0;
							while($ancienclt=mysql_fetch_array($resultatSelectScoreBis)){
								if ($ancienclt['id_archer']==$archer["id_archer"]){
									$clt=$j;
								}
								else{
									if($clt==0){
										$j++;
									}
								}
							}
						}
						else{
							$j=$i;
						}
						
						$requeteSelectArcher="SELECT * FROM arc_archer WHERE id='".$archer["id_archer"]."'";
						$resultatSelectArcher=mysql_query($requeteSelectArcher);
						$participant=mysql_fetch_array($resultatSelectArcher);
						echo "<tr>
    							<td>".$i."(".($j-$i).")</td>
    							<td>".$participant["nom"]." ".$participant["prenom"]."</td>
    							<td>".$participant["club"]."</td>
    							<td>".$archer["score"]."</td>
    						  </tr>";
    					$i++;
					}	
    	
  			}
  
  		?>
  		</table>
    </div>
    <style>
      
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
    </script>
    <script src="assets/js/bootstrap.js">
    </script>
  </body>
</html>
