<?php 
session_start();
     
if(isset($_SESSION['name'])){

include('layout/header.php'); 
?>
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
                            <h5 class="m-b-10">Purchase Report</h5>
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
            <!-- [ Contextual-table ] start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Daily Purchase Report</h5>
                    </div>
                    <div class="card-body">
                        <form class="row g-3" action="" method="GET" id="reportFrom">
                            <?php if(isset($_GET['start_date'])){ 
                                $start_date = $_GET['start_date'];
                                $end_date = $_GET['start_date'];
                            }?>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Start Date</label>
                                <input type="date" value="<?php echo $start_date?>" name="start_date" id="start_date" class="form-control">
                                
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">End Date</label>
                               <input type="date" value="<?php echo $end_date?>" id="end_date" name="end_date" class="form-control" >
                                
                            </div> 
                            
                            <div class="col-md-4 mt-2">
                                <br>
                                <button type="submit" name="submit" class="btn btn-sm btn-primary py-2"><i class="fa fa-eye"></i> View Purchase Report</button>  
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- [ Contextual-table ] end -->
           
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="card">
                        <?php if(isset($_GET['submit'])){ ?>
                            <table class="table table-striped">
                                <td>
                                    <strong>Purchase Date:</strong> <?php echo $_GET['start_date']; ?> to 
                                    <?php echo $_GET['end_date']; ?>
                                </td>
                            </table>
                        <table class="table table-striped table-bordered" width="100%;" id="example">
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
                                    $start_date = $_GET['start_date'];
                                    $end_date = $_GET['end_date'];
                                    
                                    $sql = "SELECT purchases.*, products.name as product, brands.name as brand FROM purchases
                                    JOIN products
                                    ON purchases.product_id = products.id
                                    JOIN brands
                                    ON purchases.brand_id = brands.id
                                     WHERE date BETWEEN '$start_date' AND '$end_date'";

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
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<script>
   $('document').ready(function(){
    $('#reportFrom').validate({
        rules:{
            start_date:{
                required: true,
            },
            end_date:{
                required: true,
            },
        },
        messages:{
            start_date:"<span class='text text-danger'>Start Date is Required</span>",
            end_date:"<span class='text text-danger'>End Date is Required</span>",
        }
    });
   });
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
<?php include('layout/footer.php');
}else{
    header('Location:../index.php');
}
?>