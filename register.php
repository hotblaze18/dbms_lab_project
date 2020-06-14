<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db/connect.php";
include "functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
include "cssjs/css.php";
?>

<?php
if (ifItIsMethod('get')) {
  if (isset($_GET))
    $re_id = $_GET['re_id'];
}
?>

<?php
if (ifItIsMethod('post')) {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $registered_for = $_POST["title"];
  $register = register_participent($name, $email, $phone, $registered_for);
  if ($register) {
    setMessage("You Have Sucessfully Registered");
  }
}
?>

<body>
  <style>
    body {
      background: #f3f3f3;
    }

    .field-border {
      border-radius: 20px;

    }
  </style>

  <h1 class="display-3 text-danger text-center mt-4">Register Now</h1>
  <section class="ftco-section contact-section ftco-degree-bg">
    <div class="container">
      <div class="col-md-8" id="signup_msg">
        <?php displayMessage() ?>
        <!--Alert from signup form-->
      </div>
      <div class="row block-9">
        <div class="col-md-6 pr-md-5">
          <form id="signup_form" method="POST" action="#" class="was-validated">
            <div class="form-group">
              <input type="text " name="name" class="form-control field-border" placeholder="Your Name" required>
            </div>
            <div class="form-group">
              <input type="text" name="email" class="form-control field-border" placeholder="Your Email" required>
            </div>
            <div class="form-group">
              <input type="text" name="phone" class="form-control field-border" placeholder="phone" required>
            </div>
            <div class="form-group">
              <label for="inlineFormCustomSelect">Choose Event</label>
              <select name="title" class="custom-select mr-lg-2  field-border" id="inlineFormCustomSelect" required>
                <?php
                $query = "SELECT event_id, event_title FROM events ";
                $select_events_query = mysqli_query($con, $query);
                if (!$select_events_query) {
                  echo mysqli_error($con);
                  setMessage(mysqli_error($con));
                } else {
                  while ($row = mysqli_fetch_array($select_events_query)) { ?>
                    <?php if (isset($re_id) && $re_id == $row["event_id"]) { ?>
                      <option value="<?php echo $row["event_id"] ?>" selected> <?php echo $row["event_title"] ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $row["event_id"] ?>"> <?php echo $row["event_title"] ?></option>
                <?php }
                  }
                } ?>
              </select>
            </div>
            <button type="submit" class="btn btn-outline-success btn-lg mt-3 rounded-50">Register</button>
          </form>

        </div>

        <div class="col-md-6" id="map"></div>
      </div>
    </div>
  </section>





  <?php
  include "includes/footer.php";
  setMessage(" ");
  ?>
  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>

  <?php
  include "cssjs/js.php";
  ?>
</body>

</html>