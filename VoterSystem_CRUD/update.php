<?php
// Include the database connection file
include('connection.php');

// Check if the form has been submitted
if (isset($_POST['updateData'])) {

    // Get the ID and updated data from the form
    $updateId = $_POST['updateId'];
    $updateFullname = mysqli_real_escape_string($conn, $_POST['updateFullname']);
    $updateEmail = mysqli_real_escape_string($conn, $_POST['updateEmail']);
    $updatePhoneNumber = mysqli_real_escape_string($conn, $_POST['updatePhoneNumber']);
    $updateUsername = mysqli_real_escape_string($conn, $_POST['updateUsername']);
    $updatePassword = $_POST['updatePassword']; // Password is optional; will only be updated if provided

    // If the password field is not empty, hash the new password
    if (!empty($updatePassword)) {
        $updatePasswordHash = password_hash($updatePassword, PASSWORD_BCRYPT);
    } else {
        // If no password is provided, keep the existing password (do not update it)
        $updatePasswordHash = null;
    }

    // Prepare the SQL query to update the record
    if ($updatePasswordHash) {
        // If a new password is provided, include it in the update query
        $sql = "UPDATE tbl_user SET fullname=?, email=?, phone_number=?, username=?, password_hash=? WHERE id=?";
    } else {
        // If no new password is provided, exclude the password field from the update query
        $sql = "UPDATE tbl_user SET fullname=?, email=?, phone_number=?, username=? WHERE id=?";
    }

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {

        // If password is provided, bind it to the statement
        if ($updatePasswordHash) {
            $stmt->bind_param("sssssi", $updateFullname, $updateEmail, $updatePhoneNumber, $updateUsername, $updatePasswordHash, $updateId);
        } else {
            // Otherwise, bind the values excluding the password
            $stmt->bind_param("ssssi", $updateFullname, $updateEmail, $updatePhoneNumber, $updateUsername, $updateId);
        }

        // Execute the update query
        if ($stmt->execute()) {
            // Successfully updated the record
            echo "<script>
                    alert('Record updated successfully!');
                    window.location.href = 'index.php'; // Redirect back to the main page
                  </script>";
        } else {
            // Error executing the update query
            echo "<script>
                    alert('Error updating record. Please try again.');
                    window.location.href = 'index.php'; // Redirect back to the main page
                  </script>";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Error preparing the update query
        echo "<script>
                alert('Error preparing the update query.');
                window.location.href = 'index.php'; // Redirect back to the main page
              </script>";
    }
}

// Close the database connection
$conn->close();
?>
