<div class="container">
		
		 <?php echo form_open("user/doforget");
				$email = array('id' => 'email','name' => 'email','value'=>'', 'class' => 'form-control');
		 
		 ?>
			<fieldset>
	          <legend>Reset password</legend>
			
				<div class="control-group">
					<?php echo form_label('Email:','email');
						  echo form_input($email);
					?>
				</div>
				<div class="form-actions">
					<?php  echo form_submit('submit', 'Submit',"class='btn btn-lg btn-primary btn-block'") ?>
				</div>
				<?php if( isset($info)): ?>
					<div class="alert alert-success">
						<?php echo($info) ?>
					</div>
				<?php elseif( isset($error)): ?>
					<div class="alert alert-error">
						<?php echo($error) ?>
					</div>
				<?php endif; ?>
				
			</fieldset>
		</form>
	</div> 