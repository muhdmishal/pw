
<?php
include 'includes/header.html';
?>
<body id="body" style="background-color:white;" >
<div id="main" >

<img src="images/property-page.png"/ style="margin-left:70px;">

<img src="images/new-houses.jpg"/>

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

<?php echo $newAddedProp->description ; ?>

            

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


<form id="searchbox" action="">
    <input id="search" type="text" placeholder="Search Properties by Postcode or Town">
    <input id="submit" type="submit" value="Search">
</form>

<div class="container">
    <a href="add-property.php" class="buttonadd button-green">Add Your Property</a>
    
  </div>


</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</div>
</div>

