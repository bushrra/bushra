
<?php
include( 'connect.php');
include( 'header.php');

 ?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css-files/Style_Ssubcategory.css">
		<meta charset="UTF-8">
		<title>Search result</title>
	</head>
	<body>
	<div class="BigContiner" style="height: 100%;">
	
		<div class="container">
		 <h3>Search </h3>
		</div>
		
			<div class="ProductList" style="display: flow-root;">
			<?php
				if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "send")  
      {  
				$search = $_POST['search'];
				if(!empty($search)){
				$query = "SELECT * FROM ssubcategory WHERE Title LIKE '%$search%'  ";
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
				}else{
					?>
					<h3>There is no product such as what you search :( </h3>
					<?php
				}
	  }else{
		  ?>
					<h3>No inputs to search </h3>
					<?php
	  }
 }
 }
			    ?>

			</div>


		
		</div>
		</body>
		</html>
<?php include('footer.php'); ?>