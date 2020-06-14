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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Coordinator</title>
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
    <?php include_once "coordinator_nav.php" ?>
    <?php displayMessage() ?>
    <h1 class="text-center m-5">Welcome <?php echo $username ?></h1>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">Participents</div>
                    <img class="card-img-top img-fluid p-2" style="height: 250px;" src="images/participent.jpg" alt="Card image">
                    <div class="card-body text-center">
                        <h4 class="card-title text-center">VIEW/EDIT PARTICIPENTS</h4>
                        <div class="container">
                            <a href="view_participents.php"><i class="fas fa-address-book fa-3x p-4"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">Events</div>
                    <img class="card-img-top img-fluid p-2" style="height: 250px;" src="images/event.jpg" alt="Card image">
                    <div class="card-body text-center">
                        <h4 class="card-title text-center">VIEW YOUR EVENTS</h4>
                        <div class="container">
                            <a href="view_co_events.php"><i class="fas fa-address-book fa-3x p-4"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">Event Type</div>
                    <img class="card-img-top img-fluid p-2" style="height: 250px;" src="images/messages.jpg" alt="Card image">
                    <div class="card-body text-center">
                        <h4 class="card-title text-center">VIEW MESSAGES</h4>
                        <div class="container">
                            <a href="view_messages.php"><i class="fas fa-address-book fa-3x p-4"></i></a>
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