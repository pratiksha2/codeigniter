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
					<th>Remove Admin</th>
				</tr>
			</thead>
			<tbody>
			<?php $i = 0; ?>
			<?php foreach($adminsData['admins'] as $admin){?>
				<?php $i++; ?>
				<tr class="admin-<?php echo $admin->UserID; ?>">
					<td><?php echo $i; ?></td>				  
					<td><?php echo $admin->id; ?></td>
					<td><?php echo $admin->FirstName . ' ' . $admin->LastName; ?></td>
					<td><?php echo $admin->LoginID; ?></td>
					<td><?php echo $admin->Email; ?></td>
					<td><?php echo $admin->Gender; ?></td>
					<td><?php echo $admin->Activated; ?></td>
					<td><?php echo $admin->Blocked; ?></td>
					<td><?php echo $admin->RegistrationDate; ?></td>
					<td><?php echo $admin->UserType; ?></td>
					<td><button type="button" class="btn btn-primary" onClick="removeAdmin(<?php echo $admin->UserID; ?>)">Remove Admin</button></td>				  
				</tr>
			<?php } ?>
			</tbody>
		</table>
		
		<nav style="text-align: center">
			<ul class="pagination">
				<?php 
					$currentPage = $adminsData['currentPage'];
					$totalPages = $adminsData['totalPages'];
				?>
				<?php if($currentPage!=1){?>
				<li><a href="<?php echo base_url();?>admin/admins/"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
				<?php } ?>
				<?php for ($i=1; $i<=$totalPages;$i++){?>
				<li <?php if($currentPage==$i){?>class="active"<?php } ?>><a href="<?php echo base_url();?>admin/admins/?page=<?php echo $i;?>"><?php echo $i;?></a></li>
				<?php } ?>
				<?php if($currentPage<$totalPages){?>
				<li><a href="<?php echo base_url();?>admin/admins/?page=<?php echo $currentPage+1;?>"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
				<?php } ?>
			</ul>
		</nav>
	</div>	
</div>
<script>
	function removeAdmin(id){
		$.ajax({
			url 	: '<?php echo base_url();?>ajax/remove_admin/'+id,
			dataType: 'json',
			success : function(data){
				if(data.success){
					$('.admin-'+id).addClass('success');
				}
				if(data.err){					
					alert(data.err);
				}
			},
		});
		return false;
	}
</script>