<?php 
include('header.php');
include( 'connect.php');

 ?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css-files/Style_Ssubcategory.css">
		<title>Top picks</title>
	</head>
	<body>
	<div class="BigContiner" style="height: 100%;">
	
		<div class="container">
		 <h3>Top Picks</h3>
		</div>
		
			<div class="ProductList" style="display: flow-root;">
					<?php
					$sql =sprintf("SELECT `product`, sum(quantity) FROM `shopping` group by `product` Order by sum(quantity) desc Limit 50");
					$resSelect=mysqli_query($db, $sql);
					
					
					if(mysqli_num_rows($resSelect) > 0)
						{
					while($rowSelect = mysqli_fetch_assoc($resSelect))
					{
						$productName= $rowSelect['product'];
				$query = "SELECT * FROM ssubcategory WHERE Title = '$productName' ";
				$result = mysqli_query($db, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
						?>
				<form class="Pform" method="post" action="display_item.php?id=<?php echo $row["SsubID"]; ?>">
					<div class="product" align="center">
						<img src="<?php echo $row["img"]; ?>" height="350px" width="250px" /><br />

						<h4 class="text-info"><?php echo $row["Title"]; ?></h4>

						<h4 class="text-danger">RS <?php echo $row["Price"]; ?></h4>
						<input type="hidden" name="hidden_name" value="<?php echo $row["Title"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["Price"]; ?>" />

						<input type="submit" name="Buy" style="margin-top:5px;" class="btnBuy" value="Buy" />

					</div>
				</form>
				<?php
					}
				}
					}
						}
			    ?>

			</div>


		
		</div>
		</body>
		</html>
<?php include('footer.php'); ?>