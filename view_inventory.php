<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';
//Get DB instance. function is defined in config.php
$db = getDbInstance();

include_once('includes/header.php');
?>
<!--PHP Operations-->
<?php

	$user_id = $_SESSION['user_id'];
	if ($_SESSION['admin_type'] == 'super')
	{
		$db->where ("b.status",1);
		$db->orderBy("b.timestamp","Desc");
		$businessInventoryDetails = $db->get ("business_inventory_details b", null, "*");
	}
	else
	{
		$db->where ("b.user_id", $user_id);
		$db->where ("b.status",1);
		$db->orderBy("b.timestamp","Desc");
		$businessInventoryDetails = $db->get ("business_inventory_details b", null, "*");
	}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php include BASE_PATH.'/includes/flash_messages.php'; ?>
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Inventory Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">My Inventory</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
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
              <table id="example1" class="table table-bordered table-sm" style="">
                <thead>
                <tr class="alert alert-danger">
                  <td>Id</td>
                  <td>Timestamp</td>
                  <td>User Id</td>
                  <td>Product Id</td>
                  <td>Product Name</td>
                  <td>Product Description</td>
                  <td>Product Quantity</td>
                  <td>Purchase Date</td>
                  <td>Expiry Date</td>
                  <td>Supplier Name</td>
                  <td>Supplier Address</td>
                  <td>Product Damage Status</td>
                  <td>Action</td>
                </tr>
                </thead>
                <tbody>
				<?php
				if ($db->count > 0)
				foreach ($businessInventoryDetails as $BID) {
				?>
				<tr>
				  <td><?php echo $BID['id']; ?></td>
				  <td><?php echo $BID['timestamp']; ?></td>
				  <td><?php echo $BID['user_id']; ?></td>
				  <td><?php echo $BID['product_id']; ?></td>
				  <td><?php echo $BID['product_name']; ?></td>
				  <td><?php echo $BID['product_description']; ?></td>
				  <td><?php echo $BID['product_quantity']; ?></td>
				  <td><?php echo $BID['product_purchase_date']; ?></td>
				  <td><?php echo $BID['product_expiry_date']; ?></td>
				  <td><?php echo $BID['supplier_name']; ?></td>
				  <td><?php echo $BID['supplier_address']; ?></td>
				  <td><?php echo $BID['product_damage_status']; ?></td>
				  
				  <td>
                      <div class="btn-group-vertical">
                        <div class="btn-group"><button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"></button>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="edit_inventory.php?<?php echo "id=".$BID['id'];?>">Edit</a></li>

                          </ul>
                        </div>
                      </div>
                  </td>
				</tr>			
				<?php
				}
				?>
				<!-- Delete Confirmation Modal -->
				<div class="modal fade" id="confirm-delete-<?php echo $BID['id']; ?>" role="dialog">
					<div class="modal-dialog">
						<form action="delete_inventory.php" method="POST">
							<!-- Modal content -->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
								<div class="modal-body">
									<input type="hidden" name="id" id="id" value="<?php echo $BID['id']; ?>">
									<p>Are you sure you want to delete this row?</p>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-default pull-left">Yes</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
								</div>
							</div>
						</form>
					</div>
				</div>
                </tbody>
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
    <!-- /.content -->
  </div>
<?php include_once('includes/footer.php'); ?>
