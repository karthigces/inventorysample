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
		$data1['status'] = 1;
		$sendTbl1 = $db->insert('business_inventory_details', $data1);
		
		if ($sendTbl1)
		{
			
			/*
			#sms
			$curl = curl_init();
			$c_name = $data1['c_name'];
			$c_mobile = $data1['c_mobile'];
			$check_in_date = $data1['check_in_date'];
			$msg="Dear $c_name, Thank you for booking with us. Your Request for is received and processing soon. We will sent the confirmation once booking was confirmed.";
			curl_setopt_array($curl, array(
			CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?country=91&sender=DDTECH&route=4&mobiles=$c_mobile&authkey=226176AWZWP6bgHBc5c6eb17b&message=$msg&unicode=1",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
			echo "<center>".$err."</center>";
			}
			*/
			$_SESSION['success'] = 'New Inventory Detail Added Successfully';
			// Redirect to the listing page
			header('Location: view_inventory.php');
			// Important! Don't execute the rest put the exit/die.
			exit();
		}
		else
		{
			$_SESSION['failure'] = 'Insert Failed' . $db->getLastError().'</center>';
			// Redirect to the listing page
			header('Location: add_complaint.php');
			// Important! Don't execute the rest put the exit/die.
			exit();
		}
}
?>
<head>
</head>
<body >

<?php include BASE_PATH.'/includes/header.php'; ?>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <!-- Content Wrapper. Contains page content --> 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<?php include BASE_PATH.'/includes/flash_messages.php'; ?>
    <form class="form" action="" method="post" id="customer_form" enctype="multipart/form-data">
	<?php include BASE_PATH.'/forms/add_inventory_form.php'; ?>
    <!-- /.content -->
	  </form>
  </div>
<?php include BASE_PATH.'/includes/footer.php'; ?>
