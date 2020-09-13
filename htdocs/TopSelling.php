<?php 
include('header.php');
include( 'connect.php');

 ?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css-files/Style_Orders.css">
	</head>
	<body>
	<div class="BigContiner" style="height: 100%;">
	
		<div class="header">
		 <h3>Top selling</h3>
		</div>
		<div class="Orders" align="center">

                         <table class="table" cellspacing="0" >
                    <thead>
                      <tr>
                        
                        <th>Products </th>
						<th>Color</th>
						<th>Size</th>
						<th>Quantity</th>
                      </tr>
                    </thead>
					
                    <tbody>
					<div class="ProductList" style="display: flow-root;">
					<?php
					$sql =sprintf("SELECT `product`, `color`, `size`, sum(quantity) as quantity FROM `shopping` group by `product` ");
					$resSelect=mysqli_query($db, $sql);
					
					if(mysqli_num_rows($resSelect) > 0)
						{
					while($rowSelect = mysqli_fetch_assoc($resSelect))
					{
						$nameSelect= $rowSelect['product'];
						$quantitySelect= $rowSelect['quantity'];
						
						$sql2 =sprintf("SELECT `color`, `size` FROM `shopping` WHERE `product` ='$nameSelect' ");
						$resSelect2=mysqli_query($db, $sql2);
					
						if(mysqli_num_rows($resSelect2) > 0)
							{
						while($rowSelect2 = mysqli_fetch_assoc($resSelect2))
							{
								$colorSelect= $rowSelect2['color'];
								$sizeSelect= $rowSelect2['size'];
							}
							}
						
					 
					$name= $nameSelect;
                    $quantity= $quantitySelect;
                    $color= $colorSelect;
                    $size= $sizeSelect;
						
					$sqlInsert =sprintf("INSERT INTO `topselling`(`productName`, `quantity`, `color`, `size`) VALUES ('$name','$quantity','$color','$size')");
					$resInsert=mysqli_query($db, $sqlInsert);
					
					}
						}
					$sql3 =sprintf("SELECT * FROM `topselling`");
					$resSelect3=mysqli_query($db, $sql3);
					if(mysqli_num_rows($resSelect3) > 0)
						{
					while($rowSelect3 = mysqli_fetch_assoc($resSelect3))
					{
				?>
				
				
                      <tr>
                        <td><?php echo $rowSelect3["productName"]; ?></td>
						
						<td><?php echo $rowSelect3["color"]; ?></td>
						<td><?php echo $rowSelect3["size"]; ?></td>
						<td>
						
                        <?php echo $rowSelect3["quantity"]; ?>
															
						</td>
                      </tr>
                      
                      
                   
             
				 <?php
							}
							}
					
					?>
					   </tbody>
                  </table>
                        </div>
			
				

			</div>


		
		</div>
		</body>
		</html>
<?php include('footer.php'); ?>