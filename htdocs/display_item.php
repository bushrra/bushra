<?php

include ('header.php');
include( 'connect.php');

$connect = mysqli_connect("localhost", "root", "", "ai_shopping");

if(isset($_GET['id'])&&(is_numeric($_GET['id']))){
$id= $_GET['id'];  

if(isset($_SESSION['Uname'])){
    $user_id=$_SESSION['Uname'];
}
else{
	$user_id="unknownCustomer";
}
$sql_statementView=sprintf("INSERT INTO `views`(`User_ID`, `Ssub_ID`, `date`) VALUES ('$user_id','$id',NOW())");
//echo $sql_statement;
$resView = mysqli_query($db, $sql_statementView);



$sql_statement=sprintf("SELECT * FROM ssubcategory 
    WHERE `SsubID`=$id limit 1");
//echo $sql_statement;
$res = mysqli_query($db, $sql_statement);


if(!$res) {
  print("MySQL error: " . mysqli_error($db));
 echo "could not find the required  product";
}
else
{
 //echo "dish found";   

//$c=0;
//echo mysqli_fetch_assoc($res);
////$row = mysqli_fetch_assoc($res);
//echo  count(mysqli_fetch_assoc($res));
$dishes = array();
   while ($row = mysqli_fetch_assoc($res)){
		if($row['available_quantity'] > 0){
       array_push($dishes, $row);
		}else{
			 echo '<script>alert("The product not available!!")</script>';  
			echo '<script>window.location="index.php"</script>';  
		
		}
    }

   $dish= $dishes[0]; 
   $name= $dish['Title'];
                    $type= $dish['typeID'];
                    $price= $dish['Price'];
                    $description= $dish['description'];
                    $image= $dish['img'];
                    $id= $dish['SsubID'];
                    $category=$dish['catID'];
                    $sub_category=$dish['subcatID'];
                    $available=$dish['available_quantity']; 
                    $color= $dish['color'];

                    $sql_statement=sprintf("SELECT * FROM type 
    WHERE `TypeId`=$type"
   );
//echo $sql_statement;
$res1 = mysqli_query($db, $sql_statement);


if(!$res1) {
  print("MySQL error: " . mysqli_error($db));
 echo "could not find the required  type";
}
else{
$types = array();
   while ($row1 = mysqli_fetch_assoc($res1)){

       array_push($types, $row1);

    }

   $type_name= $types[0]['Info']; 
   }
   
   
$sql_statement=sprintf("SELECT * FROM `main category`
    WHERE `cat_id`=$category"
   );
//echo $sql_statement;
$res2 = mysqli_query($db, $sql_statement);


if(!$res2) {
  print("MySQL error: " . mysqli_error($db));
 echo "could not find the required  category";
}
else{
$catrgories = array();
   while ($row2 = mysqli_fetch_assoc($res2)){

       array_push($catrgories, $row2);

    }

   $category_name= $catrgories[0]['category']; 
   }
   
   
$sql_statement=sprintf("SELECT * FROM sub_category 
    WHERE `subcat_id`= $sub_category"
   );
//echo $sql_statement;
$res3 = mysqli_query($db, $sql_statement);


if(!$res3) {
  print("MySQL error: " . mysqli_error($db));
 echo "could not find the required  sub category";
}
else{
$subcats = array();
   while ($row3 = mysqli_fetch_assoc($res3)){

       array_push($subcats, $row3);

    }

   $subcategory_name= $subcats[0]['sub_cat']; 
   }
?>
<html>
<head>
<title>Display products</title>

<link rel="stylesheet" type="text/css" href="css-files/Style_displayItem.css">
<link rel="stylesheet" type="text/css" href="css-files/Style_index.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<Body>
		<div class="container" style=" height: 100%;">
			<div class="SubContainer">
				<div class="wrap-table100">
					<div class="table100" style="margin-top: 45px; padding-left: 50px;font-family: sans-serif;">
						<h2><?php echo  $name?></h2>
						<div class="w3-content w3-display-container" style="    width: 250px; float: left;">
							<div class="w3-display-container mySlides">
								<img src="<?php echo $image?>" style="width:250px">
							</div>

							<button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)">&#10094;</button>
							<button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)">&#10095;</button>
						</div>
					</div>
				</div>
			<script>
				var slideIndex = 1;
				showDivs(slideIndex);

				function plusDivs(n) {
					showDivs(slideIndex += n);
				}

				function showDivs(n) {
					var i;
					var x = document.getElementsByClassName("mySlides");
					if (n > x.length) {slideIndex = 1}
					if (n < 1) {slideIndex = x.length}
				for (i = 0; i < x.length; i++) {
					x[i].style.display = "none";  
				}
				x[slideIndex-1].style.display = "block";  
				}
			</script>
	
		<div style= "padding-left: 345px;">
			<p><strong>Price </strong></p>
			<form method="post" action="cart.php?id=<?php echo $id; ?>">
				<p><?php echo ("price ".$price." SR")?></p>
				<p><strong>Product size </strong></p>
	
				<select name="size">
				<?php 
					$sqlSize = "SELECT * FROM `Size` WHERE `	Ssub_ID`='$id'";
					$resSize = mysqli_query ($db, $sqlSize);
					while($r = mysqli_fetch_array($resSize)){
						
						    echo "<option value='". $r['size']."'>".$r['size'].'</option>';

				 } 
				 ?>
			</select>
				<p><strong>Quanity</strong></p>			  
				<input type="number" id="myNumber" name="quantity" value="1">
				<input type="hidden" name="hidden_name" value="<?php echo $name; ?>" />  
				<input type="hidden" name="hidden_price" value="<?php echo $price; ?>" />
				<input type="hidden" name="hidden_image" value="<?php echo $image; ?>" />
				<input type="hidden" name="hidden_color" value="<?php echo $color; ?>" />
				<input type="submit" name="add_to_cart"  class="btnAddToCart" value="Add to Cart"  style="background-color: black;  color: white; border: none; text-align: center; text-decoration: none; display: inline-block; font-size: 16px;margin-left: 27px; padding: 3px 26px;"/>
			</form>
        </div>
		<div style="margin-top: 130px; padding-left: 50px; ">
			   <p><strong>Product details</strong></p>
               <p>available <?php echo $available?></p>
               <p><?php echo $description?></p>
		</div>
		
		</div>
<?php   
}
}
 ?>

	<div class="ProductList" style="display: flow-root;">
					<?php
				$query = "SELECT * FROM ssubcategory WHERE subcatID='$sub_category'";
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
</Body>
</html>	
<?php 
include ('footer.php'); 

?>