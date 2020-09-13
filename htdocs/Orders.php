<?php
include( 'header.php');
include( 'connect.php');

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css-files/Style_Orders.css">
	</head>
	<body>
	<div class="BigContiner" style="height: 100%;">
	
		<div class="header" style="width: 800px;">
		 <h3>Orders</h3>
		</div>
		
<div >
		<div class="container">
			<div >
				<div class="Orders" align="center" style="width: 800px;">

                         <table class="table" cellspacing="0" >
                    <thead>
                      <tr>
                        
                        <th>Order ID </th>
                        <th>Products </th>
						<th>Total price</th>
						<th>Payment Type</th>
                      </tr>
                    </thead>
					
                    <tbody>
					<?php

						
						$sql = "SELECT Order_id ,price, GROUP_CONCAT(product,' - ',size,' x ',quantity SEPARATOR '</br>') as orderproduct
						FROM shopping
						GROUP BY Order_id";
						$res = mysqli_query($db, $sql);
						if(mysqli_num_rows($res) > 0)
							{
						while($row = mysqli_fetch_array($res))
							{
								$OREDER_ID=$row['Order_id'];
					?>
                      <tr>
                        <td><?php echo $row["Order_id"]; ?></td>
						<td>
						
                        <?php echo "</br>".$row["orderproduct"].",</br>" ?>
															
						</td>
						<td><?php echo $row["price"]; ?></td>
						<td>
						<?php 
							  $sqlProduct = "SELECT * FROM submitorder WHERE Order_id='$OREDER_ID' ";
							  $resProduct = mysqli_query($db, $sqlProduct);
							  if(mysqli_num_rows($resProduct) > 0)
									{
								while($rowProduct = mysqli_fetch_array($resProduct))
									{
						?>
                        <?php echo $rowProduct["paymentType"]; ?>
						
									<?php }}?>
						</td>
                      </tr>
                      
                      
                   
             
				 <?php
							}}
					?>
					   </tbody>
                  </table>
                        </div>
						</div>
                        </div>
</div>  
</div>
		</body>
		</html>
<?php include('footer.php'); ?>