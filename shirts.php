<?php

$products[101] = array(
	"name" => "Logo Shirt, Red",
	"img" => "img/shirts/shirt-101.jpg",
	"price" => 18,
	"paypal" => "9P7DLECFD4LKE"
);
$products[102] = array(
	"name" => "Mike the Frog Shirt, Black",
    "img" => "img/shirts/shirt-102.jpg",
    "price" => 20,
    "paypal" => "SXKPTHN2EES3J"
);
$products[103] = array(
    "name" => "Mike the Frog Shirt, Blue",
    "img" => "img/shirts/shirt-103.jpg",    
    "price" => 20,
    "paypal" => "7T8LK5WXT5Q9J"
);
$products[104] = array(
    "name" => "Logo Shirt, Green",
    "img" => "img/shirts/shirt-104.jpg",    
    "price" => 18,
    "paypal" => "YKVL5F87E8PCS"
);
$products[105] = array(
    "name" => "Mike the Frog Shirt, Yellow",
    "img" => "img/shirts/shirt-105.jpg",    
    "price" => 25,
    "paypal" => "4CLP2SCVYM288"
);
$products[106] = array(
    "name" => "Logo Shirt, Gray",
    "img" => "img/shirts/shirt-106.jpg",    
    "price" => 20,
    "paypal" => "TNAZ2RGYYJ396"
);
$products[107] = array(
    "name" => "Logo Shirt, Teal",
    "img" => "img/shirts/shirt-107.jpg",    
    "price" => 20,
    "paypal" => "S5FMPJN6Y2C32"
);
$products[108] = array(
    "name" => "Mike the Frog Shirt, Orange",
    "img" => "img/shirts/shirt-108.jpg",    
    "price" => 25,
    "paypal" => "JMFK7P7VEHS44"
);



?>

<?php 

$pageTitle = "Mike's Full Catalog of Shirts";
$section = "shirts";
include('inc/header.php'); 

?>


	<div class="section shirts page">
		
		<div class="wrapper">
			
			<h1>Mike&rsquo;s Full Catalog of Shirts</h1>
				
			<ul class="products">
				<?php foreach ($products as $product){ 
					echo "<li>";
					echo '<a href="#">';
					echo '<img src="' . $product["img"] . '" alt= "' . $product["name"] . '">';
					echo $product["name"];
					echo "<p>View Details</p>";				
					echo "</a>";
					} 
					echo "</li>";
				?>
				
			</ul>
				
		</div>
		
	</div>


<?php include('inc/footer.php'); ?>


