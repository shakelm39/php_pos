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
                            <h5 class="m-b-10">Manage Stock</h5>
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
                    <a type="button" class="btn  btn-primary float-right"><i class="fa fa-download"> Download List</i></a>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Supplier Name</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Product Name</th>
                                        <th>Purchase Qty</th>
                                        <th>Sell Qty</th>
                                        <th>Present Stock</th>
                                        <th>Unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                        $sqls = "SELECT products.*, suppliers.name as supplier, categories.name as category, brands.name as brand, units.name as unit, purchases.id, purchases.buying_qty, sum(buying_qty) as buyqty FROM products
                                        JOIN suppliers
                                        ON products.supplier_id = suppliers.id
                                        JOIN categories
                                        ON products.category_id = categories.id
                                        JOIN brands
                                        ON products.brand_id =brands.id
                                        JOIN units
                                        ON products.unit_id = units.id
                                        JOIN purchases
                                        ON products.id = purchases.product_id
                                        WHERE products.id = purchases.product_id
                                        GROUP BY products.id";
                                        $qry = mysqli_query($conn, $sqls);
                                        $sln= 1;
                                        while($row = mysqli_fetch_assoc($qry)){
                                            $product_id = $row['id'];
                                            $supplier = $row['supplier'];
                                            $category = $row['category'];
                                            $brand = $row['brand'];
                                            $name = $row['name'];
                                            $quantity = $row['quantity'];
                                            $unit = $row['unit'];
                                            $buyqty = $row['buyqty'];
                                            $sellqty = $buyqty  - $quantity;

                                        ?>
                                        <tr>
                                            <td><?php echo $sln; ?></td>
                                            <td><?php echo $supplier; ?></td>
                                            <td><?php echo $category; ?></td>
                                            <td><?php echo $brand; ?></td>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $buyqty; ?></td>
                                            <td><?php echo $sellqty; ?></td>
                                            <td><?php echo $quantity; ?></td>
                                            <td><?php echo $unit; ?></td>
                                        </tr>
                                        <?php $sln++; }?>
                                </tbody>
                            </table>
                        </div>
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