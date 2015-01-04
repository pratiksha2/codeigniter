<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
   <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="<?php echo base_url();?>">Brand</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav">
			<li><a href="<?php echo base_url();?>">Home</a></li>
            <li><a href="<?php echo base_url();?>search/suggestions">Suggestions</a></li>
			<li><a href="<?php echo base_url();?>search">Search</a></li>
			<?php if(isset($my)){?>
			<li><a href="<?php echo base_url();?>profile"><?php echo $my->FirstName;?></a></li>
			<li><a href="<?php echo base_url();?>shortlist">My Shortlist</a></li>
			<?php } ?>
         </ul>
         <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Help<span class="caret"></span></a>
               <ul class="dropdown-menu" role="menu">
                  <li><a href="<?php echo base_url();?>user/contactus">Contact Us</a></li>
                  <li><a href="<?php echo base_url();?>user/terms">Terms & Conditions</a></li>
                  <li class="divider"></li>
                  <li><a href="<?php echo base_url();?>user/faqs">FAQs</a></li>
                  <li><a href="<?php echo base_url();?>user/aboutus">About Us</a></li>                  
               </ul>
            </li>
            <?php if(isset($my)){?>
			<li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">My Profile<span class="caret"></span></a>
               <ul class="dropdown-menu" role="menu">
                  <li><a href="<?php echo base_url();?>profile"><?php echo $my->FirstName;?></a></li>
                  <li><a href="<?php echo base_url();?>profile/edit">Edit Profile</a></li>
                  <li class="divider"></li>
                  <li><a href="<?php echo base_url();?>logout">Log Out</a></li>
               </ul>
            </li>
			<?php }else{?>
			<li><a href="<?php echo base_url();?>register">Register</a></li>
			<li><a href="<?php echo base_url();?>login">Login</a></li>
			<?php } ?>
         </ul>
      </div><!-- /.navbar-collapse -->
   </div><!-- /.container-fluid -->
</nav>