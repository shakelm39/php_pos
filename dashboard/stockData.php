<?php 
    include ('config/config.php');
    
    //Stock Select
    if (!empty($_POST['product_id'])) {
        $productId = $_POST['product_id'];
        //fetch stock from database

        $query = "SELECT quantity FROM products WHERE id='$productId'";

        $result = $conn->query($query);

        //Generate HTML of Stock 

        if($result->num_rows>0)
        {
            
            while($row = $result->fetch_assoc()){
                echo $row["quantity"];
            }
        }
    }

    
    ?>
