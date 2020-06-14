<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db/connect.php";
include "./functions.php";
?>


<!DOCTYPE html>
<html lang="en">


<?php

include "cssjs/css.php";

include "includes/body.php";

include "includes/footer.php";
?>



<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" /></svg></div>


<?php
include "./cssjs/js.php";
?>
<script>
    const myForm = document.getElementById("message_form");
    console.log(myForm);
    $(myForm).submit(function(event) {
        console.log(myForm);
        event.preventDefault();

        /* Serialize the submitted form control values to be sent to the web server with the request */
        var formValues = $(this).serialize();

        // Send the form data using post
        $.post("send_message.php", formValues, function(data) {
            // Display the returned data in browser
            document.getElementById("message_text").textContent = data;
            alert(data);
        });
    });
</script>
</body>

</html>