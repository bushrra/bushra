<?php 
 
include('header.php');

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


		
		</div>
		</body>
		</html>
<?php include('footer.php'); ?>