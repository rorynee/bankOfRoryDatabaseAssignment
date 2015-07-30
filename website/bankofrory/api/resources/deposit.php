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

 $pagename = "Deposit"; 
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
			<article class="breadcrumbs"><a href="../../dashboard/user/<?php echo($user['account_no']);?>">Dashboard</a><div class="breadcrumb_divider"></div> <a href="../../dashboard/user_deposit/<?php echo($user['account_no']);?>" class="current">Deposit</a> </article>
		</div>
	</section><!-- end of secondary bar -->
	<?php  require 'view/side_bar.php';?> 

	
	<section id="main" class="column">
		
	  
		
	  <div class="clear"></div><!-- end of post new article -->

		<article class="module width_full">
		  <header><h3>Deposit Money</h3></header>
				<div class="module_content">
					<h1>Deposit</h1>
					<p>Please enter an amount to deposit.</p>
					<p>Current Balance: <strong>&euro; <?php echo $user['balance'];?></strong></p>
				<?php if (isset($myerror)) { ?>
						<div class="alert alert-danger" role="alert">
								<p class="alert-link error_message">Error: <?php echo $myerror['error'];?> </p>
						</div>
                <?php }  ?>
				<?php if (isset($finish)) { ?>
                        <div  class="alert alert-success" role="alert">
                             <p class="alert-link error_message"><?php echo $finish['message'];?></p>
                        </div>
						<p><--- Back to <a href="../../dashboard/user/<?php echo($user['account_no']);?>">Dashboard</a></p>
						
                <?php } else{  ?>

				<form class="form-horizontal" role="form"  method="POST" action="../../dashboard/deposit/<?php echo($user['account_no']);?>">
					<input type="hidden" name="_METHOD" value="PUT"/>
				   <table class="view_table">
				   <tr>
				  <div class="form-group">
					<th><label for="input_dep" class="col-sm-2 control-label">Deposit Amount</label></th>
					<td>&euro; <input type="text" class="form-control" name="input_dep" placeholder="Deposit Amount" required autofocus></td>
				  </div>
				  </tr>
				   <tr>
					<td>
				  <div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
					  <button type="submit" class="btn btn-lg btn-primary btn-block">Deposit Money</button>
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

