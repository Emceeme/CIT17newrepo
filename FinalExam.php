<!DOCTYPE html>
<html>
<head>
    <title>CRUD Operations</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Edit button click event
            $('.edit-btn').click(function() {
                var form = $(this).closest('form');
                var recordId = form.find('.record-id').val();

                // Perform edit operation using the recordId
                // Replace the following line with your own logic
                alert('Edit button clicked for record ' + recordId);
            });

            // Delete button click event
            $('.delete-btn').click(function() {
                var form = $(this).closest('form');
                var recordId = form.find('.record-id').val();

                // Perform delete operation using the recordId
                // Replace the following line with your own logic
                alert('Delete button clicked for record ' + recordId);
            });
        });
    </script>
</head>
<body>
<div class="container">
    <h2>Add User</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>

    <h2>Add Instructor</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="instructor_name">Instructor Name:</label>
            <input type="text" class="form-control" id="instructor_name" name="instructor_name">
        </div>
        <div class="form-group">
            <label for="specialization">Specialization:</label>
            <input type="text" class="form-control" id="specialization" name="specialization">
        </div>
        <button type="submit" class="btn btn-primary" name="submit_instructor">Submit</button>
    </form>

    <h2>Add Course</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="course_name">Course Name:</label>
            <input type="text" class="form-control" id="course_name" name="course_name">
        </div>
        <div class="form-group">
            <label for="specification">Course Specification:</label>
            <input type="text" class="form-control" id="specification" name="specification">
        </div>
        <button type="submit" class="btn btn-primary" name="submit_course">Submit</button>
    </form>

    <h2>Add Student Account</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="student_name">Student Name:</label>
            <input type="text" class="form-control" id="student_name" name="student_name">
        </div>
        <div class="form-group">
            <label for="student_id">Student ID:</label>
            <input type="text" class="form-control" id="student_id" name="student_id">
        </div>
        <button type="submit" class="btn btn-primary" name="submit_student">Submit</button>
    </form>

    <?php
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Balutoc";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the user form has been submitted
    if (isset($_POST["submit"])) {
        // Sanitize and validate inputs
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        // Insert data into users table
        $sql = "INSERT INTO usersVALUES ('$username', '$email')";
        if ($conn->query($sql) === TRUE) {
            echo "New user added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Check if the instructor form has been submitted
    if (isset($_POST["submit_instructor"])) {
        // Sanitize and validate inputs
        $instructor_name = mysqli_real_escape_string($conn, $_POST['instructor_name']);
        $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);

        // Insert data into instructors table
        $sql = "INSERT INTO instructors (instructor_name, specialization) VALUES ('$instructor_name', '$specialization')";
        if ($conn->query($sql) === TRUE) {
            echo "New instructor added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Check if the course form has been submitted
    if (isset($_POST["submit_course"])) {
        // Sanitize and validate inputs
        $course_name = mysqli_real_escape_string($conn, $_POST['course_name']);
        $specification = mysqli_real_escape_string($conn, $_POST['specification']);

        // Insert data into courses table
        $sql = "INSERT INTO courses (course_name, specification) VALUES ('$course_name', '$specification')";
        if ($conn->query($sql) === TRUE) {
            echo "New course added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Check if the student form has been submitted
    if (isset($_POST["submit_student"])) {
        // Sanitize and validate inputs
        $student_name = mysqli_real_escape_string($conn, $_POST['student_name']);
        $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);

        // Insert data into students table
        $sql = "INSERT INTO students (student_name, student_id) VALUES ('$student_name', '$student_id')";
        if ($conn->query($sql) === TRUE) {
            echo "New student added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
    ?>

    <h2>Users</h2>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Fetch data from the users table
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["id"]; ?></td>
                    <td><?php echo $row["username"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td>
                        <form>
                            <input type="hidden" class="record-id" value="<?php echo $row["id"]; ?>">
                            <button type="button" class="btn btn-primary edit-btn">Edit</button>
                            <button type="button" class="btn btn-danger delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "No users found";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>