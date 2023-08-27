<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 8/24/2023
 * Time: 8:05 AM
 */
class Dashboard extends Db_connect
{
    public static function getAccreditationCount():int{
        $conn=new Db_connect;
        $dbcon=$conn->conn();
        $sel="SELECT COUNT(institution) AS totalCount FROM acc_programmes";
        $selrun = $conn->query($dbcon,$sel);
        $data = $conn->fetch($selrun);
        $response = $data['totalCount'];
        $conn->close($dbcon);
        return $response;
    }

    public static function getStaffCount():int{
        $conn=new Db_connect;
        $dbcon=$conn->conn();
        $sel="SELECT COUNT(staff_id) AS totalCount FROM staff";
        $selrun = $conn->query($dbcon,$sel);
        $data = $conn->fetch($selrun);
        $response = $data['totalCount'];
        $conn->close($dbcon);
        return $response;
    }

    public static function getUsersCount():int{
        $conn=new Db_connect;
        $dbcon=$conn->conn();
        $sel="SELECT COUNT(email) AS totalCount FROM users";
        $selrun = $conn->query($dbcon,$sel);
        $data = $conn->fetch($selrun);
        $response = $data['totalCount'];
        $conn->close($dbcon);
        return $response;
    }

    public static function getApplicantCount($status):int{
        $conn=new Db_connect;
        $dbcon=$conn->conn();
        $sel="SELECT COUNT(first_name) AS totalCount FROM appadmissions WHERE status='$status'";
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

    public static function getStudentsCount(){
        $conn=new Db_connect;
        $dbcon=$conn->conn();
        $sel="SELECT COUNT(applicant_id) AS totalCount FROM enrollments";
        $selrun = $conn->query($dbcon,$sel);
        $data = $conn->fetch($selrun);
        $response = $data['totalCount'];
        $conn->close($dbcon);
        return $response;
    }

    public static function getGraduatesCount(){
        $conn=new Db_connect;
        $dbcon=$conn->conn();
        $sel="SELECT COUNT(applicant_id) AS totalCount FROM graduates";
        $selrun = $conn->query($dbcon,$sel);
        $data = $conn->fetch($selrun);
        $response = $data['totalCount'];
        $conn->close($dbcon);
        return $response;
    }
}