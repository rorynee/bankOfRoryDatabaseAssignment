	
<aside id="sidebar" class="column">
		
         <?php if($_SESSION['role'] == 1){ ?>
			<h3>Account Options</h3>
			<ul class="toggle">
				<li class="icn_categories"><a href="../../dashboard/admin/<?php echo $_SESSION['user_id'];?>">List Accounts</a></li>
				<li class="icn_view_users"><a href="../../dashboard/add_account/<?php echo $_SESSION['user_id'];?>">Add Account</a></li>
			</ul>
			
			<h3>My Account</h3>
			<ul class="toggle">
				<li class="icn_profile"><a href="../../dashboard/user_details/<?php echo $_SESSION['user_id'];?>">Update Account</a></li>
			</ul>
			<h3>Reports</h3>
			<ul class="toggle">
				<li class="icn_photo"><a href="../../dashboard/top_balances/<?php echo $_SESSION['user_id'];?>">Top Balances</a></li>
				<li class="icn_photo"><a href="../../dashboard/top_region/<?php echo $_SESSION['user_id'];?>">Top Regions</a></li>
				<li class="icn_photo"><a href="../../dashboard/deposits_by_day/<?php echo $_SESSION['user_id'];?>">View Deposits By Day</a></li>
				<li class="icn_photo"><a href="../../dashboard/withdraw_by_day/<?php echo $_SESSION['user_id'];?>">View Withdrawals By Day</a></li>
				<li class="icn_photo"><a href="../../dashboard/customer_tickets/<?php echo $_SESSION['user_id'];?>">Customer Tickets</a></li>
			</ul>
			
			
			<h3>Help Disk</h3>
			<ul class="toggle">
				<li class="icn_tags"><a href="../../dashboard/view_all_tickets/<?php echo($user['account_no']);?>">View All Tickets</a></li>
				
				
			</ul>
		
		<?php }else if($_SESSION['role'] == 2){ ?>
			
			<h3>Account Options</h3>
			<ul class="toggle">
				<li class="icn_categories"><a href="../../dashboard/admin/<?php echo $_SESSION['user_id'];?>">List Accounts</a></li>
			</ul>
			
			<h3>My Account</h3>
			<ul class="toggle">
				<li class="icn_profile"><a href="../../dashboard/user_details/<?php echo $_SESSION['user_id'];?>">Update Account</a></li>
			</ul>
			
			<h3>Help Disk</h3>
			<ul class="toggle">
				<li class="icn_tags"><a href="../../dashboard/view_all_tickets/<?php echo($user['account_no']);?>">View All Tickets</a></li>
				
				
			</ul>
			
		<?php }else{?>
			
			<h3>My Account</h3>
			<ul class="toggle">
				<li class="icn_profile"><a href="../../dashboard/user/<?php echo($user['account_no']);?>">View Account</a></li>
				<li class="icn_edit_article"><a href="../../dashboard/user_details/<?php echo($user['account_no']);?>">Update Account</a></li>
			</ul>
		
		
			<h3>Account Options</h3>
			<ul class="toggle">
				<li class="icn_edit_article"><a href="../../dashboard/user_deposit/<?php echo($user['account_no']);?>">Deposit</a></li>
				<li class="icn_edit_article"><a href="../../dashboard/user_withdrawal/<?php echo($user['account_no']);?>">Withdrawal</a></li>
				<li class="icn_categories"><a href="../../dashboard/user_history/<?php echo($user['account_no']);?>">Account History</a></li>
			</ul>
			
			<h3>Help Disk</h3>
			<ul class="toggle">
				<li class="icn_tags"><a href="../../dashboard/view_ticket/<?php echo($user['account_no']);?>">View Tickets</a></li>
				<li class="icn_new_article"><a href="../../dashboard/open_ticket/<?php echo($user['account_no']);?>">Open Ticket</a></li>
			</ul>
		
		<?php }?>
		
		
		<footer>
			<hr /> 
			<p id="centertext"><img src="../../images/borlogo.png" alt="Bank of Rory Logo" width="75" height="75" align="middle" ></p>
			
		</footer>
	</aside><!-- end of sidebar -->
	