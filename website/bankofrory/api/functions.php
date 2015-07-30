<?php
/* Some code is repeated throughout this file.
	Comments will only be on the first instance of it.*/

// Start the session
session_start();

// Gets the account information
function getAccount($value){

	$db = dbConn::getConnection(); // Gets an connection object
	// calls the Get Account info procedure
	$querys = "CALL GET_ACCOUNT_INFO($value)";
	// runs the query
	$result = $db->query($querys);
	// fetches the result form the query
	$user_details = $result->fetch();
	// returns the result	
	return $user_details;
}
// Show the Main Dashboard Page
function showAccount($value){
	$db = dbConn::getConnection(); // Gets an connection object
	$app = Slim\Slim::getInstance(); // Gets an instance of the Slim Framework
	
	// calls the get account function
	$user_details = getAccount($value);
	// Renders the user account page and passes the array  of user to be accessed on the page	
	$app->render('../api/resources/user_account.php', array('user' => $user_details ));
}
// Show the user Update Page
function showDetails($value){
	$db = dbConn::getConnection();
	$app = Slim\Slim::getInstance();
	$user_details = getAccount($value);
	// Call the GET_ACCOUNT_TYPES procedure	
	$myquery = "CALL GET_ACCOUNT_TYPES()";
	$result = $db->query($myquery);
	$account_types = $result->fetchALL(PDO::FETCH_ASSOC); // return an associative array
	$app->render('../api/resources/user_details.php', array('user' => $user_details, 'account_types'=>$account_types ));

}
// Update the account details
function updateDetails($value){
	$db = dbConn::getConnection();
	$app = Slim\Slim::getInstance();
	// Get the request object form the slim framework
	$request = $app->request();
	// Take in the details form the user taking out any html
	$email = trim($request->post('inputEmail3'));
	$fname = htmlspecialchars(trim($request->post('input_fname')));
	$lname = htmlspecialchars(trim($request->post('input_lname'))); 
	$age = htmlspecialchars(trim($request->post('input_age')));  
	$street = htmlspecialchars(trim($request->post('input_street')));
	$city = htmlspecialchars(trim($request->post('input_city')));
	$country = htmlspecialchars(trim($request->post('input_country')));
	// Age options
	$options_age = array(
    'options' => array(
                      'min_range' => 18,
                      'max_range' => 120,
                      )
	);
	
		// is the name length greater than zero
		if(strlen($fname) > 0 && strlen($lname) > 0){
			// is the age an int and is it between the range of my age options
			if(filter_var($age, FILTER_VALIDATE_INT, $options_age) !== FALSE){
						// is the street, city and country length greater than zero
						if(strlen($street) > 0 && strlen($city) > 0 && strlen($country) > 0){
							$db->beginTransaction(); // start the transaction
							
								$query = "CALL UPDATE_ACCOUNT($value, '$fname', '$lname', $age, '$street', '$city','$country')";
											
								$execute_call = $db->query($query);
								$count = $execute_call->rowCount(); // how many rows changed
								
								if($count == 1){
									
									$db->commit(); // commit the changes
									// reidrect to a diffrent page depending the the role
									if($_SESSION['role'] == 1){
									
										$app->redirect('../../dashboard/admin/'.$_SESSION['user_id']);
									}else{
										$app->redirect('../../dashboard/user/'.$value);
									}
									
									
									
								}else{
									$user_details = getAccount($value);
									$myquery = "CALL GET_ACCOUNT_TYPES()";
									$account_types = $db->query($myquery);
									// Error messages and the page being called again
									$error =  array("error" =>"Database Error. Please Try Again Later.");
									$app->render('../api/resources/user_details.php', array('myerror_up' => $error,
																'user' => $user_details, 'account_types'=>$account_types ));
								}
								
							
						}else{
							$user_details = getAccount($value);
							$myquery = "CALL GET_ACCOUNT_TYPES()";
							$account_types = $db->query($myquery);
							
							$error =  array("error" =>"A full address must be provided. Please enter a valid value.");
							$app->render('../api/resources/user_details.php', array('myerror_up' => $error,
																	'user' => $user_details, 'account_types'=>$account_types ));
						}
		
								
			}else{
				$user_details = getAccount($value);
				$myquery = "CALL GET_ACCOUNT_TYPES()";
				$result = $db->query($myquery);
				$account_types = $result->fetchALL(PDO::FETCH_ASSOC);
				
				$error =  array("error" =>"Age is invalid. You must be over 18 to open an account. Please enter a valid value.");
				$app->render('../api/resources/user_details.php', array('myerror_up' => $error,
																'user' => $user_details,'account_types'=>$account_types ));
			}
		
		
		}else{
			$user_details = getAccount($value);
			$myquery = "CALL GET_ACCOUNT_TYPES()";
			$account_types = $db->query($myquery);
			
		
			$error =  array("error" =>"First or Last the name is blank. Please enter a valid value.");
			$app->render('../api/resources/user_details.php', array('myerror_up' => $error,
														'user' => $user_details, 'account_types'=>$account_types ));
		}


}
// Update the user account type
function updateAccountType($value){
		$db = dbConn::getConnection();
		$app = Slim\Slim::getInstance();
		$request = $app->request();
		$account_type = htmlspecialchars(trim($request->put('input_account')));
		// is account type an int
		if(filter_var($account_type, FILTER_VALIDATE_INT) !== FALSE){
			
			$db->beginTransaction();
			$query = "CALL UPDATE_ACCOUNT_type($value,$account_type)"; 
																		
			$execute_call = $db->query($query);
			$count = $execute_call->rowCount();
			
			if($count == 1){
				$db->commit();
				$app->redirect('../../dashboard/admin/'.$_SESSION['user_id']);
			}else{
				$app->redirect('../../error');
			}
			
		}else{
			$app->redirect('../../error');
		}

}

// Update the user Passwords
function  updateAccountPass($value){
	$db = dbConn::getConnection();
	$app = Slim\Slim::getInstance();
	$request = $app->request();
	
	$username = htmlspecialchars(trim($request->post('inputEmail3')));
	$pass = trim($request->post('input_pass'));
	$pass_check = trim($request->post('input_cpass'));
	
			// is the password greater than or equal to 6
			if(strlen($pass) >= 6 && strlen($pass_check) >= 6 ){
			
				if($pass == $pass_check){
					$db->beginTransaction();
						// encrypt the password
						$encript_Pass = md5( $pass );
						$pass_query = "Call UPDATE_ACCOUNT_PASS(".$value.",'".$encript_Pass."')";		
						
						$execute_call = $db->query($pass_query);
						$count = $execute_call->rowCount();
								
						if($count == 1){
							
							$db->commit();
							
							if($_SESSION['role'] == 1){
							
								$app->redirect('../../dashboard/admin/'.$_SESSION['user_id']);
							}else{
								$app->redirect('../../dashboard/user/'.$value);
							}
									
						}else{
							$user_details = getAccount($value);
							$myquery = "CALL GET_ACCOUNT_TYPES()";
							$account_types = $db->query($myquery);
							
							$error =  array("error" =>"No Change made to the database. Please Try Again Later.");
							$app->render('../api/resources/user_details.php', array('myerror_pas' => $error,
																	'user' => $user_details, 'account_types'=>$account_types ));
						}
					
				}else{
					
					$myquery = "CALL GET_ACCOUNT_TYPES()";
					$account_types = $db->query($myquery);
					$user_details = getAccount($value);
					$error =  array("error" =>"New Passwords must be the same. Please enter a valid value.");
					$app->render('../api/resources/user_details.php', array('myerror_pas' => $error,
														'user' => $user_details, 'account_types'=>$account_types ));
				}


			}else{
				
				$myquery = "CALL GET_ACCOUNT_TYPES()";
				$account_types = $db->query($myquery);
				$user_details = getAccount($value);
				$error =  array("error" =>"New Passwords must be 6 or more characters. Please enter a valid value.");
				$app->render('../api/resources/user_details.php', array('myerror_pas' => $error,
															'user' => $user_details, 'account_types'=>$account_types ));
			}

}


//Delete a User
function deleteDetails($id){
	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection();
	$request = $app->request();
	$acc_no = $request->post('account_no');
	
	// Dont delete the admin account
	if($_SESSION['role'] == 1 && $_SESSION['user_id'] == 1 && $id == 1){
		$user_details = getAccount($id);
		$myquery = "CALL GET_ACCOUNT_TYPES()";
		$account_types = $db->query($myquery);
		
		$error =  array("error" =>"Admin Super User Cannot Be Deleted.");
		$app->render('../api/resources/user_details.php', array('user' => $user_details,'myerror' => $error,'account_types'=>$account_types ));
	
	// Dont delete the support account
	}else if($_SESSION['role'] == 2 && $_SESSION['user_id'] == 2 && $id == 2){
	
		$user_details = getAccount($id);
		$myquery = "CALL GET_ACCOUNT_TYPES()";
		$account_types = $db->query($myquery);
		
		$error =  array("error" =>"Support Team Account Cannot Be Deleted.");
		$app->render('../api/resources/user_details.php', array('user' => $user_details,'myerror' => $error,'account_types'=>$account_types ));
		
	}else{ // delete all other accounts
	
		 try{
			
			$db->beginTransaction();
			$query = "CALL DELETE_ACCOUNT('".$id."')";
			$db->exec($query);
			// Get the mongo connection object
			$db_mongo_coll = mongoConn::getConnection();
			// remove the tickets belonging to the account  
			$db_mongo_coll->remove(array('account_num' => $acc_no));
			
			$db->commit();
			// when deleted go to the logout page, clear the session and close the db connection 
			$app->redirect('../../logout');
			
		}  catch (PDOException $e){
				
				$user_details = getAccount($id);
				$myquery = "CALL GET_ACCOUNT_TYPES()";
				$account_types = $db->query($myquery);
		
				$error =  array("error" =>"Database Error. Please Try Again Later.");
				$app->render('../api/resources/user_details.php', array('user' => $user_details,'myerror' => $error,'account_types'=>$account_types ));

		}
	}
}

//Create a New User from the sign up page
// Similar to the update account comments
function createAccount(){
	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection();
	$request = $app->request();
	$email = trim($request->post('inputEmail3'));
	$fname = htmlspecialchars(trim($request->post('input_fname'))); 
	$lname = htmlspecialchars(trim($request->post('input_lname'))); 
	$age = htmlspecialchars(trim($request->post('input_age')));  
	$street = htmlspecialchars(trim($request->post('input_street')));
	$city = htmlspecialchars(trim($request->post('input_city')));
	$country = htmlspecialchars(trim($request->post('input_country')));
	
	$pass = trim($request->post('input_pass'));
	$pass_check = trim($request->post('input_cpass'));
	
	$options_age = array(
    'options' => array(
                      'min_range' => 18,
                      'max_range' => 120,
                      )
	);
	// is the username an email address
	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		
		if(strlen($fname) > 0 && strlen($lname) > 0){
		
			if(filter_var($age, FILTER_VALIDATE_INT, $options_age) !== FALSE){
			
				if(strlen($pass) >= 6 && strlen($pass_check) >= 6 ){
					// are the password equal to eachother
					if($pass == $pass_check){
					
						if(strlen($street) > 0 && strlen($city) > 0 && strlen($country) > 0){
							
							$myquery = "SELECT email FROM users where email = '".$email."'";
							$result = $db->query($myquery);
							$rows  = $result->rowCount();
							
							if($rows == 0){
							
								$encript_Pass = md5( $pass );
								$db->beginTransaction();
								$query = "CALL ADD_NEW_ACCOUNT('$fname','$lname','$email',$age,'$street','$city','$country','$encript_Pass')";
																
								$execute_call = $db->query($query);
								$count = $execute_call->rowCount();
								
								if($count == 1){
									
									$db->commit();
									$query = "CALL GET_LAST_ACCOUNT_ID()";
									$result = $db->query($query);
									$lastid = $result->fetch();
									// add new information to the session
									$_SESSION['user_id'] = $lastid['account_no'];
									$_SESSION['fname'] = $fname;
									$_SESSION['lname'] = $lname;
									$_SESSION['role'] = 3;
									$_SESSION['user_token'] = $lastid['account_no'];
									
									
									$app->redirect('dashboard/user/'.$lastid['account_no']);
									
									
								}else{
									$error =  array("error" =>"Database Error. Please Try Again Later.");
									$app->render('../api/resources/signup.php', array('myerror' => $error ));
								}
								
								
							
							}else{
							
								$error =  array("error" =>"The Username/Email already exists. Please enter a valid value.");
								$app->render('../api/resources/signup.php', array('myerror' => $error ));
							
							}
							
							
						}else{
							$error =  array("error" =>"A full address must be provided. Please enter a valid value.");
							$app->render('../api/resources/signup.php', array('myerror' => $error ));
						}
		
						
					}else{
						$error =  array("error" =>"Password must be the same. Please enter a valid value.");
						$app->render('../api/resources/signup.php', array('myerror' => $error ));
					}
		
		
				}else{
					$error =  array("error" =>"Password must be 6 or more characters. Please enter a valid value.");
					$app->render('../api/resources/signup.php', array('myerror' => $error ));
				}
			
		
			}else{
				$error =  array("error" =>"Age is invalid. You must be over 18 to open an account. Please enter a valid value.");
				$app->render('../api/resources/signup.php', array('myerror' => $error ));
			}
		
		
		}else{
			$error =  array("error" =>"First or Last the name is blank. Please enter a valid value.");
			$app->render('../api/resources/signup.php', array('myerror' => $error ));
		}

	}else{
	
		$error =  array("error" =>"Email is not a valid. Please enter a valid value.");
		$app->render('../api/resources/signup.php', array('myerror' => $error ));
	
	}

}



// Show the Deposit Page
function deposit($value){
	$db = dbConn::getConnection();
	$app = Slim\Slim::getInstance();
	
	$user_details = getAccount($value);
		
	$app->render('../api/resources/deposit.php', array('user' => $user_details ));
}

// update the account balance - Deposit
function updateDeposit($value){
	$db = dbConn::getConnection();
	$app = Slim\Slim::getInstance();
	$request = $app->request();
	
	$user_details = getAccount($value);
	$account_id = $user_details['id'];
	
	$bal = htmlspecialchars(trim($request->post('input_dep'))); 
	// is the balance a floating number
	if(filter_var($bal, FILTER_VALIDATE_FLOAT) !== FALSE){
		// is the balance between this range i.e. decimal(13,2) in MySQL
		if($bal > 0 && $bal < 9999999999999.99){
		
			$db->beginTransaction();
			
			$query = "CALL DEPOSIT_MONEY($account_id, $bal)";			
			$execute_call = $db->query($query);
			$result = $execute_call->fetch();
			
			if($result == false){
				
				$db->commit();
				$user_details = getAccount($value);
				$message =  array("message" =>"Thank You. Your Money has been Deposited");
				$app->render('../api/resources/deposit.php', array('finish' => $message,'user' => $user_details ));
				
				
			}else{
				$user_details = getAccount($value);
				$error =  array("error" =>"Database Error. Please Try Again Later.");
				$app->render('../api/resources/deposit.php', array('myerror_up' => $error,'user' => $user_details ));
			}
							
		}else{
			$user_details = getAccount($value);
			$error =  array("error" =>"Deposit Amount has to be a positive numeric character betwen greater than &euro;0 and less than &euro;9999999999999.99");
			$app->render('../api/resources/deposit.php', array('myerror' => $error,'user' => $user_details ));
		}
	
	}else{
		$user_details = getAccount($value);
		$error =  array("error" =>"The value entered must be a numeric value. Please try again");
		$app->render('../api/resources/withdrawal.php', array('myerror' => $error,'user' => $user_details ));
	}
}


// Show the Withdrawal Page
function withdrawal($value){
	$db = dbConn::getConnection();
	$app = Slim\Slim::getInstance();
	
	$user_details = getAccount($value);
		
	$app->render('../api/resources/withdrawal.php', array('user' => $user_details ));
}

// update the account balance - Withdrawal
function updateWithdrawal($value){
	$db = dbConn::getConnection();
	$app = Slim\Slim::getInstance();
	$request = $app->request();
	
	$user_details = getAccount($value);
	
	$bal = htmlspecialchars(trim($request->post('input_with')));  
	$account_num = htmlspecialchars(trim($request->post('account_num')));
	$balance = htmlspecialchars(trim($request->post('balance')));
	
	$result_of_bal = $balance - $bal;
	
	if(filter_var($bal, FILTER_VALIDATE_FLOAT) !== FALSE){
		// are they taking out more than they have
		if($result_of_bal >= 0 ){
			
			if($bal > 0 && $bal < 9999999999999.99){
				
				$db->beginTransaction();
				
				$query_with = "CALL WITHDRAW_MONEY($account_num, $bal)";			
				
				$execute_call = $db->query($query_with);
				
				$result_cash = $execute_call->fetch();
				
				if($result_cash  == false){
					
					$db->commit();
					$user_details = getAccount($value);
					$message =  array("message" =>"Thank You. Your Money has been Withdrawn");
					$app->render('../api/resources/withdrawal.php', array('finish' => $message,'user' => $user_details ));
					
					
				}else{
					$user_details = getAccount($value);
					$error =  array("error" =>"Database Error. Please Try Again Later.");
					$app->render('../api/resources/withdrawal.php', array('myerror_up' => $error,'user' => $user_details ));
				}
								
			}else{
				
				$error =  array("error" =>"Withdrawal Amount has to be a positive numeric character betwen greater than &euro;0 and less than &euro;9999999999999.99");
				$app->render('../api/resources/withdrawal.php', array('myerror' => $error,'user' => $user_details ));
			}
		
		
		}else{
			
			$error =  array("error" =>"Insufficient Funds. Please try again");
			$app->render('../api/resources/withdrawal.php', array('myerror' => $error,'user' => $user_details ));
		
		
		}
	
	}else{
		
		$error =  array("error" =>"The value entered must be a numeric value. Please try again");
		$app->render('../api/resources/withdrawal.php', array('myerror' => $error,'user' => $user_details ));
	}

}

// Admin - Update Balance
function updateBalance($value){
	$db = dbConn::getConnection();
	$app = Slim\Slim::getInstance();
	$request = $app->request();
	$account_num = htmlspecialchars(trim($request->post('account_num')));
	$balance = htmlspecialchars(trim($request->post('balance')));
	
			if($balance > 0 && $balance < 9999999999999.99){
			
						$db->beginTransaction();
						
						$pass_query = "Call UPDATE_BALANCE($account_num, $balance)";		
						
						$balance_call = $db->query($pass_query);
						
						$count = $balance_call->rowCount();
								
						if($count == 1){
							
							$db->commit();
							$app->redirect('../../dashboard/admin/'.$_SESSION['user_id']);
									
						}else{
							$user_details = getAccount($value);
							$myquery = "CALL GET_ACCOUNT_TYPES()";
							$account_types = $db->query($myquery);
							
							$error =  array("error" =>"There was an error on the database. Please try later.");
							$app->render('../api/resources/user_details.php', array('myerror_bal' => $error,
																		'user' => $user_details, 'account_types'=>$account_types ));
						}
						
			}else{
				$user_details = getAccount($value);
				$myquery = "CALL GET_ACCOUNT_TYPES()";
				$account_types = $db->query($myquery);
				
				$error =  array("error" =>"New Balance connot be less than 0. Please enter a valid value.");
				$app->render('../api/resources/user_details.php', array('myerror_bal' => $error,
															'user' => $user_details, 'account_types'=>$account_types ));
			}
}


// Show Tranaction History

function history($value){
	$db = dbConn::getConnection();
	$app = Slim\Slim::getInstance();
	
	$user_details = getAccount($value);
	// show the transaction based on the user
	$his_query = "CALL GET_TRANSACTIONS($value)";
	$trans = $db->query($his_query);
	
	$app->render('../api/resources/user_history.php', array('user' => $user_details,'trans'=> $trans));
}
// List the accounts. used for admin and support login landing page
function listAccounts($value){

	$db = dbConn::getConnection();
	$app = Slim\Slim::getInstance();
	$user_details = getAccount($value);
	
	$acc_query = "CALL GET_ACCOUNTS()";
	$accounts = $db->query($acc_query);
	
	$app->render('../api/resources/user_account.php', array('user' => $user_details,'accounts'=>$accounts ));
	
}
// Show the add account page to the admin role
function addAccount($value){

	$db = dbConn::getConnection();
	$app = Slim\Slim::getInstance();
	$user_details = getAccount($value);
	
	$app->render('../api/resources/addaccount.php', array('user' => $user_details));
	
}
//Create a New User from within the admin area
function createAccountInAdmin($value){
	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection();
	$request = $app->request();
	$email = trim($request->post('inputEmail4'));
	$fname = htmlspecialchars(trim($request->post('input_fname'))); 
	$lname = htmlspecialchars(trim($request->post('input_lname'))); 
	$age = htmlspecialchars(trim($request->post('input_age')));  
	$street = htmlspecialchars(trim($request->post('input_street')));
	$city = htmlspecialchars(trim($request->post('input_city')));
	$country = htmlspecialchars(trim($request->post('input_country')));
	
	$pass = trim($request->post('input_pass'));
	$pass_check = trim($request->post('input_cpass'));
	
	$options_age = array(
    'options' => array(
                      'min_range' => 18,
                      'max_range' => 120,
                      )
	);
	
	if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		
		if(strlen($fname) > 0 && strlen($lname) > 0){
		
			if(filter_var($age, FILTER_VALIDATE_INT, $options_age) !== FALSE){
			
				if(strlen($pass) >= 6 && strlen($pass_check) >= 6 ){
				
					if($pass == $pass_check){
					
						if(strlen($street) > 0 && strlen($city) > 0 && strlen($country) > 0){
							
							$myquery = "SELECT email FROM users where email = '".$email."'";
							$result = $db->query($myquery);
							$rows  = $result->rowCount();
							
							if($rows == 0){
								
								$encript_Pass = md5( $pass );
								$db->beginTransaction();
								$query = "CALL ADD_NEW_ACCOUNT('$fname','$lname','$email',$age,'$street','$city','$country','$encript_Pass')";
																
								$execute_call = $db->query($query);
								$count = $execute_call->rowCount();
								
								if($count == 1){
									
									$db->commit();
									
									$app->redirect('../../dashboard/admin/'.$_SESSION['user_id']);
																		
								}else{
									$error =  array("error" =>"Database Error. Please Try Again Later.");
									$user_details = getAccount($value);
									$app->render('../api/resources/addaccount.php', array('user' => $user_details, 'myerror' => $error ));
								}
								
								
							}else{
							
								$error =  array("error" =>"The Username/Email already exists. Please enter a valid value.");
								$user_details = getAccount($value);
								$app->render('../api/resources/addaccount.php', array('user' => $user_details, 'myerror' => $error ));
							
							}
							
							
						}else{
							$error =  array("error" =>"A full address must be provided. Please enter a valid value.");
							$user_details = getAccount($value);
							$app->render('../api/resources/addaccount.php', array('user' => $user_details, 'myerror' => $error ));
						}
		
						
					}else{
						$error =  array("error" =>"Password must be the same. Please enter a valid value.");
						$user_details = getAccount($value);
						$app->render('../api/resources/addaccount.php', array('user' => $user_details, 'myerror' => $error ));
					}
		
		
				}else{
					$error =  array("error" =>"Password must be 6 or more characters. Please enter a valid value.");
					$user_details = getAccount($value);
					$app->render('../api/resources/addaccount.php', array('user' => $user_details, 'myerror' => $error ));
				}
			
		
			}else{
				$error =  array("error" =>"Age is invalid. You must be over 18 to open an account. Please enter a valid value.");
				$user_details = getAccount($value);
				$app->render('../api/resources/addaccount.php', array('user' => $user_details, 'myerror' => $error ));
			}
		
		
		}else{
			$error =  array("error" =>"First or Last the name is blank. Please enter a valid value.");
			$user_details = getAccount($value);
			$app->render('../api/resources/addaccount.php', array('user' => $user_details, 'myerror' => $error ));
		}

	}else{
	
	
		$error =  array("error" =>"Email is not a valid. Please enter a valid value.");
		$user_details = getAccount($value);
		$app->render('../api/resources/addaccount.php', array('user' => $user_details, 'myerror' => $error ));
	
	}
	
}
// Show Report 1 - Top Balances
function topBalances($value){
	// Get an instance of the Slim Framework
	$app = Slim\Slim::getInstance();
	// Get an instance of the database connection
	$db = dbConn::getConnection();
	
	// Get the account information of the person using the page 
	// for navagation puropses
	$user_details = getAccount($value);
	
	// Call the top Balances procedure
	$bal_query = "CALL GET_Top_BALANCES()";
	$balance_res = $db->query($bal_query);
	$balances = $balance_res->fetchAll(PDO::FETCH_ASSOC);
	
	// Put the result on to the page so it can be accessed by the html and the php.
	$app->render('../api/resources/report_top_bal.php', array('user' => $user_details,'balances' =>$balances ));

}

// Show report 2 - Top Regions
function topRegions($value){
	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection();
	$user_details = getAccount($value);
	
	// Call the top Regions procedure
	$reg_query = "CALL GET_Top_REGIONS()";
	$region_res = $db->query($reg_query);
	$regions = $region_res->fetchAll(PDO::FETCH_ASSOC);
	// Put the result on to the page so it can be accessed by the html and the php.
	$app->render('../api/resources/report_top_reg.php', array('user' => $user_details, 'regions' => $regions));
	
}

// Show the dates used to search for to be used in report 2 - View Deposits By Day
function depositsByDay($value){

	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection();
	$user_details = getAccount($value);
	
	// Call the Get Deposit Day Function
	$days_query = "Call GET_DEPOSIT_DAY()";
	$days_res = $db->query($days_query);
	$deposit_days = $days_res->fetchAll(PDO::FETCH_ASSOC);
	// Put the result on to the page so it can be accessed by the html and the php.
	$app->render('../api/resources/report_dep_day.php', array('user' => $user_details,'deposit_days' => $deposit_days));
}
// Display report 2 - View Deposits By Day
function displayDeposits($value){

	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection();

	$request = $app->request();
	// Take the date in form the user.
	$search_date = trim($request->post('input_date'));
	
	$user_details = getAccount($value);
	
	$db = dbConn::getConnection();
	// Call the Get Deposit Date Function
	$dates_query = "Call GET_DEPOSIT_DATE('".$search_date."')";
	
	$dates_res = $db->query($dates_query);
	$deposits = $dates_res->fetchAll(PDO::FETCH_ASSOC);
	
	// Put the result on to the page so it can be accessed by the html and the php.
	$app->render('../api/resources/report_dep_day.php', array('user' => $user_details,'deposits'=>$deposits));
}
// Show the dates used to search for to be used in report 2 - View Withdrawals By Day
function withdrawsByDay($value){

	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection();
	$user_details = getAccount($value);
	
	// Call the Get Withdrawals Day Function
	$with_query = "Call GET_WITHDRAWS_DAY()";
	$with_res = $db->query($with_query );
	$withdraw_days = $with_res->fetchAll(PDO::FETCH_ASSOC);
	// Put the result on to the page so it can be accessed by the html and the php.
	$app->render('../api/resources/report_with_day.php', array('user' => $user_details,'withdraw_days' => $withdraw_days));
}

// Display report 2 - View Withdrawals By Day
function displayWithdrawals($value){

	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection();

	$request = $app->request();
	// Take the date in form the user.
	$search_date = trim($request->post('input_date'));
	
	$user_details = getAccount($value);
	
	// Call the Get Withdrawals Date Function
	$with_dates_query = "Call GET_WITHDRAW_DATE('".$search_date."')";
	$with_dates_res = $db->query($with_dates_query);
	$withdrawls = $with_dates_res->fetchAll(PDO::FETCH_ASSOC);
	
	// Put the result on to the page so it can be accessed by the html and the php.
	$app->render('../api/resources/report_with_day.php', array('user' => $user_details,'withdrawls'=>$withdrawls));
}



// Show report 5 - Customer Tickets - see how many tcikets each customer has.
function customerTickets($value){
	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection(); // Mongodb connection object
	$db_mongo_coll = mongoConn::getConnection(); // Mongodb connection object
	$user_details = getAccount($value);
	// cll the Get Ticket Information function
	$cus_query = "CALL GET_TICKET_INFO()";
	$res = $db->query($cus_query);
	$customer_info = $res->fetchAll(PDO::FETCH_ASSOC);
	$counter = 0;
	// Iterate through the array and use it to call the mongodb Nosql database.	
	foreach ($customer_info as $row) {
	
			foreach ($row as $key=>$value) {
				if($key == 'id'){
					// Count the amount tickets for a value (accounr number) in the array
					$count = $db_mongo_coll->count(array('account_num' => $value)); 
					if($count === 0){ // If there are no tickers for this account
						unset($customer_info[$counter]); // Unset the array's row. There for not seing it in the results
					}else{ 
						// If there is an account add a key to that array with the number of tickets 
						$customer_info[$counter]['tickets'] = $count;
					}
				}		
			}
		// increase the counter i.e. the row number.	
		$counter++;	
	}	
	// Put the result on to the page so it can be accessed by the html and the php.
	$app->render('../api/resources/report_tickets.php', array('user' => $user_details,'ticket_info' => $customer_info));
	
}

// Show the Open Ticket screen
function openTicket($value){

	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection();
	
	$user_details = getAccount($value);

	$app->render('../api/resources/open_ticket.php', array('user' => $user_details));
}
// Handle the ticket/form being sent in to NoSQL database
function postTicket($value){

	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection();

	$request = $app->request();
	$message = htmlspecialchars(trim($request->post('message')));
	$priority = htmlspecialchars(trim($request->post('priority')));
	$area = htmlspecialchars(trim($request->post('area')));
	$fname = htmlspecialchars(trim($request->post('fname')));
	$lname = htmlspecialchars(trim($request->post('lname')));
	$account_num = htmlspecialchars(trim($request->post('account_num')));
	$status = "Open";
	
	$db_mongo_coll = mongoConn::getConnection(); // Get a collection object to mongo
	
	if(strlen($message) > 0){
		
		try{ // build the inset statement
			$result = $db_mongo_coll->insert(array(
				'ts' => new MongoDate(),
				'account_num'=>$account_num,
				'name'=>$fname.' '.$lname,
				'message'=>$message ,
				'area'=>$area ,
				'priority'=>$priority,
				'status'=>$status
			));
		}catch(MongoCursorException $mce){
			$user_details = getAccount($value);
			$error =  array("error" =>"Sorry There was an error when posting the ticket. Please try again later.");
			$app->render('../api/resources/open_ticket.php', array('user' => $user_details,'myerror' => $error));
		}

		$user_details = getAccount($value);
		$message =  array("message" =>"Your post was successfully sent. The Help desk will get back to you soon as they can");
		$app->render('../api/resources/open_ticket.php', array('user' => $user_details,'finish' => $message));
	
	
	}else{
		$user_details = getAccount($value);
		$error =  array("error" =>"No Message Entered. Please enter a valid message.");
		$app->render('../api/resources/open_ticket.php', array('user' => $user_details,'myerror' => $error));
	
	}
	
}

// show the current tickets for a user
function viewUserTickets($value){

	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection();

	$user_details = getAccount($value);
	
	$db_mongo_coll = mongoConn::getConnection();
	// find a ticket by sccount number and show in reverse order
	$user_tickets = $db_mongo_coll->find(array('account_num'=> $user_details['id'] ))->sort(array('_id' => -1));

	$app->render('../api/resources/view_ticket.php', array('user' => $user_details,'tickets' => $user_tickets));
}

// show the all tickets
function viewAllTickets($value){

	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection();

	$user_details = getAccount($value);
	
	$db_mongo_coll = mongoConn::getConnection();
	// find all in reverse order
	$user_tickets = $db_mongo_coll->find()->sort(array('_id' => -1));

	$app->render('../api/resources/view_all_tickets.php', array('user' => $user_details,'tickets' => $user_tickets));
}
// Show the reply to a ticket forms
function replyTicket($value){

	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection();
	$user_details = getAccount($value);
	$request = $app->request();
	$ticket_id = $request->post('ticket_id');
	
	$db_mongo_coll = mongoConn::getConnection();
	// Find one by ticket id
	$user_ticket = $db_mongo_coll->findOne(array('_id'=> new MongoId($ticket_id )));
	
	$app->render('../api/resources/reply_ticket.php', array('user' => $user_details,'reply' => $user_ticket));
}


// Reply to a ticket
function postReply($value){

	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection();
	$db_mongo_coll = mongoConn::getConnection();
	$user_details = getAccount($value);
	
	$request = $app->request();
	$ticket_id = $request->post('ticket_id');
	$message = htmlspecialchars(trim($request->post('message')));
	
	if(strlen($message) > 0){
		
		$newStatus = array('$set' =>array("status"=> "Closed","response"=>$message));
		// update a ticket by ticket id using the array of detsil to channge. This is explained in the documentation
		$update_result = $db_mongo_coll->update(array("_id"=>new MongoId($ticket_id )), $newStatus);
		
		
		$user_tickets = $db_mongo_coll->find()->sort(array('_id' => -1));
		$app->render('../api/resources/view_all_tickets.php', array('user' => $user_details,'tickets' => $user_tickets));
	
	}else{
	
		$error =  array("error" =>"No Message Entered. Please enter a valid message.");
		$user_ticket = $db_mongo_coll->findOne(array('_id'=> new MongoId($ticket_id )));
		$app->render('../api/resources/reply_ticket.php', array('user' => $user_details,'reply' => $user_ticket,'myerror_reply' => $error));
	}	
}


// Change Status of a ticket
function changeStatus($value){

	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection();
	$user_details = getAccount($value);
	$request = $app->request();
	$ticket_id = $request->post('ticket_id');
	$db_mongo_coll = mongoConn::getConnection();
	
	if(isset($ticket_id)){
		
		$newStatus = array('$set' =>array("status"=> "Review"));
		// update a ticket by ticket id using the array of detsil to channge. This is explained in the documentation
		$update_result = $db_mongo_coll->update(array("_id"=>new MongoId($ticket_id )), $newStatus);
		
		$db_mongo_coll = mongoConn::getConnection();
		$user_tickets = $db_mongo_coll->find()->sort(array('_id' => -1));
		$app->render('../api/resources/view_all_tickets.php', array('user' => $user_details,'tickets' => $user_tickets));
	
	}else{
	
		$error =  array("error" =>"Database error. Please try again later.");
		$user_ticket = $db_mongo_coll->findOne(array('_id'=> new MongoId($ticket_id )));
		$app->render('../api/resources/reply_ticket.php', array('user' => $user_details,'reply' => $user_ticket,'myerror' => $error));
	}
	
}


// Delete a ticket
function postDelete($value){
	
	$app = Slim\Slim::getInstance();
	$db = dbConn::getConnection();
	$user_details = getAccount($value);
	$request = $app->request();
	$ticket_id = $request->post('ticket_id');
	$db_mongo_coll = mongoConn::getConnection();
	// remove a ticket with a chosen id
	$db_mongo_coll->remove(array('_id' => new MongoId($ticket_id)), true);
	
	$user_tickets = $db_mongo_coll->find()->sort(array('_id' => -1));

	$app->render('../api/resources/view_all_tickets.php', array('user' => $user_details,'tickets' => $user_tickets));
}

?>