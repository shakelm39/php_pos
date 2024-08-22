<?php include('config/config.php'); ?>

<?php 

   if(isset($_POST['submit'])){
        $supplier   = $_POST['supplier_id'];
        $unit       = $_POST['unit_id'];
        $category   = $_POST['category_id'];
        $brand      = $_POST['brand_id'];
        $name       = $_POST['name'];

        // file upload 
        $filename = $_FILES["img"]["name"];
        $tempname = $_FILES["img"]["tmp_name"];  
        $folder = "img/product_img/".$filename; 
        $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
        
        $sql = "INSERT INTO products(supplier_id, unit_id, category_id, brand_id, name, img) VALUES ('$supplier','$unit','$category','$brand','$name','$filename')";
        
        $qry = mysqli_query($conn, $sql);

        if($qry){
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $_FILES["img"]["size"] > 500000 ){
                $msg =  "Sorry, only JPG, JPEG, PNG & GIF files and max size 5 MB are allowed.";
                header('Location: view_products.php?msg='.$msg);
            }else{
                move_uploaded_file($tempname, $folder);
                $msg= '<div class="alert alert-success alert-dismissible"><a class="close" data-dismiss="alert" aria-label="close">x</a>Products added Successfully!</div>';
                header('Location: view_products.php?msg='.$msg);
            }
        }else{
            $msg= '<div class="alert alert-danger alert-dismissible"><a class="close" data-dismiss="alert" aria-label="close">x</a>Products added failed!</div>';
            header('Location: view_products.php?msg='.$msg);
        }
 
        

   }



?>

