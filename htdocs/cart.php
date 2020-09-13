<?php 
include('header.php');
include( 'connect.php');

if(isset($_SESSION['Uname'])){
    $user_id=$_SESSION['Uname'];
    
}
else {
    $user_id=1;
}
if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"],
				'item_size'		=>	$_POST["size"],
				'item_image'   => $_POST["hidden_image"],
				'item_color'   => $_POST["hidden_color"]
			);
			
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"],
			'item_size'		=>	$_POST["size"],
			'item_image'   => $_POST["hidden_image"],
			'item_color'   => $_POST["hidden_color"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}
if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{ 
		foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     echo '<script>alert("Item Removed")</script>';  
                     echo '<script>window.location="cart.php"</script>'; 
						//select all data of product from database based on the product name
						  $itemname = $values["item_name"];
						  $sqlSelect=sprintf("SELECT * FROM `ssubcategory` WHERE Title = '$itemname' ");
						  $resSelect=mysqli_query($db, $sqlSelect);
						  $rowSelect = mysqli_fetch_assoc($resSelect);
						  
						  //Update the number of available product
						  $newQuantity= $rowSelect['available_quantity'] + $values["item_quantity"];
						  $sqlUpdate=sprintf(" UPDATE `ssubcategory` SET `available_quantity`='$newQuantity' WHERE Title = '$itemname'");
						  $resSelect=mysqli_query($db, $sqlUpdate);

                        }					 
                }  
           }  
	}
    

/*
else if($_GET["action"] == "submit"){
        
        
    }
*/
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css-files/style_cart.css">
		
	</head>
	<body>
	
	<div class="BigContiner" style="height: 100%;">
	<div class="container">
	<!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form method="post" action="checkout.php">
               <div class="table-responsive">
                  <table class="table" cellspacing="0" >
                    <thead>
                      <tr>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
						<th>Size</th>
						<th>Color</th>
                        <th>Total</th>
                      </tr>
                    </thead>
					
                    <tbody>
					<?php
					$pattern = "123456";

					$OID = $pattern{rand(0,5)};
					for($i = 1; $i < 6; $i++)
					{
					$OID .= $pattern{rand(0,5)};
					}
					$OrderID = "OR".$OID;
					$Order_id=$OrderID; 
					if(!empty($_SESSION["shopping_cart"]))
					{
						
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
							$size = $values["item_size"];
							$color = $values["item_color"];
					?>
                      <tr>
                        <td><a class="remove" href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>">Remove</a></td>
                        <td><?php echo $values["item_name"]; ?></td>
                        <td>RS <?php echo $values["item_price"]; ?></td>
                        <td><?php echo $values["item_quantity"]; ?></td>
						<td><?php echo $size ?></td>
						<td><?php echo $color ?></td>
                        <td>RS <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
                      </tr>
                      
                      
                   
             
				 <?php
				 
							$total = $total + ($values["item_quantity"] * $values["item_price"]);?>
							
					<input type="hidden" name="hidden_OrderID" value="<?php echo "$Order_id"; ?>" />  
					<input type="hidden" name="hidden_total" value="<?php echo "$total"; ?>" />  
					<input type="hidden" name="hidden_size" value="<?php echo "$size"; ?>" />  
					<input type="hidden" name="hidden_color" value="<?php echo "$color"; ?>" />  


					<?php
							
						}
					?>
					   </tbody>
                  </table>
                </div>
            
					<!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td colspan="3" align="right"><?php echo number_format($total, 2); ?></td>
						
					</tr>
					<?php
					}
					?>
						
                   
                 </tbody>
               </table>
               <button  class="btn" type="submit" style="background-color: black; color: white; padding: 8px 37px; text-align: center;text-decoration: none; display: inline-block; font-size: 16px; border: none;">Proced to Checkout</a>
			    </form>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->

		
		
			
					
			</div>
           
           
           

<p id="demo"></p>

<script>
function myFunction() {
  var txt;
  if (confirm("submit!")) {
    txt="order submitted"
    window.location.href ="checkout.php"
    
   
  } else {
   txt= "fialed"
  }
  document.getElementById("demo").innerHTML = txt;
}
</script>
		</div>
	</div>
	
	</div>


		
		</div>
		</body>
		</html>

<?php include('footer.php'); ?>