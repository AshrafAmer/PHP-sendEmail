<?php

    // User msgs
    $msg = '';
    $msgClass = '';
    // Check submittion
    if (filter_has_var(INPUT_POST, 'submit')) {
      # Handle with the data
      // get form data
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);
      $message = htmlspecialchars($_POST['message']);

      // Check Required Fields
      if (!empty($name) && !empty($email) && !empty($message)) {
        # passed successfully
        // Check Email Validation
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
          # Failed
          $msg = 'Please Fill a valid email';
          $msgClass = 'alert-danger';
        } else {
          # passed successfully
          $toEmail = 'ashraf.amer55@gmail.com';
          $subject = 'Contact Request From ' . $name;
          $body = '<h2> Contact Request <h2>';
          $body .= '<h4> Name </h4> <p>' . $name . '</p>';
          $body .= '<h4> email </h4> <p>' . $email . '</p>';
          $body .= '<h4> Message </h4> <p>' . $message . '</p>';
          // email headers
          $headers = "MIME-Version: 1.0" . "\r\n";
          $headers .= "Content-Type:text/html;charset=UTF-8" . "\r\n";
          // Additional Headers
          $headers .= " From: " . $name . "<" . $email . "> \r\n";
          if (mail($toEmail, $subject, $body, $headers)) {
            # email sent successfully
            $msg = 'your email has been sent';
            $msgClass = 'alert-success';
          }else {
            # Faild
            $msg = 'your email was NOT sent';
            $msgClass = 'alert-danger';
          }
        }
      } else {
        # Faild...
        $msg = 'Please Fill all fields';
        $msgClass = 'alert-danger';
      }
    }

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP FORM - Contact Us</title>
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
    integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
    crossorigin="anonymous">
  </head>
  <body>

    <nav class="navbar navbar-dark bg-dark">
      <div class="container">
        <a class="bavbra-brand" href="index.php"> My PHP Form </a>
      </div>
    </nav>

    <div class="container">
      <?php if( $msg != ''): ?>
        <div class="alert <?= $msgClass; ?>">
          <?= $msg; ?>
        </div>
      <?php endif; ?>
      <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">

        <div class="form-group">
          <label> Name </label>
          <input type="text" name="name" class="form-control"
          value="<?= isset($_POST['name']) ? $name : ''; ?>">
        </div>

        <div class="form-group">
          <label> e-mail </label>
          <input type="text" name="email" class="form-control"
          value="<?= isset($_POST['email']) ? $email : ''; ?>">
        </div>

        <div class="form-group">
          <label> message </label>
          <textarea name="message" class="form-control"><?= isset($_POST['message']) ? $message : ''; ?></textarea>
        </div>

        <div>
          <br>
          <button type="submit" name="submit" class="btn btn-primary"> Submit </button>
        </div>
      </form>
    </div>




    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
    integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
    crossorigin="anonymous"></script>
    <!--
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
    integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
    crossorigin="anonymous"></script>
    -->
  </body>
</html>
