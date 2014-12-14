<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
            // When the document is ready
            jQuery(document).ready(function () {

                jQuery('#dob').datepicker({
                    format: "dd/mm/yyyy"
                });  

            });
        </script>
<style>
body {
	background: url('<?php echo base_url();?>/assets/pics/Destination-Wedding-Photographer-Udaipur-Oberi-Udaivillas-India-49(pp_w892_h594).jpg') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
  	background-color:#333;
  	font-family: 'Open Sans',Arial,Helvetica,Sans-Serif;
	background-position:calc(100% - 10px) 0;
}
.nopadding { 
    padding-left: 0 !important;
    padding-right: 0 !important;
}
.col-sm-12 {
	padding-top:1%;
}
.drop-shadow {
    -webkit-box-shadow: 0 0 5px 2px rgba(0, 0, 0, .5);
    box-shadow: 0 0 5px 2px rgba(0, 0, 0, .5);
    border-radius:5px;
	background-color: #fff;
    border-radius: 19px;
    padding: 2%;
}
.error {
	color:red;
}
</style>
<div class="container">
<div class="col-xs-5 drop-shadow">
<div class="form_title">Sign Up</div>
<div class="form_sub_title">It's free and anyone can join</div>
 <?php echo validation_errors('<p class="error">'); ?>
 <?php echo form_open("user/thank"); 
		$fname = array('id' => 'fname','name' => 'fname','value'=>'', 'class' => 'form-control');
		$loginId = array('id' => 'loginId','name' => 'loginId','value'=>'', 'class' => 'form-control');
		$lname = array('id' => 'lname','name' => 'lname','value'=>'', 'class' => 'form-control');
		$email = array('id' => 'email','name' => 'email','value'=>'', 'class' => 'form-control');
		$dob = array('id' => 'dob','name' => 'dob','value'=>'', 'class' => 'form-control');
		$gender = array('id' => 'gender_id', 'name' => 'gender');
		$pswrd = array('id' => 'password','name' => 'password','value'=>'', 'class' => 'form-control');
		$cpswrd = array('id' => 'cpassword','name' => 'cpassword','value'=>'', 'class' => 'form-control');
		$terms = array(
			'name'        => 'terms',
			'id'          => 'terms',
			'value'       => '',
		);
		$attributes = array(
			'class' => 'col-xs-3 nopadding',
			//'style' => 'color: #000;',
		);
		$dobcss = array(
			'class' => 'col-xs-4 nopadding'
		);
		echo "<div class='col-sm-12'>".form_label('First Name:','fname',$attributes);
		echo "<div class='col-xs-9 nopadding'>".form_input($fname)."</div></div>";
		echo "<div class='col-sm-12'>".form_label('Last Name:','lname',$attributes);
		echo "<div class='col-xs-9 nopadding'>".form_input($lname)."</div></div>";
		echo "<div class='col-sm-12'>".form_label('Email:','email',$attributes);
		echo "<div class='col-xs-9 nopadding'>".form_input($email)."</div></div>";
		echo "<div class='col-sm-12'>".form_label('Login ID:','loginId',$attributes);
		echo "<div class='col-xs-9 nopadding'>".form_input($loginId)."</div></div>";
		echo "<div class='col-sm-12'>".form_label('Password:','password',$attributes);
		echo "<div class='col-xs-9 nopadding'>".form_password($pswrd)."</div></div>";
		echo "<div class='col-sm-12'>".form_label('Confirm Password:','cpassword',$attributes);
		echo "<div class='col-xs-9 nopadding'>".form_password($cpswrd)."</div></div>";
		echo "<div class='col-sm-12'>".form_label('Date of Birth','dob',$dobcss);
		echo "<div class='col-xs-5 nopadding'>".form_input($dob)."</div></div>";
		echo "<div class='col-sm-12'>".form_label('Gender:','gender',$attributes);
		echo "<div class='col-sm-9'>".form_radio($gender,'female');
		echo '<strong><span for="female" class="">female:</span></strong>';
		echo form_radio($gender,'male');
		echo '<strong><span for="male">male:</span></strong></div></div>';
		
		echo "<div class='col-sm-8 col-sm-offset-2'>".form_submit('submit', 'Submit',"class='btn btn-lg btn-primary btn-block'")."</div>";
 ?>
 <?php echo form_close(); ?>
</div>
 </div><!--<div class="reg_form">-->
