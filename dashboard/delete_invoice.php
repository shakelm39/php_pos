<?php 
    include ('config/config.php');
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        
        $sql = "Delete from invoices where id = $id";
        $query = mysqli_query($conn, $sql);
        if($query){
            $swl = "SELECT * FROM invoice_details WHERE invoice_id='$id'";
                $res = $conn->query($swl);
                $rowcount = mysqli_num_rows($res);
                    for($i=0;$i<$rowcount;$i++){

                        while($result  =$res->fetch_assoc()){
                            $selling_qty = $result['selling_qty'];
                            $product_id = $result['product_id'];
                            $productsql = "SELECT quantity FROM products WHERE id = $product_id";
                            $productqry = $conn->query($productsql);
                            while($results = $productqry->fetch_assoc()){
                                $qty =  $results['quantity'];
                                $return_qty = $qty + $selling_qty;
                            };
                            $sqls = "UPDATE products SET quantity='$return_qty' WHERE id='$product_id'";
                            $upqry = $conn->query($sqls);
                            if($upqry){
                                
                            }
                        };
                        
                    }
                
                    
                };
                
                
                
            $array = ['invoice_details', 'payments','payment_details'];
         for($i = 0; $i < count($array); $i++){
            $single_array = $array[$i];
            $query = "DELETE FROM $single_array WHERE invoice_id = '$id'";
            $data = $conn->query($query);
            if($data)
            {
                
                $msg = "<div class='alert alert-success'>Successfully Invoice Deleted!</div>";
                header("Location: view_invoices.php?msg=.$msg");
            }
         }

        }else{
            echo "Failed to delete";
        }
    



?>