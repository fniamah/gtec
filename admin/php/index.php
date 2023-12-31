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

if(isset($_GET['validateUser'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $uname = mysqli_real_escape_string($dbcon,$_GET['validateUser']);
    $pword = mysqli_real_escape_string($dbcon,$_GET['pword']);
    $response =array();

    if($pword == "" || $uname == ""){
        $response['erroCode'] = "1";
        $response['errorMsg'] = "Missing username or password";

        $log = date("Y-m-d H:i:s")." Response: Missing username or password".PHP_EOL;
        logrequest($log,"System Logs");
    }else{
        //CHECK IF USER RECORDS EXISTS
        $chk = "SELECT status, password FROM users WHERE email = '$uname'";
        $chkrun = $conn->query($dbcon,$chk);
        if($conn->sqlnum($chkrun) == 0){
            $response['errorCode'] = "1";
            $response['errorMsg'] = "E-mail does not exist";

            $log = date("Y-m-d H:i:s")." Username: $uname Response: E-mail does not exist".PHP_EOL;
            logrequest($log,"System Logs");
        }else{
            //GET THE STATUS
            $data = $conn->fetch($chkrun);
            $status = $data['status'];
            $hash = $data['password'];

            if($status == "Pending"){
                $response['errorCode'] = "1";
                $response['errorMsg'] = "Your Account Has Not Been Validated. Kindly Check Your E-mail, $uname, To Activate Your Account To Proceed";

                $log = date("Y-m-d H:i:s")." Your Account Has Not Been Validated. Kindly Check Your E-mail, $uname, To Activate Your Account To Proceed".PHP_EOL;
                logrequest($log,"System Logs");
            }elseif($status == "Inactive"){
                $response['errorCode'] = "1";
                $response['errorMsg'] = "Your Account is inactive. Contact your systems administrator for assistance";
                $log = date("Y-m-d H:i:s")." Your Account, $uname, is inactive. Contact your systems administrator for assistance".PHP_EOL;
                logrequest($log,"System Logs");
            }else{
                //CHECK IF PASSWORDS MATCH
                if(password_verify($pword, $hash)){
                    $response['errorCode'] = "0";
                    $response['errorMsg'] = "Account validated successfully";
                    $log = date("Y-m-d H:i:s")." Account, $uname, is validated and logged in successfully.".PHP_EOL;
                    logrequest($log,"System Logs");

                }else{
                    $response['errorCode'] = "1";
                    $response['errorMsg'] = "Wrong Password Supplied";

                    $log = date("Y-m-d H:i:s")." Account, $uname, entered wrong password".PHP_EOL;
                    logrequest($log,"System Logs");
                }
            }
        }
    }
    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_GET['getStudentsGraphData'])){
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

if(isset($_GET['genderParityIndex'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $location = $_GET['genderParityIndex'];
    $selyear = "";
    $selyear2 = "";
    if(empty($location)){
        $selyear = "SELECT DISTINCT year FROM enrollments";
        $selyear2 = "SELECT nationality, COUNT(first_name) AS totalCount FROM enrollments GROUP BY nationality ORDER BY totalCount DESC LIMIT 10 ";
    }else{
        //GET THE ACCOUNT TYPE AND INSTITUTION
        if($_SESSION['actype'] == "Institution"){
            $selyear = "SELECT DISTINCT year FROM enrollments WHERE institution = '".$_SESSION['institution']."'";
            $selyear2 = "SELECT nationality, COUNT(first_name) AS totalCount FROM enrollments WHERE institution = '".$_SESSION['institution']."' GROUP BY nationality ORDER BY totalCount DESC LIMIT 10 ";
        }else{
            $selyear = "SELECT DISTINCT year FROM enrollments";
            $selyear2 = "SELECT nationality, COUNT(first_name) AS totalCount FROM enrollments GROUP BY nationality ORDER BY totalCount DESC LIMIT 10 ";
        }
    }
    //GET THE YEARS STUDENTS HAVE BEEN REGISTERED

    $selyearrun = $conn->query($dbcon,$selyear);
    $yearData = array();
    $enrollmentDataCount = array();

    while($data = $conn->fetch($selyearrun)){
        $femaleCount = getEnrollmentByYearByGender($data['year'],'Female',$location);
        $maleCount = getEnrollmentByYearByGender($data['year'],'Male',$location);
        $parityIndex = 0;
        if($maleCount > 0){
            $parityIndex = $femaleCount / $maleCount;
        }
        array_push($yearData,
            array(
                'year'        =>$data['year'],
                'parityIndex'        => $parityIndex,
            )
        );

        array_push($enrollmentDataCount,
            array(
                'year'        =>$data['year'],
                'totalCount'        => $femaleCount + $maleCount,
            )
        );
    }

    //GET THE YEARS STUDENTS HAVE BEEN REGISTERED
    $selyearrun2 = $conn->query($dbcon,$selyear2);

    $nationalityData = array();
    $tcount = 0;
    while($data = $conn->fetch($selyearrun2)){
        $dcount = $data['totalCount'];
        $tcount+=$dcount;
        array_push($nationalityData,
            array(
                "value"        =>(int)$dcount,
                "name"        => $data['nationality'],
            )
        );
    }

    //GET THE TOTAL ENROLLMENTS
    $enrollmentData = array();
    $enr = "SELECT name, id FROM institute_categories WHERE status = 'Active'";
    $enrun = $conn->query($dbcon,$enr);
    $tabledisp = "<table class='table table-striped table-responsive'><thead><tr><th>Category</th><th>Males</th><th>Females</th><th>Total</th><th>Percentage %</th></tr></thead><tbody>";
    $totalEnrollments = getTotalEnrollments();
    while($data = $conn->fetch($enrun)){
        $id = $data['id'];
        $instname = $data['name'];
        $getMaleEnrollments = getEnrollmentsByGenderByInstitution($id,'Male');
        $getFemaleEnrollments = getEnrollmentsByGenderByInstitution($id,'Female');
        $totalPerCat = $getMaleEnrollments + $getFemaleEnrollments;
        $tabledisp.="<tr><td>".$instname."</td><td>".$getMaleEnrollments."</td><td>".$getFemaleEnrollments."</td><td>".$totalPerCat."</td><td>".(($totalPerCat / $totalEnrollments)*100)."</td></tr>";
        /*array_push($enrollmentData,[
            "category" => $instname,
            "males" => $getMaleEnrollments,
            "females" => $getFemaleEnrollments,
        ]);*/
    }
    $tabledisp.="</tbody></table>";
    $tabeData = array();
    array_push($tabeData,[
        "data" => $tabledisp,
    ]);

    $feedback = array();
    array_push($feedback,array(
        "nationality" => $nationalityData,
        "students" => $yearData,
        "enrollments" => $tabeData,
        "totalenrollments" => $enrollmentDataCount,
    ));
    print json_encode($feedback);

    $conn->close($dbcon);
}

if(isset($_GET['summaryDataChart'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    //ISCED BAR CHARTS PER ENROLLMENTS
    $iscedQry = "SELECT name, code FROM isceds WHERE status='Active'";
    $iscedQryRun = $conn->query($dbcon,$iscedQry);

    $iscedData = array();

    while($data = $conn->fetch($iscedQryRun)){
        $percentageEnrollmentsByIsced = getEnrollmentByIsced($data['code']);
        array_push($iscedData,
            array(
                'value'        => $percentageEnrollmentsByIsced,
                'name'        =>$data['name'],

            )
        );
    }

    //GENDER PARITY
    $parityQry = "SELECT DISTINCT year FROM enrollments";
    $parityQryRun = $conn->query($dbcon,$parityQry);
    $parityData = array();

    while($data = $conn->fetch($parityQryRun)){
        $obj = json_decode(getGPIDetails($data['year']));
        array_push($parityData,
            array(
                'year'        =>$data['year'],
                'parityIndex'        => $obj->gpi,
            )
        );
    }

    //SUMMARIZE RESPONSES
    $feedback = array();
    array_push($feedback,array(
        "iscedDataCounts" => $iscedData,
        "parityData" => $parityData,
    ));
    print json_encode($feedback);

    $conn->close($dbcon);
}

if(isset($_GET['getEnrollmentByCountry'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    //GET THE YEARS STUDENTS HAVE BEEN REGISTERED
    $selyear = "SELECT nationality, COUNT(first_name) AS totalCount FROM enrollments GROUP BY nationality ORDER BY totalCount DESC LIMIT 10 ";
    $selyearrun = $conn->query($dbcon,$selyear);

    $nationalityData = array();
    $tcount = 0;
    while($data = $conn->fetch($selyearrun)){
        $dcount = $data['totalCount'];
        $tcount+=$dcount;
        array_push($nationalityData,
            array(
                "value"        =>(int)$dcount,
                "name"        => $data['nationality'],
            )
        );
    }

    print json_encode($nationalityData);
    //print_r($yearData);

    $conn->close($dbcon);
}

if(isset($_GET['getIscedCounts'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    //GET THE YEARS STUDENTS HAVE BEEN REGISTERED
    $selyear = "SELECT isced, COUNT(institution) AS totalCount FROM acc_programmes GROUP BY isced";
    $selyearrun = $conn->query($dbcon,$selyear);

    $nationalityData = array();
    while($data = $conn->fetch($selyearrun)){
        $dcount = $data['totalCount'];
        array_push($nationalityData,
            array(
                "value"        =>(int)$dcount,
                "name"        => getIsced($data['isced']),
            )
        );
    }

    print json_encode($nationalityData);

    $conn->close($dbcon);
}

if(isset($_POST['addUser'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $access = mysqli_real_escape_string($dbcon,$_POST['addUser']);
    $fname = mysqli_real_escape_string($dbcon,$_POST['fname']);
    $lname = mysqli_real_escape_string($dbcon,$_POST['lname']);
    $contact = mysqli_real_escape_string($dbcon,$_POST['contact']);
    $email = mysqli_real_escape_string($dbcon,$_POST['email']);
    $actype = mysqli_real_escape_string($dbcon,$_POST['actype']);
    $role = mysqli_real_escape_string($dbcon,$_POST['role']);
    $password = mysqli_real_escape_string($dbcon,$_POST['password']);
    $institution = mysqli_real_escape_string($dbcon,$_POST['institution']);

    $hash = password_hash($password, PASSWORD_ARGON2I);

    //CHECK IF USERNAME HAS NOT BEEN TAKEN
    $chkuname = "SELECT first_name FROM users WHERE email='$email' OR phone='$contact'";
    $chkunamerun = $conn->query($dbcon,$chkuname);
    if($conn->sqlnum($chkunamerun) == 0){
        //ADD THE USER RECORDS AS WELL AS THE PASSWORD
        $user = "INSERT INTO users(first_name, last_name, institution, email, phone, account_type, status, password, roleid)
VALUES('$fname','$lname','$institution','$email','$contact','$actype','Active','$hash','$role')";
        $userrun = $conn->query($dbcon,$user);
        if($userrun){
            //CREATE USER PAGES
            $pages = "INSERT INTO userspages(pages,userid) VALUES('$access','$email')";
            $conn->query($dbcon,$pages);

            //SEND EMAIL TO THE USER
            //TO ACCOUNT HOLDER
            sendEmail($email,"Congratulations! Your account has been created on GTEC as a user. Find your account details below:<br/> E-mail:$email <br/>Password:$password.<br/> Remember to constantly update your password.",'no-reply@gtec.com','Account Creation');

            $response['erroCode'] = "0";
            $response['errorMsg'] = "Account Created Successfully, Pending user activation";

            $log = date("Y-m-d H:i:s")." Account, $email, is created successfully.".PHP_EOL;
            logrequest($log,"System Logs");
        }else{
            $response['erroCode'] = "1";
            $response['errorMsg'] = "Account creation failed. Contact the systems administrators for assistance";
        }


    }else{
        $response['erroCode'] = "1";
        $response['errorMsg'] = "Account Creation Failed: E-mail and Contact should be unique to each user created.";
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

if(isset($_GET['getGps'])){
    $digaddress = $_GET['getGps'];
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
    $class = mysqli_real_escape_string($dbcon,$_POST['classify']);
    $target = mysqli_real_escape_string($dbcon,$_POST['target']);

    //CHECK IF CODE HAS NOT BEEN TAKEN
    $chkuname = "SELECT name FROM isceds WHERE code = '$code'";
    $chkunamerun = $conn->query($dbcon,$chkuname);
    if($conn->sqlnum($chkunamerun) == 0){
        //ADD THE USER RECORDS AS WELL AS THE PASSWORD
        $user = "INSERT INTO isceds(name, code, description, classify, target) VALUES('$title','$code','$description','$class',$target)";
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
    $classify = mysqli_real_escape_string($dbcon,$_POST['classify']);
    $target = mysqli_real_escape_string($dbcon,$_POST['target']);

    //UPDATE
    $upd = "UPDATE isceds SET name = '$title', description = '$description', classify = '$classify', target=$target WHERE code ='$code'";
    $conn->query($dbcon,$upd);

    $response['errorCode'] = "0";
    $response['errorMsg'] = "ISCED Updated Successfully";

    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_GET['getInstitutePrograms'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $id = mysqli_real_escape_string($dbcon,$_GET['getInstitutePrograms']);
    $flag = mysqli_real_escape_string($dbcon,$_GET['flag']);
    $sel = "SELECT id, programme FROM acc_programmes WHERE institution='$id' ORDER BY programme ASC";
    $selrun = $conn->query($dbcon,$sel);

    $response = "";
    if($conn->sqlnum($selrun) == 0){
        $response = $response."<option value=''></option>";
    }else{
        if($flag == "All"){
            $response = $response."<option value='All'>All</option>";
        }
        while($data = $conn->fetch($selrun)){
            $response = $response."<option value='".$data['programme']."'>".getProgram($data['programme'])."</option>";
        }
    }
    print $response;

    $conn->close($dbcon);
}

if(isset($_POST['updateRank'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $id = mysqli_real_escape_string($dbcon,$_POST['updateRank']);
    $rank = mysqli_real_escape_string($dbcon,$_POST['rank']);
    $status = mysqli_real_escape_string($dbcon,$_POST['status']);
    $target = mysqli_real_escape_string($dbcon,$_POST['target']);

    $chk = "SELECT SUM(target) AS targets FROM staffranks WHERE id <> $id";
    $chkrun = $conn->query($dbcon,$chk);
    $chkdata = $conn->fetch($chkrun);
    if(($chkdata['targets'] + $target) <= 100.00) {
        //UPDATE
        $upd = "UPDATE staffranks SET status = '$status',rank = '$rank', target = $target WHERE id =$id";
        $conn->query($dbcon, $upd);
        $response['errorCode'] = "0";
        $response['errorMsg'] = "Rank Updated Successfully";
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Staff rank target of 100% is exceeded. Kindly rectify and try again";
    }



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

if(isset($_POST['addInstCollege'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $name = mysqli_real_escape_string($dbcon,$_POST['name']);
    $description = mysqli_real_escape_string($dbcon,$_POST['description']);

    //CHECK IF CODE HAS NOT BEEN TAKEN
    $chkuname = "SELECT name FROM institute_colleges WHERE name = '$name'";
    $chkunamerun = $conn->query($dbcon,$chkuname);
    if($conn->sqlnum($chkunamerun) == 0){
        //ADD THE USER RECORDS AS WELL AS THE PASSWORD
        $user = "INSERT INTO institute_colleges(name, description, status) VALUES('$name','$description','Active')";
        $conn->query($dbcon,$user);

        $response['errorCode'] = "0";
        $response['errorMsg'] = "Institution College Created Successfully";

    }else{
        $row = $conn->fetch($chkunamerun);
        $name = $row['name'];
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Institution College, $name, Already Exists.";
    }

    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['addInstFaculty'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $name = mysqli_real_escape_string($dbcon,$_POST['name']);
    $description = mysqli_real_escape_string($dbcon,$_POST['description']);

    //CHECK IF CODE HAS NOT BEEN TAKEN
    $chkuname = "SELECT name FROM institute_faculties WHERE name = '$name'";
    $chkunamerun = $conn->query($dbcon,$chkuname);
    if($conn->sqlnum($chkunamerun) == 0){
        //ADD THE USER RECORDS AS WELL AS THE PASSWORD
        $user = "INSERT INTO institute_faculties(name, description, status) VALUES('$name','$description','Active')";
        $conn->query($dbcon,$user);

        $response['errorCode'] = "0";
        $response['errorMsg'] = "Institution Faculty Created Successfully";

    }else{
        $row = $conn->fetch($chkunamerun);
        $name = $row['name'];
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Institution Faculty, $name, Already Exists.";
    }

    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['addNewProg'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $name = mysqli_real_escape_string($dbcon,$_POST['name']);
    $isced = mysqli_real_escape_string($dbcon,$_POST['isced']);

    //CHECK IF CODE HAS NOT BEEN TAKEN
    $chkuname = "SELECT programme FROM programmes WHERE programme='$name'";
    $chkunamerun = $conn->query($dbcon,$chkuname);
    if($conn->sqlnum($chkunamerun) == 0){
        //ADD THE PROGRAM RECORDS
        $user = "INSERT INTO programmes(programme, status, prog_isced) VALUES('$name','Active','$isced')";
        $conn->query($dbcon,$user);

        $response['errorCode'] = "0";
        $response['errorMsg'] = "New Program Created Successfully";

    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Program, $name, With Code, $description Already Exists.";
    }

    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['addInstDepartment'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $name = mysqli_real_escape_string($dbcon,$_POST['name']);
    $description = mysqli_real_escape_string($dbcon,$_POST['description']);

    //CHECK IF CODE HAS NOT BEEN TAKEN
    $chkuname = "SELECT name FROM institute_departments WHERE name = '$name'";
    $chkunamerun = $conn->query($dbcon,$chkuname);
    if($conn->sqlnum($chkunamerun) == 0){
        //ADD THE USER RECORDS AS WELL AS THE PASSWORD
        $user = "INSERT INTO institute_departments(name, description, status) VALUES('$name','$description','Active')";
        $conn->query($dbcon,$user);

        $response['errorCode'] = "0";
        $response['errorMsg'] = "Institution Department Created Successfully";

    }else{
        $row = $conn->fetch($chkunamerun);
        $name = $row['name'];
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Institution Department, $name, Already Exists.";
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
    $chkuname = "SELECT id,staff_type FROM staffcategory WHERE staff_type = '$name'";
    $chkunamerun = $conn->query($dbcon,$chkuname);
    if($conn->sqlnum($chkunamerun) == 0){
        //ADD THE USER RECORDS AS WELL AS THE PASSWORD
        $user = "INSERT INTO staffcategory(staff_type, ranks, status, default_type) VALUES('$name','$rank','Active','None')";
        $conn->query($dbcon,$user);

        $response['errorCode'] = "0";
        $response['errorMsg'] = "Staff Category Created Successfully";

    }else{
        $row = $conn->fetch($chkunamerun);
        $name = $row['staff_type'];
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Staff Category, $name, Already Exists.";
    }

    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['editStaffCategory'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $name = mysqli_real_escape_string($dbcon,$_POST['name']);
    $id = mysqli_real_escape_string($dbcon,$_POST['catid']);
    $status = mysqli_real_escape_string($dbcon,$_POST['status']);
    $rank = $_POST['rank'];

    //ADD THE USER RECORDS AS WELL AS THE PASSWORD
    $user = "UPDATE staffcategory SET staff_type = '$name', ranks = '$rank', status = '$status' WHERE id=$id";
    $conn->query($dbcon,$user);

    $response['errorCode'] = "0";
    $response['errorMsg'] = "Staff Category Updated Successfully";

    print json_encode($response);
    $conn->close($dbcon);
}

if(isset($_POST['addStaffRank'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $rank = mysqli_real_escape_string($dbcon,$_POST['addStaffRank']);
    $target = mysqli_real_escape_string($dbcon,$_POST['target']);

    //CHECK IF CODE HAS NOT BEEN TAKEN
    $chkuname = "SELECT id FROM staffranks WHERE rank = '$rank'";
    $chkunamerun = $conn->query($dbcon,$chkuname);
    if($conn->sqlnum($chkunamerun) == 0){
        //CHECK PERCENTAGE TARGET
        $chk = "SELECT SUM(target) AS targets FROM staffranks";
        $chkrun = $conn->query($dbcon,$chk);
        $chkdata = $conn->fetch($chkrun);
        if(($chkdata['targets'] + $target) > 100.00){
            $response['errorCode'] = "1";
            $response['errorMsg'] = "Staff rank target of 100% is exceeded. Kindly rectify and try again";
        }else{
            //ADD THE USER RECORDS AS WELL AS THE PASSWORD
            $user = "INSERT INTO staffranks(rank, status, target, default_type) VALUES('$rank','Active',$target,'None')";
            $conn->query($dbcon,$user);
            $response['errorCode'] = "0";
            $response['errorMsg'] = "Staff Rank Created Successfully";
        }

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
    $hname = mysqli_real_escape_string($dbcon,$_POST['hname']);
    $hcont = mysqli_real_escape_string($dbcon,$_POST['hcont']);
    $hmail = mysqli_real_escape_string($dbcon,$_POST['hmail']);
    $fname = mysqli_real_escape_string($dbcon,$_POST['fname']);
    $fcont = mysqli_real_escape_string($dbcon,$_POST['fcont']);
    $fmail = mysqli_real_escape_string($dbcon,$_POST['fmail']);
    $accredit = mysqli_real_escape_string($dbcon,$_POST['accredit']);
    $expire = mysqli_real_escape_string($dbcon,$_POST['expire']);

    //CHECK IF INSTITUTION ALREADY EXISTS
    $chkCode = "SELECT short_name FROM institutes WHERE institution_code = '$code'";
    $chkcoderun = $conn->query($dbcon,$chkCode);
    if($conn->sqlnum($chkcoderun) == 0){
        $ins = "INSERT INTO institutes (short_name,institution_code,name,category_id,status,region,district,town,latitude,longitude,digital_address
,contact_telephone,contact_email,url,description,hname, hcont, hmail, fname, fcont, fmail,accredit,expire)VALUES('$short','$code','$name',$cat,'Active','$reg',
'$district','$town',$lat,$longt,'$dig','$tel','$email','$url','$desc','$hname','$hcont','$hmail','$fname','$fcont','$fmail','$accredit','$expire')";
        if($conn->query($dbcon, $ins)) {
            //CHECK DISTRICT AND REGION
            $chkdistrict = "SELECT id FROM reg_districts WHERE district = '$district' AND region='$reg'";
            $chkdistrictrun = $conn->query($dbcon, $chkdistrict);
            if ($conn->sqlnum($chkdistrictrun) == 0) {
                $ins = "INSERT INTO reg_districts(region, district) VALUES ('$reg','$district')";
                $conn->query($dbcon, $ins);
            }
            $response['errorCode'] = "0";
            $response['errorMsg'] = "Institution, $name, added successfully.";
            print json_encode($response);
        }else{
            $response['errorCode'] = "1";
            $response['errorMsg'] = "Institution, $name, could not be added. Please try again.";
            print json_encode($response);
        }
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Institution With The Code, $code, Already Exists.";
        print json_encode($response);
    }
    $conn->close($dbcon);
}

if(isset($_POST['updateInstitution'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $name = mysqli_real_escape_string($dbcon,$_POST['updateInstitution']);
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
    $hname = mysqli_real_escape_string($dbcon,$_POST['hname']);
    $hcont = mysqli_real_escape_string($dbcon,$_POST['hcont']);
    $hmail = mysqli_real_escape_string($dbcon,$_POST['hmail']);
    $fname = mysqli_real_escape_string($dbcon,$_POST['fname']);
    $fcont = mysqli_real_escape_string($dbcon,$_POST['fcont']);
    $fmail = mysqli_real_escape_string($dbcon,$_POST['fmail']);
    $accredit = mysqli_real_escape_string($dbcon,$_POST['accredit']);
    $expire = mysqli_real_escape_string($dbcon,$_POST['expire']);

    //CHECK IF INSTITUTION ALREADY EXISTS
    $chkCode = "SELECT short_name FROM institutes WHERE institution_code = '$code'";
    $chkcoderun = $conn->query($dbcon,$chkCode);
    if($conn->sqlnum($chkcoderun) == 1){
        $ins = "UPDATE institutes SET short_name = '$short',name='$name',category_id='$cat',region='$reg',
district='$district',town='$town',latitude='$lat',longitude='$longt',digital_address='$dig',contact_telephone='$dig',contact_email='$email',
url='$url',description='$desc',hname='$hname', hcont='$hcont', hmail='$hmail', fname='$fname', fcont='$fcont', fmail='$fmail',accredit = '$accredit',expire='$expire' WHERE institution_code = '$code'";
        if($conn->query($dbcon, $ins)) {
            //CHECK DISTRICT AND REGION
            $chkdistrict = "SELECT id FROM reg_districts WHERE district = '$district' AND region='$reg'";
            $chkdistrictrun = $conn->query($dbcon, $chkdistrict);
            if ($conn->sqlnum($chkdistrictrun) == 0) {
                $ins = "INSERT INTO reg_districts(region, district) VALUES ('$reg','$district')";
                $conn->query($dbcon, $ins);
            }
            $response['errorCode'] = "0";
            $response['errorMsg'] = "Institution, $name, Updated successfully.";
            print json_encode($response);
        }else{
            $response['errorCode'] = "1";
            $response['errorMsg'] = "Institution, $name, could not be updated. Please try again.";
            print json_encode($response);
        }
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Institution With The Code, $code, Does Not Exist.";
        print json_encode($response);
    }
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

if(isset($_POST['rejectRow'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $id = $_POST['rejectRow'];
    $status = $_POST['status'];
    $note = $_POST['note'];

    $response =array();
    $user = $_SESSION['uname'];

    if($status == "Rejected"){
        $ins="UPDATE acc_programmes_proposed SET notes='$note', status = '$status', modify_by = '$user', updatedAt = '".date('Y-m-d H:i:s')."' WHERE id = $id";
    }else{
        //GET THE DETAILS OF THE PROPOSED PROGRAM
        $getprop = "SELECT programme, isced FROM acc_programmes_proposed WHERE id = $id";
        $getproprun = $conn->query($dbcon,$getprop);
        $getpropdata = $conn->fetch($getproprun);

        $accdate = $_POST['accdate'];
        $expirydate = $_POST['expirydate'];
        $isced = $getpropdata['isced'];
        $prog = $getpropdata['programme'];
        $certid = $_POST['certid'];

        //ADD PROGRAM TO THE LIST OF PROGRAMS
        $checkprog = "SELECT prog_isced FROM programmes WHERE programme = '$prog'";
        $checkprogrun = $conn->query($dbcon,$checkprog);
        if($conn->sqlnum($checkprogrun) == 0){
            $insprog = "INSERT INTO programmes (programme, prog_isced, status) VALUES('$prog','$isced','Active')";
            $conn->query($dbcon,$insprog);
        }

        //GET THE ID OF THE INSERTED PROGRAMME
        $selid = "SELECT prog_code FROM programmes WHERE programme = '$prog'";
        $selidrun = $conn->query($dbcon,$selid);
        $seliddata = $conn->fetch($selidrun);
        $pid = $seliddata['prog_code'];

        //MOVE THE RECORDS FROM THE PROPOSED  TO ACCREDITED PROGRAM
        $ins="INSERT INTO acc_programmes (certid,institution, accreditation_year, faculty_school, department, college, programme, accredited_date, expiration_date,fname,fcont,fmail,hname,hcont,hmail,approved_by, approved_date,notes,isced)
              SELECT $certid, institution, accreditation_year, faculty_school, department, college, '$pid', '$accdate', '$expirydate',fname,fcont,fmail,hname,hcont,hmail,'$user','".date('Y-m-d H:i:s')."','$note', isced FROM acc_programmes_proposed WHERE id=$id";
    }

    $insrun = $conn->query($dbcon,$ins);

    if($insrun){
        if($status == "Accepted"){
            //DELETE THE PROPOSED PROGRAMME
            $del = "DELETE FROM acc_programmes_proposed WHERE id=$id";
            $conn->query($dbcon,$del);
        }

        $response['errorCode'] = "0";
        $response['errorMsg'] = "Proposed program has been $status";
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Proposed program could not be completed. Please contact systems administrator";
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


if(isset($_GET['getIsced'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $id = $_GET['getIsced'];
    $response =array();

    //FETCH THE ROLE RECORDS
    $sel = "SELECT name, code,description, status, classify, target FROM isceds WHERE id = $id";
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
                    <div class='col-md-4' align='right'><label>Code:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <input type='text' id='icodeedit' readonly value='".$rows['code']."' class='form-control' placeholder='ISCED Title' />
                        </div>
                    </div>
                </div>
                <div class='row' align='center'>
                    <div class='col-md-4' align='right'><label>Name:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <input type='text' id='ititleedit' value='".$rows['name']."' class='form-control' placeholder='ISCED CODE' />
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-4' align='right'><label>Description:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <textarea id='idescriptedit' placeholder='ISCED DESCRIPTION' class='form-control' maxlength='1000' rows='5'> ".$rows['description']."</textarea>
                        </div>
                    </div>
                </div>
                <div class='row' align='center'>
                    <div class='col-md-4' align='right'><label>STR Target:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <input type='text' id='itargetedit' value='".$rows['target']."' class='form-control' />
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-4' align='right'><label>Classification:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <select  id='iclassedit'  data-placeholder='Select Classififcation' class='form-control'>
                                <option value='".$rows['classify']."'>".$rows['classify']."</option>
                                <option value='Engineering'>Engineering</option>
                                <option value='Humanities'>Humanities</option>
                                <option value='Sciences'>Sciences</option>
                            </select>
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

if(isset($_GET['sortDataTableAccPrograms'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $year = $_GET['year'];
    $inst = $_GET['inst'];

    $clause = "";
    if($year != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE accreditation_year = '$year'";
        }else{
            $clause = $clause."AND accreditation_year = '$year'";
        }
    }
    if($inst != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE institution = '$inst'";
        }else{
            $clause = $clause."AND institution = '$inst'";
        }
    }


    $qry = "SELECT * FROM acc_programmes $clause";
    $qryrun = $conn->query($dbcon,$qry);
    $data ="<table class='table table-striped table-responsive' id='accreditedPrograms'><thead><tr>
                                            <th>Certificate ID</th>
                                            <th>Name Of Program</th>
                                            <th>Institution</th>
                                            <th>ISCED</th>
                                            <th>Accreditation Year</th>
                                            <th>College</th>
                                            <th>Faculty / School</th>
                                            <th>Department</th>
                                            <th>Name Of Head</th>
                                            <th>E-mail Of Head</th>
                                            <th>Contact Of Head</th>
                                            <th>Name Of Person Filling Form</th>
                                            <th>E-mail Of Person Filling Form</th>
                                            <th>Contact Of Person Filling Form</th>
                                            <th>Accreditation Date</th>
                                            <th>Expiry Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>";
    while($row = $conn->fetch($qryrun)){
        $data = $data."<tr>
                            <td>".$row['certid']."</td>
                            <td>".getProgram($row['programme'])."</td>
                            <td>".getInstitution($row['institution'])."</td>
                            <td>".getIsced($row['isced'])."</td>
                            <td>".$row['accreditation_year']."</td>
                            <td>".getCollege($row['college'])."</td>
                            <td>".getFaculty($row['faculty_school'])."</td>
                            <td>".getDepartment($row['department'])."</td>
                            <td>".$row['hname']."</td>
                            <td>".$row['hmail']."</td>
                            <td>".$row['hcont']."</td>
                            <td>".$row['fname']."</td>
                            <td>".$row['fmail']."</td>
                            <td>".$row['fcont']."</td>
                            <td>".$row['accredited_date']."</td>
                            <td>".$row['expiration_date']."</td>

                        </tr>";
    }

    if($data == ""){
        print("<tr><td colspan='10'>No Records Found</td></tr></tbody></table>");
    }else{
        print $data."</tbody></table>";
    }

    $conn->close($dbcon);

}

if(isset($_GET['sortDataTableAccProgramsProposed'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $year = $_GET['year'];
    $inst = $_GET['inst'];
    $actype = $_SESSION['actype'];

    $clause = "";
    if($year != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE accreditation_year = '$year'";
        }else{
            $clause = $clause."AND accreditation_year = '$year'";
        }
    }
    if($inst != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE institution = '$inst'";
        }else{
            $clause = $clause."AND institution = '$inst'";
        }
    }


    $qry = "SELECT * FROM acc_programmes_proposed $clause";
    $qryrun = $conn->query($dbcon,$qry);
    $data ="<table class='table table-striped table-responsive' id='accreditedProgramsProp'><thead><tr>
                                            <th>Name Of Program</th>
                                            <th>I.S.C.E.D</th>
                                            <th>Institution</th>
                                            <th>Accreditation Year</th>
                                            <th>College</th>
                                            <th>Faculty / School</th>
                                            <th>Department</th>
                                            <th>Name Of Head</th>
                                            <th>E-mail Of Head</th>
                                            <th>Contact Of Head</th>
                                            <th>Name Of Person Filling Form</th>
                                            <th>E-mail Of Person Filling Form</th>
                                            <th>Contact Of Person Filling Form</th>
                                            <th>Status</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>";
    while($row = $conn->fetch($qryrun)){
        $id = $row['id'];
        $isced = $row['isced'];
        $program = $row['programme'];
        $type = "acc_programmes_proposed";
        $acceptance = "Accepted";
        $action = "";
        if($actype == "GTEC"){
            $action.= "<a class='btn btn-success' onclick='rejectProposedProgram(".$id.",1)' data-popup='tooltip' title='Approve Proposed Programme' data-placement='bottom'><span class='icon icon-thumbs-up3'></span> Approve</a><br/><br/>";
            $action.= "<a class='btn btn-danger' onclick='rejectProposedProgram(".$id.",0)' data-popup='tooltip' title='Reject Proposed Programme' data-placement='bottom'><span class='icon icon-thumbs-down3'></span> Reject</a>";
        }
        $data = $data."<tr>
                            <td>".$row['programme']."</td>                   
                            <td>".getIsced($row['isced'])."</td>
                            <td>".getInstitution($row['institution'])."</td>
                            <td>".$row['accreditation_year']."</td>
                            <td>".getCollege($row['college'])."</td>
                            <td>".getFaculty($row['faculty_school'])."</td>
                            <td>".getDepartment($row['department'])."</td>
                            <td>".$row['hname']."</td>
                            <td>".$row['hmail']."</td>
                            <td>".$row['hcont']."</td>
                            <td>".$row['fname']."</td>
                            <td>".$row['fmail']."</td>
                            <td>".$row['fcont']."</td>
                            <td>".$row['status']."</td>
                            <td>".$action."</td>
                        </tr>";
    }

    if($data == ""){
        print("<tr><td colspan='10'>No Records Found</td></tr></tbody></table>");
    }else{
        print $data."</tbody></table>";
    }

    $conn->close($dbcon);

}

/*if(isset($_GET['sortDataTableInstitutions'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $cat = $_GET['cat'];

    $clause = "";
    if($cat != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE category_id = '$cat'";
        }else{
            $clause = $clause."AND category_id = '$cat'";
        }
    }


    $qry = "SELECT * FROM institutes $clause";
    $qryrun = $conn->query($dbcon,$qry);
    $data ="";
    while($row = $conn->fetch($qryrun)){
        $id = $row['id'];
        $data = $data."<tr>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['institution_code']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['name']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". getCategory($row['category_id'])."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['digital_address']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['region']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['district']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['town']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['contact_email']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['contact_telephone']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['hname']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['hcont']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['hmail']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['fname']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['fcont']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['fmail']."</a></td>
                            
                        </tr>";
    }

    if($data == ""){
        print("<tr><td colspan='8'>No Records Found</td></tr>");
    }else{
        print $data;
    }

    $conn->close($dbcon);

}*/

if(isset($_GET['sortDataTablePublication'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $year = $_GET['year'];
    $inst = $_GET['inst'];
    $type = $_GET['type'];

    $clause = "";
    if($year != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE publication_year = '$year'";
        }else{
            $clause = $clause."AND publication_year = '$year'";
        }
    }
    if($inst != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE institution_id = '$inst'";
        }else{
            $clause = $clause."AND institution_id = '$inst'";
        }
    }
    if($type != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE publication_type = '$type'";
        }else{
            $clause = $clause."AND publication_type = '$type'";
        }
    }


    $qry = "SELECT * FROM publication $clause";
    $qryrun = $conn->query($dbcon,$qry);
    $data ="<table class='table table-striped table-responsive' id='publications'><thead><tr>
                                            <th>Staff ID</th>
                                            <th>Staff Name</th>
                                            <th>Publication Type</th>
                                            <th>Publication Title</th>
                                            <th>Publication Year</th>
                                            <th>Publisher Of Publication</th>
                                            <th>Institution</th>
                                        </tr>
                                        </thead>
                                        <tbody>";
    while($row = $conn->fetch($qryrun)){
        $id = $row['id'];
        $data = $data."<tr>
                            <td>".$row['staff_id']."</td>
                            <td>".getStaff($row['staff_id'])."</td>
                            <td>".$row['publication_type']."</td>
                            <td>".$row['title']."</td>
                            <td>".$row['publication_year']."</td>
                            <td>".$row['publisher']."</td>
                            <td>".getInstitution($row['institution_id'])."</td>
                         </tr>";
    }

    if($data == ""){
        print("<tr><td colspan='7'>No Records Found</td></tr></tbody></table>");
    }else{
        print $data."</tbody></table>";
    }

    $conn->close($dbcon);

}

if(isset($_GET['sortDataTableConference'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $year = $_GET['year'];
    $inst = $_GET['inst'];

    $clause = "";
    if($year != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE year = '$year'";
        }else{
            $clause = $clause."AND year = '$year'";
        }
    }
    if($inst != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE institution = '$inst'";
        }else{
            $clause = $clause."AND institution = '$inst'";
        }
    }


    $qry = "SELECT * FROM conferenceworkshop $clause";
    $qryrun = $conn->query($dbcon,$qry);
    $data ="<table class='table table-striped table-responsive' id='conferences'><thead><tr>
                                            <th>Staff ID</th>
                                            <th>Staff Name</th>
                                            <th>Insitution</th>
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
                                        <tbody>";
    while($row = $conn->fetch($qryrun)){
        $id = $row['id'];
        $data = $data."<tr>
                            <td>".$row['staff_id']."</td>
                            <td>".getStaff($row['staff_id'])."</td>
                            <td>".getInstitution($row['institution'])."</td>
                            <td>".$row['conference']."</td>
                            <td>".$row['organizer']."</td>
                            <td>".$row['venue']."</td>
                            <td>".$row['country']."</td>
                            <td>".$row['city']."</td>
                            <td>".$row['start_date']."</td>
                            <td>".$row['end_date']."</td>
                            <td>".$row['createdAt']."</td>
                        </tr>";
    }

    if($data == ""){
        print("<tr><td colspan='10'>No Records Found</td></tr></tbody></table>");
    }else{
        print $data."</tbody></table>";
    }

    $conn->close($dbcon);

}
if(isset($_GET['sortDataTableStudents'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $year = $_GET['year'];
    $inst = $_GET['inst'];
    $prog = $_GET['prog'];
    $apptype = $_GET['apptype'];
    $progtype = $_GET['progtype'];
    $level = $_GET['level'];
    $feepay = $_GET['feepay'];

    $clause = "";
    if($year != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE year = '$year'";
        }else{
            $clause = $clause."AND year = '$year'";
        }
    }
    if($inst != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE institution = '$inst'";
        }else{
            $clause = $clause."AND institution = '$inst'";
        }
    }
    if($prog != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE (programme_applied = '$prog' OR programme_offered = '$prog')";
        }else{
            $clause = $clause."AND (programme_applied = '$prog' OR programme_offered = '$prog')";
        }
    }
    if($apptype != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE application_type = '$apptype'";
        }else{
            $clause = $clause."AND application_type = '$apptype'";
        }
    }
    if($level != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE admission_level = '$level'";
        }else{
            $clause = $clause."AND admission_level = '$level'";
        }
    }
    if($progtype != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE programme_type = '$progtype'";
        }else{
            $clause = $clause."AND programme_type = '$progtype'";
        }
    }

    if($feepay != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE fee_type = '$feepay'";
        }else{
            $clause = $clause."AND fee_type = '$feepay'";
        }
    }


    $qry = "SELECT * FROM enrollments $clause";
    $qryrun = $conn->query($dbcon,$qry);
    $data ="<table class='table table-hover' id='studentsearchtable'>
                                        <thead>
                                        <tr>
                                            <th> Student/Reference Number </th>
                                            <th>Student Name</th>
                                            <th>Gender</th>
                                            <th>Date of Birth</th>
                                            <th>Country Of Birth</th>
                                            <th>Nationality</th>
                                            <th>Religion</th>
                                            <th>Hometown</th>
                                            <th>Home Region</th>
                                            <th>Institution</th>
                                            <th>Application Year </th>
                                            <th> National ID Type</th>
                                            <th> National ID Number</th>
                                            <th>Senior High School Attended </th>
                                            <th> SHS Programme Offered  </th>
                                            <th> Name Of Programme Offered</th>
                                            <th> Admission Level</th>
                                            <th> Mode of Study</th>
                                            <th> Fee Paying Status</th>
                                            <th> Special Education Needs (Yes or No) </th>
                                            <th> Special Education Needs Type(e.g.Visually Impaired)</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>";
    while($row = $conn->fetch($qryrun)){
        $id = $row['id'];
        $data = $data."<tr>
                            <td><a href='../admin/dashboard.php?view_student=$id'>".$row['applicant_id']."</a></td>
                            <td>".$row['first_name']." ".$row['other_names']." ".$row['surname']."</td>
                            <td>".$row['gender']."</td>
                            <td>".$row['birth_date']."</td>
                            <td>".$row['birth_country']."</td>
                            <td>".$row['nationality']."</td>
                            <td>".$row['religion']."</td>
                            <td>".$row['home_town']."</td>
                            <td>".$row['home_region']."</td>
                            <td>".getInstitution($row['institution'])."</td>
                            <td>".$row['year']."</td>
                            <td>".$row['applicant_id_type']."</td>
                            <td>".$row['applicant_national_id']."</td>
                            <td>".$row['high_school']."</td>
                            <td>".$row['high_school_program']."</td>
                            <td>".getProgram($row['programme_offered'])."</td>
                            <td>".$row['admission_level']."</td>
                            <td>".$row['programme_type']."</td>
                            <td>".$row['fee_type']."</td>
                            <td>".$row['disability']."</td>
                            <td>".$row['disability_type']."</td>
                            <td>".$row['status']."</td>
                        </tr>";
    }

    if($data == ""){
        print("<tr><td colspan='9'>No Records Found</td></tr></tbody></table>");
    }else{
        print $data."</tbody></table>";
    }
    print_r(getallheaders());
    $conn->close($dbcon);

}


if(isset($_GET['getAllApplicants'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $institution = $_GET['getAllApplicants'];
    $prog = $_GET['prog'];
    $statCode = $_GET['status'];
    $status="";
    if($statCode == 1){
        $status = "Qualified";
    }elseif($statCode == 2){
        $status = "Offered";
    }elseif($statCode == 3){
        $status = "Enrolled";
    }else{
        $status = "Graduated";
    }

    $sel="";
    $title="";
    if($prog == "All"){
        $sel = "SELECT applicant_id, first_name, surname, other_names, programme_applied, programme_type, status FROM appadmissions WHERE institution = '$institution' AND status = '$status'";
        $title = "List Of All ".$status." Applicants For ".getInstitution($institution);
    }else{
        $sel = "SELECT applicant_id, first_name, surname, other_names, programme_applied, programme_type, status FROM appadmissions WHERE institution = '$institution' AND programme_applied='$prog' AND status = '$status'";
        $title = "List Of ".$status." Applicants For ".getInstitution($institution)."<br/> Offering ".getProgram($prog);
    }

    $errorCode="1";

    $selrun = $conn->query($dbcon,$sel);
    $response = "<table class='table table-striped' id='applicantsData'><thead><tr style='background-color: #ffffff; color: #000'><th colspan='7'><p style='text-align: center; font-weight: bold; font-size: large;'>$title</p></th></tr><tr><td>#</td><td><input type='checkbox' name='select-all' id='select-all' /></td><td>Applicant ID</td><td>Applicant Name</td><td>Programme Applied</td><td>Programme Type</td><td>Status</td></tr></thead><tbody>";
    $count=0;
    $btn="";
    if($conn->sqlnum($selrun) == 0){
        $response = $response."<tr><td colspan='6'>No Applicants Available For The Selection Above</td></tr>";
    }else{
        $btn =$btn."<div class='row'><div class='col-md-12' align='center'><button type='button' class='btn btn-dark btn-lg' onclick='updateApplicant(".$statCode.")'>Proceed</button></div></div>";
        while($data = $conn->fetch($selrun)){
            $count++;
            $response = $response."<tr><td>".$count."</td><td><input type='checkbox' name='check_list' value='".$data['applicant_id']."' id='<?php echo $count; ?>'/></td><td>".$data['applicant_id']."</td><td>".$data['first_name']." ".$data['other_names']." ".$data['surname']."</td><td>".getProgram($data['programme_applied'])."</td><td>".$data['programme_type']."</td><td>".$data['status']."</td></tr>";
        }
        $errorCode = "0";
    }
    $response = $response."</tbody></table>".$btn;
    $responses['data'] = $response;
    $responses['code'] = $errorCode;
    print json_encode($responses);

    $conn->close($dbcon);
}

if(isset($_GET['sortDataTableApplicants'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $year = $_GET['year'];
    $inst = $_GET['inst'];
    $prog = $_GET['prog'];
    $qualify = $_GET['qualify'];

    $clause = "";
    if($year != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE year = '$year'";
        }else{
            $clause = $clause."AND year = '$year'";
        }
    }
    if($inst != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE institution = '$inst'";
        }else{
            $clause = $clause."AND institution = '$inst'";
        }
    }
    if($prog != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE (programme_applied = '$prog' OR programme_offered = '$prog')";
        }else{
            $clause = $clause."AND (programme_applied = '$prog' OR programme_offered = '$prog')";
        }
    }

    if($qualify != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE status = '$qualify'";
        }else{
            $clause = $clause."AND status = '$qualify'";
        }
    }


    $qry = "SELECT * FROM appadmissions $clause";
    $qryrun = $conn->query($dbcon,$qry);
    $data ="<table class='table table-hover' id='appsearchtable'>
                <thead>
                <tr>
                    <th> Student/Reference Number </th>
                    <th>Student Name</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Country Of Birth</th>
                    <th>Nationality</th>
                    <th>Religion</th>
                    <th>Hometown</th>
                    <th>Home Region</th>
                    <th>Institution</th>
                    <th>Application Year </th>
                    <th> National ID Type</th>
                    <th> National ID Number</th>
                    <th>Senior High School Attended </th>
                    <th> SHS Programme Offered  </th>
                    <th> Name Of Programme Offered</th>
                    <th> Admission Level</th>
                    <th> Mode of Study</th>
                    <th> Fee Paying Status</th>
                    <th> Special Education Needs (Yes or No) </th>
                    <th> Special Education Needs Type(e.g.Visually Impaired)</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>";
    $errorCode="1";
    $count = 0;
    if($conn->sqlnum($qryrun) > 0){
        while($row = $conn->fetch($qryrun)){
            $count++;
            $id = $row['id'];
            $data.="<tr>
                            <td><a href='../admin/dashboard.php?view_applicant=$id'>".$row['applicant_id']."</a></td>
                            <td>".$row['first_name']." ".$row['other_names']." ".$row['surname']."</td>
                            <td>".$row['gender']."</td>
                            <td>".$row['birth_date']."</td>
                            <td>".$row['birth_country']."</td>
                            <td>".$row['nationality']."</td>
                            <td>".$row['religion']."</td>
                            <td>".$row['home_town']."</td>
                            <td>".$row['home_region']."</td>
                            <td>".getInstitution($row['institution'])."</td>
                            <td>".$row['year']."</td>
                            <td>".$row['applicant_id_type']."</td>
                            <td>".$row['applicant_national_id']."</td>
                            <td>".$row['high_school']."</td>
                            <td>".$row['high_school_program']."</td>
                            <td>".getProgram($row['programme_offered'])."</td>
                            <td>".$row['admission_level']."</td>
                            <td>".$row['programme_type']."</td>
                            <td>".$row['fee_type']."</td>
                            <td>".$row['disability']."</td>
                            <td>".$row['disability_type']."</td>
                            <td>".$row['status']."</td>
                        </tr>";
        }
        $errorCode = "0";
    }else{
        $data.="<tr><td colspan='22'>No Records Found</td></tr>";
    }
    $response = $data."</tbody></table>";
    $responses['data'] = $response;
    $responses['code'] = $errorCode;
    print json_encode($responses);

    $conn->close($dbcon);

}

if(isset($_GET['sortDataTableGraduates'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $year = $_GET['year'];
    $inst = $_GET['inst'];
    $prog = $_GET['prog'];
    $feepay = $_GET['feepay'];

    $clause = "";
    if($year != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE year = '$year'";
        }else{
            $clause = $clause."AND year = '$year'";
        }
    }
    if($inst != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE institution = '$inst'";
        }else{
            $clause = $clause."AND institution = '$inst'";
        }
    }
    if($prog != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE (programme_applied = '$prog' OR programme_offered = '$prog')";
        }else{
            $clause = $clause."AND (programme_applied = '$prog' OR programme_offered = '$prog')";
        }
    }

    if($feepay != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE fee_type = '$feepay'";
        }else{
            $clause = $clause."AND fee_type = '$feepay'";
        }
    }


    $qry = "SELECT * FROM graduates $clause";
    $qryrun = $conn->query($dbcon,$qry);
    $data ="<table class='table table-hover' id='studentsearchtable'>
                                        <thead>
                                        <tr>
                                            <th> Student/Reference Number </th>
                                            <th>Student Name</th>
                                            <th>Gender</th>
                                            <th>Date of Birth</th>
                                            <th>Country Of Birth</th>
                                            <th>Nationality</th>
                                            <th>Religion</th>
                                            <th>Hometown</th>
                                            <th>Home Region</th>
                                            <th>Institution</th>
                                            <th>Application Year </th>
                                            <th> National ID Type</th>
                                            <th> National ID Number</th>
                                            <th>Senior High School Attended </th>
                                            <th> SHS Programme Offered  </th>
                                            <th> Name Of Programme Offered</th>
                                            <th> Admission Level</th>
                                            <th> Mode of Study</th>
                                            <th> Fee Paying Status</th>
                                            <th> Special Education Needs (Yes or No) </th>
                                            <th> Special Education Needs Type(e.g.Visually Impaired)</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>";
    while($row = $conn->fetch($qryrun)){
        $id = $row['id'];
        $data = $data."<tr>
                            <td>".$row['applicant_id']."</td>
                            <td>".$row['first_name']." ".$row['other_names']." ".$row['surname']."</td>
                            <td>".$row['gender']."</td>
                            <td>".$row['birth_date']."</td>
                            <td>".$row['birth_country']."</td>
                            <td>".$row['nationality']."</td>
                            <td>".$row['religion']."</td>
                            <td>".$row['home_town']."</td>
                            <td>".$row['home_region']."</td>
                            <td>".getInstitution($row['institution'])."</td>
                            <td>".$row['year']."</td>
                            <td>".$row['applicant_id_type']."</td>
                            <td>".$row['applicant_national_id']."</td>
                            <td>".$row['high_school']."</td>
                            <td>".$row['high_school_program']."</td>
                            <td>".getProgram($row['programme_offered'])."</td>
                            <td>".$row['admission_level']."</td>
                            <td>".$row['programme_type']."</td>
                            <td>".$row['fee_type']."</td>
                            <td>".$row['disability']."</td>
                            <td>".$row['disability_type']."</td>
                            <td>".$row['status']."</td>
                        </tr>";
    }

    if($data == ""){
        print("<tr><td colspan='9'>No Records Found</td></tr></tbody></table>");
    }else{
        print $data."</tbody></table>";
    }

    $conn->close($dbcon);

}

if(isset($_GET['sortDataTableStaff'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $year = $_GET['year'];
    $inst = $_GET['inst'];
    $gender = $_GET['gender'];
    $qualify = $_GET['qualify'];
    $rank = $_GET['rank'];
    $cat = $_GET['category'];

    $clause = "";
    if($year != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE year = '$year'";
        }else{
            $clause = $clause."AND year = '$year'";
        }
    }
    if($inst != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE institution = '$inst'";
        }else{
            $clause = $clause."AND institution = '$inst'";
        }
    }
    if($gender != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE gender = '$gender'";
        }else{
            $clause = $clause."AND gender = '$gender'";
        }
    }
    if($qualify != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE qualification = '$qualify'";
        }else{
            $clause = $clause."AND qualification = '$qualify'";
        }
    }
    if($rank != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE rank = '$rank'";
        }else{
            $clause = $clause."AND rank = '$rank'";
        }
    }
    if($cat != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE staff_type = '$cat'";
        }else{
            $clause = $clause."AND staff_type = '$cat'";
        }
    }

    $qry = "SELECT * FROM staff $clause";
    $qryrun = $conn->query($dbcon,$qry);
    $data ="<table class='table table-hover' id='staffsearchtable'>
                                        <thead>
                                        <tr>
                                            <th>Staff ID</th>
                                            <th>Name</th>
                                            <th>Institution</th>
                                            <th>Qualification</th>
                                            <th>Staff Category</th>
                                            <th>Rank</th>
                                            <th>Employment Type</th>
                                            <th>Nationality</th>
                                            <th>Gender</th>
                                        </tr>
                                        </thead>
                                        <tbody>";
    while($row = $conn->fetch($qryrun)){
        $id = $row['id'];
        $data = $data."<tr>
                        <td><a href='dashboard.php?view_staff=".$id."'>".$row['staff_id']."</a></td>
                        <td>".$row['title'].' '.$row['first_name'].' '.$row['surname'].' '.$row['other_names']."</td>
                        <td>".getInstitution($row['institution'])."</td>
                        <td>".$row['qualification']."</td>
                        <td>".getStaffCategory($row['staff_type'])."</td>
                        <td>".getStaffRank($row['rank'])."</td>
                        <td>".$row['employment_type']."</td>
                        <td>".$row['nationality']."</td>
                        <td>".$row['gender']."</td>
                        </tr>";
    }

    if($data == ""){
        print("<tr><td colspan='9'>No Records Found</td></tr></tbody></table>");
    }else{
        print $data."</tbody></table>";
    }

    $conn->close($dbcon);

}

if(isset($_GET['sortDataTableInstitutions'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $cat = $_GET['cat'];

    $clause = "";

    if($cat != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE category_id = '$cat'";
        }else{
            $clause = $clause."AND category_id = '$cat'";
        }
    }

    $qry = "SELECT * FROM institutes $clause";
    $qryrun = $conn->query($dbcon,$qry);
    $data ="<table class='table table-hover' id='institutesearchtable'>
                                        <thead>
                                        <tr>
                                            <th>Institution ID</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Location Address</th>
                                            <th>Region</th>
                                            <th>District</th>
                                            <th>Town</th>
                                            <th>Official E-mail</th>
                                            <th>Official Contact</th>
                                            <th>Name Of Head</th>
                                            <th>Contact Of Head</th>
                                            <th>E-mail Of Head</th>
                                            <th>Name Of Representative</th>
                                            <th>Contact Of Representative</th>
                                            <th>E-mail Of Representative</th>
                                        </tr>
                                        </thead>
                                        <tbody>";
    while($row = $conn->fetch($qryrun)){
        $id = $row['id'];
        $data = $data."<tr>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['institution_code']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['name']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". getCategory($row['category_id'])."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['digital_address']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['region']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['district']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['town']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['contact_email']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['contact_telephone']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['hname']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['hcont']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['hmail']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['fname']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['fcont']."</a></td>
                            <td><a class='clicklink' href='../admin/dashboard.php?view_instituion=". $id."'>". $row['fmail']."</a></td>
                            
                        </tr>";
    }

    if($data == ""){
        print("<tr><td colspan='15'>No Records Found</td></tr></tbody></table>");
    }else{
        print $data."</tbody></table>";
    }

    $conn->close($dbcon);

}

/*if(isset($_GET['sortDataTableApplicants'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $year = $_GET['year'];
    $inst = $_GET['inst'];
    $prog = $_GET['prog'];
    $qualify = $_GET['qualify'];

    $clause = "";
    if($year != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE year = '$year'";
        }else{
            $clause = $clause."AND year = '$year'";
        }
    }
    if($inst != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE institution = '$inst'";
        }else{
            $clause = $clause."AND institution = '$inst'";
        }
    }
    if($prog != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE (programme_applied = '$prog' OR programme_offered = '$prog')";
        }else{
            $clause = $clause."AND (programme_applied = '$prog' OR programme_offered = '$prog')";
        }
    }
    if($qualify != 'All'){
        if($clause == ""){
            $clause = $clause." WHERE status = '$qualify'";
        }else{
            $clause = $clause."AND status = '$qualify'";
        }
    }


    $qry = "SELECT * FROM appadmissions $clause";
    $qryrun = $conn->query($dbcon,$qry);
    $data ="";
    while($row = $conn->fetch($qryrun)){
        $id = $row['id'];
        $data = $data."<tr>
                            <td>".$row['applicant_id']."</td>
                            <td>".$row['first_name']." ".$row['other_names']." ".$row['surname']."</td>
                            <td>".$row['gender']."</td>
                            <td>".$row['birth_date']."</td>
                            <td>".$row['birth_country']."</td>
                            <td>".$row['nationality']."</td>
                            <td>".$row['religion']."</td>
                            <td>".$row['home_town']."</td>
                            <td>".$row['home_region']."</td>
                            <td>".getInstitution($row['institution'])."</td>
                            <td>".$row['year']."</td>
                            <td>".$row['applicant_id_type']."</td>
                            <td>".$row['applicant_national_id']."</td>
                            <td>".$row['high_school']."</td>
                            <td>".$row['high_school_program']."</td>
                            <td>".getProgram($row['programme_applied'])."</td>
                            <td>".$row['programme_type']."</td>
                            <td>".$row['fee_type']."</td>
                            <td>".$row['disability']."</td>
                            <td>".$row['disability_type']."</td>
                            <td>".$row['status']."</td>
                        </tr>";
}

    if($data == ""){
        print("<tr><td colspan='9'>No Records Found</td></tr>");
    }else{
        print $data;
    }

    $conn->close($dbcon);

}*/



if(isset($_GET['getStaffRank'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $id = $_GET['getStaffRank'];
    $response =array();

    //FETCH THE ROLE RECORDS
    $sel = "SELECT rank, status, target, default_type FROM staffranks WHERE id = $id";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) == 0){
        print "Not Found";
    }else{
        $rows = $conn->fetch($selrun);

        $status = $rows['status'];
        $otheroption = "Active";
        $readonly = $rows['default_type'] == "default" ? "readonly" : "";
        $otheroption = $status == "Active" ? "Inactive" : "";

        $data = "
        <form class='stepy-clickable'>
 
            <fieldset title='1'>
                <legend class='text-semibold'>Rank Details</legend>

                <div class='row'>
                    <input type='hidden' id='rankid' value='".$id."' />
                    <div class='col-md-4' align='right'><label>Rank Name:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <input type='text' id='rankedit'".$readonly." value='".$rows['rank']."' class='form-control' placeholder='Rank Name' />
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-4' align='right'><label>% Percentage Target To Staff Pyramid:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <input type='text' id='targetedit' value='".$rows['target']."' class='form-control' />
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

if(isset($_GET['getInstitutionCategory'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $id = $_GET['getInstitutionCategory'];
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

if(isset($_GET['getStaffCategory'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $id = $_GET['getStaffCategory'];
    $response =array();

    //FETCH THE ROLE RECORDS
    $sel = "SELECT * FROM staffcategory WHERE id = $id";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) == 0){
        print "Not Found";
    }else{
        $rows = $conn->fetch($selrun);

        $status = $rows['status'];
        $rank = $rows['ranks'];

        $otheroption = "Active";
        $readonly = $rows['default_type'] == "default" ? "readonly" : "";
        $visibility = $rows['default_type'] == "default" ? "hidden" : "";
        $otheroption = $status == "Active" ? "Inactive" : "";


        $rankDetails = "<select id='ranknameedit'  data-placeholder='Select Rank' multiple='multiple' class='select'><div class='form-group'>";
        $obj = explode(",",$rank);
        for($i=0; $i < count($obj); $i++){
            $rankDetails.="<option value='".$obj[$i]."' selected>".getRank($obj[$i])."</option>";
        }

        $sel = "SELECT rank, id FROM staffranks WHERE id NOT IN (".$rank.") ORDER BY rank ASC";
        $selrun = $conn->query($dbcon,$sel);
        while($row = $conn->fetch($selrun)){
            $rankDetails.="<option value='".$row['id']."'>".$row['rank']."</option>";
        }
        $rankDetails.="</div></select>";
        $data = "
        <form class='stepy-clickable'>
            <fieldset title='1'>
                <legend class='text-semibold'>Staff Category Details</legend>

                <div class='row' align='center'>
                <input type='hidden' id='catid' readonly value='".$id."'/>
                    <div class='col-md-4' align='right'><label>Category Name:</label></div>
                    <div class='col-md-8'>
                        <div class='form-group'>
                            <input ".$readonly." type='text' id='catnameedit' value='".$rows['staff_type']."' class='form-control' />
                        </div>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-4' align='right'><label>Ranks:</label></div>
                    <div class='col-md-8'>
                        ".$rankDetails."
                    </div>
                </div>
                <div class='row $visibility'>
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
                        <button class='btn btn-sm btn-primary' type='button' onclick='updateStaffCategory()'>Update  </button>
                    </div>
                </div>
            </fieldset>
        </form>
        ";
        print $data;
    }
    $conn->close($dbcon);
}

if(isset($_GET['getRankDetails'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $rankid = $_GET['getRankDetails'];
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

if(isset($_GET['getStaffDetails'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $rankid = $_GET['getStaffDetails'];
    $sel = "SELECT title, first_name, surname, other_names, staff_id FROM staff WHERE status='Active' AND institution='$rankid' ORDER BY title, first_name ASC";
    $selrun = $conn->query($dbcon,$sel);
    $msg="";
    if($conn->sqlnum($selrun) == 0){
        $msg = "<option value=''>No Staff</option>";
    }else{
        while($row = $conn->fetch($selrun)){
            $msg=$msg."<option value='".$row['staff_id']."'>".$row['title']." ".$row['first_name']." ".$row['other_names']." ".$row['surname']."</option>";
        }
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
disability_type) VALUES ('$stfid','$acad','$title','$idtype','$idnum','$inst','$fname','$lname','$oname','$dob','$sex','$nat','$edu','$desig','$rank','$stftype','$college'
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

if(isset($_POST['updateStaff'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $stfid=mysqli_real_escape_string($dbcon,$_POST['updateStaff']);
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

        $ins = "UPDATE staff SET year='$acad', title='$title', national_id_type='$idtype', national_id_number='$idnum', institution='$inst',
 first_name='$fname', surname='$lname', other_names='$oname', birth_date='$dob', gender='$sex', nationality='$nat',
  qualification='$edu', designation='$desig', rank='$rank', staff_type='$stftype', college='$college', department='$dept', faculty='$faculty',
   employment_type='$emptype', disability='$disable', disability_type = '$distype' WHERE staff_id = '$stfid'";
        $insrun = $conn->query($dbcon,$ins);
        if($insrun){
            $response['errorCode'] = "0";
            $response['errorMsg'] = "Staff Details Updated Successfully";
        }else{
            $response['errorCode'] = "1";
            $response['errorMsg'] = "Staff Details Could Not Be Updated. Please Try Again";
        }


    print json_encode($response);
}

if(isset($_POST['addNewStudent'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $stdid=mysqli_real_escape_string($dbcon,$_POST['addNewStudent']);
    $fname=mysqli_real_escape_string($dbcon,$_POST['fname']);
    $lname=mysqli_real_escape_string($dbcon,$_POST['lname']);
    $oname=mysqli_real_escape_string($dbcon,$_POST['oname']);
    $dob=mysqli_real_escape_string($dbcon,$_POST['dob']);
    $sex=mysqli_real_escape_string($dbcon,$_POST['sex']);
    $idtype=mysqli_real_escape_string($dbcon,$_POST['idtype']);
    $idnum=mysqli_real_escape_string($dbcon,$_POST['idnum']);
    $country=mysqli_real_escape_string($dbcon,$_POST['country']);
    $birth=mysqli_real_escape_string($dbcon,$_POST['birth']);
    $disable=mysqli_real_escape_string($dbcon,$_POST['disable']);
    $distype=mysqli_real_escape_string($dbcon,$_POST['distype']);
    $inst=mysqli_real_escape_string($dbcon,$_POST['inst']);
    $religion=mysqli_real_escape_string($dbcon,$_POST['religion']);
    $town=mysqli_real_escape_string($dbcon,$_POST['town']);
    $region=mysqli_real_escape_string($dbcon,$_POST['region']);
    $shs=mysqli_real_escape_string($dbcon,$_POST['shs']);
    $shsprog=mysqli_real_escape_string($dbcon,$_POST['shsprog']);
    $prog=mysqli_real_escape_string($dbcon,$_POST['prog']);
    $progoffered=mysqli_real_escape_string($dbcon,$_POST['progoffered']);
    $status=mysqli_real_escape_string($dbcon,$_POST['status']);
    $feepaying=mysqli_real_escape_string($dbcon,$_POST['feepaying']);
    $year=mysqli_real_escape_string($dbcon,$_POST['year']);
    $progtype=mysqli_real_escape_string($dbcon,$_POST['progtype']);
    $level=mysqli_real_escape_string($dbcon,$_POST['level']);
    $apptype=mysqli_real_escape_string($dbcon,$_POST['apptype']);

    //CHECK IF STUDENT ID EXISTS
    $chk = "SELECT first_name FROM appadmissions WHERE applicant_id = '$stdid'";
    $chkrun = $conn->query($dbcon,$chk);
    if($conn->sqlnum($chkrun) == 0){

        //INSERT BASIC RECORDS AND APPLICATION RECORDS OF THE STUDENT
        $ins="";
        if($status == "Qualified" || $status == "Offered"){
            $ins = "INSERT INTO appadmissions(institution, year, applicant_id, applicant_id_type,applicant_national_id, first_name, surname,
         other_names, gender, birth_date, birth_country, nationality, religion, home_town, home_region, high_school,
          high_school_program, disability, disability_type,programme_applied,fee_type,programme_type,programme_offered, status,admission_level,application_type) 
          VALUES ('$inst','$year','$stdid','$idtype','$idnum','$fname','$lname','$oname','$sex','$dob','$birth','$country','$religion','$town',
          '$region','$shs','$shsprog','$disable','$distype','$prog','$feepaying','$progtype','$progoffered','$status','$level','$apptype')";
        }elseif($status == "Enrolled"){
            $ins = "INSERT INTO enrollments(institution, year, applicant_id, applicant_id_type,applicant_national_id, first_name, surname,
         other_names, gender, birth_date, birth_country, nationality, religion, home_town, home_region, high_school,
          high_school_program, disability, disability_type,fee_type,programme_type,programme_offered, status,admission_level,application_type) 
          VALUES ('$inst','$year','$stdid','$idtype','$idnum','$fname','$lname','$oname','$sex','$dob','$birth','$country','$religion','$town',
          '$region','$shs','$shsprog','$disable','$distype','$feepaying','$progtype','$progoffered','Active','$level','$apptype')";
        }else{
            $ins = "INSERT INTO graduates(institution, year, applicant_id, applicant_id_type,applicant_national_id, first_name, surname,
         other_names, gender, birth_date, birth_country, nationality, religion, home_town, home_region, high_school,
          high_school_program, disability, disability_type,programme_applied,fee_type,programme_type,programme_offered, status,admission_level,application_type) 
          VALUES ('$inst','$year','$stdid','$idtype','$idnum','$fname','$lname','$oname','$sex','$dob','$birth','$country','$religion','$town',
          '$region','$shs','$shsprog','$disable','$distype','$prog','$feepaying','$progtype','$progoffered','Active','$level','$apptype')";
        }
        $insrun = $conn->query($dbcon,$ins);

        if($insrun){
            $response['errorCode'] = "0";
            $response['errorMsg'] = "Application Completed Successfully";
        }else{
            $response['errorCode'] = "1";
            $response['errorMsg'] = "Applicant Details Could Not Be Saved Successfully";
        }



    }else{
        $upd="UPDATE appadmissions SET status='$status' WHERE applicant_id='$stdid'";
        $conn->query($dbcon,$upd);
        $response['errorCode'] = "0";
        $response['errorMsg'] = "Applicant With Apllicant ID, $stdid, updated.";
    }


    print json_encode($response);
}

if(isset($_POST['addNewStudentRec'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $stdid=mysqli_real_escape_string($dbcon,$_POST['addNewStudentRec']);
    $fname=mysqli_real_escape_string($dbcon,$_POST['fname']);
    $lname=mysqli_real_escape_string($dbcon,$_POST['lname']);
    $oname=mysqli_real_escape_string($dbcon,$_POST['oname']);
    $dob=mysqli_real_escape_string($dbcon,$_POST['dob']);
    $sex=mysqli_real_escape_string($dbcon,$_POST['sex']);
    $idtype=mysqli_real_escape_string($dbcon,$_POST['idtype']);
    $idnum=mysqli_real_escape_string($dbcon,$_POST['idnum']);
    $country=mysqli_real_escape_string($dbcon,$_POST['country']);
    $birth=mysqli_real_escape_string($dbcon,$_POST['birth']);
    $disable=mysqli_real_escape_string($dbcon,$_POST['disable']);
    $distype=mysqli_real_escape_string($dbcon,$_POST['distype']);
    $inst=mysqli_real_escape_string($dbcon,$_POST['inst']);
    $religion=mysqli_real_escape_string($dbcon,$_POST['religion']);
    $town=mysqli_real_escape_string($dbcon,$_POST['town']);
    $region=mysqli_real_escape_string($dbcon,$_POST['region']);
    $shs=mysqli_real_escape_string($dbcon,$_POST['shs']);
    $shsprog=mysqli_real_escape_string($dbcon,$_POST['shsprog']);
    $progoffered=mysqli_real_escape_string($dbcon,$_POST['progoffered']);
    $feepaying=mysqli_real_escape_string($dbcon,$_POST['feepaying']);
    $year=mysqli_real_escape_string($dbcon,$_POST['year']);
    $progtype=mysqli_real_escape_string($dbcon,$_POST['progtype']);
    $level=mysqli_real_escape_string($dbcon,$_POST['level']);
    $apptype=mysqli_real_escape_string($dbcon,$_POST['apptype']);

    //CHECK IF STUDENT ID EXISTS
    $chk = "SELECT first_name FROM enrollments WHERE applicant_id = '$stdid'";
    $chkrun = $conn->query($dbcon,$chk);
    if($conn->sqlnum($chkrun) == 0){
        //INSERT BASIC RECORDS AND APPLICATION RECORDS OF THE STUDENT
         $ins = "INSERT INTO enrollments(institution, year, applicant_id, applicant_id_type,applicant_national_id, first_name, surname,
         other_names, gender, birth_date, birth_country, nationality, religion, home_town, home_region, high_school,
          high_school_program, disability, disability_type,fee_type,programme_type,programme_offered, status,admission_level,application_type) 
          VALUES ('$inst','$year','$stdid','$idtype','$idnum','$fname','$lname','$oname','$sex','$dob','$birth','$country','$religion','$town',
          '$region','$shs','$shsprog','$disable','$distype','$feepaying','$progtype','$progoffered','Active','$level','$apptype')";

        $insrun = $conn->query($dbcon,$ins);

        if($insrun){
            $response['errorCode'] = "0";
            $response['errorMsg'] = "Student Daetails Added Successfully";
        }else{
            $response['errorCode'] = "1";
            $response['errorMsg'] = "Student Details Could Not Be Saved Successfully";
        }



    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Student Records Already Exists With The Student ID $stdid";
    }


    print json_encode($response);
}

if(isset($_POST['updateNewStudentRec'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $stdid=mysqli_real_escape_string($dbcon,$_POST['updateNewStudentRec']);
    $fname=mysqli_real_escape_string($dbcon,$_POST['fname']);
    $lname=mysqli_real_escape_string($dbcon,$_POST['lname']);
    $oname=mysqli_real_escape_string($dbcon,$_POST['oname']);
    $dob=mysqli_real_escape_string($dbcon,$_POST['dob']);
    $sex=mysqli_real_escape_string($dbcon,$_POST['sex']);
    $idtype=mysqli_real_escape_string($dbcon,$_POST['idtype']);
    $idnum=mysqli_real_escape_string($dbcon,$_POST['idnum']);
    $country=mysqli_real_escape_string($dbcon,$_POST['country']);
    $birth=mysqli_real_escape_string($dbcon,$_POST['birth']);
    $disable=mysqli_real_escape_string($dbcon,$_POST['disable']);
    $distype=mysqli_real_escape_string($dbcon,$_POST['distype']);
    $inst=mysqli_real_escape_string($dbcon,$_POST['inst']);
    $religion=mysqli_real_escape_string($dbcon,$_POST['religion']);
    $town=mysqli_real_escape_string($dbcon,$_POST['town']);
    $region=mysqli_real_escape_string($dbcon,$_POST['region']);
    $shs=mysqli_real_escape_string($dbcon,$_POST['shs']);
    $shsprog=mysqli_real_escape_string($dbcon,$_POST['shsprog']);
    $progoffered=mysqli_real_escape_string($dbcon,$_POST['progoffered']);
    $feepaying=mysqli_real_escape_string($dbcon,$_POST['feepaying']);
    $year=mysqli_real_escape_string($dbcon,$_POST['year']);
    $progtype=mysqli_real_escape_string($dbcon,$_POST['progtype']);
    $level=mysqli_real_escape_string($dbcon,$_POST['level']);
    $apptype=mysqli_real_escape_string($dbcon,$_POST['apptype']);

    //INSERT BASIC RECORDS AND APPLICATION RECORDS OF THE STUDENT
     $ins = "UPDATE enrollments SET institution='$inst', year='$year', applicant_id_type='$idtype',applicant_national_id='$idnum', first_name='$fname', surname='$lname',
     other_names='$oname', gender='$sex', birth_date='$dob', birth_country='$birth', nationality='$country', religion='$religion', home_town='$town', home_region='$region', high_school='$shs',
      high_school_program='$shsprog', disability='$disable', disability_type='$distype',fee_type='$feepaying',programme_type='$progtype',programme_offered='$progoffered',admission_level='$level',application_type='$apptype' WHERE applicant_id ='$stdid'";

    if($conn->query($dbcon,$ins)){
        $response['errorCode'] = "0";
        $response['errorMsg'] = "Student Details Updated.";
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Student Detail Updates Failed.";
    }

    print json_encode($response);
}

if(isset($_POST['updateNewApplicantRec'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $stdid=mysqli_real_escape_string($dbcon,$_POST['updateNewApplicantRec']);
    $fname=mysqli_real_escape_string($dbcon,$_POST['fname']);
    $lname=mysqli_real_escape_string($dbcon,$_POST['lname']);
    $oname=mysqli_real_escape_string($dbcon,$_POST['oname']);
    $dob=mysqli_real_escape_string($dbcon,$_POST['dob']);
    $sex=mysqli_real_escape_string($dbcon,$_POST['sex']);
    $idtype=mysqli_real_escape_string($dbcon,$_POST['idtype']);
    $idnum=mysqli_real_escape_string($dbcon,$_POST['idnum']);
    $country=mysqli_real_escape_string($dbcon,$_POST['country']);
    $birth=mysqli_real_escape_string($dbcon,$_POST['birth']);
    $disable=mysqli_real_escape_string($dbcon,$_POST['disable']);
    $distype=mysqli_real_escape_string($dbcon,$_POST['distype']);
    $inst=mysqli_real_escape_string($dbcon,$_POST['inst']);
    $religion=mysqli_real_escape_string($dbcon,$_POST['religion']);
    $town=mysqli_real_escape_string($dbcon,$_POST['town']);
    $region=mysqli_real_escape_string($dbcon,$_POST['region']);
    $shs=mysqli_real_escape_string($dbcon,$_POST['shs']);
    $shsprog=mysqli_real_escape_string($dbcon,$_POST['shsprog']);
    $progoffered=mysqli_real_escape_string($dbcon,$_POST['progoffered']);
    $prog=mysqli_real_escape_string($dbcon,$_POST['prog']);
    $feepaying=mysqli_real_escape_string($dbcon,$_POST['feepaying']);
    $year=mysqli_real_escape_string($dbcon,$_POST['year']);
    $progtype=mysqli_real_escape_string($dbcon,$_POST['progtype']);
    $level=mysqli_real_escape_string($dbcon,$_POST['level']);
    $apptype=mysqli_real_escape_string($dbcon,$_POST['apptype']);

    //INSERT BASIC RECORDS AND APPLICATION RECORDS OF THE STUDENT
     $ins = "UPDATE appadmissions SET programme_applied = '$prog', institution='$inst', year='$year', applicant_id_type='$idtype',applicant_national_id='$idnum', first_name='$fname', surname='$lname',
     other_names='$oname', gender='$sex', birth_date='$dob', birth_country='$birth', nationality='$country', religion='$religion', home_town='$town', home_region='$region', high_school='$shs',
      high_school_program='$shsprog', disability='$disable', disability_type='$distype',fee_type='$feepaying',programme_type='$progtype',programme_offered='$progoffered',admission_level='$level',application_type='$apptype' WHERE applicant_id ='$stdid'";

    if($conn->query($dbcon,$ins)){
        $response['errorCode'] = "0";
        $response['errorMsg'] = "Applicant Details Updated.";
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Applicant Detail Updates Failed.";
    }

    print json_encode($response);
}



if(isset($_POST['admitApplicant'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $applicants = $_POST['admitApplicant'];
    $statCode = $_POST['id'];
    $status = "";
    if(($statCode +1) == 1){
        $status = "Qualified";
    }elseif(($statCode +1) == 2){
        $status = "Offered";
    }elseif(($statCode +1) == 3){
        $status = "Enrolled";
    }else{
        $status = "Graduated";
    }

    $obj = explode(",",$applicants);
        for($i=0;$i < COUNT($obj);$i++){
            $appId = $obj[$i];

            if($status == "Qualified" || $status =="Offered"){
                $upd = "UPDATE appadmissions SET status = '$status' WHERE applicant_id='$appId'";
                $conn->query($dbcon,$upd);
            }
            elseif($status == "Enrolled" || $status == "Graduated"){
                $mov="";
                if($status == "Enrolled"){
                    //MOVE RECORDS FROM APPADMISSIONS TO ENROLLMENTS
                    $mov = "INSERT INTO enrollments(institution, year, applicant_id, applicant_id_type,applicant_national_id, first_name, surname,
                     other_names, gender, birth_date, birth_country, nationality, religion, home_town, home_region, high_school,
                      high_school_program, disability, disability_type,fee_type,programme_type,programme_offered, status,admission_level,application_type) 
                      SELECT institution, year, applicant_id, applicant_id_type,applicant_national_id, first_name, surname,
                     other_names, gender, birth_date, birth_country, nationality, religion, home_town, home_region, high_school,
                      high_school_program, disability, disability_type,fee_type,programme_type,programme_offered, status,admission_level,application_type FROM appadmissions WHERE applicant_id = '$appId'";
                    }
                    else{
                    $mov = "INSERT INTO graduates(institution, year, applicant_id, applicant_id_type,applicant_national_id, first_name, surname,
                     other_names, gender, birth_date, birth_country, nationality, religion, home_town, home_region, high_school,
                      high_school_program, disability, disability_type,fee_type,programme_type,programme_offered, status,admission_level,application_type) 
                      SELECT institution, year, applicant_id, applicant_id_type,applicant_national_id, first_name, surname,
                     other_names, gender, birth_date, birth_country, nationality, religion, home_town, home_region, high_school,
                      high_school_program, disability, disability_type,fee_type,programme_type,programme_offered, status,admission_level,application_type FROM appadmissions WHERE applicant_id = '$appId'";
                }
                $conn->query($dbcon,$mov);
                //DELETE THE RECORDS FROM THE APPADMISSIONS TABLE
                $del ="DELETE FROM appadmissions WHERE applicant_id = '$appId'";
                $conn->query($dbcon,$del);
            }
        }

    $response['errorCode'] = "0";
    $response['errorMsg'] = "Applicant(s) Have Been ".$status." Successfully";
    print json_encode($response);

    $conn->close($dbcon);
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


if(isset($_POST['sendNewEmail'])){
    $response = sendEmail('felsina89@gmail.com',"Your account password has been reset. ",'no-reply@gtec.edu.gh','SMTP test');
    print $response;
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
    $accredit=mysqli_real_escape_string($dbcon,$_POST['accredit']);
    $expire=mysqli_real_escape_string($dbcon,$_POST['expire']);
    $fname=mysqli_real_escape_string($dbcon,$_POST['fname']);
    $fcont=mysqli_real_escape_string($dbcon,$_POST['fcont']);
    $fmail=mysqli_real_escape_string($dbcon,$_POST['fmail']);
    $hname=mysqli_real_escape_string($dbcon,$_POST['hname']);
    $hcont=mysqli_real_escape_string($dbcon,$_POST['hcont']);
    $hmail=mysqli_real_escape_string($dbcon,$_POST['hmail']);
    $certid=mysqli_real_escape_string($dbcon,$_POST['certid']);

    //GET THE ISCED OF THE PROGRAM
    $obj = explode("*",$title);
    $isced = $obj[1];
    $prog = $obj[0];

    //CHECK IF ACCREDITATION EXISTS FOR THE PROGRAM
    $chk = "SELECT institution FROM acc_programmes WHERE certid = '$certid' OR (institution = '$inst' AND programme = '$prog' AND isced ='$isced')";
    $chkrun = $conn->query($dbcon,$chk);
    if($conn->sqlnum($chkrun) == 0){
        $ins = "INSERT INTO acc_programmes (certid,institution, accreditation_year, faculty_school, department, college, programme, isced, accredited_date, expiration_date,fname,fcont,fmail,hname,hcont,hmail)
 VALUES ('$certid','$inst','$year','$faculty','$dept','$college','$prog','$isced','$accredit','$expire','$fname','$fcont','$fmail','$hname','$hcont','$hmail')";
        $insrun = $conn->query($dbcon,$ins);
        if($insrun){
            $response['errorCode'] = "0";
            $response['errorMsg'] = "Programme Accreditation Completed Successfully";
        }else{
            $response['errorCode'] = "1";
            $response['errorMsg'] = "Programme Accreditation Could Not Be Completed. Please Try Again";
        }
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Programme Accreditation With Certificate ID, $certid Already Exists";
    }




    print json_encode($response);
}

if(isset($_POST['addPropProgram'])){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    $inst=mysqli_real_escape_string($dbcon,$_POST['inst']);
    $year=mysqli_real_escape_string($dbcon,$_POST['year']);
    $college=mysqli_real_escape_string($dbcon,$_POST['college']);
    $faculty=mysqli_real_escape_string($dbcon,$_POST['faculty']);
    $isced=mysqli_real_escape_string($dbcon,$_POST['isced']);
    $dept=mysqli_real_escape_string($dbcon,$_POST['dept']);
    $title=mysqli_real_escape_string($dbcon,$_POST['title']);
    $fname=mysqli_real_escape_string($dbcon,$_POST['fname']);
    $fcont=mysqli_real_escape_string($dbcon,$_POST['fcont']);
    $fmail=mysqli_real_escape_string($dbcon,$_POST['fmail']);
    $hname=mysqli_real_escape_string($dbcon,$_POST['hname']);
    $hcont=mysqli_real_escape_string($dbcon,$_POST['hcont']);
    $hmail=mysqli_real_escape_string($dbcon,$_POST['hmail']);

    $ins = "INSERT INTO acc_programmes_proposed (institution, accreditation_year, faculty_school, department, college, programme,isced, fname,fcont,fmail,hname,hcont,hmail)
 VALUES ('$inst','$year','$faculty','$dept','$college','$title','$isced','$fname','$fcont','$fmail','$hname','$hcont','$hmail')";
    $insrun = $conn->query($dbcon,$ins);
    if($insrun){
        $response['errorCode'] = "0";
        $response['errorMsg'] = "Proposing of $title for accreditation Completed Successfully";
    }else{
        $response['errorCode'] = "1";
        $response['errorMsg'] = "Proposing of $title for accreditation Could Not Be Completed. Please Try Again";
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