<?php
// Include the database connection file
include('connection.php');

// Check if the form is submitted and deleteId is set
if (isset($_POST['deleteData']) && isset($_POST['deleteId'])) {

    // Sanitize and validate the input ID
    $deleteId = intval($_POST['deleteId']); // Convert to integer to prevent SQL injection

    if ($deleteId > 0) {
        // Prepare the DELETE query
        $sql = "DELETE FROM tbl_user WHERE id = ?";
        
        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameter (the ID to be deleted)
            $stmt->bind_param("i", $deleteId);

            // Execute the query
            if ($stmt->execute()) {
                // Successfully deleted the record
                echo "<script>
                    alert('Record deleted successfully!');
                    window.location.href = 'index.php'; // Redirect to the index page
                </script>";
            } else {
                // Error executing the query
                echo "<script>
                    alert('Error deleting record. Please try again.');
                    window.location.href = 'index.php'; // Redirect to the index page
                </script>";
            }

            // Close the statement
            $stmt->close();
        } else {
            // Error preparing the query
            echo "<script>
                alert('Error preparing the delete query.');
                window.location.href = 'index.php'; // Redirect to the index page
            </script>";
        }
    } else {
        // Invalid ID
        echo "<script>
            alert('Invalid ID.');
            window.location.href = 'index.php'; // Redirect to the index page
        </script>";
    }
} else {
    // If deleteData or deleteId is not set, redirect to the index page
    header('Location: index.php');
    exit;
}

// Close the database connection
$conn->close();
?>
