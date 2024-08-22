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
                            <h5 class="m-b-10">Invoices</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Invoice Details </a></li>
                            
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
                <?php 
                    if(isset($_GET['id'])){
                        $invoiceId = $_GET['id'];
                        $sql = "SELECT invoices.*, invoice_details.*, payments.*, customers.* FROM invoices 
                        JOIN invoice_details
                        ON invoices.id = invoice_details.invoice_id
                        JOIN payments
                        ON invoices.id = payments.invoice_id
                        JOIN customers
                        ON payments.customer_id = customers.id
                         where invoices.id = $invoiceId";
                        $query =$conn->query($sql);
                        $row = $query->fetch_assoc();

                        $invoice_no = $row['invoice_no'];
                        $date = $row['date'];
                        $customer = $row['name'];
                    }
                    
                ?>
            <div class="card" id="downloads">
                <div class="card-body">
                    <div class="container mb-5 mt-3">
                    <div class="row d-flex align-items-baseline">
                        <div class="col-xl-9">
                        <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>No: #<?php echo $invoice_no; ?></strong></p>
                        </div>
                        <div class="col-xl-3 float-end">
                        <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark" onclick="printContent('printArea');" id="btnPrint"><i
                            class="fas fa-print text-primary"></i> Print</a>
                        <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark" id="download"><i
                            class="far fa-file-pdf text-danger"></i> Export</a>
                        </div>
                        <hr>
                    </div>

                    <div class="container" id="printArea">
                        <div class="col-md-12">
                        <div class="text-center">
                            <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
                            <p class="pt-0">Point of Sale</p>
                        </div>

                        </div>


                        <div class="row">
                        <div class="col-xl-8">
                            <ul class="list-unstyled">
                            <li class="text-muted">To:<span style="color:#5d9fc5 ;"><?php echo $customer; ?></span></li>
                            <li class="text-muted">Address: <?php echo $row['address']; ?></li>
                            
                            <li class="text-muted"><i class="fas fa-phone"></i> <?php echo $row['mobile_no']; ?></li>
                            </ul>
                        </div>
                        <div class="col-xl-4">
                            <p class="text-muted">Invoice</p>
                            <ul class="list-unstyled">
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                class="fw-bold">ID:</span>#<?php echo $invoice_no; ?></li>
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                class="fw-bold">Creation Date: </span><?php echo date('d-m-Y', strtotime($date)); ?></li>
                            <li class="text-muted">
                            <i class="fas fa-circle" style="color:#84B0CA ;"></i> 
                            <span class="me-1 fw-bold">Status:</span>
                                <?php 
                                    if($row['paid_status']=='full_paid'){
                                        echo '<span class="badge bg-success text-white fw-bold">Full Paid</span>';
                                    }elseif($row['paid_status']=='partial_paid'){
                                        echo '<span class="badge bg-warning text-white fw-bold">Partial Paid</span>';
                                    }elseif($row['paid_status']=='full_due'){
                                        echo '<span class="badge bg-danger text-white fw-bold">Full Due</span>';
                                    }; 
                                ?>
                                
                            </li>
                            </ul>
                        </div>
                        </div>

                        <div class="row my-2 mx-1 justify-content-center">
                        <table class="table table-striped table-borderless">
                            <thead style="background-color:#84B0CA ;" class="text-white">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col">Image</th>
                                <th scope="col">Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT invoice_details.*, products.name as product, products.img as product_img FROM invoice_details
                                    JOIN products
                                    ON invoice_details.product_id = products.id
                                    WHERE invoice_id ='$invoiceId' ";
                                    $query = $conn->query($sql);
                                    $sln = 1;
                                    $subtotal = 0;
                                    while($result = $query->fetch_assoc()){
                                        $img = $result['product_img'];
                                ?>
                            <tr>
                                <th scope="row"><?php echo $sln; ?></th>
                                <td><?php echo $result['product']; ?></td>
                                <td><?php echo $result['selling_qty']; ?></td>
                                <td><?php echo $result['unit_price']; ?></td>
                                <td> <img width="80" height="80" src="<?php echo 'img/product_img/'.$img; ?>" alt=""> </td>
                                <td>৳ <?php echo $result['selling_price']; ?></td>
                                
                            </tr>
                            <?php
                                $subtotal +=  $result['selling_price'];
                             $sln++; 
                             }; ?>
                            
                            </tbody>

                        </table>
                        </div>
                        <div class="row">
                        <div class="col-xl-8">
                            <p class="ms-3"><?php echo $row['description']; ?></p>

                        </div>
                        <div class="col-md-3 col-xl-3">
                            <ul class="list-unstyled">
                            <li class="text-muted ms-3"><span class="text-black me-4">SubTotal: </span> ৳ <?php echo $subtotal; ?> </li>
                            <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Discount: </span> ৳ <?php echo $row['discount_amount']; ?></li>
                            <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Paid Amount: </span> ৳ <?php echo $row['paid_amount']; ?></li>
                            <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Due Amount: </span> ৳ <?php echo $row['due_amount']; ?></li>
                            </ul>
                            <p class="text-black float-start"><span class="text-black me-3"> Total Amount</span><span
                                style="font-size: 25px;"> ৳ <?php echo floatval($subtotal) - floatval($row['discount_amount']); ?></span></p>
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-xl-10">
                            <p>Thank you for your purchase</p>
                        </div>
                        <div class="col-xl-2">
                        <?php 
                            if($row['paid_status']=='full_paid'){
                                
                            }elseif($row['paid_status']=='partial_paid'){
                              echo "<a class='btn btn-primary text-capitalize' href=".'edit_invoice.php?id='.$_GET['id']." style='background-color:#60bdf3 ;'>Pay Now</a>";
                            }elseif($row['paid_status']=='full_due'){
                                echo "<a class='btn btn-primary text-capitalize' href=".'edit_invoice.php?id='.$_GET['id']." style='background-color:#60bdf3 ;'>Pay Now</a>";
                            }; 
                        ?>
                            
                        </div>
                        </div>

                    </div>
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
<!-- print script  -->
<script>
    // print function 
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printArea  = document.getElementById(el).innerHTML;
        document.body.innerHTML = printArea;
        window.print();
        document.body.innerHTML = restorepage;
    }

    //download function 

    window.onload = function(){
        document.getElementById("download")
        .addEventListener("click",()=>{
            const downloads = this.document.getElementById("downloads");
            var opt = {
                    margin:       .2,
                    filename:     'Invoice.pdf',
                    image:        { type: 'jpeg', quality: 0.98 },
                    html2canvas:  { scale: 2 },
                    jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
                    };
                    html2pdf().set(opt).from(downloads).save();
        })
    }
</script>
<?php include('layout/footer.php')?>
<?php 
    }else{
    header('Location:../index.php');
    }
?>