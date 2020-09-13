<?php include( 'connect.php');

require_once 'header.php'; 
?>
<html>
<head>

  <meta charset="UTF-8">
  <title>About us </title>
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
  <center>
<h1>about us</h1>
<br/>
<h3>our Goals:</h3>
<p> improve customer satisfaction through better service</p>
<br/>
<h3>informations about us:</h3>
<p>we are student in PNU and this is our graduate project </p>
<br/>
<h3>our services</h3>
<p>shopping online </p>
</div>
</div>
</center>
</body>

</html>

<?php include('footer.php'); ?>