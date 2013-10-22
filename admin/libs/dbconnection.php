<?php
	 $serveur="localhost";
	 $identifiant="root";
	 $motDePasse="";
	 
	 $nomBase="resultsam";
	
	 $connection=mysql_connect($serveur,$identifiant, $motDePasse);
	 $db=mysql_select_db($nomBase);
	 
?>