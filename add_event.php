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
    if (isset($_FILES['image'])) {
        $errors = array();
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        // $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));

        // $extensions = array("jpeg", "jpg", "png");

        // if (in_array($file_ext, $extensions) === false) {
        //     die("extension not allowed, please choose a JPEG or PNG file.");
        // }
        if (move_uploaded_file($file_tmp, "uploads/" . $file_name)) {
            $title = $_POST["title"];
            $price = $_POST["price"];
            $type =  $_POST["type"];
            $img = "uploads/" . $file_name;
            $managed_by = $_POST["managed_by"];

            $event = add_event($title, $price, $type, $img, $managed_by);
        } else {
            die("Not able to upload image. Try Again.");
        }
    } else {
        setMessage("Please upload a image and retry");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Event</title>
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
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="EVENT TITLE" id="usr" name="title" required>
            </div>
            <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="EVENT PRICE" id="mail" name="price" required>
            </div>
            <div class="form-group">
                <label for="sel1">Select type of event:</label>
                <select name="type" class="form-control" id="sel1">
                    <?php
                    $query = "SELECT type_title FROM event_type";
                    $event_type = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($event_type)) {
                    ?>
                        <option>
                            <?php echo $row['type_title']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sel2">Select Event Coordinator:</label>
                <select name="managed_by" class="form-control" id="sel2">
                    <?php
                    $query = "SELECT s.username FROM superuser s, coordinator c ";
                    $query .= "WHERE s.id = c.id";
                    $select_coordinator_query = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($select_coordinator_query)) { ?>
                        <option>
                            <?php echo $row['username']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="input-group mb-3">
                <input type="file" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
    <?php $_SESSION["message"] = ""; ?>
    <script src="ap.js"></script>
</body>

</html>