
<?

require_once("actions/Action.inc.php");

class ExportAction extends Action {

	
	public function run() {

	  /** 
      * Permet d'exporter les résultats des sondages sous format PDF ou Excel
      */
		
		if ($this->getSessionLogin()===null) {
			$this->setMessageView("Vous devez être authentifié.", "alert-error");
			return;
		}

      $data = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $_POST['disponibility']);
		$data = unserialize($data);

	
		if(isset($_POST['exportToPDF'])){
			
			$pdf = new FPDF();
			$pdf->SetTitle('Resultat du sondage');
			$pdf->SetFont('Arial','',14);
	   	$pdf->AddPage();
			
			$pdf->Cell(50,10,'Resultat du sondage',1,0,'C');
    		$pdf->Ln(20);

			foreach($data as $line){ 
				foreach($line as $content){
					if($content[1] == "black"){
					
					$pdf->Cell(40,6, utf8_decode($content[0]),1,0,'C', true);	
					$pdf->SetFillColor(976,245,458);
				}
            
				if($content[1] != "black"){
					$lenght =  $content[1];
			   	$pdf->Cell($lenght*40,6, utf8_decode($content[0]),1,0,'C'); 		  
				} 		
		   }

		   $pdf->Ln();	
	    }
	    $pdf->Output();
	}


	if(isset($_POST['exportToExcel'])){


		$objPHPExcel = new PHPExcel();
		$objPHPExcel->setActiveSheetIndex(0);

		$alpha = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J");

         $i = 1;
			foreach($data as $line){ 
				$j = 0;
				foreach($line as $content){
			 		$objPHPExcel->getActiveSheet()->SetCellValue($alpha[$j].$i, $content[0]);
					$j++;	  
				}
            $i++;
	       }

	 	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter->save('file/sondage.xlsx');
		chmod("file/sondage.xlsx", 0777);
 		
		$localPath = realpath("file/sondage.xlsx");

		if (!file_exists($localPath)) {
  			exit("Cannot find file located at '$localPath'");
		}

		ob_clean();

		header('Pragma: public'); 
		header('Content-Length: '.filesize($localPath));  
		header('Content-Type: application/octet-stream');  
		header('Content-Disposition: attachment; filename="sondage.xlsx"');  
		header('Content-Transfer-Encoding: binary');  
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0', false);  
		header('Cache-Control: private', false); 

		readfile($localPath);
		exit;
	    		 
	}

}
}
