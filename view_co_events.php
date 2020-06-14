<?php
session_start();
include "db/connect.php";
include "./functions.php";
?>

<?php
if (isLoggedInAsCoordinator()) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
} else {
    setMessage("You are not logged in as Coordinator");
    redirect('coordinator_login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Events</title>
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
    <div class="container m-auto" style="transform: translateY(50px);width:70%">
        <?php displayMessage() ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Event Id</th>
                    <th>Event Title</th>
                    <th>Event Price</th>
                    <th>Event Type</th>
                    <th>Edit Event</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT e.event_id,e.event_title, e.event_price, t.type_title FROM events e, superuser s, event_type t ";
                $query .= "WHERE e.type_id = t.type_id AND e.managed_by = s.id AND s.id =  $user_id";
                $select_events_query = mysqli_query($con, $query);
                if (!$select_events_query) {
                    setMessage(mysqli_error($con));
                } else {
                    while ($row = mysqli_fetch_array($select_events_query)) { ?>
                        <tr>
                            <td><?php echo $row['event_id']; ?></td>
                            <td><?php echo $row['event_title']; ?></td>
                            <td><?php echo $row['event_price']; ?></td>
                            <td><?php echo $row['type_title']; ?></td>
                            <td>
                                <form action="edit_co_event.php" target="_blank" method="GET">
                                    <input type="hidden" name="edit" value="1">
                                    <input type="hidden" name="id" value="<?php echo $row['event_id']; ?>">
                                    <input type="hidden" name="title" value="<?php echo $row['event_title']; ?>">
                                    <input type="hidden" name="price" value="<?php echo $row['event_price']; ?>">
                                    <button class="btn btn-warning">Edit</button>
                                </form>
                            </td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
    <?php $_SESSION["messsage"] = " " ?>
    <script src="app.js"></script>
</body>

</html>