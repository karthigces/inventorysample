<?php
require_once 'config/config.php';
require_once BASE_PATH.'/includes/auth_validate.php';
$db = getDbInstance();
	$id= $_GET['admin_user_id'];
	$db->where ("id", $id);
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
                <h3 class="card-title">Admin Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label>Admin ID #</label>
                    <input type="text" value="<?php echo $adminDetails['id']; ?>" readonly class="form-control" id="o_id">
                  </div>
                  <div class="form-group">
                    <label>User Name</label>
                    <input type="text" readonly value="<?php echo $adminDetails['user_name']; ?>" class="form-control" name="user_name" id="user_name">
                  </div>
                  <div class="form-group">
                    <label>Email Address</label>
                    <input type="text" value="<?php echo $adminDetails['email']; ?>" class="form-control" name="email" id="email">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" required id="password" placeholder="Customer Address">
                  </div>
				<!-- Radio checks -->
				<div class="form-group">
				<label class="col-md-12 control-label">User type</label>
				<div class="col-md-12">
				<div class="radio">
					<label>
					<input type="radio" name="admin_type" value="user" required="" <?php echo ($edit && $admin_account['admin_type'] =='user') ? "checked": "" ; ?>/> Client Police Station 
					</label>
				</div>
				</div>
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
