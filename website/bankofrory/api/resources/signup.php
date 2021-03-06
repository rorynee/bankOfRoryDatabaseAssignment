 <?php $pagename = "Sign Up"; ?> 
<?php include 'view/header.php'; ?>

   <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./"><img src="images/icon.png" alt="Bank of Rory Logo" align="middle">&nbsp;Bank of Rory</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="./">Home</a></li>
            <li><a href="./about">About</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="./login">Log in</a></li>
            <li class="active"><a href="./signup">Sign Up</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
	  <p>&nbsp;</p>
        <div id="headingWhite"><img src="images/borlogo.png" alt="Bank of Rory Logo"  align="middle">&nbsp;Bank of Rory</div>
        <p>Please fill out the form below to regiater as a new account.</p> 
        <p>Thanking for Banking at the Bank Of Rory</p> 
        <div>
				<?php if (isset($myerror)) { ?>
						<div class="alert alert-danger" role="alert">
								<p class="alert-link error_message">Error: <?php echo $myerror['error'];?> </p>
						</div>
            <?php }  ?>	
            <form class="form-signin" role="form" method="POST" action="./signup">
              <div class="form-group form-group-lg">
                <label for="inputEmail3" class="col-sm-2 control-label">Username/Email</label>
                <div class="col-sm-4">
                  <input type="email" class="form-control" name="inputEmail3" placeholder="Email Address" required autofocus>
                </div>
              </div>
              <p>&nbsp;</p>
              <div class="form-group form-group-lg">
                <label for="input_fname" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="input_fname" placeholder="First Name" required>
                </div>
				<p>&nbsp;</p>
              </div>
			  <div class="form-group form-group-lg">
                <label for="input_lname" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="input_lname" placeholder="Last Name" required>
                </div>
				<p>&nbsp;</p>
              </div>
              
			  <div class="form-group form-group-lg">
                <label for="input_age" class="col-sm-2 control-label">Age</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="input_age" placeholder="Age" required>
                </div>
              </div>
              <p>&nbsp;</p>
              <div class="form-group form-group-lg">
                <label for="input_street" class="col-sm-2 control-label">Street</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="input_street" placeholder="Street" required>
                </div>
              </div>
              <p>&nbsp;</p>
			  <div class="form-group form-group-lg">
                <label for="input_city" class="col-sm-2 control-label">City</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="input_city" placeholder="City" required>
                </div>
				<p>&nbsp;</p>
              </div>
			  <div class="form-group form-group-lg">
                <label for="input_country" class="col-sm-2 control-label">Country</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="input_country" placeholder="Country" required>
                </div>
              </div>
			  <p>&nbsp;</p>
              <div class="form-group form-group-lg">
                <label for="input_pass" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-4">
                  <input type="password" class="form-control" name="input_pass" placeholder="Password" required>
                </div>
              </div>
              <p>&nbsp;</p>
			  <div class="form-group form-group-lg">
                <label for="input_cpass" class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-4">
                  <input type="password" class="form-control" name="input_cpass" placeholder="Confirm Password" required>
                </div>
              </div>
              <p>&nbsp;</p>
              <div class="form-group form-group-lg">
                <div class="col-sm-offset-2 col-sm-4">
                  <button type="submit" class="btn btn-lg btn-primary btn-block">Create Account</button>
                </div>
              </div>
            </form>
         </div>
		 
        <p>&nbsp;</p>
<p>
      <img src="images/bank-icon.png" alt="bank" width="138" height="138" align="right">
      </p>
      </div>
        
      </div>
	  
	 

    </div> <!-- /container -->
	<?php include 'view/footer.php'; ?>