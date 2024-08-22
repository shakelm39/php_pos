<?php 
    session_start();
     
    if(isset($_SESSION['name'])){

?>
<?php include('layout/header.php'); ?>
<?php include('config/config.php'); ?>
<?php 
  if(isset($_GET['id'])){
    $id = $_GET['id'];
  }
  if(isset($_POST['submit'])){
    $date = $_POST['date'];
    $current_paid_amount = $_POST['paid_amount'];
    $paid_status = $_POST['paid_status'];




    $sql1 = "SELECT * FROM payments WHERE invoice_id = $id ";
    $query1 = $conn->query($sql1);
    $results = $query1->fetch_assoc();
    $due = $results['due_amount'];
    $paid_amount = (floatval($results['paid_amount'])) + (floatval($results['due_amount']));
    $partial_paid = (floatval($results['paid_amount'])) + (floatval($_POST['paid_amount']));
    $partial_due = (floatval($results['due_amount'])) - (floatval($_POST['paid_amount']));


      if($_POST['paid_amount'] > $due){
        $msg = '<div class="alert alert-danger">sorry! You input maximum value of total amount</div>';
        header('Location:view_invoices.php?msg='.$msg);
    }else{
      if ($paid_status =='full_paid') {
        $due_amount  ='0';
        

        $sql2 = "UPDATE payments SET paid_status = '$paid_status',paid_amount='$paid_amount',due_amount='$due_amount' WHERE invoice_id=$id;
        
        UPDATE payment_details SET current_paid_amount='$paid_amount',date='$date' WHERE invoice_id=$id";
        $conn->multi_query($sql2);//payment details table
        $msg = '<div class="alert alert-success">Success! Payment Updated!</div>';
        header('Location:view_invoices.php?msg='.$msg);

      }elseif($paid_status =='partial_paid'){

        $sql2 = "UPDATE payments SET paid_status = '$paid_status',paid_amount='$partial_paid',due_amount='$partial_due' WHERE invoice_id=$id;
        
        UPDATE payment_details SET current_paid_amount='$partial_paid',date='$date' WHERE invoice_id=$id";
        $conn->multi_query($sql2);//payment details table
        $msg = '<div class="alert alert-success">Success! Payment Updated!</div>';
        header('Location:view_invoices.php?msg='.$msg);
      }
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
                            <h5 class="m-b-10">Invoice</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Invoice Update </a></li>
                            
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
                        <h3>Invoice No (<?php 
                        if(isset($_GET['id']))
                        {
                          $id =  $_GET['id'];
                          $sql3 = "SELECT invoice_details.*, invoices.invoice_no FROM invoice_details
                          jOIN invoices
                          ON invoice_details.invoice_id = invoices.id 
                          WHERE invoice_details.invoice_id = $id";
                          $query3 = $conn->query($sql3);
                          $row = $query3->fetch_assoc();
                          echo '#'.$row['invoice_no'];
                        }
                        ?>)

                            <?php if(isset($_GET['msg'])){echo $_GET['msg'];}
                            ?>
                            <a href="view_invoices.php" class="btn btn-success float-right btn-sm"><i class="fa fa-list"></i> Invoice List</a>
                        </h3>
                    </div>
                </div><!-- /.card-header -->
                
                    <!-- /.card-body -->
                    <div class="card-body">
                        <table class="mb-2" width="100%">
                          <tr>
                            <td>Customer Info</td>
                          </tr>
                          <?php 
                            $query = "SELECT payments.*, customers.* FROM payments
                            JOIN customers
                            ON payments.customer_id = customers.id
                            WHERE payments.invoice_id = $id";
                            $sqls = $conn->query($query);
                            $result = $sqls->fetch_assoc();
                          ?>
                          <tr>
                            <td>Name: <?php echo $result['name']; ?></td>
                            <td>Mobile: <?php echo $result['mobile_no']; ?></td>
                            <td>Address: <?php echo $result['address']; ?></td>
                          </tr>
                        </table>
                            <table class="table-sm table-bordered table-dark" width="100%">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Category</th>
                                        <th>Product Name</th>
                                        <th>Selling Qty</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $inv = "SELECT invoice_details.*, categories.name as catName, products.name as productName, payments.* FROM invoice_details
                                        JOIN categories
                                        ON invoice_details.category_id = categories.id
                                        JOIN products
                                        ON invoice_details.product_id= products.id
                                        JOIN payments
                                        ON invoice_details.invoice_id= payments.invoice_id
                                        WHERE invoice_details.invoice_id=$id";
                                        $query = $conn->query($inv);
                                        $sln = 1;
                                        $subtotal=0;
                                        while($rs = $query->fetch_assoc()){
                                          $subtotal += $rs['selling_price'];
                                          $discount = $rs['discount_amount'];
                                          $grandtotal = $rs['total_amount'];
                                          $paid = $rs['paid_amount'];
                                          $due = $rs['due_amount'];
                                    ?>
                                    <tr>
                                          <td><?php echo $sln; ?></td>
                                          <td><?php echo $rs['catName']; ?></td>
                                          <td><?php echo $rs['productName']; ?></td>
                                          <td><?php echo $rs['selling_qty']; ?></td>
                                          <td><?php echo $rs['unit_price']; ?></td>
                                          <td><?php echo $rs['selling_price']; ?> ৳</td>
                                          
                                    </tr>
                                    
                                    <?php 
                                    $sln++;
                                    };
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                      <td colspan="5" class="text-right px-4">Sub Total</td>
                                      <td><?php echo $subtotal; ?> ৳</td>
                                    </tr>
                                    <tr>
                                      <td colspan="5" class="text-right px-4">Discount</td>
                                      <td><?php echo $discount; ?> ৳</td>
                                    </tr>
                                    <tr>
                                      <td colspan="5" class="text-right px-4">Grand Total</td>
                                      <td><?php echo $grandtotal; ?> ৳</td>
                                    </tr>
                                    <tr>
                                      <td colspan="5" class="text-right px-4">Paid Amount</td>
                                      <td><?php echo $paid; ?> ৳</td>
                                    </tr>
                                    <tr>
                                      <td colspan="5" class="text-right px-4">Due Amount</td>
                                      <td class="bg-danger"><?php echo $due; ?> ৳</td>
                                    </tr>
                                </tfoot>
                                
                            </table>
                            <br>
                           <form method="post">
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
                                <div class="form-group col-md-4">
                                    <label>Date</label>
                                    <input type="date" name="date" id="date" class="form-control" required>
                                </div>
                                <br>
                                <div class="form-group col-md-4 mt-4">
                                  <button type="submit" name="submit" class='btn btn-success mt-1' id="storeButton">Update Invoice</button>
                                </div>
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
	
</script>
<?php include('layout/footer.php');?>

<?php 
}else{
 header('Location:../index.php');
}
?>