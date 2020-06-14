<?php
session_start();
include "db/connect.php";
include "./functions.php";
?>

<?php
if (isLoggedInAsCoordinator()) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION["user_id"];
} else {
    setMessage("You are not logged in as Coordinator");
    redirect('coordinator_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Participents</title>
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
                    <th>Message Id</th>
                    <th>Sent By</th>
                    <th>Sender Email</th>
                    <th>Message Body</th>
                    <th>For Event</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT m.m_id, m.name, m.email, m.m_text, e.event_title FROM messages m, events e ";
                $query .= "WHERE e.event_id = m.m_for AND e.managed_by = $user_id";
                $select_events_query = mysqli_query($con, $query);
                if (!$select_events_query) {
                    setMessage(mysqli_error($con));
                } else {
                    while ($row = mysqli_fetch_array($select_events_query)) { ?>
                        <tr>
                            <td><?php echo $row['m_id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['m_text']; ?></td>
                            <td><?php echo $row['event_title']; ?></td>
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