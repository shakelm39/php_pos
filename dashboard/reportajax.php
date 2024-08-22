<?php 
    include ('config/config.php');
    
    if (!empty($_POST['supplier_id'])) {
        $supId = $_POST['supplier_id'];
        //fetch category from database

        $query = "SELECT distinct(categories.name) as catName, products.category_id as catId, products.supplier_id FROM categories 
        JOIN products 
        ON categories.id = products.category_id 
        WHERE supplier_id='$supId'";

        $result = $conn->query($query);

        //Generate HTML of Category options list

        if($result->num_rows>0)
        {
            echo '<option value="">Select Category</option>';
            while($row = $result->fetch_assoc()){
                echo '<option value="'.$row['catId'].'">'.$row['catName'].'</option>';
            }
        }else{
            echo '<option value ="">Category Not Found</option>';
        }
    }

    //select products 
    if (!empty($_POST['category_id'])) {
        $catId = $_POST['category_id'];
        
        //fetch Product from database
      
        $query = "SELECT * FROM products WHERE category_id='$catId'";

        $result = $conn->query($query);
        
        //Generate HTML of Category options list

        if($result->num_rows>0)
        {
            echo '<option value="">Select Product</option>';
            while($row = $result->fetch_assoc()){
                echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
            }
        }else{
            echo '<option value ="">Product Not Found</option>';
        }
    }

    //Select Brand 
    if (!empty($_POST['product_id'])) {
        $productId = $_POST['product_id'];
        //fetch Brand from database
      
        $query = "SELECT products.*, brands.id as brandId, brands.name as brandName FROM products
        JOIN brands
        ON products.brand_id = brands.id
        WHERE products.id = '$productId'";

        $result = $conn->query($query);

        //Generate HTML of Category options list

        if($result->num_rows>0)
        {
            echo '<option value="">Select Brand</option>';
            while($row = $result->fetch_assoc()){
                echo '<option value="'.$row['brandId'].'">'.$row['brandName'].'</option>';
            }
        }else{
            echo '<option value ="">Brand Not Found</option>';
        }
    }

  
    
?>


