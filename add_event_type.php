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
    $type = $_POST["type"];
    $type = strtoupper($type);
    $event = add_event_type($type);
    if ($event) {
        setMessage("Succesfully Added Given Event Type");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Event Type</title>
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
    <div class="container m-auto" style="transform: translateY(100px);width:60%">
        <?php displayMessage() ?>
        <div class="display-4 text-center mb-3">ADD EVENT</div>
        <form action="#" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="EVENT TYPE" id="usr" name="type" required>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
    <?php $_SESSION["message"] = ""; ?>
    <script src="app.js"></script>
</body>

</html>