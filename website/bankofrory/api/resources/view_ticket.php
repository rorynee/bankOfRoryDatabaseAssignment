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

 $pagename = "Help Desk - View Ticket"; 
 include 'view/header_dash.php';
 ?>
<!doctype html>
<body>
	
	
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
				<article class="breadcrumbs"><a href="../../dashboard/user/<?php echo($user['account_no']);?>">Dashboard</a><div class="breadcrumb_divider"></div> <a href="../../dashboard/view_ticket/<?php echo($user['account_no']);?>" class="current">Help Desk - View Ticket</a> </article>
			</div>
		</section><!-- end of secondary bar -->
	<?php  require 'view/side_bar.php';?> 

	
	<section id="main" class="column">
		
	  
		
	  <div class="clear"></div><!-- end of post new article -->

		<article class="module width_full">
		  <header><h3>Help Desk - View Ticket</h3></header>
				<div class="module_content">
					<h1>Help Desk - View Ticket</h1>
				
				<p>Shown below is a list of your support tickets that you have sent to our help desk department.</p>
				<p><em>please note you can search by a field by entering the value into the search box.</em></p>
				<?php if (!isset($tickets)) { ?>
						<div class="alert alert-danger" role="alert">
								<p class="alert-link error_message">No Tickets Available </p>
						</div>
                <?php }  ?>	
				<table id="data_table" class="display">
						<thead>
							<tr>
								
								<th>Date</th>
								<th>Message</th>
								<th>Read More</th>
								<th>Area</th>
								<th>Priority</th>
								<th>Status</th>
								<th>Response</th>
								<th>Read More</th>
							</tr>
						</thead>
						<tbody>
						
							<?php 
								  
								if (isset($tickets)) {
								
								foreach ($tickets as $ticket) : ?>
									<tr>
										
										<td><?php echo date('Y-m-d', $ticket['ts']->sec); ?></td>
										<td><?php echo substr($ticket['message'], 0, 20).'...'; ?></td>
										<td><button onclick='fullMessage("<?php echo htmlentities($ticket['message'], ENT_QUOTES); ?>")'>Read More</button></td>
										<td><?php echo $ticket['area']; ?></td>
										<td><?php echo $ticket['priority']; ?></td>
										<td><?php if($ticket['status'] == 'Open'){
											echo '<p id="status_open">'.$ticket['status'].'</p>';
										}else if($ticket['status'] == 'Review'){
											echo '<p id="status_review">'.$ticket['status'].'</p>';
										}else{
											echo '<p id="status_closed">'.$ticket['status'].'</p>'; 
										}?></td>
									<?php if(isset($ticket['response'])){ ?>
											<td><?php echo substr($ticket['response'], 0, 20).'...'; ?></td>
											<td><button onclick='fullMessage("<?php echo htmlentities($ticket['response'], ENT_QUOTES); ?>")'>More</button></td>
													
										<?php		}else{ ?>
											<td> <p>&nbsp;</p> </td>
											<td> <p>&nbsp;</p> </td>
										<?php		} ?>
											
									</tr>
								<?php endforeach; 
							}?>
							
						</tbody>
				</table>
				
				
			
         </div>
        <p>&nbsp;</p>
					<h3>Quick Links <a href="../../dashboard/user_deposit/<?php echo($user['account_no']);?>">Deposit Money</a>&nbsp;&nbsp;
					<a href="../../dashboard/user_withdrawal/<?php echo($user['account_no']);?>">Withdraw Money</a>&nbsp;&nbsp;
					<a href="../../dashboard/user_history/<?php echo($user['account_no']);?>">Account History</a> </h3>
					
					
				</div>
	  </article><!-- end of styles article -->
		<div class="spacer"></div>

	</section>

<?php include 'view/footer_dash.php'; 

}else{
		
		$app->redirect('../../error');
		
}

