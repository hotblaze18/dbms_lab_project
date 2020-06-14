<?php
session_start();
include "db/connect.php";
include "./functions.php";
?>

<?php
//checkIfUserIsLoggedInAndRedirect("admin.php");
if (isLoggedInAsAdmin()) {
    redirect('admin.php');
}
if (ifItIsMethod('post')) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $flag = login_admin($_POST['username'], $_POST['password']);
        if (!$flag) {
            echo "<p style='color:red;text-align:center;padding:20px;'>Incorrect Username or Password</p>";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container m-auto" style="transform: translateY(150px);width:40%">
        <div class="display-4 text-center mb-3">ADMIN LOGIN</div>
        <form action="admin_login.php" method="POST">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Username" id="usr" name="username" required>
            </div>
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Your Email" id="mail" name="email" required>
                <div class="input-group-append">
                    <span class="input-group-text">@example.com</span>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" id="usr" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>

</html>