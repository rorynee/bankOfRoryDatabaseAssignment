<?php

// Used to Keep unregestered users out of the backend
// also used to keep the user in their own section
$app = Slim\Slim::getInstance();
if(isset($_SESSION['role']))
{
	if($_SESSION['role'] == 1){
	

 $pagename = "Add New Account"; 
 include 'view/header_dash.php';
 ?>
<!doctype html>
<body>
		<header id="header">
			<hgroup>
				<h1 class="site_title">Bank of Rory - <a href="../../dashboard/admin/<?php echo($_SESSION['user_id']);?>">Dashboard</a></h1>
				<h2 class="section_title">&nbsp;</h2><div class="btn_view_site"><a href="../../dashboard/user_details/<?php echo $_SESSION['user_id'];?>"><?php echo $_SESSION['fname'].' '.$_SESSION['lname']?></a></div>
				</h2><div class="btn_view_site"><a href="../../logout">Log Out</a></div>
			</hgroup>
		</header> <!-- end of header bar -->
		
		<section id="secondary_bar">
			<div class="user">
			</div>
			<div class="breadcrumbs_container">
				<article class="breadcrumbs"><a href="../../dashboard/admin/<?php echo $_SESSION['user_id'];?>">Dashboard</a><div class="breadcrumb_divider"></div> <a href="../../dashboard/add_account/<?php echo $_SESSION['user_id'];?>" class="current">Add New Account</a> </article> </article>
			</div>
		</section><!-- end of secondary bar -->
	 
	<?php  require 'view/side_bar.php';?>
	<section id="main" class="column">

	  <div class="clear"></div><!-- end of post new article -->

		<article class="module width_full">
		  <header><h3>Add New Account</h3></header>
				<div class="module_content">
					<h1>Add New Account</h1>
					<p>Please fill out the details below to create a new account</p>
					
					<div>
						<?php if (isset($myerror)) { ?>
								<div class="alert alert-danger" role="alert">
										<p class="alert-link error_message">Error: <?php echo $myerror['error'];?> </p>
								</div>
						<?php }  ?>	
						<form class="form-horizontal" role="form" method="POST" action="../../dashboard/add_account/<?php echo $_SESSION['user_id']?>">
						<table class="view_table">
						
			
						
						  <tr> 
						  <div class="form-group">
							<th><label for="inputEmail4" class="col-sm-2 control-label">Username/Email</label></th>
							<td><input type="email" class="form-control" name="inputEmail4" placeholder="Email Address" required autofocus></td>
						  </div>
						  </tr>
						  <tr>
						  <div class="form-group">
							<th><label for="input_fname" class="col-sm-2 control-label">First Name</label></th>
							
							  <td><input type="text" class="form-control" name="input_fname" placeholder="First Name" required></td>
							
							
						  </div>
						  </tr>
						  <tr>
						  <div class="form-group ">
							<th><label for="input_lname" class="col-sm-2 control-label">Last Name</label></th>
							
							 <td> <input type="text" class="form-control" name="input_lname" placeholder="Last Name" required></td>
							
							
						  </div>
						  </tr>
						  <tr>
						  
						  <div class="form-group ">
							<th><label for="input_age" class="col-sm-2 control-label">Age</label></th>
							
							  <td><input type="text" class="form-control" name="input_age" placeholder="Age" required></td>
						
						  </div>
						  </tr>
						  <tr>
						 
						  <div class="form-group">
							<th><label for="input_street" class="col-sm-2 control-label">Street</label></th>
							
							  <td><input type="text" class="form-control" name="input_street" placeholder="Street" required></td>
							
						  </div>
						  </tr>
						  <tr>
						 
						  <div class="form-group">
							<th><label for="input_city" class="col-sm-2 control-label">City</label></th>
							
							  <td><input type="text" class="form-control" name="input_city" placeholder="City" required></td>
							
							
						  </div>
						  </tr>
						  <tr>
						  <div class="form-group">
							<th><label for="input_country" class="col-sm-2 control-label">Country</label></th>
							
							  <td><input type="text" class="form-control" name="input_country" placeholder="Country" required></td>
							
						  </div>
						  </tr>
						  <tr>
						  
						  <div class="form-group">
							<th><label for="input_pass" class="col-sm-2 control-label">Password</label></th>
							
							  <td><input type="password" class="form-control" name="input_pass" placeholder="Password" required></td>
							
						  </div>
						  </tr>
						  <tr>
						  
						  <div class="form-group">
							<th><label for="input_cpass" class="col-sm-2 control-label">Confirm Password</label></th>
							
							  <td><input type="password" class="form-control" name="input_cpass" placeholder="Confirm Password" required></td>
							
						  </div>
						  </tr>
						  <tr>
						  
						  <td><div class="form-group form-group-lg">
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" class="btn btn-lg btn-primary btn-block">Create Account</button>
							</div>
						  </div></td>
						  <td></td>
						  </tr>
						
						 </table>
						</form>
					 </div>
					 
					<p>&nbsp;</p>
					
					
				
			
				</div>
				<p>&nbsp;</p>
					
					
	  </article><!-- end of styles article -->
		<div class="spacer"></div>

	</section>

<?php include 'view/footer_dash.php'; 
	}else{
		$app->redirect('../../error');
	}

	
	}else{
		
		$app->redirect('../../error');
		
}


?>