<?php
include("../../libs/dbconnection.php");
	if(isset($_GET["mdp"]) && $_GET["mdp"]=="ilovelarge"){
	$requeteSelect="SELECT * FROM joueurs ORDER BY id_equipe ASC";
	$resultatSelect=mysql_query($requeteSelect);
	
	$ligne=1;
	
	//– On inclus les fichiers PHPExel
	include 'library/PHPExcel.php';
	include 'library/PHPExcel/Writer/Excel2007.php';
			
	// Create a new PHPExcel object
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getActiveSheet()->setTitle('Récapitulatif des Participants');
    
    $objPHPExcel->getActiveSheet()->setCellValue('A1','Nom');
    $objPHPExcel->getActiveSheet()->setCellValue('B1','Prénom');
    $objPHPExcel->getActiveSheet()->setCellValue('C1','Email');
    $objPHPExcel->getActiveSheet()->setCellValue('D1','Téléphone');
    $objPHPExcel->getActiveSheet()->setCellValue('E1','Adresse');
    $objPHPExcel->getActiveSheet()->setCellValue('F1','Code Postal');
    $objPHPExcel->getActiveSheet()->setCellValue('G1','Ville');
    $objPHPExcel->getActiveSheet()->setCellValue('H1','Type Pièce ID');
    $objPHPExcel->getActiveSheet()->setCellValue('I1','Numero ID');
    $objPHPExcel->getActiveSheet()->setCellValue('J1','Parametres Depart');
    $objPHPExcel->getActiveSheet()->setCellValue('K1','Employeur');
    $objPHPExcel->getActiveSheet()->setCellValue('L1','Fonction');
    $objPHPExcel->getActiveSheet()->setCellValue('M1','Mode de Transport');
    $objPHPExcel->getActiveSheet()->setCellValue('N1','Paramètre Arrivée');
    $objPHPExcel->getActiveSheet()->setCellValue('O1','Ecole');
    $objPHPExcel->getActiveSheet()->setCellValue('P1','Promo');
    $objPHPExcel->getActiveSheet()->setCellValue('Q1','Equipe');
    $objPHPExcel->getActiveSheet()->setCellValue('R1','Ancien/Etudiant');
    $objPHPExcel->getActiveSheet()->setCellValue('S1','Capitaine');
    $objPHPExcel->getActiveSheet()->setCellValue('T1','Relais Capitaine');
    $objPHPExcel->getActiveSheet()->setCellValue('U1','Arbitre');
    
    // Freeze pane so that the heading line will not scroll
    $objPHPExcel->getActiveSheet()->freezePane('A2');
    
    
    $ligne++;
    
    while($joueur=mysql_fetch_array($resultatSelect)){
    if($joueur["estlajeudi"]==1){
    	$estlajeudi="Oui";
    }
    else{
    	$estlajeudi="Non";
    }
    if($joueur["est_ancien"]==1){
    	$est_ancien="Ancien";
    }
    else{
    	$est_ancien="Etudiant";
    }
    
    $est_capitaine="Non";
    if($joueur["est_capitaine"]==1){
    	$est_capitaine="Oui";
    }

    $est_arbitre="Non";
    if($joueur["est_arbitre"]==1){
    	$est_arbitre="Oui";
    }
    
    $est_responsable="Non";
    if($joueur["est_responsable"]==1){
    	$est_responsable="Oui";
    }
    
    $req="SELECT * FROM equipes WHERE id_equipe='".$joueur["id_equipe"]."'";
	$res=mysql_query($req);
	$equipe=mysql_fetch_array($res);
    
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$ligne,$joueur["nom"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$ligne,$joueur["prenom"]);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$ligne,$joueur["email"]);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$ligne,$joueur["telephone"]);
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$ligne,$joueur["adresse"]);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$ligne,$joueur["codepostal"]);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$ligne,$joueur["ville"]);
    $objPHPExcel->getActiveSheet()->setCellValue('H'.$ligne,$joueur["natureid"]);
    $objPHPExcel->getActiveSheet()->setCellValue('I'.$ligne,$joueur["numero_id"]);
    $objPHPExcel->getActiveSheet()->setCellValue('J'.$ligne,$joueur["lieuheuredepart"]);
    $objPHPExcel->getActiveSheet()->setCellValue('K'.$ligne,$joueur["employeur"]);
    $objPHPExcel->getActiveSheet()->setCellValue('L'.$ligne,$joueur["fonction"]);
    $objPHPExcel->getActiveSheet()->setCellValue('M'.$ligne,$joueur["modetransport"]);
    $objPHPExcel->getActiveSheet()->setCellValue('N'.$ligne,$joueur["lieuheurearrivee"]);
    $objPHPExcel->getActiveSheet()->setCellValue('O'.$ligne,$joueur["ecole"]);
    $objPHPExcel->getActiveSheet()->setCellValue('P'.$ligne,$joueur["promo"]);
    $objPHPExcel->getActiveSheet()->setCellValue('Q'.$ligne,$equipe["nom"]);
    $objPHPExcel->getActiveSheet()->setCellValue('R'.$ligne,$est_ancien);
    $objPHPExcel->getActiveSheet()->setCellValue('S'.$ligne,$est_capitaine);
    $objPHPExcel->getActiveSheet()->setCellValue('T'.$ligne,$est_responsable);
    $objPHPExcel->getActiveSheet()->setCellValue('U'.$ligne,$est_arbitre);
    
    $ligne++;
	}

    // Save as an Excel BIFF (xls) file
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

   header('Content-Type: application/vnd.ms-excel');
   header('Content-Disposition: attachment;filename="large.xls"');
   header('Cache-Control: max-age=0');

   $objWriter->save('php://output');
   exit();
   }
?>