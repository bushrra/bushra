<?php
include( 'header.php');
include( 'connect.php');

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css-files/Style_AddNewProduct.css">
		<title>Discount Products</title>
		<meta charset="UTF-8">
	</head>
	<body>
	<div class="BigContiner" style="height: 100%;">
	
		<div class="header">
		 <h3>Discount Products</h3>
		</div>
		
<div >
		<div class="container">
			<div >
                        <form class="AddNewProductForm"  method="post" action="DicountPageAdminDB.php?action=submit">
                            
							<div class="input-group">
                                <label>Discount percentage</label>
                                <input  placeholder="20" name="Discountpercentage">
                            </div>
                            <div class="input-group">
                                <label>Product Name</label>
                                <select name="ProductName">
                               <?php
                               $sql_statement=sprintf("SELECT Title FROM ssubcategory  ");
                            $res1 = mysqli_query($db, $sql_statement);
                            
                            if(!$res1) {
                              print("MySQL error: " . mysqli_error($db));
                             echo "could not find the required  type";
                            }
                            else{
                            
                               while ($row1 = mysqli_fetch_assoc($res1)){
                             
                                   ?>
                                    <option value="<?php echo $row1['Title'];?>"><?php echo $row1['Title'];?></option>
									
                                   <?php
                            
                                }
								
                                
                               }
							  ?>
							   
							 
								          
</select>
                               
                            </div>
                           
					
							
                            <div style="display: table;" >
								<button type="submit" name="submit" class="btn">Submit</button>
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