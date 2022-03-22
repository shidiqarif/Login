<?php 

require_once("koneksi.php");

if(isset($_POST['login'])){

    $nip = filter_input(INPUT_POST, 'nip', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM user WHERE nip=:nip";
    $stmt = $db->prepare($sql);
    
    $params = array(
        ":nip" => $nip
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        if(password_verify($password, $user["password"])){
            session_start();
            $_SESSION["user"] = $user;
            header("Location: beranda.php");
        } else echo"<script>alert('NIP dan Password Salah!');</script>";
    }else echo"<script>alert('NIP Tidak Terdaftar');</script>";
}
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
				Silahkan Login Dengan NIP dan Password Anda!
			</div>
			<form class="form-horizontal" action="" method="POST" name="loginform">
                <input type="hidden" name="form_name" value="loginform">
				<fieldset>
					<div class="input-group">
						<span class="input-group-addon">NIP&emsp;&emsp;&emsp;&thinsp;  :</span>
						<input autofocus class="form-control" name="nip" id="nip" type="text"  type="text" onkeypress="return hanyaAngka(event)" placeholder="Harus angka ya!" required/>
					</div>
					<div class="input-group">
						<span class="input-group-addon">Password&nbsp; :</span>
						<input class="form-control" name="password" id="password" type="password" required />
					</div> <br>
					<p class="center span5">
						<input name="login" type="submit" class="btn btn-primary" value="Login">  
					</p>
				</fieldset>
				<p>
				Belum Memiliki Akun. <a href="registrasi.php">Buat Akun.</a>
				</p></br>
				<p><b>NIP</b> tidak boleh lebih dari <b>19</b> karakter dan harus berupa <b>angka</b>!</p>
				<p><b>Password</b> tidak boleh kurang dari <b>8</b> karakter!</p>
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