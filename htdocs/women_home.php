<?php include( 'connect.php');

require_once 'header.php'; 
?>

<!DOCTYPE html>
<html>
<head>

  <title>women homebage</title>

  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="./slick/slick.css">
  <link rel="stylesheet" type="text/css" href="./slick/slick-theme.css">
  <link rel="stylesheet" type="text/css" href="css-files/Style_home.css">

  
  <style type="text/css">
  
    html, body {
      margin: 0;
      padding: 0;
    }

    * {
      box-sizing: border-box;
    }

    .slider {
            width: 70%;
    margin: 100px auto;
    border: 1px solid #c4c0c0;
    box-shadow: 1px 3px #edebeb;
}


    }

    .slick-slide {
      margin: 0px 20px;
    }

    .slick-slide img {
      width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
      color: black;
    }


    .slick-slide {
      transition: all ease-in-out .3s;
      opacity: .2;
    }
    
    .slick-active {
      opacity: .5;
    }

    .slick-current {
      opacity: 1;
    }
  </style>
</head>
<body>
<div class="BigContiner" style="height: 100%;">
	
		<div class="container">
<h3>clothes</h3>
<section class="regular slider">

  <?php
				$query = "SELECT * FROM ssubcategory where typeID=1 and catID=1  ";
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
  </section>
  <h3>Accessories</h3>
  <section class="regular slider" >
    


  <?php
				$query = "SELECT * FROM ssubcategory where typeID=1 and catID=2";
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
  </section>
  <h3>shoes</h3>
  <section class="regular slider" >

  <?php
				$query = "SELECT * FROM ssubcategory where typeID=1 and catID=3  ";
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
  </section>
  <h3>bags</h3>
  <section class="regular slider" >

  <?php
				$query = "SELECT * FROM ssubcategory where typeID=1 and catID= 4 ";
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
  </section>
 

  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
  <script src="./slick/slick.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    
      $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 3
      });
  
</script>

	</div>


		
		</div>
		</body>
		</html>
<?php include('footer.php'); ?>