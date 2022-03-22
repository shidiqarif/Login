<?php

require_once("koneksi.php");

if(isset($_POST['register'])){

    $nip = filter_input(INPUT_POST, 'nip', FILTER_SANITIZE_STRING);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);

    $sql = "INSERT INTO user (nip, password, nama) 
            VALUES (:nip, :password, :nama)";
    $stmt = $db->prepare($sql);

    $params = array(
        ":nip" => $nip,
        ":password" => $password,
        ":nama" => $nama
    );

    $saved = $stmt->execute($params);

    if($saved) header("Location: index.php");
}

?>

<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Register</title>
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
				Silahkan Melakukan Registrasi
			</div>
			<form class="form-horizontal" action="" method="POST" name="regisform">
				<fieldset>
					<div class="input-group">
						<span class="input-group-addon">NIP&emsp;&emsp;&emsp;&thinsp;  :</span>
						<input autofocus class="form-control" name="nip" id="nip" type="text" pattern=".{1,19}" title="NIP tidak boleh lebih dari 19 karakter" onkeypress="return hanyaAngka(event)" placeholder="Harus angka ya!" required/>
					</div>
					<div class="input-group">
						<span class="input-group-addon">Password&nbsp; :</span>
						<input class="form-control" name="password" id="password" type="password" pattern=".{8,}" title="Password tidak boleh kurang dari 8 karakter" required />
					</div>
					<div class="input-group">
						<span class="input-group-addon">Nama&emsp;&emsp; :</span>
						<input autofocus class="form-control" name="nama" id="nama" type="text" required/>
					</div><br>
					<p class="center span5">
						<input name="register" type="submit" class="btn btn-primary" value="Register">  
						<a href="index.php" class="btn btn-danger" > Kembali </a>
					</p></br>
					<p><b>NIP</b> tidak boleh lebih dari <b>19</b> karakter dan harus berupa <b>angka</b>!</p>
					<p><b>Password</b> tidak boleh kurang dari <b>8</b> karakter!</p>
				</fieldset>
			</form>
			<script>
		        function hanyaAngka(event) {
		            var angka = (event.which) ? event.which : event.keyCode
		            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
		                return false;
		            return true;
		        }
		    </script>
		</div>
	</div>
</center>
</body>
</html>