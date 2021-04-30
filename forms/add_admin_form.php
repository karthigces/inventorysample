    <section class="content-header">
      <div class="container-fluid">
	  <div class="row">
          <!-- left column -->
          <!-- customer details form elements -->
          <div class="col-md-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Add New Admin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
				<?php
				require_once 'config/config.php';
				// Check whether the user id already exists
				$db = getDbInstance();
				$db->orderBy("user_id","desc");
				$adminAccounts = $db->getOne("admin_accounts", null, "*");	
				$adminUserId=$adminAccounts['user_id'];
				$adminUserId=$adminUserId+1
				?>
				<div class="card-body">
				<div class="form-group">
					<label class="col-md-12 control-label">User ID [Number]</label>
					<div class="col-md-12 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input readonly type="number" placeholder="User ID" name="user_id"class="form-control" required="" value="<?php echo $adminUserId; ?>" autocomplete="off">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-12 control-label">Username</label>
					<div class="col-md-12 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="text" name="user_name" placeholder="Username" class="form-control" required="" value="<?php echo ($edit) ? $admin_account['user_name'] : ''; ?>" autocomplete="off">
						</div>
					</div>
				</div>
				<!-- email input -->
				<div class="form-group">
					<label class="col-md-12 control-label">Email Address</label>
					<div class="col-md-12 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							<input type="email" name="email" placeholder="Email Address" class="form-control" required="" value="<?php echo ($edit) ? $admin_account['email'] : ''; ?>" autocomplete="off">
						</div>
					</div>
				</div>
				<!-- Password input -->
				<div class="form-group">
					<label class="col-md-12 control-label">Password</label>
					<div class="col-md-12 inputGroupContainer">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="text" name="password" placeholder="Password" class="form-control" required="" autocomplete="off">
						</div>
					</div>
				</div>
				<!-- Radio checks -->
				<div class="form-group">
				<label class="col-md-12 control-label">Admin type</label>
				<div class="col-md-12">
				<div class="radio">
					<label>
					<input type="radio" name="admin_type" value="user" required=""/> Client Police Station
					</label>
				</div>
				</div>
				</div>
			<!-- Submit button -->
			<div class="form-group">
				<label class="col-md-12 control-label"></label>
				<div class="col-md-12">
					<button type="submit" class="btn btn-success btn-block">Save <i class="glyphicon glyphicon-send"></i></button>
				</div>
			</div>
                </div>
            </div>
            <!-- /.card -->
          </div>	  
          <!-- /.form1 End -->
            <!-- /.card -->
          </div>	  
          <!-- /.form1 End -->
	  </div>
    </section>
