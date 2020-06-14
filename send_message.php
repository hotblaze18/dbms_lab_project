<?php include_once "./db/connect.php" ?>
<?php
$name = htmlspecialchars($_POST["name"]);
$email = htmlspecialchars($_POST["email"]);
$event = htmlspecialchars($_POST["title"]);
$message = htmlspecialchars($_POST["msg"]);
global $con;
$query = "INSERT INTO messages(name,email,m_text,m_for) values ('{$name}', '{$email}', '{$message}', $event) ";
$insert_query = mysqli_query($con, $query);
if (!$insert_query) {
    echo "Not able to send message.Please try Again";
} else {
    echo "Message Sent succesfully.";
}
