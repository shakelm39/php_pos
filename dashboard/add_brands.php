<?php 
    session_start();
    include('config/config.php'); 
?>

<?php 

   if(isset($_POST['submit'])){
        $name  = $_POST['name'];
        
        $created_by = $_SESSION['userid'];
        $sql = "SELECT name FROM brands WHERE name = '$name'";

        if($result = mysqli_query($conn, $sql)){
            $rowcount=mysqli_num_rows($result);
            if($rowcount>0){
                $msg= '<div class="alert alert-danger alert-dismissible"><a class="close" data-dismiss="alert" aria-label="close">x</a>Brand Allready Exist in Database!</div>';
                header('Location: view_brands.php?msg='.$msg);
            }else{
                $rs = "INSERT INTO brands(name,created_by) VALUES ('$name','$created_by')";
                
                $results = mysqli_query($conn, $rs);
                if($results){
                    $msg= '<div class="alert alert-success alert-dismissible"><span class="close" data-dismiss="alert" aria-label="close">x</span>Brand Successfully Added!</div>';
                    header('Location: view_brands.php?msg='.$msg);
                }
            }
        }
 
        

   }



?>

