<?php 
    session_start();
     
    if(isset($_SESSION['name'])){

?>
<?php include('layout/header.php'); ?>
<?php include('config/config.php'); ?>

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
                            <li class="breadcrumb-item"><a href="#!">Product List </a></li>
                            
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
                    <?php if(isset($_GET['msg'])) { echo $_GET['msg'];} ?>
                    <button type="button" class="btn  btn-primary float-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"> Add Product</i></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Supplier Name</th>
                                        <th>Brand Name</th>
                                        <th>Category</th>
                                        <th>Product Name</th>
                                        <th>Unit</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                        $sqls = "SELECT products.*, brands.name as brands, categories.name as category, units.name as unit, suppliers.name as supplier FROM products
                                        JOIN brands
                                        ON products.brand_id=brands.id
                                        JOIN categories
                                        ON products.category_id=categories.id
                                        JOIN units
                                        ON products.unit_id = units.id
                                        JOIN suppliers
                                        ON products.supplier_id = suppliers.id";
                                        $qrys = mysqli_query($conn, $sqls);
                                        $sln = 1;
                                        while($rs = mysqli_fetch_assoc($qrys)){
                                            $id = $rs['id'];
                                            $img = $rs['img'];
                                    ?>
                                    <tr class="table-active">
                                        <td><?php echo $sln; ?></td>
                                        <td><?php echo $rs['supplier']; ?></td>
                                        <td><?php echo $rs['brands']; ?></td>
                                        <td><?php echo $rs['category']; ?></td>
                                        <td><?php echo $rs['name']; ?></td>
                                        <td><?php echo $rs['unit']; ?></td>
                                        <td> <img width="120" height="50" src="<?php echo 'img/product_img/'.$img; ?>" alt=""> </td>
                                        <td>
                                            <a href="edit_products.php?id=<?php echo $id; ?>"  class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> </a>
                                            <a href="delete_products.php?id=<?php echo $id; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this data?');"> <i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>
                                    <?php
                                        $sln++; 
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Contextual-table ] end -->
            <!-- Product add form  modal  -->
            <div class="col-sm-12">
				<div class="">
					
					<div class="btn-page">
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">New Product</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
                                    <form class="row g-3 needs-validation" novalidate action="add_products.php" method="POST" enctype="multipart/form-data">
                                        <div class="col-md-12">
                                            <label for="image">Product Image</label>
                                            <input type="file" class="form-control" id="validationCustom01" name="img">
                                            <div class="invalid-feedback">
                                            Select Product Image!
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="validationCustom01" class="form-label">Supplier Name</label>
                                            <select name="supplier_id" class="form-control" id="validationCustom01" required>
                                            <option value="">Select Supplier</option>
                                                <?php 
                                                    $suppliersql = "SELECT * FROM suppliers WHERE status =1 ";
                                                    $supqry = mysqli_query($conn, $suppliersql);
                                                    while($supresults = mysqli_fetch_assoc($supqry)){
                                                ?>
                                                <option value="<?php echo $supresults['id'];  ?>"><?php echo $supresults['name'];  ?></option>
                                                <?php }?>
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
                                                <option value="<?php echo $brandresults['id'];  ?>"><?php echo $brandresults['name'];  ?></option>
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
                                                <option value="<?php echo $catresults['id'];  ?>"><?php echo $catresults['name'];  ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="validationCustom01" class="form-label">Product Name</label>
                                            <input type="text" class="form-control" id="validationCustom01" name="name" required>
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
                                                <option value="<?php echo $unitresults['id'];  ?>"><?php echo $unitresults['name'];  ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary mt-3" type="submit" name="submit">Add Product</button>
                                        </div>
                                        </form>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            
            <!-- form modal  -->
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
<script type="text/javascript">
	
    $(document).ready(function() {
        $('#example').DataTable(
            
            {     

        "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "iDisplayLength": 5
        } 
        );
    } );

</script>
<?php include('layout/footer.php')?>
<?php 
    }else{
    header('Location:../index.php');
    }
?>