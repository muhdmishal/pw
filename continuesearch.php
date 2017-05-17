<?php
session_start();

		require_once ('./dbc.php');
		//page_protect();
		$userID = $_SESSION[user_id] ;
		if($userID > 0)
{
	include 'includes/header1.php';
}
else{
	include 'includes/headerindex.php';
}
 //          include 'includes/sidebar.html';




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

	   	require_once './dbapi.php' ;

		require_once './property.php';

	   $dbc = new DBAPI();


 	$searchfor = '';
		if (isset($_GET['whattosearch'] ))
			$searchfor =  $_GET['whattosearch'];




		$locations = array();

 		if ($searchfor != ''){

			$locations = $_GET['whattosearch'] ;
			$locationsfull = $_GET['whattosearch'] ;
		}









?>
<style media="screen">
  .sell-box-search {
    float: none;
    text-align: center;
    margin-left: 0 !important;
    margin-right: 0;
  }
</style>

<div class="row">
  <div class="container-fluid  bg-image-fixed">
    <br/>
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <form role="form" class="grey" method="get" enctype="multipart/form-data" action="showsearchresults.php">
          <div style="background-color:rgba(46,109,164,0.85) !important;" class="set-bg-white">
          <br/>
          <div class="col-xs-12 selectContainer">
          <center>
            <div class="btn-group" data-toggle="buttons">
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

            <input type="text" style="background-color:#FFFFFF !important;" class="double form-control input-border" id="locationIdentifier" name="locationIdentifier" value="<?php echo $locationsfull ?>" />
            </div>
          </div>
          <div class="col-xs-6 selectContainer">
            <label for="radius">Search Radius</label>
            <select style="background-color:#FFFFFF !important;" id="radius" name="radius" class="double form-control input-border">
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
          <div class="col-xs-6 selectContainer">
            <label for="houseTypeID">Type</label>
            <select style="background-color:#FFFFFF !important;" id="houseTypeID" class="basic-grey form-control input-border" tabindex="3" name="houseTypeID" >
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
          <div class="col-xs-6 selectContainer">
            <label for="minPrice">Price &pound;</label>
            <select style="background-color:#FFFFFF !important;" id="minPrice" name="minPrice" class="double form-control input-border">

            </select>
          </div>
          <div class="col-xs-6 selectContainer">
            <label for="maxPrice">To</label>
            <select style="background-color:#FFFFFF !important;" id="maxPrice" name="maxPrice" class="double form-control input-border">

            </select>
          </div>

          <div class="col-xs-6 selectContainer">
            <label for="minBedrooms">Beds</label>
            <select style="background-color:#FFFFFF !important;" id="minBedrooms" name="minBedrooms" class="double form-control input-border">
              <option value="" selected="selected">No min</option>
              <option value="0">Studio</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
          <div class="col-xs-6 selectContainer">
            <label for="maxBedrooms">to</label>
            <select style="background-color:#FFFFFF !important;" id="maxBedrooms" name="maxBedrooms" class="double form-control input-border">
              <option value="" selected="selected">No max</option>
              <option value="0">Studio</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>

          </div>

        <br/>

          </div>
           <div class="btn-area" style="margin-top:10px; ">
            <input style="font-size:18px; padding:10px 150px;" type="submit" class="btn  btn-primary1" id="submitPropertyFormS" name="submitPropertyFormS" value="Search" />
          </div>
          <br/>
          <span class="sell-box-search">The new way to sell your home</span>
        </form>
      </div>
    </div>

  </div>
</div>
<div class="container">
		<span class="title">HOW WE ADVERTISE YOUR HOME</span>

        <section class="row">

            <div class="col-sm-12">
    	<h2 class="text-center">In this day and age the best place to advertise your home is using the internet. Social media is so powerful at connecting people, we are using it to help you sell your home. </h2>
        <h2 class="text-center">We are not an estate agent, we connect you with potential buyers of your home for a private sale.  If you have a sole agency agreement with an agent you can still advertise your property on our website.</h2>
        <h2 class="text-center">ou will have your own inbox and with our “message owner” feature, you will receive requests directly from potential buyers.</h2>
    </div>

        </section>
	<br/>
    	<img  class="col-sm-3 col-sm-offset-3" src="images/logo-google.png" >



    	<img src="images/logo-twitter.png" class="col-sm-1" >
        <img src="images/logo-facebook.png" class="col-sm-1">









            <div class="col-sm-12">
    	<h2 class="text-center">Once you have added your property , we will add your property to our facebook page where we will boost your post, The first boost is on us and should get your property seen by a few thousand people in your area.  After the initial boost you have the option to re-boost your facebook listing for as little as £3.00 which will go out to thousands of people in and around your local area.</h2>
        <h2 class="text-center">We will set up an advert on Google so when people search the internet for properties for sale in your area, they will be able to find your property, this is again, all completely free of charge.</h2>

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
  document.title = "Search for property in your area";
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
