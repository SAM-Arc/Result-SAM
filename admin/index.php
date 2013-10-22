<?php
session_start();
include("libs/dbconnection.php");
?>
<!DOCTYPE html>
<html lang="fr">
<?php
//Gestion des variables GET
if(!isset($_GET["p"])||empty($_GET["p"])){
	//Si rien n'est fixé comme pages
	$_GET["p"]="accueil";
}
if(!isset($_GET["sp"])||empty($_GET["sp"])){
	//Si rien n'est fixé comme sous-pages
	$_GET["sp"]="";
}



if($_GET["sp"]==""){
	//Si on est sur la page de catégorie
	//On fixe le header
	$suffixeHeader=$_GET["p"]."_header.php";
	//On fixe le controleur et le template
	$suffixeCtr=$_GET["p"]."_ctr.php";
	$suffixeTpl=$_GET["p"]."_tpl.php";
}
else{
	//Si on est sur la sous-page de catégorie
	//On fixe le header
	$suffixeHeader=$_GET["sp"]."/".$_GET["sp"]."_header.php";
	//On fixe le controleur et le template
	$suffixeCtr=$_GET["sp"]."/".$_GET["sp"]."_ctr.php";
	$suffixeTpl=$_GET["sp"]."/".$_GET["sp"]."_tpl.php";
}

//On inclue le controleur et la vue dans la page en fonction de la variable GET
if(file_exists("libs/".$_GET["p"]."/".$suffixeCtr) && file_exists("libs/".$_GET["p"]."/".$suffixeTpl) && file_exists("libs/".$_GET["p"]."/".$suffixeHeader)){

	include("libs/".$_GET["p"]."/".$suffixeHeader);
	
	echo "<body><div class='clearfix' style='text-align:center;width:100%;'><center><table style=''><tr><td><!--<img src='logobiotex.png' style='height:100px;'>--></td><td style='width:30px;'></td><td><h1>Result'SAM - Interface administration</h1></td></tr></table></center></div>";
	include("libs/".$_GET["p"]."/".$suffixeCtr);
	include("libs/".$_GET["p"]."/".$suffixeTpl);
}
else{
	include("libs/erreurs/404.php");
}

//On inclue le footer de la page
include("libs/footer.php");
?>
</body>
</html>