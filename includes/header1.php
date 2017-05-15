<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<title>PropertyWing : The best place to advertise your property</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link href="css/all.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.js"></script>

  <link rel="stylesheet" href="css/demo.css">

<link rel="icon" type="image/png"  href="images/favicon.png" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content=""/>
<meta name="keywords" content="" />
<meta name="language" content="english" />
<META http-equiv="Pragma" content="no-cache">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript" src="javascript/thumbslide.js">


// Thumbnail Slider- by JavaScript Kit (www.javascriptkit.com)
// Visit JavaScript Kit at http://www.javascriptkit.com/ for full source code
</script>
<!--image slider-->
<script>
//Initialization code:
$(document).ready(function(){ // on document load

		$("#thumbsliderdiv").imageSlider({ //initialize slider
			'thumbs': ["property-images/kitchen-lf.JPG","property-images/bedroom-lf.JPG","property-images/bathroom-lf.JPG","property-images/lounge-lf.JPG","property-images/rear-garden-lf.JPG"], // file names of images within slider. Default path should be changed inside thumbslide.js (near bottom)
			'auto_scroll':true,
			'auto_scroll_speed':4500,
			'stop_after': 2, //stop after x cycles? Set to 0 to disable.
			'canvas_width':530,
			'canvas_height':333 // <-- No comma after last option
			})
	});

</script>
<!--End of Image Slider-->
<link href="css/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="javascript/tabcontent.js" type="text/javascript"></script></script>

 <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script>
$(document).ready(function() {
    $('.toggle-nav').click(function(e) {
        $(this).toggleClass('active');
        $('.menu ul').toggleClass('active');

        e.preventDefault();
    });
});
</script>

<script language="JavaScript" type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/jquery.validate.js"></script>
<script>
  $(document).ready(function(){
    $("#myform").validate();
	 $("#pform").validate();
  });
</script>
<style media="screen">
  .navbar-default {
    background: none;
    border: none;
  }
</style>
<!--<link href="styles.css" rel="stylesheet" type="text/css">-->
</head>
<body>
<div class="col-xs-12 top-bg">
	<div class="container">

         <div style="float:left ;" >
                    <ul class="list-inline">
                            <li class="fb">
                                <a style="color:#FFFFFF;" href="https://www.facebook.com/pages/Property-Wing/707165226009503?ref=hl" class="btn-social btn-outline social-clor"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li class="google">
                                <a style="color:#FFFFFF;" href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li class="tweet">
                                <a style="color:#FFFFFF;" href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                           <!-- <li class="insta">
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-instagram"></i></a>
                            </li>-->
                        </ul>
                 </div>



        <div style="float:right;">





                 <a href="login.php" class="top-icon colr"><span class="lang-icon"><img src="images/user-ico.png" alt="User" /></span>Log in/Register</a>
                            </div>
     </div>
</div>


<div class="container">
<a class="logo" href="index.php"><img src="images/logo.png" alt="logo"/></a>

     <nav class="navbar navbar-default  menu">
            <div class="container-fluid">

              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>

              </div>
              <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="index.php">Home</a></li>
                  <li><a href="add-property.php">Add a property</a></li>
                  <li><a href="myaccount.php">My Account</a></li>
                  <li><a href="messages.php">Inbox</a></li>
                  <li><a href="mysettings.php">Services</a></li>
                  <li><a href="sale-board.php">For sale boards</a></li>
                  <li><a href="continuesearch.php">Search</a></li>


                </ul>
              </div><!--/.nav-collapse -->
            </div><!--/.container-fluid -->
          </nav>
</div>
