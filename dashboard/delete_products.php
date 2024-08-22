<?php 
    include('config/config.php');


    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = mysqli_query($conn, "SELECT * FROM products WHERE id = '$id'");
        while($row = mysqli_fetch_assoc($query)){
            $img = $row['img'];
        }
        unlink("img/product_img/".$img);
    
        

        if(mysqli_query($conn, "DELETE FROM products WHERE id = '$id'")){
            $msg= '<div class="alert alert-success alert-dismissible"><span class="close" data-dismiss="alert" aria-label="close">x</span>Product Successfully Deleted!</div>';
            header('Location: view_products.php?msg='.$msg);
        }
        
        
    }
?>