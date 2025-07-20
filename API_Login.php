<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

$arg_LoginName = isset($_GET['loginName']) ? $_GET['loginName'] : null;
$arg_Password = isset($_GET['pass']) ? $_GET['pass'] : null;

$server = "DESKTOP-BTDDR8O\\SQLEXPRESS";
$database = "MK_db";
$username = "sa";
$password = "123";

$conn = odbc_connect("Driver={SQL Server};Server=$server;Database=$database;", $username, $password, SQL_CUR_USE_ODBC);

if (!$conn) {
    http_response_code(500);
    echo json_encode([
        'userName' => null,
        'userID' => null,
        'msgid' => -100,
        'msg' => 'Database connection failed: ' . odbc_errormsg()
    ]);
    exit;
}

try {
    // $query = "EXEC LOGIN_PRO";
    $query = "EXEC LOGIN_PRO @arg_LoginName = '".@$arg_LoginName."', @arg_Password='".@$arg_Password."';";
    //print_r($query);
    //return;
    $row = odbc_exec($conn, $query);
    $results = array();
    if (!$row) {
        $results = [
            "msgid" => -200,
            "msg"=> 'Database error!',
            "userid" => null,
            "username"=> null,
        ];
    }
        else {
            while ($row_results = odbc_fetch_array($row)) {
                array_push($results, $row_results);
        }
    }

    // $row = odbc_fetch_array($query);
    echo json_encode($results);
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
