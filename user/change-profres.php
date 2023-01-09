<?php
session_start();
error_reporting(0);
include('../includes/dbconnection.php');
if (strlen($_SESSION['uid'] == 0)) {
  header('location:logout.php');
} else {
  if (isset($_POST['submit'])) {
    $eid = $_GET['editid'];
    $uid = $_SESSION['uid'];
    $profres = $_FILES["profres"]["name"];

    $extension = substr($profres, strlen($profres) - 4, strlen($profres));
    // allowed extensions
    $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
    // Validation for allowed extensions .in_array() function searches an array for a specific value.
    if (!in_array($extension, $allowed_extensions)) {
      echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    } else {
      // rename user photo
      $profrespic = md5($profres) . $pextension;
      move_uploaded_file($_FILES["profres"]["tmp_name"], "prof_of_res/" . $profrespic);
      $query = mysqli_query($con, "update tbladmapplications set ProfRes='$profrespic' where ID='$eid' && UserId='$uid'");
      if ($query) {
        echo '<script>alert("Profile image updated successfully.")</script>';
      } else {
        echo '<script>alert("Something Went Wrong. Please try again.")</script>';
      }
    }
  }
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="PSU-ACC | Student Registration System" />
    <meta name="author" content="Jaymart Padila" />
    <title>PSU-ACC · Student Registration System</title>

    <!-- title icon -->
    <link rel="icon" href="../assets/img/Pangasinan_State_University_logo.png" type="image/png" />

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- bootstrap cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />

    <!-- Custom styles for this template-->
    <link href="../assets/css/dashboard-styles-min.css" rel="stylesheet" />
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <?php include_once('includes/sidebar.php'); ?>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <?php include_once('includes/header.php'); ?>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Proof of Residence</h1>
            </div>

            <!-- Content Row -->
            <!-- Change Image Form Contents  -->
            <div class="row">
              <form name="submit" method="post" enctype="multipart/form-data" class="php-email-form">
                <?php
                $eid = $_GET['editid'];
                $uid = $_SESSION['uid'];
                $ret = mysqli_query($con, "select * from tbladmapplications where ID='$eid' && UserId='$uid'");
                $cnt = 1;
                while ($row = mysqli_fetch_array($ret)) {

                ?>
                  <section class="formatter" id="formatter">
                    <div class="row">
                      <div class="col-12">
                        <div class="card">
                          <div class="card-header">
                            <h4 class="card-title">Update Proof of Residence</h4>
                          </div>
                          <div class="card-content">
                            <div class="card-body">


                              <div class="row">


                                <div class="col-xl-6 col-lg-12">
                                  <fieldset>
                                    <h5>New Proof of Residence</h5>
                                    <div class="form-group">
                                      <input class="form-control white_bg" id="profres" name="profres" type="file" required="true">
                                    </div>
                                  </fieldset>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-xl-6 col-lg-12">
                                  <fieldset>
                                    <h5>Old Proof of Residence</h5>
                                    <div class="form-group">
                                      <img src="prof_of_res/<?php echo $row['ProfRes']; ?>" width="100" height="100">
                                    </div>
                                  </fieldset>
                                </div>

                              </div>

                              </hr>

                            <?php
                            $cnt = $cnt + 1;
                          } ?>
                            <div class="row" style="margin-top: 2%">
                              <div class="col-xl-6 col-lg-12">
                                <button type="submit" name="submit" class="btn btn-info btn-min-width mr-1 mb-1">Update</button>
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>

                  <!-- Formatter end -->
              </form>
            </div>
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include_once('includes/footer.php'); ?>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include_once('includes/logout-modal.php'); ?>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/chart-area-demo.js"></script>

  </body>

  </html>
<?php } ?>