<?php include('config/config.php'); ?>
<?php 

    if(!empty($_POST['product_id'])){
        $productId = $_POST['product_id'];
        //fetch stock from database

        $query = "SELECT MAX(unit_price) as avg,purchases.*, products.id, products.name as product  FROM purchases 
            JOIN products
            ON purchases.product_id = products.id
            WHERE product_id='$productId'";

        $result = $conn->query($query);

        //Generate HTML of Stock 

        if($result->num_rows>0)
        {
            
            while($row = $result->fetch_assoc()){
                echo $row['product']. ' (৳- ' .$row["avg"]. ' )';
                
            }
        }
    }

?>