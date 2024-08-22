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
                            <h5 class="m-b-10">Invoice Report</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Invoice Report List </a></li>
                            
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
                        <h5 class="text-center">Daily Invoice Report</h5>
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
                                <button type="submit" name="submit" class="btn btn-sm btn-primary py-2"><i class="fa fa-eye"></i> View Invoice Report</button>  
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- [ Contextual-table ] end -->
           
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php if(isset($_GET['submit'])){ ?>
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
                                <table width="100%;" class="table table-striped">
                                    <tr>
                                        <td>
                                            <strong>Invoice Date:</strong> <?php echo $_GET['start_date']; ?> to 
                                            <?php echo $_GET['end_date']; ?>
                                        </td>
                                        <td width="60%">Daily Invoice Report</td>
                                        <td></td>
                                    </tr>
                                </table>
                        <table class="table table-bordered" width="100%;">
                            <thead>
                                <th>Sl</th>
                                <th>Date</th>
                                <th>Invoice No</th>
                                <th>Customer Info</th>
                                <th>Description</th>
                                <th>Amount</th>
                                
                            </thead>
                            <tbody>
                                <?php 
                                    $start_date = $_GET['start_date'];
                                    $end_date = $_GET['end_date'];
                                    
                                    $sql = "SELECT payments.*, invoices.*,customers.* FROM payments
                                    JOIN invoices
                                    ON payments.invoice_id = invoices.id
                                    JOIN customers 
                                    ON payments.customer_id = customers.id
                                     WHERE date BETWEEN '$start_date' AND '$end_date'";

                                    $query = $conn->query($sql);
                                    $sln = 1;
                                    $grandtotal = "0";
                                    while($result = mysqli_fetch_array($query)){
                                       $total_price =  $result['total_amount'];
                                ?>
                                <tr>
                                    <td><?php echo $sln; ?></td>
                                    <td><?php echo $result['date']; ?></td>
                                    <td>#<?php echo $result['invoice_no']; ?></td>
                                    <td><?php echo $result['name'].'('.$result['mobile_no'].','.$result['address'].')'; ?></td>
                                    <td><?php echo $result['description']; ?></td>
                                    <td><?php echo $result['total_amount']; ?></td>
                                    
                                </tr>
                                <?php
                                    $grandtotal+=$total_price;
                                    $sln++ ;
                                    };
                                ?>
                            </tbody>
                            <tfoot>
                                <?php 
                                    if(!$grandtotal==0){

                                    
                                ?>
                                <tr>  
                                    <td colspan="5" class="text-right">Grand Total =</td>
                                    <td><?php echo $grandtotal; ?> ৳</td>
                                </tr>
                                <?php }else{ ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-danger">No Result Found!</td>
                                    </tr>
                                    <?php }?>
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
<?php 
include('layout/footer.php');
}else{
    header('location:../index.php');
}
?>