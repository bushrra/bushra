<?php 
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css-files/Style_header.css">
	</head>
    <body>
	 	<div class="menu">
     		<ul class="menu_css">
			  <li><a href="cart.php"><img class="market_basket" src="iShop-img/cart.png"></a></li>
			  <li style="float:left;"><a href="index.php" style="padding: 0px 0px;" ><img style="width: 141px;height: 68px;" src="iShop-img/iShop.png" alt="iShop store logo" ></a></li>
 			  <li><a href="SignIn.php"><img class="user" src="iShop-img/User-img.png"></a></li>
			  <li class="dropdown" style="float:left;" style="margin-top: 13px;">
			  <a href="javascript:void(0)" class="dropbtn"><a href="women_home.php" >Women</a></a>
				<div class="dropdown-content">
				<ul class="SubMenu">
					<a href="WomenAccessories .php">Accessories</a>
					<a href="WomenShose.php">Shoes</a>
					<a href="Dress-Women.php">Dresses</a>
					<a href="Bag-Women.php">Bags</a>
					<a href="ShirtsW.php">Shirts</a>
					<a href="CoatsJacketsW.php">Coats & Jackets</a>
					<a href="SkirtsW.php">Skirts</a>
					<a href="TopsW.php">Tops</a>
				</ul>
				</div>
				</li>
				<li class="dropdown" style="float:left;" style="margin-top: 13px;">
			  <a href="javascript:void(0)" class="dropbtn"><a href="bigKids_home.php">Big Kids</a>
				<div class="dropdown-content">
				<ul class="SubMenu">
					<a href="BigKidsAccessories.php">Accessories</a>
					<a href="BigKidsShose.php">Shoes</a>
					<a href="Dress-Bigkids.php">Dresses</a>
					<a href="Bag-BibKids.php">Bags</a>
					<a href="ShirtsBK.php">Shirts</a>
					<a href="CoatsJacketsBK.php">Coats & Jackets</a>
					<a href="SkirtsBK.php">Skirts</a>
					<a href="TopsBK.php">Tops</a>
				</ul>
				</div>
				</li>
				<li style="margin-top: 13px; float:left;"><a href="index.php">Home</a></li>
				<li style="margin-top: 13px; float:left;"><a href="aboutUs.php">About us</a></li>
				<li style="margin-top: 13px; float:left;"><a href="live.php">Contact us</a></li>

			  <li>
					<div class="SearchForm">
					<form action="search.php?action=send" method="post" align="center">
						<input class="SearchInput" type="search" id="site-search" name="search" placeholder="search.."   aria-label="Search through site content">
						<button ><img class="Search_icon" src="iShop-img/search.png"></button>
					</form>
					<div>
				</li>
            </ul>
       	</div>

    </body>

</html>

 