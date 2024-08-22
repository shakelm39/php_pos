<?php 
    include ('config/config.php');

    if(isset($_POST['submit'])){
       if($_POST['category_id']==null){
        $msg = 'sorry! You do not select any item';
        header('Location:add_purchase.php?msg='.$msg);
       }else{
        $count_category = count($_POST['category_id']);
        
        for($i=0;$i<$count_category;$i++){
            $pid = $_POST['product_id'][$i];
            $alldata = "SELECT * FROM products WHERE id='$pid'";
            $rse = $conn->query($alldata);

            while($row = $rse->fetch_assoc()){
                $name = $row['name']."<br>";
                $quantity = $row['quantity'];
                $purchase_qty = $_POST['buying_qty'][$i]+$quantity;
                echo $purchase_qty.$name."<br>";
                $usql = "UPDATE products SET quantity ='$purchase_qty' WHERE id= $pid";
                $conn->query($usql);
                
            }
            
        }
        // var_dump($count_category);
        // exit();
        for ($i=0; $i <$count_category ; $i++) { 
            $date = date("Y-m-d",strtotime($_POST['date'][$i]));
            $purchase_no  = $_POST['purchase_no'][$i];
            $brand_id     = $_POST['brand_id'][$i];
            $supplier_id  = $_POST['supplier_id'][$i];
            $category_id  = $_POST['category_id'][$i];
            $product_id   = $_POST['product_id'][$i];
            $buying_qty   = $_POST['buying_qty'][$i];
            $unit_price   = $_POST['unit_price'][$i];
            $buying_price = $_POST['buying_price'][$i];
            $description  = $_POST['description'][$i];
            $status       = '1';
            
            $sql = "INSERT INTO purchases(supplier_id, category_id, product_id, brand_id, purchase_no, date, description, buying_qty, unit_price, buying_price, status) VALUES ('$supplier_id','$category_id','$product_id','$brand_id','$purchase_no','$date','$description','$buying_qty','$unit_price','$buying_price','$status')";
            $query = $conn->query($sql);

            if($query){
                
                $msg = "<div class='alert alert-success'>Successfully data stored!</div>";
                header('location: view_purchase.php?msg='.$msg);
            }else{
                $msg = "<div class='alert alert-danger'>Error data not Stored!</div>";
                header('location: add_purchase.php?msg='.$msg);
            }
            
        }
         
       }
    }
   

?>