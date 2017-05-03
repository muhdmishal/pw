<?php


		require_once ('dbc.php');
		//page_protect();
		$userID = $_SESSION[user_id] ;
		if($userID > 0)
{
	include 'includes/header1.php';
}
else{
	include 'includes/headerindex.php';
}
/*           include 'includes/sidebar.html';
*/

 	?>
<div class=" bg-image-fixed">
<div class="container">
  <div class="row">
    <div class="col-sm-8">
    <span style="color:#000000; font-size:24px; font-weight:normal !important; text-align:left !important;" class="title form-back">Your Search Results</span>
      <?php

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





		$rs_settings = mysqli_query($link,"select * from users where `user_id`='$_SESSION[user_id]'");

		$ids = mysqli_fetch_row($rs_settings );

	   	require_once 'dbapi.php' ;

		require_once 'property.php';

	   $dbc = new DBAPI();



	   $searchfor = '';
		if (isset($_GET['locationIdentifier'] ))
		{
			$searchfor = $_GET['locationIdentifier'];
      $searchfor = str_replace(" ","",$searchfor);
			$locations = $dbc->getPostcode($searchfor) ;
			// commented by me . $locationIdentifier = $locations[0];
      $locationIdentifier = $searchfor;
		}
 		else
    {
      $locationIdentifier = '';

		  $locations = array();
    }

 		if ($searchfor != ''){

			$locations = $dbc->getPostcode($searchfor) ;
		}

	   if ( isset($_GET['minPrice']) && !empty($_GET['minPrice']))
	   		$priceMin = $_GET['minPrice'];
		else
			$priceMin =  0 ;

	   if (isset($_GET['maxPrice']) && !empty($_GET['maxPrice']))
	   		$priceTo = $_GET['maxPrice'];
		else
			$priceTo =  999999999999  ;

	   if (isset($_GET['houseTypeID']) && !empty($_GET['houseTypeID']))
	   		$type = $_GET['houseTypeID'];
		else
			$type =  '' ;

	   if (isset($_GET['bedMin']) && !empty($_GET['bedMin']))
	   		$bedMin = $_GET['bedMin'];
		else
			$bedMin =  0 ;

		if (isset($_GET['bedTo']) && !empty($_GET['bedTo']))
	   		$bedTo = $_GET['bedTo'];
		else
			$bedTo =  99999999 ;
		if (isset($_GET['status']) && !empty($_GET['status']))
	   		$searchstatus = $_GET['status'];
		else
			$searchstatus =  1 ;


		$sqlSearch = "SELECT * FROM `property` WHERE `price` <= '$priceTo'  AND `price` >= '$priceMin' AND `bedrooms` <= '$bedTo'";
		$sqlSearch .= " AND `bedrooms` >= '$bedMin' AND `status` = '$searchstatus'";

		if ($type != '')
			$sqlSearch .= " AND `type`='".$type."'";

    if(isset($_GET['radius']))
		{
			if($_GET['radius'] != 0.0)
			{
				$milesRange = $_GET['radius'];
			}
			else
			{
				$milesRange = 0;
			}
		}
		else
		{
			$milesRange = 0;
		}
    if($dbc->postcodeExist($searchfor)) {
      $searchforarray = $dbc->getPostcodeLatLng($searchfor);
      $postcodes = $dbc->getNearPostcodes($searchforarray, $milesRange) ;
    }
			$sqlSearch .= " AND `postcode` IN ('".implode("','",$postcodes)."') " ;

      $sqlSearch .= " ORDER BY `property_id` DESC LIMIT 0 , 20" ;

		$results = $dbc->searchProperties($sqlSearch) ;


		//get all properties
		$allprops = array();
		if ($results == 0 )
			echo "No results ! " ;
		else
		{
		 	while ($row = $results->fetch_assoc())
		 	$allprops[] = $row ;
		}

		$propsInRange = $allprops;

		if (sizeof($propsInRange) == 0 )
			echo "No results !";
		else {
		foreach( $propsInRange as $row){
        	//	printf ("%s (%s)\n", $row["Name"], $row["CountryCode"]);
    		$status = $row['status'];

			$propID = $row['property_id'];
			$propPrice = $row['price'];
			$propType = $dbc->getHouseType($row['type']);
			$propStreet = $row['street'];
			$propAdd2 = $row['address'];
			$propTown = $row['town'];
			$propCountry = $row['country'];
			$propPostCode = $row['postcode'];
			$propBeds = $row['bedrooms'];
			$propBaths = $row['bathrooms'];
			$propDesc = $row['description'];

			$propDescR = substr($propDesc , 0 , 200);


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

echo "<div class='col-sm-12 form-back searchresult'>
                <div class='row'>
		   <h2 class='pull-left'>&pound;".number_format ( $propPrice ,2 ,"." , "," )."</h2>
			<h2 class='pull-right color-green'><strong>".$propBeds." Bedrooms ".$propType."</strong></h2>
			</div>
              <div class='block-img col-sm-3'>
                  <img src=".$img1." />";
						  if ($img2 != './')
  	echo '<div class="small-images-left"><img src="'.$img2.'" /></div>';
  if ($img3 != './')
  	echo '<div class="small-images-right"> <img src="'.$img3.'" /> </div>';

                 echo  "
              </div>
              <div class='block-text col-sm-9'>





         <h3>".$propStreet." ".$propAdd2." , ".$propTown." , ".$propCountry." , ".$propPostCode."</h3>
					<div class='hidden-xs'>
					<p><strong>Description</strong></p>
                  <p class='para'>".$propDescR."....<a href='showprop.php?idprop=".$propID."' class='atag1'>read more</a></p>
                 <p class='para2'><a href='showprop.php?idprop=".$propID."' class='atag1'>Contact Seller</a> - <a href='showprop.php?idprop=".$propID."' class='atag1'>View Property</a></p>
              </div>
			  <a href='showprop.php?idprop=".$propID."' class='btn  viewfull button pull-right'>View Full Detials</a>
			  </div>
			  <div class='clear'></div>
       </div>"

	?>
      <?php
/*echo 	'<div class="col-sm-9 form-back">
  <div class="listing-right" style="overflow:hidden;">
    <div class="mini-description">
      <div class="view-button">
        <p><a href="showprop.php?idprop='.$propID.'">View detials</a></p>
      </div>
      <h2 style="color:#40659c; margin-bottom:0px;width:100%">&pound;'.$propPrice.'</h2>
      <h3 style="color:#3244CD; margin-bottom:-10px;font-size: 20px;">'.$propBeds.' Bedrooms '.$propType.'</h3>
      <h3 style="color:#40659c; font-size: 20px;"><strong>'.$propStreet.' '.$propAdd2.' , '.$propTown.' , '.$propCountry.' , '.$propPostCode.'</strong></h3>
      <p>'.$propDescR.'....<a href="showprop.php?idprop='.$propID.'">read more</a></p>
      <p style="width:100%"><a href="#">Contact Seller</a> - <a href="showprop.php?idprop='.$propID.'">View Property</a></p>
    </div>
  </div>
  <img src="'.$img1.'" />';
  if ($img2 != './')
  	echo '<div class="small-images-left"></div>';
  if ($img3 != './')
  	echo '<div class="small-images-right"> <img src="'.$img3.'" /> </div>';

echo '
</div>	';*/
?>
      <?php
	}?>
      <?php }
?>
    </div>

    <div class="col-sm-4 ">
      <!--<div class="section"> <span class="title txttitle">My Account</span>
        <div class="footer-icon"> <a href="#" class="footicon-text"><span class="ft-icon"><img src="images/user-ico.png" alt="map" /></span><strong>My Account Settings</strong></a> </div>
        <div class="footer-icon"> <a href="#" class="footicon-text"><span class="ft-icon"><img src="images/log.png" alt="cell" /></span><strong>Log Out</strong></a> </div>
      </div>-->
      <div >
        <span style="color:#000000; font-size:24px; font-weight:normal !important; text-align:left !important;" class="title form-back">Refine Search</span>
        <form role="form" class="form-back" method="get" enctype="multipart/form-data" action="showsearchresults.php">

          <div class="col-xs-12 selectContainer">
      <center><div class="btn-group" data-toggle="buttons">
  		<label class="btn btn-primary active">
   			 <input type="radio" onchange="price(this.value)" name="status" id="option1" value="1" autocomplete="off" checked> Property For Sale
  		</label>
  		<label class="btn btn-primary">
    		<input type="radio" onchange="price(this.value)"  name="status" id="option2" value="2" autocomplete="off"> Property To Let
  		</label>


  	</div>
  	</center>


	</div>
      <div class="col-xs-12 selectContainer">
      <div id="suggest">
        <label for="InputName">Location : <?php echo $searchfor ?> </label>

        <input type="text" style="background-color:#FFFFFF !important;" class="double form-control input-border" id="locationIdentifier" name="locationIdentifier"  value="<?php echo $searchfor ?>" />
        </div>
      </div>
          <div class="col-sm-6 selectContainer">
            <label for="radius">Search Radius</label>
            <select id="radius" name="radius" class="double form-control input-border">
              <option value="0.0" <?php if ($milesRange == 0) echo 'selected' ; ?> >This area only</option>
              <option value="0.25" <?php if ($milesRange == 0.25) echo 'selected' ; ?>>Within &frac14; mile</option>
              <option value="0.5" <?php if ($milesRange == 0.5) echo 'selected' ; ?>>Within &frac12; mile</option>
              <option value="1.0" <?php if ($milesRange == 1) echo 'selected' ; ?>>Within 1 mile</option>
              <option value="3.0" <?php if ($milesRange == 3) echo 'selected' ; ?>>Within 3 miles</option>
              <option value="5.0" <?php if ($milesRange == 5) echo 'selected' ; ?>>Within 5 miles</option>
              <option value="10.0" <?php if ($milesRange == 10) echo 'selected' ; ?>>Within 10 miles</option>
              <option value="15.0" <?php if ($milesRange == 15) echo 'selected' ; ?>>Within 15 miles</option>
              <option value="20.0" <?php if ($milesRange == 20) echo 'selected' ; ?>>Within 20 miles</option>
              <option value="30.0" <?php if ($milesRange == 30) echo 'selected' ; ?>>Within 30 miles</option>
              <option value="40.0" <?php if ($milesRange == 40) echo 'selected' ; ?>>Within 40 miles</option>
            </select>
          </div>
          <div class="col-sm-6 selectContainer">
            <label for="houseTypeID">Type</label>
            <select id="houseTypeID" class="basic-grey form-control input-border" tabindex="3" name="houseTypeID" >
              <option value="1" <?php if ($type == 1) echo 'selected' ; ?>>Detached House</option>
              <option value="2" <?php if ($type == 2) echo 'selected' ; ?>>Semi-Detached</option>
              <option value="3" <?php if ($type == 3) echo 'selected' ; ?>>Mid Terraced</option>
              <option value="4" <?php if ($type == 4) echo 'selected' ; ?>>End Terraced</option>
              <option value="5" <?php if ($type == 5) echo 'selected' ; ?>>Flat</option>
              <option value="9" <?php if ($type == 9) echo 'selected' ; ?>>Studio Flat</option>
              <option value="6" <?php if ($type == 6) echo 'selected' ; ?>>Cottage</option>
              <option value="7" <?php if ($type == 7) echo 'selected' ; ?>>Bungalow</option>
              <option value="10" <?php if ($type == 10) echo 'selected' ; ?>>Other</option>
            </select>
          </div>
          <div class="col-sm-6 selectContainer">
            <label for="minPrice">Price &pound;</label>
            <select id="minPrice" name="minPrice" class="double form-control input-border">
              <option value="">No min</option>
              <option value="50000" <?php if ($priceMin == 50000) echo 'selected' ; ?>>50,000</option>
              <option value="60000" <?php if ($priceMin == 60000) echo 'selected' ; ?>>60,000</option>
              <option value="70000" <?php if ($priceMin == 70000) echo 'selected' ; ?>>70,000</option>
              <option value="80000" <?php if ($priceMin == 80000) echo 'selected' ; ?>>80,000</option>
              <option value="90000" <?php if ($priceMin == 90000) echo 'selected' ; ?>>90,000</option>
              <option value="100000" <?php if ($priceMin == 100000) echo 'selected' ; ?>>100,000</option>
              <option value="110000" <?php if ($priceMin == 110000) echo 'selected' ; ?>>110,000</option>
              <option value="120000" <?php if ($priceMin == 120000) echo 'selected' ; ?>>120,000</option>
              <option value="125000" <?php if ($priceMin == 125000) echo 'selected' ; ?>>125,000</option>
              <option value="130000" <?php if ($priceMin == 130000) echo 'selected' ; ?>>130,000</option>
              <option value="140000" <?php if ($priceMin == 140000) echo 'selected' ; ?>>140,000</option>
              <option value="150000" <?php if ($priceMin == 150000) echo 'selected' ; ?>>150,000</option>
              <option value="160000" <?php if ($priceMin == 160000) echo 'selected' ; ?>>160,000</option>
              <option value="170000" <?php if ($priceMin == 170000) echo 'selected' ; ?>>170,000</option>
              <option value="175000" <?php if ($priceMin == 175000) echo 'selected' ; ?>>175,000</option>
              <option value="180000" <?php if ($priceMin == 180000) echo 'selected' ; ?>>180,000</option>
              <option value="190000" <?php if ($priceMin == 190000) echo 'selected' ; ?>>190,000</option>
              <option value="200000" <?php if ($priceMin == 200000) echo 'selected' ; ?>>200,000</option>
              <option value="210000" <?php if ($priceMin == 210000) echo 'selected' ; ?>>210,000</option>
              <option value="220000" <?php if ($priceMin == 220000) echo 'selected' ; ?>>220,000</option>
              <option value="230000" <?php if ($priceMin == 230000) echo 'selected' ; ?>>230,000</option>
              <option value="240000" <?php if ($priceMin == 240000) echo 'selected' ; ?>>240,000</option>
              <option value="250000" <?php if ($priceMin == 250000) echo 'selected' ; ?>>250,000</option>
              <option value="260000" <?php if ($priceMin == 260000) echo 'selected' ; ?>>260,000</option>
              <option value="270000" <?php if ($priceMin == 270000) echo 'selected' ; ?>>270,000</option>
              <option value="280000" <?php if ($priceMin == 280000) echo 'selected' ; ?>>280,000</option>
              <option value="290000" <?php if ($priceMin == 290000) echo 'selected' ; ?>>290,000</option>
              <option value="300000" <?php if ($priceMin == 300000) echo 'selected' ; ?>>300,000</option>
              <option value="325000" <?php if ($priceMin == 325000) echo 'selected' ; ?>>325,000</option>
              <option value="350000" <?php if ($priceMin == 350000) echo 'selected' ; ?>>350,000</option>
              <option value="375000" <?php if ($priceMin == 375000) echo 'selected' ; ?>>375,000</option>
              <option value="400000" <?php if ($priceMin == 400000) echo 'selected' ; ?>>400,000</option>
              <option value="425000" <?php if ($priceMin == 425000) echo 'selected' ; ?>>425,000</option>
              <option value="450000" <?php if ($priceMin == 450000) echo 'selected' ; ?>>450,000</option>
              <option value="475000" <?php if ($priceMin == 475000) echo 'selected' ; ?>>475,000</option>
              <option value="500000" <?php if ($priceMin == 500000) echo 'selected' ; ?>>500,000</option>
              <option value="550000" <?php if ($priceMin == 550000) echo 'selected' ; ?>>550,000</option>
              <option value="600000" <?php if ($priceMin == 600000) echo 'selected' ; ?>>600,000</option>
              <option value="650000" <?php if ($priceMin == 650000) echo 'selected' ; ?>>650,000</option>
              <option value="700000" <?php if ($priceMin == 700000) echo 'selected' ; ?>>700,000</option>
              <option value="800000" <?php if ($priceMin == 800000) echo 'selected' ; ?>>800,000</option>
              <option value="900000" <?php if ($priceMin == 900000) echo 'selected' ; ?>>900,000</option>
              <option value="1000000" <?php if ($priceMin == 1000000) echo 'selected' ; ?>>1,000,000</option>
              <option value="1250000" <?php if ($priceMin == 1250000) echo 'selected' ; ?>>1,250,000</option>
              <option value="1500000" <?php if ($priceMin == 1500000) echo 'selected' ; ?>>1,500,000</option>
              <option value="1750000" <?php if ($priceMin == 1750000) echo 'selected' ; ?>>1,750,000</option>
              <option value="2000000" <?php if ($priceMin == 2000000) echo 'selected' ; ?>>2,000,000</option>
              <option value="2500000" <?php if ($priceMin == 2500000) echo 'selected' ; ?>>2,500,000</option>
              <option value="3000000" <?php if ($priceMin == 3000000) echo 'selected' ; ?>>3,000,000</option>
              <option value="4000000" <?php if ($priceMin == 4000000) echo 'selected' ; ?>>4,000,000</option>
              <option value="5000000" <?php if ($priceMin == 5000000) echo 'selected' ; ?>>5,000,000</option>
              <option value="7500000" <?php if ($priceMin == 7500000) echo 'selected' ; ?>>7,500,000</option>
              <option value="10000000" <?php if ($priceMin == 10000000) echo 'selected' ; ?>>10,000,000</option>
              <option value="15000000" <?php if ($priceMin == 15000000) echo 'selected' ; ?>>15,000,000</option>
              <option value="20000000" <?php if ($priceMin == 20000000) echo 'selected' ; ?>>20,000,000</option>
              <option value="">No min</option>
            </select>
          </div>
          <div class="col-sm-6 selectContainer">
            <label for="maxPrice">To</label>
            <select id="maxPrice" name="maxPrice" class="double form-control input-border">
              <option value="" selected="selected">No max</option>
              <option value="50000" <?php if ($priceTo == 50000) echo 'selected' ; ?>>50,000</option>
              <option value="60000" <?php if ($priceTo == 60000) echo 'selected' ; ?>>60,000</option>
              <option value="70000" <?php if ($priceTo == 70000) echo 'selected' ; ?>>70,000</option>
              <option value="80000" <?php if ($priceTo == 80000) echo 'selected' ; ?>>80,000</option>
              <option value="90000" <?php if ($priceTo == 90000) echo 'selected' ; ?>>90,000</option>
              <option value="100000" <?php if ($priceTo == 100000) echo 'selected' ; ?>>100,000</option>
              <option value="110000" <?php if ($priceTo == 110000) echo 'selected' ; ?>>110,000</option>
              <option value="120000" <?php if ($priceTo == 120000) echo 'selected' ; ?>>120,000</option>
              <option value="125000" <?php if ($priceTo == 125000) echo 'selected' ; ?>>125,000</option>
              <option value="130000" <?php if ($priceTo == 130000) echo 'selected' ; ?>>130,000</option>
              <option value="140000" <?php if ($priceTo == 140000) echo 'selected' ; ?>>140,000</option>
              <option value="150000" <?php if ($priceTo == 150000) echo 'selected' ; ?>>150,000</option>
              <option value="160000" <?php if ($priceTo == 160000) echo 'selected' ; ?>>160,000</option>
              <option value="170000" <?php if ($priceTo == 170000) echo 'selected' ; ?>>170,000</option>
              <option value="175000" <?php if ($priceTo == 175000) echo 'selected' ; ?>>175,000</option>
              <option value="180000" <?php if ($priceTo == 180000) echo 'selected' ; ?>>180,000</option>
              <option value="190000" <?php if ($priceTo == 190000) echo 'selected' ; ?>>190,000</option>
              <option value="200000" <?php if ($priceTo == 200000) echo 'selected' ; ?>>200,000</option>
              <option value="210000" <?php if ($priceTo == 210000) echo 'selected' ; ?>>210,000</option>
              <option value="220000" <?php if ($priceTo == 220000) echo 'selected' ; ?>>220,000</option>
              <option value="230000" <?php if ($priceTo == 230000) echo 'selected' ; ?>>230,000</option>
              <option value="240000" <?php if ($priceTo == 240000) echo 'selected' ; ?>>240,000</option>
              <option value="250000" <?php if ($priceTo == 250000) echo 'selected' ; ?>>250,000</option>
              <option value="260000" <?php if ($priceTo == 260000) echo 'selected' ; ?>>260,000</option>
              <option value="270000" <?php if ($priceTo == 270000) echo 'selected' ; ?>>270,000</option>
              <option value="280000" <?php if ($priceTo == 280000) echo 'selected' ; ?>>280,000</option>
              <option value="290000" <?php if ($priceTo == 290000) echo 'selected' ; ?>>290,000</option>
              <option value="300000" <?php if ($priceTo == 300000) echo 'selected' ; ?>>300,000</option>
              <option value="325000" <?php if ($priceTo == 325000) echo 'selected' ; ?>>325,000</option>
              <option value="350000" <?php if ($priceTo == 350000) echo 'selected' ; ?>>350,000</option>
              <option value="375000" <?php if ($priceTo == 375000) echo 'selected' ; ?>>375,000</option>
              <option value="400000" <?php if ($priceTo == 400000) echo 'selected' ; ?>>400,000</option>
              <option value="425000" <?php if ($priceTo == 425000) echo 'selected' ; ?>>425,000</option>
              <option value="450000" <?php if ($priceTo == 450000) echo 'selected' ; ?>>450,000</option>
              <option value="475000" <?php if ($priceTo == 475000) echo 'selected' ; ?>>475,000</option>
              <option value="500000" <?php if ($priceTo == 500000) echo 'selected' ; ?>>500,000</option>
              <option value="550000" <?php if ($priceTo == 550000) echo 'selected' ; ?>>550,000</option>
              <option value="600000" <?php if ($priceTo == 600000) echo 'selected' ; ?>>600,000</option>
              <option value="650000" <?php if ($priceTo == 650000) echo 'selected' ; ?>>650,000</option>
              <option value="700000" <?php if ($priceTo == 700000) echo 'selected' ; ?>>700,000</option>
              <option value="800000" <?php if ($priceTo == 800000) echo 'selected' ; ?>>800,000</option>
              <option value="900000" <?php if ($priceTo == 900000) echo 'selected' ; ?>>900,000</option>
              <option value="1000000" <?php if ($priceTo == 1000000) echo 'selected' ; ?>>1,000,000</option>
              <option value="1250000" <?php if ($priceTo == 1250000) echo 'selected' ; ?>>1,250,000</option>
              <option value="1500000" <?php if ($priceTo == 1500000) echo 'selected' ; ?>>1,500,000</option>
              <option value="1750000" <?php if ($priceTo == 1750000) echo 'selected' ; ?>>1,750,000</option>
              <option value="2000000" <?php if ($priceTo == 2000000) echo 'selected' ; ?>>2,000,000</option>
              <option value="2500000" <?php if ($priceTo == 2500000) echo 'selected' ; ?>>2,500,000</option>
              <option value="3000000" <?php if ($priceTo == 3000000) echo 'selected' ; ?>>3,000,000</option>
              <option value="4000000" <?php if ($priceTo == 4000000) echo 'selected' ; ?>>4,000,000</option>
              <option value="5000000" <?php if ($priceTo == 5000000) echo 'selected' ; ?>>5,000,000</option>
              <option value="7500000" <?php if ($priceTo == 7500000) echo 'selected' ; ?>>7,500,000</option>
              <option value="10000000" <?php if ($priceTo == 10000000) echo 'selected' ; ?>>10,000,000</option>
              <option value="15000000" <?php if ($priceTo == 15000000) echo 'selected' ; ?>>15,000,000</option>
              <option value="20000000" <?php if ($priceTo == 20000000) echo 'selected' ; ?>>20,000,000</option>
              <option value="">No max</option>
            </select>
          </div>

          <div class="col-sm-6 selectContainer">
            <label for="minBedrooms">Beds</label>
            <select id="minBedrooms" name="minBedrooms" class="double form-control input-border">
              <option value="">No min</option>
              <option value="0" <?php if ($bedMin == 0) echo 'selected' ; ?>>Studio</option>
              <option value="1" <?php if ($bedMin == 1) echo 'selected' ; ?>>1</option>
              <option value="2" <?php if ($bedMin == 2) echo 'selected' ; ?>>2</option>
              <option value="3" <?php if ($bedMin == 3) echo 'selected' ; ?>>3</option>
              <option value="4" <?php if ($bedMin == 4) echo 'selected' ; ?>>4</option>
              <option value="5" <?php if ($bedMin == 5) echo 'selected' ; ?>>5</option>
            </select>
          </div>
          <div class="col-sm-6 selectContainer">
            <label for="maxBedrooms">to</label>
            <select id="maxBedrooms" name="maxBedrooms" class="double form-control input-border">
              <option value="">No max</option>
              <option value="0" <?php if ($bedTo == 0) echo 'selected' ; ?>>Studio</option>
              <option value="1" <?php if ($bedTo == 1) echo 'selected' ; ?>>1</option>
              <option value="2" <?php if ($bedTo == 2) echo 'selected' ; ?>>2</option>
              <option value="3" <?php if ($bedTo == 3) echo 'selected' ; ?>>3</option>
              <option value="4" <?php if ($bedTo == 4) echo 'selected' ; ?>>4</option>
              <option value="5" <?php if ($bedTo == 5) echo 'selected' ; ?>>5</option>
            </select>
          </div>
          <div class="btn-area">
            <input type="submit" class="btn btn-default form-btn" id="submitPropertyFormS" name="submitPropertyFormS" value="Find Property" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<?php include 'footer.php';  ?>

<script>
  // This example requires the Places library. Include the libraries=places
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

  function initMap() {
    var input = document.getElementById('locationIdentifier');

    var autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', function() {
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }
      var address = '';
      if (place.address_components) {
        address = [
          (place.address_components[0] && place.address_components[0].short_name || ''),
          (place.address_components[1] && place.address_components[1].short_name || ''),
          (place.address_components[2] && place.address_components[2].short_name || '')
        ].join(' ');

        var address_zip = place.address_components;
        var searchPostalCode = "";
        $.each(address_zip, function(){
            if(this.types[0]=="postal_code"){
                searchPostalCode=this.short_name;
            }
        });

        if (searchPostalCode == "") {
          alert("No post code for the selected address. Please try another");
        }
        else {
          input.value = searchPostalCode;
        }
      }
    });

  }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgVTxbNiWLoE9N8qQuogD-VIBvcRVWm2s&libraries=places&callback=initMap"
    async defer></script>
<script>
function suggest(inputString){

		if(inputString.length == 0) {
			$('#suggestions').fadeOut();

		} else {
		$('#locationIdentifier').addClass('load');
			$.post("autosuggest.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#locationIdentifier').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		$('#locationIdentifier').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 600);
	}
function price(thisvalue)
{
	var string = '';
	if(thisvalue == 1)
	{
		string =  '<option value="" selected="selected">Select Price</option>';
    priceMin = <?php echo $priceMin ?>
		for(var i = 20000; i <= 1000000 ; i = i+5000)
		{
      if (priceMin == i) {
        string += '<option value="'+i+'" checked >'+i.toLocaleString()+'</option>';
      }
      else {
        string += '<option value="'+i+'" >'+i.toLocaleString()+'</option>';
      }
		}
		$('#minPrice').html(string);

    string =  '<option value="" selected="selected">Select Price</option>';
    priceTo = <?php echo $priceTo ?>
		for(var i = 20000; i <= 1000000 ; i = i+5000)
		{
      if (priceTo == i) {
        string += '<option value="'+i+'" checked >'+i.toLocaleString()+'</option>';
      }
      else {
        string += '<option value="'+i+'" >'+i.toLocaleString()+'</option>';
      }
		}
		$('#maxPrice').html(string);
	}
	if(thisvalue == 2)
	{
		string =  '<option value="" selected="selected">Select Price</option>';
    priceTo = <?php echo $priceTo ?>
		for(var i = 100; i <= 2500 ; i = i+50)
		{
      if (priceTo == i) {
        string += '<option value="'+i+'" checked >'+i.toLocaleString()+'</option>';
      }
      else {
        string += '<option value="'+i+'" >'+i.toLocaleString()+'</option>';
      }
		}
		$('#minPrice').html(string);
    string =  '<option value="" selected="selected">Select Price</option>';
    priceMin = <?php echo $priceMin ?>
		for(var i = 100; i <= 2500 ; i = i+50)
		{
      if (priceMin == i) {
        string += '<option value="'+i+'" checked >'+i.toLocaleString()+'</option>';
      }
      else {
        string += '<option value="'+i+'" >'+i.toLocaleString()+'</option>';
      }
		}
		$('#maxPrice').html(string);
	}
}
window.onload = function() {
  price(1);
};
</script>
<style>
#result {
	height:20px;
	font-size:16px;
	font-family:Arial, Helvetica, sans-serif;
	color:#333;
	padding:5px;
	margin-bottom:10px;
	background-color:#FFFF99;
}
#country{
	padding:3px;
	border:1px #CCC solid;
	font-size:17px;
}
.suggestionsBox {
	position: absolute;
	left: 0px;
	top:40px;
	margin: 26px 0px 0px 0px;
	width: 200px;
	padding:0px;
	background-color: #000;
	border-top: 3px solid #000;
	color: #fff;
}
.suggestionList {
	margin: 0px;
	padding: 0px;
}
.suggestionList ul li {
	list-style:none;
	margin: 0px;
	padding: 6px;
	border-bottom:1px dotted #666;
	cursor: pointer;
}
.suggestionList ul li:hover {
	background-color: #FC3;
	color:#000;
}
#suggest ul {
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
	color:#FFF;
	padding:0;
	margin:0;
}

.load{
background-image:url(../images/loader.gif);
background-position:right;
background-repeat:no-repeat;
}

#suggest {
	position:relative;
	z-index:99;
}

#margin {
	height:350px !important;
}
@media only screen and (max-width : 420px) {
.suggestionsBox {
	width:100%;
}
#margin {
	height:100px !important;
}
}
</style>
