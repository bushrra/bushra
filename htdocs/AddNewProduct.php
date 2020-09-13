<?php
include( 'header.php');
include( 'connect.php');
$name="";
$type="";
$price="";
$description="";
$image="";
$id=0;
$category="";
$sub_category="";
$available="";
$color="";
$size="";
$model="";
$material="";

if(isset($_GET['id'])&&(is_numeric($_GET['id']))){
$id= $_GET['id'];  
$sql_statement=sprintf("SELECT * FROM ssubcategory WHERE `SsubID`=$id");
$res = mysqli_query($db, $sql_statement);


if(!$res) {
  print("MySQL error: " . mysqli_error($db));
 echo "could not find the required  Dish";
}
else
{
    
$dishes = array();

    while ($row = mysqli_fetch_assoc($res)){
        array_push($dishes, $row);
    }

    $dish= $dishes[0];
    
                    $name= $dish['Title'];
                    $type= $dish['typeID'];
                    $price= $dish['Price'];
                    $description= $dish['description'];
                    $image= $dish['img'];
                    $id= $dish['SsubID'] ;
                    $category=$dish['catID'];
                    $sub_category=$dish['subcatID'];
                    $available=$dish['available_quantity']; 
                    $model=$dish['model'];
                    $color=$dishr['color'];
                    $size=$dish['size'];
                    $material=$dish['material'];
}
}

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css-files/Style_AddNewProduct.css">
		<title>Add new product</title>
		<meta charset="UTF-8">
	</head>
	<body>
	<div class="BigContiner" style="height: 100%;">
	
		<div class="header">
		 <h3>Add new Product</h3>
		</div>
		
<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
                        <form class="AddNewProductForm" id="myForms" role="form" method="post" action="AddNewProductDB.php">
                            <input  type="hidden" name="id" value="<?php echo $id;?>" >
                            <div class="input-group">
                                <label>Name</label>
                                <input placeholder="Enter text" name="product-name" value="<?php echo $name;?>">
                            </div>
							<div class="input-group">
                                <label>Price</label>
                                <input  placeholder="Enter text" name="price" value="<?php echo $price;?>">
                            </div>
                            <div class="input-group">
                                <label>Type</label>
                                <select name="type-option">
                               <?php
                               $sql_statement=sprintf("SELECT * FROM type  ");
                            echo $sql_statement;
                            $res1 = mysqli_query($db, $sql_statement);
                            
                            
                            if(!$res1) {
                              print("MySQL error: " . mysqli_error($db));
                             echo "could not find the required  type";
                            }
                            else{
                            
                               while ($row1 = mysqli_fetch_assoc($res1)){
                            
                                   $tpID=$row1['TypeId'];
                                   $type_name=$row1['Info'];
                                   ?>
                                   <option value="<?php echo $tpID?>"><?php echo $type_name;?></option>
                                   <?php
                            
                                }
                            
                                
                               }
                                                            ?>
                                    
                                    
</select>
                                
                            </div>
                           
                            <div class="input-group">
                                <label>Category</label>
                                <select name="cat_option">
                                <?php
                                $sql_statement=sprintf("SELECT * FROM `main category`");
                                echo $sql_statement;
                                $res1 = mysqli_query($db, $sql_statement);


                                if(!$res1) {
                                     print("MySQL error: " . mysqli_error($db));
                                     echo "could not find the required  type";
                                 }
                                else{

                                     while ($row1 = mysqli_fetch_assoc($res1)){

                                         $cat_id=$row1['cat_id'];
                                     $cat_name=$row1['category'];
                                    ?>
                         <option value="<?php echo $cat_id?>"><?php echo  $cat_name;?></option>
                                 <?php

                                    }

    
                                         }
                                ?>
                                    
                                    
</select>
                                
                            </div>
                             <div class="input-group">
                                <label>Sub Category</label>
                                <select name="sub_catoption">
                                <?php
                                $sql_statement=sprintf("SELECT * FROM sub_category  ");
                                echo $sql_statement;
                                $res1 = mysqli_query($db, $sql_statement);
                                
                                
                                if(!$res1) {
                                  print("MySQL error: " . mysqli_error($db));
                                 echo "could not find the required  type";
                                }
                                else{
                                
                                   while ($row1 = mysqli_fetch_assoc($res1)){
                                
                                       $subcatID=$row1['subcat_id'];
                                       $subct_name=$row1['sub_cat'];
                                       ?>
                                       <option value="<?php echo $subcatID?>"><?php echo  $subct_name;?></option>
                                       <?php
                                
                                    }
                                
                                    
                                   }
                                                                ?>
                                                                    
                                                                    
</select>
                                
                            </div>
                            
                            <div class="input-group">
                                <label>Avaialable Quantity</label>
                                <input  placeholder="Enter text" name="availbla" value="<?php echo $available;?>">
                            </div>
                            <div class="input-group">
                                <label>Color</label>
                                <input  placeholder="Enter text" name="color" value="<?php echo $color;?>">
                            </div>
                            
                            <div class="input-group">
                                <label>Model</label>
                                <input placeholder="Enter text" name="model" value="<?php echo $model;?>">
                            </div>
                            <div class="input-group">
                                <label>Material</label>
                                <input placeholder="Enter text" name="material" value="<?php echo $material;?>">
                            </div>
							<div class="input-group">
                                <label>Size</label>
								<select multiple="multiple" name="size[]">
										<option selected="selected" value="OS">OS</option>
										<option value="XS">XS</option>
										<option value="S">S</option>
										<option value="M">M</option>
										<option value="L">L</option>
										<option value="XL">XL</option>
										<option value="35">35</option>
										<option value="36">36</option>
										<option value="37">37</option>
										<option value="38">38</option>
										<option value="37">39</option>
										<option value="38">40</option>
								</select>
                            </div>
                            <div class="input-group">
                                <label>Image</label>
                                <input placeholder="Enter text" name="image" value="<?php echo $image;?> " style="width: 501px;">
                            </div>

                            

                            <div class="input-group">
                                <label>Description</label>
                                <textarea rows="5" cols="70" name="Description" ><?php echo $description;?></textarea>
                            </div>

                            <div style="display: table;" >
								<button type="submit" class="btn">Submit</button>
								<button type="reset" class="btn">Reset</button>
							</div>
							
                        </form>
                        </div>
                        </div>
                        </div>
</div>
		</body>
		</html>
<?php include('footer.php'); ?>