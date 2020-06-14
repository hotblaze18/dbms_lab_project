<?php
if (ifItIsMethod('post')) {
    if (isset($_POST['logout'])) {
        logout('admin');
    }
}
?>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a href="admin.php" class="navbar-brand">Admin Section</a>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item p-2">
            <a href="index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item p-2">
            <form action="#" method="POST" class="mr-3">
                <input style="visibility: hidden;position:absolute;" name="logout">
                <button type="submit" class="btn btn-primary">Logout</button>
            </form>
        </li>
    </ul>
</nav>