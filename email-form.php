<?php
		include 'dbc.php';
		page_protect();
		include 'includes/header1.php';

		$rs_settings = mysqli_query($link,"select * from users where id='$_SESSION[user_id]'");

		$ids = mysqli_fetch_row($rs_settings );

	 //  require_once 'dbapi.php' ;
	//   include ('prop.php') ;
	//   include ('DBAPI.php');


	 ?>

<div class=" bg-image-fixed">
<div class="container">
    <div class="col-sm-8">

<span style="font-size:24px" class="form-back">Send Message</span>



<span style="font-size:14px" class="form-back">We recommend that you use our email templates when making, accepting or rejecting offers, to save any disagreements later on in the process of buying or selling your home.<br>We also recommend that you do nt have any other contact with your buyer or seller other than via this website or your solicitors.</span>

<form class="grey" action="" method="post" enctype="">
 <div class="col-sm-12 form-back">
<span style="font-size:14px">Email Templates<br /><a class="button btn viewfull" href="formal-offer.php"> Make formal offer</a><a class="button btn viewfull" href="accept-offer.php">Accept Formal Offer</a><a class="button btn viewfull" href="reject-offer.php">Reject Formal Offer</a></span>

			 <div class="col-xs-12 selectContainer">
        	<label>Your First Name:</label>
			<input  type="text" name="name" id="first-name" class="email-name-text form-control " placeholder="Your First Name" />
			</div>
            <div class="col-xs-12 selectContainer">
			<label for="email-content">Message:</label>
			<textarea tabindex="18" id="email-content" name="email-content"  rows="15" cols="80" class="basic-grey form-control " >Hi,</textarea>
				</div>


				<input type="submit" class="button btn  pull-right viewfull" id="submitPropertyForm" name="submitPropertyForm" value="Send Message" />

    </div>
</form>


<span style="font-size:24px" class="form-back">Message History</span>
 <div class="col-sm-12 form-back">
<table class="results-table">
	<th style="padding:5px;">Subject</th><th style="padding:5px;">Content</th>
    <tr><td style="padding:5px;">Subject goes here</td><td style="padding:5px;"><a style="color:#333333" href="#link-to-reply">Contents goes here</a></td></tr>
    <tr><td style="padding:5px;">Subject goes here</td><td style="padding:5px;"><a style="color:#333333" href="#link-to-reply">Contents goes here</a></td></tr>
    <tr><td style="padding:5px;">Subject goes here</td><td style="padding:5px;"><a style="color:#333333" href="#link-to-reply">Contents goes here</a></td></tr>
    <tr><td style="padding:5px;">Subject goes here</td><td style="padding:5px;"><a style="color:#333333" href="#link-to-reply">Contents goes here</a></td></tr>
    <tr><td style="padding:5px;">Subject goes here</td><td style="padding:5px;"><a style="color:#333333" href="#link-to-reply">Contents goes here</a></td></tr>
</table>
</div>
</div>

<div class="col-sm-3">
     <?php
include ('sidebar.php') ;
?>
</div>
</div></div>

<?php
include ('footer.php') ;
?>
