<?php 
    session_start();
     
    if(isset($_SESSION['name'])){

?>
<?php include('layout/header.php'); ?>
<?php include('config/config.php'); ?>
<?php 

    if(isset($_GET['id'])){
       $id =  $_GET['id'];
       $sql = "SELECT * FROM customers WHERE id = $id";

       $qry = mysqli_query($conn, $sql);
       $result = mysqli_fetch_assoc($qry);
       $name    = $result['name'];
       $mobile  = $result['mobile_no'];
       $email   = $result['email'];
       $address = $result['address'];
    }

    if(isset($_POST['submit'])){

        $id = $_POST['id'];
        $name    = $_POST['name'];
        $mobile_no  = $_POST['mobile_no'];
        $email   = $_POST['email'];
        $address = $_POST['address'];
        $address = $_POST['address'];

        $sqls = "UPDATE customers SET name='$name', mobile_no='$mobile_no',email='$email',address='$address' WHERE id='$id'";

        $query = mysqli_query($conn, $sqls);

        if($query){
            $msg= '<div class="alert alert-success alert-dismissible"><span class="close" data-dismiss="alert" aria-label="close">x</span>Customer Successfully Updated!</div>';
            header('Location: view_customers.php?msg='.$msg);
        }else{
            $msg= '<div class="alert alert-danger alert-dismissible"><span class="close" data-dismiss="alert" aria-label="close">x</span>Customer Update Failed!</div>';
            header('Location: view_customers.php?msg='.$msg);
        }


    }
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
	<?php include ('layout/navbar.php') ?>
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
                            <h5 class="m-b-10">Customers</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Update Customers </a></li>
                            
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
                    <a href="view_customers.php" class="btn  btn-primary float-right"><i class="fa fa-eye"> View Customer</i></a>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation" novalidate action="edit_customers.php" method="POST">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" id="validationCustom01" value="<?php echo $id; ?>" name="id" required>
                                
                            </div>
                             <div class="col-md-12">
                                <label for="validationCustom01" class="form-label">Customer name</label>
                                <input type="text" class="form-control" id="validationCustom01" value="<?php echo $name; ?>" name="name" required>
                                <div class="invalid-feedback">
                                Enter Customer Name!
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="validationCustom02" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" id="validationCustom02" value="<?php echo $mobile; ?>" name="mobile_no" required>
                                <div class="invalid-feedback">
                                Enter Customer Mobile Number!
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="validationCustomUsername" class="form-label">Email</label>
                                <div class="input-group has-validation">
                                <input type="email" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php echo $email; ?>" name="email" required>
                                <div class="invalid-feedback">
                                    Enter Customer Email!.
                                </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="validationCustom03" class="form-label">Address</label>
                                <input type="text" class="form-control" id="validationCustom03" value="<?php echo $address; ?>" name="address" required>
                                <div class="invalid-feedback">
                                Enter Customer Address!.
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <button class="btn btn-primary mt-3" type="submit" name="submit">Update Customer</button>
                            </div>
                        </form>
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