<?php
// Include the database connection file
include('connection.php');

// Check if the form has been submitted
if (isset($_POST['insertData'])) {

    // Sanitize and retrieve form input values
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Validate the data (You can add more validation checks as needed)
    if (empty($fullname) || empty($email) || empty($phone_number) || empty($username) || empty($password)) {
        echo "<script>
                alert('All fields are required!');
                window.location.href = 'index.php'; // Redirect back to the main page
              </script>";
        exit;
    }

    // Hash the password using bcrypt
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Prepare the INSERT query to add the data into the database
    $sql = "INSERT INTO tbl_user (fullname, email, phone_number, username, password_hash, registration_date) 
            VALUES (?, ?, ?, ?, ?, NOW())";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the prepared statement
        $stmt->bind_param("sssss", $fullname, $email, $phone_number, $username, $password_hash);

        // Execute the query
        if ($stmt->execute()) {
            // Successfully inserted the record
            echo "<script>
                    alert('New record added successfully!');
                    window.location.href = 'index.php'; // Redirect to the main page
                  </script>";
        } else {
            // Error executing the query
            echo "<script>
                    alert('Error inserting record. Please try again.');
                    window.location.href = 'index.php'; // Redirect to the main page
                  </script>";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Error preparing the query
        echo "<script>
                alert('Error preparing the insert query.');
                window.location.href = 'index.php'; // Redirect to the main page
              </script>";
    }
}

// Close the database connection
$conn->close();
?>
