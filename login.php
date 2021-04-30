<?php
session_start();
require_once 'config/config.php';
$token = bin2hex(openssl_random_pseudo_bytes(16));

// If User has already logged in, redirect to dashboard page.
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === TRUE)
{
	header('Location: index.php');
}

// If user has previously selected "remember me option": 
if (isset($_COOKIE['series_id']) && isset($_COOKIE['remember_token']))
{
	// Get user credentials from cookies.
	$series_id = filter_var($_COOKIE['series_id']);
	$remember_token = filter_var($_COOKIE['remember_token']);
	$db = getDbInstance();
	// Get user By series ID: 
	$db->where('series_id', $series_id);
	$row = $db->getOne('admin_accounts');

	if ($db->count >= 1)
	{
		// User found. verify remember token
		if (password_verify($remember_token, $row['remember_token']))
        {
			// Verify if expiry time is modified. 
			$expires = strtotime($row['expires']);

			if (strtotime(date()) > $expires)
			{
				// Remember Cookie has expired. 
				clearAuthCookie();
				header('Location: login.php');
				exit;
			}

			$_SESSION['user_logged_in'] = TRUE;
			$_SESSION['admin_type'] = $row['admin_type'];
			$_SESSION['user_id'] = $row['user_id'];
			header('Location: index.php');
			exit;
		}
		else
		{
			clearAuthCookie();
			header('Location: login.php');
			exit;
		}
	}
	else
	{
		clearAuthCookie();
		header('Location: login.php');
		exit;
	}
}
?>
<?php include BASE_PATH.'/includes/header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div align="center" class="login-logo">
      <img src="dist/img/logo.png" class="img-responsive" alt="Logo">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">மாநகர காவல், சேலம்.</p>

      <form class="form" method="POST" action="authenticate.php">
        <div class="input-group mb-3">
          <input type="text" required autocomplete="off" class="form-control" name="username" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" required autocomplete="off" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" required autocomplete="off" class="form-control" name="logged_in_as" placeholder="Logged In As">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-sticky-note"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
			<label>
				<input name="remember" type="checkbox" value="1">&nbsp;Remember Me
			</label>
		<button type="submit" class="btn btn-success btn-block">Login</button>
          <!-- /.col -->
        </div>
		<p align="center"><small>Powered By Govt.College of Engineering, Salem.</small></p>
          <!-- /.col -->
		<?php if (isset($_SESSION['login_failure'])): ?>
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?php
			echo $_SESSION['login_failure'];
			unset($_SESSION['login_failure']);
			?>
		</div>
		<?php endif; ?>
      </form>
  </div>
</div>
<!-- /.login-box -->
<?php include BASE_PATH.'/includes/footer.php'; ?>
