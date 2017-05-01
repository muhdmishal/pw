</div>
</div>
<?php
include ('includes/header.php') ;
?>

<div class="islisting-page">
<form class="search-form listinf-search">

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

	
		<label for="housePCode"><span>Postcode</span></label>
			<input type="text" tabindex="10" class="txtBox" id="housePCode" name="housePCode" value="" />
				
		

		<label for="minBedrooms"><span>Beds:</span></label>
			<select id="minBedrooms" name="minBedrooms" class="double"><option value="" selected="selected">No min</option><option value="0">Studio</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>
		<label for="maxBedrooms"><span>to:</span></label>	
			<select id="maxBedrooms" name="maxBedrooms" class="double"><option value="" selected="selected">No max</option><option value="0">Studio</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>
		<input type="submit" class="button" id="submitPropertyForm" name="submitPropertyForm" value="Find Property" />
	</form>	




</div>
<?php include 'footer.php';?> 