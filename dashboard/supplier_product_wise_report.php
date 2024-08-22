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
                            <h5 class="m-b-10">Manage Supplier/Product Wise Stock</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Stock Report List </a></li>
                            
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
                        <h5 class="text-center">Select Criteria</h5>
                    </div>
                    <div class="card-body">
                <!-- usertable -->
                <div class="row">
                  <div class="col-sm-12 text-center">
                    <strong>Supplier Wise Report</strong>
                    <input type="radio" name="supplier_product_wise" value="supplier_wise" class="search_value"> &nbsp;&nbsp;
                    <strong>Product Wise Report</strong>
                    <input type="radio" name="supplier_product_wise" value="product_wise" class="search_value">
                  </div>
                </div>
                <div class="show_supplier" style="display: none;">
                  <form action="supplier_wise_report.php" method="GET" id="supplierForm" target="_blank">
                    <div class="form-row">
                      <div class="col-sm-8">
                        <label for="">Supplier Name</label>
                        <select name="supplier_id" id="supplier_id" class="form-control select2bs4">
                          <option value="">Select Supplier</option>
                          <?php 
                            $qury = "SELECT * FROM suppliers";
                            $ssql = mysqli_query($conn, $qury);
                            while($supplier = mysqli_fetch_assoc($ssql)){
                          ?>
                          <option value="<?php  echo $supplier['id'];?>"><?php echo $supplier['name'];?></option>
                          <?php } ?>
                        </select>
                      </div>
                      
                        <div class="col-sm-4" style="margin-top: 30px;">
                         <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                      
                    </div>
                  </form>
                </div>
                <div class="show_product" style="display: none;">
                  <form action="product_wise_report.php" method="GET" id="productForm" target="_blank">
                    <div class="form-row">
                      <div class="form-group col-md-2">
                        <label for="">Category Name</label>
                        <select name="category_id" id="category_id" class="form-control select2bs4" style="width: 100%;">
                          <option value="">Select Category</option>
                          <?php 
                            $cqury = "SELECT * FROM categories";
                            $csql = mysqli_query($conn, $cqury);
                            while($category = mysqli_fetch_assoc($csql)){
                          ?>
                          <option value="<?php  echo $category['id'];?>"><?php echo $category['name'];?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-2">
                        <label>Product Name</label>
                        <select name="product_id" id="product_id" class="form-control select2bs4" style="width: 100%;">
                          <option value="">Select Product</option>
                        </select>
                      </div>
                      <div class="col-sm-4" style="margin-top: 30px;">
                        <button type="submit" class="btn btn-primary">Search</button>
                      </div>
                      
                    </div>
                  </form>
                </div>
                <!-- usertableend -->
              </div><!-- /.card-body -->
                </div>
            </div>
            <!-- [ Contextual-table ] end -->
           
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
<script type="text/javascript">
    $(document).on('change','.search_value',function(){
      var search_value = $(this).val();
      if (search_value == 'supplier_wise') {
        $('.show_supplier').show();
      }else{
        $('.show_supplier').hide();
      }
      if (search_value == 'product_wise') {
        $('.show_product').show();
      }else{
        $('.show_product').hide();
      }

    });
  </script>
  <!-- validation -->
  <!-- supplier wise -->
<script>
  $(function () {
    
    $('#supplierForm').validate({
      rules: {
        supplier_id: {
          required: true,
        }
      },
      messages: {
        
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>
<!-- product wise validation -->
<script>
  $(function () {
    
    $('#productForm').validate({
      rules: {
        category_id: {
          required: true,
        },
        product_id: {
          required: true,
        }
       
      },
      messages: {
        
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>
<!-- change product -->
<script>
  	$(function(){
  		$(document).on('change','#supplier_id',function(){
  			var supplier_id = $(this).val();
            
  			if(supplier_id){
                $.ajax({
                    type: 'POST',
                    url : 'reportajax.php',
                    data: 'supplier_id='+supplier_id,
                    success: function(html){
                        $('#category_id').html(html);
                        
                    }
                });
            }
  		});

        //select Product 
        $(document).on('change','#category_id',function(){
        var category_id = $(this).val();
        
        if(category_id){
            $.ajax({
                type: "POST",
                url: 'reportajax.php',
                data:{category_id:category_id} ,
                success: function(html){
                    $('#product_id').html(html);
                }
              
            });
            
        }
      });
            
  	});
</script>
<?php include('layout/footer.php')?>
<?php 
    }else{
    header('Location:../index.php');
    }
?>