<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$username = isset($_POST['username']) ? $_POST['username'] : null;
$pass = isset($_POST['pass']) ? $_POST['pass'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;

$server = "DESKTOP-BTDDR8O\\SQLEXPRESS";
$database = "MK_db";
$username = "sa";
$password = "123";

$conn = odbc_connect("Driver={SQL Server};Server=$server;Database=$database;", $username, $password, SQL_CUR_USE_ODBC);

if (!$conn) {
    http_response_code(500);
    echo json_encode([ 'Database connection failed: ' . odbc_errormsg()]);
    exit;
}

try {
    $query = "EXEC SIGNUP_PRO @UserName = '".$username."', @Pass = '".$pass."', @Email = '".$email."';";
    $row = odbc_exec($conn, $query);
    $results = array();
    if (!$row) {
        $results = [
            "msgid" => -200,
            "msg"=> 'Database error!',
        ];
    }else {
            while ($row_results = odbc_fetch_array($row)) {
                array_push($results, $row_results);
        }
    }
    echo json_encode($results);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'messageID' => null,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}  
odbc_close($conn);
?>