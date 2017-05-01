<?php
include 'dbc.php';
page_protect();
include 'includes/header1.php';
/*include 'includes/sidebar.html';
*/
$rs_settings = mysqli_query($link,"select * from users where user_id='$_SESSION[user_id]'");

$userID = $_SESSION[user_id]   ;

require_once 'dbapi.php';
require_once 'property.php';
require_once 'getmessages.php';



$dbc = new DBAPI();
?>
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
	top:10px;
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
	width:100%;
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
<div class=" bg-image-fixed">
<div class="container"  style="overflow:visible !important;">
    <div class="col-sm-8"  style="overflow:visible !important;">
    <div class="col-sm-12 form-back" style="overflow:visible !important;">
    	<form role="form"  style="overflow:visible !important;"  methos="GET" action="continuesearch.php" enctype="multipart/form-data" action="continuesearch.php">

      			 <div id="suggest"  style="overflow:visible !important; ">
      			<input type="text" class="basic-grey form-control" onkeyup="suggest(this.value);" onblur="fill();"  id="whattosearch" name="whattosearch" placeholder="Quick Search Properties">

                <div class="suggestionsBox" id="suggestions" style="display: none;"> <img src="images/arrow1.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
        <div class="suggestionList" id="suggestionsList"> &nbsp; </div></div>
        </div>

        </form>
    </div>


<?php

		$sqlSearch = "SELECT * FROM `property` WHERE `user_id` ='$userID'";



		$results = $dbc->searchProperties($sqlSearch) ;


		if ($results == 0 )
			echo '<div class="col-sm-12 form-back"> No Properties Added yet ! Click here to <a style="color:blue" href="add-property.php"> add a property</a></div>' ;
		else {
		 while ($row = $results->fetch_assoc()) {
        	//	printf ("%s (%s)\n", $row["Name"], $row["CountryCode"]);
    		$status = $row['status'];
			if($status == 5)
			continue;
			$propID = $row['property_id'];
			$propPrice = $row['price'];
			$propType = $dbc->getHouseType($row['type']);
			$propStreet = $row['street'];
			$propAdd2 = $row['address'];
			$propTown = $row['town'];
			$propCountry = $row['county'];
			$propPostCode = $row['postcode'];
			$propBeds = $row['bedrooms'];
			$propBaths = $row['bathrooms'];
			$propDesc = $row['description'];
			$status = $row['status'];

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

                ?>
    <div class="col-sm-12 form-back">
    <div class='col-sm-12  searchresult'>

		   <div class="row"><h2 class='pull-left'>&pound<?php echo '  '.number_format ( $propPrice ,0 ,"." , "," )?> </h2>
			<h2 class='pull-right color-green'><strong><?php echo $propType.' for Sale' ; ?></strong></h2></div>
              <div class='block-img col-xs-3'>
                  <img src="<?php echo $img1 ?>" />
                  <?php
                  if ($img2 != './')
  						echo '<div class="small-images-left"> <img src="'.$img2.'" /> </div>';
  				if ($img3 != './')
  						echo '<div class="small-images-right"> <img src="'.$img3.'" /> </div>';
					?>
              </div>
              <div class='block-text col-xs-9'>





         <h3><?php echo $propStreet.' '.$propAdd2.' , '.$propTown.' , '.$propCountry.' , '.$propPostCode ?></h3>
					<div class='hidden-xs'>
					<p><strong>Description</strong></p>
                  <p class='para'><?php echo $propDescR ;?>.....<a href='http://propertywing.co.uk/new/showprop.php?idprop=<?php echo $propID ?>' class='atag1'>read more</a></p>
                 <p class='para2'><a href='http://propertywing.co.uk/new/showprop.php?idprop=<?php echo $propID ?>' class='atag1'>View Property</a></p>
              </div>

			  </div>
              <a href='showprop.php?idprop=<?php echo $propID ?>' class='btn  viewfull button pull-right'>View Full Detials</a>
               <a href='edit_property.php?idprop=<?php echo $propID ?>' class='btn  viewfull button pull-right'>Edit Property Details</a>
               <a href='facebook-advert.php?idprop=<?php echo $propID ?>' class='btn  viewfull button pull-right'>Boost Advet on facebook</a>
			  <div class='clear'></div>
       </div>



    </div>


<?php }} ?>   </div>

       <div class="col-sm-3">

     <?php
include ('sidebar.php') ;
?>
</div>


<div class="col-sm-8">
  		<div class="col-sm-12 form-back" >

         <span class="title innhead">Welcome to your account home page <?php echo $_SESSION['user_name'];?></span>



        	<section class="row">
        	<div class="col-sm-4 ">
            		<article class="services-list services-color-04">
                      		<a href="#"><img src="images/new-houses-small.jpg" align="" class="img-responsive"/></a>
                        </article>
                        <br />
                        <br />
                    <p class="p-article">
                        Upload pictures & details of your property
We advertise your website using the internet
Your property will be added to our mailing list
Liaise with potential buyers and arrange viewings
                    </p>
            </div>
            <div class="col-sm-4 ">
            		<article class="services-list services-color-04">
                      		<a href="#"><img src="images/its-free.png" align="" class="img-responsive"/></a>
                        </article>
                        <br />
                        <br />
                    <p class="p-article">
                       This service is 100% free to use
There will never be a charge for using our website
Selling online couldnt be easier
                    </p>
            </div>

            <div class="col-sm-4 ">

            		<article class="services-list services-color-04">
                      		<a href="#"><img src="images/social-networks.jpg" align="" class="img-responsive"/></a>
                    </article>
            <br />
            <br />
            	<p class="p-article">
                	We will advertise your property on all search engines
We will post your property on our social Networks
Your property will be added to our mailing list
                </p>

            </div>
        </section>




        </div>




</div>
    <br /><br />



<!--<h3 style="margin-left:16px;font-size: 22px;">Welcome to your account home page </h3>

<p class="index-contant">Using the tabs on the left you can add a property, if you have added more than one property you can view and manage your listings. </p>

<p class="index-contant">You have your own message inbox where you can see any images you have received regarding your property you have sold, all messages will also be forwarded to the email you used to register so you'll never miss an enquiry on your property</p>

<p class="index-contant">You can also order a For Sale Board to let people know your property is for sale for only £25.00</p>

<p class="index-contant">If you are also looking for a property to buy or rent then please sign up to receive the latest properties in the areas of your choice</p>


<div id="homepage-box">
<img src="images/new-houses-small.jpg"/ style="width:190px; padding-left:5px; padding-top:5px;">
<ul class="boxes">
<li style="margin-bottom:5px;">Upload pictures & details of your property</li>
<li style="margin-bottom:5px;">We advertise your website using the internet</li>
<li style="margin-bottom:5px;">Your property will be added to our mailing list</li>
<li style="margin-bottom:5px;">Liaise with potential buyers and arrange viewings </li>
</ul>
</div>

<div id="homepage-box2">
<img src="images/its-free.png"/ style="width:190px; padding:5px;">
<ul class="boxes">
<li style="margin-bottom:5px;">This service is 100% free to use</li>
<li style="margin-bottom:5px;">There will never be a charge for using our website</li>
<li style="margin-bottom:5px;">Selling online couldnt be easier</li>

</ul>
</div>

<div id="homepage-box3">
<img src="images/social-networks.jpg"/ style="width:190px; padding:5px;">

<ul class="boxes">
<li style="margin-bottom:5px;">We will advertise your property on all search engines</li>
<li style="margin-bottom:5px;">We will post your property on our social Networks</li>
<li style="margin-bottom:5px;">Your property will be added to our mailing list</li>

</ul>

</div>








<h3 style="margin-left:16px;font-size: 23px;">The new way to sell and find your property</h3>

<p class="index-contant">The internet is a great tool for connecting people. It has changed our day to day lives, saving us money and connecting us with our friends and family.</p>
<p class="index-contant">We have created The Property Wing to help connect home sellers and buyers and save £1000's in estate agency fees. We are not an estate agent so even if you do have a contract with an agent for your home you are still entitled to advertise your home yourself using our website.  </p>
<p></p>
<p></p>

</div>




	</div>
</div>-->
</div>
</div>
<?php include 'footer.php';?>
<script>
function suggest(inputString){

		if(inputString.length == 0) {
			$('#suggestions').fadeOut();
		} else {
		$('#whattosearch').addClass('load');
			$.post("autosuggest.php", {queryString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').fadeIn();
					$('#suggestionsList').html(data);
					$('#whattosearch').removeClass('load');
				}
			});
		}
	}

	function fill(thisValue) {
		$('#whattosearch').val(thisValue);
		setTimeout("$('#suggestions').fadeOut();", 600);
	}

</script>
