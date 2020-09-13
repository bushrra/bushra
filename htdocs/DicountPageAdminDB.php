<?php

include( 'connect.php');

?>

<?php 
if(isset($_GET["action"]))  
 {  
      if($_GET["action"] == "submit")  
      {  
					$name = $_POST['ProductName'];
					$query = "SELECT * FROM ssubcategory WHERE Title='$name'";
					$res1=mysqli_query($db, $query);
					
					
					$DisPer= $_POST['Discountpercentage'];
					 while ($row = mysqli_fetch_assoc($res1)){
						 
					$id=$row['SsubID'];
                    $type= $row['typeID'];
                    $price= $row['Price'];
                    $description= $row['description'];
                    $image= $row['img'];
                    $category=$row['catID'];
                    $sub_category=$row['subcatID'];
                    $available=$row['available_quantity'];
                    $model=$row['model'];
                    $color=$row['color'];
                    $size=$row['size'];
                    $material=$row['material'];
					$date=$row['date'];
					 }
	
	                $discountValue = ($price-($price * ($DisPer/100)));
                    $sql_statement="INSERT INTO discount (typeID, catID, subcatID,SsubID, Title, Price, description, img, available_quantity,model,color,size,material,date) VALUES 
					('$type','$category', $sub_category,$id,'$name','$discountValue','$description','$image','$available','$model','$color','$size','$material','$date')"; 
    if (mysqli_query($db, $sql_statement)) {
		header('location: DicountPageAdmin.php');	
		} else {
			echo "Error: " . $sql_statement . "<br>" . mysqli_error($db);
		} 
 } }
					


?>
