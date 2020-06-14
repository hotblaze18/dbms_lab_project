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

<?php
if (ifItIsMethod('post')) {
    if (isset($_POST['id'])) {
        $id = (int) $_POST['id'];
        $remove = remove_participent($id);
        if ($remove) {
            setMessage("Succesfully Deleted");
        }
    }
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
                    <th>Participent Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Registered For</th>
                    <th>Remove Participant</th>
                    <th>Edit Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT p.user_id, p.fullname, p.email, p.mobile, e.event_title FROM participent p, events e ";
                $query .= "WHERE e.event_id = p.registerd_for AND e.managed_by = $user_id";
                $select_events_query = mysqli_query($con, $query);
                if (!$select_events_query) {
                    setMessage(mysqli_error($con));
                } else {
                    while ($row = mysqli_fetch_array($select_events_query)) { ?>
                        <tr>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['fullname']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['event_title']; ?></td>
                            <td>
                                <form action="#" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['user_id']; ?>">
                                    <button class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                            <td>
                                <form action="edit_participent.php" target="_blank" method="GET">
                                    <input type="hidden" name="edit" value="1">
                                    <input type="hidden" name="id" value="<?php echo $row['user_id']; ?>">
                                    <input type="hidden" name="name" value="<?php echo $row['fullname']; ?>">
                                    <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                                    <input type="hidden" name="mobile" value="<?php echo $row['mobile']; ?>">
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