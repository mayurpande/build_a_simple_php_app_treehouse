<?php 
include('../inc/products.php');
if(empty($_GET["pg"])){
    $current_page = 1;
}else{
    $current_page = $_GET["pg"];
}
$current_page = intval($current_page);

$total_products = get_products_count();
$products_per_page = 8;
$total_pages = ceil($total_products / $products_per_page);

if($current_page > $total_pages){
    header("Location: ./?pg=" . $total_pages);
}

if($current_page < 1){
    header("Location: ./");
}

$start = (($current_page - 1) * $products_per_page) + 1;
$end = $current_page * $products_per_page;
if($end > $total_products) {
    $end = $total_products;
}



//call new products function, and load return variable with the same name as before
$products = get_products_subset($start,$end);




$pageTitle = "Mike's Full Catalog of Shirts";
$section = "shirts";
include('../inc/header.php'); 
?>


	<div class="section shirts page">
		
		<div class="wrapper">
			
			<h1>Mike&rsquo;s Full Catalog of Shirts</h1>

            
            <div class="pagination">
                
                <?php $i=0; ?>
                <?php while($i < $total_pages): ?>
                <?php $i += 1; ?>
                <?php echo $i; ?>
                <?php endwhile ?>
    
            </div>    
			<ul class="products">
				
				<?php foreach ($products as $product){ 
						echo get_list_view_html($product);
					}
				?>
				
			</ul>
				
		</div>
		
	</div>


<?php include('../inc/footer.php'); ?>


