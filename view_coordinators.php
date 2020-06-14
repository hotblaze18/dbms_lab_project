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
        $remove = remove_coordinator($id);
        if ($remove) {
            setMessage("Succesfully Deleted");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Coordinator</title>
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
    <div class="container m-auto" style="transform: translateY(50px);width:60%">
        <?php displayMessage() ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Remove</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT s.id, s.username, s.email, c.privelege FROM superuser s, coordinator c ";
                $query .= "WHERE s.id = c.id";
                $select_coordinator_query = mysqli_query($con, $query);
                while ($row = mysqli_fetch_array($select_coordinator_query)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td>
                            <form action="#" method="POST">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                        <td>
                            <form action="edit_coordinator.php" target="_blank" method="GET">
                                <input type="hidden" name="edit" value="1">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="name" value="<?php echo $row['username']; ?>">
                                <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                                <button class="btn btn-warning">Edit</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php $_SESSION["messsage"] = " " ?>
    <script src="app.js"></script>
</body>

</html>