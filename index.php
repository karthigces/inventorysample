<?php
session_start();
require_once './config/config.php';
require_once 'includes/auth_validate.php';

//Get DB instance. function is defined in config.php
$db = getDbInstance();

if($_SESSION['admin_type']=="super")	
{
//Get Dashboard information
$numInventory = $db->getValue ("business_inventory_details", "count(*)");
$numAccounts = $db->getValue ("admin_accounts", "count(*)");
}

else
{
//Get Dashboard information
$numInventory = $db->getValue ("business_inventory_details", "count(*)");
$numAccounts = $db->getValue ("admin_accounts", "count(*)");
}

include_once('includes/header.php');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
		<!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $numInventory; ?></h3>

                <p>Total Inventory Purchased</p>
              </div>
              <div class="icon">
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $numAccounts; ?></h3>

                <p>Users</p>
              </div>
              <div class="icon">
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
<?php include_once('includes/footer.php'); ?>
