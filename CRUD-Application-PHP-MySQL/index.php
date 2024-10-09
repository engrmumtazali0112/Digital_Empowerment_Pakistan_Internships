<?php
require_once "config.php";
session_start();

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Function to reset IDs
function resetIDs($conn) {
    // Fetch all students
    $sql = "SELECT id FROM students ORDER BY id ASC";
    $result = mysqli_query($conn, $sql);
    $newID = 1;

    // Loop through all students and update IDs
    while ($row = mysqli_fetch_assoc($result)) {
        $currentID = $row['id'];
        // Update the ID to the new sequence
        $updateSQL = "UPDATE students SET id = $newID WHERE id = $currentID";
        mysqli_query($conn, $updateSQL);
        $newID++;
    }
}

// Handle deletion
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $deleteID = $_GET['id'];

    // Delete the student
    $deleteSQL = "DELETE FROM students WHERE id = $deleteID";
    mysqli_query($conn, $deleteSQL);
    
    // Reset IDs after deletion
    resetIDs($conn);
    
    header("location: index.php"); // Redirect back to index page
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student CRUD Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css"> <!-- Link to the external CSS file -->
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">Student Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">Add Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Student Management System</h2>
                        <a href="create.php" class="btn btn-primary mb-3">
                            <i class="bi bi-plus-circle me-2"></i>Add New Student
                        </a>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Student Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Course</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM students ORDER BY id ASC"; // Order by id
                                    $result = mysqli_query($conn, $sql);
                                    $index = 1; // Initialize index for display

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $index . "</td>"; // Display sequential ID
                                            echo "<td><img src='uploads/" . htmlspecialchars($row['image']) . "' alt='Student Image' style='width: 50px; height: 50px; object-fit: cover;'></td>";
                                            echo "<td>" . htmlspecialchars($row['student_name']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['course']) . "</td>";
                                            echo "<td>
                                                    <a href='view.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-info btn-sm' title='View'><i class='bi bi-eye'></i></a>
                                                    <a href='edit.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-primary btn-sm' title='Edit'><i class='bi bi-pencil'></i></a>
                                                    <a href='index.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this student?\")' title='Delete'><i class='bi bi-trash'></i></a>
                                                </td>";
                                            echo "</tr>";
                                            $index++; // Increment index
                                        }
                                    } else {
                                        echo "<tr><td colspan='7' class='text-center'>No students found.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
