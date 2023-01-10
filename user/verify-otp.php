<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');

if (isset($_POST['submit'])) {
  // collect session data
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $contno = $_SESSION['contno'];
  $email = $_SESSION['email'];
  $password = $_SESSION['password'];

  // OTP's to compare
  $otp = $_SESSION['otp'];
  $otp_code = $_POST['otp_code'];

  // if otp did match -> save to db
  if ($otp != $otp_code) {
?>
    <script>
      alert("Invalid OTP code");
      window.location.replace("verify-otp.php");
    </script>
    <?php
  } else {
    // save session data to the db
    $query = mysqli_query($con, "insert into tbluser(FirstName, LastName,MobileNumber, Email, Password) value('$fname', '$lname','$contno', '$email', '$password' )");
    // if successful, proceed | otherwise, alert an error
    if ($query) {
    ?>
      <script>
        alert("Verfiy account done, you may sign in now");
        window.location.replace("login.php");
      </script>
    <?php
    } else {
      echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
    ?>
<?php
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta name="description" content="PSU-ACC | Student Registration System | Sign up page" />
  <meta name="author" content="Jaymart Padilla" />
  <title>PSU-ACC · Sign up</title>

  <!-- title icon -->
  <link rel="icon" href="../assets/img/Pangasinan_State_University_logo.png" />

  <!-- bootstrap css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

  <!-- Custom styles -->

  <link href="../assets/css/style.css" rel="stylesheet" />

  <style>
    body {
      height: 100vh;
      display: flex;
      align-items: center;
    }

    .form-signin {
      max-width: 340px;
      padding: 15px;
    }
  </style>

</head>

<body class="text-center">
  <main class="form-signin w-100 m-auto">
    <form method="post" name="signup" onSubmit="return checkpass();">
      <a href="../index.php"><img class="mb-3" src="../assets/img/Pangasinan_State_University_logo.png" alt="" width="72" height="72" /></a>
      <h1 class="h3 mb-3 fw-normal">Verify Your Email</h1>

      <!-- enter otp -->
      <div class="mb-3">
        <label for="otp" class="form-label fw-bold">Enter OTP: </label>
        <input type="otp" class="form-control" id="otp" name="otp_code" />
      </div>

      <!-- verify -->
      <button type="submit" name="submit" class="w-100 btn btn-lg" id="btn-get-started">
        Submit
      </button>
    </form>
  </main>
</body>

</html>