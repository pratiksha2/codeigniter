<div class="container">
	<div id="search-results" class="row">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>ID</th>
					<th>Name</th>
					<th>Login ID</th>
					<th>Email</th>
					<th>Gender</th>
					<th>Activated</th>
					<th>Blocked</th>
					<th>Registration Date</th>
					<th>User Type</th>
					<th>Promote Admin</th>
				</tr>
			</thead>
			<tbody>
			<?php $i = 0; ?>
			<?php foreach($usersData['users'] as $user){?>
				<?php $i++; ?>
				<tr class="user-<?php echo $user->id; ?>">
					<td><?php echo $i; ?></td>				  
					<td><?php echo $user->id; ?></td>
					<td><?php echo $user->FirstName . ' ' . $user->LastName; ?></td>
					<td><?php echo $user->LoginID; ?></td>
					<td><?php echo $user->Email; ?></td>
					<td><?php echo $user->Gender; ?></td>
					<td><?php echo $user->Activated; ?></td>
					<td><?php echo $user->Blocked; ?></td>
					<td><?php echo $user->RegistrationDate; ?></td>
					<td><?php echo $user->UserType; ?></td>
					<td><button type="button" class="btn btn-primary" onClick="makeAdmin(<?php echo $user->id; ?>)">Make Admin</button></td>				  
				</tr>
			<?php } ?>
			</tbody>
		</table>
		
		<nav style="text-align: center">
			<ul class="pagination">
				<?php 
					$currentPage = $usersData['currentPage'];
					$totalPages = $usersData['totalPages'];
				?>
				<?php if($currentPage!=1){?>
				<li><a href="<?php echo base_url();?>admin/users/"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
				<?php } ?>
				<?php for ($i=1; $i<=$totalPages;$i++){?>
				<li <?php if($currentPage==$i){?>class="active"<?php } ?>><a href="<?php echo base_url();?>admin/users/?page=<?php echo $i;?>"><?php echo $i;?></a></li>
				<?php } ?>
				<?php if($currentPage<$totalPages){?>
				<li><a href="<?php echo base_url();?>admin/users/?page=<?php echo $currentPage+1;?>"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
				<?php } ?>
			</ul>
		</nav>
	</div>	
</div>
<script>
	function makeAdmin(id){
		$.ajax({
			url 	: '<?php echo base_url();?>ajax/make_admin/'+id,
			dataType: 'json',
			success : function(data){
				if(data.success){
					$('.user-'+id).addClass('success');
				}
				if(data.err){					
					alert(data.err);
				}
			},
		});
		return false;
	}
</script>