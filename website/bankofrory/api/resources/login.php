<?php $pagename = "Log In"; 
 include 'view/header.php';
 
 ?>

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
            <li class="active"><a href="./login">Log in</a></li>
            <li><a href="./signup">Sign Up</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
	  <p>&nbsp;</p>
        <div id="headingWhite"><img src="images/borlogo.png" alt="Bank of Rory Logo"  align="middle">&nbsp;Bank of Rory</div>
        <p>&nbsp;</p>
        <p id="centertext">Please login to view your account information.</p>
       
        <form class="form-signin" method="POST" action="./login" >
                  
                    <?php if (isset($finish)) { ?>
                        <div  class="alert alert-success" role="alert">
                             <p class="alert-link error_message"><?php echo $finish['message'];?></p>
                        </div>
                    <?php }  ?>
                  <input type="email" class="form-control" name="username" placeholder="Username" required autofocus>
                  <br/>
                  <input type="password" class="form-control" name="password" placeholder="Password" required>
					<?php if (isset($myerror)) { ?>
						<div class="alert alert-danger" role="alert">
								<p class="alert-link error_message">Error: <?php echo $myerror['error'];?> </p>
						</div>
                    <?php }  ?>
                  <button class="btn btn-lg btn-primary btn-block" id="button_green" type="submit">Sign in</button>
                  <div id="reglink">
                    <p><a href="./signup" style="color:white;">Register Now</a></p>
                  </div>
         </form>
<p>
      <img src="images/bank-icon.png" alt="bank" width="138" height="138" align="right">
      </p>
      </div>
        
      </div>
	  
	 

    </div> <!-- /container -->
	<?php include 'view/footer.php'; ?>