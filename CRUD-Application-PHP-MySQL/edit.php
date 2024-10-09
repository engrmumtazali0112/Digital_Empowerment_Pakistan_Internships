<?php
require_once "config.php";

$student_name = $email = $phone = $course = $image_path = "";
$student_name_err = $email_err = $phone_err = $course_err = $image_err = "";

// Check if the form is submitted for update
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    
    // Validate inputs
    $input_student_name = trim($_POST["student_name"]);
    if (empty($input_student_name)) {
        $student_name_err = "Please enter a name.";
    } else {
        $student_name = $input_student_name;
    }
    
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter an email.";
    } elseif (!filter_var($input_email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email address.";
    } else {
        $email = $input_email;
    }
    
    $input_phone = trim($_POST["phone"]);
    if (empty($input_phone)) {
        $phone_err = "Please enter the phone number.";     
    } elseif (!preg_match("/^[0-9]{11}$/", $input_phone)) {
        $phone_err = "Please enter a valid 11-digit phone number.";
    } else {
        $phone = $input_phone;
    }

    $input_course = trim($_POST["course"]);
    if (empty($input_course)) {
        $course_err = "Please enter the course.";     
    } else {
        $course = $input_course;
    }

    // Handle image upload
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $image_tmp_name = $_FILES["image"]["tmp_name"];
        $image_name = basename($_FILES["image"]["name"]);
        $upload_dir = __DIR__ . "/uploads/"; // Use absolute path

        // Check if upload directory exists, if not create it
        if (!is_dir($upload_dir)) {
            if (!mkdir($upload_dir, 0755, true) && !is_dir($upload_dir)) {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $upload_dir));
            }
        }

        $image_path = $upload_dir . $image_name;

        // Validate image file type
        $image_file_type = strtolower(pathinfo($image_path, PATHINFO_EXTENSION));
        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($image_file_type, $allowed_types)) {
            $image_err = "Please upload a valid image file (JPG, JPEG, PNG, GIF).";
        } else {
            // Move the uploaded file to the target directory
            if (!move_uploaded_file($image_tmp_name, $image_path)) {
                $image_err = "Failed to upload image.";
            }
        }
    } else {
        // Use existing image if no new image uploaded
        $image_path = trim($_POST["existing_image"]);
    }

    // Check for errors before updating the database
    if (empty($student_name_err) && empty($email_err) && empty($phone_err) && empty($course_err) && empty($image_err)) {
        $sql = "UPDATE students SET student_name=?, email=?, phone=?, course=?, image=? WHERE id=?"; // Ensure column name matches your DB

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssi", $param_student_name, $param_email, $param_phone, $param_course, $param_image_path, $param_id);
            
            // Set parameters
            $param_student_name = $student_name;
            $param_email = $email;
            $param_phone = $phone;
            $param_course = $course;
            $param_image_path = $image_path; // Use new or existing image path
            $param_id = $id;
            
            // Execute statement
            if (mysqli_stmt_execute($stmt)) {
                header("location: index.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($conn);
} else {
    // Fetch existing student data
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);
        
        $sql = "SELECT * FROM students WHERE id = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            $param_id = $id;
            
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
    
                if (mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    $student_name = $row["student_name"];
                    $email = $row["email"];
                    $phone = $row["phone"];
                    $course = $row["course"];
                    $image_path = $row["image"]; // Ensure this matches your DB column name
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Record</title>
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
        <h2>Update Student Record</h2>
        <p>Please edit the input values and submit to update the student record.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="student_name" class="form-label">Name</label>
                <input type="text" name="student_name" id="student_name" class="form-control <?php echo (!empty($student_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($student_name); ?>">
                <div class="invalid-feedback"><?php echo $student_name_err;?></div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($email); ?>">
                <div class="invalid-feedback"><?php echo $email_err;?></div>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($phone); ?>">
                <div class="invalid-feedback"><?php echo $phone_err;?></div>
            </div>
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" name="course" id="course" class="form-control <?php echo (!empty($course_err)) ? 'is-invalid' : ''; ?>" value="<?php echo htmlspecialchars($course); ?>">
                <div class="invalid-feedback"><?php echo $course_err;?></div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Profile Image</label>
                <input type="file" name="image" id="image" class="form-control <?php echo (!empty($image_err)) ? 'is-invalid' : ''; ?>">
                <div class="invalid-feedback"><?php echo $image_err;?></div>
                <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($image_path); ?>"> <!-- Store existing image path -->
                <?php if ($image_path): ?>
                    <img src="<?php echo htmlspecialchars($image_path); ?>" alt="Current Image" style="width: 100px; margin-top: 10px;">
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>"/>
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
