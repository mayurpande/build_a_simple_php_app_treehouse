<?php 
#shirt details page has access to the main products array from the include file
include("../inc/products.php"); 


//if an ID is specifified in the query string, use it
if(isset($_GET["id"])) {
    $product_id = intval($_GET["id"]);
    $product = get_product_single($product_id);
}


//  a $product will only be set and not false if an ID is specifified in the query 
//  string and it corresponds to a real products. If not product is set
//  then redirect to the shirts listing pag; otherwise; continue
//  on and display the Shirt Details page for that $products
if(empty($product)){
	header("Location: /shirts/");
	exit();
}
#shirt details page also has the product id for a particular shirt from the get variable
$section = "shirts";
$pageTitle = $product["name"];
include("../inc/header.php"); 


?>
	<div class="section page">
		
			<div class="wrapper">
				
					
					
					<div class="breadcrumb">
						<a href="/shirts/">Shirts</a> &gt; <?php echo $product["name"]; ?>
					</div>
					
					<div class="shirt-picture">
						<span>
							<img src="/<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>">
						</span>
					</div>
					
					<div class="shirt-details">
					
						<h1><span class="price">$<?php echo $product["price"]; ?></span> <?php echo $product["name"]; ?></h1>
						
						
						<form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="<?php echo $product["paypal"]; ?>">
							<input type="hidden" name="item_name" value="<?php echo $product["name"]; ?>">
							<table>
							<tr>
								<th>
									<input type="hidden" name="on0" value="Size">
									<label for="os0">Size</label>
								</th>
								<td>
									<select name="os0" id="os0">
										<?php foreach($product["sizes"] as $size) { ?>
											<option value="<?php echo $size; ?>"><?php echo $size; ?> </option>
											<?php } ?>
									</select>
								</td>
							</tr>
							</table>
							
							<input type="submit" value="Add to Cart" name="submit">
						</form>
						
						<p class="note-designer">* All shirts are designed by Mike the Frog.</p>
						
					</div>
			
			</div>
	</div>
	
	
<?php include("../inc/footer.php")?>
