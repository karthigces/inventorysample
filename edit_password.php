<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

// Serve POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$user_id= $_SESSION['user_id'];
	$cpassword = $_POST['cpassword'];
	$data_to_db['password'] = $_POST['npassword'];
	// Check whether the user name already exists
	$db = getDbInstance();
	$db->where('user_id', $user_id);
	$row = $db->getOne('admin_accounts');
	$db_password=$row['password'];
	// Encrypting the password
	if(password_verify($cpassword, $db_password))
	{
		$data_to_db['password'] = password_hash($data_to_db['password'], PASSWORD_DEFAULT);
		$data_to_db['updated_by']=$_SESSION['user_id'];
		$data_to_db['updated_at']=date('d-m-Y H:i:s');
		// Reset db instance
		$db = getDbInstance();
		$db->where('user_id', $user_id);
		$stat = $db->update('admin_accounts', $data_to_db);

		if ($stat)
		{
			$_SESSION['success'] = 'Password updated successfully';
		} else {
			$_SESSION['failure'] = 'Failed to update Password ' . $db->getLastError();
		}
		header('location: edit_password.php');
		exit;
	}
	else
	{
		$_SESSION['failure'] = 'Password Mismatch ';
	}
}

// Select where clause
$db = getDbInstance();

$admin_account = $db->getOne("admin_accounts");

// Set values to $row
?>
<?php include BASE_PATH.'/includes/header.php'; ?>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <!-- Content Wrapper. Contains page content --> 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<?php include BASE_PATH.'/includes/flash_messages.php'; ?>
    <form class="form" action="" method="post" id="customer_form" enctype="multipart/form-data">
	<?php include BASE_PATH.'/forms/edit_password_form.php'; ?>
    <!-- /.content -->
	  </form>
  </div>
<?php include BASE_PATH.'/includes/footer.php'; ?>

