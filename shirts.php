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
					echo '<a href="shirt.php">';
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


