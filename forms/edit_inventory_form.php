<?php
$id = filter_input(INPUT_GET, 'id');
?>
<?php
$db->where ("id", $id);
$row = $db->getOne ("business_inventory_details");
print_r($row)
?>
<script>
function validate(evt) {
var theEvent = evt || window.event;

// Handle paste
if (theEvent.type === 'paste') {
  key = event.clipboardData.getData('text/plain');
} else {
// Handle key press
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode(key);
}
var regex = /[0-9]|\./;
if( !regex.test(key) ) {
theEvent.returnValue = false;
if(theEvent.preventDefault) theEvent.preventDefault();
}
}
</script>
<section class="content-header">
  <div class="container-fluid">
	<div class="row mb-2">
	  <div class="col-sm-6">
		<h1 class="m-0 text-dark">Edit Inventory</h1>
	  </div><!-- /.col -->
	  <div class="col-sm-6">
		<ol class="breadcrumb float-sm-right">
		  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
		  <li class="breadcrumb-item active">Add Complaint</li>
		</ol>
	  </div><!-- /.col -->
	</div><!-- /.row -->
	<div class="row">
	  <!-- left column -->
	  <!-- customer details form elements -->
	  <div class="col-md-6">
		<div class="card card-primary">
		  <div class="card-header">
			<h3 class="card-title">Inventory Details</h3>
		  </div>
		  <!-- /.card-header -->
		  <!-- form start -->
			<div class="card-body">
			  <div class="form-group">
				<label>Id # *</label>
				<input type="text" readonly value="<?php echo $row['id']; ?>" class="form-control" name="id" id="id" placeholder="Product Id">
			  </div>
			  <div class="form-group">
				<label>Product Id # *</label>
				<input type="text" readonly value="<?php echo $row['product_id']; ?>" class="form-control" name="product_id" id="product_id" placeholder="Product Id">
			  </div>
			  <div class="form-group">
				<label>Product Name *</label>
				<input type="text" value="<?php echo $row['product_name']; ?>" class="form-control" name="product_name" id="product_name" placeholder="Product Name">
			  </div>
			  <div class="form-group">
				<label>Product Description</label>
				<textarea class="form-control" name="product_description" id="product_description" placeholder="Product Description"><?php echo $row['product_description']; ?></textarea>
			  </div>
			  <div class="form-group">
				<label>Product Quantity *</label>
				<input type="number" value="<?php echo $row['product_quantity']; ?>" required class="form-control" name="product_quantity" id="product_quantity" placeholder="Product Quantity">
			  </div>
			  <div class="form-group">
				<label>Product Purchase Date *</label>
				<input type="date" value="<?php echo $row['product_purchase_date']; ?>" required class="form-control" name="product_purchase_date" id="product_purchase_date" placeholder="Product Purchase Date">
			  </div>
			  <div class="form-group">
				<label>Product Expiry Date *</label>
				<input type="date" value="<?php echo $row['product_expiry_date']; ?>" required class="form-control" name="product_expiry_date" id="product_expiry_date" placeholder="Product Expiry Date">
			  </div>
			</div>
		</div>
		<!-- /.card -->
	  </div>	  
	  <!-- /.form1 End -->
	  <!-- customer details form elements -->
	  <div class="col-md-6">
		<div class="card card-danger">
		  <div class="card-header">
			<h3 class="card-title">Supplier Details</h3>
		  </div>
		  <!-- /.card-header -->
		  <!-- form start -->
			<div class="card-body">
			  <div class="form-group">
				<label>Supplier Name*</label>
				<input type="text" value="<?php echo $row['supplier_name']; ?>" class="form-control" name="supplier_name" id="supplier_name" placeholder="Supplier Name"/>
			  </div>
			  <div class="form-group">
				<label>Supplier Address  *</label>
				<textarea required class="form-control" name="supplier_address" id="supplier_address" placeholder="Supplier Address "><?php echo $row['supplier_address']; ?></textarea>
			  </div>
			</div>
		</div>
		<!-- /.card -->
	  </div>
	  <!-- /.form1 End -->
		<!-- /.card -->
	  </div>	  
	<div class="">
	  <button type="submit" class="btn btn-success btn-block">Update</button>
	</div>
  </div>
</section>
