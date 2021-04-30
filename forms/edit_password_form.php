<?php
require_once 'config/config.php';
require_once BASE_PATH.'/includes/auth_validate.php';
$db = getDbInstance();
	$user_id= $_SESSION['user_id'];
	$db->where ("user_id", $user_id);
	$adminDetails = $db->getOne("admin_accounts");
?>
    <section class="content-header">
      <div class="container-fluid">
	  <div class="row">
          <!-- left column -->
          <!-- customer details form elements -->
          <div class="col-md-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Change Password</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label>ID #</label>
                    <input type="text" value="<?php echo $adminDetails['id']; ?>" readonly class="form-control" id="o_id">
                  </div>
                  <div class="form-group">
                    <label>User Name</label>
                    <input type="text" readonly value="<?php echo $adminDetails['user_name']; ?>" class="form-control" name="user_name" id="user_name">
                  </div>
                  <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" class="form-control" name="cpassword" required id="password">
                  </div>
                  <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control" name="npassword" required id="password">
                  </div>
                </div>
            </div>
            <!-- /.card -->
          </div>	  
	  </div>
		<div class="">
		  <button type="submit" class="btn btn-success btn-block">Save</button>
		</div>
		</div>
    </section>
