	 <script type="text/javascript">
		jQuery(document).ready(function($)
		{
			$("#example-1").dataTable({
				aLengthMenu: [
					[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]
				]
			});
		});
		</script>
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
				<div class="panel-body">
					<div class="table-responsive" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true">
					<table id="example-1" cellspacing="0" class="table table-small-font table-bordered table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Email ID</th>
								<th>Contact Number</th>
								<th>Created Date</th>
								<th>Action</th>
							</tr>
						</thead>
						<tfoot>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email ID</th>
							<th>Contact Number</th>
							<th>Created Date</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>
					<?php if(isset($Register_User) && !empty($Register_User)){ 
						 $k=0; $i=1; foreach($Register_User as $lists){?>
							<tr>
								<td><?=$i;?></td>
								<td><?php echo $lists->userName;?></td>
								<td><?php echo $lists->EmailID;?></td>
								<td><?php echo $lists->MobileNumber;?></td>
								<td><?php echo $lists->createdON;?></td>
								<td>
								   <a href="<?php echo base_url(); ?>Master/Register_Userinfo/<?=$lists->registerUserID; ?>" class="btn btn-info"><i class="fa fa-eye" aria-hidden="true"></i> View Profile </a>
								</td>
							</tr>
							<?php $i++; }}?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
		
			