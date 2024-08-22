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
                            <h5 class="m-b-10">Category</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Category List </a></li>
                            
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
                    <button type="button" class="btn  btn-primary float-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"> Add Category</i></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="example">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                        $sqls = "SELECT * FROM categories";
                                        $qrys = mysqli_query($conn, $sqls);
                                        $sln = 1;
                                        while($rs = mysqli_fetch_assoc($qrys)){
                                            $id = $rs['id'];
                                    ?>
                                    <tr class="table-active">
                                        <td><?php echo $sln; ?></td>
                                        <td><?php echo $rs['name']; ?></td>
                                        
                                        <td>
                                            <a href="edit_categories.php?id=<?php echo $id; ?>"  class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> </a>
                                            <a href="delete_categories.php?id=<?php echo $id; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this data?');"> <i class="fa fa-trash"></i> </a>
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
					
					<div class="btn-page">
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">New Category</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
                                    <form class="row g-3 needs-validation" novalidate action="add_categories.php" method="POST">
                                        <div class="col-md-12">
                                            <label for="validationCustom01" class="form-label">Category name</label>
                                            <input type="text" class="form-control" id="validationCustom01" name="name" required>
                                            <div class="invalid-feedback">
                                            Enter Category Name!
                                            </div>
                                        </div>
                                       
                                       
                                        <div class="col-12">
                                            <button class="btn btn-primary mt-3" type="submit" name="submit">Add Category</button>
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
<?php include('layout/footer.php')?>
<?php 
    }else{
    header('Location:../index.php');
    }
?>