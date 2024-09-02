<?php
session_start();
include('includes/config.php');

if (isset($_POST['signin'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];
    
    // Prepare SQL statement
    $sql = "SELECT UserName, Password FROM admin WHERE UserName = :username";
    $query = $dbh->prepare($sql);
    $query->bindParam(':username', $uname, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    
    // Check if user exists and password is correct
    if ($result && password_verify($password, $result->Password)) {
        $_SESSION['alogin'] = $uname;
        echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
    } else {
        echo "<script>alert('Invalid Username or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="description" content="Responsive Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />
    
    <title>Admin Login</title>
    
    <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css"/>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">        
    <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css"/>
</head>
<body class="signin-page">

    <div class="mn-content valign-wrapper">
        <main class="mn-inner container">
            <h4 align="center"><a href="index.php" style="color:#000;">Admin Login</a></h4>
            <div class="valign">
                <div class="row">
                    <div class="col s12 m6 l4 offset-l4 offset-m3">
                        <div class="card white darken-1">
                            <div class="card-content">
                                <span class="card-title">Sign In</span>
                                <div class="row">
                                    <form class="col s12" name="signin" method="post">
                                        <div class="input-field col s12">
                                            <input id="username" type="text" name="username" class="validate" autocomplete="off" required>
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="input-field col s12">
                                            <input id="password" type="password" class="validate" name="password" autocomplete="off" required>
                                            <label for="password">Password</label>
                                        </div>
                                        <div class="col s12 right-align m-t-sm">
                                            <input type="submit" name="signin" value="Sign in" class="waves-effect waves-light btn teal">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="../assets/js/alpha.min.js"></script>
</body>
</html>
