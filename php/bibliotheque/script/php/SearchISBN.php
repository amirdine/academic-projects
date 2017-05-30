<?php

	   	
	 $dbHost = $_SERVER['dbHost'];
		$dbBd = $_SERVER['dbBd'];
		$dbPass = $_SERVER['dbPass'];
		$dbLogin = $_SERVER['dbLogin'];
   
		
   /*
	 	$dbHost  = 'localhost';
		$dbBd    = 'bibliotheque';
		$dbPass  = 'd8gfh';
		$dbLogin = 'root';
   */
      
   
	
 
	
	if (isset($_GET['term'])){
	$return_arr = array();

	try {
	    $conn = new PDO("mysql:host=".$dbHost.";port=8889;dbname=".$dbBd,$dbLogin, $dbPass);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    
	    $stmt = $conn->prepare('SELECT ISBN FROM LIVRE WHERE ISBN LIKE :term');
	    $stmt->execute(array('term' => '%'.$_GET['term'].'%'));
	    
	    while($row = $stmt->fetch()) {
	        $return_arr[] =  $row['ISBN'];
	    }

	} catch(PDOException $e) {
	    echo 'ERROR: ' . $e->getMessage();
	}


    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}


?>
