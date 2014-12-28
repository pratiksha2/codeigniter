<style>
	.center-block-custom{
		text-align:center;
	}
</style>
<div class="container">
	<?php if(isset($shortlistData) && ($shortlistData['totalPages']>0 && $shortlistData['totalPages']>=$shortlistData['currentPage'])){?>
	<div id="shortlist-results" class="row">
	<?php foreach($shortlistData['users'] as $user){?>
		<div class="col-xs-5 col-sm-4 col-md-3 shortlist-id-<?php echo $user->userIdMain;?>">
			<div class="panel panel-primary">
				<div class="panel-body">				
					<img src="<?php echo base_url();?>assets/img/defaultAvatars.png" class="img-responsive" alt="Responsive image" />
					<h4 class="center-block-custom">
						<a href="<?php echo base_url();?>profile/<?php echo $user->userIdMain;?>"><?php echo $user->FirstName . ' ' . $user->LastName;?></a>
					</h4>
					<a class="btn btn-default col-xs-12" href="<?php echo base_url();?>profile/<?php echo $user->userIdMain;?>">View Profile</a>
					<button type="button" class="btn btn-primary col-xs-12" onclick="removeShortList(<?php echo $user->userIdMain;?>);">Remove</button>
				</div>					
			</div>
		</div>
	<?php } ?>
	</div>
	<div class="row">
		<nav style="text-align: center">
            <ul class="pagination">
				<?php 
					$currentPage = $shortlistData['currentPage'];
					$totalPages = $shortlistData['totalPages'];
					$params = $shortlistData['params'];
					$params['page'] = $currentPage - 1;
				?>
				<?php if($currentPage>1){?>
				<li><a href="<?php echo base_url();?>search/results?<?php echo http_build_query($params)?>"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
				<?php } ?>
				<?php for($i=1; $i<=$totalPages; $i++){ $params['page'] = $i; ?>
					<?php if($currentPage<=$totalPages){?>
					<li <?php if($currentPage==$i){?>class="active"<?php } ?>><a href="<?php echo base_url();?>search/results?<?php echo http_build_query($params)?>"><?php echo $i;?></a></li>
					<?php } ?>
				<?php } ?>	
				<?php if($totalPages>1 && $currentPage<$totalPages){ $params['page'] = $currentPage + 1; ?>
				<li><a href="<?php echo base_url();?>search/results?<?php echo http_build_query($params)?>"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
				<?php } ?>		
			</ul>
		</nav>
	</div>
	<?php } else { ?>
		<div class="row center">No Result Found</div>
	<?php } ?>
</div>


<script>
	function removeShortList(id){
		$.ajax({
			url: '<?php echo base_url();?>shortlist/remove/'+id,
			dataType:'JSON',
			success:function(data){
				if(data.result){
					$('.shortlist-id-'+id).remove();
					if($('#shortlist-results').children().length<1){
						window.location.reload();
					}
				}
			}
		});
	}
        
</script>