<?php 
include 'dbc.php';
page_protect();
include 'includes/header.html';
 

?>


  
	  

</body>
<body>

      



<img src="images/houses-banner.jpg"/>
<div style="float:right; background-color:white; margin-top:-135px; margin-right:30px;">

</div>


<div id="property-heading">

<h2>£175,000</h2>


<h1>2 Bedroom Flat for Sale</h1>
<p>Sandhurst Road Tunbridge Wells, Kent</p>

</div>
</div>





<div id="right-column" >

<div id="box1">
<p>Back to results</p>
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
		
			 
			
			
	<label for="minPrice"><span>Price £:</span></label>	
	<select id="minPrice" name="minPrice" class="double"><option value="" selected="selected">No min</option><option value="50000">50,000</option><option value="60000">60,000</option><option value="70000">70,000</option><option value="80000">80,000</option><option value="90000">90,000</option><option value="100000">100,000</option><option value="110000">110,000</option><option value="120000">120,000</option><option value="125000">125,000</option><option value="130000">130,000</option><option value="140000">140,000</option><option value="150000">150,000</option><option value="160000">160,000</option><option value="170000">170,000</option><option value="175000">175,000</option><option value="180000">180,000</option><option value="190000">190,000</option><option value="200000">200,000</option><option value="210000">210,000</option><option value="220000">220,000</option><option value="230000">230,000</option><option value="240000">240,000</option><option value="250000">250,000</option><option value="260000">260,000</option><option value="270000">270,000</option><option value="280000">280,000</option><option value="290000">290,000</option><option value="300000">300,000</option><option value="325000">325,000</option><option value="350000">350,000</option><option value="375000">375,000</option><option value="400000">400,000</option><option value="425000">425,000</option><option value="450000">450,000</option><option value="475000">475,000</option><option value="500000">500,000</option><option value="550000">550,000</option><option value="600000">600,000</option><option value="650000">650,000</option><option value="700000">700,000</option><option value="800000">800,000</option><option value="900000">900,000</option><option value="1000000">1,000,000</option><option value="1250000">1,250,000</option><option value="1500000">1,500,000</option><option value="1750000">1,750,000</option><option value="2000000">2,000,000</option><option value="2500000">2,500,000</option><option value="3000000">3,000,000</option><option value="4000000">4,000,000</option><option value="5000000">5,000,000</option><option value="7500000">7,500,000</option><option value="10000000">10,000,000</option><option value="15000000">15,000,000</option><option value="20000000">20,000,000</option><option value="">No min</option>
	</select> 
	<label for="max"><span>To:</span></label>
	<select id="maxPrice" name="maxPrice" class="double"><option value="" selected="selected">No max</option><option value="50000">50,000</option><option value="60000">60,000</option><option value="70000">70,000</option><option value="80000">80,000</option><option value="90000">90,000</option><option value="100000">100,000</option><option value="110000">110,000</option><option value="120000">120,000</option><option value="125000">125,000</option><option value="130000">130,000</option><option value="140000">140,000</option><option value="150000">150,000</option><option value="160000">160,000</option><option value="170000">170,000</option><option value="175000">175,000</option><option value="180000">180,000</option><option value="190000">190,000</option><option value="200000">200,000</option><option value="210000">210,000</option><option value="220000">220,000</option><option value="230000">230,000</option><option value="240000">240,000</option><option value="250000">250,000</option><option value="260000">260,000</option><option value="270000">270,000</option><option value="280000">280,000</option><option value="290000">290,000</option><option value="300000">300,000</option><option value="325000">325,000</option><option value="350000">350,000</option><option value="375000">375,000</option><option value="400000">400,000</option><option value="425000">425,000</option><option value="450000">450,000</option><option value="475000">475,000</option><option value="500000">500,000</option><option value="550000">550,000</option><option value="600000">600,000</option><option value="650000">650,000</option><option value="700000">700,000</option><option value="800000">800,000</option><option value="900000">900,000</option><option value="1000000">1,000,000</option><option value="1250000">1,250,000</option><option value="1500000">1,500,000</option><option value="1750000">1,750,000</option><option value="2000000">2,000,000</option><option value="2500000">2,500,000</option><option value="3000000">3,000,000</option><option value="4000000">4,000,000</option><option value="5000000">5,000,000</option><option value="7500000">7,500,000</option><option value="10000000">10,000,000</option><option value="15000000">15,000,000</option><option value="20000000">20,000,000</option><option value="">No max</option>
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

	
		<label for="housePCode"><span>Postcode or Town</span></label></br>
			<input type="text" tabindex="10" class="txtBox" id="housePCode" name="housePCode" value="" />
				
		

		<label for="minBedrooms"><span>Beds:</span></label>
			<select id="minBedrooms" name="minBedrooms" class="double"><option value="" selected="selected">No min</option><option value="0">Studio</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>
		<label for="maxBedrooms"><span>to:</span></label>	
			<select id="maxBedrooms" name="maxBedrooms" class="double"><option value="" selected="selected">No max</option><option value="0">Studio</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>
		<input type="submit" class="button" id="submitPropertyForm" name="submitPropertyForm" value="Find Property" />
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
}(document, 'script', 'facebook-jssdk'));</script>
<div class="fb-comments" data-href="http://legalwing.co.uk/property-wing/listing.html" data-width="300" data-numposts="5" data-colorscheme="light"></div>



<div id="map-box">
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2502.8413859303546!2d0.33077299999999993!3d51.14827599999999!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47df47b205587957%3A0x4ad5687164ac7214!2sBeagles+Wood+Rd!5e0!3m2!1sen!2suk!4v1397659822138" width="300" height="225" frameborder="0" style="border:0"></iframe>
</div>




</div>




<ul class="slides">
    <input type="radio" name="radio-btn" id="img-1" checked />
    <li class="slide-container">
		<div class="slide">
			<img src="../property-images/image-8.JPG" />
        </div>
		<div class="nav">
			<label for="img-10" class="prev">&#x2039;</label>
			<label for="img-2" class="next">&#x203a;</label>
		</div>
    </li>

    <input type="radio" name="radio-btn" id="img-2" />
    <li class="slide-container">
        <div class="slide">
          <img src="../property-images/image-11.JPG" />
        </div>
		<div class="nav">
			<label for="img-1" class="prev">&#x2039;</label>
			<label for="img-3" class="next">&#x203a;</label>
		</div>
    </li>

    <input type="radio" name="radio-btn" id="img-3" />
    <li class="slide-container">
        <div class="slide">
          <img src="../property-images/image-9.JPG" />
        </div>
		<div class="nav">
			<label for="img-2" class="prev">&#x2039;</label>
			<label for="img-4" class="next">&#x203a;</label>
		</div>
    </li>

    <input type="radio" name="radio-btn" id="img-4" />
    <li class="slide-container">
        <div class="slide">
          <img src="../property-images/image-10.JPG" />
        </div>
		<div class="nav">
			<label for="img-3" class="prev">&#x2039;</label>
			<label for="img-5" class="next">&#x203a;</label>
		</div>
    </li>

    <input type="radio" name="radio-btn" id="img-5" />
    <li class="slide-container">
        <div class="slide">
          <img src="../property-images/image-12.JPG" />
        </div>
		<div class="nav">
			<label for="img-4" class="prev">&#x2039;</label>
			<label for="img-6" class="next">&#x203a;</label>
		</div>
    </li>

    <input type="radio" name="radio-btn" id="img-6" />
    <li class="slide-container">
        <div class="slide">
          <img src="../property-images/image-13.JPG" />
        </div>
		<div class="nav">
			<label for="img-5" class="prev">&#x2039;</label>
			<label for="img-7" class="next">&#x203a;</label>
		</div>
    </li>
	
	  <input type="radio" name="radio-btn" id="img-7" />
    <li class="slide-container">
        <div class="slide">
          <img src="../property-images/image-7.JPG" />
        </div>
		<div class="nav">
			<label for="img-6" class="prev">&#x2039;</label>
			<label for="img-8" class="next">&#x203a;</label>
		</div>
    </li>
	
	  <input type="radio" name="radio-btn" id="img-8" />
    <li class="slide-container">
        <div class="slide">
          <img src="../property-images/image-6.JPG" />
        </div>
		<div class="nav">
			<label for="img-7" class="prev">&#x2039;</label>
			<label for="img-9" class="next">&#x203a;</label>
		</div>
    </li>
	
	  <input type="radio" name="radio-btn" id="img-9" />
    <li class="slide-container">
        <div class="slide">
          <img src="../property-images/image-5.JPG" />
        </div>
		<div class="nav">
			<label for="img-8" class="prev">&#x2039;</label>
			<label for="img-10" class="next">&#x203a;</label>
		</div>
    </li>
	
	  <input type="radio" name="radio-btn" id="img-10" />
    <li class="slide-container">
        <div class="slide">
          <img src="../property-images/image-4.JPG" />
        </div>
		<div class="nav">
			<label for="img-9" class="prev">&#x2039;</label>
			<label for="img-1" class="next">&#x203a;</label>
		</div>
    </li>

    <li class="nav-dots">
      <label for="img-1" class="nav-dot" id="img-dot-1"></label>
      <label for="img-2" class="nav-dot" id="img-dot-2"></label>
      <label for="img-3" class="nav-dot" id="img-dot-3"></label>
      <label for="img-4" class="nav-dot" id="img-dot-4"></label>
      <label for="img-5" class="nav-dot" id="img-dot-5"></label>
      <label for="img-6" class="nav-dot" id="img-dot-6"></label>
	  <label for="img-7" class="nav-dot" id="img-dot-7"></label>
      <label for="img-8" class="nav-dot" id="img-dot-8"></label>
      <label for="img-9" class="nav-dot" id="img-dot-9"></label>
      <label for="img-10" class="nav-dot" id="img-dot-10"></label>
    </li>
</ul>



<div id="listing" style="margin-top:10px;">






<div style="width: 655px; margin: 0 0; padding: 20px 0 0px;">
        <ul class="tabs" data-persist="true">
            <li><a href="#view1">Description</a></li>
            <li><a href="#view2">Floor Plan</a></li>
			<li><a href="#view3">Map</a></li>
            <li><a href="#view4">Book a viewing</a></li>
			<li><a href="#view5">Legal Fees</a></li>
			<li><a href="#view6">Mortgage Calculator</a></li>
        </ul>
        <div class="tabcontents">
            <div id="view1">
               <h2> Full description<h2>
<p>Are you struggling to find a good sized two bedroom property, both of which are of a double size, with parking and in a central Tunbridge Wells location in your price range? This first floor apartment could be the answer to your prayers!</p>
<p>Brentor Court is situated just off Sandhurst Road and has the luxury of being in such a busy central location, without the noise of busy traffic. It is perfectly situated and tucked away – your own peaceful refuge from the hustle and bustle.</p>
<p>With beautiful fresh and stylish decor throughout, you can enjoy the exciting aspects of moving home like buying new furniture and planning where everything will go. No need to peel off old wallpaper or worry about the cost of changing the kitchen units, this truly is in walk in condition.</p>
<p>Such a wonderful opportunity for first time buyers to get on the property market, without costing the world. Buy to let investors who are looking for a sound financial investment with a great rental yield or simply looking to make a step up. This adaptable and larger style apartment will suit your requirements.</p>
<h3>What the Owner says:</h3>

<p>As a first time buyer, I found it difficult to find an apartment that ticked all the boxes. I must have viewed over 20 apartments and I didn’t think I would ever find “the one”. At first, I wasn’t going to view this property, as I was looking for something traditional but I thought I would give it a try… and I’m so glad I did!!</p>
<p>The rooms are so large, both bedrooms are bigger than any doubles I had seen in the other flats I had viewed. The living room is big and bright and I love the views over the communal area and beyond. I love the fact that I can walk into Tunbridge Wells and take advantage of the great restaurants and bars. London is only an hour away by train from Tunbridge Wells.</p>
<p>Room sizes:</p>
<h3>FIRST FLOOR</h3>
<p>Entrance Hall</p>
<p>Bathroom: 11'0 x 6'0 (3.36m x 1.83m)</p>
<p>Kitchen: 10'5 x 7'3 (3.18m x 2.21m)</p>
<p>Lounge/Diner: 16'2 x 10'1 (4.93m x 3.08m)</p>
<p>Bedroom 1: 12'7 x 10'1 (3.84m x 3.08m)</p>
<p>Bedroom 2: 11'4 x 7'2 (3.46m x 2.19m)</p>
<h3>OUTSIDE</h3>
<p>Allocated Parking</p>
            </div>
            <div id="view2">
				<h2>Floor Plan</h2>
					<img src="property-images/floorplan-lf.png"/>              
            </div>
			<div id="view3">
                <h2>Property on the Map</h2> 
				<h3>For Street view</h3>
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2503.1617751942354!2d0.28354349999999995!3d51.14236779999999!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47df467f3142383d%3A0xddd02b60c6899e06!2sSandhurst+Rd!5e0!3m2!1sen!2suk!4v1399382088840" width="600" height="450" frameborder="0" style="border:0"></iframe>			
            </div>
            <div id="view4">
                <h2>Arrange a Viewing</h2>
            </div>
			
			<div id="view5">
                <h2>Conveyancing Quote</h2>  

<h2 style="font-family:verdana; margin-top:-10px; font-weight:300;">Legal Fees</h2>
<p style="font-family:verdana; font-size:10pt;">Please see below an estimate of the legal fees for this property</p>
<div style="padding-left:10px; padding-top:30px;">

<table style=" font-family:Verdana; font-size:10pt; margin-left:0px; margin-top:0px;">
<tr>
<td style="width:200px;">Solicitors Fee </td>

<td style="padding-left:20px;">£700.00 inc VAT</td>
</tr>

<tr>

<td style="width:200px;">Local Authority Search Fee</td>

<td style="padding-left:20px;">£110.00</td>

</tr>

<tr>

<td>Drainage Search Fee </td>

<td style="padding-left:20px;">£54.90</td>

</tr>

<tr>

<td>Enviro Search Fee</td>


<td style="padding-left:20px;">£55.20</td>

</tr>

<tr>

<td>Land Registry Search Fee </td>


<td style="padding-left:20px;">£2.00 (per name if obtaining mortgage)</td>

</tr>

<tr>

<td>Land Charge Search Fee </td>


<td style="padding-left:20px;">£3.00</td>

</tr>

<tr>


<tr>

<td>Land Registry Registration Fee </td>


<td style="padding-left:20px;">£270.00</td>

</tr>

<tr>

<td>Stamp Duty </td>


<td style="padding-left:20px;">3% of Agreed Purchase Price</td>

</tr>


</table>				
            </div>
        </div>
		
		<div id="view6">
                <h2>Mortgage Calculator</h2> 
				</div>
		
    </div>

</div>

	
	



<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=831669323513345";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


	  
	  
	  
	  
	  

</body>
</html>
