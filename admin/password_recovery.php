
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Password Recovery-GTEC</title>

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
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<script type="text/javascript" src="assets/js/main.js"></script>
	<!-- /theme JS files -->
    <style type="text/css">
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .hero-image {
            background-image: url("../img/login1.jpg");
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

	<!-- Main navbar -->
	<!-- /main navbar -->


	<!-- Page container -->
	<div class="page-container login-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">
					 					<!-- Password recovery -->
                    <div class="panel panel-body login-form">


                        <div class="text-center">
                            <div class="border-slate-300 text-slate-300" align="center"><img src="assets/images/logo.png" class="img-responsive" style="width: 150px; height: 100px;"/></div>
                            <h5 class="content-group">Password Recovery <small class="display-block"> Please provide the email used during registration. </small></h5>
                        </div>

                        <div class="form-group has-feedback">
                            <input type="text" class="form-control" placeholder="E-mail" id="email" required>
                            <div class="form-control-feedback">
                                <i class="icon-mail5 text-muted"></i>
                            </div>
                        </div>

                        <div class="form-group" id="clickhide">
                            <button type="button" class="btn btn-primary btn-block" onclick="resetPassword()">Reset Password <i class="icon-circle-right2 position-right"></i></button>
                        </div>
                        <div id="deleteloader" class="hidden" align="center">
                            <img src="assets/images/spinner.gif" class="img-responsive" style="width: 50px; height: 50px;"/>
                            <p>Deleting record.....</p>
                        </div>

                        <div class="text-center">
                            <a href="index.php">Login?</a>
                        </div>
                    </div>
					<!-- /password recovery -->


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

    <div id="success_modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" align="center">
                            <img src="../admin/assets/images/pnotify/success.png" style="width: 80px; height: 80px;" class="img-responsive" />
                        </div>
                        <div class="col-md-12">
                            <br/>
                            <p style="text-align: center; font-size: large" id="successMsg" ></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="loader" class="modal fade" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog" style="width: 400px; height: 50px;">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" align="center">
                            <img src="assets/images/spinner.gif" class="img-responsive" style="width: 50px; height: 50px;"/>
                        </div>
                        <div class="col-md-12" style="text-align: center;">
                            <p id="loadermsg"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
