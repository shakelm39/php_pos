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
                            <h5 class="m-b-10">Purchase</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Purchase List </a></li>
                            
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
                    <a href="add_purchase.php" class="btn  btn-primary float-right"><i class="fa fa-plus"> Add Purchase</i></a>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Purchase No</th>
                                        <th>Supplier Name</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Product Name</th>
                                        <th>Description</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Buying Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                        $sqls = "SELECT purchases.*, suppliers.name as supplier, categories.name as category, brands.name as brand, products.name as product FROM purchases 
                                        JOIN suppliers
                                        ON purchases.supplier_id = suppliers.id
                                        JOIN categories
                                        ON purchases.category_id = categories.id
                                        JOIN brands
                                        ON purchases.brand_id = brands.id
                                        JOIN products
                                        ON purchases.product_id = products.id 
                                        Order by id DESC";
                                        $qrys = mysqli_query($conn, $sqls);
                                        $sln = 1;
                                        while($rs = mysqli_fetch_assoc($qrys)){
                                            
                                            
                                    ?>
                                    <tr>
                                        <td><?php echo $sln; ?></td>
                                        <td><?php echo $rs['date']; ?></td>
                                        <td><?php echo $rs['purchase_no']; ?></td>
                                        <td><?php echo $rs['supplier']; ?></td>
                                        <td><?php echo $rs['category']; ?></td>
                                        <td><?php echo $rs['brand']; ?></td>
                                        <td><?php echo $rs['product']; ?></td>
                                        <td><?php echo $rs['description']; ?></td>
                                        <td><?php echo $rs['buying_qty']; ?></td>
                                        <td><?php echo $rs['unit_price']; ?></td>
                                        <td><?php echo $rs['buying_price']; ?></td>
                                        
                                        <td>
                                            <a href="edit_products.php?id=<?php echo $rs['id']; ?>"  class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> </a>
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
        "iDisplayLength": 10
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