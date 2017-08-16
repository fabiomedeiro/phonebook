<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <title>Journal Phone Tools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="ico/favicon.png">
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" class="active" href="index.php">Journal Phone Tools</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="edit.php">Edit / Sync</a></li>
              <li><a href="addphones.php">Add Phone</a></li>
              <li><a href="contact.php">Contact</a></li>
	      <li><a href="blueface.php">Blueface</a></li>
            </ul>
		<?php
			include 'functions.php';
			if(check_session() == 1 )
			{
				echo '<form class="navbar-form pull-right" id="sign_in" name="login" method="post" action="login.php">
                               			 <input class="span2" id="username" name="user" type="text" placeholder="Email">
                                		<input class="span2" id="password"name="pass" type="password" placeholder="Password">
                                		<button type="submit" id="sign_in_btn" class="btn">Sign in</button>
                        		</form>';
			}else{
				echo '<form class="navbar-form pull-right" name="logout" method="post" action="logout.php">
					 <button type="submit" id="sign_out_btn" class="btn pull-right" action="logout.php">Sign Out</button>
				</form>';
			}
	  ?>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
  </body>
</html>
