<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if (strlen($_SESSION['adminID']) == 0) {
  header('location:index.php');
} else {
  // Code for Update  driver Details
  if (isset($_POST['update'])) {



    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $grade = $_POST['grade'];
    $schoolName = $_POST['schoolName'];

    $querySchoolID = mysqli_query($con, "SELECT schoolID FROM school WHERE schoolName = '$schoolName'");

    // Check if query executed successfully
    if ($querySchoolID) {
      // Fetch the result row
      $row = mysqli_fetch_assoc($querySchoolID);

      // Check if a row was found
      if ($row) {
        // Retrieve the schoolID
        $schoolID = $row['schoolID'];
      }
    }

    $childID = intval($_GET['said']);

    $query = mysqli_query($con, "update child set childName='$fullname', childDOB='$dob', childGrade = '$grade', schoolID = '$schoolID' where childID = '$childID'");
    if ($query) {
      echo "<script>alert('Child details edited successfully.');</script>";
      echo "<script type='text/javascript'> document.location = 'childManage.php'; </script>";
    } else {
      echo "<script>alert('Something went wron. Please try again.');</script>";
    }
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon/favicon-16x16.png">
    <title>CommuteGuard | School Bus Management System</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!--Function Email Availabilty---->


  </head>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <!-- Navbar -->
      <?php include_once("includes/navbar.php"); ?>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <?php include_once("includes/sidebar.php"); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Edit Child Details</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Child Details</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        <?php
        $said = intval($_GET['said']);
        $query = mysqli_query($con, "SELECT c.*, u.userName FROM child c JOIN user u ON c.userID = u.UserID where childID = '$said'");
        $cnt = 1;
        while ($result = mysqli_fetch_array($query)) {
          ?>
          <!-- Main content -->
          <section class="content">
            <div class="container-fluid">
              <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                  <!-- general form elements -->
                  <div class="card card-primary">
                    <div class="card-header">
                      <h3 class="card-title">Update the Info</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form name="user" method="post">
                      <div class="card-body">
                        <!-- Username-->

                        <div class="form-group">
                          <label for="exampleInputFullname">Parent Name</label>
                          <input type="text" class="form-control" id="parentName" name="parentName"
                            placeholder="Enter User Full Name" value="<?php echo $result['userName']; ?>" readonly>
                        </div>

                        <div class="form-group">
                          <label for="exampleInputFullname">Child Full Name</label>
                          <input type="text" class="form-control" id="fullname" name="fullname"
                            placeholder="Enter User Full Name" value="<?php echo $result['childName']; ?>">
                        </div>
                        <!-- Sub user Email---->
                        <div class="form-group">
                          <label for="text">Date of Birth</label>
                          <input type="date" class="form-control" id="dob" name="dob" placeholder="Enter Date of Birth"
                            value="<?php echo $result['childDOB']; ?>">
                        </div>

                        <div class="form-group">
                          <label for="text">Grade</label>
                          <input type="text" class="form-control" id="grade" name="grade" placeholder="Enter Grade"
                            value="<?php echo $result['childGrade']; ?>">
                        </div>


                        <div class="form-group">
                          <label for="text">School Name</label>
                          <select class="form-control" id="schoolName" name="schoolName">
                            <?php
                            $querySchool = mysqli_query($con, "SELECT * FROM school");
                            while ($rowSchool = mysqli_fetch_array($querySchool)) {
                              if ($rowSchool['schoolName'] == $result['schoolName']) {
                                echo "<option value='" . $rowSchool['schoolName'] . "' selected>" . $rowSchool['schoolName'] . "</option>";
                              } else {
                                echo "<option value='" . $rowSchool['schoolName'] . "'>" . $rowSchool['schoolName'] . "</option>";
                              }
                            }
                            ?>
                          </select>
                        </div>







                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="update" id="update">Update</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.card -->



                </div>
                <!--/.col (left) -->

              </div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include_once('includes/footer.php'); ?>

      </div>
      <!-- ./wrapper -->

      <!-- jQuery -->
      <script src="../plugins/jquery/jquery.min.js"></script>
      <!-- Bootstrap 4 -->
      <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- bs-custom-file-input -->
      <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
      <!-- AdminLTE App -->
      <script src="../dist/js/adminlte.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="../dist/js/demo.js"></script>
      <!-- Page specific script -->
      <script>
        $(function () {
          bsCustomFileInput.init();
        });
      </script>
    </body>

    </html>
  <?php }
} ?>