<!-- add organization page added by palak on 20 th june -->
<!-- add organization body starts -->
<div class="page-title">
	<div class="title-env">
		<h1 class="title">Profile View</h1>
		<p class="description">Profile View</p>
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
				<div class="panel-heading">
					<h3 class="panel-title">Profile View</h3>
				</div>
				<div class="panel-body"> 
					<form role="form" class="form-horizontal" method="post" action="<?=base_url();?>Master/insert_organization">
						<div class="row">
							<div class="row col-sm-4">
								<label class="control-label" for="joiningletter">Profile Image</label>
								 <div class="fileupload fileupload-new" data-provides="fileupload">
									<?php if(isset($profile[0]->firstName)){ ?>
										<div class="fileupload-new">
										  <img src="images/<?=$profile[0]->imageName?>" alt="" style="width:120px; height:120px;margin-left:118px; margin-bottom:22px; margin-top:-16px;" class="img-circle tooltip-primary" data-toggle="tooltip" data-placement="top" title="" />
										</div>
									<?php }else{ ?>
										<div class="fileupload-new">
										  <img src="http://www.placehold.it/120x120/EFEFEF/AAAAAA&amp;text=no+image"  alt=""  class="img-circle tooltip-primary" data-toggle="tooltip" data-placement="top" title="" />
										</div>		
									
									<?php } ?>
									  <!--<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 120px; max-height: 120px; line-height: 20px;"></div>-->
										<div>
								</div></div>
							</div>
							<div class="row col-sm-8">
								<div class=" form-group">
									<label class="col-sm-2 control-label" for="field-1">First Name</label>
									<div class="col-sm-10">
										<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->firstName)){ echo $profile[0]->firstName; }?>" id="field-1" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="field-1">Last Name</label>
									<div class="col-sm-10">
										<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->lastName)){ echo $profile[0]->lastName; }?>" id="field-1" placeholder="Organization Name"  >
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="field-1">Gender</label>
									<div class="col-sm-10">
										<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->gender) &&$profile[0]->gender=='M'){ echo 'Male'; }else{ echo 'Fe Male';}?>" id="field-1" placeholder="Organization Name"  >
									</div>
								</div>
							</div>
						</div>	
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-2 control-label" for="field-1">Date Of Birth</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->dateOfBirth)){ echo date('d/m/y',strtotime($profile[0]->dateOfBirth)); }?>" id="field-1" >
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-2 control-label" for="field-1">Highest Quallification</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->highestQualification)){ echo $profile[0]->highestQualification; }?>" id="field-1" >
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-2 control-label" for="field-1">Business</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->business)){ echo $profile[0]->business; }?>" id="field-1" >
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-2 control-label" for="field-1">Income</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->income)){ echo $profile[0]->income; }?>" id="field-1" >
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-2 control-label" for="field-1"> Currunt Address</label>
										<div class="col-sm-10">
											<textarea class="form-control name="organization_name"><?php if(isset($profile[0]->currentAddress)){ echo $profile[0]->currentAddress; }?></textarea>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-2 control-label" for="field-1">Permanent Address</label>
										<div class="col-sm-10">
											<textarea class="form-control name="organization_name" ><?php if(isset($profile[0]->permanentAddress)){ echo $profile[0]->permanentAddress; }?></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-2 control-label" for="field-1">Mobile Number</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->mobileNumber)){ echo $profile[0]->mobileNumber; }?>" id="field-1" >
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-2 control-label" for="field-1">Email</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->emailId)){ echo $profile[0]->emailId; }?>" id="field-1" >
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-2 control-label" for="field-1">Father Name</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->fatherName)){ echo $profile[0]->fatherName; }?>" id="field-1" >
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-2 control-label" for="field-1">Father Business</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->fatherJobProfile)){ echo $profile[0]->fatherJobProfile; }?>" id="field-1" >
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-2 control-label" for="field-1">Father Income</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->fatherIncome)){ echo $profile[0]->fatherIncome; }?>" id="field-1" >
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-2 control-label" for="field-1">Birth Place</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->birthPlace)){ echo $profile[0]->birthPlace; }?>" id="field-1" >
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-2 control-label" for="field-1">Nanihal Gautra</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->gautrNanihal)){ echo $profile[0]->gautrNanihal; }?>" id="field-1" >
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-2 control-label" for="field-1">Zodiac Sign</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->zodiacSign)){ echo $profile[0]->zodiacSign; }?>" id="field-1" >
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-2 control-label" for="field-1">Manglik</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->manglik)){ echo $profile[0]->manglik; }?>" id="field-1" >
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class=" form-group">
										<label class="col-sm-2 control-label" for="field-1">Saturn</label>
										<div class="col-sm-10">
											<input type="text" class="form-control"  name="organization_name" value="<?php if(isset($profile[0]->saturn)){ echo $profile[0]->saturn; }?>" id="field-1" >
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group-separator"></div>
							<div class="form-group">
								<!--<button type="submit" class="btn btn-success">Submit</button>-->
								<button type="reset" class="btn btn-white" onClick="window.history.back();">Cancel</button>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
			<!-- body container ends starts -->
</div><!-- main content div end -->
</div><!-- page container div end -->