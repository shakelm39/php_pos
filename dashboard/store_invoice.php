<?php 
    include ('config/config.php');

    if(isset($_POST['submit'])){
        if($_POST['category_id'] ==NULL){
            $msg = '<div class="alert alert-danger">sorry! You do not select any item</div>';
            header('Location:add_invoice.php?msg='.$msg);
            
        }else{
            if($_POST['paid_amount'] > $_POST['estimated_amount']){
                $msg = '<div class="alert alert-danger">sorry! You input maximum value of total amount</div>';
                header('Location:add_invoice.php?msg='.$msg);
            }else{
                $count = count($_POST['category_id']);
                $product_id     = $_POST['product_id'];
                $selling_price    = $_POST['selling_price'];
                $cat_id = $_POST['category_id'];
                
                for($i=0; $i<$count; $i++){
                    
                    $date           = date("Y-m-d",strtotime($_POST['date']));
                    $invoice_no     = $_POST['invoice_no'];
                    $description    = $_POST['description'];
                    $mobile_no      = $_POST['mobile_no'];
                    $customer_id    = $_POST['customer_id'];
                    $paid_amount    = $_POST['paid_amount'];
                    $paid_status    = $_POST['paid_status'];
                    $discount_amount= $_POST['discount_amount'];
                    $estimated_amount= $_POST['estimated_amount'];
                    
                    $status         = '1';
                    
                    $selling_qty    = $_POST['selling_qty'][$i];
                    $selling_price    = $_POST['selling_price'][$i];
                    
                    
                }
                
                foreach($cat_id as $key => $category){
                    $pid = $product_id[$key];
                    $product = "SELECT * FROM products WHERE id=$pid ";
                    $row = $conn->query($product);
                    $result = $row->fetch_assoc();
                    $quantity = $result['quantity'];
                    $name = $result['name'];
                    
                    if($quantity <$selling_qty){
                        
                        $msg= "<div class='alert alert-danger'>Your <strong>". $name ."</strong> quantity is zero. please add product first.!</div>";
                        header('Location: add_invoice.php?msg='.$msg);
                        exit();
                    }else{

                        // update product qnty
                        $productQty = floatval($quantity)- floatval($selling_qty);
                        $sql = "UPDATE products SET quantity='$productQty' WHERE id=$pid"; 
                        $conn->query($sql);
                        
                    }//if loop end  
                    }//foreach loop end  
                        //customer table start
                        if ($customer_id =='0') {

                            $customer_name 	= $_POST['name'];
                            $mobile_no 		= $_POST['mobile_no'];
                            $address 		= $_POST['address'];


                            $customersql = "INSERT INTO customers(name, mobile_no,address) VALUES ('$customer_name','$mobile_no','$address')";
                            $conn->query($customersql);
                            

                            $cusql= "SELECT max(id) FROM customers";
                            $row = mysqli_query($conn, $cusql);
                            $restt = $row->fetch_assoc();
                            $customer_id = $restt['max(id)'];
                            
                        }else{
                            $customer_id    = $_POST['customer_id'];
                        }//customer table end

                        //invoice table start
                        $invsql = "INSERT INTO invoices(invoice_no, date, description,status) VALUES ('$invoice_no','$date','$description','$status')";
                        $invquery = $conn->query($invsql);
                        //invoice table end

                        
                        //invoice details table start
                        if($invquery){
                            $invsql= "SELECT max(id) FROM invoices";
                            $row = mysqli_query($conn, $invsql);
                            $rest = $row->fetch_assoc();
                            $invoice_id = $rest['max(id)'];

                            $count_category = count($_POST['category_id']);
                                for ($i=0; $i <$count_category ; $i++) {

                                    $category_id    = $_POST['category_id'][$i];
                                    $product_id     = $_POST['product_id'][$i];
                                    $brand_id       = $_POST['brand_id'][$i];
                                    $unit_price     = $_POST['unit_price'][$i];
                                    $selling_qty    = $_POST['selling_qty'][$i];
                                    $selling_price  = $_POST['selling_price'][$i];

                                    
                                    $invdetails = "INSERT INTO invoice_details(date, invoice_id, category_id, brand_id, product_id, selling_qty, unit_price, selling_price, status) VALUES ('$date','$invoice_id','$category_id','$brand_id','$product_id','$selling_qty','$unit_price','$selling_price','$status')";
                                    $conn->query($invdetails);      
                                    
                            }
                        }//invoice details table end
                        

                    //payment table start
                    if ($paid_status =='full_paid') {
                        $invoice_id = $rest['max(id)'];
                        
                        $due_amount  ='0';
                        $current_paid_amount 	= $estimated_amount;

                        $sql = "INSERT INTO payments(invoice_id, customer_id, paid_status, paid_amount, due_amount, total_amount, discount_amount) VALUES ('$invoice_id','$customer_id','$paid_status','$estimated_amount','$due_amount','$estimated_amount','$discount_amount');
                        
                        INSERT INTO payment_details(invoice_id, current_paid_amount, date) VALUES ('$invoice_id','$current_paid_amount','$date')";
                        $conn->multi_query($sql);//payment details table


                    }elseif ($paid_status=='full_due') {

                        $invoice_id = $rest['max(id)'];
                        $paid_amount = '0';
                        $due_amount  =$estimated_amount;
                        $current_paid_amount ='0' ;

                        $sql = "INSERT INTO payments(invoice_id, customer_id, paid_status, paid_amount, due_amount, total_amount, discount_amount) VALUES ('$invoice_id','$customer_id','$paid_status','$paid_amount','$due_amount','$estimated_amount','$discount_amount');

                        INSERT INTO payment_details(invoice_id, current_paid_amount, date) VALUES ('$invoice_id','$current_paid_amount','$date')";
                        $conn->multi_query($sql);//payment details table
                        
                    }elseif ($paid_status =='partial_paid') {

                        $invoice_id = $rest['max(id)'];
                        
                        $due_amount  =$estimated_amount-$paid_amount;
                        

                        $sql = "INSERT INTO payments(invoice_id, customer_id, paid_status, paid_amount, due_amount, total_amount, discount_amount) VALUES ('$invoice_id','$customer_id','$paid_status','$paid_amount','$due_amount','$estimated_amount','$discount_amount');

                        INSERT INTO payment_details(invoice_id, current_paid_amount, date) VALUES ('$invoice_id','$paid_amount','$date')";//payment details table
                        $conn->multi_query($sql);  
                    }//paymet table ends
                        $msg = "<div class='alert alert-success'>Invoice Successfully Created</div>";
                        header('Location: view_invoices.php?msg='.$msg);
                      
                

            }//paid amount end

        }//category_id
    }//post submit end
   

?>
