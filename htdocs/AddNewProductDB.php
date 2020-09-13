<?php
require_once 'header.php'; 
include( 'connect.php');

?>

<?php 


if(isset($_POST['id'])&&(is_numeric($_POST['id']))){
                        $name= $_POST['product-name'];
                    $type= $_POST['type-option'];
                    $price= $_POST['price'];
                    $description= $_POST['Description'];
                    $image= "images/".$_POST['image'];
                    $id=$_POST['id'] ;
                    $cat=$_POST['cat_option'];
                    $sub_cat=$_POST['sub_catoption'];
                    $vaailable=$_POST['availbla'];
                    $model=$_POST['model'];
                    $color=$_POST['color'];
                    $size=$_POST['size'];
                    $material=$_POST['material'];
					
   
                    
if($id==0){
    $sql_statement1=sprintf("select * from ssubcategory where (`Title` like '$name')");
    $res1 = mysqli_query($db, $sql_statement1);


if(!$res1) {
  print("MySQL error: " . mysqli_error($db));
 echo "could not find the same  name";}
 $row2 = mysqli_fetch_assoc($res1);
if(count($row2)!=0)
{
 echo "<script type='text/javascript'>alert('dublicate name!')</script>"  ;
  header('Refresh: 5; URL = AddNewProduct.php'); 
}
  else if(count($row2)==0){
 $sql_statement=sprintf("INSERT INTO ssubcategory (typeID, catID, subcatID, Title, Price, description, img, available_quantity,model,color,material,date) VALUES
    
     ('$type','$cat', $sub_cat,'$name','$price','$description','$image','$vaailable','$model','$color','$material',NOW())");
    
    $res = mysqli_query($db, $sql_statement);
  }

if(!$res) {
  print("MySQL error: " . mysqli_error($db));
 echo "could not find the required";
}
   

else {
    //echo (sizeof($row2));
    
}
header('Refresh: 1; URL = AddNewProduct.php');   

    
}
else{
   /** $sql_statement=sprintf("update MenuItems set `Dish-name`=$name ,`Dish-Type`=$type,`price`=$price,
    `image`= $image, `Description`=$description
    
    WHERE `Dish-id`=$id"
   );**/
    
} 
$sqlSelect = "SELECT SsubID FROM ssubcategory ORDER BY SsubID DESC LIMIT 1";
$resSelect = mysqli_query($db, $sqlSelect);
$rowSelect = mysqli_fetch_assoc($resSelect);
$Sid = $rowSelect['SsubID'];
foreach($_POST['size'] as $size){
   $sql="INSERT INTO `Size`(`	Ssub_ID`,`size`) VALUES ('$Sid','$size')";
         mysqli_query($db,$sql);
   }
header('Refresh: 1; URL = AddNewProduct.php');   
}
else {
    
    header("AddNewProduct.php");
}
?>

<?php 
require_once 'footer.php';
?>