<?php 

include('headerSignIn.php');
include( 'connect.php');

 ?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css-files/Style_index.css">
		<meta charset="UTF-8">
		<title>iShopStore</title>
	</head>
	<body>
	<div class="BigContiner" style="height: 100%;">
	
		<div class="container">
		 <div class="slidShow" style="max-width:width: 100%; ">
			<img class="mySlides" src="iShop-img/h1.jpg" style="width: 100%; height: 550px; display: none;">
			<img class="mySlides" src="iShop-img/h2.jpg" style="width: 100%; height: 550px; display: none;">
			<img class="mySlides" src="iShop-img/h3.jpg" style="width: 100%; height: 550px; display: block;">
			<img class="mySlides" src="iShop-img/h4.jpg" style="width: 100%; height: 550px; display: none;">
		  </div>
		</div>
		<script>
		var myIndex = 0;
		carousel();

		function carousel() {
			var i;
			var x = document.getElementsByClassName("mySlides");
			for (i = 0; i < x.length; i++) {
			x[i].style.display = "none";  
			}
			myIndex++;
			if (myIndex > x.length) {myIndex = 1}    
			x[myIndex-1].style.display = "block";  
			setTimeout(carousel, 5000); // Change image every 5 seconds
		}
	</script>
			
			<a href="New.php"><img class="NewImg" src="iShop-img/New.jpg" ></a>
			<a href="discount.php"><img class="DiscountImg" src="iShop-img/Discount.jpg" style="float:left;"></a>
			<a href="TopPicks.php"><img class="TopPicksImg" src="iShop-img/TopPicks.jpg" ></a>

			
			<div class="ProductList" style="display: flow-root;">
					<?php
					if(isset($_SESSION['Uname'])){
						$user_id=$_SESSION['Uname'];
					}
					

					//count the diffreace between last order and lasr view to check out the last one between them
					$now = time();
					//last order
					$sqlOdrder="SELECT  `date` FROM  `shopping` WHERE  `User_ID` =  '$user_id' ORDER BY  `date` DESC LIMIT 1";
					$resultOrder = mysqli_query($db, $sqlOdrder);
					$rowOrder = mysqli_fetch_array($resultOrder);
					
					
					$dateOrder=$rowOrder['date'];
					$Orderdate = strtotime($dateOrder);
					$Orderdatediff = $now - $Orderdate;
					$OrderdateResult= round($Orderdatediff / (60 * 60 * 24));
					//last view
					$sqlView="SELECT `date` FROM  `views` WHERE `User_ID`='$user_id' ORDER BY `date` DESC LIMIT 3";
					$resultView = mysqli_query($db, $sqlView);
					$rowView = mysqli_fetch_array($resultView);
					
					
					$dateView=$rowView['date'];
					$Viewdate = strtotime($dateView);
					$Viewdatediff = $now - $Viewdate;
					$ViewdateResult= round($Viewdatediff / (60 * 60 * 24));
					if($OrderdateResult<=$ViewdateResult){
						?>
						<div class="ForYou" style="display: flow-root;">
					
					<?php
						$queryOrder = "SELECT `product` FROM `shopping` WHERE  `User_ID` =  '$user_id' AND `date`='$dateOrder'  ORDER BY  `date` DESC LIMIT 3";
						$resultOrder = mysqli_query($db, $queryOrder);
						
						if(mysqli_num_rows($resultOrder) > 0)
							{
								?>
								<h3 style="padding-top: 20px; padding-left: 30px;font-size: 27px; margin-bottom: 10px;">For You</h3>
								<?php
							while($row = mysqli_fetch_array($resultOrder))
							{
								$title=$row['product'];
								$query = "SELECT * FROM  `ssubcategory` WHERE  `Title` =  '$title'";
								$result = mysqli_query($db, $query);

								if(mysqli_num_rows($result) > 0)
								{
								while($row = mysqli_fetch_array($result))
								{
									$color=$row['color'];
								$typeID=$row['typeID'];
								$subcatID=$row['subcatID'];
								$query = "SELECT * FROM  `ssubcategory` WHERE  `color` =  '$color' AND  `typeID` ='$typeID' AND  `subcatID` ='$subcatID'";
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
							}
				}
				
				?>
				</div>
				<div class="others" style="display: flow-root;">
					<h3 style="padding-top: 20px; padding-left: 30px;font-size: 27px; margin-bottom: 10px;">You might like</h3>
					
					<?php
				$query = "SELECT * FROM ssubcategory ORDER BY RAND() LIMIT 32";
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
				?>
				</div>
				<?php
				}
			    elseif($ViewdateResult<$OrderdateResult){
					?>
					<div class="ForYou" style="display: flow-root;">
					<h3 style="padding-top: 20px; padding-left: 30px;font-size: 27px; margin-bottom: 10px;">For You</h3>
					<?php
					    $queryView = "SELECT `Ssub_ID` FROM  `views` WHERE  `date`='$dateView' AND User_ID='$user_id' ORDER BY  `date` DESC";
						$resultView = mysqli_query($db, $queryView);
						if(mysqli_num_rows($resultView) > 0)
							{
							while($row = mysqli_fetch_array($resultView))
							{
								$SsubID=$row['Ssub_ID'];
						$queryOrder = "SELECT * FROM  `ssubcategory` WHERE `SsubID`='$SsubID'";
						$resultOrder = mysqli_query($db, $queryOrder);
						if(mysqli_num_rows($resultOrder) > 0)
							{
							while($row = mysqli_fetch_array($resultOrder))
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
							}?>
							</div>
				<div class="others" style="display: flow-root;">
					<h3 style="padding-top: 20px; padding-left: 30px;font-size: 27px; margin-bottom: 10px;">You might like</h3>
					
					<?php
				$query = "SELECT * FROM ssubcategory ORDER BY RAND() LIMIT 32";
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
				?>
				</div>
				<?php
				}
				?>

			</div>


		
		</div>
		</body>
		</html>
<?php include('footer.php'); ?>