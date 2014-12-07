<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
   
	<title><?php echo $document['title'];?></title>
   
   <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
   
   <?php /*----Load Bootstrap Framework-----*/  ?>
   <link href="<?php echo base_url();?>assets/css/bootstrap.css" rel="stylesheet">
   <link href="<?php echo base_url();?>assets/css/bootstrap-theme.min.css" rel="stylesheet">
   <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<?php /*----Load Bootstrap Framework-----*/  ?>
   
	<style>
	.main-view{
		padding-top:60px;
	}	
	.footer {
		width: 100%;
		background-color: #f5f5f5;
	}
	
	</style>
      <?php /*----Load External CSS-----*/  ?>
   <?php if(   isset($document['externalCss']) && count($document['externalCss']) ){?>
	   <?php foreach($document['externalCss'] as $docCss){ ?>
      <link rel="stylesheet" type="text/css" href="<?php echo $docCss; ?>">
      <?php } ?>
   <?php }?>
      <?php /*----Load External CSS-----*/  ?>
      
      
      <?php /*----Load External Javascript-----*/  ?>
   <?php if(   isset($document['externalJs']) && count($document['externalJs']) ){?>
	   <?php foreach($document['externalJs'] as $docJs){ ?>
      <script src="<?php echo $docJs; ?>"></script>
      <?php } ?>
   <?php }?>   
      <?php /*----Load External Javascript-----*/  ?>
      
      <?php /*----Load Custom CSS-----*/  ?>
   <?php if(   isset($document['customCss']) && count($document['customCss']) ){?>
	   <?php foreach($document['customCss'] as $docCss){ ?>
      <style type="text/css">
         <?php echo $docCss; ?>
      </style>
      <?php } ?>
   <?php }?>
      <?php /*----Load Custom CSS-----*/  ?>
      
      
      <?php /*----Load Custom Javascript-----*/  ?>
   <?php if(   isset($document['customJs']) && count($document['customJs']) ){?>
	   <?php foreach($document['customJs'] as $docJs){ ?>
      <script type="text/javascript">
         <?php echo $docJs; ?>
      </script>
      <?php } ?>
   <?php }?>   
      <?php /*----Load Custom Javascript-----*/  ?>
      
      <?php /*----Load Meta Tags-----*/  ?>
   <?php if(   isset($document['metaTags']) && count($document['metaTags']) ){?>
	   <?php if(   isset($document['metaTags']['description']) ){ ?>
         <meta name="description" content="<?php echo htmlspecialchars($document['metaTags']['description']); ?>">
      <?php } ?>
      <?php if(   isset($document['metaTags']['keywords']) ){ ?>
         <meta name="keywords" content="<?php echo htmlspecialchars($document['metaTags']['keywords']); ?>">
      <?php } ?>
      <?php if(   isset($document['metaTags']['author']) ){ ?>
         <meta name="author" content="<?php echo htmlspecialchars($document['metaTags']['author']); ?>">
      <?php } ?>   
   <?php }?>   
      <?php /*----Load Meta Tags-----*/   ?>  
</head>
<body>

   
   <?php /*----NavBar-----*/   ?>
		<?php
			if(empty($navBarData)){
				$navBarData = array();
			}
		?>
      <?php $this->load->view('navbar' , $navBarData);?>
   <?php /*----NavBar-----*/   ?>
   
   <div class="main-view">
   <?php /*----Main View-----*/   ?>
		<?php
			if(empty($viewData)){
				$viewData = array();
			}
		?>
      <?php $this->load->view($view , $viewData);?>
   <?php /*----Main View-----*/   ?>
   </div>
   <?php /*----Footer-----*/   ?>
		<?php
			if(empty($footerData)){
				$footerData = array();
			}
		?>
      <?php $this->load->view('footer' , $footerData);?>
   <?php /*----Footer-----*/   ?>
   

</body>
</html>