<?php
$app = Slim\Slim::getInstance();
if(isset($_SESSION['role']))
{
	
	if($_SESSION['role'] != 1 && $_SESSION['role'] != 2){
	
		if($_SESSION['user_id'] != $user['account_no'] )
		{
		
			$app->redirect('../../error');
		
		}
	}	

 $pagename = "Update Account"; 
 include 'view/header_dash.php';
 ?>
<!doctype html>
<body>

	 <?php if($_SESSION['role'] == 1 || $_SESSION['role'] == 2){ ?>

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
				<article class="breadcrumbs"><a href="../../dashboard/admin/<?php echo $_SESSION['user_id'];?>">Dashboard</a><div class="breadcrumb_divider"></div> <a href="../../dashboard/user_details/<?php echo $_SESSION['user_id'];?>" class="current">Update Account</a> </article>
			</div>
		</section><!-- end of secondary bar -->
	 <?php } else {?>

		<header id="header">
			<hgroup>
				<h1 class="site_title">Bank of Rory - <a href="../../dashboard/user/<?php echo($user['account_no']);?>">Dashboard</a></h1>
				<h2 class="section_title">&nbsp;</h2><div class="btn_view_site"><a href="../../dashboard/user_details/<?php echo($user['account_no']);?>"><?php echo $_SESSION['fname'].' '.$_SESSION['lname']?></a></div>
				</h2><div class="btn_view_site"><a href="../../logout">Log Out</a></div>
			</hgroup>
		</header> <!-- end of header bar -->
		
		<section id="secondary_bar">
			<div class="user">
			</div>
			<div class="breadcrumbs_container">
				<article class="breadcrumbs"><a href="../../dashboard/user/<?php echo($user['account_no']);?>">Dashboard</a><div class="breadcrumb_divider"></div> <a href="../../dashboard/user_details/<?php echo($user['account_no']);?>" class="current">Update Account</a> </article>
			</div>
		</section><!-- end of secondary bar -->
	<?php }?>
	<?php  require 'view/side_bar.php';?> 

	
	<section id="main" class="column">
	<?php if($_SESSION['role'] == 1){ ?>	
	<div class="clear"></div><!-- end of post new article --> 
	<article class="module width_full">
		  <header><h3>Update Account Type</h3></header>
				<div class="module_content">
					<h1>Update Account Type</h1>
					
					<p>Please choose the account type. <em>Current account type is selected</em></p>
					
					<form class="form-horizontal" role="form"  method="POST" action="../../dashboard/account_type/<?php echo($user['account_no']);?>">
							<input type="hidden" name="_METHOD" value="PUT"/>
						   <table class="view_table">
						  
						   <tr>
						  <div class="form-group">
							<th><label for="input_account" class="col-sm-2 control-label">Account Type</label></th>
							<td><select name="input_account">
							
							<?php foreach ($account_types as $type) : ?>
								
								<?php if($user['account_type_id'] == $type['id'] ){ ?>
									<option value="<?php echo $type['id'];?>" selected><?php echo $type['type'];?></option>
								  <?php }else{?>
									<option value="<?php echo $type['id'];?>"><?php echo $type['type'];?></option>
							<?php } endforeach; ?>	  
							</select></td>
							
						  </div>
						  </tr>
						  
						   <tr>
							<td>
						  <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" class="btn btn-lg btn-primary btn-block">Update Account Type</button>
							</div>
						  </div>
						  </td>
						<td></td>
						   </tr>
						  </table>
					</form>
					
					
				</div>
				<p>&nbsp;</p>
				
	  </article><!-- end of styles article -->
	  	<div class="clear"></div><!-- end of post new article --> 
	<article class="module width_full">
		  <header><h3>Update Balance</h3></header>
				<div class="module_content">
					<h1>Update Balance</h1>
					
					<p>Please enter a new balance for this user. <em>Changes should only be done due to Error</em></p>
					<p>Balance changes are noted in the account transaction history</p>
					<p>&nbsp;</p>
					<h3>Current Balance: &nbsp;&euro; <?php echo($user['balance']);?></h3>
					
					<?php if (isset($myerror_bal)) { ?>
							<div class="alert alert-danger" role="alert">
									<p class="alert-link error_message">Error: <?php echo $myerror_bal['error'];?> </p>
							</div>
					<?php }  ?>	
					<form class="form-horizontal" role="form"  method="POST" action="../../dashboard/update_balance/<?php echo($user['account_no']);?>">
						
							<input type="hidden" name="account_num" value="<?php echo $user['id'];?>"/>
						   <table class="view_table">
						  
						   <tr>
						  <div class="form-group">
							<th><label for="balance" class="col-sm-2 control-label">Change Balance To </label></th>
							<td>&euro; &nbsp;<input type="text" class="form-control" name="balance" placeholder="New Balance" required></td>
							
						  </div>
						  </tr>
						  
						   <tr>
							<td>
						  <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" class="btn btn-lg btn-primary btn-block">Update Balance</button>
							</div>
						  </div>
						  </td>
						<td></td>
						   </tr>
						  </table>
					</form>
					
					
				</div>
				<p>&nbsp;</p>
				
	  </article><!-- end of styles article -->
	<?php } ?>	  
	  <div class="clear"></div><!-- end of post new article -->

		<article class="module width_full">
		  <header><h3>Update Account</h3></header>
				<div class="module_content">
					<h1>Update Account</h1>
					<?php if (isset($myerror_up)) { ?>
							<div class="alert alert-danger" role="alert">
									<p class="alert-link error_message">Error: <?php echo $myerror_up['error'];?> </p>
							</div>
					<?php }  ?>	

					<form class="form-horizontal" role="form"  method="POST" action="../../dashboard/update/<?php echo($user['account_no']);?>">
							<input type="hidden" name="_METHOD" value="PUT"/>
						   <table class="view_table">
						   <tr>
						  <div class="form-group">
							<th><label for="inputEmail3" class="col-sm-2 control-label">Username/Email</label></th>
							<td><input type="email" class="form-control" name="inputEmail3" value="<?php echo($user['email']);?>" disabled></td>
						  </div>
						  </tr>
						  <tr>
						  <div class="form-group">
							<th><label for="input_fname" class="col-sm-2 control-label">First Name</label></th>
							<td><input type="text" class="form-control" name="input_fname" value="<?php echo($user['first_name']);?>" required></td>
							
						
						  </div>
						  </tr>
						   <tr>
						  <div class="form-group">
							<th><label for="input_lname" class="col-sm-2 control-label">Last Name</label></th>
							<td><input type="text" class="form-control" name="input_lname" value="<?php echo($user['last_name']);?>" required></td>
							
							
						  </div>
						   </tr>
						   <tr>
						  <div class="form-group">
							<th><label for="input_age" class="col-sm-2 control-label">Age</label></th>
							<td><input type="text" class="form-control" name="input_age" value="<?php echo($user['age']);?>" required></td>
							</div>
							 </tr>
						   <tr>
						 
						  <div class="form-group">
							<th><label for="input_street" class="col-sm-2 control-label">Street</label></th>
							<td><input type="text" class="form-control" name="input_street" value="<?php echo($user['street']);?>" required></td>
							
						  </div>
						   </tr>
						   <tr>
						
						  <div class="form-group">
							<th><label for="input_city" class="col-sm-2 control-label">City</label></th>
							<td><input type="text" class="form-control" name="input_city" value="<?php echo $user['city'];?>" required></td>
							
							
							 
						  </div>
						   </tr>
						   <tr>
						  <div class="form-group">
							<th><label for="input_country" class="col-sm-2 control-label">Country</label></th>
							<td><input type="text" class="form-control" name="input_country" value="<?php echo $user['country'];?>" required></td>
							
						  </div>
						  </tr>
						   <tr>
							<td>
						  <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" class="btn btn-lg btn-primary btn-block">Update Account</button>
							</div>
						  </div>
						  </td>
						<td></td>
						   </tr>
						  </table>
					</form>
					<?php if (isset($myerror)) { ?>
								<div class="alert alert-danger" role="alert">
										<p class="alert-link error_message">Error: <?php echo $myerror['error'];?> </p>
								</div>
					<?php }  ?>	
					<form class="form-signin" role="form" action="../../dashboard/update/<?php echo($user['account_no']);?>" method="POST">
					  <div class="form-group form-group-lg">
						<div class="col-sm-offset-2 col-sm-10">
						  <input type="hidden" name="_METHOD" value="DELETE"/>
						  <input type="hidden" name="account_no" value="<?php echo $user['id'];?>"/>
						  <button type="submit" onclick="return confirm('Deleting your account will delete all transactions and account information. Are you sure you would like to delete your account?');" class="btn btn-lg btn-primary btn-block">Delete Account</button>
						</div>
					  </div>
					</form>
				</div>
				<p>&nbsp;</p>
				<?php if($_SESSION['role'] != 1 && $_SESSION['role'] != 2){ ?>
					<h3>Quick Links <a href="../../dashboard/user_deposit/<?php echo($user['account_no']);?>">Deposit Money</a>&nbsp;&nbsp;
					<a href="../../dashboard/user_withdrawal/<?php echo($user['account_no']);?>">Withdraw Money</a>&nbsp;&nbsp;
					<a href="../../dashboard/user_history/<?php echo($user['account_no']);?>">Account History</a> </h3>
					
					
				<?php }?>
	  </article><!-- end of styles article -->
		<div class="spacer"></div>
		<article class="module width_full">
			  <header><h3>Update Account Password</h3></header>
					<div class="module_content">
						<h1>Update Account Password</h1>
						
						<p>Please enter a new passowrd.</p>
						<?php if (isset($myerror_pas)) { ?>
							<div class="alert alert-danger" role="alert">
									<p class="alert-link error_message">Error: <?php echo $myerror_pas['error'];?> </p>
							</div>
						<?php }  ?>	
					<form class="form-horizontal" role="form"  method="POST" action="../../dashboard/account_pass/<?php echo($user['account_no']);?>">
						
						<input type="hidden" name="_METHOD" value="PUT"/>
						
						   <table class="view_table">
						  
						  
								
								<tr>
							  <div class="form-group">
								<th><label for="input_pass" class="col-sm-2 control-label">Password</label></th>
								<td><input type="password" class="form-control" name="input_pass" placeholder="New Password" required></td>
								
							  </div>
							  </tr>
							  <tr>
							  <div class="form-group">
								<th><label for="input_cpass" class="col-sm-2 control-label">Confirm New Password</label></th>
								<td><input type="password" class="form-control" name="input_cpass" placeholder="Confirm New Password" required></td>
								 <input type="hidden" name="inputEmail3" value="<?php echo($user['email']);?>">
							  </div>
							   </tr>
						  
						   <tr>
							<td>
						  <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" class="btn btn-lg btn-primary btn-block">Update Account Password</button>
							</div>
						  </div>
						  </td>
						<td></td>
						   </tr>
						  </table>
					</form>
						
						
					</div>
					<p>&nbsp;</p>
					
		  </article><!-- end of styles article -->
	  
	  <div class="clear"></div><!-- end of post new article -->
	<div class="spacer"></div>
	</section>

<?php include 'view/footer_dash.php'; 

}else{
		
		$app->redirect('../../error');
		
}


?>

