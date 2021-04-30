<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

// Users class
require_once BASE_PATH . '/lib/Users/Users.php';
$users = new Users();

// User ID for which we are performing operation
$admin_user_id = filter_input(INPUT_GET, 'admin_user_id');
$operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);
($operation == 'edit') ? $edit = true : $edit = false;

// Serve POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	// Sanitize input post if we want
	$data_to_db = filter_input_array(INPUT_POST);

	// Check whether the user name already exists
	$db = getDbInstance();
	$db->where('user_name', $data_to_db['user_name']);
	$db->where('id', $admin_user_id, '!=');
	//print_r($data_to_db['user_name']);die();
	$row = $db->getOne('admin_accounts');
	//print_r($data_to_db['user_name']);
	//print_r($row); die();

	if (!empty($row['user_name']))
	{
		$_SESSION['failure'] = 'Username already exists';
		$query_string = http_build_query(array(
			'admin_user_id' => $admin_user_id,
			'operation' => $operation,
		));
		header('location: edit_admin.php?'.$query_string );
		exit;
	}

	$admin_user_id = filter_input(INPUT_GET, 'admin_user_id', FILTER_VALIDATE_INT);
	// Encrypting the password
	$data_to_db['password'] = password_hash($data_to_db['password'], PASSWORD_DEFAULT);
	// Reset db instance
	$data_to_db['updated_by']=$_SESSION['user_id'];
	$data_to_db['updated_at']=date('d-m-Y H:i:s');
	$db = getDbInstance();
	$db->where('id', $admin_user_id);
	$stat = $db->update('admin_accounts', $data_to_db);

	if ($stat)
	{
		$_SESSION['success'] = 'Admin user has been updated successfully';
	} else {
		$_SESSION['failure'] = 'Failed to update Admin user: ' . $db->getLastError();
	}

	header('location: view_admin.php');
	exit;
}

// Select where clause
$db = getDbInstance();
$db->where('id', $admin_user_id);

$admin_account = $db->getOne("admin_accounts");

// Set values to $row
?>
<?php include BASE_PATH . '/includes/header.php'; ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
	<?php include BASE_PATH.'/includes/flash_messages.php'; ?>
    <form class="form" action="" method="post" id="customer_form" enctype="multipart/form-data">
		<?php include BASE_PATH . '/forms/edit_admin_form.php'; ?>
    <!-- /.content -->
	  </form>
  </div>
<?php include BASE_PATH . '/includes/footer.php'; ?>
