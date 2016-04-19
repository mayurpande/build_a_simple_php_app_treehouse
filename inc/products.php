<?php

//function will return an array of recent products
//it will not return any html or instructions about displaying the page
function get_products_recent(){
	$recent = array();
	//stores $products array into $all variable
	$all = get_products_all();
	$total_products = count($all);
	$position = 0;

	//loop through all the shirts one by one to determine if any of them is one of the last four shirts
	foreach($all as $product){
	//when we find one of the shirts that is one of the last four shirts we will add it to the recent array
		//if $product is one of the 
		//last four  shirts {
		$position = $position + 1;
		if($total_products - $position < 4){
			$recent[] = $product;
		}
	}
	return $recent;
}

//search function
function get_products_search($s){
    $results = array();
    $all = get_products_all();

    foreach($all as $product){
        if ((stripos($product["name"],$s) !== false) || (stripos($product["sku"],$s) !== false)){
            $results[] = $product;
        }
    }
    return $results;

}

//function to obtain shirts for selected pages
function get_products_subset($positionStart, $positionEnd){
    $subset = array();
    $all = get_products_all();
    
    $position = 0;

    //foreach loop to go through all products one after the other
    foreach($all as $product){
        //this will increase the shirt number by one each time the loop is run
        $position += 1;
        //we need a conditional that checks if the shirt is one of the ones
        //in the subset of shirts we are looking for
        //we check if the current position is greater than or equal to the starting position
        //it must also pass other condition is must be less than or equal to the ending position
        if($position >= $positionStart && $position <= $positionEnd){
            //if the shirt is one of the ones we want to include, we will include it in the subset array
            $subset[] = $product;
        }
    }   
    return $subset;
}

//function to calculate total number of products
function get_products_count(){
    return $count = count(get_products_all());
}
//function to return full list of all products
function get_products_all(){
    /*
    $products = array();
	$products[101] = array(
			"name" => "Logo Shirt, Red",
			"img" => "img/shirts/shirt-101.jpg",
			"price" => 18,
			"paypal" => "9P7DLECFD4LKE",
			"sizes" => array("Small", "Medium", "Large", "X-large"),
			"style" => array("Short Sleeve", "Long Sleeve", "Thermal", "Hooded")
	);
	$products[102] = array(
			"name" => "Mike the Frog Shirt, Black",
	    "img" => "img/shirts/shirt-102.jpg",
	    "price" => 20,
	    "paypal" => "SXKPTHN2EES3J",
			"sizes" => array("Small", "Medium", "Large", "X-large"),
			"style" => array("Short Sleeve", "Long Sleeve", "Thermal", "Hooded")
	);
	$products[103] = array(
	    "name" => "Mike the Frog Shirt, Blue",
	    "img" => "img/shirts/shirt-103.jpg",    
	    "price" => 20,
	    "paypal" => "7T8LK5WXT5Q9J",
			"sizes" => array("Small", "Medium", "Large", "X-large"),
			"style" => array("Short Sleeve", "Long Sleeve", "Thermal", "Hooded")
	);
	$products[104] = array(
	    "name" => "Logo Shirt, Green",
	    "img" => "img/shirts/shirt-104.jpg",    
	    "price" => 18,
	    "paypal" => "YKVL5F87E8PCS",
			"sizes" => array("Small", "Medium", "Large", "X-large"),
			"style" => array("Short Sleeve", "Long Sleeve", "Thermal", "Hooded")
	);
	$products[105] = array(
	    "name" => "Mike the Frog Shirt, Yellow",
	    "img" => "img/shirts/shirt-105.jpg",    
	    "price" => 25,
	    "paypal" => "4CLP2SCVYM288",
			"sizes" => array("Small", "Medium", "Large", "X-large"),
			"style" => array("Short Sleeve", "Long Sleeve", "Thermal", "Hooded")
	);
	$products[106] = array(
	    "name" => "Logo Shirt, Gray",
	    "img" => "img/shirts/shirt-106.jpg",    
	    "price" => 20,
	    "paypal" => "TNAZ2RGYYJ396",
			"sizes" => array("Small", "Medium", "Large", "X-large"),
			"style" => array("Short Sleeve", "Long Sleeve", "Thermal", "Hooded")
	);
	$products[107] = array(
	    "name" => "Logo Shirt, Teal",
	    "img" => "img/shirts/shirt-107.jpg",    
	    "price" => 20,
	    "paypal" => "S5FMPJN6Y2C32",
			"sizes" => array("Small", "Medium", "Large", "X-large"),
			"style" => array("Short Sleeve", "Long Sleeve", "Thermal", "Hooded")
	);
	$products[108] = array(
	    "name" => "Mike the Frog Shirt, Orange",
	    "img" => "img/shirts/shirt-108.jpg",    
	    "price" => 25,
	    "paypal" => "JMFK7P7VEHS44",
			"sizes" => array("Large", "X-large"),
			"style" => array("Short Sleeve", "Long Sleeve", "Thermal", "Hooded")
	);
	
	    $products[109] = array(
            "name" => "Get Coding Shirt, Gray",
            "img" => "img/shirts/shirt-109.jpg",    
            "price" => 20,
            "paypal" => "B5DAJHWHDA4RC",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[110] = array(
            "name" => "HTML5 Shirt, Orange",
            "img" => "img/shirts/shirt-110.jpg",    
            "price" => 22,
            "paypal" => "6T2LVA8EDZR8L",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[111] = array(
            "name" => "CSS3 Shirt, Gray",
            "img" => "img/shirts/shirt-111.jpg",    
            "price" => 22,
            "paypal" => "MA2WQGE2KCWDS",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[112] = array(
            "name" => "HTML5 Shirt, Blue",
            "img" => "img/shirts/shirt-112.jpg",    
            "price" => 22,
            "paypal" => "FWR955VF5PALA",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[113] = array(
            "name" => "CSS3 Shirt, Black",
            "img" => "img/shirts/shirt-113.jpg",    
            "price" => 22,
            "paypal" => "4ELH2M2FW7272",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[114] = array(
            "name" => "PHP Shirt, Yellow",
            "img" => "img/shirts/shirt-114.jpg",    
            "price" => 24,
            "paypal" => "AT3XQ3ZVP2DZG",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[115] = array(
            "name" => "PHP Shirt, Purple",
            "img" => "img/shirts/shirt-115.jpg",    
            "price" => 24,
            "paypal" => "LYESEKV9JWE3A",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[116] = array(
            "name" => "PHP Shirt, Green",
            "img" => "img/shirts/shirt-116.jpg",    
            "price" => 24,
            "paypal" => "KT7MRRJUXZR34",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[117] = array(
            "name" => "Get Coding Shirt, Red",
            "img" => "img/shirts/shirt-117.jpg",    
            "price" => 20,
            "paypal" => "5UXJG8PXRXFKE",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[118] = array(
            "name" => "Mike the Frog Shirt, Purple",
            "img" => "img/shirts/shirt-118.jpg",    
            "price" => 25,
            "paypal" => "KHP8PYPDZZFTA",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[119] = array(
            "name" => "CSS3 Shirt, Purple",
            "img" => "img/shirts/shirt-119.jpg",    
            "price" => 22,
            "paypal" => "BFJRFE24L93NW",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[120] = array(
            "name" => "HTML5 Shirt, Red",
            "img" => "img/shirts/shirt-120.jpg",    
            "price" => 22,
            "paypal" => "RUVJSBR9FXXWQ",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[121] = array(
            "name" => "Get Coding Shirt, Blue",
            "img" => "img/shirts/shirt-121.jpg",    
            "price" => 20,
            "paypal" => "PGN6ULGFZTXL4",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[122] = array(
            "name" => "PHP Shirt, Gray",
            "img" => "img/shirts/shirt-122.jpg",    
            "price" => 24,
            "paypal" => "PYR4QH97W2TSJ",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[123] = array(
            "name" => "Mike the Frog Shirt, Green",
            "img" => "img/shirts/shirt-123.jpg",    
            "price" => 25,
            "paypal" => "STDAUJJTSPT54",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[124] = array(
            "name" => "Logo Shirt, Yellow",
            "img" => "img/shirts/shirt-124.jpg",    
            "price" => 20,
            "paypal" => "2R2U74KWU5RXG",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[125] = array(
            "name" => "CSS3 Shirt, Blue",
            "img" => "img/shirts/shirt-125.jpg",    
            "price" => 22,
            "paypal" => "GJG7F8EW3XFAS",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[126] = array(
            "name" => "Doctype Shirt, Green",
            "img" => "img/shirts/shirt-126.jpg",    
            "price" => 25,
            "paypal" => "QW2LFRYGU7L4Q",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[127] = array(
            "name" => "Logo Shirt, Purple",
            "img" => "img/shirts/shirt-127.jpg",    
            "price" => 20,
            "paypal" => "GFV6QVRMJU7F8",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[128] = array(
            "name" => "Doctype Shirt, Purple",
            "img" => "img/shirts/shirt-128.jpg",    
            "price" => 25,
            "paypal" => "BARQMHMB565PN",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[129] = array(
            "name" => "Get Coding Shirt, Green",
            "img" => "img/shirts/shirt-129.jpg",    
            "price" => 20,
            "paypal" => "DH9GXABU3P8GS",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[130] = array(
            "name" => "HTML5 Shirt, Teal",
            "img" => "img/shirts/shirt-130.jpg",    
            "price" => 22,
            "paypal" => "4LZ3EUVCBENE4",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[131] = array(
            "name" => "Logo Shirt, Orange",
            "img" => "img/shirts/shirt-131.jpg",    
            "price" => 20,
            "paypal" => "7BNDYJBKWD364",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    $products[132] = array(
            "name" => "Mike the Frog Shirt, Red",
            "img" => "img/shirts/shirt-132.jpg",    
            "price" => 25,
            "paypal" => "Y6EQRE445MYYW",
            "sizes" => array("Small","Medium","Large","X-Large")
    );
    
	foreach ($products as $product_id => $product){
		$products[$product_id]["sku"] = $product_id;
    }*/

    
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
