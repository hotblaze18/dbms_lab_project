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

<?php
if (ifItIsMethod('post')) {
    if (isset($_POST['id'])) {
        $id = (int) $_POST['id'];
        $remove = remove_event($id);
        if ($remove) {
            setMessage("Succesfully Deleted");
        }
    }
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
    <?php include_once "admin_nav.php" ?>
    <div class="container m-auto" style="transform: translateY(50px);width:70%">
        <?php displayMessage() ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Event Id</th>
                    <th>Event Title</th>
                    <th>Event Price</th>
                    <th>Event Type</th>
                    <th>Event Coordinator</th>
                    <th>Remove Event</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT e.event_id,e.event_title, e.event_price, t.type_title, s.username FROM events e, superuser s, event_type t ";
                $query .= "WHERE e.type_id = t.type_id AND e.managed_by = s.id ";
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
                            <td><?php echo $row['username']; ?></td>
                            <td>
                                <form action="#" method="POST">
                                    <input name="id" value="<?php echo $row['event_id']; ?>" style="display: none;">
                                    <button class="btn btn-danger">Remove</button>
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