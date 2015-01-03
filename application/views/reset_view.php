<div class="container">
		
		 <?php echo validation_errors('<p class="alert alert-danger alert-dismissible" role="alert">
<button class="close" data-dismiss="alert" type="button">
<span aria-hidden="true">×</span>
<span class="sr-only">Close</span>
</button>');
		 echo form_open("user/newPassword");
				$newpassword = array('id' => 'newpassword','name' => 'newpassword','value'=>'', 'class' => 'form-control');
				$confirmpassword = array('id' => 'confirmpassword','name' => 'confirmpassword','value'=>'', 'class' => 'form-control');
		 ?>
			<fieldset>
	          <legend>Reset password</legend>
			
				<div class="control-group">
					<?php echo form_label('New Password:','newpassword');
						  echo form_password($newpassword);
						  echo form_hidden('resetCode',$this->uri->segment(3))
					?>
				</div>
				<div class="control-group">
					<?php echo form_label('Confirm Password:','confirmpassword');
						  echo form_password($confirmpassword);
					?>
				</div>
				<div class="form-actions">
					<?php  echo form_submit('submit', 'Submit',"class='btn btn-lg btn-primary btn-block'") ?>
				</div>
				
			</fieldset>
		</form>
	</div> 