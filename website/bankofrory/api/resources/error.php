<?php $pagename = "Error"; 
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
		<div id="report">
			<?php if (isset($myerror)) { ?>
						<div class="alert alert-danger" role="alert">
								<p class="alert-link error_message">Error: <?php echo $myerror['error'];?> </p>
						</div>
             <p><a href="./login" style="color:white;"><-- Click here to Log in</a></p>
			 <?php }  ?>
			
		</div>
	 </div> <!-- /container -->
<?php
    include 'view/footer.php';
?>