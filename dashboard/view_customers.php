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
                            <h5 class="m-b-10">Customer</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Customer List </a></li>
                            
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
                    <button type="button" class="btn  btn-primary float-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"> Add Customer</i></button>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                        $sqls = "SELECT * FROM customers";
                                        $qrys = mysqli_query($conn, $sqls);
                                        $sln = 1;
                                        while($rs = mysqli_fetch_assoc($qrys)){
                                            $id = $rs['id'];
                                    ?>
                                    <tr class="table-active">
                                        <td><?php echo $sln; ?></td>
                                        <td><?php echo $rs['name']; ?></td>
                                        <td><?php echo $rs['mobile_no']; ?></td>
                                        <td><?php echo $rs['email']; ?></td>
                                        <td><?php echo $rs['address']; ?></td>
                                        <td>
                                            <a href="edit_customers.php?id=<?php echo $id; ?>"  class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> </a>
                                            <a href="delete_customers.php?id=<?php echo $id; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this data?');"> <i class="fa fa-trash"></i> </a>
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
            <!-- supplier add form  modal  -->
            <div class="col-sm-12">
				<div class="">
					
					<div class="card-body btn-page">
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">New Customer</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
                                    <form class="row g-3 needs-validation" novalidate action="add_customers.php" method="POST">
                                        <div class="col-md-12">
                                            <label for="validationCustom01" class="form-label">Customer name</label>
                                            <input type="text" class="form-control" id="validationCustom01" name="name" required>
                                            <div class="invalid-feedback">
                                            Enter Customer Name!
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="validationCustom02" class="form-label">Mobile Number</label>
                                            <input type="text" class="form-control" id="validationCustom02" name="mobile_no" required>
                                            <div class="invalid-feedback">
                                            Enter Customer Mobile Number!
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="validationCustomUsername" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                            <input type="email" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="email" required>
                                            <div class="invalid-feedback">
                                                Enter Customer Email!.
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="validationCustom03" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="validationCustom03" name="address" required>
                                            <div class="invalid-feedback">
                                            Enter Customer Address!.
                                            </div>
                                        </div>
                                       
                                        <div class="col-12">
                                            <button class="btn btn-primary mt-3" type="submit" name="submit">Add Customer</button>
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
<?php include('layout/footer.php')?>
<?php 
    }else{
    header('Location:../index.php');
    }
?>