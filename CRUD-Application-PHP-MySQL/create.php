<?php
require_once "config.php";

// Initialize variables
$student_name = $email = $phone = $course = $image = "";
$student_name_err = $email_err = $phone_err = $course_err = $image_err = "";

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate student name
    $input_student_name = trim($_POST["student_name"]);
    if (empty($input_student_name)) {
        $student_name_err = "Please enter a student name.";
    } else {
        $student_name = $input_student_name;
    }

    // Validate email
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter an email.";
    } elseif (!filter_var($input_email, FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email address.";
    } else {
        $email = $input_email;
    }

    // Validate phone number
    $input_phone = trim($_POST["phone"]);
    if (empty($input_phone)) {
        $phone_err = "Please enter a phone number.";
    } elseif (!preg_match("/^0[0-9]{10}$/", $input_phone)) {
        $phone_err = "Please enter a valid 11-digit phone number starting with 0.";
    } else {
        $phone = $input_phone;
    }

    // Validate course
    $input_course = trim($_POST["course"]);
    if (empty($input_course)) {
        $course_err = "Please enter a course.";
    } else {
        $course = $input_course;
    }

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_ext = array("jpg", "jpeg", "png", "gif");
        $file_name = $_FILES['image']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        if (in_array($file_ext, $allowed_ext)) {
            $file_name = uniqid() . "." . $file_ext;
            $upload_dir = "uploads/";
            $upload_path = $upload_dir . $file_name;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $image = $file_name;
            } else {
                $image_err = "Failed to upload image.";
            }
        } else {
            $image_err = "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    } else {
        $image_err = "Please select an image to upload.";
    }

    // Insert into database if there are no errors
    if (empty($student_name_err) && empty($email_err) && empty($phone_err) && empty($course_err) && empty($image_err)) {
        $sql = "INSERT INTO students (student_name, email, phone, course, image) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssss", $student_name, $email, $phone, $course, $image);
            if (mysqli_stmt_execute($stmt)) {
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Create New Student</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <!-- Student Name -->
            <div class="mb-3">
                <label for="student_name" class="form-label">Student Name</label>
                <input type="text" name="student_name" id="student_name" class="form-control <?php echo (!empty($student_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $student_name; ?>">
                <div class="invalid-feedback"><?php echo $student_name_err; ?></div>
            </div>
            
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <div class="invalid-feedback"><?php echo $email_err; ?></div>
            </div>
            
            <!-- Phone -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phone; ?>">
                <div class="invalid-feedback"><?php echo $phone_err; ?></div>
            </div>

            <!-- Course -->
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <input type="text" name="course" id="course" class="form-control <?php echo (!empty($course_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $course; ?>">
                <div class="invalid-feedback"><?php echo $course_err; ?></div>
            </div>

            <!-- Image Upload -->
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" name="image" id="image" class="form-control <?php echo (!empty($image_err)) ? 'is-invalid' : ''; ?>">
                <div class="invalid-feedback"><?php echo $image_err; ?></div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>