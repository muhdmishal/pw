<?php
include 'dbc.php';
page_protect();
include 'includes/header1.php';
/*include 'includes/sidebar.html';
*/?>

<div class=" bg-image-fixed">
  <div class="container">
  <div class="col-sm-8 ">
  
    <div class="form-back"> <span style="font-size:24px">For Sale Board</span> </div>
    
    <div class="form-back" style="clear:none !important"> <span style="font-size:18px">Order It Now for Just: &pound;24.99</span> </div>
    <div class="form-back" style="clear:none !important">
      <form role="form" action="" method="post" enctype="multipart/form-data">
        <div class="col-xs-12 selectContainer">
          <label for="InputName">Your Name</label>
          <input tabindex="1" id="name" type="text" class="add-property-input form-control" name="name"  placeholder="Your Full Name" />
        </div>
        <div class="col-xs-6 hidden-xs"> <img src="images/forsaleboard.png" class="img-responsive" /> </div>
        <div class="col-xs-6 visible-xs"><div class="forsaleimage"></div>  </div>
        <div class="col-xs-6 selectContainer">
          <label for="Address">Your Address</label>
          <div class="input-group">
            <textarea  id="Address" name="Address"  rows="10" tabindex="2" cols="180" class="form-control basic-grey" >Full Address</textarea>
          </div>
        </div>
        <div class="col-xs-6 selectContainer">
          <label for="PostCode">PostCode</label>
          <input tabindex="1" id="PostCode" type="number" class="add-property-input form-control" name="name"  placeholder="PostCode" />
        </div>
        <div class="col-xs-3 selectContainer"> <a href="#"><img src="images/paypal-button-image.png" class="img-responsive" /></a> </div>
      </form>
    </div>
    </div>
    <div class="col-sm-3">
     <?php
include ('sidebar.php') ;
?>
</div>
  </div>
  <br />
  <br />
  
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
<?php include 'footer.php';?>
<script>
  document.title = "Propertywing For sale Board order here ";
</script>