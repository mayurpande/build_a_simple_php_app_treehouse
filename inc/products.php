<?php

//function will return an array of recent products
//it will not return any html or instructions about displaying the page
function get_products_recent(){
    require('db.php');
    try{
        //no need for prepare method as there is no user input
        $results = $db->query("
            SELECT name,price,img,sku,paypal
            FROM products
            ORDER BY sku DESC
            LIMIT 4
            ");
    }catch(Exception $e){
        echo "Data could not be retrieved from the db";
        exit;
    }  

    //we called the query method above, so we should have all four shirts in the results object
    //we can extract them into an array with the fetch all method
    $recent = $results->fetchAll(PDO::FETCH_ASSOC);
    $recent = array_reverse($recent);
	return $recent;
}

//search function
function get_products_search($s){
    require('db.php');

    try{
        $results = $db->prepare("
            SELECT *
            FROM products
            WHERE name LIKE ?
            ORDER BY sku");
        //normally we use bind param for the placeholder as this is ok to use when binding a 
        //variable for a placeholder. However as we need the wildcards (%%) we cannot use bind 
        //param. We will need to use bindValue. You could pass a variable to bindValue without
        //any problems. However there is a subtle little difference between how bindValue and 
        //bindParam works;
        //bindParam binds the placeholder to the specific variable, even if that variable changes
        //later.
        //bindValue on the other hand;
        //binds the placeholder to the value in the variable at the moment of the binding and all 
        //the examples we have used before this one either bindParam or bindValue would have worked
        //just fine 
        //with bindValue though we can use contactenation hence we can use the wildcards
        $results->bindValue(1,"%" . $s . "%");
        $results->execute();

    }catch(Exception $e){
        echo "Data could not be retrieved from db";
        exit;
    }

    $matches = $results->fetchAll(PDO::FETCH_ASSOC);

    return $matches;

}

//function to obtain shirts for selected pages
function get_products_subset($positionStart, $positionEnd){
    //calculate offset and row position to use in query
    $offset = $positionStart + 1;
    $rows = $positionEnd - $positionStart + 1;

    
    require('db.php');
    try{
        $results = $db->prepare("
            SELECT * 
            FROM products
            ORDER BY sku ASC
            LIMIT ?,? 
            ");
        //bind limit parameters, as this will be a string update, use pdo method to convert to int
        $results->bindParam(1,$offset,PDO::PARAM_INT);
        $results->bindParam(2,$rows,PDO::PARAM_INT);
        $results->execute();
    }catch(Exception $e){
        echo 'Data could not be found';
        exit;
    }

    $subset = $results->fetchAll(PDO::FETCH_ASSOC);

    return $subset;
}

//function to calculate total number of products
function get_products_count(){
    require('db.php');

    try{
        $results = $db->query("
            SELECT COUNT(sku)
            FROM products");
    }catch(Exception $e){
        echo 'Data could not be retrieved from the db';
        exit;
    }

    return(intval($results->fetchColumn(0)));
}
//function to return full list of all products
function get_products_all(){
      
   require('db.php');

    try{
        $results = $db->query("SELECT * FROM products ORDER BY sku ASC");
    }catch(Exception $e){
        echo "Data could not be retreived";
    }
    $products = ($results->fetchAll(PDO::FETCH_ASSOC));

    return $products;
}

// Returns an array of product information for the product that matches the sku;
// returns a boolean false if no product matches the sku
// @param   int     $sku    the sku
// @return  mixed   array   list of product information for the one matching product
//                  bool    false if no product matches
function get_product_single($sku){
    require('db.php');

    try{
        //this line create a PDO statment object with the sql query we want to run
        //it contains a question mark instead of a sku
        $results =  $db->prepare("SELECT * FROM products WHERE sku = ?");
        //this line hear binds our sku variable to that first question mark
        $results->bindParam(1,$sku);  
        //this line here executes the query which loads the result set into our results object
        $results->execute();  
    }catch(Exception $e){
        echo "Data could not be retrieved";
        exit;
    }
    //this line then calls the fetch method to retrieve the product information for the one 
    //product that matches the sku and loads it into the product variable so it can be returned back
    //to the controller
    $product = $results->fetch(PDO::FETCH_ASSOC);
    
    if($product == false) {
        return $product;
    }

    $product["sizes"] = array();

    try{
        $results = $db->prepare("
            SELECT size
            FROM products_sizes
            INNER JOIN sizes
            ON products_sizes.size_id = sizes.id
            WHERE product_sku = ?
            ORDER BY `order`");
        $results->bindParam(1,$sku);
        $results->execute();

    }catch(Exception $e){
        echo 'Data could not be retrieved from the database';
        exit;
    }
    //this while loop actually executes a command
    //it calls the fetch method and loads the return value of the fetch value into a
    //a variable named row. This variable will contain the first size as long as the row
    //variable is not false then the condition will be considered true and the code inside
    //the curly brackets will be executed, when the end of the while loop is reached, the flow
    //loops back to the top. It again calls the fetch method which this time loads the second 
    //size into the row variable, because the row variable is still not false, it runs the code
    //inside the loop again, at the end it loops back and calls the fetch method again loading
    //the third size into the variable and executing the code inside the while loop. If the 
    //current item only had 3 sizes after executing the code three times it would loop back up
    //to the top of the condition again it would call the fetch method again which this time 
    //would return false and store it in the row variable because there are no more sizes to fetch
    //it already fetched all three of them. In this case the row variable gets assinged a value of
    //boolean false, the while loop sees that row is false and it now ends the while loop and skips
    //down to the final closing curly brackets 
    while($row = $results->fetch(PDO::FETCH_ASSOC)){
        //we want to add a new size to the product variable 
        //remember that each detail about the shirt including the available sizes is represented
        //by an element inside this array, 
        //the sizes element is different than the other elements because it is also an array.
        //it is an array nested inside of an array
        //to add a new element to an exiting array, we use a opening and closing square bracket
        //this will add a new element to the second dimension of our product variable using
        //whatever key is available next
        //
        //inside our while loop the row variable contains the record from the results object that
        //we retrieved using the fetch method, which inludes the name of the size from the db
        //the row variable is an array which will have one element inside of it for each column in
        //the query. In this case the row array will have one element size because we only have one
        //column specified in our select statement, we want to take the size from the row array
        //and load it into the sizes available in our product variable,  
        $product["sizes"][] = $row["size"];
    }
    return $product;
}

?>
