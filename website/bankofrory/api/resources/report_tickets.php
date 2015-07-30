<?php
$app = Slim\Slim::getInstance();
if(isset($_SESSION['role']))
{
	if($_SESSION['role'] == 1){
	

 $pagename = "Reports - Customer Tickets"; 
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
				<article class="breadcrumbs"><a href="../../dashboard/admin/<?php echo $_SESSION['user_id'];?>">Dashboard</a><div class="breadcrumb_divider"></div> <a href="../../dashboard/customer_tickets/<?php echo $_SESSION['user_id'];?>" class="current">Reports - Customer Tickets</a> </article> </article>
			</div>
		</section><!-- end of secondary bar -->
	 
	<?php  require 'view/side_bar.php';?>
	<section id="main" class="column">

	  <div class="clear"></div><!-- end of post new article -->

		<article class="module width_full">
		  <header><h3>Reports - Customer Tickets</h3></header>
				<div class="module_content">
					<h1>Reports - Customer Tickets</h1>
					
					
					<p>The report below shows a list of customes who have tickets in the ticket system.<br/>
					If an account number is missing then they do not have any tickets in the ticket system.</p>
					 
					 <p>&nbsp;</p>
					 
					<table id="data_table" class="display">
						<thead>
							<tr>
								<th>A/C No.</th>
								<th>Name</th>
								<th>Country</th>
								<th>A/C Type</th>
								<th>No. of Tickets</th>
								
							</tr>
						</thead>
						<tbody>
							<?php foreach ($ticket_info as $ticket) : ?>
								<tr>
									<td><?php echo $ticket['id']; ?></td>
									<td><?php echo $ticket['first_name'];?> <?php echo $ticket['last_name'];?></td>
									<td><?php echo $ticket['country']; ?></td>
									<td><?php
										
										if($ticket['type'] == 'Current'){
											echo "<p id=\"account_current\">Current Account</p>";
										}else{
											echo "<p id=\"account_student\">Student Account</p>";
										}
									?>
									
									</td>
									<td><?php echo $ticket['tickets']; ?></td>
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