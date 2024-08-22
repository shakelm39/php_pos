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
                            <h5 class="m-b-10">Invoice</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Invoice Store </a></li>
                            
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
                        <h3>Add Invoice
                            <?php if(isset($_GET['msg'])){echo $_GET['msg'];}?>
                            <a href="view_invoices.php" class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i> Invoice List</a>
                        </h3>
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                            <label for="">Invoice No</label>
                            <input type="text" value="<?php echo date('Y').(rand(6,100));?>" name="invoice_no" id="invoice_no" class="form-control" readonly style="background: #D8FDEA;">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Date</label>
                            <input type="date" id="date" value="<?php echo date('Y-m-d');?>" name='date' class="input-group form-control">
                            
                        </div> 
                        <div class="form-group col-md-2">
                            <label for="">Category Name</label>
                            <select name="category_id" id="category_id" class="form-control select2bs4" style="width: 100%;">
                            <option value="">Select Category</option>
                            <?php 
                                $sql = "SELECT * FROM categories WHERE status ='1'";
                                $query = $conn->query($sql);
                                while ($row = $query->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Product Name</label>
                            <select name="product_id" id="product_id" class="form-control select2bs4" style="width: 100%;">
                            <option value="">Select Product</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Brand</label>
                            <select name="brand_id" id="brand_id" class="form-control select2bs4" style="width: 100%;">
                            <option value="">Select Brand</option>
                            
                            </select>
                        </div>
                        
                        <div class="form-group col-md-1">
                            <label>Stock(Pcs/Kg)</label>
                            <input type="text" name="current_stock_qty" id="current_stock_qty" class="form-control" readonly style="background: #D8FDEA;">
                        </div>
                        <div class="form-group col-md-1" style="padding-top: 35px;">
                            <a class="btn btn-primary btn-sm addeventmore form-contorl" ><i class="fa fa-plus-circle"></i> Add</a>
                        </div>
                        </div>
                </div>
                    <!-- /.card-body -->
                    <div class="card-body">
                        <form method="post" action="store_invoice.php" id="myForm">
                        
                            <table class="table-sm table-bordered table-dark" width="100%">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Product Name</th>
                                        <th>Brand Name</th>
                                        <th widht="7%">Pcs/Kg</th>
                                        <th widht="10%">Unit Price <input class="bg-dark" id="rate" readonly></th>
                                        <th widht="10%">Total Price</th>
                                        <th widht="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="addRow" class="addRow">
                                    
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="5" class="text-right">Discount</td>
                                        <td><input type="text" name="discount_amount" id="discount_amount" class="form-control discount_amount text-right"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-right">Grand Total</td>
                                        <td>
                                            <input type="text" name="estimated_amount" value='0' id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background: #D8FDEA;">
                                        </td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <textarea class="form-control col-md-12" name="description" id="description" placeholder="Write description here"></textarea>
                                </div>	
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Paid Status</label>
                                        <select name="paid_status" id="paid_status" class="form-control">
                                            <option value="">Select Status</option>
                                            <option value="full_paid">Full Paid</option>
                                            <option value="full_due">Full Due</option>
                                            <option value="partial_paid">Partial Paid</option>
                                        </select>
                                        <input type="text" name="paid_amount" class="form-control paid_amount" placeholder="Enter Paid Amount" style="display: none;">
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Customer Name</label>
                                    <select name="customer_id" id="customer_id" class="form-control select2bs4" style="width: 100%;" required>
                                        <option value="">Select Customer</option>
                                        <?php 
                                            $sql = "SELECT * FROM customers WHERE status = '1'";
                                            $query = $conn->query($sql);
                                            while($row = $query->fetch_assoc()){
                                        ?>
                                        <option value="<?php echo $row['id'] ?>">
                                        <?php echo $row['name'];?> ( <?php echo $row['mobile_no'].' address :' .$row['address'];?> ) </option>
                                        <?php }?>
                                        <option value="0">New Customer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row new_customer" style="display: none;">
                                <div class="form-group col-md-4">
                                    <input type="text" name="name" id="cname" class="form-control" placeholder="Enter Customer Name" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="number" name="mobile_no" id="mobile_no" class="form-control" placeholder="Enter Customer Mobile">
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" name="address" id="address" class="form-control" placeholder="Enter Customer Address">
                                </div>
                            </div>
                        
                        <div class="form-group">
                            <button type="submit" name="submit" class='btn btn-success' id="storeButton">Invoice Store</button>
                        </div>
                        </form>
                    </div><!-- /.card-body -->
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
    <input type="hidden" name="date" value="{{date}}">
    <input type="hidden" name = "invoice_no" value="{{invoice_no}}">
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
      <input type="number" min="1" name="selling_qty[]" value="1" class="form-control form-control-sm text-right selling_qty">
    </td>
    <td>
      <input type="number" min="1" name="unit_price[]" class="form-control form-control-sm text-right unit_price" value="" required>
    </td>
    
    <td>
      <input name="selling_price[]" value="0" class="form-control form-control-sm text-right selling_price" readonly>
      <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i></td>
    </td>
  </tr>
</script>
<!-- sum invoice -->
<script>
  $(document).ready(function(){
    $(document).on('click','.addeventmore', function(){
      var stock = $('#current_stock_qty').val();
      var date = $('#date').val();
      var invoice_no = $('#invoice_no').val();
      var brand_id = $('#brand_id').val();
      var brand_name = $('#brand_id').find('option:selected').text(); 
      var supplier_id = $('#supplier_id').val();
      var category_id = $('#category_id').val();
      var category_name = $('#category_id').find('option:selected').text(); 
      var product_id = $('#product_id').val();
      var product_name = $('#product_id').find('option:selected').text();

      if(stock=='0'){
        alert(product_name + " Stock is Zero");
        return false;
      }
      if (date =='') {
        alert('Date is required');
        $.notify("Date is required",{globalPosition:'top right',className:'error'});
        return false;
      }
      
      if (category_id =='') {
        alert('Category is required');
        $.notify("Category Id is required",{globalPosition:'top right',className:'error'});
        return false;
      }
      if (product_id =='') {
        alert('Product is required');
        $.notify("Product Id is required",{globalPosition:'top right',className:'error'});
        return false;
      } 
      if (brand_id =='') {
        alert('Brand is required');
        $.notify("Brand id is required",{globalPosition:'top right',className:'error'});
        return false;
      }
  
      var source = document.getElementById("document-template").innerHTML;
      var template = Handlebars.compile(source);
      var data = {
        date:date,
        invoice_no:invoice_no,
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

    $(document).on('keyup click','.unit_price,.selling_qty',function(){
      var unit_price = $(this).closest('tr').find('input.unit_price').val();
      var qty = $(this).closest("tr").find('input.selling_qty').val();
      var total = unit_price * qty;
      $(this).closest('tr').find('input.selling_price').val(total);
      $('#discount_amount').trigger('keyup');
    });
    $(document).on('keyup','#discount_amount',function(){
		totalAmountPrice();
    });
    //calculate sum of amount in invoice
    function totalAmountPrice(){
      var sum = 0;
      $(".selling_price").each(function(){
        var value = $(this).val();
       
        if(!isNaN(value) && value.lenght !=0) {
           sum +=parseFloat(value);
        }
      });
      var discount_amount = parseFloat($('#discount_amount').val());
      if (!isNaN(discount_amount) && discount_amount.length !=0) {
      	sum -=parseFloat(discount_amount);
      }
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
                data:{category_id:category_id} ,
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

        //select stock 
        $(document).on('change','#product_id',function(){
                var product_id = $(this).val();
                
                if(product_id){
                    $.ajax({
                        type: "POST",
                        url: 'stockData.php',
                        data:{product_id:product_id} ,
                        success: function(html){
                            $('#current_stock_qty').val(html);
                            $('#rate').val(html);
                        }
                    
                    });
                    
                }
            });
            
            //select Rate 
        $(document).on('change','#product_id',function(){
                var product_id = $(this).val();
                
                if(product_id){
                    $.ajax({
                        type: "POST",
                        url: 'rate.php',
                        data:{product_id:product_id} ,
                        success: function(html){
                            $('#rate').val(html);
                        }
                    
                    });
                    
                }
            });
            
  	});
</script>
<!-- form validation -->
<script>
  $(function () {
    $.validator.setDefaults({
      submitHandler: function () {
        alert( "Form successful submitted!" );
      }
    });
    $('#myForm').validate({
      rules: {
        estimated_amount: {
          required: true,
          estimated_amount: true
        },
        supplier_id: {
          required: true,
          supplier_id: true
        },
        brand_id: {
          required: true,
          brand_id: true
        }, 
        category_id: {
          required: true,
          category_id: true
        },
        unit_id: {
          required: true,
          unit_id: true
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
<!-- new customer and paid status  -->
<script>
	//Paid status
	$(document).on('change',"#paid_status",function(){
		
		var paid_status = $(this).val();
		if (paid_status=='partial_paid') {
			$('.paid_amount').show();
		}else{
			$('.paid_amount').hide();
		}
		
	});
	//new customer
	$(document).on('change',"#customer_id",function(){
		
		
		var customer_id = $(this).val();
		if (customer_id=='0') {
			$('.new_customer').show();
		}else{
			$('.new_customer').hide();
		}
		
	});
</script>
<?php 
include('layout/footer.php');
}else{
  header('Location:../index.php');
}
?>

