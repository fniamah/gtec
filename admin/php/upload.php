<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 5/16/2023
 * Time: 11:06 AM
 */
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
require_once ('../../vendor/autoload.php');

include("../dbcon.php");

if (isset($_POST["uploadType"])) {
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    $type = $_POST['uploadType'];
    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    if (in_array($_FILES["uploadFile"]["type"], $allowedFileType)) {

        $file=$_FILES['uploadFile']['tmp_name'];
        //if there was an error uploading the file
        $storagename = date("ymdHis").".xlsx";
        $targetPath="bulk-uploads/".$storagename;//URL of the image location
        $file = file_put_contents($targetPath, file_get_contents($file));
        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);
        $highestColumm = $spreadSheet->setActiveSheetIndex(0)->getHighestColumn();

        $validated="No";
        if($type == "application"){
            if($highestColumm == "Z"){
                $col1=mysqli_real_escape_string($dbcon,$spreadSheetAry[0]['0']);
                $col2=mysqli_real_escape_string($dbcon,$spreadSheetAry[0]['17']);
                $col3=mysqli_real_escape_string($dbcon,$spreadSheetAry[0]['18']);
                $col4=mysqli_real_escape_string($dbcon,$spreadSheetAry[0]['19']);
                $col5=mysqli_real_escape_string($dbcon,$spreadSheetAry[0]['22']);
                $col6=mysqli_real_escape_string($dbcon,$spreadSheetAry[0]['25']);

                if($col1 == "Applicant Number" && $col2 == "Institution Code" && $col3 == "Application Type" && $col4 == "Programme Applied Code" && $col5 == "Programme Type" && $col6 == "Fee Payment Type"){
                    for ($i = 1; $i < $sheetCount; $i ++) {
                        $stdid=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['0']);
                        $fname=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['1']);
                        $lname=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['2']);
                        $oname=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['3']);
                        $dob=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['4']);
                        $sex=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['5']);
                        $idtype=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['6']);
                        $idnum=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['7']);
                        $country=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['8']);
                        $birth=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['9']);
                        $disable=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['15']);
                        $distype=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['16']);
                        $inst=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['17']);
                        $religion=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['10']);
                        $town=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['11']);
                        $region=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['12']);
                        $shs=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['13']);
                        $shsprog=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['14']);
                        $prog=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['19']);
                        $progoffered=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['20']);
                        $status=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['23']);
                        $feepaying=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['25']);
                        $year=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['21']);
                        $progtype=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['22']);
                        $level=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['24']);
                        $apptype=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['18']);

                        //IGNORE EMPTY SPACES
                        if(!empty($stdid) && !empty($status)){
                            //CHECK IF STUDENT DETAILS EXISTS
                            if(checkIfStudentExists($stdid) == "Valid"){
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
                                }elseif($status == "Graduated"){
                                    $ins = "INSERT INTO graduates(institution, year, applicant_id, applicant_id_type,applicant_national_id, first_name, surname,
                             other_names, gender, birth_date, birth_country, nationality, religion, home_town, home_region, high_school,
                              high_school_program, disability, disability_type,programme_applied,fee_type,programme_type,programme_offered, status,admission_level,application_type) 
                              VALUES ('$inst','$year','$stdid','$idtype','$idnum','$fname','$lname','$oname','$sex','$dob','$birth','$country','$religion','$town',
                              '$region','$shs','$shsprog','$disable','$distype','$prog','$feepaying','$progtype','$progoffered','Active','$level','$apptype')";
                                }

                                $insrun = $conn->query($dbcon,$ins);
                            }else{
                                //LOG THE FAILED HERE
                            }

                        }
                    }
                    $response['errorCode'] = "0";
                    $response['errorMsg'] = "Bulk Data Has Been Uploaded Successfully";
                    print json_encode($response);
                }else{
                    $response['errorCode'] = "1";
                    $response['errorMsg'] = "File Validation Failed";
                    print json_encode($response);
                }
            }else{
                $response['errorCode'] = "1";
                $response['errorMsg'] = "File Validation Failed";
                print json_encode($response);
            }

        }
        elseif($type == "qualified" || $type == "offered"){
            if($highestColumm == "G"){
                $col1=mysqli_real_escape_string($dbcon,$spreadSheetAry[1]['0']);
                $col2=mysqli_real_escape_string($dbcon,$spreadSheetAry[1]['2']);
                $col3=mysqli_real_escape_string($dbcon,$spreadSheetAry[1]['5']);

                if($col1 == "#" && trim($col2) == "Applicant ID" && trim($col3) == "Programme Type"){
                    for ($i = 2; $i < $sheetCount; $i ++) {
                        $stdid=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['2']);
                        if(!empty($stdid)){
                            //CHECK IF STUDENT DETAILS EXISTS
                            if($type == "qualified"){
                                //CHECK THE admissions table, enrollments table and graduates table to see if such student records do not exist
                                $chkadmissions = "SELECT year AS totalCount FROM appadmissions WHERE applicant_id = '$stdid' AND status = 'Qualified'";
                                $admissionRun = $conn->query($dbcon,$chkadmissions);
                                if($conn->sqlnum($admissionRun) != 0){
                                    $upd = "UPDATE appadmissions SET status = 'Offered' WHERE applicant_id='$stdid'";
                                    $conn->query($dbcon,$upd);
                                }else{
                                    //PUT LOG HERE
                                }
                            }elseif($type == "offered"){
                                //CHECK THE admissions table, enrollments table and graduates table to see if such student records do not exist
                                $chkadmissions = "SELECT year AS totalCount FROM enrollments WHERE applicant_id = '$stdid' AND status = 'Active'";
                                $admissionRun = $conn->query($dbcon,$chkadmissions);
                                if($conn->sqlnum($admissionRun) == 0){
                                    $mov = "INSERT INTO enrollments(institution, year, applicant_id, applicant_id_type,applicant_national_id, first_name, surname,
                                             other_names, gender, birth_date, birth_country, nationality, religion, home_town, home_region, high_school,
                                              high_school_program, disability, disability_type,fee_type,programme_type,programme_offered, status,admission_level,application_type) 
                                              SELECT institution, year, applicant_id, applicant_id_type,applicant_national_id, first_name, surname,
                                             other_names, gender, birth_date, birth_country, nationality, religion, home_town, home_region, high_school,
                                              high_school_program, disability, disability_type,fee_type,programme_type,programme_offered, 'Active',admission_level,application_type FROM appadmissions WHERE applicant_id = '$stdid'";
                                    $conn->query($dbcon,$mov);
                                    //DELETE THE RECORDS FROM THE APPADMISSIONS TABLE
                                    $del ="DELETE FROM appadmissions WHERE applicant_id = '$stdid'";
                                    $conn->query($dbcon,$del);
                                }else{
                                    //PUT LOG HERE
                                }
                            }


                        }
                    }
                    $response['errorCode'] = "0";
                    $response['errorMsg'] = "Bulk Data Has Been Uploaded Successfully";
                    print json_encode($response);
                }else{
                    $response['errorCode'] = "1";
                    $response['errorMsg'] = "File Validation Failed";
                    print json_encode($response);
                }
            }else{
                $response['errorCode'] = "1";
                $response['errorMsg'] = "File Validation Failed";
                print json_encode($response);
            }

        }
        elseif($type == "graduated"){
            if($highestColumm == "V"){
                $col1=mysqli_real_escape_string($dbcon,$spreadSheetAry[1]['0']);

                if(trim($col1) == "Student/Reference Number"){
                    for ($i = 2; $i < $sheetCount; $i ++) {
                        $stdid=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['0']);
                        if(!empty($stdid)){
                            //CHECK THE admissions table, enrollments table and graduates table to see if such student records do not exist
                            $chkadmissions = "SELECT year AS totalCount FROM graduates WHERE applicant_id = '$stdid'";
                            $admissionRun = $conn->query($dbcon,$chkadmissions);
                            if($conn->sqlnum($admissionRun) == 0) {
                                $mov = "INSERT INTO graduates(institution, year, applicant_id, applicant_id_type,applicant_national_id, first_name, surname,
                                 other_names, gender, birth_date, birth_country, nationality, religion, home_town, home_region, high_school,
                                  high_school_program, disability, disability_type,fee_type,programme_type,programme_offered, status,admission_level,application_type) 
                                  SELECT institution, year, applicant_id, applicant_id_type,applicant_national_id, first_name, surname,
                                 other_names, gender, birth_date, birth_country, nationality, religion, home_town, home_region, high_school,
                                  high_school_program, disability, disability_type,fee_type,programme_type,programme_offered, status,admission_level,application_type FROM enrollments WHERE applicant_id = '$stdid'";

                                $conn->query($dbcon, $mov);
                                //DELETE THE RECORDS FROM THE APPADMISSIONS TABLE
                                $del = "DELETE FROM enrollments WHERE applicant_id = '$stdid'";
                                $conn->query($dbcon, $del);
                            }
                        }
                    }
                    $response['errorCode'] = "0";
                    $response['errorMsg'] = "Bulk Data Has Been Uploaded Successfully";
                    print json_encode($response);
                }else{
                    $response['errorCode'] = "1";
                    $response['errorMsg'] = "File Validation Failed";
                    print json_encode($response);
                }
            }else{
                $response['errorCode'] = "1";
                $response['errorMsg'] = "File Validation Failed";
                print json_encode($response);
            }

        }
        elseif($type == "add_student"){
            if($highestColumm == "Z"){
                $col1=mysqli_real_escape_string($dbcon,$spreadSheetAry[0]['0']);
                $col2=mysqli_real_escape_string($dbcon,$spreadSheetAry[0]['17']);
                $col3=mysqli_real_escape_string($dbcon,$spreadSheetAry[0]['18']);
                $col4=mysqli_real_escape_string($dbcon,$spreadSheetAry[0]['19']);
                $col5=mysqli_real_escape_string($dbcon,$spreadSheetAry[0]['22']);
                $col6=mysqli_real_escape_string($dbcon,$spreadSheetAry[0]['25']);

                if($col1 == "Applicant Number" && $col2 == "Institution Code" && $col3 == "Application Type" && $col4 == "Programme Applied Code" && $col5 == "Programme Type" && $col6 == "Fee Payment Type"){
                    for ($i = 1; $i < $sheetCount; $i ++) {
                        $stdid=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['0']);
                        $fname=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['1']);
                        $lname=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['2']);
                        $oname=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['3']);
                        $dob=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['4']);
                        $sex=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['5']);
                        $idtype=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['6']);
                        $idnum=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['7']);
                        $country=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['8']);
                        $birth=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['9']);
                        $disable=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['15']);
                        $distype=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['16']);
                        $inst=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['17']);
                        $religion=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['10']);
                        $town=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['11']);
                        $region=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['12']);
                        $shs=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['13']);
                        $shsprog=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['14']);
                        $prog=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['19']);
                        $progoffered=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['20']);
                        $status=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['23']);
                        $feepaying=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['25']);
                        $year=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['21']);
                        $progtype=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['22']);
                        $level=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['24']);
                        $apptype=mysqli_real_escape_string($dbcon,$spreadSheetAry[$i]['18']);

                        //IGNORE EMPTY SPACES
                        if(!empty($stdid) && !empty($status)){
                            //CHECK IF STUDENT DETAILS EXISTS
                            if(checkIfStudentExists($stdid) == "Valid"){
                                //INSERT BASIC RECORDS AND APPLICATION RECORDS OF THE STUDENT
                                $ins = "INSERT INTO enrollments(institution, year, applicant_id, applicant_id_type,applicant_national_id, first_name, surname,
                             other_names, gender, birth_date, birth_country, nationality, religion, home_town, home_region, high_school,
                              high_school_program, disability, disability_type,fee_type,programme_type,programme_offered, status,admission_level,application_type) 
                              VALUES ('$inst','$year','$stdid','$idtype','$idnum','$fname','$lname','$oname','$sex','$dob','$birth','$country','$religion','$town',
                              '$region','$shs','$shsprog','$disable','$distype','$feepaying','$progtype','$progoffered','Active','$level','$apptype')";

                                $insrun = $conn->query($dbcon,$ins);
                            }else{
                                //LOG THE FAILED HERE
                            }

                        }
                    }
                    $response['errorCode'] = "0";
                    $response['errorMsg'] = "Bulk Data Has Been Uploaded Successfully";
                    print json_encode($response);
                }else{
                    $response['errorCode'] = "1";
                    $response['errorMsg'] = "File Validation Failed";
                    print json_encode($response);
                }
            }else{
                $response['errorCode'] = "1";
                $response['errorMsg'] = "File Validation Failed";
                print json_encode($response);
            }

        }
        else{
            $response['errorCode'] = "1";
            $response['errorMsg'] = "I dont know";
            print json_encode($response);
        }
    } else {
        $response['errorCode'] = "1";
        $response['errorMsg'] = "File With Extension ".$_FILES["uploadFile"]["type"]." Not Allowed. Only excel file formats are supported";
        print json_encode($response);
    }

    $conn->close($dbcon);
}


function checkIfStudentExists($stdid){
    $conn=new Db_connect;
    $dbcon=$conn->conn();
    //CHECK THE admissions table, enrollments table and graduates table to see if such student records do not exist
    $chkadmissions = "SELECT year AS totalCount FROM appadmissions WHERE applicant_id = '$stdid'";
    $chkenrollment = "SELECT year AS totalCount FROM enrollments WHERE applicant_id = '$stdid'";
    $chkgraduates = "SELECT year AS totalCount FROM graduates WHERE applicant_id = '$stdid'";

    $enrollRun = $conn->query($dbcon,$chkenrollment);
    $admissionRun = $conn->query($dbcon,$chkadmissions);
    $graduateRun = $conn->query($dbcon,$chkgraduates);
    if($conn->sqlnum($enrollRun) == 0 && $conn->sqlnum($admissionRun) == 0 && $conn->sqlnum($graduateRun) == 0){
        return "Valid";
    }
    return "Invalid";
}
?>