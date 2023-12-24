<?php
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});
$error_message_alert = "";
define('DBNAME', 'broke');
define('DBHOST', 'localhost');
define('DBPASS', '');
define('DBUSER', 'root');
try {
    $connect = new PDO('mysql:host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS);
    $sql = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    @session_start();
} catch (PDOException $e) {
    $error_message_alert = "Error: " . $e->getMessage();
    include "./underconstruction/index.php";
    die();
} catch (Exception $exc) {
    $error_message_alert = "Error in  Database Connection: " . $exc->getMessage();
    include "./underconstruction/index.php";
    die();
} catch (Error $err) {
    $error_message_alert = "Error in  Database Connection: " . $err->getMessage();
    include "./underconstruction/index.php";
    die();
}
