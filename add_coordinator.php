<?php
session_start();
include "db/connect.php";
include "./functions.php";
?>

<?php
if (isLoggedInAsAdmin()) {
    $username = $_SESSION['username'];
} else {
    setMessage("You are not logged in as admin");
    redirect('index.php');
}

if (ifItIsMethod('post')) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        if (empty($_POST["privelege"])) {
            $privelege = 0;
        } else {
            $privelege = 1;
        }
        $flag = add_coordinator($_POST['username'], $_POST['email'], $_POST['password'], $privelege);
        if ($flag)
            setMessage("Successfully Added Coordinator");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Coordinator</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include_once "admin_nav.php" ?>
    <div class="container m-auto" style="transform: translateY(150px);width:60%">
        <?php displayMessage() ?>
        <div class="display-4 text-center mb-3">ADD COORDINATOR</div>
        <form action="#" method="POST">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" placeholder="Username" id="usr" name="username" required>
            </div>
            <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" id="mail" name="email" required>
                <div class="input-group-append">
                    <span class="input-group-text">@example.com</span>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" id="usr" name="password" required>
            </div>
            <div class="checkbox mb-3">
                <label><input type="checkbox" value="" name="privelege"><span class="ml-2">Privelege</span></label>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
    <?php $_SESSION["message"] = ""; ?>
    <script src="app.js"></script>
</body>

</html>