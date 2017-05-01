<?php



		include 'dbc.php';
		page_protect();
		include 'includes/myaccount-header.html';


 		function redirect($url)
		{
			if (!headers_sent())
			{
				header('Location: '.$url);
				exit;
			}
			else
			{
				echo '<script type="text/javascript">';
				echo 'window.location.href="'.$url.'";';
				echo '</script>';
				echo '<noscript>';
				echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
				echo '</noscript>';
				exit;
			}
		}






		$rs_settings = mysqli_query($link,"select * from users where id='$_SESSION[user_id]'");

		$ids = mysqli_fetch_row($rs_settings );

	   require_once 'dbapi.php' ;

	require_once 'property.php';

	   $dbc = new DBAPI();

	   if ( isset($_GET['priceMin']) && !empty($_GET['priceMin']))
	   		$priceMin = $_GET['priceMin'];
		else
			$priceMin =  0 ;

	   if (isset($_GET['priceTo']) && !empty($_GET['priceTo']))
	   		$priceTo = $_GET['priceTo'];
		else
			$priceTo =  999999999999  ;

	   if (isset($_GET['type']) && !empty($_GET['type']))
	   		$type = $_GET['type'];
		else
			$type =  '' ;

	   if (isset($_GET['postcode']) && !empty($_GET['postcode']))
	   		$postcode = $_GET['postcode'];
		else
			$postcode =  '' ;

	   if (isset($_GET['bedMin']) && !empty($_GET['bedMin']))
	   		$bedMin = $_GET['bedMin'];
		else
			$bedMin =  0 ;

		if (isset($_GET['bedTo']) && !empty($_GET['bedTo']))
	   		$bedTo = $_GET['bedTo'];
		else
			$bedTo =  999999 ;


		$sqlSearch = "SELECT * FROM `property` WHERE `price` <= '$priceTo'  AND `price` >= '$priceMin' AND `type`=$type AND `bedrooms` <= '$bedTo'";
		$sqlSearch .= " AND `bedrooms` >= '$bedMin' ";

		if ($postcode != '')
			$sqlSearch .= " AND `postcode` = '$postcode' " ;


		$results = $dbc->searchProperties($sqlSearch) ;


		if ($results == 0 )
			echo "No results ! " ;
		else {
		 while ($row = $results->fetch_assoc()) {
        	//	printf ("%s (%s)\n", $row["Name"], $row["CountryCode"]);

			$propID = $row['id'];
			$propPrice = $row['price'];
			$propType = $dbc->getHouseType($row['type']);
			$propStreet = $row['street'];
			$propAdd2 = $row['address2'];
			$propTown = $row['town'];
			$propCountry = $row['country'];
			$propPostCode = $row['postcode'];
			$propBeds = $row['bedrooms'];
			$propBaths = $row['bathrooms'];
			$propDesc = $row['description'];

			$propDescR = substr($propDesc , 0 , 100);


			//get  3 images of a prop


			$images = $dbc->getPropImages($propID);

			$numimgs = sizeof($images);

			$img1 = './';
			$img2 = './';
			$img3 = './';

			if($numimgs > 0 )
				$img1 = $images[0];

			if($numimgs > 1 )
				$img2 = $images[1];

			if($numimgs > 2 )
				$img3 = $images[2];
			include 'includes/sidebar.html';



		echo 	'

			<div class="search-result">
  <div class="listing-right">
    <div class="mini-description">
      <div class="view-button">
        <p><a href="http://propertywing.co.uk/login2/showprop.php?idprop='.$propID.'">View detials</a></p>
      </div>
      <h2 style="color:#40659c; margin-bottom:-10px;">&pound;'.$propPrice.'</h2>
      <h3 style="color:#3244CD; margin-bottom:-10px;">'.$propBeds.' Bedrooms '.$propType.'</h3>
      <h3 style="color:#40659c;"><strong>'.$propStreet.' '.$propAdd2.' , '.$propTown.' , '.$propCountry.' , '.$propPostCode.'</strong></h3>
      <p>'.$propDescR.'....<a href="http://propertywing.co.uk/login2/showprop.php?idprop='.$propID.'">read more</a></p>
      <p><a href="#">Contact Seller</a> - <a href="http://propertywing.co.uk/login2/showprop.php?idprop='.$propID.'">View Property</a></p>
    </div>
  </div>
  <img src="'.$img1.'" />';
  if ($img2 != './')
  	echo '<div class="small-images-left"> <img src="'.$img2.'" /> </div>';
  if ($img3 != './')
  	echo '<div class="small-images-right"> <img src="'.$img3.'" /> </div>';

echo '
</div>




		';



	}



}






include ('includes/footer.html') ;
?>
