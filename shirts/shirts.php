<?php 
include('../inc/products.php');
$pageTitle = "Mike's Full Catalog of Shirts";
$section = "shirts";
include('../inc/header.php'); 

?>


	<div class="section shirts page">
		
		<div class="wrapper">
			
			<h1>Mike&rsquo;s Full Catalog of Shirts</h1>
				
			<ul class="products">
				
				<?php foreach ($products as $product){ 
						echo get_list_view_html($product);
					}
				?>
				
			</ul>
				
		</div>
		
	</div>


<?php include('../inc/footer.php'); ?>


