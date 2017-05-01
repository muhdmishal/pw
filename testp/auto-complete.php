<?php
	require_once './dbapi.php' ; 
	
	if (!isset($_GET['keyword'])) {
		die("");
	}
	
	$key=$_GET['keyword'];
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
echo json_encode($array, JSON_HEX_APOS);