<div class="container demo">
<div class="row show-grid">
	<div class="col-md-4">
		<!-- Thumbnails -->
		<div class="thumbnail">
			<img alt="" src="<?php echo base_url();?>assets/img/defaultAvatars.png">
			<ul class="list-group">
				<li class="list-group-item">Gender : <?php echo $ProfileData->Gender;?></li>
				<li class="list-group-item">User From <?php echo matrimony_date($ProfileData->RegistrationDate);?></li>
				<li class="list-group-item">Birthdate : <?php echo matrimony_date($profile['PersonalInfo']->DOB);?></li>
				<li class="list-group-item">Setings</li>
			</ul>
		</div><!-- /Thumbnails -->		
	</div>
	<div class="col-md-8 left-block">
		<div class="info-block">
			<div class="info-text">
				<h3><?php echo $ProfileData->FirstName . ' ' . $ProfileData->LastName;?></h3>
				<div class="well">About Me : <?php echo set_default($profile['PersonalInfo']->AboutMe);?></div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Educational & Professional Information</h3>
			</div>
			<div class="panel-body">
				<?php if(count($profile['EducationInfo'])){?>
					<?php if(!($profile['EducationInfo']->hide)){?>
					<div>Education : <?php echo set_default($profile['EducationInfo']->Education);?></div>
					<div>Profession : <?php echo set_default($profile['EducationInfo']->Profession);?></div>
					<div>Annual Income : <?php echo set_default($profile['EducationInfo']->AnnualIncome);?></div>
					<div>Family Status : <?php echo set_default($profile['EducationInfo']->FamilyStatus);?></div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Location Information</h3>
			</div>
			<div class="panel-body">
				<?php if(count($profile['LocationInfo'])){?>
					<?php if(!($profile['LocationInfo']->hide)){?>
					<div>Living In : <?php echo set_default($profile['LocationInfo']->LivingIn);?></div>
					<div>State : <?php echo set_default($profile['LocationInfo']->State);?></div>
					<div>City : <?php echo set_default($profile['LocationInfo']->City);?></div>
					<div>PostalCode : <?php echo set_default($profile['LocationInfo']->PostalCode);?></div>
					<div>Street : <?php echo set_default($profile['LocationInfo']->Street);?></div>
					<div>Born In : <?php echo set_default($profile['LocationInfo']->BornIn);?></div>
					<div>Spend Childhood In : <?php echo set_default($profile['LocationInfo']->GrewUpIn);?></div>
					<div>Nationality : <?php echo set_default($profile['LocationInfo']->Nationality);?></div>
					<div>Residence Type : <?php echo set_default($profile['LocationInfo']->ResidenceType);?></div>
					<div>Can Relocate : <?php echo set_default($profile['LocationInfo']->CanRelocate);?></div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Family Information</h3>
			</div>
			<div class="panel-body">
				<?php if(count($profile['FamilyInfo'])){?>
					<?php if(!($profile['FamilyInfo']->hide)){?>
					<div>Live With : <?php echo set_default($profile['FamilyInfo']->LiveWith);?></div>
					<div>Parents Live In : <?php echo set_default($profile['FamilyInfo']->ParentsLiveIn);?></div>
					<div>Father Alive : <?php echo set_default($profile['FamilyInfo']->FatherAlive);?></div>
					<div>Mother Alive : <?php echo set_default($profile['FamilyInfo']->MotherAlive);?></div>
					<div>Brothers : <?php echo set_default($profile['FamilyInfo']->Brothers);?></div>
					<div>Married Brothers : <?php echo set_default($profile['FamilyInfo']->MarriedBrothers);?></div>
					<div>Sisters : <?php echo set_default($profile['FamilyInfo']->Sisters);?></div>
					<div>Married Sisters : <?php echo set_default($profile['FamilyInfo']->MarriedSisters);?></div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Religion Information</h3>
			</div>
			<div class="panel-body">
				<?php if(count($profile['ReligionInfo'])){?>
					<?php if(!($profile['ReligionInfo']->hide)){?>
					<div>Mother Tongue : <?php echo set_default($profile['ReligionInfo']->MotherTongue);?></div>
					<div>Culture : <?php echo set_default($profile['ReligionInfo']->Culture);?></div>
					<div>Religion - Caste : <?php echo set_default($profile['ReligionInfo']->ReligionCaste);?></div>
					<div>Manglik : <?php echo set_default($profile['ReligionInfo']->Manglik);?></div>
					<div>Lifestyle : <?php echo set_default($profile['ReligionInfo']->Lifestyle);?></div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Personal Information</h3>
			</div>
			<div class="panel-body">
				<?php if(count($profile['PersonalInfo'])){?>
					<?php if(!($profile['PersonalInfo']->hide)){?>
					<div>Profile Created By : <?php echo set_default($profile['PersonalInfo']->CreatedBy);?></div>
					<div>Like To Marry : <?php echo set_default($profile['PersonalInfo']->LikeToMarry);?></div>
					<div>Marital Status : <?php echo set_default($profile['PersonalInfo']->MaritalStatus);?></div>
					<div>Date of Bitrh : <?php echo matrimony_date(set_default($profile['PersonalInfo']->DOB));?></div>
					<div>Time of Bitrh : <?php echo matrimony_time(set_default($profile['PersonalInfo']->DOB));?></div>
					<div>Height : <?php echo set_default($profile['PersonalInfo']->Height);?> (in centimeters)</div>
					<div>Weight : <?php echo set_default($profile['PersonalInfo']->Weight);?> (in kilograms)</div>
					<div>Body Type : <?php echo set_default($profile['PersonalInfo']->BodyType);?></div>
					<div>Complexion : <?php echo set_default($profile['PersonalInfo']->Complexion);?></div>
					<div>Eye Color : <?php echo set_default($profile['PersonalInfo']->EyeColor);?></div>
					<div>Hair Color : <?php echo set_default($profile['PersonalInfo']->HairColor);?></div>
					<div>Drink : <?php echo set_default($profile['PersonalInfo']->Drink);?></div>
					<div>Smoke : <?php echo set_default($profile['PersonalInfo']->Smoke);?></div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Contact Information</h3>
			</div>
			<div class="panel-body">
				<?php if(count($profile['ContactInfo'])){?>
					<?php if(!($profile['ContactInfo']->hide)){?>
					<div>Mobile : <?php echo set_default($profile['ContactInfo']->Mobile);?></div>
					<div>Landline : <?php echo set_default($profile['ContactInfo']->Landline);?></div>
					<div>Suitable Time To Call : <?php echo set_default($profile['ContactInfo']->SuitableTimeToCall);?></div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
</div>