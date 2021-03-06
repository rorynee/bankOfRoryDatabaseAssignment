  <?php $pagename = "About"; ?>    
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
            <li class="active"><a href="./about">About</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="./login">Log in</a></li>
            <li><a href="./signup">Sign Up</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
	  <p>&nbsp;</p>
        <div id="headingWhite"><img src="images/borlogo.png" alt="Bank of Rory Logo"  align="middle">&nbsp;Bank of Rory - About</div>
        <p>The Bank of Rory bank is a well-established online bank since 2014. We have lots of happy customers. They are happy to bank with us for many different reasons.</p>
		<p class="tab">Great bank rates.</p> 
		<p class="tab">Able to deposit and withdraw money as you wish.</p>
		<p>If you have an enquiry or need help you can ask our support team and they will get back to you as soon as possible.<br/>Bank with us now and avail of our great services.

		</p>
		<p>Bank with us now with Bank of Rory. You can take that to the back.</p>
        <p>&nbsp;</p>
<p>
      <a class="btn btn-lg btn-primary" id="bag" href="./signup" role="button">Sign Up Now &raquo;</a><img src="images/bank-icon.png" alt="bank" width="138" height="138" align="right">
      </p>
      </div>
        
      </div>

    </div> <!-- /container -->
	<?php include 'view/footer.php'; ?>