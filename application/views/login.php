<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
   
	<title>Login</title>
   
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
   
   <?php /*----Load Bootstrap Framework-----*/  ?>
   <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
   <link href="<?php echo base_url();?>assets/css/bootstrap-theme.min.css" rel="stylesheet">
   <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<?php /*----Load Bootstrap Framework-----*/  ?>
   
   <style>
      body {
         padding-top: 40px;
         padding-bottom: 40px;
         background-color: #eee;
      }
      .form-signin {
         max-width: 330px;
         padding: 15px;
         margin: 0 auto;
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
         margin-bottom: 10px;
      }
      .form-signin .checkbox {
         font-weight: normal;
      }
      .form-signin .form-control {
         position: relative;
         height: auto;
         -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
         box-sizing: border-box;
         padding: 10px;
         font-size: 16px;
      }
      .form-signin .form-control:focus {
         z-index: 2;
      }
      .form-signin input[type="email"] {
         margin-bottom: -1px;
         border-bottom-right-radius: 0;
         border-bottom-left-radius: 0;
      }
      .form-signin input[type="password"] {
         margin-bottom: 10px;
         border-top-left-radius: 0;
         border-top-right-radius: 0;
      }

   </style>
</head>
<body>

   
    <div class="container">
	<?php if(isset($error)){ ?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<?php echo $error;?>
		</div>
	<?php }	?>
	<?php
		$attributes = array('class' => 'form-signin', 'role' => 'form');
		echo form_open(base_url().'login/verify', $attributes);
	?>
		<h2 class="form-signin-heading">Please sign in</h2>
		<?php
			$attributes = array(
									'class' => 'sr-only',
								);
			echo form_label('Email address', 'inputEmail', $attributes);
			$data = array(
						  'name'        => 'login',
						  'id'          => 'inputLogin',
						  'class'       => 'form-control',
						  'placeholder' => 'Login ID or Email address',
						  'required'    => '',
						  'autofocus'   => '',
						  'type'   		=> 'text',
						  'value'		=>  set_value('login', ''),
						);
			echo form_input($data);
			
			$attributes = array(
									'class' => 'sr-only',
								);
			echo form_label('Password', 'inputPassword', $attributes);
			$data = array(
						  'name'        => 'password',
						  'id'          => 'inputPassword',
						  'class'       => 'form-control',
						  'placeholder' => 'Password',
						  'required'    => '',
						  'type'   		=> 'password',
						);
			echo form_input($data);
			
			$data = array(
						  'id'          => 'inputSubmit',
						  'class'       => 'btn btn-lg btn-primary btn-block',
						  'value'		=> 'Sign in',
						  'name'    	=> 'submit',
						  'type'   		=> 'submit',
						);
			echo form_submit($data);
			
			echo form_close();
		?>

    </div> 


   
</body>
</html>