<?php $userdata = $this->session->userdata('username');
//print_r($userdata['organization_name']);die;
?>


<body class="page-body  skin-concrete">
<div class="page-loading-overlay">
	<div class="loader-2"></div>
</div>
<nav class="navbar horizontal-menu navbar-fixed-top"><!-- set fixed position by adding class "navbar-fixed-top" -->
		
		<div class="navbar-inner">
			<!-- Navbar Brand -->
			<div class="navbar-brand">
				<a href="javascript:;" class="logo">
					<img src="<?php echo base_url(); ?>assets/images/junctionerplogo.png" width="180" alt="" class="hidden-xs" />
					<img src="<?php echo base_url(); ?>assets/images/junctionerplogo.png" width="120" alt="" class="visible-xs" />
				</a>
		
			</div>
				<!-- Mobile Toggles Links -->
			<div class="nav navbar-mobile">
			
				<!-- This will toggle the mobile menu and will be visible only on mobile devices -->
				<div class="mobile-menu-toggle">
					<!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
				
					<!-- data-toggle="mobile-menu-horizontal" will show horizontal menu links only -->
					<!-- data-toggle="mobile-menu" will show sidebar menu links only -->
					<!-- data-toggle="mobile-menu-both" will show sidebar and horizontal menu links -->
					<a href="javascript:;" data-toggle="mobile-menu-both">
							<i class="fa-bars"></i>
						</a>
				</div>
				
			</div>
			
			<div class="navbar-mobile-clear"></div>
			
			<ul class="navbar-nav">
				<li>
					<a href="javascript:;" data-toggle="sidebar">
							<i class="fa-bars"></i>
						</a>
						</li>
					<!-- add class "multiple-expanded" to allow multiple submenus to open -->
					<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
					<!-- <li>
						<a href="<?php echo base_url(); ?>home"  >
							<i class="linecons-graduation-cap"></i>
							<span id="hr" class="title" title="Human Resource">Human Resource</span>
						</a>
					
					</li>
					<li>
						<a  href="<?php echo base_url(); ?>home?menu=sales" >
							<i class="linecons-shop"></i>
							<span id="sales" class="title">Sales</span>
						</a>
				
					</li>
					<li>
						<a  href="<?php echo base_url(); ?>home?menu=crm" >
							<i class="linecons-comment"></i>
							<span id="crm" class="title">CRM</span>
						</a>
				
					</li>
					<li>
						<a  href="<?php echo base_url(); ?>home?menu=purchasing" >
							<i class="linecons-user"></i>
							<span id="marketing" class="title">Purchasing</span>
						</a>
				
					</li>
					<li>
						<a  href="<?php echo base_url(); ?>home?menu=inventory" >
							<i class="linecons-pencil"></i>
							<span class="title">Inventory</span>
						</a>
				
					</li>-->
					<li>
						<a  href="<?php echo base_url(); ?>home?menu=report" >
							<i class="linecons-money"></i>
							<span id="payable" class="title">Reporting</span>
						</a>
				
					</li>
					<li>
					<a href="javascript:;" onclick="var el = document.getElementById('element'); el.webkitRequestFullscreen();">
							<i class="fa-arrows-alt"></i>
						
					</a>
					</li>
				</ul>
				<ul class="nav nav-userinfo navbar-right">
				
					<li class="dropdown user-profile">
					<a href="#" data-toggle="dropdown">
						<img src="<?php echo base_url(); ?>assets/images/user-1.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
						<span>
							<?=$userdata['username'];?>
							<i class="fa-angle-down"></i>
						</span>
					</a>
					
					<ul class="dropdown-menu user-profile-menu list-unstyled">
						<li>
								<a href="<?=base_url();?>admin_panel/acc_setting">
									<i class="fa-wrench"></i>
									Settings
								</a>
							</li>
							<li>
								<a href="javascript:;">
									<i class="fa-user"></i>
									Profile
								</a>
							</li>
							
							<li class="last">
								<a href="<?php echo base_url(); ?>login/logout">
									<i class="fa-lock"></i>
									Logout
								</a>
							</li>
					</ul>
				</li>
				
				</ul>
			</div>
		
	</nav>
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
			
		<!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
		<!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
		<!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
		<div class="sidebar-menu toggle-others fixed">
			
			<div class="sidebar-menu-inner">	
			<?php if(isset($_GET['menu'])!=1){  ?>		
				<ul id="main-menu" class="main-menu hr">
					<!-- add class "multiple-expanded" to allow multiple submenus to open -->
					<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
					<li>
						<a href="<?php echo base_url(); ?>Master/profileList">
							<i class="linecons-lightbulb" title="Dashboard"></i>
							<span class="title" >Profile List</span>
						</a>
					</li>
				</ul>
					
				<!--	<li><a href="<?=base_url()?>role/user_role"> <i class="linecons-t-shirt" title="User Management"></i><span class="title" >User Management</span></a></li>
					<li><a href="<?=base_url()?>role/role_management"> <i class="linecons-comment" title="Role Management"></i><span class="title" >Role Management</span></a></li> -->
				</ul>
				<?php }else{?>
				
				<!--  ul start for sales -->
				
				<?php if(empty($_GET['menu']=="sales")!=1){  ?>
				<ul id="main-menu" class="main-menu sales">
					<!-- add class "multiple-expanded" to allow multiple submenus to open -->
					<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
						<li>
						<a href="<?php echo base_url(); ?>home">
							<i class="linecons-lightbulb"></i>
							<span class="title">Dashboard</span>
						</a>
					
					</li>
					<li>
						<a href="javascript:;">
							<i class="linecons-money"></i>
							<span class="title">Sales</span>
						</a>
						<ul>
							<li class="javascript:;">
								<a href="javascript:;">
									<span class="title">Customers</span>
								</a>
							</li>
							<li class="">
								<a href="<?php echo base_url();?>crm/product/manage_product">
									<span class="title">Products</span>
								</a>
							</li>
							<li class="">
								<a href="javascript:;">
									<span class="title">Inquiry</span>
								</a>
							</li>
							<li class="">
								<a href="javascript:;">
									<span class="title">Quotation</span>
								</a>
							</li>
							<li class="">
								<a href="javascript:;">
									<span class="title">Sales Order</span>
								</a>
							</li>
								<li class="">
								<a href="javascript:;">
									<span class="title">Delivery</span>
								</a>
							</li>
							<li class="">
								<a href="javascript:;">
									<span class="title">Invoice</span>
								</a>
							</li>
							<li class="">
								<a href="javascript:;">
									<span class="title">Contract Order</span>
								</a>
							</li>
						</ul>
					</li>
				</ul>
				<?php }?>
				
				<!--  ul End for sales -->
				
				<!--  ul End for crm -->
				<?php if(empty($_GET['menu']=="crm")!=1 || $this->uri->segment(2)=="crm"){  ?>
				<ul  class="main-menu crm">
					<!-- add class "multiple-expanded" to allow multiple submenus to open -->
					<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
						<li>
						<a href="<?php echo base_url(); ?>home">
							<i class="linecons-lightbulb"></i>
							<span class="title">Dashboard</span>
						</a>
					
					</li>
						<li class="javascript:;">
								<a href="<?php echo base_url(); ?>crm/crm/customers">
								<i class="linecons-user"></i>
									<span class="title">Customers</span>
								</a>
							</li>
							<li class="javascript:;">
								<a href="<?php echo base_url(); ?>crm/product/manage_product">
								<i class="linecons-user"></i>
									<span class="title">Products</span>
								</a>
							</li>
									<li class="javascript:;">
								<a href="<?php echo base_url(); ?>crm/crm/customequick">
								<i class="linecons-user"></i>
									<span class="title">Quick Lead</span>
								</a>
							</li>
							<li class="javascript:;">
								<a href="javascript:;">
								<i class="linecons-lightbulb"></i>
									<span class="title">Leads</span>
								</a>
							</li>
							<li class="">
								<a href="<?php echo base_url(); ?>crm/crm/manage_opportunities">
								<i class="linecons-lightbulb"></i>
									<span class="title">Opportunity</span>
								</a>
							</li>
							<li class="">
								<a href="javascript:;">
								<i class="linecons-lightbulb"></i>
									<span class="title">Campaign</span>
								</a>
							</li>
							<li class="">
								<a href="javascript:;">
								<i class="linecons-lightbulb"></i>
									<span class="title">Help Desk</span>
								</a>
							</li>
							<li class="">
								<a href="javascript:;">
								<i class="linecons-lightbulb"></i>
									<span class="title">Reporting</span>
								</a>
							</li>
						
					
				</ul>
			<?php }?>
				<!--  ul End for crm -->
				
				<!--  ul End for marketing -->
				<?php if(empty($_GET['menu']=="purchasing")!=1){  ?>
				<ul id="main-menu" class="main-menu purchasing">
					<!-- add class "multiple-expanded" to allow multiple submenus to open -->
					<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
						<li>
						<a href="<?php echo base_url(); ?>home">
							<i class="linecons-lightbulb"></i>
							<span class="title">Dashboard</span>
						</a>
					
					</li>
					<li>
						<a href="javascript:;">
							<i class="linecons-params"></i>
							<span class="title">Purchasing</span>
						</a>
							<ul>
							<li class="javascript:;">
								<a href="javascript:;">
									<span class="title">RFQ</span>
								</a>
							</li>
							<li class="">
								<a href="javascript:;">
									<span class="title">Purchase Order</span>
								</a>
							</li>
							<li class="">
								<a href="javascript:;">
									<span class="title">Receipt</span>
								</a>
							</li>
							<li class="">
								<a href="javascript:;">
									<span class="title">Payment Invoice</span>
								</a>
							</li>
								<li class="">
								<a href="javascript:;">
									<span class="title">Vendor Supplier</span>
								</a>
							</li>
								<li class="">
								<a href="javascript:;">
									<span class="title">Material</span>
								</a>
							</li>
						</ul>
					</li>
				</ul>
				<?php }?>
				<!--  ul End for marketing -->
				
		
				
				<!--  ul End for inventory -->
				<?php if(empty($_GET['menu']=="inventory")!=1){  ?>
				<ul id="main-menu" class="main-menu inventory">
					<!-- add class "multiple-expanded" to allow multiple submenus to open -->
					<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
					<li>
						<a href="<?php echo base_url(); ?>home">
							<i class="linecons-lightbulb"></i>
							<span class="title">Dashboard</span>
						</a>
					
					</li>
					<li>
						<a href="javascript:;">
							<i class="linecons-cog"></i>
							<span class="title">Inventory </span>
						</a>
						<ul>
							<li class="javascript:;">
								<a href="javascript:;">
									<span class="title">Stock Status </span>
								</a>
							</li>
							<li class="javascript:;">
								<a href="javascript:;">
									<span class="title">Item Movements</span>
								</a>
							</li>
							<li class="javascript:;">
								<a href="javascript:;">
									<span class="title">Stock Transfer</span>
								</a>
							</li>
							<li class="javascript:;">
								<a href="javascript:;">
									<span class="title">Reporting</span>
								</a>
							</li>
						</ul>
					</li>
					
						
				</ul>
				<?php }?>
				<!--  ul End for inventory -->
						<!--  ul End for payable -->
						<?php if(empty($_GET['menu']=="report")!=1){  ?>
				<ul id="main-menu" class="main-menu reporting">
					<!-- add class "multiple-expanded" to allow multiple submenus to open -->
					<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
						<li>
						<a href="<?php echo base_url(); ?>home">
							<i class="linecons-lightbulb"></i>
							<span class="title">Dashboard</span>
						</a>
					
					</li>
					<li>
						<a href="javascript:;">
							<i class="linecons-diamond"></i>
							<span class="title">Reporting</span>
						</a>
						
					</li>
						
				</ul>
				<?php  }}?>
				</div>
				<!--  ul End for payable -->
			
		
		</div>

<div class="main-content"  id="element">


				
			
			
			
			
			
	
