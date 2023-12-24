<?php 
$conn=new mysqli('sqlsrv:server = tcp:mahpara-afshan-mehro.database.windows.net,1433','CloudSA26407d6b','Afshan@123456789','2BrokeEngineerDatabase');

// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:mahpara-afshan-mehro.database.windows.net,1433; Database = 2BrokeEngineerDatabase", "CloudSA26407d6b", "Afshan@123456789");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "CloudSA26407d6b", "pwd" => "{your_password_here}", "Database" => "2BrokeEngineerDatabase", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:mahpara-afshan-mehro.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>
?>