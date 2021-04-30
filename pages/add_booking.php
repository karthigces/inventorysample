<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH.'/includes/auth_validate.php';
$db = getDbInstance();
// Serve POST method, After successful insert, redirect to customers.php page.
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
	if($_POST['hiddenCounter']>1)
	{
		$db = getDbInstance();
		// Mass Insert Data. Keep "name" attribute in html form same as column name in mysql table.
		// Table1 Customer Details
		$data1['c_id'] = $_POST['c_id'];
		$data1['c_name'] = $_POST['c_name'];
		$data1['c_address'] = $_POST['c_address'];
		$data1['c_city'] = $_POST['c_city'];
		$data1['c_state'] = $_POST['c_state'];
		$data1['c_pincode'] = $_POST['c_pincode'];
		$data1['c_gender'] = $_POST['c_gender'];
		$data1['c_dob'] = $_POST['c_dob'];
		$data1['c_mobile'] = $_POST['c_mobile'];
		$data1['c_email'] = $_POST['c_email'];
		$data1['c_em_name'] = $_POST['c_em_name'];
		$data1['c_em_phone'] = $_POST['c_em_phone'];
		$data1['status'] = 1;
		$data1['created_by']=$_SESSION['user_id'];
		$data1['created_at']=date('d-m-Y H:i:s');
		// Table2 Tour Booking Details
		$data2['s_id'] = $_SESSION['user_id'];
		$data2['o_id'] =  $_POST['o_id'];
		$data2['o_date'] = date('Y-m-d');
		$data2['c_id'] = $_POST['c_id'];
		$data2['t_id'] = $_POST['t_id'];
		$data2['no_of_adult'] = $_POST['no_of_adult'];
		$data2['no_of_adult_icost'] = $_POST['no_of_adult_icost'];
		$data2['no_of_adult_dcost'] = $_POST['no_of_adult_dcost'];
		$data2['no_of_adult_ecost'] = $_POST['no_of_adult_ecost'];
		$data2['no_of_childwb'] = $_POST['no_of_childwb'];
		$data2['no_of_childwb_icost'] = $_POST['no_of_childwb_icost'];
		$data2['no_of_childwb_dcost'] = $_POST['no_of_childwb_dcost'];
		$data2['no_of_childwb_ecost'] = $_POST['no_of_childwb_ecost'];
		$data2['no_of_childwob'] = $_POST['no_of_childwob'];
		$data2['no_of_childwob_icost'] = $_POST['no_of_childwob_icost'];
		$data2['no_of_childwob_dcost'] = $_POST['no_of_childwob_dcost'];
		$data2['no_of_childwob_ecost'] = $_POST['no_of_childwob_ecost'];
		$data2['no_of_single'] = $_POST['no_of_single'];
		$data2['no_of_single_icost'] = $_POST['no_of_single_icost'];
		$data2['no_of_single_dcost'] = $_POST['no_of_single_dcost'];
		$data2['no_of_single_ecost'] = $_POST['no_of_single_ecost'];
		$data2['no_of_passengers'] = $_POST['no_of_passengers'];
		$data2['total_inr'] = $_POST['total_inr'];
		$data2['total_d'] = $_POST['total_d'];
		$data2['total_e'] = $_POST['total_e'];
		$data2['sub_total_cost'] = $_POST['sub_total_cost'];
		$data2['discount'] = $_POST['discount'];
		$data2['grand_total_cost'] = $_POST['grand_total_cost'];
		$data2['status'] = 1;
		$data2['created_by'] = $_SESSION['user_id'];
		$data2['created_at'] = date('d-m-Y H:i:s');		
		#Send Data Tables to SQL
		$sendTbl1 = $db->insert('tour_customer_details', $data1);
		$sendTbl2 = $db->insert('tour_booking_details', $data2);
		if ($sendTbl1 && $sendTbl2===true)
		{
				// Table3 Passenger Details
		$data3['o_id'] = $_POST['o_id'];
		$data3['c_id'] = $_POST['c_id'];
		$data3['t_id'] = $_POST['t_id'];
		$hiddenCounter = $_POST['hiddenCounter'];
		$i=1;
		while($i<$hiddenCounter)
		{
		$data3['p_id'] = $_POST['c_id']."P".$i."";
		$data3['first_name'] = $_POST["first_name".$i.""];
		$data3['last_name'] = $_POST["last_name".$i.""];
		$data3['dob'] = $_POST["dob".$i.""];
		$data3['gender'] = $_POST["gender".$i.""];
		$data3['room_type'] = $_POST["room_type".$i.""];
		$data3['meal_type'] = $_POST["meal_type".$i.""];
		$data3['aadhar_no'] = $_POST["aadhar_no".$i.""];
		$data3['passport_no'] = $_POST["passport_no".$i.""];
		$data3['passport_expiry_date'] = $_POST["passport_expiry_date".$i.""];
		$data3['photo'] = $_POST["photo".$i.""];
		$data3['old_PP'] = $_POST["old_PP".$i.""];
		$data3['new_PP'] = $_POST["new_PP".$i.""];
		$data3['PAN_card'] = $_POST["PAN_card".$i.""];
		$data3['aadhar_card'] = $_POST["aadhar_card".$i.""];
		$data3['status'] = 1;
		$data3['created_by'] = $_SESSION['user_id'];
		$data3['created_at'] = date('d-m-Y H:i:s');
		$db->insert('tour_passenger_details', $data3);
		$i++;
		}
		// Table4 Tour Ticketing Details
		$data4['o_id'] = $_POST['o_id'];
		$data4['c_id'] = $_POST['c_id'];
		$hiddenCounter = $_POST['hiddenCounter'];
		$j=1;
		while($j<$hiddenCounter)
		{
		$data4['p_id'] = $_POST['c_id']."P".$j."";
		$data4['ticketing_status'] = 0;
		$data4['status'] = 1;
		$data4['created_by'] = $_SESSION['user_id'];
		$data4['created_at'] = date('d-m-Y H:i:s');
		$db->insert('tour_ticketing_details', $data4);
		$j++;
		}
		// Table5 Tour Rooming Details
		$data5['o_id'] = $_POST['o_id'];
		$data5['c_id'] = $_POST['c_id'];
		$hiddenCounter = $_POST['hiddenCounter'];
		$k=1;
		while($k<$hiddenCounter)
		{
		$data5['p_id'] = $_POST['c_id']."P".$k."";
		$data5['rooming_status'] = 0;
		$data5['status'] = 1;
		$data5['created_by'] = $_SESSION['user_id'];
		$data5['created_at'] = date('d-m-Y H:i:s');
		$db->insert('tour_rooming_details', $data5);
		$k++;
		}
		// Table6 Tour Visa Details
		$data6['o_id'] = $_POST['o_id'];
		$data6['c_id'] = $_POST['c_id'];
		$hiddenCounter = $_POST['hiddenCounter'];
		$l=1;
		while($l<$hiddenCounter)
		{
		$data6['p_id'] = $_POST['c_id']."P".$l."";
		$data6['visa_status'] = 0;
		$data6['status'] = 1;
		$data6['created_by'] = $_SESSION['user_id'];
		$data6['created_at'] = date('d-m-Y H:i:s');
		$db->insert('tour_visa_details', $data6);
		$l++;
		}
		$hiddenCounter=$hiddenCounter-1;
			$_SESSION['success'] = 'New Tour Booking added successfully (x'.$hiddenCounter.') PAX';
			// Redirect to the listing page
			header('Location: add_booking.php');
			// Important! Don't execute the rest put the exit/die.
			exit();
		}
		else
		{
			$_SESSION['failure'] = 'Insert Failed' . $db->getLastError().'</center>';
			// Redirect to the listing page
			header('Location: add_booking.php');
			// Important! Don't execute the rest put the exit/die.
			exit();
		}
	}
		else
		{
			$_SESSION['failure'] = 'Insert Failed - You must enter atleast one passenger!</center>';
			// Redirect to the listing page
			header('Location: add_booking.php');
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
	<?php include BASE_PATH.'/forms/add_booking_form.php'; ?>
    <!-- /.content -->
	  </form>
  </div>
<?php include BASE_PATH.'/includes/footer.php'; ?>
