<!DOCTYPE html>
<html>
<head>
    <title>Enter Name</title>
</head>
<body>
    <h1>Enter Your Name</h1>
    <form method="POST" action="greeting.php">
        <input type="text" name="name" placeholder="Enter your name" required>
        <button type="submit">Submit</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        echo "<h1>Hello, $name!</h1>";
    }
    ?>
    <a href="index.php">Back</a>
</body>
</html>