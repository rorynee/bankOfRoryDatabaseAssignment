<?php
$app = Slim\Slim::getInstance();
if(isset($_SESSION['role']))
{
	if($_SESSION['role'] == 1){
	

 $pagename = "Reports - View Deposits By Day"; 
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
				<article class="breadcrumbs"><a href="../../dashboard/admin/<?php echo $_SESSION['user_id'];?>">Dashboard</a><div class="breadcrumb_divider"></div> <a href="../../dashboard/deposits_by_day/<?php echo $_SESSION['user_id'];?>" class="current">Reports - View Deposits By Day</a> </article> </article>
			</div>
		</section><!-- end of secondary bar -->
	 
	<?php  require 'view/side_bar.php';?>
	<section id="main" class="column">

	  <div class="clear"></div><!-- end of post new article -->

		<article class="module width_full">
		  <header><h3>Reports - View Deposits By Day</h3></header>
				<div class="module_content">
					<h1>Reports - View Deposits By Day</h1>
					
					<?php if (isset($deposit_days)) { ?>
					<p>Please select form list the days deposits you would like to look at and press search</p>
					<form class="form-horizontal" role="form"  method="POST" action="../../dashboard/deposits_by_day/<?php echo($user['account_no']);?>">
						
						   <table class="view_table">
						  
						   <tr>
						  <div class="form-group">
							<th><label for="input_date" class="col-sm-2 control-label">Available Dates</label></th>
							<td><select name="input_date">
							
							<?php foreach ($deposit_days as $day) : ?>
								
								<?php if( date("Y-m-d") == $day['dates'] ){ ?>
									<option value="<?php echo $day['dates'];?>" selected><?php echo $day['dates'];?></option>
								  <?php }else{?>
									<option value="<?php echo $day['dates'];?>"><?php echo $day['dates'];?></option>
							<?php } endforeach; ?>	  
							</select></td>
							
						  </div>
						  </tr>
						  
						   <tr>
							<td>
						  <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" class="btn btn-lg btn-primary btn-block">Search</button>
							</div>
						  </div>
						  </td>
						<td></td>
						   </tr>
						  </table>
					</form>
					<?php } ?>
					 <?php if (isset($deposits)) { ?>
					 <p>Below is a list of deposits on your selected days</p>
						<table id="data_table" class="display">
							<thead>
								<tr>
									<th>A/C Id</th>
									<th>Name</th>
									<th>Transaction Id</th>
									<th>Transaction Date/Time</th>
									<th>Transaction Type</th>
									<th>Transaction Amount</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($deposits as $deposit) : ?>
									<tr>
										<td><?php echo $deposit['id']; ?></td>
										<td><?php echo $deposit['first_name'].' '.$deposit['last_name'];?></td>
										<td><?php echo $deposit['transaction_id']; ?></td>
										<td><?php echo $deposit['transactions_time']; ?></td>
										<td><?php echo $deposit['transaction_type']; ?></td>
										<td>&euro;&nbsp;<?php echo $deposit['transaction_amount']; ?></td>
									</tr>
								<?php endforeach; ?>	
							</tbody>
						</table>
						<p>&nbsp;</p>
						<h4>Total Deposits on 
						<?php echo substr($deposit['transactions_time'], 0, -9).' are &nbsp;&nbsp;'; 
							$total_deposits = 0; 
							foreach ($deposits as $deposit) :
								$total_deposits = $total_deposits + $deposit['transaction_amount'];
							endforeach; 
							echo '<strong>&euro;&nbsp;&nbsp;'.number_format($total_deposits, 2, '.', '').'</strong>';
							
							?>
							
						</h4>
						<p>&nbsp;</p>
						<p><a href="../../dashboard/deposits_by_day/<?php echo $_SESSION['user_id'];?>">Click here to make another search.</a></p>
					<?php } ?>
					
					
					
				
			
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