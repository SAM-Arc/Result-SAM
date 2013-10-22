<head>
	<meta charset="utf-8">
	<meta name="Description" content="">
	<meta name="Keywords" content="">
	<meta name="Subject" content="">
	<meta name="Author" content="">
	<meta name="Identifier-Url" content="">
	<meta name="Reply-To" content="contact@louisauthie.fr">
	<meta name="Revisit-After" content="2 days">
	<meta name="Robots" content="all">
	<meta name="Rating" content="general">
	<meta name="Distribution" content="global">
	<meta name="Category" content="">
	<title>Interface d'administration - Biotex France</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script SRC="assets/js/bootbox.min.js"></script>
	
	<script type="text/javascript">
	function afficherConfirmationSupprimerCompet(id_compet){
		bootbox.confirm("Etes-vous sûr de vouloir supprimer cette compétition ?", function(result) {
			if(result==true){
  				document.location.href = "index.php?p=competitions&del="+id_compet;
  			}
  			else{
  			}
		}); 
	}
	</script>
	
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<style>
		.droite{
			text-align:right;
		}
		.centre{
			text-align:center;
		}
	</style>
</head>