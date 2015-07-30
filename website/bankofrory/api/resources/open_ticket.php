<?php
// Used to Keep unregestered users out of the backend
// also used to keep the user in their own section

$app = Slim\Slim::getInstance();
if(isset($_SESSION['role']))
{
	
	if($_SESSION['role'] != 1){
	
		if($_SESSION['user_id'] != $user['account_no'] )
		{
		
			$app->redirect('../../error');
		
		}
	}	

 $pagename = "Help Desk - Open Ticket"; 
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
			<article class="breadcrumbs"><a href="../../dashboard/user/<?php echo($user['account_no']);?>">Dashboard</a><div class="breadcrumb_divider"></div> <a href="../../dashboard/open_ticket/<?php echo($user['account_no']);?>" class="current">Help Desk - Open Ticket</a> </article>
		</div>
	</section><!-- end of secondary bar -->
	<?php  require 'view/side_bar.php';?> 

	
	<section id="main" class="column">
		
	  
		
	  <div class="clear"></div><!-- end of post new article -->

		<article class="module width_full">
		  <header><h3>Help Desk - Open Ticket</h3></header>
				<div class="module_content">
					<h1>Help Desk - Open Ticket</h1>
					
					
				<?php if (isset($myerror)) { ?>
						<div class="alert alert-danger" role="alert">
								<p class="alert-link error_message">Error: <?php echo $myerror['error'];?> </p>
						</div>
                <?php }  ?>
				<?php if (isset($finish)) { ?>
                        <div  class="alert alert-success" role="alert">
                             <p class="alert-link error_message"><?php echo $finish['message'];?></p>
                        </div>
						<p><--- Click here to <a href="../../dashboard/view_ticket/<?php echo($user['account_no']);?>">View Open Tickets</a></p>
						
                <?php } else{  ?>
				<p>To send a support ticket to our help desk please enter the relevent information in to the form below and press send.<br/>
					We will get back to you as soon as we can.</p>
					
				<form class="form-horizontal" role="form"  method="POST" action="../../dashboard/open_ticket/<?php echo($user['account_no']);?>">

					
					<input type="hidden" name="fname" value="<?php echo $user['first_name'];?>"/>
					<input type="hidden" name="lname" value="<?php echo $user['last_name'];?>"/>
					<input type="hidden" name="account_num" value="<?php echo $user['id'];?>"/>
				   <table class="view_table">
				   <tr>
				  <div class="form-group">
					<th><label for="message" class="col-sm-2 control-label">Message for the Help Desk</label></th>
					<td><textarea cols="40" rows="5" name="message" placeholder="Please enter a message" required autofocus></textarea></td>
				  </div>
				  </tr>
				  <tr>
				  <td><p>&nbsp;</p></td>
				  <td><p>&nbsp;</p></td>
				  
				  </tr>
				  <tr>
				  <td><label for="priority" class="col-sm-2 control-label">Please choose how Urgent your ticket is</label></td>
				  <td><select name="priority">
									<option value="Low" selected>Low</option>
									<option value="Medium">Medium</option>
									<option value="High">High</option>
							</select></td>
				  
				  </tr>
				  <tr>
				  <td><p>&nbsp;</p></td>
				  <td><p>&nbsp;</p></td>
				  
				  </tr>
				  <tr>
				  <td><label for="area" class="col-sm-2 control-label">Please choose an area that your ticket applys to</label></td>
				  <td><select name="area">
									<option value="Profile" selected>Profile</option>
									<option value="Withdrawal">Withdrawal</option>
									<option value="Deposit">Depopsit</option>
							</select></td>
				  
				  </tr>
				   <tr>
				   <tr>
				  <td><p>&nbsp;</p></td>
				  <td><p>&nbsp;</p></td>
				  
				  </tr>
				   <tr>
					<td>
				  <div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					  <button type="submit" class="btn btn-lg btn-primary btn-block">Post Ticket</button>
					</div>
				  </div>
				  </td>
				<td></td>
				   </tr>
				  </table>
            </form>
			<?php } ?>
			
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


?>