
<!-- manage organization page added by palak on 20 th june -->
<!-- manage organization body starts -->
<div class="page-title">
	<div class="title-env">
		<h1 class="title">Profile List</h1>
		<p class="description">Profile List</p>
	</div>
	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1">
			<li><a href="javascript:;"><i class="fa-home"></i>Home</a></li>
			<li class="active"><strong>Profile List</strong></li>
		</ol>
	</div>
</div>
<?php  if($this->session->flashdata('category_success')) { ?>
		<div class="row">
			<div style="margin-left:250px ;margin-right:250px"; class="alert alert-success">
			<strong><?=$this->session->flashdata('message')?></strong> 
			</div>
		</div>
		<?php }?>
		<?php  if($this->session->flashdata('category_error')) { ?>
		<div class="row">
			<div style="margin-left:250px ;margin-right:250px"; class="alert alert-danger">
			<strong><?=$this->session->flashdata('message')?></strong> 
			</div>
		</div>
		<?php }?>
		<script type="text/javascript">
			jQuery(document).ready(function($)
			{
				$(".s2example-1").select2({
					placeholder: 'Select Your Organization Name...',
					allowClear: true
				}).on('select2-open', function()
				{
					// Adding Custom Scrollbar
					$(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
				});
				
			});
		</script>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<form method="post" action ="<?=base_url();?>Master/profileList">
					<div class="form-group">
					<label class="col-sm-2 control-label" for="field-1">Gender<span style="color:red;"> *</span></label>
						<div class="col-sm-2" style="margin-left: -80px;">
							<select class="selectboxit s2example-1" id="s2example-1" name="gender" onchange="genderChange(this.value);">
								<?php //foreach($organizationList as $list){ ?>
								<option value="M">Male</option>
								<option value="F">Female</option>
								<?php //} ?>
								</optgroup>
							</select>
						</div>
					<label style="margin-left: -5px;"class="col-sm-1 control-label" for="field-1">Age<span style="color:red;"> *</span></label>
					<div class="col-sm-3" style="margin-left:-35px">
						<div id="male">
							<select class="selectboxit s2example-1" id="s2example-1" name="maleAge" required>
								<optgroup label="Please select Age " >
									<?php //foreach($organizationList as $list){ ?>
									<option value="">Please Select Age</option>
									<option value="21-25">21-25 Year</option>
									<option value="25-30">25-30 Year</option>
									<option value="30-35">31-35 Year</option>
									<option value="35-40">35-40 Year</option>
									<option value="40-45">40-45 Year</option>
									<option value="45-50">45-50 Year</option>
									<option value="55-60">55-60 Year</option>
									<option value="60-100">more than 60 Year</option>
									<?php //} ?>
								</optgroup>
						 	</select>
						</div>
						<div id="female" style="display:none">
							<select class="selectboxit s2example-1" id="s2example-1" name="feMaleAge">
								<optgroup label="Please select Age " >
									<?php //foreach($organizationList as $list){ ?>
									<option value="">Please Select Age</option>
									<option value="18-25">18-25 Year</option>
									<option value="25-30">25-30 Year</option>
									<option value="30-35">31-35 Year</option>
									<option value="35-40">35-40 Year</option>
									<option value="40-45">40-45 Year</option>
									<option value="45-50">45-50 Year</option>
									<option value="55-60">55-60 Year</option>
									<option value="60-100">more than 60 Year</option>
									<?php //} ?>
								</optgroup>
							</select>
						</div>
					</div>
					<label class="col-sm-1 control-label" for="field-1" > Income<span style="color:red;">*</span></label>
				 	<div class="col-sm-3" style="margin-top: -40px;margin-left: 780px; margin-right: 1px;">
						<select class="selectboxit s2example-1" id="" name="income" >
							<option value="">Please Select income</option>
								<option value="100000">1 Lakh</option>
								<option value="500000">5 Lakh</option>
								<option value="1000000">10 Lakh</option>
								<option value="1500000">15 Lakh</option>
								<option value="2000000">20 Lakh</option>
								<option value="2500000">25 Lakh</option>
								<option value="3000000">30 Lakh</option>
								<option value="3500000">35 Lakh</option>
								<option value="4000000">40 Lakh</option>
								<option value="4500000">45 Lakh</option>
								<option value="5000000">50 Lakh</option>
							</optgroup>
						</select>
					</div>
					<div class="col-sm-2" style="margin-top: -30px;margin-left: 1050px;">
						<input type="radio" class=""  name="incomeIdentity" value=">" id="field-1" checked /><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
						<input type="radio" class=""  name="incomeIdentity" value="<" id="field-1" /><i class="fa-thumbs-o-down" aria-hidden="true"></i>
					</div>
				</div>
				</br></br></br>
				<div class="form-group">
					<label class="col-sm-2 control-label" style="margin-left: 0px;" for="field-1">Caste<span style="color:red;"> *</span></label>
					<div class="col-sm-4">
						<select class="selectboxit s2example-1" id="" name="caste">
								<option value="">Please Select Caste</option>
								<?php foreach($caste as $list){ ?>
									<option value="<?php echo $list->caste?>"><?php echo $list->caste; ?></option>
								<?php } ?>
							</optgroup>
						</select>
					</div>
					<label class="col-sm-2 control-label" for="field-1">Sub Caste<span style="color:red;"> *</span></label>
					<div class="col-sm-4">
						<select class="selectboxit s2example-1" id="" name="subCaste">
								<option value="">Please Select Sub Caste</option>
								<?php foreach($subCaste as $list){ ?>
									<option value="<?php echo $list->subcaste?>"><?php echo $list->subcaste; ?></option>
								<?php } ?>
							</optgroup>
						</select>
					</div>
				</div>
				</br></br></br>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="field-1"> Height<span style="color:red;"> *</span></label>
					<div class="col-sm-4" style="margin-left: -80px;">
						<select class="selectboxit s2example-1" id="" name="minHeight" onchange="height(this.value)">
							<option value="">Min Height</option>
							<?php for($i=4;$i<=6;$i++){ for($k=0;$k<12;$k++){ ?>
							<option value="<?php echo $i.".".$k;?>"><?php echo $i.".".$k;?></option>
							<?php  } } ?>
						</select>
					</div>
					<label class="col-sm-2 control-label" for="field-1"> To<span style="color:red;"> *</span></label>
					<div class="col-sm-4">
						<select class="selectboxit s2example-1" id="minHeight" name="maxHeight">
							<option value="">Max Height</option>
						</select>
					</div>
				</div>
				</br></br></br>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="field-1">City<span style="color:red;"> *</span></label>
					<div class="col-sm-4" style="margin-left: -80px;">
						<select class="selectboxit s2example-1" id="" name="city">
								<option value="">Please Select City</option>
								<?php foreach($city as $list){ ?>
									<option value="<?php echo $list->city?>"><?php echo $list->city; ?></option>
								<?php } ?>
							</optgroup>
						</select>
					</div>
					<label class="col-sm-2 control-label" for="field-1"> Education<span style="color:red;"> *</span></label>
					<div class="col-sm-4">
						<select class="selectboxit s2example-1" id="" name="education">
								<option value="">Please Select Education</option>
								<?php //foreach($organizationList as $list){ ?>
								<option value="Graduate">Doctorate</option>
								<option value="Post Graduate">Post Graduate</option>
								<option value="Graduate">Graduate</option>
								<option value="12th">12th</option>
								<option value="non-educated">Non Educated</option>
								<?php // } ?>
							</optgroup>
						</select>
					</div>
				</div>
				<div align="right" style="margin-right: 68px; margin-top: 68px;">
					<button type="submit" value="" class="btn btn-secondary btn-sm btn-icon icon-left">Search</button>
				</div>
			</form>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Profile List</h3>
					<!--  <div class="panel-options">
							<a href="<?php echo base_url(); ?>master/add_organization">
							<button class="btn btn-theme btn-info btn-icon btn-sm"><i class="fa-plus"></i> <span>Add Organization</span>
							</button></a>
						  </div>-->
					</div>
					<div class="panel-body">
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
						<div class="table-responsive" data-pattern="priority-columns" data-focus-btn-icon="fa-asterisk" data-sticky-table-header="true" data-add-display-all-btn="true" data-add-focus-btn="true">
						<table id="example-1" cellspacing="0" class="table table-small-font table-bordered table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Name</th>
									<th>Age</th>
									<th>City</th>
									<th>Education</th>
									<th>Income</th>
									<th>Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
								<th>#</th>
								<th>Name</th>
								<th>Age</th>
								<th>City</th>
								<th>Education</th>
								<th>Income</th>
								<th>Action</th>
							</tr>
						</tfoot>
						<tbody>
					<?php if(isset($profileList) && !empty($profileList)){
						 $k=0; $i=1; foreach($profileList as $list){?>
							<tr>
								<td><?=$i;?></td>
								<td><?php echo $list->firstName;?></td>
								<td><?php  echo date('Y')-date('Y',strtotime($list->dateOfBirth)).' Year';?></td>
								<td><?php echo $list->city;?></td>
								<td><?php echo $list->highestQualification;?></td>
								<td><?php echo $list->income;?></td>
								<td>
								     
									<a href="<?php echo base_url(); ?>Master/profile/<?=$list->no; ?>" class="btn btn-secondary"><i class="fa fa-eye" aria-hidden="true"></i> View Profile </a>
									<a href="<?php echo base_url(); ?>Master/deleteProfileList/<?=$list->no;?>" onClick="return confirm('Are you sure you want to delete information....')" class="btn btn-danger "><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
									<!--<a href="<?php echo base_url(); ?>Master/profile/<?=$list->no;?>" class="btn btn-info btn-sm btn-icon icon-left"> Request</a>-->                
									<?php 
									if(strcasecmp($list->status,'block')==0){ ?>
										<a href="<?php echo base_url(); ?>Master/disapprove/<?=$registerUser_ID[$k];?>?no=<?=$list->no;?>" onclick="return confirm(' Are you sure you want to Enable <?php echo $list->firstName?> profile');" class="btn btn-success "><i class="fa fa-unlock-alt" aria-hidden="true"></i> Un-block</a>
										<?php }
										else
										{ ?>	
										<a href="<?php echo base_url(); ?>Master/approve/<?=$registerUser_ID[$k];?>?no=<?=$list->no;?>" onclick="return confirm('Are you sure you want to Disable <?php echo $list->firstName?> profile');" class="btn btn-danger "><i class="fa fa-lock" aria-hidden="true"></i> Block</a>
									<?php }?>
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
