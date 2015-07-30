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

 $pagename = "Account History"; 
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
				<article class="breadcrumbs"><a href="../../dashboard/admin/<?php echo $_SESSION['user_id'];?>">Dashboard</a><div class="breadcrumb_divider"></div> <a href="../../dashboard/user_history/<?php echo($user['account_no']);?>" class="current">Account History</a> </article> </article>
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
				<article class="breadcrumbs"><a href="../../dashboard/user/<?php echo($user['account_no']);?>">Dashboard</a><div class="breadcrumb_divider"></div> <a href="../../dashboard/user_history/<?php echo($user['account_no']);?>" class="current">Account History</a> </article>
			</div>
		</section><!-- end of secondary bar -->
	
	<?php }?>
	<?php  require 'view/side_bar.php';?>
	<section id="main" class="column">
		
	  
		
	  <div class="clear"></div><!-- end of post new article -->

		<article class="module width_full">
		  <header><h3>Account History</h3></header>
				<div class="module_content">
					<h1>Account History</h1>
					<p>Below is a list of all your transactions</p>
					<p><strong>Account Number:</strong> <?php echo($user['id']);?></p>
					<p><strong>Name:</strong> <?php echo($user['first_name']);?> <?php echo($user['last_name']);?></p>
					<p><strong>Balance:</strong>  <?php echo($user['balance']);?></p>
					<p><strong>Account Type:</strong> 
					<?php 
						if($user['account_type_id'] == 1){
							echo "Current Account";
						}else{
							echo "Student Account";
						}
					?></p>
					
					<table id="data_table" class="display">
						<thead>
							<tr>
								<th>Transaction ID</th>
								<th>Date & Time</th>
								<th>Type</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($trans as $tran) : ?>
								<tr>
									<td><?php echo $tran['transaction_id']; ?></td>
									<td><?php echo $tran['transactions_time']; ?></td>
									<td><?php echo $tran['transaction_type']; ?></td>
									<td>&euro; <?php echo $tran['transaction_amount']; ?></td>
								</tr>
							<?php endforeach; ?>	
						</tbody>
					</table>

				
			
				</div>
				<p>&nbsp;</p>
				<?php if($_SESSION['role'] != 1 && $_SESSION['role'] != 2){ ?>
					<h3>Quick Links <a href="../../dashboard/user_deposit/<?php echo($user['account_no']);?>">Deposit Money</a>&nbsp;&nbsp;
					<a href="../../dashboard/user_withdrawal/<?php echo($user['account_no']);?>">Withdraw Money</a>&nbsp;&nbsp;
					<a href="../../dashboard/user_history/<?php echo($user['account_no']);?>">Account History</a> </h3>
				<?php }?>	
					
				
	  </article><!-- end of styles article -->
		<div class="spacer"></div>

	</section>

<?php include 'view/footer_dash.php'; 

}else{
		
		$app->redirect('../../error');
		
}


?>