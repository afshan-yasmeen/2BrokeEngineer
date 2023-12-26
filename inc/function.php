<?php

function myExceptionHandler($e)
{
    // header('HTTP/1.1 500 Internal Server Error', TRUE, 500);
    error_log($e->getMessage() . ". Trace: " . $e->getTraceAsString());
    $path = $e->getFile();
    $file = basename($path);         // $file is set to "index.php"
    //$file = basename($path, ".php");
    $error_message_alert = "Error: " . $e->getMessage() . "<br><br> Error in file: " . $file . " [" . $e->getLine() . "]";
    error($error_message_alert);
    //include "./error.php";
    include "./underconstruction/index.php";
    exit;
}
set_exception_handler('myExceptionHandler');
function str_time($time)
{
    $dt = new DateTime();
    $dt->setTimestamp($time); //<--- Pass a UNIX TimeStamp
    return $dt->format('h:i a');
}
function str_date($time)
{
    $dt = new DateTime();
    $dt->setTimestamp($time); //<--- Pass a UNIX TimeStamp
    return $dt->format('d-M-Y');
}
function intcode($n)
{
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}
function randomstr($n)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    $randomString = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
    return $randomString;
}
function getfilename()
{
    $filename = ucfirst(basename($_SERVER["SCRIPT_FILENAME"], ".php"));
    $filename = str_replace("_", " ", $filename);
    $filename = ucwords($filename);
    return $filename;
}
//For ROW count
function count_records($table, $condition_type = "AND", ...$conditions)
{
    global $sql;
    $query = "SELECT COUNT(*) FROM $table";
    if (!empty($conditions)) {
        $query .= " WHERE ";
        $i = 0;
        foreach ($conditions as $condition) {
            if (is_array($condition)) {
                $j = 0;
                foreach ($condition as $field => $value) {
                    $query .= "$field = '$value'";
                    if ($j < count($condition) - 1) {
                        $query .= " $condition_type ";
                    }
                    $j++;
                }
            } else {
                $query .= $condition;
            }
            if ($i < count($conditions) - 1) {
                $query .= " $condition_type ";
            }
            $i++;
        }
    }
    $result = $sql->query($query);
    $count = $result->fetch_row()[0];
    //$sql->close();
    return $count;
}
//Data Insertion Code
function insert($tableName, $data, $rules = [], $successMsg = 'Data inserted successfully.')
{
    global $connect;
    $columns = implode(", ", array_keys($data));
    $placeholders = ":" . implode(", :", array_keys($data));
    $sql = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
    $stmt = $connect->prepare($sql);
    foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }
    // Check validation rules for specific fields
    $errors = []; // initialize empty array to store errors
    foreach ($rules as $field => $fieldRules) {
        foreach ($fieldRules as $rule => $param) {
            if ($rule === 'required') {
                if ($param && empty($data[$field])) {
                    $errors[$field] = "$field is required.";
                }
            } else if ($rule === 'min') {
                if (strlen($data[$field]) < $param) {
                    $errors[$field] = "$field must be at least $param characters long.";
                }
            } else if ($rule === 'max') {
                if (strlen($data[$field]) > $param) {
                    $errors[$field] = "$field cannot be more than $param characters long.";
                }
            }
        }
    }
    // Check if there are errors
    if (!empty($errors)) {
        return $errors; // return array of errors
    }
    try {
        $stmt->execute();
        return $successMsg;
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}
function update($tableName, $data, $where, $rules = array(), $successMsg = 'Data updated successfully.')
{
    global $connect;
    $setStr = '';
    foreach ($data as $key => $value) {
        $setStr .= "$key = :$key, ";
    }
    $setStr = rtrim($setStr, ', ');
    $sql = "UPDATE $tableName SET $setStr WHERE $where";
    $stmt = $connect->prepare($sql);
    foreach ($data as $key => $value) {
        $stmt->bindValue(":$key", $value);
    }
    if (!empty($rules)) {
        $errorMessages = array();
        foreach ($rules as $key => $rule) {
            $value = $data[$key];
            if (!empty($rule['required']) && empty($value)) {
                $errorMessages[$key] = ucfirst($key) . ' field is required.';
            } else if (!empty($rule['min']) && strlen($value) < $rule['min']) {
                $errorMessages[$key] = ucfirst($key) . ' field must contain at least ' . $rule['min'] . ' characters.';
            } else if (!empty($rule['max']) && strlen($value) > $rule['max']) {
                $errorMessages[$key] = ucfirst($key) . ' field cannot exceed ' . $rule['max'] . ' characters.';
            }
        }
        if (!empty($errorMessages)) {
            $errorMsg = implode(' ', $errorMessages);
            return $errorMsg;
        }
    }
    try {
        $stmt->execute();
        return $successMsg;
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}
function delete($tableName, $where, $successMsg = 'Data deleted successfully.')
{
    global $connect;
    $sql = "DELETE FROM $tableName WHERE $where";
    try {
        $stmt = $connect->prepare($sql);
        $stmt->execute();
        return $successMsg;
    } catch (PDOException $e) {
        return "Error: " . $e->getMessage();
    }
}
function select($tableName, $columns = '*', $where = '1', $orderBy = '', $limit = '')
{
    global $connect;
    $sql = "SELECT $columns FROM $tableName WHERE $where $orderBy $limit";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($rows) == 0) {
        $result = "Error: No records found.";
    } else {
        $result = [];
        foreach ($rows as $row) {
            $result[] = $row;
        }
    }
    return $result;
}
function checkRecordExists($tableName, $conditions)
{
    global $connect;
    $sql = "SELECT COUNT(*) as count FROM $tableName WHERE ";
    $whereClauses = [];
    foreach ($conditions as $condition) {
        $column = $condition['column'];
        $operator = $condition['operator'];
        $value = $condition['value'];
        $logic = isset($condition['logic']) ? $condition['logic'] : 'AND';
        $whereClauses[] = "$column $operator ?";
        $params[] = $value;
        $sql .= "$logic ";
    }
    $sql .= implode(" $logic ", $whereClauses);
    $stmt = $connect->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] > 0;
}
function validatePassword($password)
{
    $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[A-Za-z\d\W_]{8,}$/';
    if (preg_match($regex, $password)) {
        return true;
    } else {
        return false;
    }
}
function array_to_string($array)
{
    $result = '';
    foreach ($array as $item) {
        if (is_array($item)) {
            $result .= array_to_string($item);
        } else {
            $result .= $item;
        }
    }
    return $result;
}

function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ipArray = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($ipArray as $ip) {
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
    return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null;
}


function redirect($path)
{
    echo "<script>window.location.replace('" . $path . "');</script>";
}


function cookies_time()
{
    $cookiestime = 60 * 60 * 3;
    return $cookiestime;
}
function name()
{
    return isset($_COOKIE["name"]) ? $_COOKIE["name"] : '';
}
function email()
{
    return isset($_COOKIE["email"]) ? $_COOKIE["email"] : '';
}


function error($error){
    $info = $_SERVER;
  $log_data = array(
      'error' => $error,
      'info' => json_encode($info),
      'time' => time()
  );
  $rules = array();
  $result = insert('log', $log_data, $rules, '');

}

function get_value($table, $column, $where = '1', $orderBy = '', $limit = '')
{
   
    $results = select("$table", '*', "$where", "$orderBy", "$limit");
    if (is_array($results)) {
        foreach ($results as $row) {

           $value = $row[$column];
           return $value;
        }
    }
}

function validateAndSanitize($value) {
    $sanitizedValue = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
    return $sanitizedValue;
}

function extenion()
{
    $extension = get_value('setting', 'php_extension');
    return $extension;
}
