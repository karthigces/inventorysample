<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

$edit = false;

// Serve POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	// Sanitize input post if we want
	$data_to_db = filter_input_array(INPUT_POST);

	// Check whether the user name already exists
	$db = getDbInstance();
	$db->where('user_name', $data_to_db['user_name']);
	$db->get('admin_accounts');

	if ($db->count >= 1)
	{
		$_SESSION['failure'] = 'Username already exists';
		header('location: add_admin.php');
		exit;
	}

	// Encrypting the password
	$data_to_db['password'] = password_hash($data_to_db['password'], PASSWORD_DEFAULT);
	// Reset db instance
	$data_to_db['status']=1;
	$data_to_db['created_by']=$_SESSION['user_id'];
	$data_to_db['created_at']=date('d-m-Y H:i:s');
	$db = getDbInstance();
	$last_id = $db->insert('admin_accounts', $data_to_db);

	if ($last_id)
	{
		$_SESSION['success'] = 'Admin user added successfully';
		header('location: view_admin.php');
		exit;
	}
}
?>
<?php include BASE_PATH.'/includes/header.php'; ?>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!-- Content Wrapper. Contains page content --> 
  <div class="content-wrapper">
    <?php if($_SESSION['admin_type'] === 'super') { ?>
    <!-- Content Header (Page header) -->
	<?php include BASE_PATH.'/includes/flash_messages.php'; ?>
    <form class="form" action="" method="post" id="customer_form" enctype="multipart/form-data">
	<?php include BASE_PATH.'/forms/add_admin_form.php'; ?>
    <!-- /.content -->
	</form>
    <?php } ?>
  </div>
<script type="text/javascript">
$(document).ready(function(){
   $('#customer_form').validate({
       rules: {
            f_name: {
                required: true,
                minlength: 3
            },
            l_name: {
                required: true,
                minlength: 3
            },   
        }
    });
});
</script>
<?php include BASE_PATH.'/includes/footer.php'; ?>
