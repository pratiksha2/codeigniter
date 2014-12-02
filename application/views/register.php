<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Registration</title>
	<link href="<?php //echo base_url();?>/CodeIgniter/assets/css/bootstrap.css" rel="stylesheet">
	<link href="<?php //echo base_url();?>/CodeIgniter/assets/css/bootstrap-theme.min.css" rel="stylesheet">
	<script src="<?php //echo base_url();?>/CodeIgniter/assets/js/bootstrap.min.js"></script>
	<style>
		body {
			padding-top: 40px;
		}

		.form-signup, .form-signin {
			width: 400px;
			margin: 0 auto;
		}
	</style>
  </head>
 
  <body>
	  <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav"> 
                     <li>Register</li>  
                     <li>Login</li>  
                     <li>Logout</li>
                </ul> 
            </div>
        </div>
      </div>
	  
     
     
         <h2 class="form-signup-heading">Register</h2>

         <ul>
             <li>error</li>
         </ul>
         
         <form class="form-signup">
            <input type="text" name="firstName" class="input-block-level" placeholder="First Name">
            <input type="text" name="lastname" class="input-block-level" placeholder="Last Name">
            <input type="text" name="email" class="input-block-level" placeholder="Email">
            <input type="password" name="password" class="input-block-level" placeholder="Password">
            <input type="password" name="password_confirmation" class="input-block-level" placeholder="Re-type Password">
            <input type="submit" name="register" class="btn btn-large btn-primary btn-block" value="Register">
         </form>   
         
     
     
  </body>
</html>