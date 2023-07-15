<?php
include("dbcon.php");
if (!isset($_SESSION['uname'])) {
    header("location: index.php");
    exit(0);
} else{
    $uname = $_SESSION['uname'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
    $email = $_SESSION['email'];
    $roleid = $_SESSION['roleid'];
    $institution = $_SESSION['institution'];
    $access = $_SESSION['access'];
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
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/forms/wizards/stepy.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/jasny_bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/validation/validate.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/wizard_stepy.js"></script>

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>

    <script type="text/javascript" src="assets/js/pages/datatables_basic.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>
    <script type="text/javascript" src="assets/js/echarts.js"></script>
    <script type="text/javascript" src="assets/js/themes/roma.js"></script>
    <script type="text/javascript" src="assets/js/themes/infographic.js"></script>
    <!-- /theme JS files -->
    <!-- /theme JS files -->
    <style type="text/css">
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .hero-image {
            background-image: url("assets/images/background.png");
            background-color: #cccccc;
            height: 500px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }

        .menu-item {
            font-weight: bold;
            font-size: large;
        }

        a > .dlink{
            color: #FFDC0A;
        }

        label{
            font-weight: bold;
            color: #000000;
        }

        thead{
            background-color: #0c7cd5;
            color: #FFFFFF;
            font-weight: bold;
        }
        .rqd{
            color: #ff0000;
            font-weight: bold;
            font-size: large;
        }

        .tree, .tree ul {
            margin:0;
            padding:0;
            list-style:none
        }
        .tree ul {
            margin-left:1em;
            position:relative
        }
        .tree ul ul {
            margin-left:.5em
        }
        .tree ul:before {
            content:"";
            display:block;
            width:0;
            position:absolute;
            top:0;
            bottom:0;
            left:0;
            border-left:1px solid
        }
        .tree li {
            margin:0;
            padding:0 1em;
            line-height:2em;
            color:#369;
            font-weight:700;
            position:relative
        }
        .tree ul li:before {
            content:"";
            display:block;
            width:10px;
            height:0;
            border-top:1px solid;
            margin-top:-1px;
            position:absolute;
            top:1em;
            left:0
        }
        .tree ul li:last-child:before {
            background:#fff;
            height:auto;
            top:1em;
            bottom:0
        }
        .indicator {
            margin-right:5px;
        }
        .tree li a {
            text-decoration: none;
            color:#369;
        }
        .tree li button, .tree li button:active, .tree li button:focus {
            text-decoration: none;
            color:#369;
            border:none;
            background:transparent;
            margin:0px 0px 0px 0px;
            padding:0px 0px 0px 0px;
            outline: 0;
        }

        .btnrqd{
            background-color: rgba(223,246,221,0.98);
        }

        .clicklink{
            color: #000000;
        }
        .clicklink:hover{
            color: rgba(2,47,173,0.98);
        }

        #map {
            height: 400px;
            width: 1200px;
        }
    </style>

</head>

<body>

<!-- Main navbar -->

<div class="navbar navbar-inverse" style="background-color: #000000">

    <div class="navbar-collapse collapse" id="navbar-mobile">

        <ul class="nav navbar-nav navbar-right">
            <li>
                <a href="dashboard.php" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-library2"></i></a>
            </li>

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="assets/images/logo.png" alt="">
                    <span><?php echo $fname." ".$lname; ?></span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="../admin/dashboard.php?profile"><i class="icon-user-plus"></i> Profile</a></li>
                    <li><a href="../index.html"><i class="icon-switch2"></i> Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <?php include("components/sidemenu.php") ?>
        <!-- /main sidebar -->


        <!-- Main content -->
        <?php
            if(isset($_GET['user_roles'])){
                $conn=new Db_connect;
                $dbcon=$conn->conn();
                $status = "";
        ?>
        <div class="content-wrapper">
            <!-- Page header -->
            <div class="page-header" style="margin: 20px;">
                <div class="breadcrumb-line">
                    <ul class="breadcrumb" style="font-size: medium;">
                        <li style="font-weight: bold; font-size: x-large">Accounts </li>
                        <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                        <li class="active"><a href="dashboard.php?user_roles">User Roles</a></li>
                    </ul>
                    <ul class="breadcrumb-elements">
                        <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                        <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                    </ul>
                </div>
            </div>
            <!-- /page header -->
            <!-- Content area -->
            <div class="content">
                <!-- Clickable title -->
                <div class="panel panel-white hidden" id="add_new_role">
                    <div class="panel-heading">
                        <h6 class="panel-title">Add New Role</h6>
                    </div>

                    <form class="stepy-clickable">
                        <fieldset title="1">
                            <legend class="text-semibold">Role Information</legend>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Role Title:<b class="rqd">*</b></label>
                                        <input type="text" id="roletitle" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label align="center">Access:<b class="rqd">*</b></label>
                                        <div class="row">
                                            <div class="col-md-6" align="right"><input type="checkbox" name="accesses" value="create" />&nbsp;Create&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="accesses"  value="read" checked="checked" disabled />&nbsp;Read</div>
                                            <div class="col-md-6" align="left"><input type="checkbox" name="accesses" value="update" />&nbsp;Update&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="accesses"  value="delete" />&nbsp;Delete</div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-12" align="right">
                                    <button class="btn btn-sm btn-primary" type="button" onclick="createRole()">Submit  </button>
                                </div>
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary stepy-finish" style="visibility: hidden">Submit <i class="icon-check position-right"></i></button>
                    </form>
                </div>
                <!-- /clickable title -->

                <!-- Clickable title -->
                <div class="panel panel-white" id="view_roles">
                    <div class="panel-heading">
                        <h6 class="panel-title">User Roles</h6>
                    </div>
                    <div class="row" style="margin: 20px;">
                        <div class="col-md-6">
                            <div align="left"><a onclick="toggle('add_new_role','view_roles')" class="btn btn-lg btn-default"><span class="icon icon-plus3"></span>   Add Roles</a></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-flat" style="margin: 10px;">
                                <table class="table table-hover datatable-basic">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Role</th>
                                        <th>Permissions</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count= 0;
                                    $sel = "SELECT role, permissions, status, id FROM roles WHERE status='Active' ORDER BY role ASC";
                                    $selrun = $conn->query($dbcon,$sel);
                                    while($row = $conn->fetch($selrun)){
                                        $count++;
                                        $id = $row['id'];
                                        $status = $row['status'];
                                        $color = "#000000";
                                        if($status == "Inactive"){
                                            $color = "#6B8139";
                                        }
                                    ?>
                                    <tr style="color: <?php echo $color; ?>">
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $row['role']; ?></td>
                                        <td><?php echo $row['permissions']; ?></td>
                                        <td align="right"><a class="btn" onclick="updateRole(<?php echo $id; ?>)" data-popup="tooltip" title="Edit" data-placement="bottom"><span class="icon icon-database-edit2"></span></a></td>
                                        <td align="left"><a class="btn" onclick="deleteModal(<?php echo $id; ?>,'roles')" data-popup="tooltip" title="Delete" data-placement="bottom"><span class="icon icon-trash-alt"></span></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /clickable title -->
            </div>
            <!-- /content area -->

        </div>
        <?php $conn->close($dbcon);}elseif(isset($_GET['isced'])){
            $conn=new Db_connect;
            $dbcon=$conn->conn();
            $status = "";
            if(isset($_GET['status'])){
                $status = $_GET['status'];
            }
            ?>
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header" style="margin: 20px;">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb" style="font-size: medium;">
                            <li style="font-weight: bold; font-size: x-large">Accounts </li>
                            <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                            <li class="active"><a href="dashboard.php?isced">ISCED</a></li>
                        </ul>
                        <ul class="breadcrumb-elements">
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">
                    <!-- Clickable title -->
                    <div class="panel panel-white hidden" id="add_new_isced">
                        <div class="panel-heading">
                            <h6 class="panel-title">Create ISCED for institutions</h6>
                        </div>

                        <form class="stepy-clickable">
                            <fieldset title="1">
                                <legend class="text-semibold">ISCED Details</legend>

                                <div class="row">
                                    <div class="col-md-4">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="ititle" class="form-control" placeholder="ISCED Title" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">&nbsp;</div>
                                </div>
                                <div class="row" align="center">
                                    <div class="col-md-4">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="icode" class="form-control" placeholder="ISCED CODE" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <textarea id="idescript" placeholder="ISCED DESCRIPTION" class="form-control" maxlength="1000" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" align="center">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="createIsced()">Submit  </button>
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-primary stepy-finish" style="visibility: hidden">Submit <i class="icon-check position-right"></i></button>
                        </form>
                    </div>
                    <!-- /clickable title -->

                    <!-- Clickable title -->
                    <div class="panel panel-white" id="view_isced">
                        <div class="panel-heading">
                            <h6 class="panel-title">ISCED</h6>
                        </div>
                        <div class="row" style="margin: 20px;">
                            <div class="col-md-6">
                                <div align="left"><a onclick="toggle('add_new_isced','view_isced')" class="btn btn-lg btn-default"><span class="icon icon-plus3"></span>   Add ISCED</a></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-flat" style="margin: 10px;">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ISCED</th>
                                            <th>ISCED Code</th>
                                            <th>ISCED Description</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count= 0;
                                        $sel = "SELECT id, name, code, description, status FROM isceds WHERE status='Active' ORDER BY code ASC";
                                        $selrun = $conn->query($dbcon,$sel);
                                        while($row = $conn->fetch($selrun)){
                                            $count++;
                                            $id = $row['id'];
                                            $status = $row['status'];
                                            $color = "#000000";
                                            if($status == "Inactive"){
                                                $color = "#6B8139";
                                            }
                                            ?>
                                            <tr style="color: <?php echo $color; ?>">
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['code']; ?></td>
                                                <td><?php echo $row['description']; ?></td>
                                                <td align="right"><a class="btn" onclick="getIsced(<?php echo $id; ?>)" data-popup="tooltip" title="Edit" data-placement="bottom"><span class="icon icon-database-edit2"></span></a></td>
                                                <td align="left"><a class="btn" onclick="deleteModal(<?php echo $id; ?>,'isceds')" data-popup="tooltip" title="Delete" data-placement="bottom"><span class="icon icon-trash-alt"></span></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /clickable title -->
                </div>
                <!-- /content area -->

            </div>
            <?php $conn->close($dbcon);}elseif(isset($_GET['institutions'])){
            $conn=new Db_connect;
            $dbcon=$conn->conn();
            $status = "";
            if(isset($_GET['status'])){
                $status = $_GET['status'];
            }
            ?>
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header" style="margin: 20px;">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb" style="font-size: medium;">
                            <li style="font-weight: bold; font-size: x-large">Institution </li>
                            <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                            <li class="active"><a href="dashboard.php?isced">Institutions</a></li>
                        </ul>
                        <ul class="breadcrumb-elements">
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">
                    <!-- Clickable title -->
                    <div class="panel panel-white hidden" id="add_new_institution">
                        <div class="panel-heading">
                            <h6 class="panel-title">Create Institutions</h6>
                        </div>

                        <form class="stepy-clickable">
                            <fieldset title="1">
                                <legend class="text-semibold">Institution Details</legend>

                                <div class="row">
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="insname" class="form-control btnrqd" placeholder="Name Of Institution" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                </div>
                                <div class="row" align="center">
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="inshort" class="form-control btnrqd" placeholder="Institution Short Name" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                </div>
                                <div class="row" align="center">
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="inscode" class="form-control btnrqd" placeholder="Institution Code" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                </div>
                                <div class="row" align="center">
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="inscat"  data-placeholder="Select Institution Category" class="select btnrqd">
                                                <option value=""></option>
                                                <?php
                                                $sel = "SELECT name, id FROM institute_categories ORDER BY name ASC";
                                                $selrun = $conn->query($dbcon,$sel);
                                                while($row = $conn->fetch($selrun)){
                                                    ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                </div>
                                <div class="row" align="center">
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <textarea id="insdesc" class="form-control" placeholder="Description" maxlength="200" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                </div>
                            </fieldset>
                            <fieldset title="2">
                                <legend class="text-semibold">Contact Details</legend>

                                <div class="row">
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="inscont" class="form-control btnrqd" placeholder="Telephone Contact" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                </div>
                                <div class="row" align="center">
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="insemail" class="form-control" placeholder="E-mail" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                </div>
                                <div class="row" align="center">
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="insurl" class="form-control" placeholder="Website URL" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                </div>

                            </fieldset>
                            <fieldset title="3">
                                <legend class="text-semibold">Location Details</legend>

                                <div class="row">
                                    <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="digaddress" class="form-control btnrqd" placeholder="Digital Address" />
                                        </div>
                                    </div>
                                    <div class="col-md-4"><button type="button" onclick="getAddressDetails()"><img src="assets/images/map.jpeg" class="img-responsive" style="width: 50px; height: 40px" /> </button></div>
                                </div>
                                <div id="dighide" class="hidden">
                                    <div class="row" align="center">
                                        <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Region</label>
                                                <input type="text" readonly id="digregion" class="form-control" placeholder="Region" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                    </div>
                                    <div class="row" align="center">
                                        <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>District</label>
                                                <input type="text" readonly id="digdistrict" class="form-control" placeholder="District" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                    </div>
                                    <div class="row" align="center">
                                        <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Town</label>
                                                <input type="text" readonly id="digtown" class="form-control" placeholder="Town" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                    </div>
                                    <div class="row" align="center">
                                        <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Latitude</label>
                                                <input type="text" readonly id="diglat" class="form-control" placeholder="Latitude" />
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Laongitude</label>
                                                <input type="text" readonly id="diglongt" class="form-control" placeholder="Longitude" />
                                            </div>
                                        </div>
                                        <div class="col-md-4 hidden-xs hidden-sm">&nbsp;</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" align="center" style="margin-bottom: 20px">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="createInstitution()">Submit  </button>
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-primary stepy-finish" style="visibility: hidden">Submit <i class="icon-check position-right"></i></button>
                        </form>
                    </div>
                    <!-- /clickable title -->

                    <!-- Clickable title -->
                    <div class="panel panel-white" id="view_institutions">
                        <div class="panel-heading">
                            <h6 class="panel-title">Institutions</h6>
                        </div>
                        <div class="row" style="margin: 20px;">
                            <div class="col-md-6">
                                <div align="left"><a onclick="toggle('add_new_institution','view_institutions')" class="btn btn-lg btn-default"><span class="icon icon-plus3"></span>   Add Institution</a></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-flat" style="margin: 10px;">
                                    <table class="table table-hover datatable-basic">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Digital Address</th>
                                            <th>Region</th>
                                            <th>District</th>
                                            <th>Town</th>
                                            <th>E-mail</th>
                                            <th>Phone/th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count= 0;
                                        $sel = "SELECT id, short_name, institution_code, name, category_id,status, region, district, town, latitude, longitude, digital_address, contact_telephone, contact_email, url FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                        $selrun = $conn->query($dbcon,$sel);
                                        while($row = $conn->fetch($selrun)){
                                            $count++;
                                            $id = $row['id'];
                                            $status = $row['status'];
                                            $color = "#000000";
                                            if($status == "Inactive"){
                                                $color = "#6B8139";
                                            }
                                            ?>
                                                <tr style="color: <?php echo $color; ?>">
                                                    <td><a class="clicklink" href="../admin/dashboard.php?view_instituion=<?php echo $id; ?>"><?php echo $count; ?></a></td>
                                                    <td><a class="clicklink" href="../admin/dashboard.php?view_instituion=<?php echo $id; ?>"><?php echo $row['institution_code']; ?></a></td>
                                                    <td><a class="clicklink" href="../admin/dashboard.php?view_instituion=<?php echo $id; ?>"><?php echo $row['name']; ?></a></td>
                                                    <td><a class="clicklink" href="../admin/dashboard.php?view_instituion=<?php echo $id; ?>"><?php echo $row['category_id']; ?></a></td>
                                                    <td><a class="clicklink" href="../admin/dashboard.php?view_instituion=<?php echo $id; ?>"><?php echo $row['digital_address']; ?></a></td>
                                                    <td><a class="clicklink" href="../admin/dashboard.php?view_instituion=<?php echo $id; ?>"><?php echo $row['region']; ?></a></td>
                                                    <td><a class="clicklink" href="../admin/dashboard.php?view_instituion=<?php echo $id; ?>"><?php echo $row['district']; ?></a></td>
                                                    <td><a class="clicklink" href="../admin/dashboard.php?view_instituion=<?php echo $id; ?>"><?php echo $row['town']; ?></a></td>
                                                    <td><a class="clicklink" href="../admin/dashboard.php?view_instituion=<?php echo $id; ?>"><?php echo $row['contact_email']; ?></a></td>
                                                    <td><a class="clicklink" href="../admin/dashboard.php?view_instituion=<?php echo $id; ?>"><?php echo $row['contact_telephone']; ?></a></td>
                                                    <td>
                                                        <a class="btn btn-sm" onclick="deleteModal(<?php echo $id; ?>,'institutes')"><span class="icon icon-trash"></span></a><a class="btn btn-sm" onclick="updateRole(<?php echo $id; ?>)"><span class="icon icon-database-edit2"></span></a>
                                                    </td>

                                                </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /clickable title -->
                </div>
                <!-- /content area -->

            </div>
            <?php $conn->close($dbcon);}elseif(isset($_GET['view_instituion'])){
            $conn=new Db_connect;
            $dbcon=$conn->conn();
            $id=$_GET['view_instituion'];

            $sel = "SELECT * FROM institutes WHERE id = $id";
            $selrun = $conn->query($dbcon,$sel);

            ?>
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header" style="margin: 20px;">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb" style="font-size: medium;">
                            <li style="font-weight: bold; font-size: x-large">Institution </li>
                            <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                            <li><a href="dashboard.php?institutions">Institutions</a></li>
                            <li class="active">View</li>
                        </ul>
                        <ul class="breadcrumb-elements">
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">
                    <!-- Clickable title -->
                    <?php if($conn->sqlnum($selrun) == 0){ ?>
                    <div class="panel panel-white">
                        <div class="row">

                            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 content-group">
                                No Institution Details Found
                            </div>
                        </div>
                    </div>
                    <?php }else{
                        $rows = $conn->fetch($selrun);
                        ?>
                        <div class="panel panel-white" id="add_new_institution">
                            <div class="panel-heading">
                                <h6 class="panel-title">Added On <?php echo $rows['createdAt']; ?></h6>
                            </div>
                            <div class="row" style="margin: 10px;">

                                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 content-group">
                                    <span class="text-muted"><h5>Institution Details:</h5></span>
                                    <ul class="list-condensed list-unstyled">
                                        <li><span style="font-weight: bold;">Code</span>:&nbsp;&nbsp;&nbsp; <?php echo $rows['institution_code']; ?></li>
                                        <li><span style="font-weight: bold;">Short Name</span>:&nbsp;&nbsp;&nbsp;  <?php echo $rows['short_name']; ?></li>
                                        <li><span style="font-weight: bold;">Institution Name</span>:&nbsp;&nbsp;&nbsp;  <?php echo $rows['name']; ?></li>
                                        <li><span style="font-weight: bold;">Category</span>:&nbsp;&nbsp;&nbsp;  <?php echo getCategory($rows['category_id']); ?></li>
                                        <li><span style="font-weight: bold;">Description</span>:&nbsp;&nbsp;&nbsp;  <?php echo $rows['description']; ?></li>
                                    </ul>
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 content-group">
                                    <span class="text-muted"><h5>Contact Details:</h5></span>
                                    <ul class="list-condensed list-unstyled">
                                        <li><span style="font-weight: bold;">Telephone Contact</span>:&nbsp;&nbsp;&nbsp; <?php echo $rows['contact_telephone']; ?></li>
                                        <li><span style="font-weight: bold;">E-mail</span>:&nbsp;&nbsp;&nbsp;  <?php echo $rows['contact_email']; ?></li>
                                        <li><span style="font-weight: bold;">Website</span>:&nbsp;&nbsp;&nbsp;  <a href="<?php echo $rows['url']; ?>" target="new"><?php echo $rows['url']; ?></a></li></li>
                                    </ul>
                                </div>
                                <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4 content-group">
                                    <span class="text-muted"><h5>Location Details:</h5></span>
                                    <ul class="list-condensed list-unstyled">
                                        <li><span style="font-weight: bold;">Digital Address</span>:&nbsp;&nbsp;&nbsp; <?php echo $rows['digital_address']; ?></li>
                                        <li><span style="font-weight: bold;">Region</span>:&nbsp;&nbsp;&nbsp;  <?php echo $rows['region']; ?></li>
                                        <li><span style="font-weight: bold;">District</span>:&nbsp;&nbsp;&nbsp; <?php echo $rows['district']; ?></li></li>
                                        <li><span style="font-weight: bold;">Town</span>:&nbsp;&nbsp;&nbsp; <?php echo $rows['town']; ?></li></li>
                                        <li><span style="font-weight: bold;">Longitude</span>:&nbsp;&nbsp;&nbsp; <?php echo $rows['longitude']; ?></li></li>
                                        <li><span style="font-weight: bold;">Latitude</span>:&nbsp;&nbsp;&nbsp; <?php echo $rows['latitude']; ?></li></li>
                                    </ul>
                                </div>

                            </div>
                            <div class="row" style="margin: 10px;">
                                <div class="col-md-12" id="map"></div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- /content area -->

            </div>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCumSa1SxK_bh-OSLAgaVzK5DskXXOWEo&callback=initMap&libraries=&v=weekly"async></script>
            <script type="text/javascript">
                // Initialize and add the map
                function initMap() {
                    const myLatLng = { lat: <?php echo $rows['latitude'] ?>, lng: <?php echo $rows['longitude'] ?> };
                    const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 15,
                        center: myLatLng,
                    });

                    new google.maps.Marker({
                        position: myLatLng,
                        map,
                        title: "Hello World!",
                    });
                }

                window.initMap = initMap;
            </script>
            <?php $conn->close($dbcon);}elseif(isset($_GET['staff'])){
            $conn=new Db_connect;
            $dbcon=$conn->conn();
            $status = "";
            ?>
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header" style="margin: 20px;">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb" style="font-size: medium;">
                            <li style="font-weight: bold; font-size: x-large">Staff </li>
                            <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                            <li class="active"><a href="dashboard.php?staff">Staff</a></li>
                        </ul>
                        <ul class="breadcrumb-elements">
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">
                    <!-- Clickable title -->
                    <div class="panel panel-white hidden" id="add_new_staff">
                        <div class="panel-heading">
                            <h6 class="panel-title">Create Staff</h6>
                        </div>

                        <form class="stepy-clickable">
                            <fieldset title="1">
                                <legend class="text-semibold">Personal Details</legend>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stfid" class="form-control btnrqd" placeholder="Staff ID" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stftitle" class="form-control" placeholder="Staff Title" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stffname" class="form-control btnrqd" placeholder="First Name" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stflname" class="form-control btnrqd" placeholder="Last Name" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stfoname" class="form-control" placeholder="Other Name(s)" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text"  id="stfdob" class="form-control btnrqd" placeholder="Date Of Birth (YYYY-MM-DD)" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="gender" id="stfsex" class="form-control btnrqd">
                                                <option value="">Select Gender</option>
                                                <option value="Female">Female</option>
                                                <option value="Male">Male</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="gender" id="stfidtype" class="form-control btnrqd">
                                                <option value="">Staff ID Type</option>
                                                <option value="Ghana Card">Ghana Card</option>
                                                <option value="National ID">National ID</option>
                                                <option value="Passport">Passport</option>
                                                <option value="Social Security">Social Security</option>
                                                <option value="Voter ID">Voter's ID</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stfidnum" class="form-control btnrqd" placeholder="ID Number" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="stfedu" data-placeholder="Highest Educational Qualification" class="select">
                                                <option></option>
                                                <option value="BA">BA</option>
                                                <option value="BBA">BBA</option>
                                                <option value="BEd">BEd</option>
                                                <option value="BSc">BSc</option>
                                                <option value="BTech">BTech</option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="HND">HND</option>
                                                <option value="LLB">LLB</option>
                                                <option value="MA">MA</option>
                                                <option value="MBA">MBA</option>
                                                <option value="MED">MED</option>
                                                <option value="MSc">MSc</option>
                                                <option value="PhD">PhD</option>
                                                <option value="Phil">Phil</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stfnationality" class="form-control btnrqd" placeholder="Nationality" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="stfdisable" data-placeholder="Select Disability Status" class="select" onchange="disabilityStatus(this.value)">
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 hidden" id="disability_details">
                                        <div class="form-group">
                                            <input type="text" id="stfdisabletype" class="form-control btnrqd" placeholder="Specific Disability" />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset title="2">
                                <legend class="text-semibold">Employment Details</legend>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="stfinstitution" data-placeholder="Select User Institution" class="select">
                                                <option></option>
                                                <?php
                                                $sel = "SELECT name, institution_code FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                                $selrun = $conn->query($dbcon,$sel);
                                                while($row = $conn->fetch($selrun)){
                                                    ?>
                                                    <option value="<?php echo $row['institution_code']; ?>"><?php echo $row['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="stfacadyear" data-placeholder="Select Academic Year" class="select">
                                                <option></option>
                                                <?php
                                                $curryear = date("Y");
                                                for($i=$curryear; $i >= ($curryear - 40); $i--){
                                                    ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="stfemptype" data-placeholder="Employment Type" class="select">
                                                <option></option>
                                                <option value="Full-time">Full-time</option>
                                                <option value="Part-time">Part-time</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="stftype" data-placeholder="Select Staff Type" class="select" onchange="getRankDetails(this.value)">
                                                <option></option>
                                                <?php
                                                $sel = "SELECT staff_type, id FROM staffcategory WHERE status = 'Active' ORDER BY staff_type ASC";
                                                $selrun = $conn->query($dbcon,$sel);
                                                while($row = $conn->fetch($selrun)){
                                                    ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['staff_type']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 hidden" align="left">
                                        <div id="rankdetailsloader"><img src="assets/images/spinner.gif" style="width: 30px; height: 30px" /></div>
                                    </div>
                                    <div class="col-md-4" id="ranklisthide">
                                        <div class="form-group">
                                            <select name="institution" id="ranklist" data-placeholder="Select Rank" class="select">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stfdesig" class="form-control" placeholder="Any Designation" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stfcollege" class="form-control" placeholder="College" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stffaculty" class="form-control" placeholder="Faculty/School" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stfdept" class="form-control" placeholder="Department" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" align="center" style="margin-bottom: 20px">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="createStaffRecord()">Submit  </button>
                                    </div>
                                </div>

                            </fieldset>
                            <button type="submit" class="btn btn-primary stepy-finish" style="visibility: hidden">Submit <i class="icon-check position-right"></i></button>
                        </form>
                    </div>
                    <!-- /clickable title -->

                    <!-- Clickable title -->
                    <div class="panel panel-white" id="view_staff">
                        <div class="panel-heading">
                            <h6 class="panel-title">Staff</h6>
                        </div>
                        <div class="row" style="margin: 20px;">
                            <div class="col-md-6">
                                <div align="left"><a onclick="toggle('add_new_staff','view_staff')" class="btn btn-lg btn-default"><span class="icon icon-plus3"></span>   Add Staff</a></div>
                            </div>
                            <div class="col-md-6">
                                <div align="right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-rounded"><i class="icon-database-export position-left"></i> Export</button>
                                        <button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#"><i class="icon-book"></i> CSV</a></li>
                                            <li><a href="#"><i class="icon-file-excel"></i> Excel</a></li>
                                            <li><a href="#"><i class="icon-file-pdf"></i> PDF</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-flat" style="margin: 10px;">
                                    <table class="table table-hover datatable-basic">
                                        <thead>
                                        <tr style="background-color: #ffffff">
                                            <th colspan="10">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>Year</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $curryear = date("Y");
                                                            for($i=$curryear; $i >= ($curryear - 40); $i--){
                                                                ?>
                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Institution</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $sel = "SELECT name, institution_code FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                                            $selrun = $conn->query($dbcon,$sel);
                                                            while($row = $conn->fetch($selrun)){
                                                                ?>
                                                                <option value="<?php echo $row['institution_code']; ?>"><?php echo $row['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Gender</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Qualification</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <option value="BA">BA</option>
                                                            <option value="BBA">BBA</option>
                                                            <option value="BEd">BEd</option>
                                                            <option value="BSc">BSc</option>
                                                            <option value="BTech">BTech</option>
                                                            <option value="Diploma">Diploma</option>
                                                            <option value="HND">HND</option>
                                                            <option value="LLB">LLB</option>
                                                            <option value="MA">MA</option>
                                                            <option value="MBA">MBA</option>
                                                            <option value="MED">MED</option>
                                                            <option value="MSc">MSc</option>
                                                            <option value="PhD">PhD</option>
                                                            <option value="Phil">Phil</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Rank</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $sel = "SELECT id, rank FROM staffranks WHERE status = 'Active' ORDER BY rank ASC";
                                                            $selrun = $conn->query($dbcon,$sel);
                                                            while($row = $conn->fetch($selrun)){
                                                                ?>
                                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['rank']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Staff Category</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $sel = "SELECT id, staff_type FROM staffcategory WHERE status = 'Active' ORDER BY staff_type ASC";
                                                            $selrun = $conn->query($dbcon,$sel);
                                                            while($row = $conn->fetch($selrun)){
                                                                ?>
                                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['staff_type']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Staff ID</th>
                                            <th>Name</th>
                                            <th>Institution</th>
                                            <th>Qualification</th>
                                            <th>Staff Type</th>
                                            <th>Rank</th>
                                            <th>Employment Type</th>
                                            <th>Nationality</th>
                                            <th>Gender</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count= 0;
                                        $sel = "SELECT status, id, staff_id, title, institution, first_name, surname, other_names, gender, nationality, qualification, rank, staff_type, employment_type FROM staff ORDER BY first_name ASC";
                                        $selrun = $conn->query($dbcon,$sel);
                                        while($row = $conn->fetch($selrun)){
                                            $count++;
                                            $id = $row['id'];
                                            $status = $row['status'];
                                            $color = "#000000";
                                            if($status == "Inactive"){
                                                $color = "#6B8139";
                                            }
                                            ?>
                                            <tr style="color: <?php echo $color; ?>">
                                                <td><?php echo $row['staff_id']; ?></td>
                                                <td><?php echo $row['title']." ".$row['first_name']." ".$row['surname']." ".$row['other_names']; ?></td>
                                                <td><?php echo getInstitution($row['institution']); ?></td>
                                                <td><?php echo $row['qualification']; ?></td>
                                                <td><?php echo getStaffCategory($row['staff_type']); ?></td>
                                                <td><?php echo getStaffRank($row['rank']); ?></td>
                                                <td><?php echo $row['employment_type']; ?></td>
                                                <td><?php echo $row['nationality']; ?></td>
                                                <td><?php echo $row['gender']; ?></td>
                                                <td>
                                                    <?php if($status == "Active"){ ?><a class="btn btn-danger" onclick="deleteModal(<?php echo $id; ?>,'staff')"><span class="icon icon-trash"></span></a><?php } ?>
                                                    &nbsp;<br/><br/><a class="btn btn-primary" onclick="updateRole(<?php echo $id; ?>)"><span class="icon icon-database-edit2"></span></a></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /clickable title -->
                </div>
                <!-- /content area -->

            </div>
            <?php $conn->close($dbcon);}elseif(isset($_GET['student_application'])){
            $conn=new Db_connect;
            $dbcon=$conn->conn();
            $status = "";
            ?>
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header" style="margin: 20px;">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb" style="font-size: medium;">
                            <li style="font-weight: bold; font-size: x-large">Students </li>
                            <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                            <li class="active"><a href="dashboard.php?student_application">Application & Admission</a></li>
                        </ul>
                        <ul class="breadcrumb-elements">
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">
                    <!-- Clickable title -->
                    <div class="panel panel-white hidden" id="add_new_staff">
                        <div class="panel-heading">
                            <h6 class="panel-title">Create Student</h6>
                        </div>

                        <form class="stepy-clickable">
                            <fieldset title="1">
                                <legend class="text-semibold">Personal Details</legend>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stffname" class="form-control btnrqd" placeholder="First Name" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stflname" class="form-control btnrqd" placeholder="Surname" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stfoname" class="form-control" placeholder="Other Name(s)" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text"  id="stfdob" class="form-control btnrqd" placeholder="Date Of Birth (YYYY-MM-DD)" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="gender" id="stfsex" class="form-control btnrqd">
                                                <option value="">Select Gender</option>
                                                <option value="Female">Female</option>
                                                <option value="Male">Male</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="gender" id="stfidtype" class="form-control btnrqd">
                                                <option value="">National ID Type</option>
                                                <option value="Ghana Card">Ghana Card</option>
                                                <option value="National ID">National ID</option>
                                                <option value="Passport">Passport</option>
                                                <option value="Social Security">Social Security</option>
                                                <option value="Voter ID">Voter's ID</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stfidnum" class="form-control btnrqd" placeholder="ID Number" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="confcountry" data-placeholder="Nationality" class="select">
                                                <option></option>
                                                <option value="Ghanaian">Ghanaian</option>
                                                <?php
                                                $countryCount = count($nationalityJSON);
                                                for($i=0; $i < $countryCount; $i++){
                                                    ?>
                                                    <option value="<?php echo $nationalityJSON[$i]; ?>"><?php echo $nationalityJSON[$i]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="confcountry" data-placeholder="Birth Country" class="select">
                                                <option></option>
                                                <option value="Ghana">Ghana</option>
                                                <?php
                                                $countryCount = count($countryJson);
                                                for($i=0; $i < $countryCount; $i++){
                                                    ?>
                                                    <option value="<?php echo $countryJson[$i]; ?>"><?php echo $countryJson[$i]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stfnationality" class="form-control btnrqd" placeholder="Religion" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stfnationality" class="form-control btnrqd" placeholder="Home town" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="confcountry" data-placeholder="Hometown Region" class="select">
                                                <option></option>
                                                <?php
                                                $countryCount = count($regions);
                                                for($i=0; $i < $countryCount; $i++){
                                                    ?>
                                                    <option value="<?php echo $regions[$i]; ?>"><?php echo $regions[$i]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 hidden" id="disability_details">
                                        <div class="form-group">
                                            <input type="text" id="stfdisabletype" class="form-control btnrqd" placeholder="High School" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 hidden" id="disability_details">
                                        <div class="form-group">
                                            <input type="text" id="stfdisabletype" class="form-control btnrqd" placeholder="High School Location" />
                                        </div>
                                    </div>
                                    <div class="col-md-4 hidden" id="disability_details">
                                        <div class="form-group">
                                            <input type="text" id="stfdisabletype" class="form-control btnrqd" placeholder="Program" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="stfdisable" data-placeholder="Select Disability Status" class="select">
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="disability_details">
                                        <div class="form-group">
                                            <input type="text" id="stfdisabletype" class="form-control btnrqd" placeholder="Specific Disability" />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset title="2">
                                <legend class="text-semibold">Admission Details</legend>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stfid" class="form-control btnrqd" placeholder="Student ID Number Or Referrence Number" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="stfinstitution" data-placeholder="Institution" class="select">
                                                <option></option>
                                                <?php
                                                $sel = "SELECT name, institution_code FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                                $selrun = $conn->query($dbcon,$sel);
                                                while($row = $conn->fetch($selrun)){
                                                    ?>
                                                    <option value="<?php echo $row['institution_code']; ?>"><?php echo $row['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="stfacadyear" data-placeholder="Year" class="select">
                                                <option></option>
                                                <?php
                                                $curryear = date("Y");
                                                for($i=$curryear; $i >= ($curryear - 40); $i--){
                                                    ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="stfemptype" data-placeholder="Programme Type" class="select">
                                                <option></option>
                                                <option value="distance">distance</option>
                                                <option value="evening">evening</option>
                                                <option value="regular">regular</option>
                                                <option value="weekend">weekend</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="stftype" data-placeholder="ISCED" class="select">
                                                <option></option>
                                                <?php
                                                $sel = "SELECT code, name FROM isceds WHERE status = 'Active' ORDER BY name ASC";
                                                $selrun = $conn->query($dbcon,$sel);
                                                while($row = $conn->fetch($selrun)){
                                                    ?>
                                                    <option value="<?php echo $row['code']; ?>"><?php echo $row['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="stfemptype" data-placeholder="Select Application Qualification" class="select">
                                                <option></option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="stfemptype" data-placeholder="Select Offer" class="select">
                                                <option></option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stfcollege" class="form-control" placeholder="Programme Offered" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stfcollege" class="form-control" placeholder="Name Of High School" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stfcollege" class="form-control" placeholder="High School Programme" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stfcollege" class="form-control" placeholder="High School Location" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="stfemptype" data-placeholder="Select Acceptance" class="select">
                                                <option></option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select name="institution" id="stfemptype" data-placeholder="Fee Paying" class="select">
                                                <option></option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" align="center" style="margin-bottom: 20px">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="createStaffRecord()">Submit  </button>
                                    </div>
                                </div>

                            </fieldset>
                            <button type="submit" class="btn btn-primary stepy-finish" style="visibility: hidden">Submit <i class="icon-check position-right"></i></button>
                        </form>
                    </div>
                    <!-- /clickable title -->

                    <!-- Clickable title -->
                    <div class="panel panel-white" id="view_staff">
                        <div class="panel-heading">
                            <h6 class="panel-title">Student</h6>
                        </div>
                        <div class="row" style="margin: 20px;">
                            <div class="col-md-6">
                                <div align="left"><a onclick="toggle('add_new_staff','view_staff')" class="btn btn-lg btn-default"><span class="icon icon-plus3"></span>   Add Student</a></div>
                            </div>
                            <div class="col-md-6">
                                <div align="right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-rounded"><i class="icon-database-export position-left"></i> Export</button>
                                        <button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#"><i class="icon-book"></i> CSV</a></li>
                                            <li><a href="#"><i class="icon-file-excel"></i> Excel</a></li>
                                            <li><a href="#"><i class="icon-file-pdf"></i> PDF</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-flat overflow-scroll" style="margin: 10px;">
                                    <table class="table table-hover datatable-basic">
                                        <thead>
                                        <tr style="background-color: #ffffff">
                                            <th colspan="10">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <label>Year</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $curryear = date("Y");
                                                            for($i=$curryear; $i >= ($curryear - 40); $i--){
                                                                ?>
                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Institution</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $sel = "SELECT name, institution_code FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                                            $selrun = $conn->query($dbcon,$sel);
                                                            while($row = $conn->fetch($selrun)){
                                                                ?>
                                                                <option value="<?php echo $row['institution_code']; ?>"><?php echo $row['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Gender</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Qualification</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <option value="BA">BA</option>
                                                            <option value="BBA">BBA</option>
                                                            <option value="BEd">BEd</option>
                                                            <option value="BSc">BSc</option>
                                                            <option value="BTech">BTech</option>
                                                            <option value="Diploma">Diploma</option>
                                                            <option value="HND">HND</option>
                                                            <option value="LLB">LLB</option>
                                                            <option value="MA">MA</option>
                                                            <option value="MBA">MBA</option>
                                                            <option value="MED">MED</option>
                                                            <option value="MSc">MSc</option>
                                                            <option value="PhD">PhD</option>
                                                            <option value="Phil">Phil</option>
                                                            <option value="Other">Other</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Rank</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $sel = "SELECT id, rank FROM staffranks WHERE status = 'Active' ORDER BY rank ASC";
                                                            $selrun = $conn->query($dbcon,$sel);
                                                            while($row = $conn->fetch($selrun)){
                                                                ?>
                                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['rank']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label>Staff Category</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $sel = "SELECT id, staff_type FROM staffcategory WHERE status = 'Active' ORDER BY staff_type ASC";
                                                            $selrun = $conn->query($dbcon,$sel);
                                                            while($row = $conn->fetch($selrun)){
                                                                ?>
                                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['staff_type']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Institution</th>
                                            <th>Application Year (e.g., 2022 refers to 2021/2022 academic year) </th>
                                            <th> National ID Type (e.g. Ghana Card, Passport) </th>
                                            <th> National ID Number (e.g. Ghana Card,Passport) </th>
                                            <th> Student ID Number/ Reference Number </th>
                                            <th>First Name of Applicant</th>
                                            <th>Surname of Applicant</th>
                                            <th>Other Name(s) of Applicant</th>
                                            <th>Gender</th>
                                            <th>Date of Birth (DD/MM/YYYY)</th>
                                            <th>Country Of Birth</th>
                                            <th>Nationality</th>
                                            <th>Religion</th>
                                            <th>Hometown</th>
                                            <th>Home Region</th>
                                            <th> Name of Senior High School (SHS) Attended </th>
                                            <th> Location Of Senior High School (SHS) Attended  </th>
                                            <th> Location Of Senior High School (SHS) Attended  </th>
                                            <th> Title of Programme Applied for (e.g., BSc Computer Science, MA. African Studies, PhD Linguisitcs)</th>
                                            <th> Mode of Study (Indicate whether Regular, Distance, Sandwich, Evening, Weekend etc.) </th>
                                            <th>Did Student Qualify for Admission (Indicate Yes or No) </th>
                                            <th>Was Student Offered Admission  </th>
                                            <th> If Student was offered admission, indicate programme offered (e.g., BSc Earth Science, MSc Business Analytics, PhD African Studies etc.) </th>
                                            <th> Did Student Accept Admission Offer </th>
                                            <th> Fee Paying (Indicate Yes if Student Applied to be full-fee-paying or No if they did not) </th>
                                            <th> Indicate if Applicant has Special Education Needs (indicate Yes or No) </th>
                                            <th> Indicate the Special Education Needs (e.g. Physically Challenged, Visually Impaired)</th>
                                            <th>ISCED</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count= 0;
                                        $sel = "SELECT * FROM appadmissions ORDER BY first_name ASC";
                                        $selrun = $conn->query($dbcon,$sel);
                                        while($row = $conn->fetch($selrun)){
                                            $count++;
                                            $id = $row['id'];
                                            ?>
                                            <tr style="color: <?php echo $color; ?>">
                                                <td><?php echo $row['staff_id']; ?></td>
                                                <td><?php echo $row['title']." ".$row['first_name']." ".$row['surname']." ".$row['other_names']; ?></td>
                                                <td><?php echo $row['institution']; ?></td>
                                                <td><?php echo $row['qualification']; ?></td>
                                                <td><?php echo $row['staff_type']; ?></td>
                                                <td><?php echo $row['rank']; ?></td>
                                                <td><?php echo $row['employment_type']; ?></td>
                                                <td><?php echo $row['nationality']; ?></td>
                                                <td><?php echo $row['gender']; ?></td>
                                                <td>
                                                    <a class="btn btn-danger" onclick="deleteModal(<?php echo $id; ?>,'staff')"><span class="icon icon-trash"></span></a>
                                                    &nbsp;<a class="btn btn-primary" onclick="updateRole(<?php echo $id; ?>)"><span class="icon icon-database-edit2"></span></a></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /clickable title -->
                </div>
                <!-- /content area -->

            </div>
            <?php $conn->close($dbcon);}elseif(isset($_GET['publication'])){
            $conn=new Db_connect;
            $dbcon=$conn->conn();
            $status = "";
            ?>
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header" style="margin: 20px;">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb" style="font-size: medium;">
                            <li style="font-weight: bold; font-size: x-large">Staff </li>
                            <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                            <li class="active"><a href="dashboard.php?staff">Publications</a></li>
                        </ul>
                        <ul class="breadcrumb-elements">
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">
                    <!-- Clickable title -->
                    <div class="panel panel-white hidden" id="add_new_publication">
                        <div class="panel-heading">
                            <h6 class="panel-title">Publications</h6>
                        </div>

                        <form class="stepy-clickable">
                            <fieldset title="1">
                                <legend class="text-semibold">Publication Details</legend>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select name="institution" id="pubinst" data-placeholder="Select Institution" class="select btnrqd" onchange="getStaffDetails(this.value)">
                                                <option></option>
                                                <?php
                                                    $sel = "SELECT institution_code, name FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                                    $selrun = $conn->query($dbcon,$sel);
                                                    if($conn->sqlnum($selrun) == 0){
                                                ?>
                                                <option value="">No Records Found</option>
                                                <?php }else{
                                                        while($data = $conn->fetch($selrun)){
                                                ?>
                                                <option value="<?php echo $data['institution_code'] ?>"><?php echo $data['name']; ?></option>
                                                <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 hidden" align="left">
                                        <div id="staffdetailsloader"><img src="assets/images/spinner.gif" style="width: 30px; height: 30px" /></div>
                                    </div>
                                    <div class="col-md-6" id="stafflisthide">
                                        <div class="form-group">
                                            <select id="stafflist" data-placeholder="Select Staff" class="select">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select id="pubtype" class="form-control btnrqd">
                                                <option value="">Publication Type</option>
                                                <option value="article">article</option>
                                                <option value="chapter">chapter</option>
                                                <option value="edited(book)">edit(book)</option>
                                                <option value="proceeding">proceeding</option>
                                                <option value="monograph or preprint">monograph or preprint</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="pubtitle" class="form-control btnrqd" placeholder="Publication Title" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="pubpublisher" class="form-control btnrqd" placeholder="Publisher Of Publication" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select name="institution" id="pubyear" data-placeholder="Publication Year" class="select">
                                                <option></option>
                                                <?php
                                                $curryear = date("Y");
                                                for($i=$curryear; $i >= ($curryear - 40); $i--){
                                                    ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" align="center" style="margin-bottom: 20px">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="createPublicationRecord()">Submit  </button>
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-primary stepy-finish" style="visibility: hidden">Submit <i class="icon-check position-right"></i></button>
                        </form>
                    </div>
                    <!-- /clickable title -->

                    <!-- Clickable title -->
                    <div class="panel panel-white" id="view_publication">
                        <div class="panel-heading">
                            <h6 class="panel-title">Staff Publications</h6>
                        </div>
                        <div class="row" style="margin: 20px;">
                            <div class="col-md-6">
                                <div align="left"><a onclick="toggle('add_new_publication','view_publication')" class="btn btn-lg btn-default"><span class="icon icon-plus3"></span>   Add Publication</a></div>
                            </div>
                            <div class="col-md-6">
                                <div align="right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-rounded"><i class="icon-database-export position-left"></i> Export</button>
                                        <button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#"><i class="icon-book"></i> CSV</a></li>
                                            <li><a href="#"><i class="icon-file-excel"></i> Excel</a></li>
                                            <li><a href="#"><i class="icon-file-pdf"></i> PDF</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-flat" style="margin: 10px;">
                                    <table class="table table-hover datatable-basic">
                                        <thead>
                                        <tr style="background-color: #ffffff">
                                            <th colspan="10">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Publication Year</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $curryear = date("Y");
                                                            for($i=$curryear; $i >= ($curryear - 40); $i--){
                                                                ?>
                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Institution</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $sel = "SELECT name, institution_code FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                                            $selrun = $conn->query($dbcon,$sel);
                                                            while($row = $conn->fetch($selrun)){
                                                                ?>
                                                                <option value="<?php echo $row['institution_code']; ?>"><?php echo $row['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Publication Type</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="">Publication Type</option>
                                                            <option value="article">article</option>
                                                            <option value="chapter">chapter</option>
                                                            <option value="edited(book)">edit(book)</option>
                                                            <option value="proceeding">proceeding</option>
                                                            <option value="monograph or preprint">monograph or preprint</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Staff ID</th>
                                            <th>Staff Name</th>
                                            <th>Publication Type</th>
                                            <th>Publication Title</th>
                                            <th>Publication Year</th>
                                            <th>Publisher Of Publication</th>
                                            <th>Institution</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count= 0;
                                        $sel = "SELECT * FROM publication ORDER BY createdAt DESC";
                                        $selrun = $conn->query($dbcon,$sel);
                                        while($row = $conn->fetch($selrun)){
                                            $count++;
                                            $id = $row['id'];
                                            $color = "#000000";
                                            ?>
                                            <tr style="color: <?php echo $color; ?>">
                                                <td><?php echo $row['staff_id']; ?></td>
                                                <td><?php echo getStaff($row['staff_id']); ?></td>
                                                <td><?php echo $row['publication_type']; ?></td>
                                                <td><?php echo $row['title']; ?></td>
                                                <td><?php echo $row['publication_year']; ?></td>
                                                <td><?php echo $row['publisher']; ?></td>
                                                <td><?php echo getInstitution($row['institution_id']); ?></td>
                                             </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /clickable title -->
                </div>
                <!-- /content area -->

            </div>
            <?php $conn->close($dbcon);}elseif(isset($_GET['conferences_and_workshops'])){
            $conn=new Db_connect;
            $dbcon=$conn->conn();
            $status = "";
            ?>
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header" style="margin: 20px;">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb" style="font-size: medium;">
                            <li style="font-weight: bold; font-size: x-large">Staff </li>
                            <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                            <li class="active"><a href="dashboard.php?staff">Conferences & Workshops</a></li>
                        </ul>
                        <ul class="breadcrumb-elements">
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">
                    <!-- Clickable title -->
                    <div class="panel panel-white hidden" id="add_new_publication">
                        <div class="panel-heading">
                            <h6 class="panel-title">Conferences And Workshops</h6>
                        </div>

                        <form class="stepy-clickable">
                            <fieldset title="1">
                                <legend class="text-semibold">Conference Or Workshop Details</legend>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select id="confinst" data-placeholder="Select Institution" class="select btnrqd" onchange="getStaffDetails(this.value)">
                                                <option></option>
                                                <?php
                                                $sel = "SELECT institution_code, name FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                                $selrun = $conn->query($dbcon,$sel);
                                                if($conn->sqlnum($selrun) == 0){
                                                    ?>
                                                    <option value="">No Records Found</option>
                                                <?php }else{
                                                    while($data = $conn->fetch($selrun)){
                                                        ?>
                                                        <option value="<?php echo $data['institution_code'] ?>"><?php echo $data['name']; ?></option>
                                                    <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 hidden" align="left">
                                        <div id="staffdetailsloader"><img src="assets/images/spinner.gif" style="width: 30px; height: 30px" /></div>
                                    </div>
                                    <div class="col-md-6" id="stafflisthide">
                                        <div class="form-group">
                                            <select id="stafflist" data-placeholder="Select Staff" class="select">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="conftitle" class="form-control btnrqd" placeholder="Conference" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="conforganizer" class="form-control btnrqd" placeholder="Organizer" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="confvenue" class="form-control btnrqd" placeholder="Venue" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select name="institution" id="confcountry" data-placeholder="Country" class="select">
                                                <option></option>
                                                <?php
                                                $countryCount = count($countryJson);
                                                for($i=0; $i < $countryCount; $i++){
                                                    ?>
                                                    <option value="<?php echo $countryJson[$i]; ?>"><?php echo $countryJson[$i]; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" id="confcity" class="form-control btnrqd" placeholder="City" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input type="date" id="confsdate" class="form-control btnrqd" value="<?php echo date('Y-m-d'); ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input type="date" id="confedate" class="form-control btnrqd" value="<?php echo date('Y-m-d'); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" align="center" style="margin-bottom: 20px">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="createConferenceRecord()">Submit  </button>
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-primary stepy-finish" style="visibility: hidden">Submit <i class="icon-check position-right"></i></button>
                        </form>
                    </div>
                    <!-- /clickable title -->

                    <!-- Clickable title -->
                    <div class="panel panel-white" id="view_publication">
                        <div class="panel-heading">
                            <h6 class="panel-title">Conferences And Workshops</h6>
                        </div>
                        <div class="row" style="margin: 20px;">
                            <div class="col-md-6">
                                <div align="left"><a onclick="toggle('add_new_publication','view_publication')" class="btn btn-lg btn-default"><span class="icon icon-plus3"></span>&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;</a></div>
                            </div>
                            <div class="col-md-6">
                                <div align="right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-rounded"><i class="icon-database-export position-left"></i> Export</button>
                                        <button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#"><i class="icon-book"></i> CSV</a></li>
                                            <li><a href="#"><i class="icon-file-excel"></i> Excel</a></li>
                                            <li><a href="#"><i class="icon-file-pdf"></i> PDF</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-flat" style="margin: 10px;">
                                    <table class="table table-hover datatable-basic">
                                        <thead>
                                        <tr style="background-color: #ffffff">
                                            <th colspan="10">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Year</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $curryear = date("Y");
                                                            for($i=$curryear; $i >= ($curryear - 40); $i--){
                                                                ?>
                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Institution</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $sel = "SELECT name, institution_code FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                                            $selrun = $conn->query($dbcon,$sel);
                                                            while($row = $conn->fetch($selrun)){
                                                                ?>
                                                                <option value="<?php echo $row['institution_code']; ?>"><?php echo $row['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <!--<div class="col-md-4">
                                                        <label>Participant Rank</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="">Publication Type</option>
                                                            <option value="article">article</option>
                                                            <option value="chapter">chapter</option>
                                                            <option value="edited(book)">edit(book)</option>
                                                            <option value="proceeding">proceeding</option>
                                                            <option value="monograph or preprint">monograph or preprint</option>
                                                        </select>
                                                    </div>-->
                                                </div>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Staff ID</th>
                                            <th>Staff Name</th>
                                            <th>Conference</th>
                                            <th>Organizer</th>
                                            <th>Venue</th>
                                            <th>Country</th>
                                            <th>City</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Date Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count= 0;
                                        $sel = "SELECT * FROM conferenceworkshop ORDER BY createdAt DESC";
                                        $selrun = $conn->query($dbcon,$sel);
                                        while($row = $conn->fetch($selrun)){
                                            $count++;
                                            $id = $row['id'];
                                            $color = "#000000";
                                            ?>
                                            <tr style="color: <?php echo $color; ?>">
                                                <td><?php echo $row['staff_id']; ?></td>
                                                <td><?php echo getStaff($row['staff_id']); ?></td>
                                                <td><?php echo $row['conference']; ?></td>
                                                <td><?php echo $row['organizer']; ?></td>
                                                <td><?php echo $row['venue']; ?></td>
                                                <td><?php echo $row['country']; ?></td>
                                                <td><?php echo $row['city']; ?></td>
                                                <td><?php echo $row['start_date']; ?></td>
                                                <td><?php echo $row['end_date']; ?></td>
                                                <td><?php echo $row['createdAt']; ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /clickable title -->
                </div>
                <!-- /content area -->

            </div>
            <?php $conn->close($dbcon);}elseif(isset($_GET['acc_contact'])){
            $conn=new Db_connect;
            $dbcon=$conn->conn();
            $status = "";
            ?>
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header" style="margin: 20px;">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb" style="font-size: medium;">
                            <li style="font-weight: bold; font-size: x-large">Accreditation </li>
                            <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                            <li class="active"><a href="dashboard.php?acc_contact">Contacts</a></li>
                        </ul>
                        <ul class="breadcrumb-elements">
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">
                    <!-- Clickable title -->
                    <div class="panel panel-white hidden" id="add_new_publication">
                        <div class="panel-heading">
                            <h6 class="panel-title">Contacts</h6>
                        </div>

                        <form class="stepy-clickable">
                            <fieldset title="1">
                                <legend class="text-semibold">Contact Details</legend>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select id="continst" data-placeholder="Select Institution" class="select btnrqd">
                                                <option></option>
                                                <?php
                                                $sel = "SELECT institution_code, name FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                                $selrun = $conn->query($dbcon,$sel);
                                                if($conn->sqlnum($selrun) == 0){
                                                    ?>
                                                    <option value="">No Records Found</option>
                                                <?php }else{
                                                    while($data = $conn->fetch($selrun)){
                                                        ?>
                                                        <option value="<?php echo $data['institution_code'] ?>"><?php echo $data['name']; ?></option>
                                                    <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select id="contyear" class="form-control">
                                                <option value="">Academic Year Ending</option>
                                                <?php
                                                $curryear = date("Y");
                                                for($i=$curryear; $i >= ($curryear - 40); $i--){
                                                    ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="conthead" class="form-control btnrqd" placeholder="Name Of Head Of Institution" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="contheadphone" class="form-control btnrqd" placeholder="Phone Of Head Of Institution" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="contheademail" class="form-control btnrqd" placeholder="Email Of Head Of Institution" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="contperson" class="form-control btnrqd" placeholder="Name Of Person Filling Form" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="contpersonphone" class="form-control btnrqd" placeholder="Phone Of Person Filling Form" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="contpersonemail" class="form-control btnrqd" placeholder="Email Of Person Filling Form" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date Of First Accreditation</label>
                                                <input type="date" id="contaccredit" class="form-control btnrqd" value="<?php echo date('Y-m-d'); ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date Accreditation Expires</label>
                                                <input type="date" id="contexpire" class="form-control btnrqd" value="<?php echo date('Y-m-d'); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" align="center" style="margin-bottom: 20px">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="createContactRecord()">Submit  </button>
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-primary stepy-finish" style="visibility: hidden">Submit <i class="icon-check position-right"></i></button>
                        </form>
                    </div>
                    <!-- /clickable title -->

                    <!-- Clickable title -->
                    <div class="panel panel-white" id="view_publication">
                        <div class="panel-heading">
                            <h6 class="panel-title">Contacts</h6>
                        </div>
                        <div class="row" style="margin: 20px;">
                            <div class="col-md-6">
                                <div align="left"><a onclick="toggle('add_new_publication','view_publication')" class="btn btn-lg btn-default"><span class="icon icon-plus3"></span>&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;</a></div>
                            </div>
                            <div class="col-md-6">
                                <div align="right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-rounded"><i class="icon-database-export position-left"></i> Export</button>
                                        <button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#"><i class="icon-book"></i> CSV</a></li>
                                            <li><a href="#"><i class="icon-file-excel"></i> Excel</a></li>
                                            <li><a href="#"><i class="icon-file-pdf"></i> PDF</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-flat" style="margin: 10px; overflow-x:auto;">
                                    <table class="table table-hover datatable-basic">
                                        <thead>
                                        <tr style="background-color: #ffffff">
                                            <th colspan="10">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Year</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $curryear = date("Y");
                                                            for($i=$curryear; $i >= ($curryear - 40); $i--){
                                                                ?>
                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Institution</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $sel = "SELECT name, institution_code FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                                            $selrun = $conn->query($dbcon,$sel);
                                                            while($row = $conn->fetch($selrun)){
                                                                ?>
                                                                <option value="<?php echo $row['institution_code']; ?>"><?php echo $row['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <!--<div class="col-md-4">
                                                        <label>Participant Rank</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="">Publication Type</option>
                                                            <option value="article">article</option>
                                                            <option value="chapter">chapter</option>
                                                            <option value="edited(book)">edit(book)</option>
                                                            <option value="proceeding">proceeding</option>
                                                            <option value="monograph or preprint">monograph or preprint</option>
                                                        </select>
                                                    </div>-->
                                                </div>

                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Academic Year</th>
                                            <th>Institution</th>
                                            <th>Accreditation Date</th>
                                            <th>Expiry Date</th>
                                            <th>Name Of Head</th>
                                            <th>Phone Of Head</th>
                                            <th>E-mail Of Head</th>
                                            <th>Filled By</th>
                                            <th>Filled By Contact</th>
                                            <th>Filled By E-mail</th>
                                            <th>Date Created</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count= 0;
                                        $sel = "SELECT * FROM contacts ORDER BY createdAt DESC";
                                        $selrun = $conn->query($dbcon,$sel);
                                        while($row = $conn->fetch($selrun)){
                                            $count++;
                                            $id = $row['id'];
                                            $color = "#000000";
                                            ?>
                                            <tr style="color: <?php echo $color; ?>">
                                                <td><?php echo $row['academic_year']; ?></td>
                                                <td><?php echo getInstitution($row['institution']); ?></td>
                                                <td><?php echo $row['date_first_accreditation']; ?></td>
                                                <td><?php echo $row['date_accreditation_expires']; ?></td>
                                                <td><?php echo $row['name_of_head']; ?></td>
                                                <td><?php echo $row['phone_of_head']; ?></td>
                                                <td><?php echo $row['email_of_head']; ?></td>
                                                <td><?php echo $row['filled_by_name']; ?></td>
                                                <td><?php echo $row['filled_by_phone']; ?></td>
                                                <td><?php echo $row['filled_by_email']; ?></td>
                                                <td><?php echo $row['createdAt']; ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /clickable title -->
                </div>
                <!-- /content area -->

            </div>
            <?php $conn->close($dbcon);}elseif(isset($_GET['acc_programs'])){
            $conn=new Db_connect;
            $dbcon=$conn->conn();
            $status = "";
            ?>
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header" style="margin: 20px;">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb" style="font-size: medium;">
                            <li style="font-weight: bold; font-size: x-large">Accreditation </li>
                            <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                            <li class="active"><a href="dashboard.php?acc_programs">Programmes</a></li>
                        </ul>
                        <ul class="breadcrumb-elements">
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">
                    <!-- Clickable title -->
                    <div class="panel panel-white hidden" id="add_new_publication">
                        <div class="panel-heading">
                            <h6 class="panel-title">Programmes</h6>
                        </div>

                        <form class="stepy-clickable">
                            <fieldset title="1">
                                <legend class="text-semibold">Program Details</legend>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select id="proginst" data-placeholder="Select Institution" class="select btnrqd">
                                                <option></option>
                                                <?php
                                                $sel = "SELECT institution_code, name FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                                $selrun = $conn->query($dbcon,$sel);
                                                if($conn->sqlnum($selrun) == 0){
                                                    ?>
                                                    <option value="">No Records Found</option>
                                                <?php }else{
                                                    while($data = $conn->fetch($selrun)){
                                                        ?>
                                                        <option value="<?php echo $data['institution_code'] ?>"><?php echo $data['name']; ?></option>
                                                    <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select id="progyear" class="form-control">
                                                <option value="">Academic Year</option>
                                                <?php
                                                $curryear = date("Y");
                                                for($i=$curryear; $i >= ($curryear - 40); $i--){
                                                    ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="progcollege" class="form-control btnrqd" placeholder="College" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="progfaculty" class="form-control btnrqd" placeholder="Faculty Or School" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="progdept" class="form-control btnrqd" placeholder="Department" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="progtitle" class="form-control btnrqd" placeholder="Programme Title" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="progisced" class="select" data-placeholder="ISCED">
                                            <option></option>
                                            <?php
                                            $sel = "SELECT name, code FROM isceds WHERE status = 'Active' ORDER BY name ASC";
                                            $selrun = $conn->query($dbcon,$sel);
                                            while($row = $conn->fetch($selrun)){
                                                ?>
                                                <option value="<?php echo $row['code']; ?>"><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Accredited Date</label>
                                                <input type="date" id="progaccredit" class="form-control btnrqd" value="<?php echo date('Y-m-d'); ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Expiration Date</label>
                                                <input type="date" id="progexpire" class="form-control btnrqd" value="<?php echo date('Y-m-d'); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" align="center" style="margin-bottom: 20px">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="createProgramRecord()">Submit  </button>
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-primary stepy-finish" style="visibility: hidden">Submit <i class="icon-check position-right"></i></button>
                        </form>
                    </div>
                    <!-- /clickable title -->

                    <!-- Clickable title -->
                    <div class="panel panel-white" id="view_publication">
                        <div class="panel-heading">
                            <h6 class="panel-title">Programmes</h6>
                        </div>
                        <div class="row" style="margin: 20px;">
                            <div class="col-md-6">
                                <div align="left"><a onclick="toggle('add_new_publication','view_publication')" class="btn btn-lg btn-default"><span class="icon icon-plus3"></span>&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;</a></div>
                            </div>
                            <div class="col-md-6">
                                <div align="right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-rounded"><i class="icon-database-export position-left"></i> Export</button>
                                        <button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#"><i class="icon-book"></i> CSV</a></li>
                                            <li><a href="#"><i class="icon-file-excel"></i> Excel</a></li>
                                            <li><a href="#"><i class="icon-file-pdf"></i> PDF</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-flat" style="margin: 10px; overflow-x:auto;">
                                    <table class="table table-hover datatable-basic">
                                        <thead>
                                        <tr style="background-color: #ffffff">
                                            <th colspan="10">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Accreditation Year</label>
                                                        <select name="institution" id="stfacadyear" class="select">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $curryear = date("Y");
                                                            for($i=$curryear; $i >= ($curryear - 40); $i--){
                                                                ?>
                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Institution</label>
                                                        <select name="institution" id="stfacadyear" class="select">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $sel = "SELECT name, institution_code FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                                            $selrun = $conn->query($dbcon,$sel);
                                                            while($row = $conn->fetch($selrun)){
                                                                ?>
                                                                <option value="<?php echo $row['institution_code']; ?>"><?php echo $row['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>ISCED</label>
                                                        <select name="institution" id="stfacadyear" class="select">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $sel = "SELECT name, code FROM isceds WHERE status = 'Active' ORDER BY name ASC";
                                                            $selrun = $conn->query($dbcon,$sel);
                                                            while($row = $conn->fetch($selrun)){
                                                                ?>
                                                                <option value="<?php echo $row['code']; ?>"><?php echo $row['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <!--<div class="col-md-4">
                                                        <label>Participant Rank</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="">Publication Type</option>
                                                            <option value="article">article</option>
                                                            <option value="chapter">chapter</option>
                                                            <option value="edited(book)">edit(book)</option>
                                                            <option value="proceeding">proceeding</option>
                                                            <option value="monograph or preprint">monograph or preprint</option>
                                                        </select>
                                                    </div>-->
                                                </div>

                                            </th>
                                        </tr>
                                        <tr>

                                            <th>Institution</th>
                                            <th>Accreditation Year</th>
                                            <th>College</th>
                                            <th>Faculty / School</th>
                                            <th>Department</th>
                                            <th>Title Of Program</th>
                                            <th>ISCED</th>
                                            <th>Date Program Was Accredited</th>
                                            <th>Date Program Accreditation Expires</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count= 0;
                                        $sel = "SELECT * FROM programmes ORDER BY institution ASC";
                                        $selrun = $conn->query($dbcon,$sel);
                                        while($row = $conn->fetch($selrun)){
                                            $count++;
                                            $id = $row['id'];
                                            $color = "#000000";
                                            ?>
                                            <tr style="color: <?php echo $color; ?>">
                                                <td><?php echo getInstitution($row['institution']); ?></td>
                                                <td><?php echo $row['accreditation_year']; ?></td>
                                                <td><?php echo $row['college']; ?></td>
                                                <td><?php echo $row['faculty_school']; ?></td>
                                                <td><?php echo $row['department']; ?></td>
                                                <td><?php echo $row['programme']; ?></td>
                                                <td><?php echo getIsced($row['programme_isced_code']); ?></td>
                                                <td><?php echo $row['accredited_date']; ?></td>
                                                <td><?php echo $row['expiration_date']; ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /clickable title -->
                </div>
                <!-- /content area -->

            </div>
            <?php $conn->close($dbcon);}elseif(isset($_GET['acc_proposed_programs'])){
            $conn=new Db_connect;
            $dbcon=$conn->conn();
            $status = "";
            ?>
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header" style="margin: 20px;">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb" style="font-size: medium;">
                            <li style="font-weight: bold; font-size: x-large">Accreditation </li>
                            <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                            <li class="active"><a href="dashboard.php?acc_programs">Proposed</a></li>
                        </ul>
                        <ul class="breadcrumb-elements">
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">
                    <!-- Clickable title -->
                    <div class="panel panel-white hidden" id="add_new_publication">
                        <div class="panel-heading">
                            <h6 class="panel-title">Create Accreditation Proposed</h6>
                        </div>

                        <form class="stepy-clickable">
                            <fieldset title="1">
                                <legend class="text-semibold">Accreditation Details</legend>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select id="propinst" data-placeholder="Select Institution" class="select btnrqd">
                                                <option></option>
                                                <?php
                                                $sel = "SELECT institution_code, name FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                                $selrun = $conn->query($dbcon,$sel);
                                                if($conn->sqlnum($selrun) == 0){
                                                    ?>
                                                    <option value="">No Records Found</option>
                                                <?php }else{
                                                    while($data = $conn->fetch($selrun)){
                                                        ?>
                                                        <option value="<?php echo $data['institution_code'] ?>"><?php echo $data['name']; ?></option>
                                                    <?php }} ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select id="propyear" class="form-control">
                                                <option value="">Academic Year</option>
                                                <?php
                                                $curryear = date("Y");
                                                for($i=$curryear; $i >= ($curryear - 40); $i--){
                                                    ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="propcollege" class="form-control btnrqd" placeholder="College" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="propfaculty" class="form-control btnrqd" placeholder="Faculty Or School" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="propdept" class="form-control btnrqd" placeholder="Department" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="proptitle" class="form-control btnrqd" placeholder="Programme Title" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <select id="propisced" class="select" data-placeholder="ISCED">
                                            <option></option>
                                            <?php
                                            $sel = "SELECT name, code FROM isceds WHERE status = 'Active' ORDER BY name ASC";
                                            $selrun = $conn->query($dbcon,$sel);
                                            while($row = $conn->fetch($selrun)){
                                                ?>
                                                <option value="<?php echo $row['code']; ?>"><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" align="center" style="margin-bottom: 20px">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="createProposedRecord()">Submit  </button>
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-primary stepy-finish" style="visibility: hidden">Submit <i class="icon-check position-right"></i></button>
                        </form>
                    </div>
                    <!-- /clickable title -->

                    <!-- Clickable title -->
                    <div class="panel panel-white" id="view_publication">
                        <div class="panel-heading">
                            <h6 class="panel-title">Proposed Programmes</h6>
                        </div>
                        <div class="row" style="margin: 20px;">
                            <div class="col-md-6">
                                <div align="left"><a onclick="toggle('add_new_publication','view_publication')" class="btn btn-lg btn-default"><span class="icon icon-plus3"></span>&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;</a></div>
                            </div>
                            <div class="col-md-6">
                                <div align="right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info btn-rounded"><i class="icon-database-export position-left"></i> Export</button>
                                        <button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="#"><i class="icon-book"></i> CSV</a></li>
                                            <li><a href="#"><i class="icon-file-excel"></i> Excel</a></li>
                                            <li><a href="#"><i class="icon-file-pdf"></i> PDF</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-flat" style="margin: 10px; overflow-x:auto;">
                                    <table class="table table-hover datatable-basic">
                                        <thead>
                                        <tr style="background-color: #ffffff">
                                            <th colspan="10">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>Accreditation Year</label>
                                                        <select name="institution" id="stfacadyear" class="select">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $curryear = date("Y");
                                                            for($i=$curryear; $i >= ($curryear - 40); $i--){
                                                                ?>
                                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Institution</label>
                                                        <select name="institution" id="stfacadyear" class="select">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $sel = "SELECT name, institution_code FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                                            $selrun = $conn->query($dbcon,$sel);
                                                            while($row = $conn->fetch($selrun)){
                                                                ?>
                                                                <option value="<?php echo $row['institution_code']; ?>"><?php echo $row['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>ISCED</label>
                                                        <select name="institution" id="stfacadyear" class="select">
                                                            <option value="All">All</option>
                                                            <?php
                                                            $sel = "SELECT name, code FROM isceds WHERE status = 'Active' ORDER BY name ASC";
                                                            $selrun = $conn->query($dbcon,$sel);
                                                            while($row = $conn->fetch($selrun)){
                                                                ?>
                                                                <option value="<?php echo $row['code']; ?>"><?php echo $row['name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <!--<div class="col-md-4">
                                                        <label>Participant Rank</label>
                                                        <select name="institution" id="stfacadyear" class="form-control">
                                                            <option value="">Publication Type</option>
                                                            <option value="article">article</option>
                                                            <option value="chapter">chapter</option>
                                                            <option value="edited(book)">edit(book)</option>
                                                            <option value="proceeding">proceeding</option>
                                                            <option value="monograph or preprint">monograph or preprint</option>
                                                        </select>
                                                    </div>-->
                                                </div>

                                            </th>
                                        </tr>
                                        <tr>

                                            <th>Institution</th>
                                            <th>Accreditation Year</th>
                                            <th>College</th>
                                            <th>Faculty / School</th>
                                            <th>Department</th>
                                            <th>Title Of Program</th>
                                            <th>ISCED</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count= 0;
                                        $sel = "SELECT * FROM proposed ORDER BY institution ASC";
                                        $selrun = $conn->query($dbcon,$sel);
                                        while($row = $conn->fetch($selrun)){
                                            $count++;
                                            $id = $row['id'];
                                            $color = "#000000";
                                            ?>
                                            <tr style="color: <?php echo $color; ?>">
                                                <td><?php echo getInstitution($row['institution']); ?></td>
                                                <td><?php echo $row['accreditation_year']; ?></td>
                                                <td><?php echo $row['college']; ?></td>
                                                <td><?php echo $row['faculty_school']; ?></td>
                                                <td><?php echo $row['department']; ?></td>
                                                <td><?php echo $row['programme']; ?></td>
                                                <td><?php echo getIsced($row['programme_isced_code']); ?></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /clickable title -->
                </div>
                <!-- /content area -->

            </div>
            <?php $conn->close($dbcon);}elseif(isset($_GET['institution_category'])){
            $conn=new Db_connect;
            $dbcon=$conn->conn();
            $status = "";
            if(isset($_GET['status'])){
                $status = $_GET['status'];
            }
            ?>
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header" style="margin: 20px;">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb" style="font-size: medium;">
                            <li style="font-weight: bold; font-size: x-large">Institution </li>
                            <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                            <li class="active"><a href="dashboard.php?institution_category">Category</a></li>
                        </ul>
                        <ul class="breadcrumb-elements">
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">
                    <!-- Clickable title -->
                    <div class="panel panel-white hidden" id="add_new_instcat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Create Category For Institutes</h6>
                        </div>

                        <form class="stepy-clickable">
                            <fieldset title="1">
                                <legend class="text-semibold">Category Details</legend>

                                <div class="row">
                                    <div class="col-md-4">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="catname" class="form-control" placeholder="Category Name" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <textarea id="catdescript" placeholder="Description" class="form-control" maxlength="200" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" align="center">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="createInstCat()">Submit  </button>
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-primary stepy-finish" style="visibility: hidden">Submit <i class="icon-check position-right"></i></button>
                        </form>
                    </div>
                    <!-- /clickable title -->

                    <!-- Clickable title -->
                    <div class="panel panel-white" id="view_instcat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Institution Category</h6>
                        </div>
                        <div class="row" style="margin: 20px;">
                            <div class="col-md-6">
                                <div align="left"><a onclick="toggle('add_new_instcat','view_instcat')" class="btn btn-lg btn-default"><span class="icon icon-plus3"></span>   Add Category</a></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-flat" style="margin: 10px;">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count= 0;
                                        $sel = "SELECT id, name, description, status FROM institute_categories ORDER BY name ASC";
                                        $selrun = $conn->query($dbcon,$sel);
                                        while($row = $conn->fetch($selrun)){
                                            $count++;
                                            $id = $row['id'];
                                            $status = $row['status'];
                                            $color = "#000000";
                                            if($status == "Inactive"){
                                                $color = "#6B8139";
                                            }
                                            ?>
                                            <tr style="color: <?php echo $color; ?>">
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['name']; ?></td>
                                                <td><?php echo $row['description']; ?></td>
                                                <td>
                                                    <?php if($status == "Active"){ ?><a class="btn btn-danger" onclick="deleteModal(<?php echo $id; ?>,'institute_categories')"><span class="icon icon-trash"></span></a><?php } ?>
                                                    &nbsp;&nbsp;&nbsp;<a class="btn btn-primary" onclick="getInstitutionCategory(<?php echo $id; ?>)"><span class="icon icon-database-edit2"></span></a></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /clickable title -->
                </div>
                <!-- /content area -->

            </div>
            <?php $conn->close($dbcon);}elseif(isset($_GET['staff_category'])){
            $conn=new Db_connect;
            $dbcon=$conn->conn();
            $status = "";
            if(isset($_GET['status'])){
                $status = $_GET['status'];
            }
            ?>
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header" style="margin: 20px;">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb" style="font-size: medium;">
                            <li style="font-weight: bold; font-size: x-large">Staff </li>
                            <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                            <li class="active"><a href="dashboard.php?staff_category">Category</a></li>
                        </ul>
                        <ul class="breadcrumb-elements">
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">
                    <!-- Clickable title -->
                    <div class="panel panel-white hidden" id="add_new_staffcat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Create Category For Staff</h6>
                        </div>

                        <form class="stepy-clickable">
                            <fieldset title="1">
                                <legend class="text-semibold">Category Details</legend>

                                <div class="row">
                                    <div class="col-md-4">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="stcatname" class="form-control" placeholder="Staff Category Name" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <select id="strankname"  data-placeholder="Select Rank" class="select btnrqd">
                                                <option value=""></option>
                                                <?php
                                                $sel = "SELECT rank, id FROM staffranks ORDER BY rank ASC";
                                                $selrun = $conn->query($dbcon,$sel);
                                                while($row = $conn->fetch($selrun)){
                                                    ?>
                                                    <option value="<?php echo $row['id']."*".$row['rank']; ?>"><?php echo $row['rank']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4" align="left"><button type="button" onclick="addRank()" class="btn" style="background-color: rgba(2,47,173,0.98); color: #ffffff;">Add</button></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">&nbsp;</div>
                                    <div class="col-md-4" id="catrank"></div>
                                    <div class="col-md-4">&nbsp;</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" align="center">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="createStaffCat()">Submit  </button>
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-primary stepy-finish" style="visibility: hidden">Submit <i class="icon-check position-right"></i></button>
                        </form>
                    </div>
                    <!-- /clickable title -->

                    <!-- Clickable title -->
                    <div class="panel panel-white" id="view_staffcat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Staff Category</h6>
                        </div>
                        <div class="row" style="margin: 20px;">
                            <div class="col-md-6">
                                <div align="left"><a onclick="toggle('add_new_staffcat','view_staffcat')" class="btn btn-lg btn-default"><span class="icon icon-plus3"></span>   Add Staff Category</a></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-flat" style="margin: 10px;">
                                    <table class="table table-hover datatable-basic">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Rank(s)</th>
                                            <th>Status</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count= 0;
                                        $sel = "SELECT id, staff_type, ranks, status FROM staffcategory WHERE status='Active' ORDER BY staff_type ASC";
                                        $selrun = $conn->query($dbcon,$sel);
                                        while($row = $conn->fetch($selrun)){
                                            $count++;
                                            $id = $row['id'];
                                            $status = $row['status'];
                                            $color = "#000000";
                                            if($status == "Inactive"){
                                                $color = "#6B8139";
                                            }
                                            ?>
                                            <tr style="color: <?php echo $color; ?>">
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['staff_type']; ?></td>
                                                <td>
                                                    <?php
                                                        $dranks = $row['ranks'];
                                                        //GET THE ARRAY LENGTH
                                                        $obj = explode(",",$dranks);
                                                        for($i=0; $i < count($obj); $i++){
                                                            //print $obj[$i]."<br/>";
                                                            print "<span class='badge badge-flat border-green-800 text-green-800' style='font-size: small;'>".getRank($obj[$i])."</span>&nbsp;&nbsp;";
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $row['status']; ?></td>
                                                <td align="right"><a class="btn" onclick="getInstitutionCategory(<?php echo $id; ?>)" data-popup="tooltip" title="Edit" data-placement="bottom"><span class="icon icon-database-edit2"></span></a></td>
                                                <td align="left"><a class="btn" onclick="deleteModal(<?php echo $id; ?>,'staffcategory')" data-popup="tooltip" title="Delete" data-placement="bottom"><span class="icon icon-trash-alt"></span></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /clickable title -->
                </div>
                <!-- /content area -->

            </div>
            <?php $conn->close($dbcon);}elseif(isset($_GET['staff_ranks'])){
            $conn=new Db_connect;
            $dbcon=$conn->conn();
            $status = "";
            ?>
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header" style="margin: 20px;">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb" style="font-size: medium;">
                            <li style="font-weight: bold; font-size: x-large">Staff </li>
                            <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                            <li class="active"><a href="dashboard.php?staff_ranks">Ranks</a></li>
                        </ul>
                        <ul class="breadcrumb-elements">
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                            <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">
                    <!-- Clickable title -->
                    <div class="panel panel-white hidden" id="add_new_staffrank">
                        <div class="panel-heading">
                            <h6 class="panel-title">Create Rank For Staff</h6>
                        </div>

                        <form class="stepy-clickable">
                            <fieldset title="1">
                                <legend class="text-semibold">Rank Details</legend>
                                <div class="row">
                                    <div class="col-md-4">&nbsp;</div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" id="drankname" class="form-control" placeholder="Add Rank" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" align="center">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="createRank()">Submit  </button>
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-primary stepy-finish" style="visibility: hidden">Submit <i class="icon-check position-right"></i></button>
                        </form>
                    </div>
                    <!-- /clickable title -->

                    <!-- Clickable title -->
                    <div class="panel panel-white" id="view_staffrank">
                        <div class="panel-heading">
                            <h6 class="panel-title">Staff Ranks</h6>
                        </div>
                        <div class="row" style="margin: 20px;">
                            <div class="col-md-6">
                                <div align="left"><a onclick="toggle('add_new_staffrank','view_staffrank')" class="btn btn-lg btn-default"><span class="icon icon-plus3"></span>   Add Staff Rank</a></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-flat" style="margin: 10px;">
                                    <table class="table table-hover datatable-basic">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Rank</th>
                                            <th>Status</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count= 0;
                                        $sel = "SELECT id, rank, status FROM staffranks ORDER BY rank ASC";
                                        $selrun = $conn->query($dbcon,$sel);
                                        while($row = $conn->fetch($selrun)){
                                            $count++;
                                            $id = $row['id'];
                                            $status = $row['status'];
                                            $color = "#000000";
                                            if($status == "Inactive"){
                                                $color = "#6B8139";
                                            }
                                            ?>
                                            <tr style="color: <?php echo $color; ?>">
                                                <td><?php echo $count; ?></td>
                                                <td><?php echo $row['rank']; ?></td>
                                                <td><?php echo $row['status']; ?></td>
                                                <td align="right"><a class="btn" onclick="getStaffRank(<?php echo $id; ?>)" data-popup="tooltip" title="Edit" data-placement="bottom"><span class="icon icon-database-edit2"></span></a></td>
                                                <td align="left"><a class="btn" onclick="deleteModal(<?php echo $id; ?>,'staffranks')" data-popup="tooltip" title="Delete" data-placement="bottom"><span class="icon icon-trash-alt"></span></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /clickable title -->
                </div>
                <!-- /content area -->

            </div>
            <?php $conn->close($dbcon);}elseif(isset($_GET['profile'])){
            $conn=new Db_connect;
            $dbcon=$conn->conn();
            ?>
            <div class="content-wrapper">
                <!-- Page header -->
                <div class="page-header" style="margin: 20px;">
                    <div class="breadcrumb-line">
                        <ul class="breadcrumb" style="font-size: medium;">
                            <li style="font-weight: bold; font-size: x-large">User </li>
                            <li class="active"><a>Profile</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /page header -->
                <!-- Content area -->
                <div class="content">

                    <!-- User profile -->
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="thumbnail">
                                <div class="thumb thumb-rounded thumb-slide">
                                    <img src="assets/images/logo.png" alt="">
                                </div>

                                <div class="caption text-center">
                                    <h6 class="text-semibold no-margin"><?php echo $fname." ".$lname; ?> <small class="display-block"><?php echo getRole($roleid); ?></small> <small class="display-block"><?php echo getInstitution($institution); ?></small></h6>
                                    <ul class="icons-list mt-15">
                                        <li><a href="#" data-popup="tooltip" title="Google Drive"><i class="icon-google-drive"></i></a></li>
                                        <li><a href="#" data-popup="tooltip" title="Twitter"><i class="icon-twitter"></i></a></li>
                                        <li><a href="#" data-popup="tooltip" title="Github"><i class="icon-github"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="tabbable">
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="activity">

                                        <!-- Timeline -->
                                        <div class="timeline timeline-left content-group">
                                            <div class="timeline-container">


                                                <!-- Invoices -->
                                                <div class="timeline-row">
                                                    <div class="timeline-icon">
                                                        <div class="bg-primary-400">
                                                            <i class="icon-user-lock"></i>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <div class="panel border-left-lg border-left-danger invoice-grid timeline-content">
                                                                <div class="panel-body">
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <h6 class="text-semibold no-margin-top">Password Update</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <label for="uname">Username</label>
                                                                            <input readonly id="unamechg" value="<?php echo $uname; ?>" type="text" class="form-control" />
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label for="uname">Current Password</label>
                                                                            <input type="password" id="curpassword" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-sm-6">
                                                                            <label for="uname">New Password</label>
                                                                            <input type="password" id="newpassword" class="form-control" />
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label for="uname">Repeat New Password</label>
                                                                            <input type="password" id="repeatpassword" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="panel-footer" style="padding: 20px;">

                                                                    <button class="btn btn-primary btn-sm" type="button" onclick="updatePassword()">Update Password</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /invoices -->



                                            </div>
                                        </div>
                                        <!-- /timeline -->

                                    </div>


                                    <div class="tab-pane fade" id="schedule">

                                        <!-- Available hours -->
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">Available hours</h6>
                                                <div class="heading-elements">
                                                    <ul class="icons-list">
                                                        <li><a data-action="collapse"></a></li>
                                                        <li><a data-action="reload"></a></li>
                                                        <li><a data-action="close"></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <div class="chart-container">
                                                    <div class="chart has-fixed-height" id="plans"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /available hours -->


                                        <!-- Calendar -->
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">My schedule</h6>
                                                <div class="heading-elements">
                                                    <ul class="icons-list">
                                                        <li><a data-action="collapse"></a></li>
                                                        <li><a data-action="reload"></a></li>
                                                        <li><a data-action="close"></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <div class="schedule"></div>
                                            </div>
                                        </div>
                                        <!-- /calendar -->

                                    </div>


                                    <div class="tab-pane fade" id="settings">

                                        <!-- Profile info -->
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">Profile information</h6>
                                                <div class="heading-elements">
                                                    <ul class="icons-list">
                                                        <li><a data-action="collapse"></a></li>
                                                        <li><a data-action="reload"></a></li>
                                                        <li><a data-action="close"></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <form action="#">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Username</label>
                                                                <input type="text" value="Eugene" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Full name</label>
                                                                <input type="text" value="Kopyov" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Address line 1</label>
                                                                <input type="text" value="Ring street 12" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Address line 2</label>
                                                                <input type="text" value="building D, flat #67" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>City</label>
                                                                <input type="text" value="Munich" class="form-control">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>State/Province</label>
                                                                <input type="text" value="Bayern" class="form-control">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>ZIP code</label>
                                                                <input type="text" value="1031" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Email</label>
                                                                <input type="text" readonly="readonly" value="eugene@kopyov.com" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label>Your country</label>
                                                                <select class="select">
                                                                    <option value="germany" selected="selected">Germany</option>
                                                                    <option value="france">France</option>
                                                                    <option value="spain">Spain</option>
                                                                    <option value="netherlands">Netherlands</option>
                                                                    <option value="other">...</option>
                                                                    <option value="uk">United Kingdom</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Phone #</label>
                                                                <input type="text" value="+99-99-9999-9999" class="form-control">
                                                                <span class="help-block">+99-99-9999-9999</span>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label>Upload profile image</label>
                                                                <input type="file" class="file-styled">
                                                                <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /profile info -->


                                        <!-- Account settings -->
                                        <div class="panel panel-flat">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">Account settings</h6>
                                                <div class="heading-elements">
                                                    <ul class="icons-list">
                                                        <li><a data-action="collapse"></a></li>
                                                        <li><a data-action="reload"></a></li>
                                                        <li><a data-action="close"></a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="panel-body">
                                                <form action="#">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Username</label>
                                                                <input type="text" value="Kopyov" readonly="readonly" class="form-control">
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label>Current password</label>
                                                                <input type="password" value="password" readonly="readonly" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>New password</label>
                                                                <input type="password" placeholder="Enter new password" class="form-control">
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label>Repeat password</label>
                                                                <input type="password" placeholder="Repeat new password" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <label>Profile visibility</label>

                                                                <div class="radio">
                                                                    <label>
                                                                        <input type="radio" name="visibility" class="styled" checked="checked">
                                                                        Visible to everyone
                                                                    </label>
                                                                </div>

                                                                <div class="radio">
                                                                    <label>
                                                                        <input type="radio" name="visibility" class="styled">
                                                                        Visible to friends only
                                                                    </label>
                                                                </div>

                                                                <div class="radio">
                                                                    <label>
                                                                        <input type="radio" name="visibility" class="styled">
                                                                        Visible to my connections only
                                                                    </label>
                                                                </div>

                                                                <div class="radio">
                                                                    <label>
                                                                        <input type="radio" name="visibility" class="styled">
                                                                        Visible to my colleagues only
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label>Notifications</label>

                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" class="styled" checked="checked">
                                                                        Password expiration notification
                                                                    </label>
                                                                </div>

                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" class="styled" checked="checked">
                                                                        New message notification
                                                                    </label>
                                                                </div>

                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" class="styled" checked="checked">
                                                                        New task notification
                                                                    </label>
                                                                </div>

                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" class="styled">
                                                                        New contact request notification
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-right">
                                                        <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /account settings -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /user profile -->


                    <!-- Footer -->
                    <div class="footer text-muted">
                        &copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
                    </div>
                    <!-- /footer -->

                </div>
                <!-- /content area -->

            </div>
            <?php $conn->close($dbcon);}elseif(isset($_GET['users'])){
                $conn=new Db_connect;
                $dbcon=$conn->conn();
                ?>
                <div class="content-wrapper">
                    <!-- Page header -->
                    <div class="page-header" style="margin: 20px;">
                        <div class="breadcrumb-line">
                            <ul class="breadcrumb" style="font-size: medium;">
                                <li style="font-weight: bold; font-size: x-large">Accounts </li>
                                <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                                <li class="active"><a href="dashboard.php?users">Users</a></li>
                            </ul>
                            <ul class="breadcrumb-elements">
                                <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                                <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /page header -->
                    <!-- Content area -->
                    <div class="content">
                        <!-- Clickable title -->
                        <div class="panel panel-white hidden" id="add_new_user">
                            <div class="panel-heading">
                                <h6 class="panel-title">Add New User</h6>
                            </div>

                            <form class="stepy-clickable" action="#">
                                <fieldset title="1">
                                    <legend class="text-semibold">Personal data</legend>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>First Name:<b class="rqd">*</b></label>
                                                <input type="text" id="fname" class="form-control" required />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Last Name:<b class="rqd">*</b></label>
                                                <input type="text" id="lname" class="form-control" required />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Phone Number:<b class="rqd">*</b></label>
                                                <input type="text" id="contact" class="form-control" required />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>E-mail:<b class="rqd">*</b></label>
                                                <input type="text" id="email" class="form-control" required />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Institution:<b class="rqd">*</b></label>
                                                <select name="institution" id="institution" data-placeholder="Select User Institution" class="select">
                                                    <option></option>
                                                    <?php
                                                    $sel = "SELECT name, institution_code FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                                    $selrun = $conn->query($dbcon,$sel);
                                                    while($row = $conn->fetch($selrun)){
                                                        ?>
                                                        <option value="<?php echo $row['institution_code']; ?>"><?php echo $row['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset title="2">
                                    <legend class="text-semibold">Account Details</legend>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Account Type:<b class="rqd">*</b></label>
                                                <select name="account-type" id="actype" data-placeholder="Choose Account Type" class="select">
                                                    <option></option>
                                                    <option value="GTEC">GTEC</option>
                                                    <option value="Institution">Institution</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>User Role:<b class="rqd">*</b></label>
                                                <select name="experience-from-month" id="role" data-placeholder="Select User Role" class="select">
                                                    <option></option>
                                                    <?php
                                                    $sel = "SELECT role, id FROM roles WHERE status = 'Active' ORDER BY role ASC";
                                                    $selrun = $conn->query($dbcon,$sel);
                                                    while($row = $conn->fetch($selrun)){
                                                    ?>
                                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['role']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Password:<b class="rqd">*</b></label>
                                                <input type="password" id="password" id="email" class="form-control" required />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Confirmation Password:<b class="rqd">*</b></label>
                                                <input type="password" id="confpassword" id="email" class="form-control" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p style="font-weight: bold; text-align: left; font-size: large">Assign User Page Access</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <ul id="tree1">
                                                <li><input type="checkbox" name="access" value="Home"/> <a href="#">Home</a>
                                                    <ul></ul>
                                                </li>
                                                <li><input type="checkbox" name="access" value="ISCED" /> <a href="#">ISCED</a>
                                                    <ul></ul>
                                                </li>
                                                <li><input type="checkbox"  name="access" value="Locations"/> <a href="#">Locations</a>
                                                    <ul></ul>
                                                </li>
                                                <li>Institutions
                                                    <ul>
                                                        <li><input type="checkbox" name="access" value="Institution Category" /> Institution Category</li>
                                                        <li><input type="checkbox" name="access" value="Institution" /> Institutions</li>
                                                    </ul>
                                                </li>
                                                <li>Accreditation
                                                    <ul>
                                                            <li><input type="checkbox"  name="access" value="Contact"/> Contact</li>
                                                        <li><input type="checkbox"  name="access" value="Programs"/> Programs</li>
                                                        <li><input type="checkbox"  name="access" value="Proposed"/> Proposed</li>
                                                    </ul>
                                                </li>
                                                <li>Staff
                                                    <ul>
                                                        <li><input type="checkbox"  name="access" value="Staff Category"/> Staff Category</li>
                                                        <li><input type="checkbox"  name="access" value="Staff"/> Staff</li>
                                                        <li><input type="checkbox"  name="access" value="Publications"/> Publications</li>
                                                    </ul>
                                                </li>
                                                <li>Students
                                                    <ul>
                                                        <li><input type="checkbox"  name="access" value="Applications"/> Application And Admissions</li>
                                                        <li><input type="checkbox"  name="access" value="Enrollments"/> Enrollments</li>
                                                        <li><input type="checkbox"  name="access" value="Graduations"/> Graduations</li>
                                                    </ul>
                                                </li>
                                                <li>Reports
                                                    <ul>
                                                        <li><input type="checkbox"  name="access" value="Summary Report"/> Summary</li>
                                                        <li><input type="checkbox"  name="access" value="Analytics Report"/> Analytics</li>
                                                    </ul>
                                                </li>
                                                <li>Accounts
                                                    <ul>
                                                        <li><input type="checkbox"  name="access" value="Users"/> Systems Users</li>
                                                        <li><input type="checkbox"  name="access" value="User Roles"/> System User Role</li>
                                                    </ul>
                                                </li>
                                                <li><input type="checkbox"  name="access" value="Archive"/> Archive
                                                    <ul></ul>
                                                </li>
                                                <li><input type="checkbox"  name="access" value="Logs"/> Logs
                                                    <ul></ul>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                    <div class="row" style="margin-top: 50px;">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-primary btn-lg" onclick="createUser()">Submit <i class="icon-check position-right"></i></button>
                                        </div>
                                    </div>
                                </fieldset>

                                <button type="submit" class="btn btn-primary stepy-finish hidden">Submit <i class="icon-check position-right"></i></button>
                            </form>
                        </div>
                        <!-- /clickable title -->
                        </div>
                        <!-- /clickable title -->

                        <!-- Clickable title -->
                        <div class="panel panel-white" id="view_users">
                            <div class="panel-heading">
                                <h6 class="panel-title">System Users</h6>
                            </div>
                            <div class="row" style="margin: 20px;">
                                <div class="col-md-6">
                                    <div align="left"><a onclick="toggle('add_new_user','view_users')" class="btn btn-lg btn-default"><span class="icon icon-plus3"></span>   Add New User</a></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-flat" style="margin: 10px;">
                                        <table class="table table-hover datatable-basic">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>E-mail</th>
                                                <th>Status</th>
                                                <th>Role</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $count= 0;
                                            $sel = "SELECT username, first_name, last_name, institution, email, account_type, status, roleid, id, phone FROM users WHERE status='Active' ORDER BY first_name ASC";
                                            $selrun = $conn->query($dbcon,$sel);
                                            while($row = $conn->fetch($selrun)){
                                                $count++;
                                                $id = $row['id'];
                                                $status = $row['status'];
                                                $rolename =getRole($row['roleid']);
                                                $color = "#000000";
                                                if($status == "Inactive"){
                                                    $color = "#6B8139";
                                                }


                                                //GET THE FIRST LETTER OF EACH WORD
                                                $words = explode(" ", $rolename);
                                                $acronym = "";
                                                foreach ($words as $w) {
                                                    $acronym .= mb_substr($w, 0, 1);
                                                }
                                                ?>
                                                <tr style="color: <?php echo $color; ?>">
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                                                    <td><?php echo $row['phone']; ?></td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['status']; ?></td>
                                                    <td><button type="button" class="btn btn-default btn-rounded"><i class="position-left" style="background-color: "><?php echo $acronym; ?></i> <b style="color: #000000;">|</b> <?php echo $rolename; ?></button></td>
                                                    <td>
                                                        <a class="btn" href="dashboard.php?user_edit=<?php echo $id; ?>" data-popup="tooltip" title="Edit" data-placement="bottom"><span class="icon icon-database-edit2"></span></a>&nbsp;&nbsp;&nbsp;
                                                        <?php if($status == "Active"){ ?>&nbsp;<a class="btn" onclick="deleteModal(<?php echo $id; ?>,'users')" data-popup="tooltip" title="Delete" data-placement="bottom"><span class="icon icon-trash-alt"></span></a><?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /clickable title -->
                    </div>
                    <!-- /content area -->
                </div>
                <?php $conn->close($dbcon);}elseif(isset($_GET['user_edit'])){
                    $id = $_GET['user_edit'];
                    $conn=new Db_connect;
                    $dbcon=$conn->conn();
                    $sel= "SELECT * FROM users WHERE id = $id";
                    $selrun = $conn->query($dbcon,$sel);
                    $data = $conn->fetch($selrun);
                    $email = $data['email'];
                ?>
                    <div class="content-wrapper">
                        <!-- Page header -->
                        <div class="page-header" style="margin: 20px;">
                            <div class="breadcrumb-line">
                                <ul class="breadcrumb" style="font-size: medium;">
                                    <li style="font-weight: bold; font-size: x-large">Accounts </li>
                                    <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                                    <li><a href="dashboard.php?users">Users</a></li>
                                    <li class="active"><a href="dashboard.php?users">User Edit</a></li>
                                </ul>
                                <ul class="breadcrumb-elements">
                                    <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                                    <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /page header -->
                        <!-- Content area -->
                        <div class="content">
                            <!-- Clickable title -->
                            <div class="panel panel-white" id="add_new_user">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Edit, <span style="font-weight: bold; font-size: large;"><?php echo $data['first_name']." ".$data['last_name']; ?></span></h6>
                                </div>

                                <form class="stepy-clickable" action="#">
                                    <fieldset title="1">
                                        <legend class="text-semibold">Personal data</legend>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>E-mail:<b class="rqd">*</b></label>
                                                    <input type="text" value="<?php echo $data['email']; ?>" id="emailedit" class="form-control" readonly />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>First Name:<b class="rqd">*</b></label>
                                                    <input type="text" value="<?php echo $data['first_name']; ?>" id="fnameedit" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Last Name:<b class="rqd">*</b></label>
                                                    <input type="text" value="<?php echo $data['last_name']; ?>" id="lnameedit" class="form-control" required />
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Phone Number:<b class="rqd">*</b></label>
                                                    <input type="text" value="<?php echo $data['phone']; ?>" id="contactedit" class="form-control" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Institution:<b class="rqd">*</b></label>
                                                    <select name="institution" id="institutionedit" data-placeholder="Select User Institution" class="select">
                                                        <option  value="<?php echo $data['institution']; ?>"><?php echo getInstitution($data['institution']); ?></option>
                                                        <?php
                                                        $sel = "SELECT name, institution_code FROM institutes WHERE status = 'Active' ORDER BY name ASC";
                                                        $selrun = $conn->query($dbcon,$sel);
                                                        while($row = $conn->fetch($selrun)){
                                                            ?>
                                                            <option value="<?php echo $row['institution_code']; ?>"><?php echo $row['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset title="2">
                                        <legend class="text-semibold">Account Details</legend>

                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Account Type:<b class="rqd">*</b></label>
                                                    <select name="account-type" id="actypeedit" data-placeholder="Choose Account Type" class="select">
                                                        <option value="<?php echo $data['account_type']; ?>"><?php echo $data['account_type']; ?></option>
                                                        <option value="GTEC">GTEC</option>
                                                        <option value="Institution">Institution</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>User Role:<b class="rqd">*</b></label>
                                                    <select name="experience-from-month" id="roleedit" data-placeholder="Select User Role" class="select">
                                                        <option value="<?php echo $data['roleid']; ?>"><?php echo getRole($data['roleid']); ?></option>
                                                        <?php
                                                        $sel = "SELECT role, id FROM roles WHERE status = 'Active' ORDER BY role ASC";
                                                        $selrun = $conn->query($dbcon,$sel);
                                                        while($row = $conn->fetch($selrun)){
                                                            ?>
                                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['role']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p style="font-weight: bold; text-align: left; font-size: large">Assign User Page Access</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <ul id="tree1">
                                                    <li><input type="checkbox" <?php echo checkAccess('Home',$email) ?> name="accessedit" value="Home"/> <a href="#">Home</a>
                                                        <ul></ul>
                                                    </li>
                                                    <li><input type="checkbox" <?php echo checkAccess('ISCED',$email) ?> name="accessedit" value="ISCED" /> <a href="#">ISCED</a>
                                                        <ul></ul>
                                                    </li>
                                                    <li><input type="checkbox" <?php echo checkAccess('Locations',$email) ?>  name="accessedit" value="Locations"/> <a href="#">Locations</a>
                                                        <ul></ul>
                                                    </li>
                                                    <li>Institutions
                                                        <ul>
                                                            <li><input type="checkbox" name="accessedit" <?php echo checkAccess('Institution Category',$email) ?> value="Institution Category" /> Institution Category</li>
                                                            <li><input type="checkbox" name="accessedit" <?php echo checkAccess('Institution',$email) ?> value="Institution" /> Institutions</li>
                                                        </ul>
                                                    </li>
                                                    <li>Accreditation
                                                        <ul>
                                                            <li><input type="checkbox" <?php echo checkAccess('Contact',$email) ?>  name="accessedit" value="Contact"/> Contact</li>
                                                            <li><input type="checkbox" <?php echo checkAccess('Programs',$email) ?> name="accessedit" value="Programs"/> Programs</li>
                                                            <li><input type="checkbox" <?php echo checkAccess('Proposed',$email) ?> name="accessedit" value="Proposed"/> Proposed</li>
                                                        </ul>
                                                    </li>
                                                    <li>Staff
                                                        <ul>
                                                            <li><input type="checkbox" <?php echo checkAccess('Staff Category',$email) ?>  name="accessedit" value="Staff Category"/> Staff Category</li>
                                                            <li><input type="checkbox"  name="accessedit" <?php echo checkAccess('Staff',$email) ?> value="Staff"/> Staff</li>
                                                            <li><input type="checkbox"  name="accessedit" <?php echo checkAccess('Publications',$email) ?> value="Publications"/> Publications</li>
                                                        </ul>
                                                    </li>
                                                    <li>Students
                                                        <ul>
                                                            <li><input type="checkbox" <?php echo checkAccess('Applications',$email) ?> name="accessedit" value="Applications"/> Application And Admissions</li>
                                                            <li><input type="checkbox" <?php echo checkAccess('Enrollments',$email) ?> name="accessedit" value="Enrollments"/> Enrollments</li>
                                                            <li><input type="checkbox" <?php echo checkAccess('Graduations',$email) ?> name="accessedit" value="Graduations"/> Graduations</li>
                                                        </ul>
                                                    </li>
                                                    <li>Reports
                                                        <ul>
                                                            <li><input type="checkbox" <?php echo checkAccess('Summary Report',$email) ?> name="accessedit" value="Summary Report"/> Summary</li>
                                                            <li><input type="checkbox" <?php echo checkAccess('Analytics Report',$email) ?> name="accessedit" value="Analytics Report"/> Analytics</li>
                                                        </ul>
                                                    </li>
                                                    <li>Accounts
                                                        <ul>
                                                            <li><input type="checkbox" <?php echo checkAccess('Users',$email) ?> name="accessedit" value="Users"/> Systems Users</li>
                                                            <li><input type="checkbox" <?php echo checkAccess('User Roles',$email) ?> name="accessedit" value="User Roles"/> System User Role</li>
                                                        </ul>
                                                    </li>
                                                    <li><input type="checkbox" <?php echo checkAccess('Archive',$email) ?> name="accessedit" value="Archive"/> Archive
                                                        <ul></ul>
                                                    </li>
                                                    <li><input type="checkbox" <?php echo checkAccess('Logs',$email) ?>  name="accessedit" value="Logs"/> Logs
                                                        <ul></ul>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="row" style="margin-top: 50px;">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-primary btn-lg" onclick="updateUser()">Update <i class="icon-check position-right"></i></button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <button type="submit" class="btn btn-primary stepy-finish hidden">Submit <i class="icon-check position-right"></i></button>
                                </form>
                            </div>
                            <!-- /clickable title -->
                        </div>
                        <!-- /clickable title -->
                    </div>
                </div>
                <?php $conn->close($dbcon);}else{?>
                    <div class="content-wrapper">
                        <!-- Page header -->
                        <div class="page-header" style="margin: 20px;">
                            <div class="breadcrumb-line">
                                <ul class="breadcrumb" style="font-size: medium;">
                                    <li style="font-weight: bold; font-size: x-large">Dashboard </li>
                                    <li><a href="dashboard.php"><i class="icon-home2 position-left"></i></a></li>
                                </ul>
                                <ul class="breadcrumb-elements">
                                    <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;"><i class="icon-arrow-left7 position-left"></i> Back</a></li>
                                    <li><a href="#" class="btn btn-lg" style="background-color: #FFDC0A; color: #ffffff; margin: 5px;">Forward <i class="icon-arrow-right7 position-left"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /page header -->
                        <!-- Content area -->
                        <div class="content">
                            <div class="row">
                                <div class="col-lg-3">
                                    <!-- Members online -->
                                    <div class="panel bg-white">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3" style="font-size: xx-large;"></i></a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <h3 class="no-margin" style="font-weight: bold; font-size: xx-large"><?php echo getAccreditationCount(); ?></h3>
                                            <div style="font-size: large; color: #FFDC0A">Accreditations</div>
                                        </div>
                                    </div>
                                    <!-- /members online -->
                                </div>
                                <div class="col-lg-3">
                                    <!-- Members online -->
                                    <div class="panel bg-white">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-graduation2" style="font-size: xx-large;"></i></a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <h3 class="no-margin" style="font-weight: bold; font-size: xx-large">42</h3>
                                            <div style="font-size: large; color: #FFDC0A">Graduations</div>
                                        </div>
                                    </div>
                                    <!-- /members online -->
                                </div>
                                <div class="col-lg-3">
                                    <!-- Members online -->
                                    <div class="panel bg-white">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-office" style="font-size: xx-large;"></i></a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <h3 class="no-margin" style="font-weight: bold; font-size: xx-large"><?php echo getInstitutionCount(); ?></h3>
                                            <div style="font-size: large; color: #FFDC0A">Institutions</div>
                                        </div>
                                    </div>
                                    <!-- /members online -->
                                </div>
                                <div class="col-lg-3">
                                    <!-- Members online -->
                                    <div class="panel bg-white">
                                        <div class="panel-body">
                                            <div class="heading-elements">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-books" style="font-size: xx-large;"></i></a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <h3 class="no-margin" style="font-weight: bold; font-size: xx-large"><?php echo getEnrollmentCount(); ?></h3>
                                            <div style="font-size: large; color: #FFDC0A">Enrollments</div>
                                        </div>
                                    </div>
                                    <!-- /members online -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Members online -->
                                    <div class="panel bg-white">
                                        <div class="panel-body">
                                            <div style="font-size: large;">Students Enrollment By Year</div>
                                            <div id="studentsgraph" style="width: auto;height:400px;"></div>
                                        </div>
                                    </div>
                                    <!-- /members online -->
                                </div>
                                <div class="col-lg-6">
                                    <!-- Members online -->
                                    <div class="panel bg-white">
                                        <div class="panel-body">
                                            <div style="font-size: large;">Top 10 Nationalities By Enrollments</div>
                                            <div id="nationalitygraph" style="width: auto;height:400px;"></div>
                                        </div>
                                    </div>
                                    <!-- /members online -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div id="graphmain" style="width: auto;height:400px;"></div>-->

        <?php } ?>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->
<?php include("components/modals.php"); ?>
<script type="text/javascript">
    /*
    THE ECHARTS STARTS HERE
     */
    // Initialize the echarts instance based on the prepared dom
    var myChart = echarts.init(document.getElementById('studentsgraph'),'infographic');
    myChart.showLoading();
    // Specify the configuration items and data for the chart
    var xData = [];
    var yData = [];
    $.ajax({
        type: "post",
        url: "php/index.php",
        data: "getStudentsGraphData",
        success: function (data) {
            var result = $.parseJSON(data);
            for(var i=0; i < result.length;i++ ){
                let dval = result[i];
                var year = dval['year'];
                var dcount = dval['totalCount'];
                xData.push(year);
                yData.push(dcount);

            }
            option = {
                xAxis: {
                    //data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
                    data: xData
                },
                yAxis: {},
                series: [
                    {
                        type: 'bar',
                        data: yData,
                        showBackground: true,
                        backgroundStyle: {
                            color: 'rgba(180, 180, 180, 0.2)'
                        }
                        //data: [23, 24, 18, 25, 27, 28, 25]
                    }
                ]
            };

            // Display the chart using the configuration items and data just specified.
            myChart.hideLoading();
            myChart.setOption(option);
    },
    error: function (xhr, desc, err) {
    }
    });




    var myBarChart = echarts.init(document.getElementById('nationalitygraph'),'infographic');
    myBarChart.showLoading();
    var xData2 = [];
    var yData2 = [];
    $.ajax({
        type: "post",
        url: "php/index.php",
        data: "getEnrollmentByCountry",
        success: function (data) {
            console.log(data);
            /*var result = $.parseJSON(data);
            for(var i=0; i < result.length;i++ ){
                let dval = result[i];
                var nationality = dval['nationality'];
                var dcount = dval['totalCount'];
                xData2.push(nationality);
                yData2.push(dcount);

            }*/
            option = {
                tooltip: {
                    trigger: 'item'
                },
                legend: {
                    top: '5%',
                    left: 'center',
                    // doesn't perfectly work with our tricks, disable it
                    selectedMode: false
                },
                series: [
                    {
                        name: 'Access From',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        center: ['50%', '70%'],
                        // adjust the start angle
                        startAngle: 180,
                        label: {
                            show: true,
                            formatter(param) {
                                // correct the percentage
                                return param.name + ' (' + param.percent * 2 + '%)';
                            }
                        },
                        data: [
                            { value: 1048, name: 'Search Engine' },
                            { value: 735, name: 'Direct' },
                            { value: 580, name: 'Email' },
                            { value: 484, name: 'Union Ads' },
                            { value: 300, name: 'Video Ads' },
                            {
                                // make an record to fill the bottom 50%
                                value: 1048 + 735 + 580 + 484 + 300,
                                itemStyle: {
                                    // stop the chart from rendering this piece
                                    color: 'none',
                                    decal: {
                                        symbol: 'none'
                                    }
                                },
                                label: {
                                    show: false
                                }
                            }
                        ]
                    }
                ]
            };

            // Display the chart using the configuration items and data just specified.
            myBarChart.hideLoading();
            myBarChart.setOption(option);
        },
        error: function (xhr, desc, err) {
        }
    });
    /*//BARGRAPH HERE
    // Initialize the echarts instance based on the prepared dom
    var myBarChart = echarts.init(document.getElementById('nationalitygraph'),'infographic');

    // Specify the configuration items and data for the chart
    optionBar = {
        dataset: {
            source: [
                ['score', 'amount', 'product'],
                [89.3, 58212, 'Matcha Latte'],
                [57.1, 78254, 'Milk Tea'],
                [74.4, 41032, 'Cheese Cocoa'],
                [50.1, 12755, 'Cheese Brownie'],
                [89.7, 20145, 'Matcha Cocoa'],
                [68.1, 79146, 'Tea'],
                [19.6, 91852, 'Orange Juice'],
                [10.6, 101852, 'Lemon Juice'],
                [32.7, 20112, 'Walnut Brownie']
            ]
        },
        grid: { containLabel: true },
        xAxis: { name: 'amount' },
        yAxis: { type: 'category' },
        visualMap: {
            orient: 'horizontal',
            left: 'center',
            min: 10,
            max: 100,
            text: ['High Score', 'Low Score'],
            // Map the score column to color
            dimension: 0,
            inRange: {
                color: ['#65B581', '#FFCE34', '#FD665F']
            }
        },
        series: [
            {
                type: 'bar',
                encode: {
                    // Map the "amount" column to X axis.
                    x: 'amount',
                    // Map the "product" column to Y axis
                    y: 'product'
                }
            }
        ]
    };

    // Display the chart using the configuration items and data just specified.
    myBarChart.setOption(optionBar);
    /*
    ECHARTS ENDS HERE
     */



    $.fn.extend({
        treed: function (o) {

            var openedClass = 'icon-minus3';
            var closedClass = 'icon-plus3';

            if (typeof o != 'undefined'){
                if (typeof o.openedClass != 'undefined'){
                    openedClass = o.openedClass;
                }
                if (typeof o.closedClass != 'undefined'){
                    closedClass = o.closedClass;
                }
            };

            //initialize each of the top levels
            var tree = $(this);
            tree.addClass("tree");
            tree.find('li').has("ul").each(function () {
                var branch = $(this); //li with children ul
                branch.prepend("<i class='indicator icon " + closedClass + "'></i>");
                branch.addClass('branch');
                branch.on('click', function (e) {
                    if (this == e.target) {
                        var icon = $(this).children('i:first');
                        icon.toggleClass(openedClass + " " + closedClass);
                        $(this).children().children().toggle();
                    }
                })
                branch.children().children().toggle();
            });
            //fire event from the dynamically added icon
            tree.find('.branch .indicator').each(function(){
                $(this).on('click', function () {
                    $(this).closest('li').click();
                });
            });
            //fire event to open branch if the li contains an anchor instead of text
            tree.find('.branch>a').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li').click();
                    e.preventDefault();
                });
            });
            //fire event to open branch if the li contains a button instead of text
            tree.find('.branch>button').each(function () {
                $(this).on('click', function (e) {
                    $(this).closest('li').click();
                    e.preventDefault();
                });
            });
        }
    });

    //Initialization of treeviews

    $('#tree1').treed();

    $('#tree2').treed({openedClass:'icon-folder-open', closedClass:'icon-close2'});

    $('#tree3').treed({openedClass:'icon-arrow-right5', closedClass:'icon-arrow-down5'});



</script>

</body>
</html>
