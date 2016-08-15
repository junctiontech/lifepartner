<?php //print_r($this->data['select_customer']);
?>
	<footer class="main-footer sticky footer-type-1">
				
				<div class="footer-inner">
				
					<!-- Add your copyright text here -->
					<div class="footer-text text-black" >
						&copy; <?php echo date("Y"); ?> 
						<strong >Junction ERP.Copyright<a href="http://junctiontech.in/" target="_blank"> Junction Software Pvt.Ltd	</a></strong> 
						Mobile Number- 8109069226 				</div>
					
					
					<!-- Go to Top Link, just add rel="go-top" to any link to add this functionality -->
					<div class="go-up">
					
						<a href="#" rel="go-top">
							<i class="fa-angle-up"></i>
						</a>
						
					</div>
					
				</div>
				
			</footer>
			</div>
			</div>
			
		<div class="modal  custom-width fade" id="modal-8" data-backdrop="static" >
	
		<div class="modal-dialog" style="width: 75%">
			<div class="modal-content">
						
					
				
				</div>
		</div>
	</div>	
			
	<div class="modal  custom-width fade" id="modal-7" data-backdrop="static" >
	
		<div class="modal-dialog" style="width: 75%">
			
		</div>
	</div>	
	
				
				<script type="text/javascript">
	
						function showHide(){
							var chkBox = document.getElementById("chkBox");
							var txtBox = document.getElementById("txtBox");
			 
							if (chkBox.checked){
								txtBox.style.display = "none";
							} else {
								txtBox.style.display = "block";
							}
						}
		
		</script>
<script>
		function space_alert()
 {
	    var textb=document.getElementById("space").value;

	        if(textb.match(' ')){
	           alert('Spaces not allowed in user id');
	           return false;
	        }
	        var b=document.getElementById("role_description").value;
	        if(b.match(''))
	        {
				alert('Do not empty role description field');
	        }    
}
		
</script>
<!-- Bottom Scripts -->
	<script> var base_url='<?=base_url();?>'; </script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/TweenMax.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/resizeable.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/joinable.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/xenon-api.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/xenon-toggles.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-validate/jquery.validate.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
	<script type="text/javascript">
			
				$(document).ready(function(){
				    var next = 1;
				    $(".add-more").click(function(e){
				        e.preventDefault();
				        var addto = "#field" + next;
				        var addRemove = "#field" + (next);
				        next = next + 1;
				        var newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="department_name[]" type="text">';
				        var newInput = $(newIn);
				        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
				        var removeButton = $(removeBtn);
				        $(addto).after(newInput);
				        $(addRemove).after(removeButton);
				        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
				        $("#count").val(next);  
				        
				            $('.remove-me').click(function(e){
				                e.preventDefault();
				                var fieldNum = this.id.charAt(this.id.length-1);
				                var fieldID = "#field" + fieldNum;
				                $(this).remove();
				                $(fieldID).remove();
				            });
				    });
				    	    $(".add-designation").click(function(e){
				        e.preventDefault();
				        var addto = "#field" + next;
				        var addRemove = "#field" + (next);
				        next = next + 1;
				        var newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="designation_name[]" type="text">';
				        var newInput = $(newIn);
				        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
				        var removeButton = $(removeBtn);
				        $(addto).after(newInput);
				        $(addRemove).after(removeButton);
				        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
				        $("#count").val(next);  
				        
				            $('.remove-me').click(function(e){
				                e.preventDefault();
				                var fieldNum = this.id.charAt(this.id.length-1);
				                var fieldID = "#field" + fieldNum;
				                $(this).remove();
				                $(fieldID).remove();
				            });
				    });

				    	    $(".add-attribute").click(function(e){
						        e.preventDefault();
						        var addto = "#field" + next;
						        var addRemove = "#field" + (next);
						        next = next + 1;
						        var newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="atttibute_name[]" type="text">';
						        var newInput = $(newIn);
						        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
						        var removeButton = $(removeBtn);
						        $(addto).after(newInput);
						        $(addRemove).after(removeButton);
						        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
						        $("#count").val(next);  
						        
						            $('.remove-me').click(function(e){
						                e.preventDefault();
						                var fieldNum = this.id.charAt(this.id.length-1);
						                var fieldID = "#field" + fieldNum;
						                $(this).remove();
						                $(fieldID).remove();
						            });
						    });
				    
				});
				</script>
		
<!-- Bottom Scripts -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker-bs3.css">
		<script src="<?php echo base_url(); ?>assets/js/daterangepicker/daterangepicker.js"></script>	
		<script src="<?=base_url();?>assets/js/timepicker/bootstrap-timepicker.min.js"></script>
			<!-- Imported scripts on this page -->
	<script src="<?php echo base_url(); ?>assets/js/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/yadcf/jquery.dataTables.yadcf.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datatables/tabletools/dataTables.tableTools.min.js"></script>
	<!--tags input css-->
		<script src="<?php echo base_url(); ?>assets/js/tagsinput/bootstrap-tagsinput.min.js"></script>
	<!-- select 2 Scripts -->
	<script src="<?php echo base_url(); ?>assets/js/select2/select2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<!-- select 2 Scripts -->

	<!-- Imported scripts on this page -->
	
	<script src="<?php echo base_url(); ?>assets/js/jquery-validate/jquery.validate.min.js"></script>
	
	<script src="<?php echo base_url(); ?>assets/js/formwizard/jquery.bootstrap.wizard.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/datepicker/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<!-- form wizardScripts -->

		<!-- file upload -->
	 <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bootstrap-fileupload/bootstrap-fileupload.css" />
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
	<!--file upload -->
	<!-- validation script for space remove and special -->
	<script src="<?php echo base_url(); ?>assets/js/inputmask/jquery.inputmask.bundle.js"></script>
	<!-- JavaScripts initializations and stuff -->
	
	<script src="<?php echo base_url(); ?>assets/js/xenon-custom.js"></script>
	
	
  	
</body>
</html>
