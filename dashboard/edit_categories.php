<?php 
session_start();
     
if(isset($_SESSION['name'])){

include('layout/header.php'); ?>
<?php include('config/config.php'); ?>
<?php 

    if(isset($_GET['id'])){
       $id =  $_GET['id'];
       $sql = "SELECT * FROM categories WHERE id = $id";

       $qry = mysqli_query($conn, $sql);
       $result = mysqli_fetch_assoc($qry);
       $name    = $result['name'];
       
    }

    if(isset($_POST['submit'])){

        $id = $_POST['id'];
        $name    = $_POST['name'];
        

        $sqls = "UPDATE categories SET name='$name' WHERE id='$id'";

        $query = mysqli_query($conn, $sqls);

        if($query){
            $msg= '<div class="alert alert-success alert-dismissible"><span class="close" data-dismiss="alert" aria-label="close">x</span>Category Successfully Updated!</div>';
            header('Location: view_categories.php?msg='.$msg);
        }else{
            $msg= '<div class="alert alert-danger alert-dismissible"><span class="close" data-dismiss="alert" aria-label="close">x</span>Category Update Failed!</div>';
            header('Location: view_categories.php?msg='.$msg);
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
                            <h5 class="m-b-10">Category</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Update Category </a></li>
                            
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
                    <a href="view_units.php" class="btn  btn-primary float-right"><i class="fa fa-eye"> View Categories</i></a>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation" novalidate action="edit_categories.php" method="POST">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" id="validationCustom01" value="<?php echo $id; ?>" name="id" required>
                                
                            </div>
                             <div class="col-md-12">
                                <label for="validationCustom01" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="validationCustom01" value="<?php echo $name; ?>" name="name" required>
                                
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary mt-3" type="submit" name="submit">Update Category</button>
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
<?php include('layout/footer.php');
}else{
    header('Location:../index.php');
}?>