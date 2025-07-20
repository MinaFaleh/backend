<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

$arg_LoginName = isset($GET['loginName']) ? $GET['loginName'] : null;
$arg_Password = isset($GET['pass']) ? $GET['pass'] : null;

$server = "DESKTOP-BTDDR8O\\SQLEXPRESS";
$database = "MK_db";
$username = "sa";
$password = "123";

$conn = odbc_connect("Driver={SQL Server};Server=$server;Database=$database;", $username, $password, SQL_CUR_USE_ODBC);

if (!$conn) {
    http_response_code(500);
    echo json_encode([
        'userID' => null,
        'messageID' => null,
        'message' => 'Database connection failed: ' . odbc_errormsg()
    ]);
    exit;
}

try {
    // $query = "EXEC LOGIN_PRO";
    $query = "EXEC LOGIN_PRO ";
    print_r($query);
    return;
    $result = odbc_exec($conn, $query);
    // $row = odbc_fetch_array($query);
    echo json_encode($result);
        //  echo json_encode(
    // }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'userID' => null,
        'messageID' => null,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
}

// odbc_close($conn);
?>