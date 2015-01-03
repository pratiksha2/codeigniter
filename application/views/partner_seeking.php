<link rel="stylesheet" type="text/css" href="http://localhost/matri/css/bootstrap.min.css" />
<div class="container">
<div class="drop-shadow">
 <?php echo validation_errors('<p class="alert alert-danger alert-dismissible" role="alert">
<button class="close" data-dismiss="alert" type="button">
<span aria-hidden="true">×</span>
<span class="sr-only">Close</span>
</button>'); ?>
 <?php echo form_open("user/partner"); 
		$ageto = array('id' => 'ageto','name' => 'ageto','value'=>'', 'class' => 'form-control');
		$agefrom = array('id' => 'agefrom','name' => 'agefrom','value'=>'', 'class' => 'form-control');
		$manglik = array('id' => 'manglik', 'name' => 'manglik');
		$options = array(
                  'single'  => 'Single',
                  'divorced'    => 'Divorced',
                  'widowed'   => 'Widowed',
                  'seperated' => 'Seperated',
                );
		
		$attributes = array(
			'class' => 'col-xs-3 nopadding',
			//'style' => 'color: #000;',
		);

		echo "<div class='col-sm-12'>".form_label('Age to:','ageto',$attributes);
		echo "<div class='col-xs-9 nopadding'>".form_input($ageto)."</div></div>";
		echo "<div class='col-sm-12'>".form_label('Age from:','agefrom',$attributes);
		echo "<div class='col-xs-9 nopadding'>".form_input($agefrom)."</div></div>";
		echo "<div class='col-sm-12'>".form_label('Marital Status:','maritalstatus',$attributes);
		echo "<div class='col-xs-9 nopadding'>".form_dropdown('maritalstatus', $options, 'large','class="form-control" id="maritalstatus"')."</div></div>";
		echo "<div class='col-sm-12'>".form_label('Manglik:','manglik',$attributes);
		echo "<div class='col-sm-9'>".form_radio($manglik,'1');
		echo '<strong><span for="1" class="">Yes:</span></strong>';
		echo form_radio($manglik,'0');
		echo '<strong><span for="0">No:</span></strong></div></div>';
		echo "<div class='col-sm-12'>".form_label('Religion / Caste:','religion',$attributes);
		echo "<div class='col-xs-9 nopadding'>".form_dropdown('religion', $religion, 'large','class="form-control" id="religion"')."</div></div>";
		echo "<div class='col-sm-12'>".form_label('Mother Tongue:','mothertongue',$attributes);
		echo "<div class='col-xs-9 nopadding'>".form_dropdown('language', $language, 'large','class="form-control" id="language"')."</div></div>";
		echo "<div class='col-sm-12'>".form_label('Education:','education',$attributes);
		echo "<div class='col-xs-9 nopadding'>".form_dropdown('education', $education, 'large','class="form-control" id="language"')."</div></div>";
		echo "<div class='col-sm-12'>".form_label('Profession:','profession',$attributes);
		echo "<div class='col-xs-9 nopadding'>".form_dropdown('profession', $profession, 'large','class="form-control" id="language"')."</div></div>";		
		echo "<div class='col-sm-8 col-sm-offset-2'>".form_submit('submit', 'Submit',"class='btn btn-lg btn-primary btn-block'")."</div>";
 ?>
 <?php echo form_close(); ?>
</div>
 </div><!--<div class="reg_form">-->
