<?php 
$pageTitle = "Unique T-shirts desgines by a frog";
$section ="";
include('inc/header.php'); 

?>

		<div class="section banner">

			<div class="wrapper">

				<img class="hero" src="img/mike-the-frog.png" alt="Mike the Frog says:">
				<div class="button">
					<a href="shirts.php">
						<h2>Hey, I&rsquo;m Mike!</h2>
						<p>Check Out My Shirts</p>
					</a>
				</div>
			</div>

		</div>

		<div class="section shirts latest">

			<div class="wrapper">

				<h2>Mike&rsquo;s Latest Shirts</h2>
				
				<?php 
					include('inc/products.php'); 
					$recent = get_products_recent();
				?>

				<ul class="products">
                     <?php
                        include('inc/list_view.html.php');
                        $list_view_html = "";
						foreach($recent as $product){
							$list_view_html =  get_list_view_html($product) . $list_view_html;			
						} 
						echo $list_view_html;
					?>						
				</ul>
				
			</div>

		</div>

<?php include('inc/footer.php'); ?>
