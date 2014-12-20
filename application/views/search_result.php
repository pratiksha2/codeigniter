<div class="container">
	<?php print_r($searchData);?>
	<div id="search-results" class="row">
	<?php for($i=0;$i<5;$i++){?>
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-xs-5 col-sm-4 col-md-3">
					<img src="<?php echo base_url();?>assets/img/defaultAvatars.png" class="img-responsive" alt="Responsive image" />
					<button type="button" class="btn btn-default col-xs-12">View Profile</button>
					<button type="button" class="btn btn-primary col-xs-12">Shortlist</button>
				</div>
				<div class="col-xs-7 col-sm-8 col-md-9">
					<h4>
						FirstName LastName
					</h4>
					Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
				</div>
			</div>
		</div>
	<?php } ?>
	</div>	
</div>