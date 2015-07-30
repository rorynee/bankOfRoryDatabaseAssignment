<?php
$app = Slim\Slim::getInstance();
if(isset($_SESSION['role']))
{
	
	if($_SESSION['role'] != 1){
	
		if($_SESSION['user_id'] != $user['account_no'] )
		{
		
			$app->redirect('../../error');
		
		}
	}	

 $pagename = "Dashboard"; 
 include 'view/header_dash.php';
 ?>
<!doctype html>
<body>
	 <?php if($_SESSION['role'] == 1 || $_SESSION['role'] == 2){ ?>

		<header id="header">
			<hgroup>
				<h1 class="site_title">Bank of Rory - <a href="../../dashboard/admin/<?php echo($_SESSION['user_id']);?>">Dashboard</a></h1>
				<h2 class="section_title">&nbsp;</h2><div class="btn_view_site"><a href="../../dashboard/user_details/<?php echo($user['account_no']);?>"><?php echo $_SESSION['fname'].' '.$_SESSION['lname']?></a></div>
				</h2><div class="btn_view_site"><a href="../../logout">Log Out</a></div>
			</hgroup>
		</header> <!-- end of header bar -->
		
		<section id="secondary_bar">
			<div class="user">
			</div>
			<div class="breadcrumbs_container">
				<article class="breadcrumbs"><a class="current" href="../../dashboard/admin/<?php echo $_SESSION['user_id'];?>">Dashboard</a> </article>
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
				<article class="breadcrumbs"><a class="current" href="../../dashboard/user/<?php echo($user['account_no']);?>">Dashboard</a> </article>
			</div>
		</section><!-- end of secondary bar -->
	 
	 <?php }?>
	

	<?php  require 'view/side_bar.php';?> 
	<section id="main" class="column">
	 
	  <div class="clear"></div><!-- end of post new article -->

	   <?php if($_SESSION['role'] == 1 || $_SESSION['role'] == 2){ ?>
	    <article class="module width_full">
		  <header><h3>List Accounts</h3></header>
				<div class="module_content">
					<h1>Account History</h1>
					<table class="view_table">
						<tr>
							<td><p><strong>Role:</strong></p></td><td>  <?php 
						if($_SESSION['role'] == 1){
							echo "Admin Role";
						}else if($_SESSION['role'] == 2){
							echo "Support Role";
						}?></td>
						</tr>
						<tr>
							<td><p><strong>Account Number:</strong></p></td><td><?php echo($user['id']);?></td>
						</tr>
						<tr>
							<td><p><strong>First Name:</strong></p></td><td><?php echo($user['first_name']);?></td>
						</tr>
						<tr>
							<td><p><strong>Last Name:</strong></p></td><td> <?php echo($user['last_name']);?></td>
						</tr>
						<tr>
							<td><p><strong>Username/Email:</strong></p></td><td> <?php echo($user['email']);?></td>
						</tr>
						<tr>
							<td><p><strong>Address:</strong></p></td><td>  <?php echo($user['street'].', '.$user['city'].', '.$user['country']);?></td>
						</tr>					
						
						</table>
						
						<p>Click here to <a href="../../dashboard/user_details/<?php echo($user['account_no']);?>">Update Account</a></p>
				</div>
					
	  </article><!-- end of styles article -->
	  <div class="spacer"></div>
	  <article class="module width_full">
		  <header><h3>Account Overview</h3></header>
				<div class="module_content">
					<h1>Account Overview</h1>
					<p>Below is a list of all the present accounts</p>
					
					
					
					<table id="data_table_sort" class="display">
						<thead>
							<tr>
								<th>A/C No.</th>
								<th>A/C Type</th>
								<th>A/C Holders Name</th>
								<th>Age</th>
								<th>Country of Residence</th>
								<th>Balance</th>
								<th>Show Details</th>
								<th>Show History</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($accounts as $account) : ?>
								<tr>
									<td><?php echo $account['id']; ?></td>
									<td><?php
										
										if($account['account_type_id'] == 1){
											echo "<p id=\"account_current\">Current Account</p>";
										}else{
											echo "<p id=\"account_student\">Student Account</p>";
										}
									?></td>
									<td><?php echo $account['first_name'].' '.$account['last_name']; ?></td>
									<td><?php echo $account['age']; ?></td>
									<td><?php echo $account['country']; ?></td>
									<td>&euro; <?php echo $account['balance']; ?></td>
									<td>
										<form action="../../dashboard/user_details/<?php echo $account['account_no'];?>" method="GET">
											<input type="submit" value="Update" />
										</form>
									</td>
									<td>
										<form action="../../dashboard/user_history/<?php echo $account['account_no']?>" method="GET">
											<input type="submit" value="History" />
										</form>
									</td>
									
								</tr>
							<?php endforeach; ?>	
						</tbody>
					</table>

				
			
				</div>
				
					
					
				
	  </article><!-- end of styles article -->
	   
	   
	   
	  <?php } else {?>
	  
			 <article class="module width_full">
			  <header><h3>Account Overview</h3></header>
					<div class="module_content">
						<h1>Account Overview</h1>
						<?php if (isset($user)) { ?>
						<table class="view_table">
						<tr>
						<td><p><strong>Account Number:</strong></p></td><td><?php echo($user['id']);?></td>
						</tr>
						<tr>
						<td><p><strong>First Name:</strong></p></td><td><?php echo($user['first_name']);?></td>
						</tr>
						<tr>
						<td><p><strong>Last Name:</strong></p></td><td> <?php echo($user['last_name']);?></td>
						</tr>
						<tr>
						<td><p><strong>Username/Email:</strong></p></td><td> <?php echo($user['email']);?></td>
						</tr>
						<tr>
						<td><p><strong>Age:</strong></p></td><td>  <?php echo($user['age']);?></td>
						</tr>
						<tr>
						<td><p><strong>Address:</strong></p></td><td>  <?php echo($user['street'].', '.$user['city'].', '.$user['country']);?></td>
						</tr>
						<tr>
						<td><p><strong>Balance:</strong></p></td><td>&euro; <?php echo($user['balance']);?></td>
						</tr>
						<tr>
						<td><p><strong>Account Type:</strong></p></td><td>
						<?php 
							if($user['account_type_id'] == 1){
								echo "Current Account";
							}else{
								echo "Student Account";
							}
						?></td>
						</tr>
						</table>
						<?php }?>
						<div class="spacer"></div>
						
						<h3>Quick Links <a href="../../dashboard/user_deposit/<?php echo($user['account_no']);?>">Deposit Money</a>&nbsp;&nbsp;
						<a href="../../dashboard/user_withdrawal/<?php echo($user['account_no']);?>">Withdraw Money</a>&nbsp;&nbsp;
						<a href="../../dashboard/user_history/<?php echo($user['account_no']);?>">Account History</a> </h3>
						
						
					</div>
		  </article><!-- end of styles article -->
	  <?php }?>
		<div class="spacer"></div>

	</section>

<?php include 'view/footer_dash.php'; 

}else{
		
		$app->redirect('../../error');
		
}


?>

