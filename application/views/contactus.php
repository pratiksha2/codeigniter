 <?php 
		echo validation_errors('<p class="alert alert-danger alert-dismissible" role="alert">
<button class="close" data-dismiss="alert" type="button">
<span aria-hidden="true">×</span>
<span class="sr-only">Close</span>
</button>');
		$name = array('id' => 'name','name' => 'name','value'=>'', 'class' => 'form-control');
		$email = array('id' => 'email','name' => 'email','value'=>'', 'class' => 'form-control');
		$mob = array('id' => 'mob','name' => 'mob','value'=>'', 'class' => 'form-control');
		$query = array('id' => 'query', 'name' => 'query','value'=>'', 'class' => 'form-control');
 ?>
<div class="container">
	<div id="contactus" class="col-xs-12 col-sm-10 col-md-10">
		<?php echo form_open("user/contact_thank"); ?>		
		
		<div class="row">
			<div class="col-xs-2"><?php echo form_label('Name:','name');?></div>
			<div class="col-xs-10"><?php echo form_input($name); ?></div>
		</div>
		<div class="row">
			<div class="col-xs-2"><?php echo form_label('Email:','email');?></div>
			<div class="col-xs-10"><?php echo form_input($email); ?></div>
		</div>
		<div class="row">
			<div class="col-xs-2"><?php echo form_label('MOB No:','mob');?></div>
			<div class="col-xs-10"><?php echo form_input($mob); ?></div>
		</div>
		<div class="row">
			<div class="col-xs-2"><?php echo form_label('Query:','query');?></div>
			<div class="col-xs-10"><?php echo form_textarea($query); ?></div>
		</div>
		<div class="row">
			<?php echo form_submit('searchSubmit', 'Save', 'id="searchSubmit" class="btn btn-primary btn-lg col-xs-12"');?>
		</div>
		<?php echo form_close();?>
	</div>
	
	
</div>