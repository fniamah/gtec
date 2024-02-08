<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 2/7/2024
 * Time: 10:24 AM
 */
include("../dbcon.php");
$conn=new Db_connect;
$dbcon=$conn->conn();

$databases = ['fptec'];

//CHEK IF FOLDER FOR SAVING BACKUP EXISTS
if(!file_exists(BACKUP_BASE_LOCATION)){
    mkdir(BACKUP_BASE_LOCATION);
}

foreach($databases as $database){
    if(!file_exists(BACKUP_BASE_LOCATION."/$database")){
        mkdir(BACKUP_BASE_LOCATION."/$database");
    }

    $filenmae = $database."_".date("F_d_Y")."@".date("g_ia").uniqid("_",false);
    $folder = BACKUP_BASE_LOCATION."/$database/".$filenmae.".sql";

    //INSERT INTO THE DATABASE LOGS TABLE
    $ins = "INSERT INTO database_logs(file_name) VALUES ('$filenmae')";
    $conn->query($dbcon,$ins);

    exec(MYSQL_DUMP_LOCATION." --user=".DB_USER." --password=".DB_PASSWORD." --host=".DB_HOST." {$database} --result-file={$folder}", $output);
}

$conn->close($dbcon);