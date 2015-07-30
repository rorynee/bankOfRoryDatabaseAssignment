<?php
$app = Slim\Slim::getInstance();
if(isset($_SESSION['role']))
{
	if($_SESSION['role'] == 1){
	

 $pagename = "Reports - Top Balances"; 
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
				<article class="breadcrumbs"><a href="../../dashboard/admin/<?php echo $_SESSION['user_id'];?>">Dashboard</a><div class="breadcrumb_divider"></div> <a href="../../dashboard/top_balances/<?php echo $_SESSION['user_id'];?>" class="current">Reports - Top Balances</a> </article> </article>
			</div>
		</section><!-- end of secondary bar -->
	 
	<?php  require 'view/side_bar.php';?>
	<section id="main" class="column">

	  <div class="clear"></div><!-- end of post new article -->

		<article class="module width_full">
		  <header><h3>Reports - Top Balances</h3></header>
				<div class="module_content">
					<h1>Reports - Top Balances</h1>
					
					
					<p>below is a list of all the top balance in the Bank Of Rory</p>
					
					<table id="data_table" class="display">
						<thead>
							<tr>
								<th>A/C No</th>
								<th>Name</th>
								<th>Country</th>
								<th>A/C Type</th>
								<th>No. of Transactions</th>
								<th>Balance</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($balances as $bal) : ?>
								<tr>
									<td><?php echo $bal['id']; ?></td>
									<td><?php echo $bal['first_name'].' '.$bal['last_name']; ?></td>
									<td><?php echo $bal['country']; ?></td>
									<td><?php
										
										if($bal['type'] == 'Current'){
											echo "<p id=\"account_current\">Current Account</p>";
										}else{
											echo "<p id=\"account_student\">Student Account</p>";
										}
									?>
									
									</td>
									<td><?php echo $bal['no_of_trans']; ?></td>
									<td>&euro; <?php echo $bal['balance']; ?></td>
								</tr>
							<?php endforeach; ?>	
						</tbody>
					</table>
					
					
					
					
				
			
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