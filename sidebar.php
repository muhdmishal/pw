<?php require_once './getmessages.php'; ?>
 <div class=" form-back"> <span style="font-size:24px">Our Features</span> 
 <div class="row">
        <a class=" btn viewfull" style="width:100% !important;  padding-left:0 !important; padding-right:0 !important"  href="myaccount.php">View My Properties </a> 
  </div>
   <div class="row">
        <a class=" btn viewfull" style="width:100% !important;  padding-left:0 !important; padding-right:0 !important"  href="add-property.php">Add Property</a> 
   </div>
         <div class="row">
        <a class=" btn viewfull" style="width:100% !important;  padding-left:0 !important; padding-right:0 !important"  href="messages.php">Inbox <span class="badge" style="background-color:#993300"><?php echo getMessagesCount(); ?></span></a> 
        </div>
        <div class="row">
        <a class=" btn viewfull" style="width:100% !important;  padding-left:0 !important; padding-right:0 !important"  href="sale-board.php">Order for Sale Board</a> 
        </div>
        <div class="row">
        <a class=" btn viewfull" style="width:100% !important;  padding-left:0 !important; padding-right:0 !important"  href="facebook-advert.php">Boost Advert on Facebook</a> 
        </div>
        <div class="row">
        
        <a class=" btn viewfull" style="width:100% !important;  padding-left:0 !important; padding-right:0 !important"  href="#">Ask us for Help</a> <br />
        </div>
        <div class="row">
        
          <h2 >My Account</h2>
          <div class="footer-icon"> <a href="#" class="footicon-text" style="color:#666666 !important"><span class="ft-icon"><img src="images/user-ico.png" alt="map" /></span><strong>My Account Settings</strong></a> </div>
          <div class="footer-icon"> <a href="logout.php" class="footicon-text" style="color:#666666 !important"><span class="ft-icon"><img src="images/log.png" alt="cell" /></span><strong>Log Out</strong></a> </div>
        </div>
      </div>