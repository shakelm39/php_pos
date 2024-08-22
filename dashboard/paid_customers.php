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
                            <h5 class="m-b-10">Paid Customer</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Paid Customer List </a></li>
                            
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
                    
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-bordered table-dark">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Info</th>
                                        <th>Date</th>
                                        <th>Invoice No</th>
                                        <th>Amount</th>
                                        <th>Paid Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                        $sqls = "SELECT payments.*,invoices.date, invoices.invoice_no, invoices.description, customers.* FROM payments 
                                        JOIN invoices
                                        ON payments.invoice_id = invoices.id
                                        JOIN customers
                                        ON payments.customer_id = customers.id
                                        WHERE paid_status='full_paid' order by payments.id desc";
                                        $qrys = mysqli_query($conn, $sqls);
                                        $sln = 1;
                                        while($rs = mysqli_fetch_assoc($qrys)){
                                            $id = $rs['invoice_id'];
                                            
                                            
                                    ?>
                                    <tr>
                                        <td><?php echo $sln; ?></td>
                                        <td><?php echo $rs['name']." ( ". $rs['mobile_no'].","." ".$rs['address']." )"; ?></td>
                                        <td><?php echo $rs['date']; ?></td>
                                        <td><?php echo $rs['invoice_no']; ?></td>
                                        <td><?php echo $rs['total_amount']; ?></td>
                                        <td><?php 
                                            if($rs['paid_status']=='full_paid'){
                                                echo "<span class='badge bg-success'>Paid</span>";
                                            }elseif($rs['paid_status']=='partial_paid'){
                                                echo "<span class='badge bg-warning'>Partial Paid</span>";
                                            }elseif($rs['paid_status']=='full_due'){
                                                echo "<span class='badge bg-danger'>Due</span>";
                                            }; 
                                        ?></td>
                                        
                                        <td>
                                            <a href="show_invoice.php?id=<?php echo $id; ?>"  class="btn btn-sm btn-primary"> <i class="fa fa-eye"></i> </a>
                                            
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
<?php include('layout/footer.php')?>
<?php 
}else{
 header('Location:../index.php');
}
?>