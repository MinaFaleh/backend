<?php
session_start();
$msg = "";

// Check if login parameters exist in GET
if (isset($_GET["loginName"]) && isset($_GET["password"])) {
    $loginName = $_GET["loginName"];
    $pass = $_GET["password"];

    // Call the working API with GET
    $apiUrl = "http://www.minafaleh.com/backend/API_Login.php?loginName=" . urlencode($loginName) . "&pass=" . urlencode($pass);

    // Call API using cURL
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    // Validate response
    if (isset($result[0]['msgid']) && $result[0]['msgid'] == "0") {
        $_SESSION['userid'] = $result[0]['userID'];
        $_SESSION['username'] = $result[0]['username'];
        $_SESSION['loginname'] = $loginName;
        header("Location: welcome.php");
        exit();
    } else {
        $msg = isset($result[0]['msg']) ? $result[0]['msg'] : "Wrong login name or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow rounded-4">
                    <div class="card-body">
                        <h4 class="text-center mb-4">Login</h4>
                        <?php if (!empty($msg)): ?>
                            <div class="alert alert-danger"><?php echo htmlspecialchars($msg); ?></div>
                        <?php endif; ?>
                        <form method="get" action="login.php">
                            <div class="mb-3">
                                <label for="loginName" class="form-label">Login Name</label>
                                <input type="text" name="loginName" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
