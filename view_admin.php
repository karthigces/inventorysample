<?php
session_start();
require_once 'config/config.php';
require_once BASE_PATH . '/includes/auth_validate.php';

// Get current page
$page = filter_input(INPUT_GET, 'page');
if (!$page) {
	$page = 1;
}

// Get DB instance. i.e instance of MYSQLiDB Library
$db = getDbInstance();
$db->where ('status', 1);
$select = array('id', 'user_id', 'user_name', 'email', 'admin_type');

// Get result of the query
$rows = $db->arraybuilder()->paginate('admin_accounts', $page, $select);
?>
<?php include BASE_PATH . '/includes/header.php'; ?>
<!-- Main container -->
 <div class="content-wrapper">
    <?php if($_SESSION['admin_type'] === 'super') { ?>
	<?php include BASE_PATH.'/includes/flash_messages.php'; ?>
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Admin Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  <!-- Main content -->
  <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with default features</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
			  <table id="example1" class="table table-bordered table-sm">
                <thead>
                <tr class="alert alert-danger">
                  <th>Staff ID</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>User Type</th>
                  <th>Action</th>
                </tr>
                </thead>
			<tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
                <td><?php echo $row['user_id']; ?></td>
                <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['admin_type']); ?></td>
                <td>
                    <?php if($row['admin_type']=='user') {?>
                    <a href="edit_admin.php?admin_user_id=<?php echo $row['id']; ?>&operation=edit" class="btn btn-primary delete_btn btn-sm">Edit</a>
					<a href="#" class="btn btn-danger delete_btn btn-sm" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id']; ?>">Delete</a>
					<?php } ?>
                </td>
            </tr>
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="confirm-delete-<?php echo $row['id']; ?>" role="dialog">
                <div class="modal-dialog">
                    <form action="delete_admin.php" method="POST">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="del_id" id="del_id" value="<?php echo $row['id']; ?>">
                                <p>Are you sure you want to delete this row? This can't be undone!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default pull-left">Yes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- //Delete Confirmation Modal -->
            <?php endforeach; ?>
        </tbody>
                <tfoot>
                <tr class="alert alert-success">
                  <th>Staff ID</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>User Type</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
			  </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- //Table -->
    <!-- //Pagination -->
	<?php } ?>
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php'; ?>
