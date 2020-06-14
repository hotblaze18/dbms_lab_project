<?php
session_start();
include "db/connect.php";
include "./functions.php";
?>

<?php
if (isLoggedInAsCoordinator()) {
    $username = $_SESSION['username'];
} else {
    setMessage("You are not logged in as Coordinator");
    redirect('coordinator_login.php');
}

if (ifItIsMethod('post')) {
    if (!empty($_POST["id"] && !empty($_POST["email"]))) {
        $id = (int) $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $mobile = $_POST["mobile"];
        $update = update_participent($id, $name, $email, $mobile);
        if ($update) {
            setMessage("Succesfully Updated Participent Details");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Participent</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include_once "coordinator_nav.php" ?>
    <div class="container m-auto" style="transform: translateY(100px);width:60%">
        <?php displayMessage() ?>
        <div class="display-4 text-center mb-3">EDIT PARTICIPENT DETAILS</div>
        <form action="#" method="post">
            <div class="form-group mb-3">
                <input type="number" class="form-control" placeholder="PARTICIPENT ID" id="usr" name="id" value="<?php if (isset($_GET["edit"])) {
                                                                                                                        echo $_GET["id"];
                                                                                                                    } ?>" required readonly>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" placeholder="PARTICIPENT NAME" id="usr" name="name" value="<?php if (isset($_GET["edit"])) {
                                                                                                                        echo $_GET["name"];
                                                                                                                    } ?>" required>
            </div>
            <div class="form-group mb-3">
                <input type="email" class="form-control" placeholder="PARTICIPENT EMAIL" id="usr" name="email" value="<?php if (isset($_GET["edit"])) {
                                                                                                                            echo $_GET["email"];
                                                                                                                        } ?>" required>
            </div>
            <div class="form-group mb-3">
                <input type="text" class="form-control" placeholder="PARTICIPENT MOBILE" id="usr" name="mobile" value="<?php if (isset($_GET["edit"])) {
                                                                                                                            echo $_GET["mobile"];
                                                                                                                        } ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
    <?php $_SESSION["message"] = ""; ?>
    <script src="app.js"></script>
</body>

</html>