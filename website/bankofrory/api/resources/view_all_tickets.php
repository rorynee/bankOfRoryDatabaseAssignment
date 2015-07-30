<?php
$app = Slim\Slim::getInstance();
if(isset($_SESSION['role']))
{
	
	if($_SESSION['role'] == 1 || $_SESSION['role'] == 2){
	


 $pagename = "Help Desk - View All Tickets"; 
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
				<article class="breadcrumbs"><a href="../../dashboard/admin/<?php echo $_SESSION['user_id'];?>">Dashboard</a><div class="breadcrumb_divider"></div> <a href="../../dashboard/view_all_tickets/<?php echo $_SESSION['user_id'];?>" class="current">Help Desk - View All Tickets</a> </article> </article>
			</div>
		</section><!-- end of secondary bar -->
	
		
	<?php  require 'view/side_bar.php';?> 

	
	<section id="main" class="column">
		
	  
		
	  <div class="clear"></div><!-- end of post new article -->

		<article class="module width_full">
		  <header><h3>Help Desk - View All Ticket</h3></header>
				<div class="module_content">
					<h1>Help Desk - View All Ticket</h1>
				
				<p>Shown below is a list of all the support tickets that have been sent to the help desk department.</p>
				<p><em>please note you can search by a field by entering the value into the search box.</em></p>
				<p>&nbsp;</p>
				<?php if (!isset($tickets)) { ?>
						<div class="alert alert-danger" role="alert">
								<p class="alert-link error_message">No Tickets Available </p>
						</div>
                <?php }  ?>	
				<table id="data_table" class="display">
						<thead>
							<tr>
								<th>A/C No.</th>
								<th>Date</th>
								<th>Message</th>
								<th>Read More</th>
								<th>Area</th>
								<th>Priority</th>
								<th>Status</th>
								<th>Response</th>
								<th>Delete</th>
								
							</tr>
						</thead>
						<tbody>
						
							<?php 
								  
								if (isset($tickets)) {
								
								foreach ($tickets as $ticket) : ?>
									<tr>
										<td><strong><?php echo $ticket['account_num']; ?></strong></td>
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
											<td><button onclick='fullMessage("<?php echo htmlentities($ticket['response'], ENT_QUOTES); ?>");'>View</button></td>
											
													
										<?php }else{ ?>
													<td>
														<form action="../../dashboard/ticket_reply/<?php echo $_SESSION['user_id'];?>" method="POST">
															<input type="hidden" name="ticket_id" value="<?php echo $ticket['_id'];?>">
															<input type="submit" value="Reply" />
														</form>
													</td>
													
										<?php	} ?>
										<?php if($ticket['status'] == 'Closed'){ ?>
											<td>
												<form action="../../dashboard/post_delete/<?php echo $_SESSION['user_id'];?>" method="POST">
													<input type="hidden" name="ticket_id" value="<?php echo $ticket['_id'];?>">
													<input type="submit" value="X" onclick="return confirm('Are you sure you want to delete this ticket?');" />
												</form>
											</td>	
										
										<?php  }else{ ?>
											<td><p>&nbsp;</p></td>
										
										<?php }?>
										</tr>
								<?php endforeach; 
							}?>
							
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

