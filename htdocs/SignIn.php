<?php include('header.php');

$errors = array();
include( 'connect.php');

// LOGIN USER
if(isset($_SESSION['Uname']))   // Checking whether the session is already there or not if 
                              // true then header redirect it to the home page directly 
 {
    header("Location:indexSignIn.php");
 }
 
if (isset($_POST['login_user'])) {
  $Uname = mysqli_real_escape_string($db, $_POST['Uname']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($Uname)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$query = "SELECT * FROM usertable WHERE Uname='$Uname' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['Uname'] = $Uname;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: indexSignIn.php');
  	}else {
  		array_push($errors, "Wrong Username/password combination");
  	}
  }
}



 ?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css-files/Style_SignIn.css">
		<meta charset="UTF-8">
		<title>Sign in </title>
	</head>
	<body>
	<div class="BigContiner" style="height: 100%;">
	<div class="header">
  	<h2>Login</h2>
  </div>
  <form class="SignInForm" method="post" action="SignIn.php">
  
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="Uname" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="SignUp.php">Sign up</a><br/>
		Forget Password? <a href="ResetPassword.php">Click here</a>
  	</p>
  </form>
		</div>
		</body>
		</html>
<?php include('footer.php'); ?>