<?php 
    session_start();
     
    if(isset($_SESSION['name'])){

?>
<?php include('layout/header.php'); ?>
<?php include('config/config.php'); ?>
<?php 

    if(isset($_GET['id'])){
       $id  =  $_GET['id'];
       $sql = "SELECT * FROM products WHERE id = $id";

       $qry         = mysqli_query($conn, $sql);
       $result      = mysqli_fetch_assoc($qry);
       $supplier    = $result['supplier_id'];
       $unit        = $result['unit_id'];
       $category    = $result['category_id'];
       $brand       = $result['brand_id'];
       $name        = $result['name'];
       $img         = $result['img'];
    }

    if(isset($_POST['submit'])){

        $id        = $_POST['id'];
        $supplier  = $_POST['supplier_id'];
        $unit      = $_POST['unit_id'];
        $category  = $_POST['category_id'];
        $brand     = $_POST['brand_id'];
        $name      = $_POST['name'];
        // file upload 
        $filename = $_FILES["img"]["name"];
        $tempname = $_FILES["img"]["tmp_name"];  
        $folder = "img/product_img/".$filename; 
        $imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
       
        $sqls = "UPDATE products SET supplier_id='$supplier',unit_id='$unit',category_id='$category',brand_id='$brand',name='$name',img='$filename' WHERE id='$id'";

        $query = mysqli_query($conn, $sqls);

        if($query){
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $_FILES["img"]["size"] > 500000 ){
                $msg =  "Sorry, only JPG, JPEG, PNG & GIF files and max size 5 MB are allowed.";
                header('Location: view_products.php?msg='.$msg);
            }else{
                move_uploaded_file($tempname, $folder);
                $msg= '<div class="alert alert-success alert-dismissible"><a class="close" data-dismiss="alert" aria-label="close">x</a>Products added Successfully!</div>';
                header('Location: view_products.php?msg='.$msg);
            }
        }else{
            $msg= '<div class="alert alert-danger alert-dismissible"><span class="close" data-dismiss="alert" aria-label="close">x</span>Product Update Failed!</div>';
            header('Location: view_products.php?msg='.$msg);
        }


    }
?>
<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<?php include('layout/sidebar.php')?>
	<!-- [ navigation menu ] end -->
	<!-- [ Header ] start -->
	<?php include('layout/navbar.php')?>
	<!-- [ Header ] end -->
	
	

<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Products</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Update Products </a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ Contextual-table ] start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <a href="view_products.php" class="btn  btn-primary float-right"><i class="fa fa-eye"> View Products</i></a>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation" novalidate action="edit_products.php" method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <img width="80" src="<?php echo "img/product_img/".$img; ?>" alt="img">
                                <input type="file" value="<?php echo "img/product_img/".$img; ?>" class="form-control" id="validationCustom01" name="img">
                                
                            </div>
                            <div class="col-md-12">
                                <label for="validationCustom01" class="form-label">Supplier Name</label>
                                <select name="supplier_id" class="form-control" id="validationCustom01" required>
                                    <?php 
                                        $suppliersql = "SELECT * FROM suppliers WHERE status =1 ";
                                        $supqry = mysqli_query($conn, $suppliersql);
                                        while($supresults = mysqli_fetch_assoc($supqry)){
                                        $db_sup_id = $supresults['id'];
                                        ?>
                                    ?>
                                    <option value="<?php echo $db_sup_id; ?>" <?php if($db_sup_id==$supplier){echo "selected";}?>><?php echo $supresults['name'];  ?></option>
                                    <?php } ?>
                                </select>
                                
                            </div>
                            <div class="col-md-12">
                                <label for="validationCustom01" class="form-label">Brand name</label>
                                
                                <select name="brand_id" class="form-control" id="validationCustom01" required>
                                <option value="">Select Brand</option>
                                    <?php 
                                        $brandsql = "SELECT * FROM brands WHERE status =1 ";
                                        $brandqry = mysqli_query($conn, $brandsql);
                                        while($brandresults = mysqli_fetch_assoc($brandqry)){
                                    ?>
                                    <option value="<?php echo $brandresults['id'];  ?>" <?php if($brandresults['id']==$brand){echo "selected";}?>><?php echo $brandresults['name'];  ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="validationCustom01" class="form-label">Category Name</label>
                                <select name="category_id" class="form-control" id="validationCustom01" required>
                                <option value="">Select Category</option>
                                    <?php 
                                        $catsql = "SELECT * FROM categories WHERE status =1 ";
                                        $catqry = mysqli_query($conn, $catsql);
                                        while($catresults = mysqli_fetch_assoc($catqry)){
                                    ?>
                                    <option value="<?php echo $catresults['id'];  ?>" <?php if($catresults['id']==$category){echo "selected"; }  ?>><?php echo $catresults['name'];  ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="validationCustom01" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="validationCustom01" name="name" value="<?php echo $name;  ?>" required>
                                <div class="invalid-feedback">
                                Enter Product Name!
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="validationCustom01" class="form-label">Unit Name</label>
                                <select name="unit_id" class="form-control" id="validationCustom01" required>
                                <option value="">Select Unit</option>
                                    <?php 
                                        $unitsql = "SELECT * FROM units WHERE status =1 ";
                                        $unitqry = mysqli_query($conn, $unitsql);
                                        while($unitresults = mysqli_fetch_assoc($unitqry)){
                                    ?>
                                    <option value="<?php echo $unitresults['id'];  ?>" <?php if($unitresults['id']==$unit){echo "selected";} ;  ?>><?php echo $unitresults['name'];  ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div>
                                <input type="hidden" value="<?php echo $id; ?>" name="id">
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary mt-3" type="submit" name="submit">Update Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- [ Contextual-table ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()
</script>
<?php include('layout/footer.php')?>
<?php 
}else{
 header('Location:../index.php');
}
?>