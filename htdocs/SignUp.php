<?php include('header.php');
include( 'connect.php');
$Fname = "";
$Lname="";
$Uname="";
$email    = ""; 
$errors = array();
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $Fname = mysqli_real_escape_string($db, $_POST['Fname']);
  $Lname = mysqli_real_escape_string($db, $_POST['Lname']);
  $Uname = mysqli_real_escape_string($db, $_POST['Uname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $country = mysqli_real_escape_string($db, $_POST['country']);
  $city = mysqli_real_escape_string($db, $_POST['city']);
  $street = mysqli_real_escape_string($db, $_POST['street']);
  $house = mysqli_real_escape_string($db, $_POST['house']);
  $NAddress = mysqli_real_escape_string($db, $_POST['NAddress']);
  $pNumber = mysqli_real_escape_string($db, $_POST['pNumber']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($Fname)) { array_push($errors, "First name is required"); }
  if (empty($Lname)) { array_push($errors, "Last name is required"); }
  if (empty($Uname)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($country)) { array_push($errors, "country is required"); }
  if (empty($city)) { array_push($errors, "city is required"); }
  if (empty($street)) { array_push($errors, "street is required"); }
  if (empty($house)) { array_push($errors, "Adress is required"); }
  if (empty($NAddress)) { array_push($errors, "National Address is required"); }
  if (empty($pNumber)) { array_push($errors, "Phone Number is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same email
  $user_check_query = "SELECT * FROM `usertable` WHERE `Email`='$email' or `Uname`='$Uname' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
	if ($user['Uname'] === $Uname) {
      array_push($errors, "Username already exists");
    }
    if ($user['Email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO usertable (Uname,Fname,Lname,password,RPassword,Email,Country,City,Street,House,NAddress,Phone_number)
		VALUES ('$Uname','$Fname','$Lname', '$password_1' ,'$password_2' , '$email' , '$country','$city','$street', '$house','$NAddress', '$pNumber')";
  	mysqli_query($db, $query);
  	$_SESSION['Uname'] = $Uname;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}
 ?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css-files/Style_SignUp.css">
		<meta charset="UTF-8">
		<title>Sign up</title>
	</head>
	<body>
	<div class="BigContiner" style="height: 100%;">
 <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form class="SignUpForm" method="post" action="SignUp.php">
    <div>
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>First name</label>
  	  <input type="text" name="Fname" value="<?php echo $Fname; ?>" placeholder="First Name">
  	</div>
	<div class="input-group">
  	  <label>Last name</label>
  	  <input type="text" name="Lname" value="<?php echo $Lname; ?>" placeholder="Last Name">
  	</div>
	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="Uname" value="<?php echo $Uname; ?>" placeholder="UserName">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>" placeholder="example@example.com">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
	<div class="input-group">
  	  <label>County</label>
  	  <input type="text" name="country" placeholder="Saudi Arabia">
  	</div>
	<div class="input-group">
  	  <label>City</label>
  	  <input type="text" name="city" placeholder="Riyadh">
  	</div>
	<div class="input-group">
  	  <label>Street</label>
  	  <input type="text" name="street"  placeholder="Stret No. 93">
  	</div>
	<div class="input-group">
  	  <label>Address</label>
  	  <input type="text" name="house" placeholder="House NO. 101">
  	</div>
	<div class="input-group">
  	  <label>National Address</label>
  	  <input type="text" name="NAddress" placeholder="12345">
  	</div>
	<div class="input-group">
  	  <label>Phone Number</label>
  	  <input type="text" name="pNumber" placeholder="+966 500000000">
  	</div>
  	<div class="input-group" style="display:contents; margin: 10px;">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  		<p>Already a member? <a href="SignIn.php">Sign in</a></p>
  </div>
  </form>
		
		</div>
		</body>
		</html>
<?php include('footer.php'); ?>