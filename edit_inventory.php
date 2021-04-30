<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH.'/includes/auth_validate.php';
$db = getDbInstance();
// Serve POST method, After successful insert, redirect to customers.php page.
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{		$db = getDbInstance();
		// Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
		// Table1 Customer Details
		
		$data1['user_id'] = $_SESSION['user_id'];
		$data1['product_id'] = $_POST['product_id'];
		$data1['product_name'] = $_POST['product_name'];
		$data1['product_description'] = $_POST['product_description'];
		$data1['product_quantity'] = $_POST['product_quantity'];
		$data1['product_purchase_date'] = $_POST['product_purchase_date'];
		$data1['product_expiry_date'] = $_POST['product_expiry_date'];
		$data1['supplier_name'] = $_POST['supplier_name'];
		$data1['supplier_address'] = $_POST['supplier_address'];
		$data1['product_damage_status'] = 0;
		$data1['created_by'] = $_SESSION['user_id'];
		$data1['created_at'] = date('d-m-Y H:i:s');
		$data1['updated_by'] = $_SESSION['user_id'];
		$data1['updated_at'] = date('d-m-Y H:i:s');
		$data1['status'] = 1;
		$db->where ('id', $_POST['id']);
		$sendTbl1 = $db->update('business_inventory_details', $data1);
		
		if ($sendTbl1)
		{
			$_SESSION['success'] = 'Inventory Updated Successfully';
			// Redirect to the listing page
			header('Location: view_inventory.php');
			// Important! Don't execute the rest put the exit/die.
			exit();
		}
		else
		{
			$_SESSION['failure'] = 'Update Failed' . $db->getLastError().'</center>';
			// Redirect to the listing page
			header('Location: add_complaint.php');
			// Important! Don't execute the rest put the exit/die.
			exit();
		}
}
?>
<head>
</head>
<body>

<?php include BASE_PATH.'/includes/header.php'; ?>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <!-- Content Wrapper. Contains page content --> 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<?php include BASE_PATH.'/includes/flash_messages.php'; ?>
    <form class="form" action="" method="post" id="customer_form" enctype="multipart/form-data">
	<?php include BASE_PATH.'/forms/edit_inventory_form.php'; ?>
    <!-- /.content -->
	  </form>
  </div>
<?php include BASE_PATH.'/includes/footer.php'; ?>
