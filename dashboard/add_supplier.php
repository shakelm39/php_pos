<?php include('config/config.php'); ?>

<?php 

   if(isset($_POST['submit'])){
        $name  = $_POST['name'];
        $mobile  = $_POST['mobile_no'];
        $email  = $_POST['email'];
        $address  = $_POST['address'];


        $sql = "SELECT email FROM suppliers WHERE email = '$email'";

        if($result = mysqli_query($conn, $sql)){
            $rowcount=mysqli_num_rows($result);
            if($rowcount>0){
                $msg= '<div class="alert alert-danger alert-dismissible"><a class="close" data-dismiss="alert" aria-label="close">x</a>Supplier Allready Exist in Database!</div>';
                header('Location: view_suppliers.php?msg='.$msg);
            }else{
                $rs = "INSERT INTO suppliers(name, mobile_no, email, address) VALUES ('$name','$mobile','$email','$address')";
                $results = mysqli_query($conn, $rs);
                if($results){
                    $msg= '<div class="alert alert-success alert-dismissible"><span class="close" data-dismiss="alert" aria-label="close">x</span>Supplier Successfully Added!</div>';
                    header('Location: view_suppliers.php?msg='.$msg);
                }
            }
        }
 
        

   }



?>

