<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="stylesheet" href="assets/css/custom.css">
	<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
</head>
	<body>
		<section class="container">
   			<div class="login">
   			<?php  if($this->session->flashdata('category_error')) { ?>
		<div class="row-fluid"> 
			<div class="alert alert-danger">
				<strong><?=$this->session->flashdata('message')?></strong> 
			</div>
		</div>
		<?php } ?>
		<?php  if($this->session->flashdata('category_success')) { ?>
			<div class="row-fluid">
				<div class="alert alert-success">
					<strong><?=$this->session->flashdata('message')?></strong>
				</div>
			</div>
		<?php } ?>
   			     <h1 style="color:white; margin-left:120px;font-style:italic; ">Login Life Partner</h1>
   			
				<form  method="POST" action="<?=base_url();?>login/verifyUser_Info">
					 <p>
					 	<input class="input" type="text" name="username" value="" placeholder="Username or Email">
					 </p>
			 		 <p>
			  			<input class="input" type="password" name="password" value="" placeholder="Password">
			  		</p>
			 		<p class="remember_me">
         				<label>
           					 <input type="checkbox" name="remember_me" id="remember_me">
          					  Remember me on this computer
         				 </label>
       				 </p>
        			<p class="submit">
        				<button class="button button-block">Log In</button>
        			</p>
    			</form>
			</div>
			<div class="login-help">
				<p>Forgot your password? <a href="">Click here to reset it</a>.</p>
			</div>
		</section>
	</body>
</html>

