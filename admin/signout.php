<?php
include("dbcon.php");
session_unset();
session_destroy();
if(isset($_GET['userid'])){
    $uname = $_GET['userid'];
    $msg = "Signed out";
    $log = date("Y-m-d H:i:s")." Username:".$uname." Message:".$msg.PHP_EOL;
    logrequest($log,"System Logs",1);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GTEC</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/core.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/components.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/minified/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
	<!-- /core JS files -->


	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/plugins/notifications/pnotify.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/components_notifications_pnotify.js"></script>
	<!-- /theme JS files -->
    <style type="text/css">
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .hero-image {
            background-image: url("../img/login2.jpg");
            background-color: #cccccc;
            height: 500px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }
    </style>

</head>

<body class="hero-image">


	<!-- Page container -->
	<div class="page-container login-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Simple login form -->
					<form method="post" id="loginform">
						<div class="panel panel-body login-form">
                            <div class="text-center">
                                <div class="border-slate-300 text-slate-300" align="center"><img src="assets/images/logo.png" class="img-responsive" style="width: 150px; height: 100px;"/></div>
                                <h5 class="content-group">System Signed Out After Long Period Of Inactivity <small class="display-block">Please Log In Below</small></h5>
                            </div>

							<div class="form-group has-feedback has-feedback-left hidden">
								<input type="text" value="<?php echo $uname; ?>" class="form-control" placeholder="E-mail" id="uname" name="uname">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" class="form-control" placeholder="Password" id="pword">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="button" class="btn btn-primary btn-block" onclick="logIn()" id="loadbtn">Sign in <i class="icon-circle-right2 position-right"></i></button>
                                <div align="center" id="loader" class="hidden"><img src="assets/images/spinner.gif" class="img-responsive"  width="100" height="100"/></div>
                            </div>

							<div class="text-center">
								<a href="password_recovery.php">Forgot password?</a>
							</div>
						</div>
					</form>
					<!-- /simple login form -->


					<!-- Footer -->
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->
    <div id="alertt_modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" align="center">
                            <img src="../admin/assets/images/pnotify/danger.png" style="width: 80px; height: 80px;" class="img-responsive" />
                        </div>
                        <div class="col-md-12">
                            <br/>
                            <p style="text-align: center; font-size: large" id="alertMsg" ></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
