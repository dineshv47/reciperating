<?php
include('config/session.php');
include('config/config.php');


$message = '';
$message_type = '';

$errors = array(
	'password' => '',
	'email' => '',
);


if ($_POST && $_POST['login-form-submit'] != '') {

	$message = "";
	$message_type = '';

	if ($_POST['email'] == '') {
		$errors['email'] = 'Please enter email';
	}
	if ($_POST['password'] == '') {
		$errors['password'] = 'Please enter password';
	}

	//print_r('post' . $_POST);

	if ($errors['email'] == '' && $errors['password'] == '') {

		$sqlEmail = "SELECT * FROM users WHERE email = '" . $_POST['email'] . "' and password = '" . md5($_POST['password']) . "'";
		//echo $sqlEmail;
		$result = $conn->query($sqlEmail);
		//print_r($result);


		if ($result->num_rows == 1) {
			$row = $result->fetch_object();
			$_SESSION['user'] = $row->fname;
			$_SESSION['id'] = $row->id;
			//print_r($row->fname);
			$message = "Login successfully, you will redirect in 5 sec";
			$message_type = 'success';
			$_POST = [];
			sleep(5);
			if (isset($_GET) && $_GET['redirect'] != '') {
				$location = $_GET['redirect'] . ".php";

				if ($_GET['id'] != '') {
					$location .= "?id=" . $_GET['id'];
				}
				header("Location: " . $location);
			} else {
				header("Location: index.php");
			}
			exit();
		} else {

			//echo 'in else num rows';
			$message = 'Check email and password!';
			$message_type = 'danger';
		}
	}
}

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Poppins:300,400,500,600,700|PT+Serif:400,400i&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="assets/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="assets/style.css" type="text/css" />
	<link rel="stylesheet" href="assets/dark.css" type="text/css" />
	<link rel="stylesheet" href="assets/font-icons.css" type="text/css" />
	<link rel="stylesheet" href="assets/animate.css" type="text/css" />
	<link rel="stylesheet" href="assets/magnific-popup.css" type="text/css" />

	<link rel="stylesheet" href="assets/custom.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<!-- Document Title
	============================================= -->
	<title>Login</title>

</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap py-0">

				<div class="section p-0 m-0 h-100 position-absolute" style="background: url('images/2.jpg') center center no-repeat; background-size: cover;"></div>

				<div class="section bg-transparent min-vh-100 p-0 m-0">
					<div class="vertical-middle">
						<div class="container-fluid py-5 mx-auto">
							<div class="center mb-3">
								<a href="<?php echo BASE_URL; ?>index.php"><svg xmlns="https://www.w3.org/2000/svg" viewBox="0 0 127 32" width=120>
										<path fill="#F7AF31" fill-rule="nonzero" d="M126.7 6.912c0-3.885-2.176-6.88-4.674-6.88-2.491 0-4.674 3.002-4.674 6.88 0 3.358 1.631 5.43 3.68 5.935-.015.812-.157 8.473-.93 16.89 0 0 .678.285 1.97.285 1.294 0 2.2-.284 2.2-.284-.749-7.44-1.072-14.62-1.15-16.568 0-.015-.237.071-.568-.023-.276-.071-.426-.181-.41-.181h.047c.268 0 .552-.056.733-.095.008 0 .016 0 .024-.008l.165-.04c2.01-.551 3.587-2.608 3.587-5.91z"></path>
										<path fill="#F15025" d="M4.627 19.058c-2.538.654-4.588 1.766-4.588 4.706 0 2.845 1.931 3.885 4.052 3.885 1.639 0 3.428-.607 4.72-2.167v1.82h4.32V17.23c0-3.839-1.986-5.226-5.92-5.226-2.104 0-3.987.41-5.713.946l-.3 3.76c1.679-.49 3.184-.86 4.76-.86 1.892 0 2.854.528 2.854 2.018v.158l-4.185 1.032zm1.418 5.517c-.843 0-1.529-.41-1.529-1.426 0-1.23 1.01-1.94 3.16-2.538l1.128-.331v3.097c-.851.741-1.9 1.198-2.759 1.198zm9.348-17.363v20.09h4.327V6.723zm6.747 0v20.09h4.335V6.723zm6.755 5.43v14.653h4.335v-8.907c1.568-1 3.46-1.277 5.083-1.198l.229-5.147c-2.822 0-4.256 1.151-5.312 4.982v-4.887l-4.335.504zm24.22 3.855l-.276-.678c-.859-2.136-2.837-3.839-6.092-3.823-3.8 0-7.693 2.31-7.693 7.771 0 4.753 2.893 7.874 7.945 7.874 2.767 0 4.753-.85 5.872-1.592l.284-4.295c-1.734 1.316-4.06 1.781-5.652 1.781-1.568 0-2.671-.465-3.373-1.23l8.103-3.775c.859-.386 1.245-1.166.882-2.033zm-9.97 2.892c0-2.782 1.726-3.98 3.673-3.98 1.387 0 2.073.646 2.506 1.474l-6.171 2.877c0-.119-.008-.245-.008-.37zm19.2-3.539c1.166 0 2.325.386 3.16.82v-4.106c-1.269-.395-2.766-.56-3.94-.56-4.919 0-7.48 3.074-7.48 7.819 0 4.737 2.561 7.818 7.487 7.818a12.7 12.7 0 004.288-.788v-4.059c-1.08.497-2.317.899-3.507.899-2.27 0-3.925-1.23-3.925-3.886 0-2.64 1.655-3.957 3.917-3.957zm5.305 11.452h4.334V12.154l-4.335.488zm2.151-21.446c-1.734 0-2.806 1.048-2.806 2.507 0 1.481 1.064 2.53 2.806 2.53 1.734 0 2.75-1.049 2.75-2.53.009-1.459-1.016-2.507-2.75-2.507zm4.603 6.786v19.342h4.335v-4.682a7.876 7.876 0 002.34.347c4.32 0 7.599-2.892 7.599-8.457 0-4.989-2.286-7.188-5.415-7.188-2.05 0-3.484.93-4.524 1.97v-1.828l-4.335.496zm6.581 2.917c2.444 0 3.169 1.939 3.153 4.082.008 2.893-1.253 4.58-3.941 4.58a6.966 6.966 0 01-1.458-.15v-7.835c.623-.394 1.348-.677 2.246-.677zm22.849.938l-.275-.678c-.86-2.136-2.838-3.839-6.093-3.823-3.799 0-7.693 2.31-7.693 7.771 0 4.753 2.893 7.874 7.945 7.874 2.767 0 4.753-.85 5.872-1.592l.284-4.295c-1.734 1.316-4.06 1.781-5.651 1.781-1.569 0-2.672-.465-3.374-1.23l8.103-3.775c.859-.386 1.245-1.166.882-2.033zm-9.97 2.892c0-2.782 1.726-3.98 3.673-3.98 1.387 0 2.073.646 2.506 1.474l-6.171 2.877c0-.119-.008-.245-.008-.37zm15.362-2.735c0-.938 1.284-1.174 2.522-1.174 1.214 0 2.68.197 4.437.977l-.118-3.61c-1.096-.488-2.562-.843-4.437-.843-4.8 0-6.369 2.31-6.369 4.776 0 6.006 7.425 3.579 7.425 6.014 0 .993-1.08 1.222-2.136 1.222a10.58 10.58 0 01-5.313-1.419l-.252 3.815c1.49.756 3.46 1.23 5.557 1.23 4.61 0 6.376-2.263 6.376-5.187.016-5.809-7.692-3.539-7.692-5.8z"></path>
									</svg>
								</a>
							</div>

							<div class="card mx-auto rounded-0 border-0" style="max-width: 400px; background-color: rgba(255,255,255,0.93);">
								<div class="card-body" style="padding: 40px;">
									<form id="login-form" name="login-form" class="mb-0" action="" method="post">
										<h3>Login to your Account</h3>
										<?php
										if ($message != '' && $message_type != '') {
										?>
											<div class="alert alert-<?php echo $message_type; ?>" role="alert">
												<?php echo $message; ?>
											</div>
										<?php
										}
										?>
										<div class="row">
											<div class="col-12 form-group">
												<label for="login-form-username">Username:</label>
												<input type="text" id="login-form-username" name="email" value="" class="form-control not-dark" />
												<?php if ($errors['email'] != '') {
												?>
													<span class="error"><?php echo $errors['email'] ?></span>
												<?php
												} ?>
											</div>

											<div class="col-12 form-group">
												<label for="login-form-password">Password:</label>
												<input type="password" id="login-form-password" name="password" value="" class="form-control not-dark" />
												<?php if ($errors['password'] != '') {
												?>
													<span class="error"><?php echo $errors['password'] ?></span>
												<?php
												} ?>
											</div>

											<div class="col-12 form-group">
												<button class="button button-3d button-black m-0" id="login-form-submit" name="login-form-submit" value="login">Login</button>
												<!-- <a href="#" class="float-end">Forgot Password?</a> -->

												<a href="<?php echo BASE_URL; ?>registration.php" class="float-end">New user? Register</a>

											</div>
										</div>
									</form>

								</div>

								<div class="text-center dark"><small>Copyrights &copy; All Rights Reserved by Canvas Inc.</small></div>
							</div>
						</div>
					</div>

				</div>
		</section><!-- #content end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="js/jquery.js"></script>
	<script src="js/plugins.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="js/functions.js"></script>

</body>

</html>