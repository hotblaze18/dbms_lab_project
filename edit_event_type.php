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
    if (!empty($_POST["id"] && !empty($_POST["type"]))) {
        $id = (int) $_POST["id"];
        $type = $_POST["type"];
        $type = strtoupper($type);
        $event = update_event_type($id, $type);
        if ($event) {
            setMessage("Succesfully Updated Given Event Type");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Event Type</title>
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
        <div class="display-4 text-center mb-3">EDIT EVENT TYPE</div>
        <form action="#" method="post">
            <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="EVENT ID" id="usr" name="id" value="<?php if (isset($_GET["edit"])) {
                                                                                                                echo $_GET["id"];
                                                                                                            } ?>" required readonly>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="EVENT TYPE" id="usr" name="type" value="<?php if (isset($_GET["edit"])) {
                                                                                                                    echo $_GET["type"];
                                                                                                                } ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
    <?php $_SESSION["message"] = ""; ?>
    <script src="app.js"></script>
</body>

</html>