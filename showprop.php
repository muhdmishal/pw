<?php
include 'dbc.php';
session_start();
//page_protect();

$userID = $_SESSION['user_id']   ;

$rs_settings = mysqli_query($link,"select * from users where user_id='$userID'");


if($userID > 0)
{
	include 'includes/header1.php';
	$userdetails = mysqli_fetch_row($rs_settings );
}
else{
	include 'includes/headerindex.php';
}

require_once 'dbapi.php';
require_once 'property.php';

$dbc = new DBAPI();
$imgStat = '';

  if( isset($_GET['idprop']) )
  	$idp = 	$_GET['idprop'] ;

    $newAddedProp = $dbc->loadProperty($idp);


	if (isset($_POST['submit_msg'])){

		$host  = $_SERVER['HTTP_HOST'];
		//get the message details add them to the database

		//get the idprop owner

		//$idrecev = $dbc->getPropertyOwner($idp);

		$rs_settings = mysqli_query($link,"select * from users where user_id='".$newAddedProp['values']['user_id']."'");

		$ownerdetails = mysqli_fetch_row($rs_settings );

		$detail = htmlspecialchars($_POST['message']);




		$msgSubject = $_POST['subject'];
		$Email = $_POST['email'];


		if($userID <= 0){
			$userdetails['0'] = "";
		}



	mail($ownerdetails['4'], "Reply for your posting on Propertywing : ".$msgSubject, $detail,
    "From: \"".$userdetails['2']." via Propertywing\" <messages@$host >\r\n" .
     "X-Mailer: PHP/" . phpversion());

	 mail($Email , "Copy of your message in Propertywing: ".$msgSubject, $detail,
    "From: \"".$userdetails['2']." via Propertywing\" <messages@$host >\r\n" .
     "X-Mailer: PHP/" . phpversion());

	 $message_thread = $idp."_".$ownerdetails[0]."_".$Email;

	 $sql_insert = "INSERT INTO `message`( `message_thread`, `property_id`, `receiver_id`, `sender_id`, `sender_email`, `send_date`,`status`, `message_subject`, `message_content`,`viewedstatus`)
	 VALUES ('$message_thread','$idp','$ownerdetails[0]','$userdetails[0]','$Email','".date("Y-m-d H:i:s")."','1','$msgSubject','$detail','1')";

	if(mysqli_query($link,$sql_insert))
	{
		echo '<center><div class="container form-back">Message sent successfully</div></center>';
	}


		//create a new Thread Message
		//$threadId = $dbc->createMessageThread($msgSubject) ;
		//$threadID = uniqid($idrecev.'_'.$userID.'_'.$idp.'_' , true);

		//$msg = new Message($threadID , $idrecev , $userID , $msgSubject , $detail , $idp ) ;



	}

?>
<?php

	if ( $newAddedProp['values']['status'] == 1 )
		$imgStat="./images/available.png";
	else if ( $newAddedProp['values']['status'] == 2 )
		$imgStat="./images/pending.png";
	else if ( $newAddedProp['values']['status'] == 3 )
		$imgStat="./images/sold.png";
	else if ( $newAddedProp['values']['status'] == 0 )
		$imgStat="./images/cancel.png";



//	echo "Status : ".$newAddedProp->status ;
?>

 <?php

	$address = $newAddedProp['values']['postcode'];

	$coordinates = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
	$coordinates = json_decode($coordinates);


	$lat = $coordinates->results[0]->geometry->location->lat;
	$lng = $coordinates->results[0]->geometry->location->lng;

?>
<hr/>

<div style="background-color:#f4f4f4 !important;" class="showprop">
 <br/>
  <!--<div id="right-column" >
    <div id="box1">
	     <p onclick="goBack()" style="cursor:pointer">Back to results</p>
		      <script>function goBack() {    window.history.back()}</script>

    </div>

	<div id="box5">
	    <p>Make an Offer to seller</p>
	</div>

	<div id="box5">
	    <p>Ask seller a question</p>
	</div>


	<div id="share-icons">
        <img src="images/facebook-share.jpg"/>
			<img src="images/twitter-share.jpg"/>
				<img src="images/pinterest-share.jpg"/>
					<img src="images/google-plus-share.jpg"/>
							<p>Share this property</p>
	</div>
<div id="box7">
	<form class="search-form">
		<h1>Search Properties</h1>

			<label for="minPrice"><span>Price �:</span></label>
				<select id="minPrice" name="minPrice" class="double">
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
	<label for="max"><span>To:</span></label>
	    <select id="maxPrice" name="maxPrice" class="double">
	           <option value="" selected="selected">No max</option><option value="50000">50,000</option><option value="60000">60,000</option><option value="70000">70,000</option><option value="80000">80,000</option><option value="90000">90,000</option><option value="100000">100,000</option><option value="110000">110,000</option><option value="120000">120,000</option><option value="125000">125,000</option><option value="130000">130,000</option><option value="140000">140,000</option><option value="150000">150,000</option><option value="160000">160,000</option><option value="170000">170,000</option><option value="175000">175,000</option><option value="180000">180,000</option><option value="190000">190,000</option><option value="200000">200,000</option><option value="210000">210,000</option><option value="220000">220,000</option><option value="230000">230,000</option><option value="240000">240,000</option><option value="250000">250,000</option><option value="260000">260,000</option><option value="270000">270,000</option><option value="280000">280,000</option><option value="290000">290,000</option><option value="300000">300,000</option><option value="325000">325,000</option><option value="350000">350,000</option><option value="375000">375,000</option><option value="400000">400,000</option><option value="425000">425,000</option><option value="450000">450,000</option><option value="475000">475,000</option><option value="500000">500,000</option><option value="550000">550,000</option><option value="600000">600,000</option><option value="650000">650,000</option><option value="700000">700,000</option><option value="800000">800,000</option><option value="900000">900,000</option><option value="1000000">1,000,000</option><option value="1250000">1,250,000</option><option value="1500000">1,500,000</option><option value="1750000">1,750,000</option><option value="2000000">2,000,000</option><option value="2500000">2,500,000</option><option value="3000000">3,000,000</option><option value="4000000">4,000,000</option><option value="5000000">5,000,000</option><option value="7500000">7,500,000</option><option value="10000000">10,000,000</option><option value="15000000">15,000,000</option><option value="20000000">20,000,000</option><option value="">No max</option>
	    </select>

			<label for="houseTypeID"><span>Type:</span></label>
				<select id="houseTypeID" class="basic-grey" tabindex="3" name="houseTypeID" >
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


		<label for="housePCode"><span>Postcode</span></label>
			<input type="text" tabindex="10" class="txtBox" id="housePCode" name="housePCode" value="" />



		<label for="minBedrooms"><span>Beds:</span></label>
			<select id="minBedrooms" name="minBedrooms" class="double">
			<option value="" selected="selected">No min</option><option value="0">Studio</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>

		<label for="maxBedrooms"><span>to:</span></label>
			<select id="maxBedrooms" name="maxBedrooms" class="double"><option value="" selected="selected">No max</option><option value="0">Studio</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>
		<input type="button" class="button" id="submitPropertyFormS" name="submitPropertyFormS" value="Find Property"  onClick="myredirect()" action="" />


	 	<script>
		function myredirect() {
   				var priceMin = document.getElementById("minPrice").value ;
				var priceTo = document.getElementById("maxPrice").value ;
				var type = document.getElementById("houseTypeID").value ;
				var postcode = document.getElementById("housePCode").value ;
				var bedMin = document.getElementById("minBedrooms").value ;
				var bedTo = document.getElementById("maxBedrooms").value ;

				var root = 'http://propertywing.co.uk/login2/showsearchresults.php?';
				var urlt = '';
				urlt = urlt.concat(root , 'priceMin=' , priceMin , '&priceTo=', priceTo , '&type=',type  , '&postcode=',postcode , '&bedMin=' , bedMin , '&bedTo=' , bedTo );


				window.location.replace(urlt);


			}
           </script>


	    </form>

    </div>



    <div id="box2">
      <p><a href="mailto:<? echo $row_settings['user_email']; ?>">Email Seller</a></p>
    </div>

	<div id="box3">
		<p>Arrange a Viewing</p>
	</div>

	<div id="box4">
		<p>Make A Formal Offer</p>
	</div>



	<div id="box5">
		<p>Legal Fees for this property</p>
	</div>

	<div id="box5">
		<p>Mortgage Calculator</p>
	</div>

	<div id="box5">
		<p>Local Removals</p>
	</div>

	<div id="box5">
		<p>Local services</p>
	</div>

	<div id="box6" style="margin-top:20px;">
		<p>Add a comment about this property</p>
	</div>

	<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=831669323513345";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>

		<div class="fb-comments" data-href="http://legalwing.co.uk/property-wing/listing.html" data-width="300" data-numposts="5" data-colorscheme="light"></div>
</div>-->

  <div  class="container">
    <div class="row">
      <div class="col-lg-6">
        <div id="property-heading">
          <h2 style="font-size:24px; margin:5px;"><b><?php echo $dbc->getHouseType($newAddedProp['values']['type']); if ( $newAddedProp['values']['status'] == 1 || $newAddedProp['values']['status'] == 3 || $newAddedProp['values']['status'] == 6) echo '<b>'.' For sale'.'</b>' ;  else if( $newAddedProp['values']['status'] == 2 || $newAddedProp['values']['status'] == 4 || $newAddedProp['values']['status'] == 7) echo '<b>'.' To Let'.'</b>'; ?> </b></h2>
          <h1 style="color:#82b24c; margin:5px;">&pound<?php echo '  '.number_format ( $newAddedProp['values']['price'] ,0 ,"." , "," )?> </h1>
          <h2 style="float:left; font-size:16px; margin:5px;"><b><?php echo $newAddedProp['values']['street'].', '.$newAddedProp['values']['address'].'<br>'.$newAddedProp['values']['town'].', '.$newAddedProp['values']['country'].'<br>'.$newAddedProp['values']['postcode'] ; ?></b></h2>
          <h2 style="float:right; font-size:16px; margin:5px; color:#82b24c;"><?php  if ( $newAddedProp['values']['status'] == 1) echo '<b>'.'For sale'.'</b>' ;  else if( $newAddedProp['values']['status'] == 2) echo '<b>'.'To Let'.'</b>';   else if( $newAddedProp['values']['status'] == 3) echo '<b>'.'Sold'.'</b>';  else if( $newAddedProp['values']['status'] == 4) echo '<b>'.'Let'.'</b>';  else if( $newAddedProp['values']['status'] == 6) echo '<b>'.'Under Offer'.'</b>';   else if( $newAddedProp['values']['status'] == 7) echo '<b>'.'Under Offer'.'</b>'; ?></h2>
        </div>
        <br/>
        <div style="margin-top:20px !important" class="slider-container" id="caption-slide">
          <div class="slider">
            <?php
            			for ($idximg = 0 ; $idximg < sizeof( $newAddedProp['images'] )  ; $idximg++ ){

				$imgid = 'img-'.($idximg+1);

				echo '<div>' ;
				echo '<img src="./'.$newAddedProp['images'][$idximg].'" />';
				?>
            <?php
				$prev = ($idximg == 0 ) ? sizeof($newAddedProp['images'])-1 : $idximg-1 ;
				$nxt = ($idximg == sizeof($newAddedProp['images']) -1 ) ? 0 : $idximg+1 ;

				echo '</div>';


			}
			?>

            <?php /*?><div>
				<img src="images/bed.png" alt="">
                 <span class="caption">
                	<h2>&pound<?php echo '  '.$newAddedProp->price ;  echo '   Status : <b>'.$newAddedProp->status.'</b>' ; ?></h2>
         <h1><?php echo $dbc->getHouseType($newAddedProp->type).' for Sale' ; ?></h1>
              <p><?php echo $newAddedProp->street.' '.$newAddedProp->address2 ; ?></p>

                </span>
			</div><?php */?>
          </div>
          <div class="switch" id="prev"><span></span></div>
          <div class="switch" id="next"><span></span></div>
        </div>
        <div class="clr"></div>

      </div>
      <div class="col-lg-6">
      <h1 style="font-size:18px">To book a viewing please contact the seller of the property using the form below</h1>
      <div class="tab">
          <ul class="nav nav-tabs" role="tablist" id="myTab">
            <li role="presentation" class="active"><a  id="maptab" href="#home" aria-controls="home" role="tab" data-toggle="tab">Map</a></li>
            <li role="presentation" ><a id="streettab" href="#street" aria-controls="street" role="tab" data-toggle="tab">Street View</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Description</a></li>
            <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Contact Seller</a></li>
            <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Legal Fees</a></li>
          </ul>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
              <div id="map-canvas"></div>
              </div>
              <div role="tabpanel" class="tab-pane " id="street">
              <div id="map-canvas-street"></div>
              </div>
            <div role="tabpanel" class="tab-pane" id="profile">
              <strong>Full description</strong><br />
              <br />
              <?php echo nl2br( $newAddedProp['values']['description']) ; ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="messages">
              <form role="form" action="" method="post" >
                <div class="row form-back">
                	<br />
                  <div class="col-xs-12 selectContainer">

                  <?php if($userID <= 0) {?>
                    <label for="InputEmail">Email</label>

                      <input type="email" name="email" class="double form-control input-border" id="email" placeholder="Email" required="required" />
                      <?php }
					  else { ?>

                      <input type="hidden" name="email" class="double form-control input-border" id="email" placeholder="Email" required="required" value="<?php echo $userdetails['4'] ?>" />

                      <?php  } ?>

                  </div>
                  <div class="col-xs-12 selectContainer">
                    <label for="InputEmail">Subject</label>

                      <input type="text" name="subject" class="double form-control input-border" id="subject" placeholder="Subject" required="required" />


                  </div>
                  <div class="col-xs-12 selectContainer">

                  <label for="InputEmail">Message</label>

                    <textarea name="message" class="basic-grey form-control" id="message" placeholder="Please type your message here" required="required"  rows="5"></textarea>
                   </div>
                  <input type="submit" class="button btn btn-info pull-right" id="submit_msg" name="submit_msg" value="Send" style="margin:10px;" />
                </div>
              </form>
            </div>
            <div role="tabpanel" class="tab-pane" id="settings"> <strong>Conveyancing Quote Legal Fees</strong> <br />
              <br />
              Please see below an estimate of the legal fees for this property <br />
              <br />
              <ul class="legal">
                <li>Our Purchase fee</li>
                <li> &pound;960 including VAT</li>
                <li>Local Authority Search Fee</li>
                <li> &pound;110.00 including VAT</li>
                <li>Drainage Search Fee</li>
                <li> &pound;54.90</li>
                <li>Enviro Search Fee</li>
                <li> &pound;55.20</li>
                <li>Land Registry Search Fee</li>
                <li> &pound;2.00 (per name if obtaining mortgage)</li>
                <li>Land Charge Search Fee</li>
                <li> &pound;3.00</li>
                <li>Land Registry Registration Fee</li>
                <li> &pound;270.00</li>
                <li>Stamp Duty</li>
                <li>&pound;
                <?php if($newAddedProp['values']['price'] <= 125000)
						echo "0";
					else if($newAddedProp['values']['price'] <= 250000)
						echo ($newAddedProp['values']['price']*2)/100 ;
					else if($newAddedProp['values']['price'] <= 925000)
						echo "&pound;". 2500 + (($newAddedProp['values']['price']-250000)*2)/100 ;
					else if($newAddedProp['values']['price'] <= 1500000)
						echo 2500.00 + 33749.95  + (($newAddedProp['values']['price']-925000)*10)/100 ;
					else
						echo  2500 + 33749.95 + 57500 + (($newAddedProp['values']['price']-1500000)*12)/100 ;


				?>
                </li>

              </ul>
            </div>
          </div>
        </div>
        </div>
      <?php /*?><hr class="featurette-divider hidden-lg">
  <div class="col-lg-5 col-md-push-1">

   		<div class="section">
        	 <span class="title txttitle">My Account</span>

            <div class="footer-icon">
                 <a href="#" class="footicon-text"><span class="ft-icon"><img src="images/user-ico.png" alt="map" /></span><strong>My Account Settings</strong></a>
            </div>

            <div class="footer-icon">
                 <a href="#" class="footicon-text"><span class="ft-icon"><img src="images/log.png" alt="cell" /></span><strong>Log Out</strong></a>
            </div>
        </div>



        	<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=831669323513345";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>

		<div class="fb-comments" data-href="http://legalwing.co.uk/property-wing/listing.html" data-width="300" data-numposts="5" data-colorscheme="light"></div>

  </div><?php */?>
    </div>
  </div>
  <!--<div id="listing" style="margin-top:10px;">
	<ul class="slides">

		<?php

		/*	for ($idximg = 0 ; $idximg < sizeof( $newAddedProp->images )  ; $idximg++ ){

				$imgid = 'img-'.($idximg+1);

				echo "<input type='radio' name='radio-btn' id='".$imgid."'".( $idximg == 0 ? " checked" : " ")."/>";
				echo ' <li class="slide-container"><div class="slide">' ;
				echo '<img src="./'.$newAddedProp->images[$idximg].'" />';
				echo '</div><div class="nav">';

				$prev = ($idximg == 0 ) ? sizeof($newAddedProp->images)-1 : $idximg-1 ;
				$nxt = ($idximg == sizeof($newAddedProp->images) -1 ) ? 0 : $idximg+1 ;

				echo '<label for="img-'.($prev+1).'" class="prev">&#x2039;</label>';
				echo '<label for="img-'.($nxt+1).'" class="next">&#x203a;</label>';
				echo '</div></li>';


			}

			echo '<li class="nav-dots">' ;

			for ($idximg = 0 ; $idximg < sizeof( $newAddedProp->images ) ; $idximg++ ){
				$imgid = 'img-'.($idximg+1) ;
				echo '<label for="'.$imgid.'" class="nav-dot" id="'.$imgid.'"></label>';
			 }
			 echo '</li></ul> ';*/
		?>

	<div class="tabs">
        <ul class="tabs" data-persist="true">
            <li><a href="#view1">Description</a></li>
			<li><a href="#view3">Map</a></li>
            <li><a href="#view4">Contact Seller</a></li>
			<li><a href="#view5">Legal Fees</a></li>

        </ul>

	<div class="tabcontents">
         <div id="view1">
               <h2 class="full"> Full description<h2>
					<?php echo $newAddedProp->description ; ?>
		</div>

     <div id="view2">


     </div>



    <div id="view3">
             <h2>Property on the Map</h2>
				<h3>For Street view</h3>
                   <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2503.1617751942354!2d0.28354349999999995!3d51.14236779999999!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47df467f3142383d%3A0xddd02b60c6899e06!2sSandhurst+Rd!5e0!3m2!1sen!2suk!4v1399382088840" width="600" height="600" frameborder="0" style="border:0"></iframe>
    </div>


     <div id="view4" class="view44">
            <h2 style="font-size:15pt; margin-top:-10px;">Contact the seller of this property</h2>
	             <form id="contactForm1" action="" method="post" class="search-form" style="margin-left:30px; background-color:#fff">
                       <label for="subject" style="margin-left:-85px;"></label>
                             <input type="text" name="subject" id="subject" placeholder="Subject" required="required" maxlength="64" style="border:2px soild #ccc; width:300px;"  />


                                <label for="message" class="basic-grey" ></label>
                                     <textarea name="message" class="basic-grey" id="message" placeholder="Please type your message here" required="required" cols="60" rows="10" maxlength="10000" style="border:1px soild #ccc; width:300px;  height:100px;"></textarea>
			 <div id="formButtons">
			   <input type="submit" class="button" id="submit_msg" name="submit_msg" value="Send" style="margin-left:0px;" />
			 </div>

			 </form>
     </div>

    <div id="view5">
        <h2>Conveyancing Quote</h2>
           <h2 style="font-family:verdana; margin-top:-10px; font-weight:300;">Legal Fees</h2>
				<p style="font-family:verdana; font-size:10pt;">Please see below an estimate of the legal fees for this property</p>

	<div style="padding-left:10px; padding-top:30px;">
		<table style=" font-family:Verdana; font-size:10pt; margin-left:0px; margin-top:0px;">
		 <tr>
			<td style="width:200px;">Solicitors Fee </td>

			<td style="padding-left:20px;">�700.00 inc VAT</td>
		</tr>

		<tr>

			<td style="width:200px;">Local Authority Search Fee</td>

			<td style="padding-left:20px;">�110.00</td>

		</tr>

		<tr>

			<td>Drainage Search Fee </td>

			<td style="padding-left:20px;">�54.90</td>

		</tr>

		<tr>

			<td>Enviro Search Fee</td>


			<td style="padding-left:20px;">�55.20</td>

		</tr>

		<tr>

			<td>Land Registry Search Fee </td>


			<td style="padding-left:20px;">�2.00 (per name if obtaining mortgage)</td>

		</tr>

		<tr>

			<td>Land Charge Search Fee </td>


			<td style="padding-left:20px;">�3.00</td>

		</tr>

		<tr>


		<tr>

			<td>Land Registry Registration Fee </td>


			<td style="padding-left:20px;">�270.00</td>

		</tr>

		<tr>

			<td>Stamp Duty </td>


			<td style="padding-left:20px;">3% of Agreed Purchase Price</td>

		</tr>
	  </table>
    </div>
  </div>

		<div id="view6">

		</div>

    </div>

</div>-->
<br/>
<hr/>
<div style="background-color:rgba(256,256,256,1 ) !important;"  class="row">

<span class="title">Refine your Search</span>
  <div class="container-fluid bg-set-gray">
  <br/>
    <form role="form" class="grey" method="get" enctype="multipart/form-data" action="showsearchresults.php">
      <div style="background-color:rgba(46,109,164,0.85) !important;" class="col-sm-8 set-bg-white">
      <br/>
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

        <input type="text" style="background-color:#FFFFFF !important;" class="double form-control input-border" id="locationIdentifier" name="locationIdentifier" value="<?php echo $locationsfull ?>" />
         <div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="images/arrow1.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div></div>
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

    </form>
    <br/>
  </div>

</div>
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
<style>
      html, body, #map-canvas {
        height: 400px;
        margin: 0px;
        padding: 0px;
		z-index:9999 !important;
      }
	   html, body, #map-canvas-street {
        height: 300px;
        margin: 0px;
        padding: 0px;
		z-index:9999 !important;
      }
	  .active> #map-canvas-street {
        height: 401px !important;
        margin: 0px;
        padding: 0px;
		z-index:9999 !important;
      }
    </style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDup-23CPNjYbS7m2rHU9h7iqkn5KDqbiM&v=3.exp&sensor=false&language=en"></script>
    <script>

		function initialize() {
  var myLatlng = new google.maps.LatLng('<?php echo $lat ?>', '<?php echo $lng ?>');
  var mapOptions = {
    zoom: 14,
    center: myLatlng
  };
var bryantPark = new google.maps.LatLng('<?php echo $lat ?>', '<?php echo $lng ?>');
  var panoramaOptions = {
    position: bryantPark,
    pov: {
      heading: 165,
      pitch: 0
    },
    zoom: 1
  };
  var myPano = new google.maps.StreetViewPanorama(
      document.getElementById('map-canvas-street'),
      panoramaOptions);
  myPano.setVisible(true);
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h2 id="firstHeading" class="firstHeading"><?php echo $dbc->getHouseType($newAddedProp['values']['type']).' for Sale' ; ?></h2>'+
      '<div id="bodyContent">'+
      '<h2 id="firstHeading" class="firstHeading"><?php echo 'Postcode : '.$newAddedProp['values']['postcode']; ?></h2>'+
	  '<p>Address : <?php echo $newAddedProp['values']['street']; ?> , <?php echo $newAddedProp['values']['address']; ?> , <?php echo $newAddedProp['values']['town']; ?> , <?php echo $newAddedProp['values']['country']; ?></p>'+
      '</div>'+
      '</div>';

  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: '<?php echo 'Postcode : '.$newAddedProp['values']['postcode']; ?>'
  });
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
  });

}
 google.maps.event.addDomListener(window, 'load', initialize);
function loadScript() {
      var script = document.createElement("script");
      script.type = "text/javascript";
      script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDup-23CPNjYbS7m2rHU9h7iqkn5KDqbiM&sensor=false&callback=initialize";
      document.body.appendChild(script);
    }

    var tab = document.getElementById('streettab');
   // tab.onmouseover = loadScript;
    tab.onclick = loadScript;
	 var tab1 = document.getElementById('maptab');
    //tab.onmouseover = loadScript;
    tab1.onclick = loadScript;



</script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=831669323513345";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
  <script src="js/slider.js"></script>
  <script>
	$("#slider-container").sliderUi({
		speed: 700,
		cssEasing: "cubic-bezier(0.285, 1.015, 0.165, 1.000)"
	});
	$("#caption-slide").sliderUi({
		caption: true
	});
</script>

</div>
</div>
</div>
<?php include 'footer.php';  ?>
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
