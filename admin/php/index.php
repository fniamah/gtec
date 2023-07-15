<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 5/16/2023
 * Time: 11:06 AM
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/phpmailer/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/phpmailer/src/SMTP.php';

include("../dbcon.php");

if(isset($_POST['validateUser'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $uname = mysqli_real_escape_string($dbcon,$_POST['validateUser']);
    $pword = mysqli_real_escape_string($dbcon,$_POST['pword']);
    $response =array();

    if($pword == "" || $uname == ""){
        $response['erroCode'] = "1";
        $response['errorMsg'] = "Please Supply All Fields";
    }else{
        //CHECK IF USER RECORDS EXISTS
        $chk = "SELECT status, password FROM users WHERE email = '$uname'";
        $chkrun = $conn->query($dbcon,$chk);
        if($conn->sqlnum($chkrun) == 0){
            $response['errorCode'] = "1";
            $response['errorMsg'] = "E-mail does not exist";
        }else{
            //GET THE STATUS
            $data = $conn->fetch($chkrun);
            $status = $data['status'];
            $hash = $data['password'];

            if($status == "Pending"){
                $response['errorCode'] = "1";
                $response['errorMsg'] = "Your Account Has Not Been Validated. Kindly Check Your E-mail, $email, To Activate Your Account To Proceed";
            }elseif($status == "Inactive"){
                $response['errorCode'] = "1";
                $response['errorMsg'] = "Your Account Has Been Deactivated By An Administrator. Kindly Contact Them To Assist";
            }else{
                //CHECK IF PASSWORDS MATCH
                if(password_verify($pword, $hash)){
                    $response['errorCode'] = "0";
                    $response['errorMsg'] = "Account Validated";
                }else{
                    $response['errorCode'] = "1";
                    $response['errorMsg'] = "Wrong Password Supplied";
                }
            }
        }
    }
    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['getStudentsGraphData'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    //GET THE YEARS STUDENTS HAVE BEEN REGISTERED
    $selyear = "SELECT DISTINCT year FROM enrollments";
    $selyearrun = $conn->query($dbcon,$selyear);

    $yearData = array();
    $countData = array();

    while($data = $conn->fetch($selyearrun)){
        array_push($yearData,
            array(
                'year'        =>$data['year'],
                'totalCount'        => getEnrollmentByYear($data['year']),
            )
        );
    }

    print json_encode($yearData);
    //print_r($yearData);

    $conn->close($dbcon);
}

if(isset($_POST['getEnrollmentByCountry'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    //GET THE YEARS STUDENTS HAVE BEEN REGISTERED
    $selyear = "SELECT nationality, COUNT(first_name) AS totalCount FROM `enrollments` GROUP BY nationality ORDER BY totalCount DESC LIMIT 10 ";
    $selyearrun = $conn->query($dbcon,$selyear);

    $nationalityData = array();
    $tcount = 0;
    while($data = $conn->fetch($selyearrun)){
        $tcount = $data['totalCount'];
        array_push($nationalityData,
            array(
                value        =>(int)$tcount,
                name        => $data['nationality'],
            )
        );
    }

    print json_encode($nationalityData);
    //print_r($yearData);

    $conn->close($dbcon);
}

if(isset($_POST['addUser'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $access = mysqli_real_escape_string($dbcon,$_POST['addUser']);
    $fname = mysqli_real_escape_string($dbcon,$_POST['fname']);
    $uname = mysqli_real_escape_string($dbcon,$_POST['username']);
    $lname = mysqli_real_escape_string($dbcon,$_POST['lname']);
    $contact = mysqli_real_escape_string($dbcon,$_POST['contact']);
    $email = mysqli_real_escape_string($dbcon,$_POST['email']);
    $actype = mysqli_real_escape_string($dbcon,$_POST['actype']);
    $role = mysqli_real_escape_string($dbcon,$_POST['role']);
    $password = mysqli_real_escape_string($dbcon,$_POST['password']);
    $institution = mysqli_real_escape_string($dbcon,$_POST['institution']);

    $hash = password_hash($password, PASSWORD_ARGON2I);

    //CHECK IF USERNAME HAS NOT BEEN TAKEN
    $chkuname = "SELECT first_name FROM users WHERE username = '$uname' OR email='$email' OR phone='$contact'";
    $chkunamerun = $conn->query($dbcon,$chkuname);
    if($conn->sqlnum($chkunamerun) == 0){
        //ADD THE USER RECORDS AS WELL AS THE PASSWORD
        $user = "INSERT INTO users(username, first_name, last_name, institution, email, phone, account_type, status, password, roleid)
VALUES('$uname','$fname','$lname','$institution','$email','$contact','$actype','Active','$hash','$role')";
        $conn->query($dbcon,$user);

        //CREATE USER PAGES
        $pages = "INSERT INTO userspages(pages,userid) VALUES('$access','$uname')";
        $conn->query($dbcon,$pages);

        //SEND EMAIL TO THE USER
        //TO ACCOUNT HOLDER
        sendEmail($email,"Congratulations! Your account has been created on GTEC as a user. Find your account details below:<br/> Username:$uname <br/>Password:$password.<br/> Remember to constantly update your password.",'no-reply@gtec.com','Account Creation');

        $response['erroCode'] = "0";
        $response['errorMsg'] = "Account Created Successfully, Pending user activation";

    }else{
        $response['erroCode'] = "1";
        $response['errorMsg'] = "Account Creation Failed: Username, E-mail and Contact have to unique to each user created.";
    }

    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['updateUserDetails'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $access = mysqli_real_escape_string($dbcon,$_POST['updateUserDetails']);
    $fname = mysqli_real_escape_string($dbcon,$_POST['fname']);
    $lname = mysqli_real_escape_string($dbcon,$_POST['lname']);
    $contact = mysqli_real_escape_string($dbcon,$_POST['contact']);
    $email = mysqli_real_escape_string($dbcon,$_POST['email']);
    $actype = mysqli_real_escape_string($dbcon,$_POST['actype']);
    $role = mysqli_real_escape_string($dbcon,$_POST['role']);
    $institution = mysqli_real_escape_string($dbcon,$_POST['institution']);

        //ADD THE USER RECORDS AS WELL AS THE PASSWORD

        $user = "UPDATE users SET first_name ='$fname', last_name='$lname',institution='$institution', phone='$contact',account_type='$actype', roleid='$role', updatedAt = '".TIMESTAMP."' WHERE email = '$email'";
        $conn->query($dbcon,$user);

        //CREATE USER PAGES
        $pages = "UPDATE userspages SET pages ='$access' WHERE userid='$email'";
        $conn->query($dbcon,$pages);

        $response['erroCode'] = "0";
        $response['errorMsg'] = "Account Update Completed Successfully";


    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['resetPassword'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $email = $_POST['resetPassword'];
    //CHECK IF email exists
    $chk = "SELECT password FROM users WHERE email = '$email'";
    $chkrun = $conn->query($dbcon, $chk);
    if($conn->sqlnum($chkrun) == 0){
        $response['errorCode'] = "1";
        $response['errorMsg'] = "E-Mail Does Not Exist In Our User Accounts.";
    }else{

        //GENERATE THE RANDOM PASSWORD
        $random_characters = 3;

        $lower_case = "abcdefghijklmnopqrstuvwxyz";
        $upper_case = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $numbers = "1234567890";
        $symbols = "!@#$%^&*";

        $lower_case = str_shuffle($lower_case);
        $upper_case = str_shuffle($upper_case);
        $numbers = str_shuffle($numbers);
        $symbols = str_shuffle($symbols);

        $random_password = substr($lower_case, 0, $random_characters);
        $random_password .= substr($upper_case, 0, $random_characters);
        $random_password .= substr($numbers, 0, $random_characters);
        $random_password .= substr($symbols, 0, $random_characters);

        $password = str_shuffle($random_password);
        $hash = password_hash($password, PASSWORD_ARGON2I);

        //UPDATE THE PASSWORD
        $upd ="UPDATE users SET password = '$hash' WHERE email = '$email'";
        $conn->query($dbcon,$upd);

        //SEND EMAIL
        sendEmail($email,"Your account password has been reset. Your Auto Generated Password is <b>$password</b> . Kindly change your password after logging in successfully.",'no-reply@gtec.com','Account Password Update');

        $response['errorCode'] = "0";
        $response['errorMsg'] = "Password updated successfully. Kindly check your e-mail for the autogenerated password";
    }
    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['getGps'])){
    $digaddress = $_POST['getGps'];
    $feedback = getGpsLocation($digaddress);

    $gpsmodeldata = array();
    $district="";
    $region="";
    $area="";

    if (!empty($feedback)) {
        $result = json_decode($feedback);
        if (!empty($result->Table)) {
            $data = $result->Table[0];
            $gpsmodeldata = array(
                "centerlatitude" => $data->CenterLatitude,
                "centerlongitude" => $data->CenterLongitude,
                "northlat" => $data->NorthLat,
                "northlong" => $data->NorthLong,
                "southlat" => $data->SouthLat,
                "southlong" => $data->SouthLong,
                "eastlat" => $data->EastLat,
                "eastlongt" => $data->EastLong,
                "westlat" => $data->WestLat,
                "westlongt" => $data->WestLong,
                "gpsname" => $data->GPSName,
                "postcode" => $data->PostCode,
                "district" => $data->District,
                "region" => $data->Region,
                "street" => $data->Street,
                "area" => $data->Area,
            );
            $response['status'] = 'Successful';
            $response['district'] = $data->District;
            $response['area'] = $data->Area;
            $response['region'] = $data->Region;
            $response['latitude'] = $data->CenterLatitude;
            $response['longitude'] = $data->CenterLongitude;
            print json_encode($response);
        }else{
            $response['status'] = 'failed';
            print json_encode($response);
        }
    }else{
        $response['status'] = 'failed';
        print json_encode($response);
    }
}

if(isset($_POST['addIsced'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $title = mysqli_real_escape_string($dbcon,$_POST['title']);
    $code = mysqli_real_escape_string($dbcon,$_POST['code']);
    $description = mysqli_real_escape_string($dbcon,$_POST['description']);

    //CHECK IF CODE HAS NOT BEEN TAKEN
    $chkuname = "SELECT name FROM isceds WHERE code = '$code'";
    $chkunamerun = $conn->query($dbcon,$chkuname);
    if($conn->sqlnum($chkunamerun) == 0){
        //ADD THE USER RECORDS AS WELL AS THE PASSWORD
        $user = "INSERT INTO isceds(name, code, description) VALUES('$title','$code','$description')";
        $conn->query($dbcon,$user);

        $response['errorCode'] = "0";
        $response['errorMsg'] = "ISCED Created Successfully";

    }else{
        $row = $conn->fetch($chkunamerun);
        $name = $row['name'];
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Code $code Already Assigned To Institution, $name. Kindly provide another code";
    }

    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['updateIsced'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $title = mysqli_real_escape_string($dbcon,$_POST['title']);
    $code = mysqli_real_escape_string($dbcon,$_POST['code']);
    $description = mysqli_real_escape_string($dbcon,$_POST['description']);

    //UPDATE
    $upd = "UPDATE isceds SET name = '$title', description = '$description' WHERE code ='$code'";
    $conn->query($dbcon,$upd);

    $response['errorCode'] = "0";
    $response['errorMsg'] = "ISCED Updated Successfully";

    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['updateRank'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $id = mysqli_real_escape_string($dbcon,$_POST['updateRank']);
    $rank = mysqli_real_escape_string($dbcon,$_POST['rank']);
    $status = mysqli_real_escape_string($dbcon,$_POST['status']);

    //UPDATE
    $upd = "UPDATE staffranks SET status = '$status',rank = '$rank' WHERE id =$id";
    $conn->query($dbcon,$upd);

    $response['errorCode'] = "0";
    $response['errorMsg'] = "Rank Updated Successfully";

    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['updateInstitutionCategory'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $name = mysqli_real_escape_string($dbcon,$_POST['name']);
    $id = mysqli_real_escape_string($dbcon,$_POST['id']);
    $description = mysqli_real_escape_string($dbcon,$_POST['description']);
    $status = mysqli_real_escape_string($dbcon,$_POST['status']);

    //UPDATE
    $upd = "UPDATE institute_categories SET status = '$status',name = '$name', description = '$description' WHERE id ='$id'";
    $conn->query($dbcon,$upd);

    $response['errorCode'] = "0";
    $response['errorMsg'] = "Institution Caegory Updated Successfully";

    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['addInstCategory'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $name = mysqli_real_escape_string($dbcon,$_POST['name']);
    $description = mysqli_real_escape_string($dbcon,$_POST['description']);

    //CHECK IF CODE HAS NOT BEEN TAKEN
    $chkuname = "SELECT name FROM institute_categories WHERE name = '$name'";
    $chkunamerun = $conn->query($dbcon,$chkuname);
    if($conn->sqlnum($chkunamerun) == 0){
        //ADD THE USER RECORDS AS WELL AS THE PASSWORD
        $user = "INSERT INTO institute_categories(name, description) VALUES('$name','$description')";
        $conn->query($dbcon,$user);

        $response['errorCode'] = "0";
        $response['errorMsg'] = "Institution Category Created Successfully";

    }else{
        $row = $conn->fetch($chkunamerun);
        $name = $row['name'];
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Institution Category, $name, Already Exists.";
    }

    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['addStaffCategory'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $name = mysqli_real_escape_string($dbcon,$_POST['name']);
    $rank = $_POST['rank'];

    //CHECK IF CODE HAS NOT BEEN TAKEN
    $chkuname = "SELECT id FROM staffcategory WHERE staff_type = '$name'";
    $chkunamerun = $conn->query($dbcon,$chkuname);
    if($conn->sqlnum($chkunamerun) == 0){
        //ADD THE USER RECORDS AS WELL AS THE PASSWORD
        $user = "INSERT INTO staffcategory(staff_type, ranks, status) VALUES('$name','$rank','Active')";
        $conn->query($dbcon,$user);

        $response['errorCode'] = "0";
        $response['errorMsg'] = "Staff Category Created Successfully";

    }else{
        $row = $conn->fetch($chkunamerun);
        $name = $row['name'];
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Staff Category, $name, Already Exists.";
    }

    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['addStaffRank'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $rank = mysqli_real_escape_string($dbcon,$_POST['addStaffRank']);

    //CHECK IF CODE HAS NOT BEEN TAKEN
    $chkuname = "SELECT id FROM staffranks WHERE rank = '$rank'";
    $chkunamerun = $conn->query($dbcon,$chkuname);
    if($conn->sqlnum($chkunamerun) == 0){
        //ADD THE USER RECORDS AS WELL AS THE PASSWORD
        $user = "INSERT INTO staffranks(rank, status) VALUES('$rank','Active')";
        $conn->query($dbcon,$user);

        $response['errorCode'] = "0";
        $response['errorMsg'] = "Staff Rank Created Successfully";

    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Staff Rank, $rank, Already Exists.";
    }

    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['addInstitution'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $name = mysqli_real_escape_string($dbcon,$_POST['addInstitution']);
    $short = mysqli_real_escape_string($dbcon,$_POST['short']);
    $code = mysqli_real_escape_string($dbcon,$_POST['code']);
    $cat = mysqli_real_escape_string($dbcon,$_POST['cat']);
    $desc = mysqli_real_escape_string($dbcon,$_POST['desc']);
    $tel = mysqli_real_escape_string($dbcon,$_POST['tel']);
    $email = mysqli_real_escape_string($dbcon,$_POST['email']);
    $url = mysqli_real_escape_string($dbcon,$_POST['url']);
    $dig = mysqli_real_escape_string($dbcon,$_POST['dig']);
    $reg = mysqli_real_escape_string($dbcon,$_POST['reg']);
    $district = mysqli_real_escape_string($dbcon,$_POST['district']);
    $town = mysqli_real_escape_string($dbcon,$_POST['town']);
    $lat = mysqli_real_escape_string($dbcon,$_POST['lat']);
    $longt = mysqli_real_escape_string($dbcon,$_POST['longt']);

    //CHECK IF INSTITUTION ALREADY EXISTS
    $chkCode = "SELECT short_name FROM institutes WHERE institution_code = '$code'";
    $chkcoderun = $conn->query($dbcon,$chkCode);
    if($conn->sqlnum($chkcoderun) == 0){
        $ins = "INSERT INTO institutes (short_name,institution_code,name,category_id,status,region,district,town,latitude,longitude,digital_address,contact_telephone,contact_email,url,description)VALUES('$short','$code','$name',$cat,'Active','$reg','$district','$town',$lat,$longt,'$dig','$tel','$email','$url','$desc')";
        $conn->query($dbcon,$ins);
        //CHECK DISTRICT AND REGION
        $chkdistrict = "SELECT id FROM districts WHERE name = '$district'";
        $chkdistrictrun = $conn->query($dbcon,$chkdistrict);
        if($conn->sqlnum($chkdistrictrun) == 0){
            $ins = "INSERT INTO districts(name) VALUES ('$district')";
            $conn->query($dbcon,$ins);
        }

        $chkregion = "SELECT id FROM regions WHERE name = '$reg'";
        $chkregionrun = $conn->query($dbcon,$chkregion);
        if($conn->sqlnum($chkregionrun) == 0){
            $ins = "INSERT INTO regions(name) VALUES ('$reg')";
            $conn->query($dbcon,$ins);
        }

        $response['errorCode'] = "0";
        $response['errorMsg'] = "Institution, $name, Added Successfully.";
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Institution With The Code, $code, Already Exists.";
    }

    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['addRole'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $roles = mysqli_real_escape_string($dbcon,$_POST['addRole']);
    $title = mysqli_real_escape_string($dbcon,ucfirst($_POST['title']));
    $response =array();

    //CHECK IF ROLE NAME DOES NOT EXIST
    $chk = "SELECT role FROM roles WHERE role = '$title'";
    $chkrun = $conn->query($dbcon,$chk);
    if($conn->sqlnum($chkrun) == 0){
        $ins="INSERT INTO roles (role, permissions,created_at,status) VALUES ('$title','$roles','".TIMESTAMP."','Active')";
        $insrun = $conn->query($dbcon,$ins);
        if($insrun){
            $response['erroCode'] = "0";
            $response['errorMsg'] = "Role Created Successfully";
        }else{
            $response['erroCode'] = "1";
            $response['errorMsg'] = "Role Not Created";
        }

    }else{
        $response['erroCode'] = 1;
        $response['errorMsg'] = "Role $title Already Exists";
    }
    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['removeRole'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $id = $_POST['removeRole'];
    $table = $_POST['table'];
    $response =array();

    $ins="UPDATE ".$table." SET status = 'Inactive' WHERE id = $id";
    $insrun = $conn->query($dbcon,$ins);
    if($insrun){
        $response['errorCode'] = "0";
        $response['errorMsg'] = "Record Deleted Successfully";
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Record Not Deleted";
    }
    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['updateRole'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $id = $_POST['updateRole'];
    $response =array();

    //FETCH THE ROLE RECORDS
    $sel = "SELECT role, permissions,status FROM roles WHERE id = $id";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) == 0){
        print "Not Found";
    }else{
        $rows = $conn->fetch($selrun);
        $permissions = $rows['permissions'];
        $createCheck="";
        $updateCheck="";
        $deleteCheck="";

        $status = $rows['status'];
        $otheroption = "Active";
        if($status == "Active"){
            $otheroption = "Inactive";
        }

        if(str_contains($permissions, 'create')){
            $createCheck = " checked = 'checked'";
        }

        if(str_contains($permissions, 'update')){
            $updateCheck = " checked = 'checked'";
        }
        if(str_contains($permissions, 'delete')){
            $deleteCheck = " checked = 'checked'";
        }

        $data = "<form method='post'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='form-group'>
                    <label>Role Title:<b class='rqd'>*</b></label>
                    <input type='text' id='roletitleU' value='".$rows['role']."' class='form-control' />
                </div>
            </div>

            <div class='col-md-12'>
                <div class='form-group'>
                    <label align='center'>Access:<b class='rqd'>*</b></label>
                    <div class='row'>
                        <div class='col-md-6' align='right'><input type='checkbox' name='accessesU' value='create'".$createCheck." />&nbsp;Create&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' name='accessesU'  value='read' checked='checked' disabled />&nbsp;Read</div>
                        <div class='col-md-6' align='left'><input type='checkbox' name='accessesU' value='update'".$updateCheck." />&nbsp;Update&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' name='accessesU'  value='delete' ".$deleteCheck."/>&nbsp;Delete</div>
                    </div>


                </div>
            </div>
            <div class='col-md-12' align='right'>
                <button class='btn btn-sm btn-primary' type='button' onclick='updateRoleData(".$id.")'>Update Role</button>
            </div>
        </div>
        ";
        print $data;
    }
    $conn->close($dbcon);
}


if(isset($_POST['getIsced'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $id = $_POST['getIsced'];
    $response =array();

    //FETCH THE ROLE RECORDS
    $sel = "SELECT name, code,description, status FROM isceds WHERE id = $id";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) == 0){
        print "Not Found";
    }else{
        $rows = $conn->fetch($selrun);

        $status = $rows['status'];
        $otheroption = "Active";
        if($status == "Active"){
            $otheroption = "Inactive";
        }

        $data = "
        <form class='stepy-clickable'>
            <fieldset title='1'>
                <legend class='text-semibold'>ISCED Details</legend>

                <div class='row'>
                    <div class='col-md-4' align='right'><label>ISCED Code:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <input type='text' id='icodeedit' readonly value='".$rows['code']."' class='form-control' placeholder='ISCED Title' />
                        </div>
                    </div>
                </div>
                <div class='row' align='center'>
                    <div class='col-md-4' align='right'><label>ISCED Name:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <input type='text' id='ititleedit' value='".$rows['name']."' class='form-control' placeholder='ISCED CODE' />
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-4' align='right'><label>ISCED Description:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <textarea id='idescriptedit' placeholder='ISCED DESCRIPTION' class='form-control' maxlength='1000' rows='5'> ".$rows['description']."</textarea>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-12' align='center'>
                        <button class='btn btn-sm btn-primary' type='button' onclick='updateIsced()'>Update  </button>
                    </div>
                </div>
            </fieldset>
            <button type='submit' class='btn btn-primary stepy-finish' style='visibility: hidden'>Submit <i class='icon-check position-right'></i></button>
        </form>
        ";
        print $data;
    }
    $conn->close($dbcon);
}

if(isset($_POST['getStaffRank'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $id = $_POST['getStaffRank'];
    $response =array();

    //FETCH THE ROLE RECORDS
    $sel = "SELECT rank, status FROM staffranks WHERE id = $id";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) == 0){
        print "Not Found";
    }else{
        $rows = $conn->fetch($selrun);

        $status = $rows['status'];
        $otheroption = "Active";
        if($status == "Active"){
            $otheroption = "Inactive";
        }

        $data = "
        <form class='stepy-clickable'>
 
            <fieldset title='1'>
                <legend class='text-semibold'>Rank Details</legend>

                <div class='row'>
                    <input type='hidden' id='rankid' value='".$id."' />
                    <div class='col-md-4' align='right'><label>Rank Name:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <input type='text' id='rankedit' value='".$rows['rank']."' class='form-control' placeholder='Rank Name' />
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-4' align='right'><label>Rank Status:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <select id='rankstatus' class='form-control'> 
                                <option value='".$status."'>".$status."</option>
                                <option value='".$otheroption."'>".$otheroption."</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-12' align='center'>
                        <button class='btn btn-sm btn-primary' type='button' onclick='updateRank()'>Update  </button>
                    </div>
                </div>
            </fieldset>
            <button type='submit' class='btn btn-primary stepy-finish' style='visibility: hidden'>Submit <i class='icon-check position-right'></i></button>
        </form>
        ";
        print $data;
    }
    $conn->close($dbcon);
}

if(isset($_POST['getInstitutionCategory'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $id = $_POST['getInstitutionCategory'];
    $response =array();

    //FETCH THE ROLE RECORDS
    $sel = "SELECT name, description, status FROM institute_categories WHERE id = $id";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) == 0){
        print "Not Found";
    }else{
        $rows = $conn->fetch($selrun);

        $status = $rows['status'];
        $otheroption = "Active";
        if($status == "Active"){
            $otheroption = "Inactive";
        }

        $data = "
        <form class='stepy-clickable'>
            <fieldset title='1'>
                <legend class='text-semibold'>Institution Category Details</legend>

                <div class='row hidden'>
                    <div class='col-md-4' align='right'><label>Category Code:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <input type='text' id='catid' readonly value='".$id."' class='form-control' placeholder='ISCED Title' />
                        </div>
                    </div>
                </div>
                <div class='row' align='center'>
                    <div class='col-md-4' align='right'><label>Category Name:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <input type='text' id='catnameedit' value='".$rows['name']."' class='form-control' placeholder='ISCED CODE' />
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-4' align='right'><label>Category Description:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <textarea id='catdescriptedit' placeholder='ISCED DESCRIPTION' class='form-control' maxlength='1000' rows='5'> ".$rows['description']."</textarea>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-4' align='right'><label>Category Status:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <select id='catstatusedit' class='form-control'> 
                                <option value='".$status."'>".$status."</option>
                                <option value='".$otheroption."'>".$otheroption."</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-12' align='center'>
                        <button class='btn btn-sm btn-primary' type='button' onclick='updateInstitutionCategory()'>Update  </button>
                    </div>
                </div>
            </fieldset>
            <button type='submit' class='btn btn-primary stepy-finish' style='visibility: hidden'>Submit <i class='icon-check position-right'></i></button>
        </form>
        ";
        print $data;
    }
    $conn->close($dbcon);
}

if(isset($_POST['getRankDetails'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $rankid = $_POST['getRankDetails'];
    $sel = "SELECT ranks FROM staffcategory WHERE id=$rankid";
    $selrun = $conn->query($dbcon,$sel);
    $msg="";
    if($conn->sqlnum($selrun) == 0){
        $msg = "<option value=''>Empty Ranks</option>";
    }else{
        $row = $conn->fetch($selrun);
        $ranks = $row['ranks'];
        $explode = explode(",",$ranks);
        for($i=0; $i < count($explode);$i++){
            $msg=$msg."<option value='".$explode[$i]."'>".getRank($explode[$i])."</option>";
        }
    }
    print $msg;
}

if(isset($_POST['getStaffDetails'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $rankid = $_POST['getStaffDetails'];
    $sel = "SELECT title, first_name, surname, other_names, staff_id FROM staff WHERE status='Active' AND institution='$rankid'";
    $selrun = $conn->query($dbcon,$sel);
    $msg="";
    if($conn->sqlnum($selrun) == 0){
        $msg = "<option value=''>No Staff</option>";
    }else{
        $row = $conn->fetch($selrun);
        $msg=$msg."<option value='".$row['staff_id']."'>".$row['title']." ".$row['first_name']." ".$row['other_names']." ".$row['surname']."</option>";
    }
    print $msg;
}

if(isset($_POST['addNewStaff'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $stfid=mysqli_real_escape_string($dbcon,$_POST['addNewStaff']);
    $title=mysqli_real_escape_string($dbcon,$_POST['title']);
    $fname=mysqli_real_escape_string($dbcon,$_POST['fname']);
    $lname=mysqli_real_escape_string($dbcon,$_POST['lname']);
    $oname=mysqli_real_escape_string($dbcon,$_POST['oname']);
    $dob=mysqli_real_escape_string($dbcon,$_POST['dob']);
    $sex=mysqli_real_escape_string($dbcon,$_POST['sex']);
    $idtype=mysqli_real_escape_string($dbcon,$_POST['idtype']);
    $idnum=mysqli_real_escape_string($dbcon,$_POST['idnum']);
    $edu=mysqli_real_escape_string($dbcon,$_POST['edu']);
    $nat=mysqli_real_escape_string($dbcon,$_POST['nat']);
    $disable=mysqli_real_escape_string($dbcon,$_POST['disable']);
    $distype=mysqli_real_escape_string($dbcon,$_POST['distype']);
    $inst=mysqli_real_escape_string($dbcon,$_POST['inst']);
    $acad=mysqli_real_escape_string($dbcon,$_POST['acad']);
    $emptype=mysqli_real_escape_string($dbcon,$_POST['emptype']);
    $stftype=mysqli_real_escape_string($dbcon,$_POST['stftype']);
    $rank=mysqli_real_escape_string($dbcon,$_POST['rank']);
    $desig=mysqli_real_escape_string($dbcon,$_POST['desig']);
    $college=mysqli_real_escape_string($dbcon,$_POST['college']);
    $faculty=mysqli_real_escape_string($dbcon,$_POST['faculty']);
    $dept=mysqli_real_escape_string($dbcon,$_POST['dept']);

    //CHECK IF STAFF ID EXISTS
    $chk = "SELECT first_name FROM staff WHERE staff_id = '$stfid'";
    $chkrun = $conn->query($dbcon,$chk);
    if($conn->sqlnum($chkrun) == 0){
        $ins = "INSERT INTO staff (staff_id, year, title, national_id_type, national_id_number, institution, first_name, surname, other_names, 
birth_date, gender, nationality, qualification, designation, rank, staff_type, college, department, faculty, employment_type, disability, 
disability_type) VALUES ('$stfid','$acad','$title','$idtype','$idnum','$inst','$fname','$lname','$oname',$dob,'$sex','$nat','$edu','$desig','$rank','$stftype','$college'
,'$dept','$faculty','$emptype','$disable','$distype')";
        $insrun = $conn->query($dbcon,$ins);
        if($insrun){
            $response['errorCode'] = "0";
            $response['errorMsg'] = "Staff Details Added Successfully";
        }else{
            $response['errorCode'] = "1";
            $response['errorMsg'] = "Staff Details Could Not Be Created. Please Try Again";
        }
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Staff With Staff ID, $stfid, Exists.";
    }


    print json_encode($response);
}

if(isset($_POST['addPublication'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $stfid=mysqli_real_escape_string($dbcon,$_POST['stfid']);
    $inst=mysqli_real_escape_string($dbcon,$_POST['inst']);
    $type=mysqli_real_escape_string($dbcon,$_POST['type']);
    $title=mysqli_real_escape_string($dbcon,$_POST['title']);
    $publisher=mysqli_real_escape_string($dbcon,$_POST['publisher']);
    $pubyear=mysqli_real_escape_string($dbcon,$_POST['pubyear']);

    $ins = "INSERT INTO publication (institution_id, staff_id, publication_type, publication_year, publisher, title)
 VALUES ('$inst','$stfid','$type','$pubyear','$publisher','$title')";
    $insrun = $conn->query($dbcon,$ins);
    if($insrun){
        $response['errorCode'] = "0";
        $response['errorMsg'] = "Staff Publication Added Successfully";
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Staff Publication Could Not Be Created. Please Try Again";
    }


    print json_encode($response);
}


if(isset($_POST['addConference'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $stfid=mysqli_real_escape_string($dbcon,$_POST['stfid']);
    $inst=mysqli_real_escape_string($dbcon,$_POST['inst']);
    $organiser=mysqli_real_escape_string($dbcon,$_POST['organiser']);
    $title=mysqli_real_escape_string($dbcon,$_POST['title']);
    $venue=mysqli_real_escape_string($dbcon,$_POST['venue']);
    $country=mysqli_real_escape_string($dbcon,$_POST['country']);
    $sdate=mysqli_real_escape_string($dbcon,$_POST['sdate']);
    $edate=mysqli_real_escape_string($dbcon,$_POST['edate']);
    $city=mysqli_real_escape_string($dbcon,$_POST['city']);

    $year = date("Y", strtotime($sdate));

    $ins = "INSERT INTO conferenceworkshop (institution, staff_id, year, conference, organizer, venue, city, country, start_date, end_date)
 VALUES ('$inst','$stfid','$year','$title','$organiser','$venue','$city','$country','$sdate','$edate')";
    $insrun = $conn->query($dbcon,$ins);
    if($insrun){
        $response['errorCode'] = "0";
        $response['errorMsg'] = "Conference And Workshop Added Successfully";
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Conference And Workshop Could Not Be Created. Please Try Again";
    }


    print json_encode($response);
}

if(isset($_POST['addContact'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $inst=mysqli_real_escape_string($dbcon,$_POST['inst']);
    $year=mysqli_real_escape_string($dbcon,$_POST['year']);
    $head=mysqli_real_escape_string($dbcon,$_POST['head']);
    $headphone=mysqli_real_escape_string($dbcon,$_POST['headphone']);
    $heademail=mysqli_real_escape_string($dbcon,$_POST['heademail']);
    $person=mysqli_real_escape_string($dbcon,$_POST['person']);
    $email=mysqli_real_escape_string($dbcon,$_POST['email']);
    $phone=mysqli_real_escape_string($dbcon,$_POST['phone']);
    $accredit=mysqli_real_escape_string($dbcon,$_POST['accredit']);
    $expire=mysqli_real_escape_string($dbcon,$_POST['expire']);

    $ins = "INSERT INTO contacts (institution, academic_year, date_first_accreditation, date_accreditation_expires, name_of_head, phone_of_head, email_of_head, filled_by_name, filled_by_phone, filled_by_email)
 VALUES ('$inst','$year','$accredit','$expire','$head','$headphone','$heademail','$person','$email','$phone')";
    $insrun = $conn->query($dbcon,$ins);
    if($insrun){
        $response['errorCode'] = "0";
        $response['errorMsg'] = "Contact Added Successfully";
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Contact Could Not Be Created. Please Try Again";
    }


    print json_encode($response);
}

if(isset($_POST['addProgram'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $inst=mysqli_real_escape_string($dbcon,$_POST['inst']);
    $year=mysqli_real_escape_string($dbcon,$_POST['year']);
    $college=mysqli_real_escape_string($dbcon,$_POST['college']);
    $faculty=mysqli_real_escape_string($dbcon,$_POST['faculty']);
    $dept=mysqli_real_escape_string($dbcon,$_POST['dept']);
    $title=mysqli_real_escape_string($dbcon,$_POST['title']);
    $isced=mysqli_real_escape_string($dbcon,$_POST['isced']);
    $accredit=mysqli_real_escape_string($dbcon,$_POST['accredit']);
    $expire=mysqli_real_escape_string($dbcon,$_POST['expire']);

    $ins = "INSERT INTO programmes (institution, accreditation_year, faculty_school, department, college, programme, programme_isced_code, accredited_date, expiration_date)
 VALUES ('$inst','$year','$faculty','$dept','$college','$title','$isced','$accredit','$expire')";
    $insrun = $conn->query($dbcon,$ins);
    if($insrun){
        $response['errorCode'] = "0";
        $response['errorMsg'] = "Programme Added Successfully";
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Programme Could Not Be Created. Please Try Again";
    }


    print json_encode($response);
}

if(isset($_POST['addProposed'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $inst=mysqli_real_escape_string($dbcon,$_POST['inst']);
    $year=mysqli_real_escape_string($dbcon,$_POST['year']);
    $college=mysqli_real_escape_string($dbcon,$_POST['college']);
    $faculty=mysqli_real_escape_string($dbcon,$_POST['faculty']);
    $dept=mysqli_real_escape_string($dbcon,$_POST['dept']);
    $title=mysqli_real_escape_string($dbcon,$_POST['title']);
    $isced=mysqli_real_escape_string($dbcon,$_POST['isced']);

    $ins = "INSERT INTO proposed (institution, accreditation_year, faculty_school, department, college, programme, programme_isced_code)
 VALUES ('$inst','$year','$faculty','$dept','$college','$title','$isced')";
    $insrun = $conn->query($dbcon,$ins);
    if($insrun){
        $response['errorCode'] = "0";
        $response['errorMsg'] = "Proposed Programme Added Successfully";
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Proposed Programme Could Not Be Created. Please Try Again";
    }


    print json_encode($response);
}

if(isset($_POST['updateUser'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $id = $_POST['updateUser'];
    $response =array();

    //FETCH THE ROLE RECORDS
    $sel = "SELECT username, email, first_name, last_name, institution, phone, account_type, status, roleid FROM users WHERE id = $id";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) == 0){
        print "Not Found";
    }else{
        $rows = $conn->fetch($selrun);
        $userid = $rows['username'];

        //FETCH THE USERPAGES
        $pages = "SELECT pages FROM userspages WHERE userid = '$userid'";
        $pagesrun = $conn->query($dbcon,$pages);
        $pagesdata = $conn->fetch($pagesrun);

        //GET THE ROLE NAME AND INSTITUTION
        $rolename = getRole($rows['roleid']);
        $institute = getInstitution($rows['institution']);
        $response = Array();
        $response['username'] = $rows['username'];
        $response['email'] = $rows['email'];
        $response['fname'] = $rows['first_name'];
        $response['lname'] = $rows['last_name'];
        $response['institution'] = $rows['institution'];
        $response['institute'] = $institute;
        $response['phone'] = $rows['phone'];
        $response['actype'] = $rows['account_type'];
        $response['status'] = $rows['status'];
        $response['roleid'] = $rows['roleid'];
        $response['rolename'] = $rolename;
        $response['pages'] = $pagesdata['pages'];
        print json_encode($response);
    }
    $conn->close($dbcon);
}

if(isset($_POST['updateRoleData'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $access = mysqli_real_escape_string($dbcon,$_POST['updateRoleData']);
    $id = $_POST['id'];
    $title = mysqli_real_escape_string($dbcon,$_POST['title']);
    $response = array();

    $upd = "UPDATE roles SET role = '$title', permissions = '$access' WHERE id = $id";
    $updrun = $conn->query($dbcon, $upd);
    if($updrun){
        $response['errorCode'] = "0";
        $response['errorMsg'] = "Role Updated";
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Role Not Updated";
    }
    print json_encode($response);
}

//UPDATE PASSWORD FUNCTION
if(isset($_POST['updatePassword'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $username = mysqli_real_escape_string($dbcon,$_POST['updatePassword']);
    $currpassword = mysqli_real_escape_string($dbcon,$_POST['currpassword']);
    $newpassword = mysqli_real_escape_string($dbcon,$_POST['newpassword']);
    $response =array();

    //FETCH THE ROLE RECORDS
    $sel = "SELECT password FROM users WHERE username = '$username'";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) == 0){
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Username Not Found";
    }else{
        $rows = $conn->fetch($selrun);
        $oldhash = $rows['password'];

        if(password_verify($currpassword, $oldhash)){
            $hashnew = password_hash($newpassword, PASSWORD_ARGON2I);
            $upd = "UPDATE users SET password = '$hashnew' WHERE username='$username'";
            $conn->query($dbcon,$upd);

            $response['errorCode'] = "0";
            $response['errorMsg'] = "Your account password has been updated successfully";
        }
        else{
            $response['errorCode'] = "1";
            $response['errorMsg'] = "Old password supplied is wrong";
        }
    }

    print json_encode($response);
    $conn->close($dbcon);
}
?>