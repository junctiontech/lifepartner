<footer class="" align="center">
	<div class="" style="background-color:#7d3669; ">
		<!-- Add your copyright text here -->
		<div class="footer-text text-black" >
						&copy; <?php echo date("Y"); ?> 
						<strong >Junction ERP.Copyright<a href="http://junctiontech.in/" target="_blank"> Junction Software Pvt.Ltd	</a></strong> 
						Mobile Number- 8109069226 				
		</div>
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
		
	<div class="modal  custom-width fade" id="modal-7" data-backdrop="static" >
		<div class="modal-dialog" style="width: 75%">
			<div class="modal-content">
			</div>
		</div>
	</div>
	<div class="modal  custom-width fade" id="modal-8" data-backdrop="static" >
		<div class="modal-dialog" style="width: 60%">
			<div class="modal-content"></div>
		</div>
	</div>	
	<!--  <script type="text/javascript">
	
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
		
</script>-->
<!-- Bottom Scripts -->
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/TweenMax.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/resizeable.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/joinable.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/xenon-api.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/xenon-toggles.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-validate/jquery.validate.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
	<!--  <script type="text/javascript">
			
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
		<script type="text/javascript">
			function ajaxindicatorstart(text)
			{
				if(jQuery('body').find('#resultLoading').attr('id') != 'resultLoading'){
				jQuery('body').append('<div id="resultLoading" style="display:none"><div><img src="img/ajax-loader.gif"><div>'+text+'</div></div><div class="bg"></div></div>');
				}
				
				jQuery('#resultLoading').css({
					'width':'100%',
					'height':'100%',
					'position':'fixed',
					'z-index':'10000000',
					'top':'0',
					'left':'0',
					'right':'0',
					'bottom':'0',
					'margin':'auto'
				});	
				
				jQuery('#resultLoading .bg').css({
					'background':'#000000',
					'opacity':'0.7',
					'width':'100%',
					'height':'100%',
					'position':'absolute',
					'top':'0'
				});
				
				jQuery('#resultLoading>div:first').css({
					'width': '250px',
					'height':'75px',
					'text-align': 'center',
					'position': 'fixed',
					'top':'0',
					'left':'0',
					'right':'0',
					'bottom':'0',
					'margin':'auto',
					'font-size':'16px',
					'z-index':'10',
					'color':'#ffffff'
					
				});
		
			    jQuery('#resultLoading .bg').height('100%');
		        jQuery('#resultLoading').fadeIn(300);
			    jQuery('body').css('cursor', 'wait');
			}
		
			function ajaxindicatorstop()
			{
			    jQuery('#resultLoading .bg').height('100%');
		        jQuery('#resultLoading').fadeOut(300);
			    jQuery('body').css('cursor', 'default');
			}
			
			function callAjax()
			{
				jQuery.ajax({
					type: "GET",
					url: "fetch_data.php",
					cache: false,
					success: function(res){
							jQuery('#ajaxcontent').html(res);
					}
				});
			}
			
		  jQuery(document).ajaxStart(function () {
		   		//show ajax indicator
				ajaxindicatorstart('loading data.. please wait..');
		  }).ajaxStop(function () {
				//hide ajax indicator
				ajaxindicatorstop();
		  });
		</script>-->
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
