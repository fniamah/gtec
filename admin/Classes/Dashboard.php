<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 8/24/2023
 * Time: 8:05 AM
 */
class Dashboard extends Db_connect
{

    public static function getAccreditationCount($actype,$institution){
        $conn=new Db_connect;
        $dbcon=$conn->conn();
        $sel = $actype == "GTEC" ? "SELECT COUNT(institution) AS totalCount FROM acc_programmes" : "SELECT COUNT(institution) AS totalCount FROM acc_programmes WHERE institution = '$institution'";
        $selrun = $conn->query($dbcon,$sel);
        $data = $conn->fetch($selrun);
        $response = $data['totalCount'];
        $conn->close($dbcon);
        return $response;
    }

    public static function getStaffCount($actype,$institution){
        $conn=new Db_connect;
        $dbcon=$conn->conn();
        $sel = $actype == "GTEC" ? "SELECT COUNT(staff_id) AS totalCount FROM staff" : "SELECT COUNT(staff_id) AS totalCount FROM staff WHERE institution='$institution'";
        $selrun = $conn->query($dbcon,$sel);
        $data = $conn->fetch($selrun);
        $response = $data['totalCount'];
        $conn->close($dbcon);
        return $response;
    }

    public static function getUsersCount($actype,$institution){
        $conn=new Db_connect;
        $dbcon=$conn->conn();
        $sel= $actype == "GTEC" ? "SELECT COUNT(email) AS totalCount FROM users" : "SELECT COUNT(email) AS totalCount FROM users WHERE institution = '$institution'";
        $selrun = $conn->query($dbcon,$sel);
        $data = $conn->fetch($selrun);
        $response = $data['totalCount'];
        $conn->close($dbcon);
        return $response;
    }

    public static function getApplicantCount($status,$actype,$institution){
        $conn=new Db_connect;
        $dbcon=$conn->conn();
        $sel= $actype == "GTEC" ? "SELECT COUNT(first_name) AS totalCount FROM appadmissions WHERE status='$status'" : "SELECT COUNT(first_name) AS totalCount FROM appadmissions WHERE status='$status' AND institution = '$institution'";
        $selrun = $conn->query($dbcon,$sel);
        $data = $conn->fetch($selrun);
        $response = $data['totalCount'];
        $conn->close($dbcon);
        return $response;
    }

    public static function getInstitutionCount(){
        $conn=new Db_connect;
        $dbcon=$conn->conn();
        $sel="SELECT COUNT(name) AS totalCount FROM institutes WHERE status='Active'";
        $selrun = $conn->query($dbcon,$sel);
        $data = $conn->fetch($selrun);
        $response = $data['totalCount'];
        $conn->close($dbcon);
        return $response;
    }

    public static function getStudentsCount($actype,$institution){
        $conn=new Db_connect;
        $dbcon=$conn->conn();
        $sel= $actype == "GTEC" ? "SELECT COUNT(applicant_id) AS totalCount FROM enrollments" : "SELECT COUNT(applicant_id) AS totalCount FROM enrollments WHERE institution = '$institution'";
        $selrun = $conn->query($dbcon,$sel);
        $data = $conn->fetch($selrun);
        $response = $data['totalCount'];
        $conn->close($dbcon);
        return $response;
    }

    public static function getGraduatesCount($actype,$institution){
        $conn=new Db_connect;
        $dbcon=$conn->conn();
        $sel= $actype == "GTEC" ? "SELECT COUNT(applicant_id) AS totalCount FROM graduates" : "SELECT COUNT(applicant_id) AS totalCount FROM graduates WHERE institution = '$institution'";
        $selrun = $conn->query($dbcon,$sel);
        $data = $conn->fetch($selrun);
        $response = $data['totalCount'];
        $conn->close($dbcon);
        return $response;
    }
}