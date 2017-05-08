<!-- add organization page added by palak on 20 th june -->
<!-- add organization body starts -->
<div class="page-title">
	<div class="title-env">
		<h1 class="title">Register User Info</h1>
		<p class="description">Register User Info</p>
	</div>
		<!-- breadcrumbs starts -->
	<!--<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1">
			<li>
				<a href="javascript:;"><i class="fa-home"></i>Home</a>
			</li>
			<li class="active">
				<strong>Manage Organization</strong>
			</li>
			<li class="active">
				<strong>Add Organization</strong>
			</li>
		</ol>
	</div>-->
		<!-- breadcrumbs ends -->	
</div>
			<!-- page title closed -->
			<!-- body container  starts -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<!-- <div class="panel-heading">
					<h3 class="panel-title">Profile View</h3>
				</div> -->
				<div class="panel-body"> 
					<form role="form" class="form-horizontal" method="post" action="<?=base_url();?>Master/insert_organization">
						
					<div class="row">
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class=" form-group">
									<label class="col-sm-4 control-label" for="field-1">First Name<span style="color:red;"> *</span></label>
									<div class="col-sm-8">
										<input type="text" class="form-control input-lg" name="userName" value="<?php if(isset($Userinfo[0]->userName)){ echo $Userinfo[0]->userName; }?>" id="field-1" >
									</div>
								</div>
								</div>
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-4 control-label" for="field-1">Last Name<span style="color:red;"> *</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control input-lg"  name="EmailID" value="<?php if(isset($Userinfo[0]->EmailID)){ echo $Userinfo[0]->EmailID; }?>" id="field-1" >
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-4 control-label" for="field-1">Date Of Birth<span style="color:red;"> *</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control input-lg" name="MobileNumber" value="<?php if(isset($Userinfo[0]->MobileNumber)){ echo $Userinfo[0]->MobileNumber; }?>" id="field-1" >
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-4 control-label" for="field-1">Highest Quallification<span style="color:red;"> *</span></label>
										<div class="col-sm-8">
											<input type="text" class="form-control input-lg"  name="createdON" value="<?php if(isset($Userinfo[0]->createdON)){ echo $Userinfo[0]->createdON; }?>" id="field-1" >
										</div>
									</div>
								</div>
							</div>
						</div>
						
							<div class="form-group">
								<button type="reset" class="btn btn-white" onClick="window.history.back();">Cancel</button>
						
								<!--<button  type="reset" class="btn btn-white" onClick="return confirm('Are you sure you want to delete information....')">Delete</button>-->
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
			<!-- body container ends starts -->
</div><!-- main content div end -->
</div><!-- page container div end -->