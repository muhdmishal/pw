<?php



		include 'dbc.php';
		page_protect();
		include 'includes/header1.php';


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



 	$userID = $_SESSION['user_id']   ;


		$rs_settings = mysqli_query($link,"select * from `users` where `user_id`='$userID'");

		//$ids = mysqli_fetch_row($rs_settings );

	   require_once 'dbapi.php' ;

	require_once 'property.php';

	   $dbc = new DBAPI();



	   $propID = $_REQUEST['idprop'];

	   $newAddedProp = $dbc->loadProperty($propID);

	   //load the property's details

		//states






$propTypes  = array(1 => 'Detached House' ,
2 => 'Semi-Detached' ,
3 => 'Mid Terraced' ,
4 => 'End Terraced' ,
5 => 'Flat' ,
9 => 'Studio Flat',
6 => 'Cottage' ,
7 => 'Bungalow' ,
10 => 'Other');


$gardenSize = array(
"Large",
"Medium",
"Small",
"None");

if($newAddedProp['values']['status'] == 1 || $newAddedProp['values']['status'] == 3 || $newAddedProp['values']['status'] == 6)
$propertyStatus = array(
1 => 'For Sale' ,
6 => 'Under Offer' ,
3 => 'Sold' ,



);
else
$propertyStatus = array(

2 => 'To Let' ,
7 => 'Under Offer' ,
4 => 'Let' ,


);




	   if ( isset($_POST['submitEditPropertyForm'])){


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
		$status = $_POST['propertyStatus'];


		$sql = "UPDATE `property` SET `price`='$price', `type`='$type', `street`='$street', `address`='$address', `town`='$town' , `country`='$country', `postcode`='$postCode', `bedrooms`='$bedrooms', `bathrooms`='$bathrooms' , `gardensize`='$gardenSize' , `description`='$description' , `status`='$status'  WHERE `property_id`='$propID' AND `user_id`='$idUser'" ;




		//	echo $sql ;

			mysqli_query($link,$sql);
		//$newProp->id= $propID ;

		//$idp = $dbc->updatePropertyFromDatabase($newProp);

		//echo '<h1> PROP ID Returned : '.$idp.'</h1>' ;

		/*


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

						$localPath = "uploads/prop".$newProp->id.$file_name ;
						move_uploaded_file($file_tmp, $localPath );

						//store it into the database
						$dbc->storeImage($newProp , $localPath) ;


					}else{
						print_r($errors);
					}

				}
			}
	   */
	   for($idx = 1 ; $idx < 11 ; $idx ++ )
	   {

			//upload images and store to the database

			$formel = 'houseImage'.$idx ;



			if(isset($_FILES[$formel]) && $_FILES[$formel]['size'] > 0)
			{
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

					if(in_array($file_ext,$expensions)=== false)
					{

						$errors[]="extension not allowed, please choose a JPEG or PNG file.";

					}

					if($file_size > 2097152)
					{

					$errors[]='File size must be excately 2 MB';

					}

					if(empty($errors)==true)
					{



						$localPath = "uploads/prop".$property_id.$file_name ;

						move_uploaded_file($file_tmp, $localPath );



						//store it into the database
						$sql_insert = "INSERT INTO `images`( `property_id`, `user_id`, `image_name`, `status`, `user_ip`, `created_date`, `updated_date`)
		    VALUES
		    ('$propID','$idUser','$localPath','1','','".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."'
			)
			";
			mysqli_query($link,$sql_insert) or die("Insertion Failed:" . mysqli_error());
					}
			}
	   }

	    redirect('http://propertywing.co.uk/new/showprop.php?idprop='.$propID);


	   }
	   else if ( isset($_POST['submitDeletePropertyForm'])){

		   $sql = "UPDATE `property` SET `status`='5'  WHERE `property_id`='$propID' AND `user_id`='$userID'" ;




		//	echo $sql ;

			mysqli_query($link,$sql);
		    //echo $sql;
			redirect('http://propertywing.co.uk/new/myaccount.php');
	   }
	   else  {



	   echo '






<div class=" bg-image-fixed">

<br />
<br />
  <div class="container">
  <div class="col-sm-8">
<form class="grey" action="" method="post" enctype="multipart/form-data">

	<div class="col-sm-12 form-back"> <span style="font-size:24px">Edit your property</span>
	<br>
	<span style="font-size:14px">Complete this form to edit your property to The Property Wing.</span></div>

		<div class="col-sm-12 form-back">


		<div class="col-xs-6 selectContainer">
			<label for="housePrice"><span>Price:</span></label>

			<select id="housePrice" style="background-color:#fff !important" class="form-control add-property-input" tabindex="11" name="housePrice" >';

				if($newAddedProp['values']['status'] == 1 || $newAddedProp['values']['status'] == 3 || $newAddedProp['values']['status'] == 5)
				for($i=20000; $i<= 1000000 ; $i = $i + 5000 )
				{
					if($i == $newAddedProp['values']['price'])
					echo '<option selected="selected" value='.$i.'>'.number_format ( $i ,0 ,"." , "," ).'</option>';
					else
					echo '<option value='.$i.'>'.number_format ( $i ,0 ,"." , "," ).'</option>';
				}
				else
				for($i=100; $i<= 2500 ; $i = $i + 50 )
				{
					if($i == $newAddedProp['values']['price'])
					echo '<option selected="selected" value='.$i.'>'.number_format ( $i ,0 ,"." , "," ).'</option>';
					else
					echo '<option value='.$i.'>'.number_format ( $i ,0 ,"." , "," ).'</option>';
				}

			echo '</select>

		</div>


		<div class="col-xs-6 selectContainer">
        <label for="housePCode">Post Code</label>
         <div id="suggest">
		<input type="text"  class="form-control add-property-input" tabindex="2" autocomplete="off"   onkeyup="suggest(this.value);" onblur="fill();" class="txtBox" id="housePCode" name="housePCode" value="'.$newAddedProp['values']['postcode'].'" />
           <div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="images/arrow1.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
		   <div class="suggestionList" id="suggestionsList"> &nbsp; </div></div>
        </div>
      </div>

			<div class="col-xs-6 selectContainer">
			<label for="houseStreet">Street Name</label>
				<input type="text" tabindex="5"   class="add-property-input form-control" placeholder=" Without door number" id="houseStreet" name="houseStreet" value="'.$newAddedProp['values']['street'].'" />

			</div>

			<div class="col-xs-6 selectContainer">
			<label for="houseTown"><span>Town</span></label>
				<input type="text" tabindex="7"  class="add-property-input form-control" id="houseTown" name="houseTown" value="'.$newAddedProp['values']['town'].'" />

			</div>
			<div class="col-xs-6 selectContainer">
        <label for="houseCountyID">Country</label>
		 <input type="text" tabindex="7"  class="form-control add-property-input" id="houseCountyID" name="houseCountyID" value="'.$newAddedProp['values']['country'].'" />




        </div>
	<div class="col-xs-6 selectContainer">
			<label for="houseTypeID"><span>Type:</span></label>
				<select id="houseTypeID"   class="add-property-input form-control" tabindex="3" name="houseTypeID" >

		';


				foreach($propTypes as $key=>$val) {
    				echo ($key == $newAddedProp['values']['type']) ? "<option selected=\"selected\" value=\"$key\">$val</option>":"<option value=\"$key\">$val</option>";
				}



				echo '

				</select>
			</div>

	<div class="col-xs-6 selectContainer">
		<label for="houseNumBedrooms">Bedrooms:</label>
		<select id="houseNumBedrooms" style="background-color:#fff !important" class="form-control add-property-input" tabindex="9" name="houseNumBedrooms" >
				';
				for( $i = 1; $i<=12; $i++)
				{
					if($i == $newAddedProp['values']['bedrooms'] )
					echo '<option selected=\"selected\" value="'.$i.'">'.$i.'</option>';
					else
					echo '<option  value="'.$i.'">'.$i.'</option>';
				}




			echo '</select>

	</div>
	<div class="col-xs-6 selectContainer">
		<label for="houseNumBathrooms"><span>Bathrooms:</span></label>
			<select id="houseNumBathrooms" style="background-color:#fff !important" class="form-control add-property-input" tabindex="9" name="houseNumBathrooms" >
				';
				for( $i = 1; $i<=12; $i++)
				{
					if($i == $newAddedProp['values']['bathrooms'] )
					echo '<option selected=\"selected\" value="'.$i.'">'.$i.'</option>';
					else
					echo '<option  value="'.$i.'">'.$i.'</option>';
				}




			echo '</select>
	</div>


	<div class="col-xs-6 selectContainer">
		<label for="houseGardenSize">Garden Size</label>
			<select id="houseGardenSize"  class="add-property-input form-control" tabindex="17" name="houseGardenSize" >';

	foreach($gardenSize as $val) {
 			   echo ($val == $newAddedProp['values']['gardensize']) ? "<option selected=\"selected\" value=\"$val\">$val</option>":"<option value=\"$val\">$val</option>";
			}


	echo '</select></div>
	<div class="col-xs-6 selectContainer">
	<label for="propertyStatus"><span>Property Status</span></label>
			<select id="propertyStatus"  class="add-property-input form-control" tabindex="18" name="propertyStatus" >

	';
	foreach($propertyStatus as $key=>$val) {
    				echo ($key == $newAddedProp['values']['status']) ? "<option selected=\"selected\" value=\"$key\">$val</option>":"<option value=\"$key\">$val</option>";
				}



echo '
			</select>
	</div>
	<div class="col-xs-12 selectContainer">
		<label for="houseDesc"><span>Description:</span></label>
			<textarea tabindex="18" id="houseDesc" name="houseDesc"  rows="12" cols="80" class="add-property-input form-control" >'.$newAddedProp['values']['description'].'</textarea>
	</div>
	<div class="col-xs-12 selectContainer">
	<div class="col-xs-12 ">
					<label>Images ( Click on the image to delete image )</label>
	</div>
	';
		for ($idximg = 0 ; $idximg < sizeof( $newAddedProp['images'] )  ; $idximg++ )
		{

				$imgid = 'img-'.($idximg+1);

				echo '<div onclick="deleteimage('.$newAddedProp['images_id'][$idximg].','.$userID.')" class="col-sm-4" style="height:200px; overflow:hidden;">' ;
				echo '<img class="img-responsive" src="./'.$newAddedProp['images'][$idximg].'" /></div>';
		}

	echo'
	</div>
	<div class="col-xs-12 selectContainer">
	<div class="col-xs-12 ">
					<label>Add more images </label>
	</div>';

	echo '
						<div class="col-xs-6 selectContainer">

							<input class="';if(sizeof( $newAddedProp['images'] )  >= 1) echo "hidden";
							echo '" type="file" name="houseImage1" id="houseImage1" />
							<input class="';
							if(sizeof( $newAddedProp['images'] )  >= 2) echo "hidden";
							echo '" type="file" name="houseImage2" id="houseImage2" />
							<input class="';
							if(sizeof( $newAddedProp['images'] )  >= 3) echo "hidden";
							echo '" type="file" name="houseImage3" id="houseImage3" />
							<input class="';
							if(sizeof( $newAddedProp['images'] )  >= 4) echo "hidden";
							echo '" type="file" name="houseImage4" id="houseImage4" />
							<input class="';
							if(sizeof( $newAddedProp['images'] )  >= 5) echo "hidden";
							echo '" type="file" name="houseImage5" id="houseImage5" />
						</div>
						<div class="col-xs-6 selectContainer">
							<input class="';
							if(sizeof( $newAddedProp['images'] )  >= 6) echo "hidden";
							echo '" type="file" name="houseImage6" id="houseImage6" />
							<input class="';
							if(sizeof( $newAddedProp['images'] )  >= 7) echo "hidden";
							echo '" type="file" name="houseImage7" id="houseImage7" />
							<input class="';
							if(sizeof( $newAddedProp['images'] )  >= 8) echo "hidden";
							echo '" type="file" name="houseImage8" id="houseImage8" />
							<input class="';
							if(sizeof( $newAddedProp['images'] )  >= 9) echo "hidden";
							echo '" type="file" name="houseImage9" id="houseImage9" />
							<input class="';
							if(sizeof( $newAddedProp['images'] )  >= 10) echo "hidden";
							echo '" type="file" name="houseImage10" id="houseImage10" />
					</div>

	</div>
	<div class="col-xs-12 selectContainer">


		<label for="termsCond">
		<input type="checkbox" name="termsCond"  id="termsCond" value="1" />
				I have read and agree to the terms &amp; conditions</label>

	</div>
				<input type="submit" class="button btn  pull-right viewfull" id="submitEditPropertyForm" name="submitEditPropertyForm" value="Update Property" />
				<input type="submit" style="background-color:red !important" class="button btn  pull-right viewfull" id="submitDeletePropertyForm" name="submitDeletePropertyForm" value="Delete Property" />

				</div>
	</form>
	</div>


	<div class="col-sm-3">';

include ('sidebar.php') ;

echo '</div>
</div>
	</div>



</div>
' ;

}


include ('footer.php') ;
?>

<script>
  document.title = "Propertywing :: Edit Property";
function deleteimage(str,str1) {

	var response = confirm('Are You sure You want to Delete the Image?');
     // OR var response = window.confirm('Confirm Test: Continue?');

     if (response)
	 {

    if (str == "") {


    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
               location.reload();
            }
        }
        xmlhttp.open("GET","deleteimage.php?q="+str+"&user="+str1,true);
        xmlhttp.send();
    }
	 }

}


</script>
