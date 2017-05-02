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
			$locationIdentifier = $locations[0];
		}
 		else
    {
      $locationIdentifier = '';

		  $locations = array();
    }

 		if ($searchfor != ''){

			$locations = $dbc->getPostcode($searchfor) ;
		}

	   if ( isset($_GET['priceMin']) && !empty($_GET['priceMin']))
	   		$priceMin = $_GET['priceMin'];
		else
			$priceMin =  0 ;

	   if (isset($_GET['priceTo']) && !empty($_GET['priceTo']))
	   		$priceTo = $_GET['priceTo'];
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

		if ($postcode != '')
			$sqlSearch .= " AND `postcode` = '$postcode' " ;


		$results = $dbc->searchProperties($sqlSearch) ;

echo "<pre>";
print_r($results);
die();
		if(isset($_GET['radius']))
		{
			if($_GET['radius'] != 0.0)
			{
				$milesRange = $_GET['radius'];
			}
			else
			{
				$milesRange = 999999;
			}
		}
		else
		{
			$milesRange = 999999;
		}


		//get all properties
		 $allprops = array();
		 if ($results == 0 )
			echo "No results ! " ;
		else
		{
		 	while ($row = $results->fetch_assoc())
		 	$allprops[] = $row ;
		}
		//search for distance
		$propsInRange = array();
		if($locationIdentifier != '')
		foreach ($allprops as $row ){

			if ($dbc->isPropertyInRange($locationIdentifier ,$row['postcode'] , $milesRange))
				$propsInRange[] = $row ;

		}
		else
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
              <option value="0.0" selected="selected">This area only</option>
              <option value="0.25">Within &frac14; mile</option>
              <option value="0.5">Within &frac12; mile</option>
              <option value="1.0">Within 1 mile</option>
              <option value="3.0">Within 3 miles</option>
              <option value="5.0">Within 5 miles</option>
              <option value="10.0">Within 10 miles</option>
              <option value="15.0">Within 15 miles</option>
              <option value="20.0">Within 20 miles</option>
              <option value="30.0">Within 30 miles</option>
              <option value="40.0">Within 40 miles</option>
            </select>
          </div>
          <div class="col-sm-6 selectContainer">
            <label for="houseTypeID">Type</label>
            <select id="houseTypeID" class="basic-grey form-control input-border" tabindex="3" name="houseTypeID" >
              <option value="1">Detached House</option>
              <option value="2">Semi-Detached</option>
              <option value="3">Mid Terraced</option>
              <option value="4">End Terraced</option>
              <option value="5">Flat</option>
              <option value="9">Studio Flat</option>
              <option value="6">Cottage</option>
              <option value="7">Bungalow</option>
              <option value="10">Other</option>
            </select>
          </div>
          <div class="col-sm-6 selectContainer">
            <label for="minPrice">Price &pound;</label>
            <select id="minPrice" name="minPrice" class="double form-control input-border">
              <option value="" selected="selected">No min</option>
              <option value="50000">50,000</option>
              <option value="60000">60,000</option>
              <option value="70000">70,000</option>
              <option value="80000">80,000</option>
              <option value="90000">90,000</option>
              <option value="100000">100,000</option>
              <option value="110000">110,000</option>
              <option value="120000">120,000</option>
              <option value="125000">125,000</option>
              <option value="130000">130,000</option>
              <option value="140000">140,000</option>
              <option value="150000">150,000</option>
              <option value="160000">160,000</option>
              <option value="170000">170,000</option>
              <option value="175000">175,000</option>
              <option value="180000">180,000</option>
              <option value="190000">190,000</option>
              <option value="200000">200,000</option>
              <option value="210000">210,000</option>
              <option value="220000">220,000</option>
              <option value="230000">230,000</option>
              <option value="240000">240,000</option>
              <option value="250000">250,000</option>
              <option value="260000">260,000</option>
              <option value="270000">270,000</option>
              <option value="280000">280,000</option>
              <option value="290000">290,000</option>
              <option value="300000">300,000</option>
              <option value="325000">325,000</option>
              <option value="350000">350,000</option>
              <option value="375000">375,000</option>
              <option value="400000">400,000</option>
              <option value="425000">425,000</option>
              <option value="450000">450,000</option>
              <option value="475000">475,000</option>
              <option value="500000">500,000</option>
              <option value="550000">550,000</option>
              <option value="600000">600,000</option>
              <option value="650000">650,000</option>
              <option value="700000">700,000</option>
              <option value="800000">800,000</option>
              <option value="900000">900,000</option>
              <option value="1000000">1,000,000</option>
              <option value="1250000">1,250,000</option>
              <option value="1500000">1,500,000</option>
              <option value="1750000">1,750,000</option>
              <option value="2000000">2,000,000</option>
              <option value="2500000">2,500,000</option>
              <option value="3000000">3,000,000</option>
              <option value="4000000">4,000,000</option>
              <option value="5000000">5,000,000</option>
              <option value="7500000">7,500,000</option>
              <option value="10000000">10,000,000</option>
              <option value="15000000">15,000,000</option>
              <option value="20000000">20,000,000</option>
              <option value="">No min</option>
            </select>
          </div>
          <div class="col-sm-6 selectContainer">
            <label for="maxPrice">To</label>
            <select id="maxPrice" name="maxPrice" class="double form-control input-border">
              <option value="" selected="selected">No max</option>
              <option value="50000">50,000</option>
              <option value="60000">60,000</option>
              <option value="70000">70,000</option>
              <option value="80000">80,000</option>
              <option value="90000">90,000</option>
              <option value="100000">100,000</option>
              <option value="110000">110,000</option>
              <option value="120000">120,000</option>
              <option value="125000">125,000</option>
              <option value="130000">130,000</option>
              <option value="140000">140,000</option>
              <option value="150000">150,000</option>
              <option value="160000">160,000</option>
              <option value="170000">170,000</option>
              <option value="175000">175,000</option>
              <option value="180000">180,000</option>
              <option value="190000">190,000</option>
              <option value="200000">200,000</option>
              <option value="210000">210,000</option>
              <option value="220000">220,000</option>
              <option value="230000">230,000</option>
              <option value="240000">240,000</option>
              <option value="250000">250,000</option>
              <option value="260000">260,000</option>
              <option value="270000">270,000</option>
              <option value="280000">280,000</option>
              <option value="290000">290,000</option>
              <option value="300000">300,000</option>
              <option value="325000">325,000</option>
              <option value="350000">350,000</option>
              <option value="375000">375,000</option>
              <option value="400000">400,000</option>
              <option value="425000">425,000</option>
              <option value="450000">450,000</option>
              <option value="475000">475,000</option>
              <option value="500000">500,000</option>
              <option value="550000">550,000</option>
              <option value="600000">600,000</option>
              <option value="650000">650,000</option>
              <option value="700000">700,000</option>
              <option value="800000">800,000</option>
              <option value="900000">900,000</option>
              <option value="1000000">1,000,000</option>
              <option value="1250000">1,250,000</option>
              <option value="1500000">1,500,000</option>
              <option value="1750000">1,750,000</option>
              <option value="2000000">2,000,000</option>
              <option value="2500000">2,500,000</option>
              <option value="3000000">3,000,000</option>
              <option value="4000000">4,000,000</option>
              <option value="5000000">5,000,000</option>
              <option value="7500000">7,500,000</option>
              <option value="10000000">10,000,000</option>
              <option value="15000000">15,000,000</option>
              <option value="20000000">20,000,000</option>
              <option value="">No max</option>
            </select>
          </div>

          <div class="col-sm-6 selectContainer">
            <label for="minBedrooms">Beds</label>
            <select id="minBedrooms" name="minBedrooms" class="double form-control input-border">
              <option value="" selected="selected">No min</option>
              <option value="0">Studio</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
          <div class="col-sm-6 selectContainer">
            <label for="maxBedrooms">to</label>
            <select id="maxBedrooms" name="maxBedrooms" class="double form-control input-border">
              <option value="" selected="selected">No max</option>
              <option value="0">Studio</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
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
		for(var i = 20000; i <= 1000000 ; i = i+5000)
		{
			string += '<option value="'+i+'" >'+i.toLocaleString()+'</option>';
		}
		$('#minPrice').html(string);
		$('#maxPrice').html(string);
	}
	if(thisvalue == 2)
	{
		string =  '<option value="" selected="selected">Select Price</option>';
		for(var i = 100; i <= 2500 ; i = i+50)
		{
			string += '<option value="'+i+'" >'+i.toLocaleString()+'</option>';
		}
		$('#minPrice').html(string);
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
