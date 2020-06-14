<?php

function redirect($location)
{


    header("Location:" . $location);
    exit;
}


function ifItIsMethod($method = null)
{

    if ($_SERVER['REQUEST_METHOD'] == strtoupper($method)) {

        return true;
    }

    return false;
}

function isLoggedInAsAdmin()
{

    if (isset($_SESSION["admin"])) {
        if ($_SESSION['admin']) {
            return true;
        }
    }
    return false;
}

function isLoggedInAsCoordinator()
{
    if ($_SESSION['coordinator']) {
        return true;
    }


    return false;
}

function escape($string)
{

    global $con;

    return mysqli_real_escape_string($con, trim($string));
}



function display_message()
{

    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

function login_admin($username, $password)
{

    global $con;

    $username = trim($username);
    $password = trim($password);

    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    $query = "SELECT * FROM superuser WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($con, $query);
    if (!$select_user_query) {
        die("QUERY FAILED" . mysqli_error($con));
    }
    while ($row = mysqli_fetch_array($select_user_query)) {
        $db_user_id = $row['id'];
        $db_username = $row['username'];
        $db_user_password = $row['password'];

        if ($db_user_password == $password) {
            $_SESSION['username'] = $db_username;
            $_SESSION['user_id'] = $db_user_id;
        } else {
            return false;
        }
        $query = "SELECT * FROM admin WHERE id = $db_user_id";
        $admin = mysqli_query($con, $query);

        if (mysqli_num_rows($admin) > 0) {
            $_SESSION['admin'] = true;
            setMessage("Successfully Logged in as Admin");
            redirect("admin.php");
        } else {
            $_SESSION['admin'] = false;
            return false;
        }
    }

    return true;
}


function logout($type)
{
    if ($type == "admin") {
        $_SESSION['admin'] = false;
        setMessage("You are now logged out");
        redirect('index.php');
    } else {
        $_SESSION['coordinator'] = false;
        setMessage("You are now logged out");
        redirect('index.php');
    }
}

function setMessage($message)
{
    $_SESSION["message"] = $message;
}

function displayMessage()
{
    echo '<p id="message" class="text-center">' . $_SESSION['message'] . '</p>';
}

function add_coordinator($username, $email, $password, $privelege)
{
    global $con;

    $username = trim($username);
    $password = trim($password);
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    $query = "SELECT * FROM superuser WHERE username='{$username}' AND email='{$email}'";
    $select_query  = mysqli_query($con, $query);
    if (mysqli_num_rows($select_query) > 0) {
        setMessage("Usename or email is not unique");
        return false;
    }

    $query = "INSERT INTO superuser(username, email, password) values ('{$username}', '{$email}', '{$password}')";
    $insert_user_query = mysqli_query($con, $query);

    if (!$insert_user_query) {
        setMessage(mysqli_error($con));
        return false;
    }

    $query = "SELECT id FROM superuser WHERE username = '{$username}'";
    $id_query = mysqli_query($con, $query);

    if (!$id_query) {
        setMessage(mysqli_error($con));
        return false;
    }
    while ($row = mysqli_fetch_array($id_query)) {
        $id = $row[0];
    }
    $query = "INSERT INTO coordinator values($id, $privelege)";
    $c_query =   mysqli_query($con, $query);
    if (!$c_query) {
        setMessage(mysqli_error($con));
        return false;
    }
    return true;
}

function remove_coordinator($id)
{
    global $con;
    $query = "DELETE FROM superuser WHERE id = $id";
    $delete_query = mysqli_query($con, $query);
    if (!$delete_query) {
        setMessage('Not able to delete please try again.');
        return false;
    } else {
        return true;
    }
}

function add_event($title, $price, $type, $img, $managed_by)
{
    global $con;

    $title = trim($title);
    $price = trim($price);
    $title = mysqli_real_escape_string($con, $title);
    $price = mysqli_real_escape_string($con, $price);

    $query = "SELECT id FROM superuser WHERE username = '{$managed_by}'";
    $m_query = mysqli_query($con, $query);
    if (!$m_query) {
        setMessage("Could not insert." . mysqli_error($con));
        return 0;
    }
    $row = mysqli_fetch_row($m_query);
    $m_id = $row[0];


    $query = "SELECT type_id FROM event_type WHERE type_title = '{$type}'";
    $t_query = mysqli_query($con, $query);
    if (!$t_query) {
        setMessage("Could not insert." . mysqli_error($con));
        return 0;
    }
    $row = mysqli_fetch_row($t_query);
    $t_id = $row[0];

    $query = "INSERT INTO events(event_title, event_price,img_link,type_id,managed_by) values ('{$title}', $price, '{$img}', $t_id, $m_id)";
    $insert_event = mysqli_query($con, $query);

    if (!$insert_event) {
        setMessage(mysqli_error($con));
    } else {
        setMessage("Succesfully Added the event");
    }
}

function remove_event($id)
{
    global $con;
    $query = "DELETE FROM events WHERE event_id = $id";
    $delete_query = mysqli_query($con, $query);
    if (!$delete_query) {
        setMessage('Not able to delete please try again.' . mysqli_error($con));
        return false;
    } else {
        return true;
    }
}

function add_event_type($type)
{
    global $con;

    $query = "INSERT INTO event_type(type_title) VALUE ('{$type}') ";
    $insert_query = mysqli_query($con, $query);
    if (!$insert_query) {
        setMessage(mysqli_error($con));
        return 0;
    }
    return true;
}

function remove_event_type($id)
{
    global $con;
    $query = "DELETE FROM event_type WHERE type_id = $id";
    $delete_query = mysqli_query($con, $query);
    if (!$delete_query) {
        setMessage('Not able to delete please try again.' . mysqli_error($con));
        return false;
    } else {
        return true;
    }
}

function update_event_type($id, $type)
{
    global $con;
    $query = "UPDATE event_type SET type_title='{$type}' WHERE type_id=$id ";
    $edit_query = mysqli_query($con, $query);
    if (!$edit_query) {
        setMessage(mysqli_error($con));
        return false;
    }
    return true;
}

function register_participent($name, $email, $phone, $registered_for)
{

    global $con;
    $query = "INSERT INTO participent(fullname,email,mobile,registerd_for) values('{$name}', '{$email}', '{$phone}', $registered_for) ";
    $insert_query = mysqli_query($con, $query);
    if (!$insert_query) {
        setMessage(mysqli_error($con));
        return false;
    }
    return true;
}

function login_coordinator($username, $password)
{

    global $con;

    $username = trim($username);
    $password = trim($password);

    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    $query = "SELECT * FROM superuser WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($con, $query);
    if (!$select_user_query) {
        die("QUERY FAILED" . mysqli_error($con));
    }
    while ($row = mysqli_fetch_array($select_user_query)) {
        $db_user_id = $row['id'];
        $db_username = $row['username'];
        $db_user_password = $row['password'];

        if ($db_user_password == $password) {
            $_SESSION['username'] = $db_username;
            $_SESSION['user_id'] = $db_user_id;
        } else {
            return false;
        }
        $query = "SELECT * FROM coordinator WHERE id = $db_user_id";
        $coordinator = mysqli_query($con, $query);

        if (mysqli_num_rows($coordinator) > 0) {
            $_SESSION['coordinator'] = true;
            setMessage("Successfully Logged in as Coordinator");
            redirect("coordinator.php");
        } else {
            $_SESSION['coordinator'] = false;
            return false;
        }
    }

    return true;
}

function remove_participent($id)
{
    global $con;
    $query = "DELETE FROM participent WHERE user_id=$id";
    $delete_query = mysqli_query($con, $query);
    if (!$delete_query) {
        setMessage(mysqli_error($con));
        return 0;
    }
    return true;
}

function update_participent($id, $name, $email, $mobile)
{
    global $con;
    $query = "UPDATE participent SET fullname='{$name}', email='{$email}', mobile='{$mobile}' ";
    $query .= "WHERE user_id = $id";
    $update_query = mysqli_query($con, $query);
    if (!$update_query) {
        setMessage(mysqli_error($con));
        return false;
    }
    return true;
}

function update_event($id, $title, $price)
{
    global $con;
    $query = "UPDATE events SET event_title='{$title}', event_price=$price WHERE event_id=$id ";
    $edit_query = mysqli_query($con, $query);
    if (!$edit_query) {
        setMessage(mysqli_error($con));
        return false;
    }
    return true;
}

function update_coordinator($id, $name, $email)
{
    global $con;

    $query = "SELECT * FROM superuser WHERE username='{$name}' AND email='{$email}'";
    $select_query  = mysqli_query($con, $query);
    if (mysqli_num_rows($select_query) > 0) {
        setMessage("Usename or email is not unique");
        return false;
    }
    $query = "UPDATE superuser SET username='{$name}', email='{$email}' WHERE id=$id ";
    $edit_query = mysqli_query($con, $query);
    if (!$edit_query) {
        setMessage(mysqli_error($con));
        return false;
    }
    return true;
}
