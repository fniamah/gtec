<?php
session_start();
include("env.php");

class Db_connect{
    private $lhost= DB_HOST;
    private $user= DB_USER;
    private $pword= DB_PASSWORD;
    private $db= DB_NAME;

    public function conn(){
        try{
            $conn=mysqli_connect($this->lhost,$this->user,$this->pword,$this->db);
            if(!$conn){
                throw new Exception("Database Connection Error");
            }
            else{
                return $conn;
            }
        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }
    }

    //QUERY STRING
    public function query($con,$queryString){
        try{
            if(!empty($queryString)){
                return mysqli_query($con,$queryString);
            }
            else{
                throw new Exception("You Are Submitting An Empty Query");
            }

        }
        catch(Exception $ex){
            echo $ex->getMessage();
        }

    }
    //FETCHING FROM DATABASE
    public function fetch($mysqli_num_rowsqry){
        return mysqli_fetch_assoc($mysqli_num_rowsqry);
    }
    //SQL NUM
    public function sqlnum($num){
        return mysqli_num_rows($num);
    }

    public function close($con){
        mysqli_close($con);
    }
}

if (isset($_POST['uname'])) {
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $uname =$_POST['uname'];
    $sel = "SELECT u.first_name, u.last_name, u.photo, u.phone, u.email, u.institution, u.account_type, u.roleid, p.pages, r.permissions FROM users u INNER JOIN userspages p ON u.email = p.userid LEFT JOIN roles r ON u.roleid = r.id WHERE u.email = '$uname'";
    $selrun = $conn->query($dbcon,$sel);
    $seldata = $conn->fetch($selrun);

    $_SESSION['uname'] = $uname;
    $_SESSION['fname'] = $seldata['first_name'];
    $_SESSION['lname'] = $seldata['last_name'];
    $_SESSION['photo'] = $seldata['photo'];
    $_SESSION['contact'] = $seldata['phone'];
    $_SESSION['email'] = $seldata['email'];
    $_SESSION['institution'] = $seldata['institution'];
    $_SESSION['actype'] = $seldata['account_type'];
    $_SESSION['roleid'] = $seldata['roleid'];
    $_SESSION['access'] = $seldata['pages'];
    $_SESSION['permission'] = $seldata['permissions'];

    $msg = "Logged in";
    $log = date("Y-m-d H:i:s")." Username:".$uname." Message:".$msg.PHP_EOL;
    logrequest($log,"System Logs");

    header("location: dashboard.php");
    $conn->close($dbcon);
    exit(0);
}

//FUNCTIONS
function getRole($id){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $response="N/A";
    $sel="SELECT role FROM roles WHERE id = $id";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) != 0){
        $data = $conn->fetch($selrun);
        $response = $data['role'];
    }
    return $response;
}

function getRank($id){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $response="N/A";
    $sel="SELECT drank FROM staffranks WHERE id = $id";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) != 0){
        $data = $conn->fetch($selrun);
        $response = $data['drank'];
    }
    return $response;
}

function getInstitution($id){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $response="N/A";
    $sel="SELECT name FROM institutes WHERE institution_code = '$id'";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) != 0){
        $data = $conn->fetch($selrun);
        $response = $data['name'];
    }
    return $response;
}

function getIsced($id){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $response="N/A";
    $sel="SELECT name FROM isceds WHERE code = '$id'";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) != 0){
        $data = $conn->fetch($selrun);
        $response = $data['name'];
    }
    return $response;
}

function getCollege($id){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $response="N/A";
    $sel="SELECT name FROM institute_colleges WHERE id = $id";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) != 0){
        $data = $conn->fetch($selrun);
        $response = $data['name'];
    }
    return $response;
}


function getFaculty($id){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $response="N/A";
    if(!empty($id)){
        $sel="SELECT name FROM institute_faculties WHERE id = $id";
        $selrun = $conn->query($dbcon,$sel);
        if($conn->sqlnum($selrun) != 0){
            $data = $conn->fetch($selrun);
            $response = $data['name'];
        }
    }

    return $response;
}

function getDepartment($id){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $response="N/A";
    $sel="SELECT name FROM institute_departments WHERE id = $id";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) != 0){
        $data = $conn->fetch($selrun);
        $response = $data['name'];
    }
    return $response;
}

function getCategory($id){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $response="N/A";
    $sel="SELECT name FROM institute_categories WHERE id = $id";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) != 0){
        $data = $conn->fetch($selrun);
        $response = $data['name'];
    }
    return $response;
}

function getStaffCategory($id){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $response="N/A";
    $sel="SELECT staff_type FROM staffcategory WHERE id = $id";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) != 0){
        $data = $conn->fetch($selrun);
        $response = $data['staff_type'];
    }
    return $response;
}

function getStaffRank($id){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $response="N/A";
    $sel="SELECT drank FROM staffranks WHERE id = $id";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) != 0){
        $data = $conn->fetch($selrun);
        $response = $data['drank'];
    }
    return $response;
}

function getProgram($id){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $response="N/A";
    $sel="SELECT programme FROM programmes WHERE prog_code = '$id'";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) != 0){
        $data = $conn->fetch($selrun);
        $response = $data['programme'];
    }
    return $response;
}

function getActualTargetPyramid($id){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    //GET THE TOTAL ONUMBER OF STAFF OF THE STAFF TYPE
    $getStfType="SELECT COUNT(staff_id) AS total FROM staff WHERE drank = '$id'";
    $getStfTypeRun = $conn->query($dbcon,$getStfType);
    $getStfTypeData = $conn->fetch($getStfTypeRun);
    $singleCount = $getStfTypeData['total'];

    $getStfTypeTgt="SELECT COUNT(staff_id) AS total FROM staff WHERE drank IN('1','2','3','4')";
    $getStfTypeRunTgt = $conn->query($dbcon,$getStfTypeTgt);
    $getStfTypeDataTgt = $conn->fetch($getStfTypeRunTgt);
    $allCount = $getStfTypeDataTgt['total'];

    $actualTarget = 100*($singleCount / $allCount);
    return $actualTarget;

    $conn->close($dbcon);
}

function getFemaleStaffEnrollments($year){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    //GET THE TOTAL ONUMBER OF FEMALE TEACHING STAFF
    $getStfType="SELECT COUNT(staff_id) AS total FROM staff WHERE year = '$year' AND gender = 'Female' AND drank IN('1','2','3','4')";
    $getStfTypeRun = $conn->query($dbcon,$getStfType);
    $getStfTypeData = $conn->fetch($getStfTypeRun);
    $singleCount = $getStfTypeData['total'];

    $getStfTypeTgt="SELECT COUNT(staff_id) AS total FROM staff WHERE year = '$year' AND drank IN('1','2','3','4')";
    $getStfTypeRunTgt = $conn->query($dbcon,$getStfTypeTgt);
    $getStfTypeDataTgt = $conn->fetch($getStfTypeRunTgt);
    $allCount = $getStfTypeDataTgt['total'];

    $actualTarget = $allCount == 0 ? 0 : number_format(100*($singleCount / $allCount),2);
    return $actualTarget;

    $conn->close($dbcon);
}

function getPercentageDistribution($year,$isced,$type="enrollments"){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    //GET THE TOTAL ONUMBER OF FEMALE TEACHING STAFF
    $getStfType="SELECT COUNT(e.applicant_id) AS total FROM $type e INNER JOIN programmes p ON e.programme_offered = p.prog_code WHERE p.prog_isced = '$isced' AND e.year = '$year'";
    $getStfTypeRun = $conn->query($dbcon,$getStfType);
    $getStfTypeData = $conn->fetch($getStfTypeRun);
    $singleCount = $getStfTypeData['total'];

    $getStfTypeTgt="SELECT COUNT(applicant_id) AS total FROM $type WHERE year = '$year'";
    $getStfTypeRunTgt = $conn->query($dbcon,$getStfTypeTgt);
    $getStfTypeDataTgt = $conn->fetch($getStfTypeRunTgt);
    $allCount = $getStfTypeDataTgt['total'];

    $actualTarget = $allCount == 0 ? 0 : number_format(100*($singleCount / $allCount),2);
    return $actualTarget;

    $conn->close($dbcon);
}

function getPercentageEnrollments($inst){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    //GET THE TOTAL ONUMBER OF FEMALE TEACHING STAFF
    $getStfType="SELECT COUNT(e.first_name) AS total FROM enrollments e INNER JOIN institutes i ON e.institution = i.institution_code INNER JOIN institute_categories c ON c.id = i.category_id WHERE i.category_id = '$inst' AND e.status = 'Active'";
    $getStfTypeRun = $conn->query($dbcon,$getStfType);
    $getStfTypeData = $conn->fetch($getStfTypeRun);
    $singleCount = $getStfTypeData['total'];

    $getStfTypeTgt="SELECT COUNT(first_name) AS total FROM enrollments WHERE status = 'Active'";
    $getStfTypeRunTgt = $conn->query($dbcon,$getStfTypeTgt);
    $getStfTypeDataTgt = $conn->fetch($getStfTypeRunTgt);
    $allCount = $getStfTypeDataTgt['total'];

    $actualTarget = $allCount == 0 ? 0 : number_format(100*($singleCount / $allCount),2);
    return $actualTarget;

    $conn->close($dbcon);
}

function getPercentageStaffInPrivate($inst){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    //GET THE TOTAL ONUMBER OF FEMALE TEACHING STAFF
    $getStfType="SELECT COUNT(e.first_name) AS total FROM staff e INNER JOIN institutes i ON e.institution = i.institution_code INNER JOIN institute_categories c ON c.id = i.category_id WHERE i.category_id = '$inst' AND e.status = 'Active'";
    $getStfTypeRun = $conn->query($dbcon,$getStfType);
    $getStfTypeData = $conn->fetch($getStfTypeRun);
    $singleCount = $getStfTypeData['total'];

    $getStfTypeTgt="SELECT COUNT(first_name) AS total FROM staff WHERE status = 'Active'";
    $getStfTypeRunTgt = $conn->query($dbcon,$getStfTypeTgt);
    $getStfTypeDataTgt = $conn->fetch($getStfTypeRunTgt);
    $allCount = $getStfTypeDataTgt['total'];

    $actualTarget = $allCount == 0 ? 0 : number_format(100*($singleCount / $allCount),2);
    return $actualTarget;

    $conn->close($dbcon);
}

function getGPIDetails($year){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $selMale = "SELECT COUNT(applicant_id) AS TotalCount FROM enrollments WHERE status = 'Active' AND year = '$year' AND gender='Male'";
    $selrunMale = $conn->query($dbcon,$selMale);
    $seldataMale = $conn->fetch($selrunMale);
    $male = $seldataMale['TotalCount'];

    $selFemale = "SELECT COUNT(applicant_id) AS TotalCount FROM enrollments WHERE status = 'Active' AND year = '$year' AND gender='Female'";
    $selrunFemale = $conn->query($dbcon,$selFemale);
    $seldataFemale = $conn->fetch($selrunFemale);
    $female = $seldataFemale['TotalCount'];

    $gpi = 0;
    if($male != 0){
        $gpi = $female / $male;
    }
    $resp['male'] = $male;
    $resp['female'] = $female;
    $resp['gpi'] = number_format($gpi,2);

    return json_encode($resp);
    $conn->close($dbcon);
}

function getPartToFullTimeStaff($year){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $selPart = "SELECT COUNT(staff_id) AS TotalCount FROM staff WHERE employment_type = 'Part-Time' AND status = 'Active' AND year = '$year'";
    $selPartRun = $conn->query($dbcon,$selPart);
    $selPartData = $conn->fetch($selPartRun);
    $parttime = $selPartData['TotalCount'];

    $selFull = "SELECT COUNT(staff_id) AS TotalCount FROM staff WHERE employment_type = 'Full-Time' AND status = 'Active' AND year = '$year'";
    $selFullRun = $conn->query($dbcon,$selFull);
    $selFullData = $conn->fetch($selFullRun);
    $fulltime = $selFullData['TotalCount'];

    $CalculateTotal = ceil(($parttime/3)+$fulltime);

    $resp['parttime'] = $parttime;
    $resp['fulltime'] = $fulltime;
    $resp['epfs'] = $CalculateTotal;

    return json_encode($resp);
    $conn->close($dbcon);
}

function getSTR1Details($year){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $selPart = "SELECT COUNT(applicant_id) AS TotalCount FROM enrollments WHERE status = 'Active' AND year = '$year'";
    $selPartRun = $conn->query($dbcon,$selPart);
    $selPartData = $conn->fetch($selPartRun);
    $students = $selPartData['TotalCount'];

    $selFull = "SELECT COUNT(staff_id) AS TotalCount FROM staff WHERE status = 'Active' AND year = '$year'";
    $selFullRun = $conn->query($dbcon,$selFull);
    $selFullData = $conn->fetch($selFullRun);
    $staff = $selFullData['TotalCount'];

    $CalculateRatio = 0;
    if($staff != 0){
        $CalculateRatio = $students / $staff;
    }

    $resp['students'] = $students;
    $resp['staff'] = $staff;
    $resp['str1'] = $CalculateRatio;

    return json_encode($resp);
    $conn->close($dbcon);
}

function getEnrollmentQuota($year){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $selPart = "SELECT COUNT(applicant_id) AS TotalCount FROM enrollments WHERE status = 'Active' AND year = '$year' AND application_type='postgraduate'";
    $selPartRun = $conn->query($dbcon,$selPart);
    $selPartData = $conn->fetch($selPartRun);
    $postgraduate = $selPartData['TotalCount'];

    $selPart = "SELECT COUNT(applicant_id) AS TotalCount FROM enrollments WHERE status = 'Active' AND year = '$year' AND nationality !='Ghanaian'";
    $selPartRun = $conn->query($dbcon,$selPart);
    $selPartData = $conn->fetch($selPartRun);
    $international = $selPartData['TotalCount'];

    $selPart = "SELECT COUNT(applicant_id) AS TotalCount FROM enrollments WHERE status = 'Active' AND year = '$year' AND fee_type='Full-Fee Paying'";
    $selPartRun = $conn->query($dbcon,$selPart);
    $selPartData = $conn->fetch($selPartRun);
    $feepaying = $selPartData['TotalCount'];

    $selPart = "SELECT COUNT(applicant_id) AS TotalCount FROM enrollments WHERE status = 'Active' AND year = '$year'";
    $selPartRun = $conn->query($dbcon,$selPart);
    $selPartData = $conn->fetch($selPartRun);
    $totalstudents = $selPartData['TotalCount'];


    $resp['postgraduates'] = $totalstudents != 0 ? number_format(($postgraduate / $totalstudents)*100,2) : 0;
    $resp['international'] = $totalstudents != 0 ? number_format(($international / $totalstudents)*100,2) : 0;
    $resp['feepaying'] = $totalstudents != 0 ? number_format(($feepaying / $totalstudents)*100,2) : 0;

    return json_encode($resp);
    $conn->close($dbcon);
}

function getEnrollmentByIsced($iscedCode){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $selPart = "SELECT COUNT(e.applicant_id) AS TotalCount FROM enrollments e INNER JOIN programmes p ON e.programme_offered = p.prog_code WHERE p.prog_isced = '$iscedCode' AND e.status = 'Active'";
    $selPartRun = $conn->query($dbcon,$selPart);
    $selPartData = $conn->fetch($selPartRun);
    $iscedEnrollments = $selPartData['TotalCount'];

    $selPart2 = "SELECT COUNT(applicant_id) AS TotalCount FROM enrollments WHERE status = 'Active'";
    $selPartRun2 = $conn->query($dbcon,$selPart2);
    $selPartData2 = $conn->fetch($selPartRun2);
    $totalstudents = $selPartData2['TotalCount'];


   return $iscedEnrollments;

    $conn->close($dbcon);
}

function getSTR2Details($code,$target){
    $conn=new Db_connect;
    $dbcon=$conn->conn();

    //TOTAL STUDENTS IN THE FIELD OF SUBJECT
    $selPart = "SELECT COUNT(e.applicant_id) AS TotalCount FROM enrollments e INNER JOIN programmes p ON e.programme_offered = p.prog_code WHERE p.prog_isced = '$code'";
    $selPartRun = $conn->query($dbcon,$selPart);
    $selPartData = $conn->fetch($selPartRun);
    $students = $selPartData['TotalCount'];

    //TOTAL NUMBER OF STAFF
    $selFull = "SELECT COUNT(s.staff_id) AS TotalCount FROM staff s INNER JOIN staffcategory c ON c.id = s.staff_type WHERE s.status = 'Active' AND s.staff_type = '16'";
    $selFullRun = $conn->query($dbcon,$selFull);
    $selFullData = $conn->fetch($selFullRun);
    $staff = $selFullData['TotalCount'];

    $CalculateRatio = 0;
    if($staff != 0){
        $CalculateRatio = $students / $staff;
    }

    $resp['students'] = $students;
    $resp['staff'] = $staff;
    $resp['actual'] = ceil($CalculateRatio)." : 1";
    $resp['deficit'] = ceil($target - $CalculateRatio)." : 1";

    return json_encode($resp);
    $conn->close($dbcon);
}

function getRequestHeaders() {
    $headers = array();
    foreach($_SERVER as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_') {
            continue;
        }
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }
    return $headers;
}

function logrequest($log,$folder,$index = 0){
    //TODAY'S DATE WILL BE THE NAME OF THE FILE
    $fname="";
    if($index == 0){
        $fname = "../assets/Logs/".$folder."/".date("Ymd").".log";

    }else{
        $fname = "assets/Logs/".$folder."/".date("Ymd").".log";
    }

    if(file_exists($fname)){
        file_put_contents($fname, $log, FILE_APPEND);
    }else{
        touch($fname);
        file_put_contents($fname, $log, FILE_APPEND);
    }
}

function getScienceToHumanitiesRatio($year){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $selHumanities = "SELECT COUNT(e.applicant_id) AS TotalCount FROM enrollments e INNER JOIN programmes p ON p.prog_code = e.programme_offered INNER JOIN isceds i ON p.prog_isced = i.code  WHERE i.classify='Humanities' AND e.status = 'Active' AND e.year = '$year'";
    $selHumanitiesRun = $conn->query($dbcon,$selHumanities);
    $selHumanitiesdata = $conn->fetch($selHumanitiesRun);
    $humanities = $selHumanitiesdata['TotalCount'];

    $selSciences = "SELECT COUNT(e.applicant_id) AS TotalCount FROM enrollments e INNER JOIN programmes p ON p.prog_code = e.programme_offered INNER JOIN isceds i ON p.prog_isced = i.code  WHERE i.classify='Sciences' AND e.status = 'Active' AND e.year = '$year'";
    $selSciencesRun = $conn->query($dbcon,$selSciences);
    $selSciencesdata = $conn->fetch($selSciencesRun);
    $sciences = $selSciencesdata['TotalCount'];

    $str1 = 0;
    if(($humanities + $sciences) != 0){
        $str1 = ceil(100 * ($sciences / ($sciences + $humanities)))." : ".ceil(100 * ($humanities / ($sciences + $humanities)));
    }



    $resp['sciences'] = $sciences;
    $resp['humanities'] = $humanities;
    $resp['str1'] = $str1;

    return json_encode($resp);
    $conn->close($dbcon);
}

function getEnrollmentByYear($year){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $sel="SELECT COUNT(applicant_id) AS totalCount FROM enrollments WHERE year = '$year'";
    $selrun = $conn->query($dbcon,$sel);
    $data = $conn->fetch($selrun);
    $response = $data['totalCount'];
    return $response;
}
function getEnrollmentByYearByGender($year,$gender,$location){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $sel = "";
    if(empty($location)){
        $sel="SELECT COUNT(applicant_id) AS totalCount FROM enrollments WHERE year = '$year' AND gender = '$gender'";
    }else{
        if($_SESSION['actype'] == "GTEC"){
            $sel="SELECT COUNT(applicant_id) AS totalCount FROM enrollments WHERE year = '$year' AND gender = '$gender'";
        }else{
            $sel="SELECT COUNT(applicant_id) AS totalCount FROM enrollments WHERE year = '$year' AND gender = '$gender' AND institution = '".$_SESSION['institution']."'";
        }
    }

    $selrun = $conn->query($dbcon,$sel);
    $data = $conn->fetch($selrun);
    $response = $data['totalCount'];
    return $response;
}

function getTotalEnrollments(){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $sel="SELECT COUNT(applicant_id) AS totalCount FROM enrollments";
    $selrun = $conn->query($dbcon,$sel);
    $data = $conn->fetch($selrun);
    $response = $data['totalCount'];
    return $response;
}

function getEnrollmentsByGenderByInstitution($catid,$gender){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $sel="SELECT COUNT(applicant_id) AS totalCount FROM enrollments e INNER JOIN institutes i ON e.institution = i.institution_code INNER JOIN institute_categories c ON i.category_id = c.id WHERE i.category_id = $catid AND e.gender = '$gender' GROUP BY e.gender";
    $selrun = $conn->query($dbcon,$sel);
    $count=0;
    if($conn->sqlnum($selrun) > 0){
        $data = $conn->fetch($selrun);
        $count = $data['totalCount'];
    }

    return $count;
}

function checkAccess($type,$user){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $chk = "SELECT id FROM userspages WHERE userid='$user' AND pages LIKE '%$type%'";
    $chkrun = $conn->query($dbcon,$chk);
    if($conn->sqlnum($chkrun) != 0){
        return "checked";
    }else{
        return "No";
    }
}

function getStaff($id){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $response="N/A";
    $sel="SELECT title, first_name, surname, other_names  FROM staff WHERE staff_id = '$id'";
    $selrun = $conn->query($dbcon,$sel);
    if($conn->sqlnum($selrun) != 0){
        $data = $conn->fetch($selrun);
        $response = $data['title']." ".$data['first_name']." ".$data['other_names']." ".$data['surname'];
    }
    return $response;
}

function getGpsLocation($digital_address)
{

    $baseUrl = "https://api.ghanapostgps.com/v2/PublicGPGPSAPI.aspx?Action=GetLocation&GPSName=".$digital_address;
    $gps_device_id = "spring_consult"; // Device Id
    $gps_authorization = "Basic c3ByaW5nX2NvbnN1bHQ6VTNCeWFXNW5JRUJUY0hKcGJtY2dRMjl1YzNWc2RDQnNhVzFwZEdWa0lBPT0="; // Example: "Basic Z3djbDhlZjM0Y2I1ZDA4NTUyNDdkN2Q4YzQzMjY5OW"

    $timeout = 30;
    $headers = array(
        "DeviceID: $gps_device_id",
        "Authorization: $gps_authorization"
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $baseUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, null);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if (curl_errno($ch)) {
        return null;
    }
    curl_close($ch);
    return $response;
}

//function for sending emails
function sendEmail($recipient,$msg,$sender,$subject){
    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'felsina89@gmail.com';
    $mail->Password = 'cgdtgklizduuftzm';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('felsina89@gmail.com');
    $mail->addAddress($recipient);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->send();
    /*$mail = new \PHPMailer\PHPMailer\PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'fpt@gtec.edu.gh';
    $mail->Password = 'gimp!@2005';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom('fpt@gtec.edu.gh');
    $mail->addAddress($recipient);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    if(!$mail->send()){
        echo "Message Could not be sent.";
        echo "Mailer Error: ".$mail->ErrorInfo;
    }else{
        echo "Message has been sent";
    }
    //$mail->send();*/

    //echo "<script>alert('Mail sent successfully');</script>";
}
?>