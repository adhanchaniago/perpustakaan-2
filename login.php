	<?php 
		include "db/koneksi.php";
		session_start();
		// $i = 1;
		// if ($i == 1){
		// 	echo "coba";
		// 
		
		if (isset($_SESSION['admin']) OR isset($_SESSION['anggota']) ) {
			echo "masuk";
			
			if (isset($_SESSION['admin']) ) {
				header("location:index.php");
			}
			else {
				header("location:member/index.php");
			}
		}else{
			$error = "";
			if(isset($_POST['submit'])){
				$username = $_POST['username'];
				$password = $_POST['password'];
				$cek = mysqli_query($dbConn, "SELECT * FROM petugas WHERE nama = '$username' AND password = '$password' ") or die(mysqli_error());
				$cek2 = mysqli_query($dbConn, "SELECT * FROM anggota WHERE nisn = '$username' AND password = '$password' ") or die(mysqli_error());
				if (mysqli_num_rows($cek) == 1) {
					$data = mysqli_fetch_array($cek);
					echo $_SESSION['admin'] = $data['1'];
					header("location:index.php");
				}else if (mysqli_num_rows($cek2) == 1 ){
					$data = mysqli_fetch_array($cek2);
					echo $_SESSION['anggota'] = $data['1'];
					header("location:member/index.php");
				}else{
					$error = "Username atau Password Salah";
				}
			}?>
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.css">
	
	<div class="row">
		<div class="col m6 offset-m3">
			<h3 class="center-align">Login <span class="orange-text">Area</span></h3>
			<div class="card z-depth-2">
				<div class="card-content">
					<form  method="POST">
						<div class="input-field"> 
							<input type="text" class="validate" name="username" autocomplete="off" required="">	
							<label>Username</label>
						</div>
						<div class="input-field">
							<input type="password"  name="password" autocomplete="off" required="">
							<label>Password</label>
						</div>
						<div class="row">
							<button type="submit" class="btn waves-effect waves-light" name="submit">Login</button> 
						</div>
					</form>
				</div>
				<p class="center-align red-text"><?=$error ?></p>
			</div>
		</div>
	</div>
	
	<?php include "templates/footer.php"; ?>
	<?php } ?>