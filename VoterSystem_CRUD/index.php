<?php
  include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Voting System</title>

  <link rel="stylesheet" href="css/styles.css">
  <!-- Add Bootstrap CSS for responsive design -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>

  <!-- Navigation -->
  <nav>
    <div>
      <a href="" target="_blank">VOTING SYSTEM</a>
    </div>
  </nav>
  <br><br><br>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div>
          <h1 class="text-center">VOTERS LIST</h1>
          <hr>
          <div>
            <a href="#" class="add-new-button" data-toggle="modal" data-target="#addModal">
              Add New Voter
            </a>
          </div>

          <br><br><br>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Full Name</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Username</th>
                  <th>Registration Date</th>
                  <th>View</th>
                  <th>Update</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM tbl_user";
                $result = mysqli_query($conn, $sql);

                if($result) {
                  while($row = mysqli_fetch_assoc($result)) {
                ?>
                  <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['fullname']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone_number']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['registration_date']; ?></td>
                    <td>
                      <button type="button" class="viewBtn">View</button>
                    </td>
                    <td>
                      <button type="button" class="updateBtn">Update</button>
                    </td>
                    <td>
                      <button type="button" class="deleteBtn">Delete</button>
                    </td>
                  </tr>
                <?php
                  }
              } else {
                echo "<script> alert('No Voter Found');</script>";
              }
              ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>
    </div>
  </div>
      <!-- MODALS -->

      <!-- ADD RECORD MODAL -->
      <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title">Add New Voter</h5>
              <button class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="insert.php" method="POST">
                <div class="form-group">
                  <label for="fullname">Full Name</label>
                  <input type="text" name="fullname" class="form-control" placeholder="Enter full name" maxlength="100" required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Enter email" maxlength="100" required>
                </div>
                <div class="form-group">
                  <label for="phone_number">Phone Number</label>
                  <input type="text" name="phone_number" class="form-control" placeholder="Enter phone number" maxlength="20" required>
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" class="form-control" placeholder="Enter username" maxlength="50" required>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" name="insertData">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- VIEW MODAL -->
      <div class="modal fade" id="viewModal">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header bg-info text-white">
              <h5 class="modal-title">View Voter Information</h5>
              <button class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-5 col-xs-6 tital "><strong>Full Name:</strong></div>
                <div class="col-sm-7 col-xs-6 "><div id="viewFullname"></div></div>
                <div class="col-sm-5 col-xs-6 tital "><strong>Email:</strong></div>
                <div class="col-sm-7 col-xs-6 "><div id="viewEmail"></div></div>
                <div class="col-sm-5 col-xs-6 tital "><strong>Phone Number:</strong></div>
                <div class="col-sm-7 col-xs-6 "><div id="viewPhoneNumber"></div></div>
                <div class="col-sm-5 col-xs-6 tital "><strong>Username:</strong></div>
                <div class="col-sm-7 col-xs-6 "><div id="viewUsername"></div></div>
                <div class="col-sm-5 col-xs-6 tital "><strong>Registration Date:</strong></div>
                <div class="col-sm-7 col-xs-6 "><div id="viewRegistrationDate"></div></div>
              </div>
              <br>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    <!-- UPDATE MODAL -->
    <div class="modal fade" id="updateModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Update Voter Information</h5>
                    <button class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="update.php" method="POST">
                        <input type="hidden" name="updateId" id="updateId"> <!-- Hidden field for User ID -->

                        <div class="form-group">
                            <label for="updateFullname">Full Name</label>
                            <input type="text" name="updateFullname" id="updateFullname" class="form-control" placeholder="Enter full name" maxlength="100" required>
                        </div>

                        <div class="form-group">
                            <label for="updateEmail">Email</label>
                            <input type="email" name="updateEmail" id="updateEmail" class="form-control" placeholder="Enter email" maxlength="100" required>
                        </div>

                        <div class="form-group">
                            <label for="updatePhoneNumber">Phone Number</label>
                            <input type="text" name="updatePhoneNumber" id="updatePhoneNumber" class="form-control" placeholder="Enter phone number" maxlength="20" required>
                        </div>

                        <div class="form-group">
                            <label for="updateUsername">Username</label>
                            <input type="text" name="updateUsername" id="updateUsername" class="form-control" placeholder="Enter username" maxlength="50" required>
                        </div>

                        <div class="form-group">
                            <label for="updatePassword">Password</label>
                            <input type="password" name="updatePassword" id="updatePassword" class="form-control" placeholder="Enter new password (Leave empty to keep unchanged)">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-warning" name="updateData">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- DELETE MODAL -->
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="delete.php" method="POST">

                    <div class="modal-body">
                        <!-- Hidden field for the ID of the record to be deleted -->
                        <input type="hidden" name="deleteId" id="deleteId">
                        <h4>Are you sure you want to delete this voter?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger" name="deleteData">Yes, Delete</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

  <!-- jQuery, Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

  <script>
      $(document).ready(function () {
        // Handle the update button click event
        $(".updateBtn").click(function () {
            var id = $(this).closest("tr").find("td:eq(0)").text(); // Get User ID from the first column
            var fullname = $(this).closest("tr").find("td:eq(1)").text(); // Get Full Name from the second column
            var email = $(this).closest("tr").find("td:eq(2)").text(); // Get Email from the third column
            var phone_number = $(this).closest("tr").find("td:eq(3)").text(); // Get Phone Number
            var username = $(this).closest("tr").find("td:eq(4)").text(); // Get Username
            var password_hash = $(this).closest("tr").find("td:eq(5)").text(); // Get Password Hash

            // Set the values in the update modal fields
            $("#updateId").val(id);
            $("#updateFullname").val(fullname);
            $("#updateEmail").val(email);
            $("#updatePhoneNumber").val(phone_number);
            $("#updateUsername").val(username);
            $("#updatePassword").val(""); // Clear the password field for security

            // Open the update modal
            $("#updateModal").modal("show");
        });
      });
    </script>

    <script>
        $(document).ready(function () {
          // Handle the view button click event
          $(".viewBtn").click(function () {
            var $tr = $(this).closest("tr"); // Get the closest table row

            var data = $tr.children("td").map(function () {
              return $(this).text(); // Get the data from each column of the row
            }).get();

            // Populate the modal with the record data
            $("#viewFullname").text(data[1]);  // Full Name
            $("#viewEmail").text(data[2]);     // Email
            $("#viewPhoneNumber").text(data[3]); // Phone Number
            $("#viewUsername").text(data[4]);  // Username
            $("#viewRegistrationDate").text(data[5]); // Registration Date

            // Show the view modal
            $("#viewModal").modal("show");
          });
        });
    </script>

    <script>
      $(document).ready(function () {
        // Handle the delete button click event
        $(".deleteBtn").click(function () {
            var id = $(this).closest("tr").find("td:eq(0)").text(); // Get User ID from the first column
            // Set the ID of the user to the hidden field in the delete modal
            $("#deleteId").val(id);

            // Open the delete modal
            $("#deleteModal").modal("show");
        });
      });
    </script>

      
    </body>

    </html>