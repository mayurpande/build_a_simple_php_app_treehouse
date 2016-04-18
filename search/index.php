<?php

//set search term variable to be blank
$search_term = "";
//if form get variable is set store get variable in $search_term
if(isset($_GET["s"])){
    $search_term = trim($_GET["s"]);
   //if search term is set call the function get_products_search from the model
    if($search_term != "") {
        require_once('../inc/products.php');
        $products = get_products_search($search_term);
    }
}


$pageTitle = "Search";
$section = "search";
include('../inc/header.php');



?>

    <div class="section shirts search page">
        
        <div class="wrapper">
            
            <h1>Search</h1>
            
            <form method="get" action="./">
            <input type="text" name="s" value="<?php echo htmlspecialchars($search_term); ?>" />
                <input type="submit" value="Go" />

            </form>

            <?php

                include('../inc/list_view.html.php');
                //if search term isnt blank then a search is being performed
                if($search_term != ""){
                    //check to see if search query returns nothing (blank array)
                    //if the array is not empty as in result are found then display the results
                    if(!empty($products)){                    
                        echo '<ul class="products">';
                        //we need one list item tag for each shirt
                        //so we will need a foreach loop
                        foreach($products as $product){
                            //in this loop we are considering each loop one by one
                            //foreach shirt we need to display the list item for that shirt
                           echo  get_list_view_html($product);

                        }
                        echo'</ul>';
                    }else{
                        //if the array is empty and there are not results display this
                        echo '<p>No products were found mathching that search term.</p>';
                    }
                   
                    
                 }
            ?>
        
        </div>

    </div>



<?php include('../inc/footer.php'); ?>
