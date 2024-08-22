<?php 
session_start();
     
if(isset($_SESSION['name'])){

include('layout/header.php'); ?>
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
                            <h5 class="m-b-10">Purchase</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Purchase Store </a></li>
                            
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
                    <a href="view_purchase.php" class="btn  btn-primary float-right"><i class="fa fa-eye"> View Purchase</i></a>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation" action="add_purchase.php" method="POST" enctype="multipart/form-data">
                            
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Date</label>
                                <input type="date" id="date" value="<?php echo date('Y-m-d');?>" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Purchase/Challan Number</label>
                               <input type="text" id="purchase_no" class="form-control">
                                
                            </div> 
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Supplier Name</label>
                                <select name="supplier_id" id="supplier_id" class="form-control"  required>
                                <option value="">Select Supplier</option>
                                    <?php 
                                        $suppliersql = "SELECT * FROM suppliers WHERE status =1 ORDER BY name ASC";
                                        $supqry = mysqli_query($conn, $suppliersql);
                                        while($supresults = mysqli_fetch_assoc($supqry)){
                                    ?>
                                    <option value="<?php echo $supresults['id'];  ?>"><?php echo $supresults['name'];  ?></option>
                                    <?php }?>
                                </select>
                                
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Category Name</label>
                                <select name="category_id" class="form-control select2bs4" id="category_id" required>
                                <option value="">Select Category</option>
                                </select>
                            </div>
                            
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Product Name</label>
                                <select name="product_id" class="form-control select2bs4" id="product_id" required>
                                <option value="">Select Product</option>
                                   
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Brand name</label>
                                
                                <select name="brand_id" class="form-control select2bs4" id="brand_id" required>
                                <option value="">Select Brand</option>
                                    
                                </select>
                            </div>
                            <div class="form-group col-12 pt-2">
                                <a class="btn btn-primary btn-sm addeventmore" ><i class="fa fa-plus-circle"></i> Add Item</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- [ Contextual-table ] end -->
        </div>
        <div class="row">
            <!-- [ Contextual-table ] start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h5 class="text text-success">Store Purchase</h5>
                    </div>
                    <div class="card-body">
                        <form action="store_purchase.php" id="myForm" method="POST">
                            <table class="table-sm table-dark table-bordered" width='100%'>
                                <thead>
                                    <th width='15%'>Category</th>
                                    <th width='15%'>Product Name</th>
                                    <th width='15%'>Brand</th>
                                    <th width='10%'>Pcs/Kg</th>
                                    <th width='10%'>Unit Price</th>
                                    <th width='20%'>Description</th>
                                    <th width='10%'>Total Price</th>
                                    <th>Action</th>
                                </thead>
                                <tbody id="addRow" class="addRow">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6"></td>
                                        <td>
                                            <input type="text" name="estimated_amount" value='0' id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background: #D8FDEA;">
                                        </td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="form-group mt-2">
                                <button type="submit" name="submit" class='btn btn-success' id="storeButton">Purchase Store</button>
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

<!-- handlebars -->
<script id="document-template" type="text/x-handlebars-template">  
  <tr class="delete_add_more_item" id="delete_add_more_item">
    <input type="hidden" name="date[]" value="{{date}}">
    <input type="hidden" name ="purchase_no[]" value="{{purchase_no}}">
    <input type="hidden" name ="supplier_id[]" value="{{supplier_id}}">
    <td>
      <input type="hidden" name="category_id[]" value="{{category_id}}">{{category_name}}
    </td>
    <td>
      <input type="hidden" name="product_id[]" value="{{product_id}}">{{product_name}}
    </td> 
    <td>
      <input type="hidden" name="brand_id[]" value="{{brand_id}}">{{brand_name}}
    </td>
    <td>
      <input type="number" min="1" name="buying_qty[]" value="1" class="form-control form-control-sm text-right buying_qty">
    </td>
    <td>
      <input type="number" min="1" name="unit_price[]" class="form-control form-control-sm text-right unit_price" value="">
    </td>
    <td>
      <input type="text" name="description[]" class="form-control form-control-sm">
    </td>
    <td>
      <input name="buying_price[]" value="0" class="form-control form-control-sm text-right buying_price" readonly>
      <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i></td>
    </td>
  </tr>
</script>
<!-- sum invoice -->
<script>
  $(document).ready(function(){
    $(document).on('click','.addeventmore', function(){
      var date          = $('#date').val();
      var purchase_no   = $('#purchase_no').val();
      var brand_id      = $('#brand_id').val();
      var brand_name    = $('#brand_id').find('option:selected').text(); 
      var supplier_id   = $('#supplier_id').val();
      var category_id   = $('#category_id').val();
      var category_name = $('#category_id').find('option:selected').text(); 
      var product_id    = $('#product_id').val();
      var product_name  = $('#product_id').find('option:selected').text();

      if (date =='') {
       alert("Date is required");
        $('.toast-left').toast('show');
       
      }
      if (purchase_no =='') {
        alert("Purchase no is required");
        $.notify("Purchase no is required",{position:'top right',className:'error'});
        return false;
      }
      if (supplier_id =='') {
        alert("Supplier is required");
        $.notify("Supplier Id is required",{globalPosition:'top right',className:'error'});
        return false;
      }
      if (category_id =='') {
        alert("Category is required");
        $.notify("Category Id is required",{globalPosition:'top right',className:'error'});
        return false;
      }
      if (product_id =='') {
        alert("Product is required");
        $.notify("Product Id is required",{globalPosition:'top right',className:'error'});
        return false;
      } 
      if (brand_id =='') {
        alert("Brand is required");
        $.notify("Brand id is required",{globalPosition:'top right',className:'error'});
        return false;
      }
      
     
      
      
      var source = document.getElementById("document-template").innerHTML;
      var template = Handlebars.compile(source);
      var data = {
        date:date,
        purchase_no:purchase_no,
        supplier_id:supplier_id,
        brand_id:brand_id,
        brand_name:brand_name,
        category_id:category_id,
        category_name:category_name,
        product_id:product_id,
        product_name:product_name

      };
      var html = template(data);
      $("#addRow").append(html);
    });

    $(document).on('click',".removeeventmore", function(event){
      $(this).closest(".delete_add_more_item").remove();
      totalAmountPrice();
    });

    $(document).on('keyup click','.unit_price,.buying_qty',function(){
      var unit_price = $(this).closest('tr').find('input.unit_price').val();
      var qty = $(this).closest("tr").find('input.buying_qty').val();
      var total = unit_price * qty;
      $(this).closest('tr').find('input.buying_price').val(total);
      totalAmountPrice();
    });
    //calculate sum of amount in invoice
    function totalAmountPrice(){
      var sum = 0;
      $(".buying_price").each(function(){
        var value = $(this).val();
       
        if(!isNaN(value) && value.lenght !=0) {
           sum +=parseFloat(value);
        }
      });
      $("#estimated_amount").val(sum.toFixed(2));
    }
  });
</script>
<!-- select category -->
<script>
  	$(function(){
  		$(document).on('change','#supplier_id',function(){
  			var supplier_id = $(this).val();
            
  			if(supplier_id){
                $.ajax({
                    type: 'POST',
                    url : 'ajaxData.php',
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
                url: 'ajaxData.php',
                data:{category_id:category_id},
                success: function(html){
                  
                    $('#product_id').html(html);
                }
              
            });
            
        }
      });

      //select brand
       
        $(document).on('change','#product_id',function(){
                var product_id = $(this).val();
                
                if(product_id){
                    $.ajax({
                        type: "POST",
                        url: 'ajaxData.php',
                        data:{product_id:product_id} ,
                        success: function(html){
                            $('#brand_id').html(html);
                        }
                    
                    });
                    
                }
            });

  	});
</script>
<?php 
include('layout/footer.php');
  }else{
    header('Locathon:../index.php');
  }
?>