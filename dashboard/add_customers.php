<?php 
session_start();
include('config/config.php'); 
?>

<?php 

   if(isset($_POST['submit'])){
        $name       = $_POST['name'];
        $mobile     = $_POST['mobile_no'];
        $email      = $_POST['email'];
        $address    = $_POST['address'];
        $created_by = $_SESSION['userid'];

        $sql = "SELECT email FROM customers WHERE email = '$email'";

        if($result = mysqli_query($conn, $sql)){
            $rowcount=mysqli_num_rows($result);
            if($rowcount>0){
                $msg= '<div class="alert alert-danger alert-dismissible"><a class="close" data-dismiss="alert" aria-label="close">x</a>Customer Allready Exist in Database!</div>';
                header('Location: view_customers.php?msg='.$msg);
            }else{
                $rs = "INSERT INTO customers(name, mobile_no, email, address,created_by) VALUES ('$name','$mobile','$email','$address','$created_by')";
                $results = mysqli_query($conn, $rs);
                if($results){
                    $msg= '<div class="alert alert-success alert-dismissible"><span class="close" data-dismiss="alert" aria-label="close">x</span>Customer Successfully Added!</div>';
                    header('Location: view_customers.php?msg='.$msg);
                }
            }
        }
 
        

   }



?>

