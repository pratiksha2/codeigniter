<style>
	#search-results .searchLabel{
		color : #5bc0de;
		font-weight : bold;
	}
</style>
<div class="container">
	<?php if(isset($searchData) /*&& ($searchData['totalPages']>0 && $searchData['totalPages']>=$searchData['currentPage'])*/){?>
	<div id="search-results" class="row">
	<?php foreach($searchData['search'] as $search){?>
		<div class="panel panel-primary">
			<div class="panel-body">
				<div class="col-xs-5 col-sm-4 col-md-3">
					<img src="<?php echo base_url();?>assets/img/defaultAvatars.png" class="img-responsive" alt="Responsive image" />
					<a class="btn btn-default col-xs-12" href="<?php echo base_url();?>profile/<?php echo $search->userIdMain;?>">View Profile</a>
					<button type="button" class="btn btn-primary col-xs-12">Shortlist</button>
				</div>
				<div class="col-xs-7 col-sm-8 col-md-9">
					<h4>
						<a href="<?php echo base_url();?>profile/<?php echo $search->userIdMain;?>"><?php echo $search->FirstName . ' ' . $search->LastName;?></a>
					</h4>
					<?php if( isset($search->AboutMe) && $search->AboutMe!='' ){ ?>
						<div><span class="searchLabel">About Me : </span><?php echo $search->AboutMe;?></div>
					<?php } ?>
					<?php if( isset($search->Gender) && $search->Gender!='' ){ ?>
						<div><span class="searchLabel">Gender : </span><?php echo $search->Gender;?></div>
					<?php } ?>
					<?php if( isset($search->MaritalStatus) && $search->MaritalStatus!='' ){ ?>
						<div><span class="searchLabel">Marital Status : </span><?php echo $search->MaritalStatus;?></div>
					<?php } ?>
					<?php if( isset($search->DOB) && $search->DOB!='' ){ ?>
						<div><span class="searchLabel">Age : </span><?php echo getAge($search->DOB);?></div>
					<?php } ?>
					<?php if( isset($search->MotherTongue) && $search->MotherTongue!='' ){ ?>
						<div><span class="searchLabel">Mother Tongue : </span><?php echo $search->MotherTongue;?></div>
					<?php } ?>
					<?php if( isset($search->LivingIn) && $search->LivingIn!='' ){ ?>
						<div><span class="searchLabel">Living In : </span><?php echo $search->LivingIn;?></div>
					<?php } ?>
					<?php if( isset($search->ReligionCaste) && $search->ReligionCaste!='' ){ ?>
						<div><span class="searchLabel">Religion - Caste : </span><?php echo $search->ReligionCaste;?></div>
					<?php } ?>
					<?php if( isset($search->Education) && $search->Education!='' ){ ?>
						<div><span class="searchLabel">Education : </span><?php echo $search->Education;?></div>
					<?php } ?>
					<?php if( isset($search->Manglik) && $search->Manglik!='' ){ ?>
						<div><span class="searchLabel">Manglik : </span><?php echo $search->Manglik;?></div>
					<?php } ?>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>
	<?php /*
	<div class="row">
		<nav style="text-align: center">
            <ul class="pagination">
				<?php 
					$currentPage = $searchData['currentPage'];
					$totalPages = $searchData['totalPages'];
					$params = $searchData['params'];
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
	</div> */?>
	<?php } else { ?>
		<div class="row center">No Result Found</div>
	<?php } ?>
</div>