<?php include('server.php');
include('header.php');
// Reset Password
 if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "send")  
      {  
  if (isset($_POST['ResetPass'])) {
  $Uname = mysqli_real_escape_string($db, $_POST['Uname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 =$_POST['password_1'];
  $password_2 =$_POST['password_2'];

  if (empty($Uname)) {
  	array_push($errors, "Username is required");
  }
  if (empty($email)) {
  	array_push($errors, "Email is required");
  }
  if (empty($password_1)) {
  	array_push($errors, "New password is required");
  }
  if (empty($password_2)) { array_push($errors, "Confirm password is required"); }
  if (!empty($password_1) AND !empty($password_2) AND $password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  
  if (count($errors) == 0) {
  	$query = "SELECT * FROM usertable WHERE Uname='$Uname' AND Email='$email'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	    
     $Pass1=$_POST['password_1'];
	 $Pass2=$_POST['password_2'];
	 
	 $sql="UPDATE usertable SET password='$Pass1',RPassword='$Pass2' WHERE Uname='$Uname' AND Email='$email'";
     $results2 = mysqli_query($db, $sql);

  	}else {
  		array_push($errors, "There is no user with this Username/Email");
  	}
  }
}
	  }
 }





?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css-files/Style_ResetPassword.css">
		<title>Reset Password</title>
		<meta charset="UTF-8">
	</head>
	<body>
	<div class="BigContiner" style="height: 100%;">
  <div class="header">
  	<h2>Reset Password</h2>
  </div>
	 
  <form class="ResetPasswordForm" method="post" action="ResetPassword.php?action=send">
  	<?php include('errors.php'); ?>
	<div>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="Uname" >
  	</div>
  	<div class="input-group">
  		<label>Email</label>
  		<input type="text" name="email">
  	</div>
  	
	<div class="input-group">
  		<label>New Password</label>
  		<input type="text" name="password_1" >
  	</div>
  	<div class="input-group">
  		<label>Confirm password</label>
  		<input type="text" name="password_2">
  	</div>
	<div class="input-group">
  		<button type="submit" class="btn" name="ResetPass">Reset Password</button>
  	</div>
	</div>
  </form>

		</div>
		</body>
		</html>
<?php include('footer.php'); ?>