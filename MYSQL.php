<!DOCTYPE html>
<html>
<head>
    <title>CRUD Operations</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            <input type="submit" class="btn btn-primary" name="submit" value="Submit">
        </form>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "studentinfo";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the form has been submitted
        if (isset($_POST["submit"])) {
            // Sanitize and validate inputs
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);

            // Insert data into users table
            $sql = "INSERT INTO users (username, email) VALUES ('$username', '$email')";

            if ($conn->query($sql) === TRUE) {
                echo "<p class='success-message'>New record created successfully</p>";
            } else {
                echo "<p class='error-message'>Error: " . $sql . "<br>" . $conn->error . "</p>";
            }
        }

        // Select data from the users table
        $sql = "SELECT id, username, email FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display data in a table
            echo "<h2>Users</h2>";
            echo "<table class='table'>";
            echo "<thead><tr><th>ID</th><th>Username</th><th>Email</th></tr></thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p class='error-message'>0 results</p>";
        }

        // Close connection
        $conn->close();
        ?>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>