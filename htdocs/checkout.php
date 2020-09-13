<?php 
include('header.php');
include( 'connect.php');

$pattern = "1234567890";
$user_id;
if(isset($_SESSION['Uname'])){
    $user_id=$_SESSION['Uname'] ;
    
}
else {
	  echo '<script>alert("You must sign in to countinue to check out!!")</script>';  
	  echo '<script>window.location="SignIn.php"</script>';  

	
}
	$Order_id=$_POST['hidden_OrderID'];
	$total=$_POST['hidden_total'];
	

    if(!empty($_SESSION["shopping_cart"]))
					{
						
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
						  $itemname=$values['item_name'];
                          $qt=$values['item_quantity'];
						  $pr=$values['item_color'];
						  $size = $values["item_size"];

						  $color = $values["item_color"];
                         $sql_statement=sprintf("INSERT INTO `shopping`(`User_ID`, `product`, `quantity`,`size`,`color`, `price`, `Order_id`,`date`) VALUES  
                          ('$user_id','$itemname','$qt','$size','$color','$total','$Order_id',NOW())");
                         // echo  $sql_statement;
                          $res = mysqli_query($db, $sql_statement);

						  
						if(!$res) {
							print("MySQL error: " . mysqli_error($db));
						echo "could not insert order";
								}
						//select all data of product from database based on the product name
						  $sqlSelect=sprintf("SELECT * FROM `ssubcategory` WHERE Title = '$itemname' ");
						  $resSelect=mysqli_query($db, $sqlSelect);
						  $rowSelect = mysqli_fetch_assoc($resSelect);
						  
						  //Update the number of available product
						  $newQuantity= $rowSelect['available_quantity'] - $qt;
						  $sqlUpdate=sprintf(" UPDATE `ssubcategory` SET `available_quantity`='$newQuantity' WHERE Title = '$itemname'");
						  $resSelect=mysqli_query($db, $sqlUpdate);

                        }
                        
                        
                    }
  
		$sql_statement=sprintf("select * from `shopping` WHERE Order_id='$Order_id' ");
        $res = mysqli_query($db, $sql_statement);
		if(!$res) {
			print("MySQL error: " . mysqli_error($db));
			echo "could not insert order";
		}
		

	 
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css-files/Style_checkout.css">
		<!-- Google Font -->
		<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
		<title>Check out</title>
	</head>
	<body>
		<div class="BigContiner" style="height: 100%;">
			<div class="container">
			
			<form action="SubmitOrder.php" method="POST">
			
			
                <div class="checkout">
                  <h4>Order Summary</h4>
                  <div class="order-summary">
                    <table class="table" cellspacing="0">
						<thead>
                        <tr>
                          <th>Product</th>
						  <th>Quantity</th>
                        </tr>
						</thead>
                        <?php
							//product`,`quantity`,`price
                                    while($row = mysqli_fetch_assoc($res)) {?>
								<tbody>
								<tr>    
									<td class="column1"><?php echo $row['product'];?></td>
									<td class="column2"><?php echo $row['quantity'];?></td>
									<input type="hidden" name="Product"  value="<?php echo $row['product'];?>">
									<input type="hidden" name="quantity"  value="<?php echo $row['quantity'];?>">

								</tr>
								</tbody>
								
							<?php }?>
							<tfoot>
								<tr>    
									<th>Total</th>
									<td class="column1"><?php echo "$total";?></td>
									<input type="hidden" name="user"  value="<?php echo "$user_id";?>">
									<input type="hidden" name="orderID"  value="<?php echo "$Order_id";?>">


								</tr>
								</tfoot>
                    </table>
					
				  
				  <!--payment options-->
                  <h4>Payment Method</h4>
                  <div class="payment-method">                    
                    <label for="cashdelivery"><input type="radio" id="cashdelivery" name="optionsRadios" value="Cash"checked> Cash on Delivery </label>
                    <label for="paypal"><input type="radio" id="paypal" value="PayPal" name="optionsRadios" disabled > Via Paypal 
                    <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0" alt="PayPal Acceptance Mark"> </label>   
                  </div>
				  <input type="submit" value="Place Order"style="margin-top:5px;" class="Checkbtn">                

                </div>
				
			</form>
				
				
				 </div>
              </div>
			  </div>
	</body>
</html>
<?php include('footer.php'); ?>
