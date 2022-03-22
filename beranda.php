<?php
  session_start();
  if(!isset($_SESSION["user"])) header("Location: index.php");
?>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="css/bootstrap.css" media="screen">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script type="text/javascript" async src="../js/bsa.js"></script><style type="text/css"></style>
  <link rel="shortcut icon" href="../img/webicon.ico">
</head>
<body>
<center>
    <br><br><br><br>
	<div class="row-fluid">
		<div class="well span5 center login-box" style="width:500px; text-align:center;">
			<div class="alert alert-info">
				Anda Sudah Login!
			</div>
      <h3>NIP : <?php echo  $_SESSION["user"]["nip"] ?></h3>
      <p>Nama : <?php echo $_SESSION["user"]["nama"] ?></p>
    </div>
  </div>
  <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header"> 
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
</center>
</body>
</html>