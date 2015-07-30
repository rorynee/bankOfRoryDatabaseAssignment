<?php
$app = Slim\Slim::getInstance();
if(isset($_SESSION['role']))
{
	if($_SESSION['role'] == 1){
	

 $pagename = "Reports - Top Region"; 
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
				<article class="breadcrumbs"><a href="../../dashboard/admin/<?php echo $_SESSION['user_id'];?>">Dashboard</a><div class="breadcrumb_divider"></div> <a href="../../dashboard/top_region/<?php echo $_SESSION['user_id'];?>" class="current">Reports - Top Balances</a> </article> </article>
			</div>
		</section><!-- end of secondary bar -->
	 
	<?php  require 'view/side_bar.php';?>
	<section id="main" class="column">

	  <div class="clear"></div><!-- end of post new article -->

		<article class="module width_full">
		  <header><h3>Reports - Top Region</h3></header>
				<div class="module_content">
					<h1>Reports - Top Region</h1>
					
					
					<p>below is a list of all countries with the combined total balances of its customers and the amount<br/>
					of customers per each country</p>
					 
					<table id="data_table" class="display">
						<thead>
							<tr>
								<th>Country Name</th>
								<th>No. of Customers</th>
								<th>Total Blances</th>
								<th>No. of Transactions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($regions as $reg) : ?>
								<tr>
									<td><?php echo $reg['country']; ?></td>
									<td><?php echo $reg['total_cust'];?></td>
									<td>&euro;&nbsp;<?php echo $reg['total_bal']; ?></td>
									<td><?php echo $reg['no_of_trans']; ?></td>
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