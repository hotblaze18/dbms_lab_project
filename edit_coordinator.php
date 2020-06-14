<?php
session_start();
include "db/connect.php";
include "./functions.php";
?>

<?php
if (isLoggedInAsAdmin()) {
    $username = $_SESSION['username'];
} else {
    setMessage("You are not logged in as Admin");
    redirect('admin_login.php');
}

if (ifItIsMethod('post')) {
    if (!empty($_POST["id"] && !empty($_POST["email"]))) {
        $id = (int) $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $update = update_coordinator($id, $name, $email);
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
                <label for="usr">Coordinator Id</label>
                <input type="number" class="form-control" placeholder="COORDINATOR ID" id="usr" name="id" value="<?php if (isset($_GET["edit"])) {
                                                                                                                        echo $_GET["id"];
                                                                                                                    } ?>" required readonly>
            </div>
            <div class="form-group mb-3">
                <label for="usr">Coordinator Name</label>
                <input type="text" class="form-control" placeholder="CORDINATOR NAME" id="usr" name="name" value="<?php if (isset($_GET["edit"])) {
                                                                                                                        echo $_GET["name"];
                                                                                                                    } ?>" required>
            </div>
            <div class="form-group mb-3">
                <label for="usr">Coordinator Email</label>
                <input type="email" class="form-control" placeholder="COORDINATOR EMAIL" id="usr" name="email" value="<?php if (isset($_GET["edit"])) {
                                                                                                                            echo $_GET["email"];
                                                                                                                        } ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
    <?php $_SESSION["message"] = ""; ?>
    <script src="app.js"></script>
</body>

</html>