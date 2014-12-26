<style>
	#search-box .row{
		margin-bottom:15px;
	}
</style>
<div class="container">
	<div id="search-box" class="col-xs-12 col-sm-10 col-md-10">
		<?php $attributes = array('method' => 'get');?>
		<?php echo form_open('search/results',$attributes);?>
		<div class="row">
			<div class="col-xs-2"><?php echo form_label('Looking for');?></div>
			<div class="col-xs-10">
				<label>
				<?php 
					$data = array( 'name' => 'gender', 'value' => 'Male' );
					echo form_radio($data);
				?>Groom
				</label>
				<label>
				<?php 
					$data = array( 'name' => 'gender', 'value' => 'Female' );
					echo form_radio($data);
				?>Bride
				</label>
			</div>
		</div>		
		<div class="row">
			<div class="col-xs-2"><?php echo form_label('Age', 'ageFrom');?></div>
			<div class="col-xs-10">
				<div class="col-xs-2">
					<?php echo form_input('ageFrom', '18' ,'class="form-control" id="ageFrom" placeholder="18"'); ?>
				</div>
				<div class="col-xs-1">
					<?php echo form_label('to', 'ageTo');?>
				</div>
				<div class="col-xs-2">
					<?php echo form_input('ageTo', '40' ,'class="form-control" id="ageTo" placeholder="40"'); ?>
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-xs-2"><?php echo form_label('Height', 'heightFrom');?></div>
			<div class="col-xs-10">
				<div class="col-xs-4">
					<?php echo form_dropdown('heightFrom', $this->formhtml_lib->getFieldValues('Height') , '' ,'class="form-control" id="heightFrom"'); ?>
				</div>
				<div class="col-xs-1">
					<?php echo form_label('to', 'heightTo');?>
				</div>
				<div class="col-xs-4">
					<?php echo form_dropdown('heightTo', $this->formhtml_lib->getFieldValues('Height') , '' ,'class="form-control" id="heightTo"'); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-2"><?php echo form_label('Marital Status');?></div>
			<div class="col-xs-10">
				<?php echo form_label(form_checkbox('MaritalStatus[]','Single').'Single');?>
				<?php echo form_label(form_checkbox('MaritalStatus[]','Divorced').'Divorced');?>
				<?php echo form_label(form_checkbox('MaritalStatus[]','Widowed').'Widowed');?>
				<?php echo form_label(form_checkbox('MaritalStatus[]','Separated').'Separated');?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-2"><?php echo form_label('Religion - Caste', 'ReligionCaste');?></div>
			<div class="col-xs-10"><?php echo form_dropdown('ReligionCaste', $this->formhtml_lib->getFieldValues('ReligionCaste') , '' ,'class="form-control" id="ReligionCaste"'); ?></div>
		</div>
		<div class="row">
			<div class="col-xs-2"><?php echo form_label('Mother Tongue', 'MotherTongue');?></div>
			<div class="col-xs-10"><?php echo form_dropdown('MotherTongue', $this->formhtml_lib->getLanguages() , 'Hindi' ,'class="form-control" id="MotherTongue"'); ?></div>
		</div>
		<div class="row">
			<div class="col-xs-2"><?php echo form_label('Country', 'LivingIn');?></div>
			<div class="col-xs-10"><?php echo form_dropdown('LivingIn', $this->formhtml_lib->getCountryList() , 'India' ,'class="form-control" id="LivingIn"'); ?></div>
		</div>
		<div class="row">
			<div class="col-xs-2"><?php echo form_label('Education', 'Education');?></div>
			<div class="col-xs-10"><?php echo form_dropdown('Education', $this->formhtml_lib->getFieldValues('Education') , '' ,'class="form-control" id="Education"'); ?></div>
		</div>
		<div class="row">
			<?php echo form_submit('searchSubmit', 'Save', 'id="searchSubmit" class="btn btn-primary btn-lg col-xs-12"');?>
		</div>
		<?php echo form_close();?>
	</div>
	
	
</div>