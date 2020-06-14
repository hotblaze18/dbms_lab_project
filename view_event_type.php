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
    if (isset($_POST['id1'])) {
        $id = (int) $_POST['id1'];
        $remove = remove_event_type($id);
        if ($remove) {
            setMessage("Succesfully Deleted Given Event Type");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Event Type</title>
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
                    <th>Event Type Id</th>
                    <th>Event Type Title</th>
                    <th>Remove Event</th>
                    <th>Edit Event</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT type_id, type_title FROM event_type ";
                $select_event_type_query = mysqli_query($con, $query);
                if (!$select_event_type_query) {
                    setMessage(mysqli_error($con));
                } else {
                    while ($row = mysqli_fetch_array($select_event_type_query)) { ?>
                        <tr>
                            <td><?php echo $row['type_id']; ?></td>
                            <td><?php echo $row['type_title']; ?></td>
                            <td>
                                <form action="#" method="POST">
                                    <input name="id1" value="<?php echo $row['type_id']; ?>" style="display: none;">
                                    <button class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                            <td>
                                <form action="edit_event_type.php" target="_blank" method="GET">
                                    <input name="edit" value="1" style="display: none;">
                                    <input name="id" value="<?php echo $row['type_id']; ?>" style="display: none;">
                                    <input name="type" value="<?php echo $row['type_title']; ?>" style="display: none;">
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