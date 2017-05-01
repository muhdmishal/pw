<?php
    
	require_once './dbapi.php' ; 
	
	
	$key=$_GET['key'];
    $array = array();
   
    echo $key ; 
   
	$dbc = new DBAPI(); 
   
    $fp = fopen('./logs.txt' , 'a');
	fwrite($fp , $key.' | ');
	
	$array = $dbc->getPrediction($key);
	fwrite($fp , 'Result '.$array[0].PHP_EOL);
	fclose($fp);
		
    echo json_encode($array);
?>
