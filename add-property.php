<?php

		require_once ('dbc.php');
		page_protect();
include 'includes/header1.php';

$rs_settings = mysqli_query($link,"select * from users where user_id='$_SESSION[user_id]'");

 		function redirect($url)

		{

			if (!headers_sent())

			{


				exit;

			}

			else

			{echo '<script type="text/javascript">';

				echo 'window.location.href="'.$url.'";';

				echo '</script>';

				echo '<noscript>';

				echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';

				echo '</noscript>';

				exit;

			}

		}


	$rs_settings = mysqli_query($link,"select * from users where user_id='$_SESSION[user_id]'");



		$ids = mysqli_fetch_row($rs_settings );



	   require_once 'dbapi.php' ;



	require_once 'property.php';



	   $dbc = new DBAPI();



	   if ( isset($_POST['submitPropertyForm'])){





		$userID = $_SESSION['user_id']   ;





		$idUser = $userID ;

		$price = $_POST['housePrice'];

		$type = $_POST['houseTypeID'];

		$postCode = $_POST['housePCode'];

		$street = $_POST['houseStreet'];

		$address2 = $_POST['houseAdd2'];

		$town = $_POST['houseTown'];

		$country = $_POST['houseCountyID'];

		$bedrooms = $_POST['houseNumBedrooms'];

		$bathrooms = $_POST['houseNumBathrooms'];

		$gardenSize = $_POST['houseGardenSize'];

		$description = $_POST['houseDesc'];
		$status = $_POST['status'];



		$sql_insert = "INSERT INTO `property`
  			(`user_id`, `price`, `type`, `street`, `address`, `town`, `country`, `postcode`, `bedrooms`, `bathrooms`, `gardensize`, `description`, `status`, `user_ip`, `created_date`, `updated_date`	)
		    VALUES
		    ('$idUser','$price','$type','$street','$address2','$town','$country','$postCode','$bedrooms','$bathrooms','$gardenSize','$description','$status',''
			,'".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."'
			)
			";

		mysqli_query($link, $sql_insert) or die("Insertion Failed:" . mysqli_error());
		$property_id = mysqli_insert_id($link);

		//$newProp = new Property($idUser , $price,  $type ,$street ,$address2 ,$town ,$country , $postCode , $bedrooms ,$bathrooms ,$gardenSize ,$description );



		//$idp = $dbc->storePropertyToDatabase($newProp);

		//print_r($idp);

		//echo '<h1> PROP ID Returned : '.$idp.'</h1>' ;


		if ($idp )

			$property_id = $idp ;

		else

			echo '<h1>Wrong ! </h1>' ;

		for($idx = 1 ; $idx < 11 ; $idx ++ ){

			//upload images and store to the database

			$formel = 'houseImage'.$idx ;



			if(isset($_FILES[$formel]) && $_FILES[$formel]['size'] > 0){
					$errors= array();

					$file_name = $_FILES[$formel]['name'];

					$file_size = $_FILES[$formel]['size'];

					$file_tmp =$_FILES[$formel]['tmp_name'];

					$file_type=$_FILES[$formel]['type'];



					 $value = explode(".", $file_name);

  					 $file_ext = strtolower(array_pop($value));   //Line 32

  					 // the file name is before the last "."

  					 $fileName = array_shift($value);  //Line 34







					$expensions= array("jpeg","jpg","png");

					if(in_array($file_ext,$expensions)=== false){

						$errors[]="extension not allowed, please choose a JPEG or PNG file.";

					}

					if($file_size > 2097152){

					$errors[]='File size must be excately 2 MB';

					}

					if(empty($errors)==true){



						$localPath = "uploads/prop".$property_id.$file_name ;

						move_uploaded_file($file_tmp, $localPath );



						//store it into the database
						$sql_insert = "INSERT INTO `images`( `property_id`, `user_id`, `image_name`, `status`, `user_ip`, `created_date`, `updated_date`)
		    VALUES
		    ('$property_id','$idUser','$localPath','1','','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."'
			)
			";

		mysqli_query($link,$sql_insert) or die("Insertion Failed:" . mysqli_error());




						//$dbc->storeImage($newProp , $localPath) ;





					}else{

						print_r($errors);

					}



				}

			}





	     redirect('http://propertywing.co.uk/new/showprop.php?idprop='.$property_id);

	   } else  {
	   echo '
<div>
<div class=" bg-image-fixed">
<div class="container">
    <div class="col-sm-8">
      <span style="font-size:24px" class="form-back">Add Your Property</span>



    <div class="row">

  <form role="form" action="" method="post" enctype="multipart/form-data">
    <div class="col-sm-12 form-back">


      <div class="col-xs-12 selectContainer">
      <center><div class="btn-group" data-toggle="buttons">
  		<label style="min-width:200px;" class="btn btn-primary active">
   			 <input type="radio" onchange="price(this.value)" name="propertyStatus" id="option1" value="1" autocomplete="off" checked> Property For Sale
  		</label>
  		<label style="min-width:200px;" class="btn btn-primary">
    		<input type="radio" onchange="price(this.value)"  name="propertyStatus" id="option2" value="2" autocomplete="off"> Property To Let
  		</label>


  	</div>
  	</center>


	</div>
      <div class="col-xs-6 selectContainer">
        <label for="housePrice">Price</label>


          <select id="housePrice" style="background-color:#fff !important" class="form-control add-property-input" tabindex="11" name="housePrice"  required="required">';

				for($i=20000; $i<= 1000000 ; $i = $i + 5000 )
				{
					echo '<option value='.$i.'>'.number_format ( $i ,0 ,"." , "," ).'</option>';
				}

			echo '</select>
      </div>

      <div class="col-xs-6 selectContainer">
        <label for="housePCode">Post Code</label>
         <div id="suggest">

		<input type="text"  class="form-control add-property-input" tabindex="2" autocomplete="off"   onkeyup="suggest(this.value);" onblur="fill();" class="txtBox" id="housePCode" name="housePCode" value="" onfocusout="clearInput()" required="required" placeholder="Start typing your postcode and select from the options below"/>
           <div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="images/arrow1.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
		   <div class="suggestionList" id="suggestionsList"> &nbsp; </div></div>
        </div>
      </div>



      <div class="col-xs-6 selectContainer">
        <label for="houseStreet">Street Name</label>

			<input type="text" tabindex="4"  placeholder=" Without door number"  class="add-property-input form-control" id="houseStreet" name="houseStreet" value="" />

      </div>



      <div class="col-xs-6 selectContainer">
        <label for="houseTown">Town</label>

		  <input type="text" tabindex="6"  class="form-control add-property-input" id="houseTown" name="houseTown" value=""  required="required"/>

      </div>

     <div class="col-xs-6 selectContainer">
        <label for="houseCountyID">County</label>
		 <input type="text" tabindex="7"  class="form-control add-property-input" id="houseCountyID" name="houseCountyID" value=""  required="required"/>




        </div>


	  <div class="col-xs-6 selectContainer">
        <label for="houseTypeID">Type</label>

				<select id="houseTypeID" tabindex="3"  style="background-color:#fff !important" class="form-control add-property-input" tabindex="3" name="houseTypeID" >

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
        <label for="houseNumBedrooms">Bedrooms</label>


          <select id="houseNumBedrooms" style="background-color:#fff !important" class="form-control add-property-input" tabindex="9" name="houseNumBedrooms"  required="required">

				<option value="1">1</option>

				<option value="2">2</option>

				<option value="3">3</option>

				<option value="4">4</option>

				<option value="5">5</option>

				<option value="6">6</option>

				<option value="7">7</option>

				<option value="8">8</option>

				<option value="9">9</option>

				<option value="10">10</option>

				<option value="11">11</option>

				<option value="12">12</option>



			</select>
      </div>

      <div class="col-xs-6 selectContainer">
        <label for="houseNumBathrooms">Bathrooms</label>


          	 <select id="houseNumBathrooms" style="background-color:#fff !important" class="form-control add-property-input" tabindex="10" name="houseNumBathrooms"  required="required">

				<option value="1">1</option>

				<option value="2">2</option>

				<option value="3">3</option>

				<option value="4">4</option>

				<option value="5">5</option>

				<option value="6">6</option>

				<option value="7">7</option>

				<option value="8">8</option>

				<option value="9">9</option>

				<option value="10">10</option>

				<option value="11">11</option>

				<option value="12">12</option>



			</select>
      </div>

      <div class="col-xs-6 selectContainer">
        <label for="houseGardenSize">Garden Size</label>
					<select id="houseGardenSize" style="background-color:#fff !important" class="form-control add-property-input" tabindex="11" name="houseGardenSize"  required="required">

				<option value="Large">Large</option>

				<option value="Medium">Medium</option>

				<option value="Small">Small</option>

				<option value="None">None</option>

			</select>

        </div>


      <div class="col-xs-12 selectContainer">
        <label for="houseDesc">Description</label>
        <div class="input-group">
			<textarea tabindex="12" id="houseDesc" name="houseDesc"  rows="10" tabindex="12" cols="180" class="form-control basic-grey"  required="required">Full Description:




	</textarea>

          </div>
      </div>


      <div class="col-xs-12 selectContainer">
        <label>Images </label>
		<br/>
       <div class="col-xs-6 selectContainer">
   						<input type="file" tabindex="13" name="houseImage1" id="houseImage1"  required="required"/>

							<input type="file" tabindex="14" name="houseImage2" id="houseImage2" />

							<input type="file" tabindex="15" name="houseImage3" id="houseImage3" />

							<input type="file" tabindex="16" name="houseImage4" id="houseImage4" />

							<input type="file" tabindex="17" name="houseImage5" id="houseImage5" />
		</div>
		<div class="col-xs-6 selectContainer">

							<input type="file" tabindex="18" name="houseImage6" id="houseImage6" />

							<input type="file" tabindex="19" name="houseImage7" id="houseImage7" />

							<input type="file" tabindex="20" name="houseImage8" id="houseImage8" />

							<input type="file" tabindex="21" name="houseImage9" id="houseImage9" />

							<input type="file" tabindex="22" name="houseImage10" id="houseImage10" />
		</div>


       </div>


      <div class="col-xs-12 selectContainer">

       <span class="button-checkbox" style="float:left; margin-right:12px;">
						<input tabindex="23" type="checkbox" name="termsCond" id="termsCond" value="1"  required="required" />
		</span>
        <div style="float:left;">
					I have read and agree to the terms &amp; conditions.
				</div>
      </div>

      <input  tabindex="24" type="submit" class="button btn  pull-right viewfull" id="submitPropertyForm" name="submitPropertyForm" value="Add Property" />
    </div>
  </form>


</div>

</div>
<div class="col-sm-3">';

include ("sidebar.php") ;
echo'
</div>
</div>
</div>
' ;



}include 'footer.php';?>

<script>
  document.title = "Add property to Propertywing its completely free and simple";
  function clearInput()
  {
	  $('#housePCode').val("");
  }
function suggest(inputString){

		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#housePCode').addClass('load');
			$.post("autosuggestpostcode.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#housePCode').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		$('#housePCode').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 600);
		$.post("town.php", {queryString: ""+thisValue+""}, function(data){
				if(data.length >0) {

					$('#houseTown').val(data);

				}
			});

			$.post("country.php", {queryString: ""+thisValue+""}, function(data){
				if(data.length >0) {

					$('#houseCountyID').val(data);

				}
			});

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
		$('#housePrice').html(string);

	}
	if(thisvalue == 2)
	{
		string =  '<option value="" selected="selected">Select Price</option>';
		for(var i = 100; i <= 2500 ; i = i+50)
		{
			string += '<option value="'+i+'" >'+i.toLocaleString()+'</option>';
		}
		$('#housePrice').html(string);

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
	z-index:9999;
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
