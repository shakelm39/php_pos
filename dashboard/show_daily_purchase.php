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
                            <h5 class="m-b-10">Daily Purchase Report</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Purchase Report List </a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php if(isset($_GET['date'])){ ?>
                            
                            <table class="table table-striped">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                
                                <td colsapan="2"><a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark" onclick="printContent('printAreas');" id="btnPrints"><i
                            class="fas fa-print text-primary"></i> Print</a></td>
                            <td></td>
                            </table>
                            <div id="printAreas">
                                <h5 class="">
                                    Daily Purchase Report 
                                </h5>
                                <span> <strong>Purchase Date:</strong> <?php echo $_GET['date']; ?></span>
                                <table class="table table-bordered" width="100%;">
                                    <thead>
                                        <th>Sl</th>
                                        <th>Date</th>
                                        <th>Purchase No</th>
                                        <th>Product Name</th>
                                        <th>Brand</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $date = $_GET['date'];
                                            
                                            
                                            $sql = "SELECT purchases.*, products.name as product, brands.name as brand FROM purchases
                                            JOIN products
                                            ON purchases.product_id = products.id
                                            JOIN brands
                                            ON purchases.brand_id = brands.id
                                            WHERE purchases.date='$date'";

                                            $query = $conn->query($sql);
                                            $sln = 1;
                                            $grandtotal = "0";
                                            while($result = mysqli_fetch_array($query)){
                                            $tota_price = $result['buying_qty'] * $result['unit_price'];
                                        ?>
                                        <tr>
                                            <td><?php echo $sln; ?></td>
                                            <td><?php echo $result['date']; ?></td>
                                            <td><?php echo $result['purchase_no']; ?></td>
                                            <td><?php echo $result['product']; ?></td>
                                            <td><?php echo $result['brand']; ?></td>
                                            <td><?php echo $result['buying_qty']; ?></td>
                                            <td><?php echo $result['unit_price']; ?></td>
                                            <td><?php echo $tota_price; ?> ৳</td>
                                        </tr>
                                        <?php
                                            $grandtotal+=$tota_price;
                                            $sln++ ;
                                            };
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7" class="text-right">Grand Total =</td>
                                            <td><?php echo $grandtotal; ?> ৳</td>
                                        </tr>
                                    </tfoot>
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