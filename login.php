<?php
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loginName = $_POST["loginname"];
    $password = $_POST["password"];

    $apiUrl = "http://www.minafaleh.com/backend/API_Login.php?loginName=" . urlencode($loginName) . "&pass=" . urlencode($password);

    $response = file_get_contents($apiUrl);
    $result = json_decode($response, true);

    if (is_array($result) && count($result) > 0 && isset($result[0]["msgid"]) && $result[0]["msgid"] == "0") {
        header("Location: index.html");
        exit();
    } else {
        $errorMessage = isset($result[0]["msg"]) ? $result[0]["msg"] : "Unknown error occurred.";
    }
}
?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin - HTML5 Admin Template</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <style>
        /* Cancel hover effect on eye button */
        .btn-outline-secondary:hover,
        .btn-outline-secondary:focus,
        .btn-outline-secondary:active {
            background-color: transparent !important;
            border-color: #ced4da !important;
            color: inherit !important;
            box-shadow: none !important;
            outline: none !important;
        }
        </style>
</head>
<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="images/logo.png" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form method="POST">
                        <?php if (!empty($errorMessage)) : ?>
                            <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label>Login Name</label>
                            <input type="text" name="loginname" class="form-control" placeholder="Login Name" value="<?php echo isset($_POST['loginname']) ? htmlspecialchars($_POST['loginname']) : ''; ?>"required>
                        </div>

                       <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                    id="password"
                                    value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>" required>

                                <div class="input-group-append" style="height: 38px;">
                                    <button class="btn btn-outline-secondary no-hover d-flex align-items-center" type="button" onclick="togglePassword()" style="height: 100%; border: 1px solid #ced4da;
">
                                        <i class="fa fa-eye" id="toggleIcon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                              <label class="pull-right">
                                <a href="forget.php">Forgotten Password?</a>
                            </label>

                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                        <div class="register-link m-t-15 text-center">
                            <p>Don't have an account? <a href="signup.php">Sign Up Here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!-- Password toggle script -->
    <script>
        function togglePassword() {
            const passwordField = document.getElementById("password");
            const toggleIcon = document.getElementById("toggleIcon");

            const isPassword = passwordField.type === "password";
            passwordField.type = isPassword ? "text" : "password";
            toggleIcon.className = isPassword ? "fa fa-eye-slash" : "fa fa-eye";
        }
    </script>
</body>
</html>
