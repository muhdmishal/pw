<?php
	require_once 'dbapi.php' ;

	if($_POST)
	{
		$key = $_POST['search'];
		$array = array();



		$dbc = new DBAPI();

		$fp = fopen('logs.txt' , 'a');
		fwrite($fp , $key.' | ');

		$array = $dbc->getPrediction($key);
		fwrite($fp , 'Result '.$array[0].PHP_EOL);
		fclose($fp);

		$result = array_unique($array);

		foreach($result as $ar){


			echo '<span><b>';
			echo $ar;
			echo '</b></span><br>';

			//echo json_encode($array);
		}

	}
?>
