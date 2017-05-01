<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $page_title; ?></title>
<link rel="stylesheet" href="includes/style.css">
 <link rel="stylesheet" href="css/templatemo_style.css">
 <link rel="stylesheet" href="css/testimonails-slider.css">
<script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
<link rel="stylesheet" href="includes/image-slider.css">
<link href="styles.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/thumbslide.css" />
<link rel="stylesheet" href="css/bootstrap.css">
<link href='http://fonts.googleapis.com/css?family=Dosis|Open+Sans' rel='stylesheet' type='text/css' />
<!-- CSS3 Animation -->
<link rel="stylesheet" href="includes/animate-custom.css" type="text/css" />
<!-- Tabion CSS Pack -->
<link rel="stylesheet" href="includes/tabion-css.css" type="text/css" />
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
<link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="header">
<div id="headermiddle">




<div id="headermiddlepics">
 
<a href="https://www.facebook.com/pages/Property-Wing/707165226009503?fref=nf" alt="facebook page" title="facebook" style="border-style;none;"><img src="images/facebook-logo.png" style="padding-right:20px;"/></a>
<img src="images/twitter-logo.png" style="padding-right:20px;"/>
<img src="images/google-logo.png" style="padding-right:20px;"/>
</div>

<div id="headlinks">

<p style="color:white;"><a href="index.php" style="text-decoration:none;">Home</a> - <a href="" style="text-decoration:none;">Sign In</a> - <a href="" style="text-decoration:none;">Add your property</a></p>

	

				

</div>




</div>




</div>

<?php include 'loginhead.php'; ?>

<div class="main-header">

	<div class="heading">
	<div id="background" >
	<body id="body">
	<div id="main" class="heder-main">
	<div id="logo"><a href="index.php"><img src="images/propertywing2.png"/></a></div>
	<div id="headlinks-lower"></div>
	<div style="float:right; background-color:white; margin-top:-135px; margin-right:30px;">
	</div>



		
		
	  

		   <td width="732" valign="top">
		  
			<div style="margin-top:50px;">
			
	  
	  
	  
	  
	 </div>
	 
		</div> </div>
		<a class="toggle-nav" href="#"><form class="search-form media-screen">
        <input type="text">
        <button>Search</button>
    </form>&#9776;
		</a>
		
		
		<!----- navigation----->
	<div class="navigation">
        <div class="nav menu">
		<nav class="menu">
		<ul class="active">
		
		<li class="current-item"><a href="add-property.php">Add a property </a></li>
		<li><a href="mysettings.php">Solicitor Quote </a></li>
		<li><a href="mysettings.php">Mortgage Calculator </a></li>
		<li><a href="mysettings.php">For sale boards </a></li>
		<li><a href="mysettings.php">Sold prices </a></li>
		<li><a href="login.php">Login/Register</a></li>
		<form class="search-form media-screen-1">
        <input type="text">
        <button>Search</button>
    </form>
		
	  </ul>
	  
		
	  </nav>
		</div>
	</div>	

<!----- End navigation----->  

 <?php if(($_SERVER['REQUEST_URI'] == '/login2/index.php') || ($_SERVER['REQUEST_URI'] == '/login2') || ($_SERVER['REQUEST_URI'] == '/login2/'))  : ?>

<div id="slider">
                <div class="flexslider">
                  <ul class="slides">
                    <li>
                      <img src="images/slide1.jpg" alt="" />
                    </li>
                    <li>
                      <img src="images/slide2.jpg" alt="" />
                    </li>
                    <li>
                      <img src="images/slide3.jpg" alt="" />
                    </li>
                  </ul>
                </div>
            </div>

     <script src="js/vendor/jquery-1.11.0.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
	  
		  <?php	
		  if (isset($_GET['msg'])) {
		  echo "<div class=\"error\">$_GET[msg]</div>";
		  }
			  
		  ?>
		  

		  </div>
</div>

<?php endif; ?>
  


 
	  
<div id="main">
<div id="background" style="margin-top:18%;">
