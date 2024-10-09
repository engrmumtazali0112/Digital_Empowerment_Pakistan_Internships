<?php
require_once "config.php";

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    $sql = "SELECT * FROM students WHERE id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_GET["id"]);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $student_name = $row["student_name"];
                $email = $row["email"];
                $phone = $row["phone"];
                $course = $row["course"];
                $image = $row["image"]; // Get the image path
            } else {
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>View Student</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($student_name); ?></h5>
                <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                <p class="card-text"><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
                <p class="card-text"><strong>Course:</strong> <?php echo htmlspecialchars($course); ?></p>
                
                <?php if (!empty($image)): ?>
                    <img src="uploads/<?php echo htmlspecialchars($image); ?>" alt="Student Image" style="width: 150px; height: auto;">
                <?php else: ?>
                    <p>No image available.</p>
                <?php endif; ?>
            </div>
        </div>
        <a href="index.php" class="btn btn-primary mt-3">Back to List</a>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
