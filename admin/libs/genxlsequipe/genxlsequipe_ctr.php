<?php
include("dbconnection.php");
	if(isset($_GET["mdp"]) && $_GET["mdp"]=="ilovelarge"){
	
	$requeteSelect1="SELECT * FROM equipes where id_equipe='".$_GET["idequipe"]."'";
	$resultatSelect1=mysql_query($requeteSelect1);
	$dataequipe=mysql_fetch_array($resultatSelect1);
	$requeteSelect="SELECT * FROM joueurs WHERE id_equipe='".$_GET["idequipe"]."'";
	$resultatSelect=mysql_query($requeteSelect);
	
	$ligne=4;
	
	//– On inclus les fichiers PHPExel
	include 'library/PHPExcel.php';
	include 'library/PHPExcel/Writer/Excel2007.php';
			
	// Create a new PHPExcel object
    $objPHPExcel = new PHPExcel();
    $objPHPExcel->getActiveSheet()->setTitle('Récapitulatif Equipe');
    
    $objPHPExcel->getActiveSheet()->setCellValue('A2','Nom Equipe :'.$dataequipe["nom"]);
    
    $objPHPExcel->getActiveSheet()->setCellValue('A4','Nom et Prénom');
    $objPHPExcel->getActiveSheet()->setCellValue('B4','Ecole et année de sortie');
    $objPHPExcel->getActiveSheet()->setCellValue('C4','Adresse');
    $objPHPExcel->getActiveSheet()->setCellValue('D4','Code Postal et ville');
    $objPHPExcel->getActiveSheet()->setCellValue('E4','Téléphone');
    $objPHPExcel->getActiveSheet()->setCellValue('F4','Email');
    $objPHPExcel->getActiveSheet()->setCellValue('G4','Employeur');
    $objPHPExcel->getActiveSheet()->setCellValue('H4','Fonction');
    $objPHPExcel->getActiveSheet()->setCellValue('I4','Nature et n° pièce d\'identité');
    $objPHPExcel->getActiveSheet()->setCellValue('J4','Site alumni et PW');
    $objPHPExcel->getActiveSheet()->setCellValue('K4','Mode de transport');
    $objPHPExcel->getActiveSheet()->setCellValue('L4','Lieu & heure d\'arrivée');
    $objPHPExcel->getActiveSheet()->setCellValue('M4','Lieu & heure de départ');
    $objPHPExcel->getActiveSheet()->setCellValue('N4','Statut (C : Capitaine; R : Relais capitaine)');
    
    // Freeze pane so that the heading line will not scroll
    $objPHPExcel->getActiveSheet()->freezePane('A5');
    
    
    $ligne++;
    
    while($joueur=mysql_fetch_array($resultatSelect)){
    $r=array_map("stripslashes",$joueur);
    $statut="";
    if($joueur["est_capitaine"]==1){
    	$statut.="C ";
    }
    if($joueur["est_responsable"]==1){
    	$statut.="R ";
    }
    
    $req="SELECT * FROM equipes WHERE id_equipe='".$joueur["id_equipe"]."'";
	$res=mysql_query($req);
	$equipe=mysql_fetch_array($res);
	$r=array_map("stripslashes",$equipe);
	$r=array_map("stripslashes",$joueur);
    
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$ligne,$joueur["nom"]." ".$joueur["prenom"]);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$ligne,$dataequipe["ecole"]." - Promo : ".$joueur["promo"]);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$ligne,$joueur["adresse"]);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$ligne,$joueur["codepostal"]." ".$joueur["ville"]);
    
    //$objPHPExcel->getActiveSheet()->setCellValue('E'.$ligne,$joueur["telephone"]);
    $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$ligne,$joueur["telephone"],PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$ligne,$joueur["email"]);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$ligne,$joueur["employeur"]);
    $objPHPExcel->getActiveSheet()->setCellValue('H'.$ligne,$joueur["fonction"]);
    $objPHPExcel->getActiveSheet()->setCellValue('I'.$ligne,$joueur["natureid"]." n°".$joueur["numero_id"]);
    $objPHPExcel->getActiveSheet()->setCellValue('J'.$ligne,$dataequipe["alumni"]." id/pass : ".$dataequipe["passalumni"]);
    $objPHPExcel->getActiveSheet()->setCellValue('K'.$ligne,$joueur["modetransport"]);
    $objPHPExcel->getActiveSheet()->setCellValue('L'.$ligne,$joueur["lieuheurearrivee"]);
    $objPHPExcel->getActiveSheet()->setCellValue('M'.$ligne,$joueur["lieuheuredepart"]);
    $objPHPExcel->getActiveSheet()->setCellValue('N'.$ligne,$statut);
    
    $ligne++;
	}
	
	$default_border = array(
    'style' => PHPExcel_Style_Border::BORDER_THIN,
	);
	$style_header = array(
    	'borders' => array(
        	'bottom' => $default_border,
        	'left' => $default_border,
        	'top' => $default_border,
        	'right' => $default_border,
    	),
    	'fill' => array(
        	'type' => PHPExcel_Style_Fill::FILL_SOLID,
        	'color' => array('rgb'=>'CCCCCC'),
    	),
    		'font' => array(
       	 	'bold' => false,
    	)
);	

$style_normal = array(
    	'borders' => array(
        	'bottom' => $default_border,
        	'left' => $default_border,
        	'top' => $default_border,
        	'right' => $default_border,
    	),
);

$objPHPExcel->getActiveSheet()->getStyle('A5:N'.$ligne)->applyFromArray( $style_normal );
$objPHPExcel->getActiveSheet()->getStyle('A4')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('B4')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('C4')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('D4')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('E4')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('F4')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('G4')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('H4')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('I4')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('J4')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('K4')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('L4')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('M4')->applyFromArray( $style_header );
$objPHPExcel->getActiveSheet()->getStyle('N4')->applyFromArray( $style_header );

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);


for($j=5;$j<=$ligne;$j++){

$objPHPExcel->getActiveSheet()->getStyle('A'.$j)->applyFromArray( $style_normal );
$objPHPExcel->getActiveSheet()->getStyle('B'.$j)->applyFromArray( $style_normal );
$objPHPExcel->getActiveSheet()->getStyle('C'.$j)->applyFromArray( $style_normal );
$objPHPExcel->getActiveSheet()->getStyle('D'.$j)->applyFromArray( $style_normal );
$objPHPExcel->getActiveSheet()->getStyle('E'.$j)->applyFromArray( $style_normal );
$objPHPExcel->getActiveSheet()->getStyle('F'.$j)->applyFromArray( $style_normal );
$objPHPExcel->getActiveSheet()->getStyle('G'.$j)->applyFromArray( $style_normal );
$objPHPExcel->getActiveSheet()->getStyle('H'.$j)->applyFromArray( $style_normal );
$objPHPExcel->getActiveSheet()->getStyle('I'.$j)->applyFromArray( $style_normal );
$objPHPExcel->getActiveSheet()->getStyle('J'.$j)->applyFromArray( $style_normal );
$objPHPExcel->getActiveSheet()->getStyle('K'.$j)->applyFromArray( $style_normal );
$objPHPExcel->getActiveSheet()->getStyle('L'.$j)->applyFromArray( $style_normal );
$objPHPExcel->getActiveSheet()->getStyle('M'.$j)->applyFromArray( $style_normal );
$objPHPExcel->getActiveSheet()->getStyle('N'.$j)->applyFromArray( $style_normal );

}

function autoFitColumnWidthToContent($sheet, $fromCol, $toCol) {
        if (empty($toCol) ) {//not defined the last column, set it the max one
            $toCol = $sheet->getColumnDimension($sheet->getHighestColumn())->getColumnIndex();
        }
        for($i = $fromCol; $i <= $toCol; $i++) {
            $sheet->getColumnDimension($i)->setAutoSize(true);
        }
        $sheet->calculateColumnWidths();
    }
    

    // Save as an Excel BIFF (xls) file
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

   header('Content-Type: application/vnd.ms-excel');
   header('Content-Disposition: attachment;filename="'.$dataequipe["nom"].'.xls"');
   header('Cache-Control: max-age=0');

   $objWriter->save('php://output');
   exit();
   }
?>