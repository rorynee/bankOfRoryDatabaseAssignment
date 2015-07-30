<?php
require 'api/Slim/Slim.php';
require_once 'api/database.php';
require_once 'api/database_mongo.php';
require 'api/static_fn.php';
require 'api/access.php';
require 'api/functions.php';
// Silm Framework initiation
use Slim\Slim;
\Slim\Slim::registerAutoloader();
$app = new Slim();

// Routes for the front end pages
$app->get( '/','getMain');
$app->get( '/index','getMain');
$app->get( '/about','getabout');
$app->get( '/signup','getsignup');
$app->post('/signup','createAccount'); // Route to accept the signup form
$app->get( '/login','getlogin'); 
$app->post('/login','validateLogin'); // Route to accept the login form
$app->get('/error','error'); // Show Errors
$app->get('/logout','logout'); // Logout

// Backend
// User section routes
// user Dashboard 
$app->get('/dashboard/user/:id','showAccount'); // Show the account information
$app->get('/dashboard/user_details/:id','showDetails'); // Show user Details
$app->put('/dashboard/update/:id','updateDetails'); // Update user Details
$app->put('/dashboard/account_type/:id','updateAccountType'); // Update user Details
$app->put('/dashboard/account_pass/:id','updateAccountPass'); // Update user Details
$app->delete('/dashboard/update/:id','deleteDetails'); // Delete user Details
$app->get('/dashboard/user_deposit/:id','deposit'); // Show the Deposit Page
$app->put('/dashboard/deposit/:id','updateDeposit'); // Route to accept the Deposit form
$app->get('/dashboard/user_withdrawal/:id','withdrawal'); // Show the Withdrawal Page
$app->put('/dashboard/withdrawal/:id','updateWithdrawal'); // Route to accept the Withdrawal form
$app->get('/dashboard/user_history/:id','history'); // Show the History page 

// Admin section routes
$app->get('/dashboard/admin/:id','listAccounts'); // Show the account information
$app->get('/dashboard/add_account/:id','addAccount'); // Show the add account page
$app->post('/dashboard/update_balance/:id','updateBalance'); // Update balance
$app->post('/dashboard/add_account/:id','createAccountInAdmin'); // create a new user form the admin section
$app->get('/dashboard/top_balances/:id','topBalances'); // Show Report 1 - Top Balances
$app->get('/dashboard/top_region/:id','topRegions'); // Show report 2 - Top Regions
$app->get('/dashboard/deposits_by_day/:id','depositsByDay'); // Show the dates used to search for to be used in report 3 - View Deposits By Day
$app->post('/dashboard/deposits_by_day/:id','displayDeposits'); // Display report 3 - View Deposits By Day
$app->get('/dashboard/withdraw_by_day/:id','withdrawsByDay'); // Show the dates used to search for to be used in report 4 - View Withdrawals By Day
$app->post('/dashboard/withdraw_by_day/:id','displayWithdrawals'); // Display report 4 - View Withdrawals By Day
$app->get('/dashboard/customer_tickets/:id','customerTickets'); // Show report 2 - Top Regions

// Ticket NoSQL
$app->get('/dashboard/open_ticket/:id','openTicket'); // Show the open ticket page to the user
$app->post('/dashboard/open_ticket/:id','postTicket'); // Save the new ticket form data to the NoSQL database
$app->get('/dashboard/view_ticket/:id','viewUserTickets'); // Show the Tickets by user

// Support Ticket NoSQL
$app->get('/dashboard/view_all_tickets/:id','viewAllTickets'); // Show all tickets
$app->post('/dashboard/ticket_reply/:id','replyTicket'); // Show all tickets
$app->post('/dashboard/change_status/:id','changeStatus'); // Show all tickets
$app->post('/dashboard/post_reply/:id','postReply'); // Show all tickets
$app->post('/dashboard/post_delete/:id','postDelete'); // Show all tickets

$app->run();
