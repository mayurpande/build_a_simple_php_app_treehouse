<?php 
include('../inc/products.php');
$pageTitle = "Mike's Full Catalog of Shirts";
$section = "shirts";
include('../inc/header.php'); 
//call new products function, and load return variable with the same name as before
$products = get_products_all();

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


