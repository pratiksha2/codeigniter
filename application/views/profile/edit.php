<style>
.info-panel .row{
	margin-bottom:5px;
}
.info-panel .row div:first-child{
	line-height:34px;
}
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
</style>
<div class="container demo">
<div class="row show-grid">
	<div class="col-md-4">
		<!-- Thumbnails -->
		<div class="thumbnail">
			<img alt="" src="<?php echo base_url();?><?php echo get_avatar($ProfileData->ProfilePic);?>">
			<div class="class-xs-12">
				
			</div>
			<?php echo form_open_multipart('profile/edit');?>
				<?php echo form_hidden('form', 'users');?>
				<?php echo form_hidden('userId', $ProfileData->id);?>
				<ul class="list-group">
					<li class="list-group-item">
						Change Avatar : 
						<span class="btn btn-default btn-file">
							Browse <input type="file" name="profilePic">
						</span>
					</li>
					<li class="list-group-item">
						First Name<?php echo form_input('FirstName', $ProfileData->FirstName ,'class="form-control"'); ?>
					</li>
					<li class="list-group-item">
						Last Name<?php echo form_input('LastName', $ProfileData->LastName ,'class="form-control"'); ?>
					</li>					
					<li class="list-group-item">
						Gender : 
						<label>
						<?php 
							$data = array( 'name' => 'Gender', 'value' => 'Male' );
							if(strtolower($ProfileData->Gender) == 'male'){$data['checked'] = TRUE;}
							echo form_radio($data);
						?>Male
						</label>
						<label>
						<?php 
							$data = array( 'name' => 'Gender', 'value' => 'Female' );
							if(strtolower($ProfileData->Gender) == 'female'){$data['checked'] = TRUE;}
							echo form_radio($data);
						?>Female
						</label>
					</li>
					<li class="list-group-item">User From <?php echo matrimony_date($ProfileData->RegistrationDate);?></li>
					<li class="list-group-item">
						Birthdate : <?php echo form_input('DOB', $profile['PersonalInfo']->DOB ,'class="form-control" id="DOB-picker"'); ?>
					</li>
					<li class="list-group-item"><?php echo form_submit('UsersSubmit', 'Save', 'id="UsersSubmit" class="btn btn-primary btn-sm"');?></li>
				</ul>
			<?php echo form_close();?>	
		</div><!-- /Thumbnails -->		
	</div>
	<div class="col-md-8 left-block">
		<div class="info-block">
			<div class="info-text info-panel">
				<h3><?php echo $ProfileData->FirstName . ' ' . $ProfileData->LastName;?></h3>
				<?php echo form_open('profile/edit');?>
					<?php echo form_hidden('form', 'PersonalInfo');?>
					<?php echo form_hidden('userId', $ProfileData->id);?>
					<div class="well">
						<div class="row">About Me : <?php echo form_textarea(array("name"=>"AboutMe","value"=>set_default($profile['PersonalInfo']->AboutMe), "class"=>"form-control", "rows"=>"3" ,"cols"=>"3")); ?></div>
						<div class="row">
							<div class="col-xs-6 col-md-4"><?php echo form_submit('PersonalInfoSubmit', 'Save', 'id="PersonalInfoSubmit" class="btn btn-primary btn-sm"');?></div>
						</div>
					</div>
				<?php echo form_close();?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Educational & Professional Information</h3>
			</div>
			<div class="panel-body info-panel">
				<?php if(count($profile['EducationInfo'])){?>
				<?php echo form_open('profile/edit');?>
					<?php echo form_hidden('form', 'EducationInfo');?>
					<?php echo form_hidden('userId', $ProfileData->id);?>
					<div class="row">
						<div class="col-xs-6 col-md-4">Education : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('Education', $this->formhtml_lib->getFieldValues('Education') , $profile['EducationInfo']->Education ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Profession : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('Profession', $this->formhtml_lib->getFieldValues('Profession') , $profile['EducationInfo']->Profession ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Annual Income : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('AnnualIncome', $this->formhtml_lib->getFieldValues('AnnualIncome') , $profile['EducationInfo']->AnnualIncome ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Family Status : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('FamilyStatus', $this->formhtml_lib->getFieldValues('FamilyStatus') , $profile['EducationInfo']->FamilyStatus ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4"><?php echo form_submit('EducationInfoSubmit', 'Save', 'id="EducationInfoSubmit" class="btn btn-primary btn-sm"');?></div>
					</div>
				<?php echo form_close();?>
				<?php } ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Location Information</h3>
			</div>
			<div class="panel-body info-panel">
				<?php if(count($profile['LocationInfo'])){?>
				<?php echo form_open('profile/edit');?>
					<?php echo form_hidden('form', 'LocationInfo');?>
					<?php echo form_hidden('userId', $ProfileData->id);?>
					<div class="row">
						<div class="col-xs-6 col-md-4">Living In : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('LivingIn', $this->formhtml_lib->getCountryList() , $profile['LocationInfo']->LivingIn ,'class="form-control" id="country"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">State : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('State', $this->formhtml_lib->getStateList($profile['LocationInfo']->LivingIn) , $profile['LocationInfo']->State ,'class="form-control" id="state"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">City : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('City', $this->formhtml_lib->getCityList($profile['LocationInfo']->State) , $profile['LocationInfo']->City ,'class="form-control" id="city"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Postal Code : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_input('PostalCode', $profile['LocationInfo']->PostalCode ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Street : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_input('Street', $profile['LocationInfo']->Street ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Born In : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('BornIn', $this->formhtml_lib->getCountryList() , $profile['LocationInfo']->BornIn ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Spend Childhood In : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('GrewUpIn', $this->formhtml_lib->getCountryList() , $profile['LocationInfo']->GrewUpIn ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Nationality : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('Nationality', $this->formhtml_lib->getNationalities() , $profile['LocationInfo']->Nationality ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Residence Type : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('ResidenceType', $this->formhtml_lib->getFieldValues('ResidenceType') , $profile['LocationInfo']->ResidenceType ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Can Relocate : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<label>
							<?php 
								$data = array( 'name' => 'CanRelocate', 'value' => 'Yes' );
								if($profile['LocationInfo']->CanRelocate == 'Yes'){$data['checked'] = TRUE;}
								echo form_radio($data);
							?>Yes
							</label>
							<label>
							<?php 
								$data = array( 'name' => 'CanRelocate', 'value' => 'No' );
								if($profile['LocationInfo']->CanRelocate == 'No'){$data['checked'] = TRUE;}
								echo form_radio($data);
							?>No
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4"><?php echo form_submit('LocationInfoSubmit', 'Save', 'id="LocationInfoSubmit" class="btn btn-primary btn-sm"');?></div>
					</div>
					<?php echo form_close();?>
				<?php } ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Family Information</h3>
			</div>
			<div class="panel-body info-panel">
				<?php if(count($profile['FamilyInfo'])){?>
					<?php echo form_open('profile/edit');?>
					<?php echo form_hidden('form', 'FamilyInfo');?>
					<?php echo form_hidden('userId', $ProfileData->id);?>
					<div class="row">
						<div class="col-xs-6 col-md-4">Live With : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('LiveWith', $this->formhtml_lib->getFieldValues('LiveWith') , $profile['FamilyInfo']->LiveWith ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Parents Live In : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('ParentsLiveIn', $this->formhtml_lib->getCountryList() , $profile['FamilyInfo']->ParentsLiveIn ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Father Alive : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<label>
							<?php 
								$data = array( 'name' => 'FatherAlive', 'value' => 'Yes' );
								if($profile['FamilyInfo']->FatherAlive == 'Yes'){$data['checked'] = TRUE;}
								echo form_radio($data);
							?>Yes
							</label>
							<label>
							<?php 
								$data = array( 'name' => 'FatherAlive', 'value' => 'No' );
								if($profile['FamilyInfo']->FatherAlive == 'No'){$data['checked'] = TRUE;}
								echo form_radio($data);
							?>No
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Mother Alive : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<label>
							<?php 
								$data = array( 'name' => 'MotherAlive', 'value' => 'Yes' );
								if($profile['FamilyInfo']->MotherAlive == 'Yes'){$data['checked'] = TRUE;}
								echo form_radio($data);
							?>Yes
							</label>
							<label>
							<?php 
								$data = array( 'name' => 'MotherAlive', 'value' => 'No' );
								if($profile['FamilyInfo']->MotherAlive == 'No'){$data['checked'] = TRUE;}
								echo form_radio($data);
							?>No
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Brothers : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('Brothers', $this->formhtml_lib->getCountCountArray(4) , $profile['FamilyInfo']->Brothers ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Married Brothers : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('MarriedBrothers', $this->formhtml_lib->getCountCountArray(4) , $profile['FamilyInfo']->MarriedBrothers ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Sisters : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('Sisters', $this->formhtml_lib->getCountCountArray(4) , $profile['FamilyInfo']->Sisters ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Married Sisters : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('MarriedSisters', $this->formhtml_lib->getCountCountArray(4) , $profile['FamilyInfo']->MarriedSisters ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4"><?php echo form_submit('FamilyInfoSubmit', 'Save', 'id="FamilyInfoSubmit" class="btn btn-primary btn-sm"');?></div>
					</div>
					<?php echo form_close();?>
				<?php } ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Religion Information</h3>
			</div>
			<div class="panel-body info-panel">
				<?php if(count($profile['ReligionInfo'])){?>
					<?php echo form_open('profile/edit');?>
					<?php echo form_hidden('form', 'ReligionInfo');?>
					<?php echo form_hidden('userId', $ProfileData->id);?>
					<div class="row">
						<div class="col-xs-6 col-md-4">Mother Tongue : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('MotherTongue', $this->formhtml_lib->getLanguages() , $profile['ReligionInfo']->MotherTongue ,'class="form-control"'); ?>
						</div>
					</div>
					<div>Culture : <?php echo set_default($profile['ReligionInfo']->Culture);?></div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Religion - Caste : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('ReligionCaste', $this->formhtml_lib->getFieldValues('ReligionCaste') , $profile['ReligionInfo']->ReligionCaste ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Manglik : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('Manglik', $this->formhtml_lib->getFieldValues('Manglik') , $profile['ReligionInfo']->Manglik ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Lifestyle : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('Lifestyle', $this->formhtml_lib->getFieldValues('Lifestyle') , $profile['ReligionInfo']->Lifestyle ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4"><?php echo form_submit('ReligionInfoSubmit', 'Save', 'id="ReligionInfoSubmit" class="btn btn-primary btn-sm"');?></div>
					</div>
					<?php echo form_close();?>
				<?php } ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Personal Information</h3>
			</div>
			<div class="panel-body info-panel">
				<?php if(count($profile['PersonalInfo'])){?>
					<?php echo form_open('profile/edit');?>
					<?php echo form_hidden('form', 'PersonalInfo');?>
					<?php echo form_hidden('userId', $ProfileData->id);?>
					<div class="row">
						<div class="col-xs-6 col-md-4">Profile Created By : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('CreatedBy', $this->formhtml_lib->getFieldValues('CreatedBy') , $profile['PersonalInfo']->CreatedBy ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Like To Marry : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('LikeToMarry', $this->formhtml_lib->getFieldValues('LikeToMarry') , $profile['PersonalInfo']->LikeToMarry ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Marital Status : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('MaritalStatus', $this->formhtml_lib->getFieldValues('MaritalStatus') , $profile['PersonalInfo']->MaritalStatus ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Date of Bitrh : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_input('DOBDate', matrimony_date(set_default($profile['PersonalInfo']->DOB)) ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Time of Bitrh : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_input('DOBDate', matrimony_time(set_default($profile['PersonalInfo']->DOB)) ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Height : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('Height', $this->formhtml_lib->getFieldValues('Height') , $profile['PersonalInfo']->Height ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Weight : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('Weight', $this->formhtml_lib->getFieldValues('Weight') , $profile['PersonalInfo']->Weight ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Body Type : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('BodyType', $this->formhtml_lib->getFieldValues('BodyType') , $profile['PersonalInfo']->BodyType ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Complexion : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('Complexion', $this->formhtml_lib->getFieldValues('Complexion') , $profile['PersonalInfo']->Complexion ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Eye Color : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('EyeColor', $this->formhtml_lib->getFieldValues('EyeColor') , $profile['PersonalInfo']->EyeColor ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Hair Color : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('HairColor', $this->formhtml_lib->getFieldValues('HairColor') , $profile['PersonalInfo']->HairColor ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Drink : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('Drink', $this->formhtml_lib->getFieldValues('Drink') , $profile['PersonalInfo']->Drink ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Smoke : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('Smoke', $this->formhtml_lib->getFieldValues('Smoke') , $profile['PersonalInfo']->Smoke ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4"><?php echo form_submit('PersonalInfoSubmit', 'Save', 'id="PersonalInfoSubmit" class="btn btn-primary btn-sm"');?></div>
					</div>
					<?php echo form_close();?>
				<?php } ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Contact Information</h3>
			</div>
			<div class="panel-body info-panel">
				<?php if(count($profile['ContactInfo'])){?>
					<?php echo form_open('profile/edit');?>
					<?php echo form_hidden('form', 'ContactInfo');?>
					<?php echo form_hidden('userId', $ProfileData->id);?>
					<div class="row">
						<div class="col-xs-6 col-md-4">Mobile : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_input('Mobile', $profile['ContactInfo']->Mobile ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Landline : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_input('Landline', $profile['ContactInfo']->Landline ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Suitable Time To Call : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('SuitableTimeToCall', $this->formhtml_lib->getFieldValues('SuitableTimeToCall') , $profile['ContactInfo']->SuitableTimeToCall ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4"><?php echo form_submit('ContactInfoSubmit', 'Save', 'id="ContactInfoSubmit" class="btn btn-primary btn-sm"');?></div>
					</div>
					<?php echo form_close();?>
				<?php } ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Partner Seeking For</h3>
			</div>
			<div class="panel-body info-panel">
				<?php if(count($profile['PartnerSeekingInfo'])){?>
					<?php echo form_open('profile/edit');?>
					<?php echo form_hidden('form', 'PartnerSeekingInfo');?>
					<?php echo form_hidden('userId', $ProfileData->id);?>
					<div class="row">
						<div class="col-xs-6 col-md-4">Age : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_input('Age', $profile['PartnerSeekingInfo']->Age ,'class="form-control" placeholder="18"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Marital Status : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('MaritalStatus', $this->formhtml_lib->getFieldValues('MaritalStatus') , $profile['PartnerSeekingInfo']->MaritalStatus ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Manglik : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('Manglik', $this->formhtml_lib->getFieldValues('Manglik') , $profile['PartnerSeekingInfo']->Manglik ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Religion - Caste : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('ReligionCaste', $this->formhtml_lib->getFieldValues('ReligionCaste') , $profile['PartnerSeekingInfo']->ReligionCaste ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Mother Tongue : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('MotherTongue', $this->formhtml_lib->getLanguages() , $profile['PartnerSeekingInfo']->MotherTongue ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Education : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('Education', $this->formhtml_lib->getFieldValues('Education') , $profile['PartnerSeekingInfo']->Education ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4">Profession : </div>
						<div class="col-xs-12 col-sm-6 col-md-8">
							<?php echo form_dropdown('Profession', $this->formhtml_lib->getFieldValues('Profession') , $profile['PartnerSeekingInfo']->Profession ,'class="form-control"'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-6 col-md-4"><?php echo form_submit('PartnerSeekingInfoSubmit', 'Save', 'id="PartnerSeekingInfoSubmit" class="btn btn-primary btn-sm"');?></div>
					</div>
					<?php echo form_close();?>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
</div>
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker.css">
<script src="<?php echo base_url();?>assets/js/bootstrap-datepicker.js"></script>
<script>
	$(document).ready(function(){
		$('.info-panel form').submit(function(){
			$.ajax({
				url 	: $(this).attr('action'),
				type 	: $(this).attr('method'),
				data	: $(this).serialize(),
				success : function(data){
					console.log(data);
				},
			});
			return false;
		});
		
		
		$('#country').change(function(){
            $.ajax({
                url: '<?php echo base_url();?>ajax/getstates/'+$(this).val(),
                dataType:'JSON',
                success:function(data){
                    $options = '<option value="">Select State</option>';
                    for(i=0; i<data.length; i++){
                        $options += '<option value="'+data[i].state+'">'+data[i].state+'</option>';
                    }
					alert($options);
                    $('#state').html($options);
                }
            });
        });
        $('#state').change(function(){
            $.ajax({
                url: '<?php echo base_url();?>ajax/getcities/'+$(this).val(),
                dataType:'JSON',
                success:function(data){
                    $options = '<option value="">Select City</option>';
                    for(i=0; i<data.length; i++){
                        $options += '<option value="'+data[i].city+'">'+data[i].city+'</option>';
                    }
                    $('#city').html($options);
                }
            });
        });
		
		$('#DOB-picker').datepicker({
			format: "yyyy/mm/dd",
			endDate: "-18y",
			autoclose: true
		});
		
	});
</script>