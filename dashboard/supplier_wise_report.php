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
                            <h5 class="m-b-10 justify-content-space-between">
                                <span>Manage Supplier Wise Stock</span>
                                <span class="float-right mr-4"><a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark" onclick="printContent('printAreas');" id="btnPrints"><i
                            class="fas fa-print text-primary"></i> Print</a></span>
                            </h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.php"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#!">Stock Report List </a>
                            </li> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        
        <!-- Supplier Wise Report -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php if(isset($_GET['supplier_id'])){ ?>
                            
                            <div id="printAreas">
                                <table width="100%;" class="table table-striped">
                                    <?php 
                                        $date = date("d-m-Y");
                                        $id = $_GET['supplier_id'];
                                        $sup = "SELECT * FROM suppliers where id =$id ";
                                        $qrr = $conn->query($sup);
                                        $rws = $qrr->fetch_assoc();
                                    ?>
                                    <tr>
                                        <th>Supplier Wise Stock Report:</th>
                                        
                                        <th>Date:</th>
                                        <td>
                                            <?php echo $date; ?>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                    <td colspan="3">
                                        <p><strong>Supplier Name: </strong> 
                                        <?php echo $rws['name']; ?><br> 
                                        <strong>Supplier Mobile: </strong> 
                                        <?php echo $rws['mobile_no']; ?><br> <strong>Supplier Address: </strong> 
                                        <?php echo $rws['address']; ?></p>
                                    </td>
                                    </tr>
                                </table>
                                <table class="table table-bordered table-dark">
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
                                        $supplier_id = $_GET["supplier_id"];
                                        $sqls = "SELECT products.*, suppliers.name as supplier, categories.name as category, brands.name as brand, units.name as unit, purchases.id, purchases.buying_qty, sum(buying_qty) as buyqty FROM products
                                        JOIN suppliers
                                        ON products.supplier_id = $supplier_id
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
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- [ Main Content ] end -->
    </div>
</div>

<script>
    //Print function 
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printAreas  = document.getElementById(el).innerHTML;
        document.body.innerHTML = printAreas;
        window.print();
        document.body.innerHTML = restorepage;
    }
   
</script>


<?php include('layout/footer.php')?>
<?php 
    }else{
    header('Location:../index.php');
    }
?>