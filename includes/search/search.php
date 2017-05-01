<?php
/************************************************
	The Search PHP File
************************************************/


/************************************************
	MySQL Connect
************************************************/

require_once './dbapi.php';

$dbc = new DBAPI();


/************************************************
	Search Functionality
************************************************/

// Define Output HTML Formating
$html = '';
$html .= '<li class="result">';
$html .= '<a target="_blank" href="urlString">';
$html .= '<h3>nameString</h3>';
$html .= '<h4>functionString</h4>';
$html .= '</a>';
$html .= '</li>';

// Get Search
$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);

$res = $dbc->autocomplete($search_string);

foreach ($res as $r)
	echo $r ; 




/*
// Build Function List (Insert All Functions Into DB - From PHP)

// Compile Functions Array
$functions = get_defined_functions();
$functions = $functions['internal'];

// Loop, Format and Insert
foreach ($functions as $function) {
	$function_name = str_replace("_", " ", $function);
	$function_name = ucwords($function_name);

	$query = '';
	$query = 'INSERT INTO search SET id = "", function = "'.$function.'", name = "'.$function_name.'"';

	$tutorial_db->query($query);
}
*/
?>