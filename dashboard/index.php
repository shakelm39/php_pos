
<?php   
    session_start();
     
    if(isset($_SESSION['name'])){


        include('config/config.php');
        include('layout/header.php'); 
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
                            <h5 class="m-b-10">Dashboard</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- table card-1 start -->
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                <a href="view_suppliers.php"><i class="icon feather icon-users text-c-green mb-1 d-block"></i></a>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <?php 
                                        $supsql = "SELECT * FROM suppliers WHERE status = '1'";
                                        $supquery = $conn->query($supsql);
                                        $suppliers = mysqli_num_rows($supquery);
                                        
                                    ?>
                                    <h5><?php echo $suppliers; ?></h5>
                                    <span> <a href="view_suppliers.php">Suppliers</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                <a href="view_customers.php"><i class="icon feather icon-users text-c-red mb-1 d-block"></i></a>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                <?php 
                                        $cussql = "SELECT * FROM customers WHERE status = '1'";
                                        $cusquery = $conn->query($cussql);
                                        $customers = mysqli_num_rows($cusquery);
                                        
                                    ?>
                                    <h5><?php echo $customers; ?></h5>
                                    <span> <a href="view_customers.php">Customers</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                <a href="view_brands.php"><i class="icon feather icon-file-text text-c-blue mb-1 d-block"></i></a>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                <?php 
                                        $brandsql = "SELECT * FROM brands WHERE status = '1'";
                                        $brandquery = $conn->query($brandsql);
                                        $brands = mysqli_num_rows($brandquery);
                                        
                                    ?>
                                    <h5><?php echo $brands; ?></h5>
                                    <span><a href="view_brands.php">Total Brands</a> </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                <a href="view_products.php"><i class="icon feather icon-list text-c-yellow mb-1 d-block"></i></a>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                <?php 
                                        $prosql = "SELECT * FROM products WHERE status = '1'";
                                        $proquery = $conn->query($prosql);
                                        $products = mysqli_num_rows($proquery);
                                        
                                    ?>
                                    <h5><?php echo $products; ?></h5>
                                    <span><a href="view_products.php">Products</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- widget primary card start -->
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-star-on"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>4000 +</h4>
                            <h6>Ratings Received</h6>
                        </div>
                    </div>
                </div>
                <!-- widget primary card end -->
            </div>
            <!-- table card-1 end -->
            <!-- table card-2 start -->
            <div class="col-md-12 col-xl-4">
                <div class="card flat-card">
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-shopping-cart text-c-blue mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                <?php 
                                        $pursql = "SELECT sum(buying_price) as purchase FROM purchases WHERE status = '1'";
                                        $purquery = $conn->query($pursql);
                                        $result = $purquery->fetch_assoc();

                                        //sell query

                                        $sellsql = "SELECT sum(selling_price) as sell FROM invoice_details WHERE status = '1'";
                                        $sellquery = $conn->query($sellsql);
                                        $results = $sellquery->fetch_assoc();
                                        

                                        $profit = floatval($results['sell']) -floatval( $result['purchase']);
                                    ?>
                                    <h5><?php echo $result['purchase']; ?></h5>
                                    <span>Purchase</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="icon feather icon-shopping-cart text-c-blue mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5><?php echo $results['sell'] ?></h5>
                                    <span>Sell</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row-table">
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                                <div class="col-sm-4">
                                    <i class="fas fa-trophy text-c-blue mb-1 d-block"></i>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <h5><?php echo $profit; ?></h5>
                                    <span><?php 
                                        if($results['sell']<$result['purchase']){
                                            echo "Loss";
                                        }else{
                                            echo "Profit";
                                        }
                                    ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="Due Tk"><i class="icon feather icon-star text-c-blue mb-1 d-blockz"></i></a>
                                </div>
                                <div class="col-sm-8 text-md-center">
                                    <?php 
                                        $duesql = "SELECT sum(due_amount) as due FROM payments";
                                        $dueqry = $conn->query($duesql);
                                        $row = $dueqry->fetch_assoc();
                                    ?>
                                    <h5><?php echo $row['due']; ?></h5>
                                    <span><a href="credit_customers.php">Due Tk</a> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- widget-success-card start -->
                <div class="card flat-card widget-purple-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>17</h4>
                            <h6>Achievements</h6>
                        </div>
                    </div>
                </div>
                <!-- widget-success-card end -->
            </div>
            <!-- table card-2 end -->
            <!-- Widget primary-success card start -->
            <div class="col-md-12 col-xl-4">
                <div class="card support-bar overflow-hidden">
                    <div class="card-body">
                        <h5 class="text text-danger">Low Stock Product Qty Below 5</h5>
                        <table class="table-bordered" width="100%" id="example2">
                            <thead>
                                <th>Sl</th>
                                <th>Product Name</th>
                                <th>Stock Qty</th>
                            </thead>
                            <tbody>
                               <?php 
                                $sql = "SELECT * FROM products where quantity<=5 and quantity>=1";
                                $query = $conn->query($sql);
                                $sln =1;
                                while($row = $query->fetch_assoc()){

                                
                               ?>
                                <tr>
                                    <td><?php echo $sln; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['quantity'];; ?></td>
                                  
                                </tr>
                                <?php 
                                $sln++;
                                };
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Widget primary-success card end -->

            <!-- prject ,team member start -->
        </div>
        <div class="row">
            <!-- Daily Purchase Table card-1 start -->
            <div class="col-md-12 col-xl-6">
                <div class="card flat-card">
                        <div class="card-header">
                            <h5>Daily Purchase</h5>
                        </div>
                    <div class="row-table">
                        
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                               <table class="table table-striped table-bordered" id="example1" cellspacing="0" width="100%">
                                    <thead>
                                        <th>Sl</th>
                                        <th>Date</th>
                                        <th>Purchase Amount</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                    <?php 
                                            $sql = "SELECT date, sum(buying_price) as buy FROM purchases group by date order by date desc";
                                            $qry = $conn->query($sql);
                                            $sln = 1;
                                            while ($row = $qry->fetch_assoc()) {
                                                $date = $row['date'];
                                        ?>
                                        <tr>
                                            <td><?php echo $sln; ?></td>
                                            <td><?php echo $row['date']; ?></td>
                                            <td>৳ <?php echo $row['buy']; ?></td>
                                            <td>
                                                <form action="" method="POST">
                                                    <a href="show_daily_purchase.php?date=<?php echo $date;?>" target="_blank"> <i class="fa fa-eye"></i>  </a>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php $sln++; }?>
                                    </tbody>
                               </table>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            <!-- table card-1 end -->
            <!-- Daily Sell Table card-2 start -->
            <div class="col-md-12 col-xl-6">
                <div class="card flat-card">
                        <div class="card-header">
                            <h5>Daily Sell Amount</h5>
                        </div>
                    <div class="row-table">
                        
                        <div class="col-sm-6 card-body br">
                            <div class="row">
                               <table class="table table-bordered" id="example" style="width:100%!important">
                                    <thead>
                                        <th>Sl</th>
                                        <th>Date</th>
                                        <th>Sell Amount</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql = "SELECT date, sum(selling_price) as sell FROM invoice_details group by date order by date desc";
                                            $qry = $conn->query($sql);
                                            $sln = 1;
                                            while ($row = $qry->fetch_assoc()) {
                                                $saledate = $row['date'];
                                        ?>
                                        <tr>
                                            <td><?php echo $sln; ?></td>
                                            <td><?php echo $row['date']; ?></td>
                                            <td>৳ <?php echo $row['sell']; ?></td>
                                            <td>
                                                <form action="" method="POST">
                                                    <a href="show_daily_sell.php?date=<?php echo $saledate;?>" target="_blank"> <i class="fa fa-eye"></i>  </a>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php $sln++; }?>
                                    </tbody>
                               </table>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            
        </div>
        
        <!-- [ Main Content ] end -->
        
    </div>
</div>
<script>
    $(document).ready(function() {
    $('#example1').DataTable(
        
         {     

      "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "iDisplayLength": 5
       } 
        );
} );


function checkAll(bx) {
  var cbs = document.getElementsByTagName('input');
  for(var i=0; i < cbs.length; i++) {
    if(cbs[i].type == 'checkbox') {
      cbs[i].checked = bx.checked;
    }
  }
}
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
<script type="text/javascript">
	
    $(document).ready(function() {
        $('#example2').DataTable(
            
            {     

        "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "iDisplayLength": 5
        } 
        );
    } );

</script>
<?php 
    include('layout/footer.php');
    }else{
        $msg = '<div class="alert alert-danger">Login first!</div>';
        header('Location: ../index.php?msg='.$msg);
    }
?>
