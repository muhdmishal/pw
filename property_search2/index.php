
	<?php
	 
	 include '../includes/property_search_header.html';
	
	 
	//Upload File
	if (isset($_POST['submit'])) {
	   
	//   require_once './dbhandler.php'
	   require_once './dbapi.php' ;
	//   include ('prop.php') ; 
	//   include ('dbapi.php');
	   
	   $dbc = new dbapi();
	   
	   if (!empty($_REQUEST['toSearch'])) {				
				   
				echo "<h2 class='basic-grey' style='margin-top:80px; margin-left:20px; font-size:13pt; font-weight:300;'>Sold Prices for : ".$_REQUEST['toSearch'].'<br></h2>';
				$dbc->searchFor($_REQUEST['toSearch']);
			
				
		}
	 } else { 
	 
	
		print "<form action='' method='post' class='basic-grey1'>"; 

		print '<input type="text" name="toSearch" placeholder=" Search by post code road name or area" /><br /> ';

		print '<input type="submit" name="submit" value="Search" /> ';

	}
	include ('../includes/property_search_footer.html');
	?>	
	 