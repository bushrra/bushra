<?php
include( 'connect.php');
$Fname = "";
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
  $user_check_query = "SELECT * FROM `usertable` WHERE `Email`='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
	if ($user['Uname'] === $Uname) {
      array_push($errors, "Username already exists");
    }
    if ($user['email'] === $email) {
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
