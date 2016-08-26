<?php  if($this->session->flashdata('category_error')) { ?>
		<div class="row-fluid">
			<div class="alert alert-danger">
				<strong><?=$this->session->flashdata('message')?></strong>
			</div>
		</div>
  		<?php } ?>
<form method="post" action="<?=base_url();?>Master/registerData">
<div class="row-fluid">
			<div class="alert alert-danger">
				<strong>NOTE:-  Category should be save behalf on your select value and other value save randomly whose already insert in database </strong>
			</div>
		</div>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="field-1">Category</label>
		<div class="col-sm-10">
			<select class="selectboxit s2example-1" id="" name="category">
					<optgroup label="Please select Category" >
					<option value="friend">Friend</option>
					<option value="son">Son</option>
					<option value="sister">Sister</option>
					<option value="brother">Brother</option>
					<option value="daughter">Daughter</option>
					</optgroup>
			</select>
		</div>
	</div><br><br><br>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="field-1">Number Of Entry</label>
		<div class="col-sm-10">
			<select class="selectboxit s2example-1" id="" name="loopValue">
					<optgroup label="Please select loop value" >
					<?php for($i=1;$i<1000;$i++){ ?>
						<option value="<?=$i;?>"><?=$i;?></option>
					<?php }?>
					</optgroup>
			</select>
		</div>
	</div><br><br>
	<div align="right" style="margin-right: 68px; margin-top: 68px;">
		<button type="submit" value="" class="btn btn-secondary btn-sm btn-icon icon-left">Submit</button>
	</div>
</form>	