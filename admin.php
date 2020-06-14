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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>

<body class="pb-5">
    <?php include_once "admin_nav.php" ?>
    <?php displayMessage() ?>
    <h1 class="text-center m-5">Welcome <?php echo $username ?></h1>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Coordinator</div>
                    <img class="card-img-top img-fluid p-2" style="height: 250px;" src="images/coordinator.jpg" alt="Card image">
                    <div class="card-body text-center">
                        <h4 class="card-title text-center">ADD/VIEW COORDINATORS</h4>
                        <div class="container">
                            <a href="add_coordinator.php"><i class="fas fa-plus fa-3x p-4"></i></a>
                            <a href="view_coordinators.php"><i class="fas fa-address-book fa-3x p-4"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">Event</div>
                    <img class="card-img-top img-fluid p-2" style="height: 250px;" src="images/event.jpg" alt="Card image">
                    <div class="card-body text-center">
                        <h4 class="card-title text-center">ADD/VIEW EVENTS</h4>
                        <div class="container">
                            <a href="add_event.php"><i class="fas fa-plus fa-3x p-4"></i></a>
                            <a href="view_events.php"><i class="fas fa-address-book fa-3x p-4"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">Event Type</div>
                    <img class="card-img-top img-fluid p-2" style="height: 250px;" src="images/event_type.png" alt="Card image">
                    <div class="card-body text-center">
                        <h4 class="card-title text-center">ADD/VIEW EVENT TYPES</h4>
                        <div class="container">
                            <a href="add_event_type.php"><i class="fas fa-plus fa-3x p-4"></i></a>
                            <a href="view_event_type.php"><i class="fas fa-address-book fa-3x p-4"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php setMessage(""); ?>
    <script src="app.js"></script>
</body>

</html>