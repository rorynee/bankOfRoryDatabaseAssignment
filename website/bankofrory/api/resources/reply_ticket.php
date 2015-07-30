<?php
$app = Slim\Slim::getInstance();
if(isset($_SESSION['role']))
{
	
	if($_SESSION['role'] == 1 || $_SESSION['role'] == 2){
	


 $pagename = "Help Desk - Reply To A Ticket"; 
 include 'view/header_dash.php';
 ?>
<!doctype html>
<body>
	<script>
		function fullMessage(data) {
			alert(data);
		};
	</script>
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
				<article class="breadcrumbs"><a href="../../dashboard/admin/<?php echo $_SESSION['user_id'];?>">Dashboard</a><div class="breadcrumb_divider"></div> <a href="../../dashboard/ticket_reply/<?php echo $_SESSION['user_id'];?>" class="current">Help Desk - Reply To A Ticket</a> </article> </article>
			</div>
		</section><!-- end of secondary bar -->
	
		
	<?php  require 'view/side_bar.php';?> 

	
	<section id="main" class="column">
		
	  
		
	  <div class="clear"></div><!-- end of post new article -->

		<article class="module width_full">
		  <header><h3>Ticket Details</h3></header>
				<div class="module_content">
					<h1>Ticket Details</h1>
				
					<p>Shown below are the individual ticket details.</p>
					<?php if (!isset($reply)) { ?>
							<div class="alert alert-danger" role="alert">
									<p class="alert-link error_message">Incorrect Ticket ID </p>
							</div>
					<?php } else{  ?>
						<table class="view_table">
						
							<tr>
								<td><p><strong>Account Number:</strong></p></td><td><?php echo $reply['account_num']; ?></td>
							</tr>
							<tr>
								<td><p><strong>Ticket Date:</strong></p></td><td><?php echo date('Y-m-d', $reply['ts']->sec); ?></td>
							</tr>
							<tr>
								<td><p><strong>Message:</strong></p></td><td> <?php echo substr($reply['message'], 0, 20).'...'; ?> <button onclick="fullMessage('<?php echo $reply['message']; ?>')">Read More</button></td>
							</tr>
							<tr>
								<td><p><strong>Area:</strong></p></td><td> <?php echo $reply['area']; ?></td>
							</tr>
							<tr>
								<td><p><strong>Priority:</strong></p></td><td>  <?php echo $reply['priority']; ?></td>
							</tr>
							<tr><td><p><strong>Status:</strong></p></td><td> 
							<?php if($reply['status'] == 'Open'){
													echo '<p id="status_open">'.$reply['status'].'</p>';
												}else if($reply['status'] == 'Review'){
													echo '<p id="status_review">'.$reply['status'].'</p>';
												}else{
													echo '<p id="status_closed">'.$reply['status'].'</p>'; 
												}?>
								</td>
							</tr>							
						
						</table>
					
					<?php }?>
									
				</div>
			
         
        <p>&nbsp;</p>
					
				
	  </article><!-- end of styles article -->
		<div class="spacer"></div>
		<article class="module width_full">
		  <header><h3>Update Statuse</h3></header>
				<div class="module_content">
					<h1>Update Status To Review</h1>
				
					<p>If you are going to work on a ticket please change the status to review.</p>
					<p>By doing this you are letting the customer know that their ticket is being worked on.</p>
					<?php if (isset($myerror)) { ?>
						<div class="alert alert-danger" role="alert">
								<p class="alert-link error_message">Error: <?php echo $myerror['error'];?> </p>
						</div>
					<?php }  ?>
					<form action="../../dashboard/change_status/<?php echo $_SESSION['user_id'];?>" method="POST">
								<input type="hidden" name="ticket_id" value="<?php echo $reply['_id'];?>"/>
								<p>Change status to Reiew: &nbsp;&nbsp;<input type="submit" value="Change" /></p>
					</form>
					
									
				</div>
			
         
        <p>&nbsp;</p>
	  </article><!-- end of styles article -->
	  <div class="spacer"></div>
	  <article class="module width_full">
		  <header><h3>Reply To A Ticket</h3></header>
				<div class="module_content">
					<h1>Reply To A Ticket</h1>
				
					<p>Please enter in the message you would like to reply with below</p>
					<p>By replying to this message you will automatically close the ticket. <em>Tickets can not be reopened!!</em></p>
					<?php if (isset($myerror_reply)) { ?>
						<div class="alert alert-danger" role="alert">
								<p class="alert-link error_message">Error: <?php echo $myerror_reply['error'];?> </p>
						</div>
					<?php }  ?>
					<form class="form-horizontal" role="form"  method="POST" action="../../dashboard/post_reply/<?php echo($user['account_no']);?>">

					
					<input type="hidden" name="ticket_id" value="<?php echo $reply['_id'];?>"/>
				   <table class="view_table">
				   <tr>
				  <div class="form-group">
					<th><label for="message" class="col-sm-2 control-label">Message form the Help Desk</label></th>
					<td><textarea cols="40" rows="5" name="message" placeholder="Please enter a message" required></textarea></td>
				  </div>
				  </tr>
				 
			
				   <tr>
					<td>
				  <div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					  <button type="submit" class="btn btn-lg btn-primary btn-block">Reply To Ticket</button>
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
	<div class="spacer"></div>
	</section>

<?php include 'view/footer_dash.php'; 
	}else{
		$app->redirect('../../error');
	}


}else{
		
		$app->redirect('../../error');
		
}