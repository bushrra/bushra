<?php
include('header.php');
include( 'connect.php');

		$user_id = $_POST["user"];
		$orderID = $_POST["orderID"];
	
		$radio_value = $_POST["optionsRadios"];
		$sql="INSERT INTO `submitorder`(`order_ID`, `paymentType`, `User_ID`) VALUES ('$orderID','$radio_value','$user_id')";
		if (mysqli_query($db, $sql)) {
			
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($db);
		}
			
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css-files/Style_checkout.css">
		<meta charset="UTF-8">
		<title>Submit order</title>
		<!-- Google Font -->
		<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div class="BigContiner" style="height: 100%;">
			<div class="container">
		

			<div >
				<p style="    text-align: center;    font-size: 20px; margin-top: 153px; margin-bottom: 153px;  margin-left: 338px;">
					Your order was submitted,</br>
					your order number is <?php echo "$orderID";?> . </br>
					Thank you.
				</p>
					</div>
		
			
				<?php 
				
			
unset($_SESSION["shopping_cart"]);

				
				?>
				 </div>
              </div>
	</body>
</html>
<?php include('footer.php'); ?>
