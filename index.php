<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>

<body>
    <p>Hi</p>
    
    <?php
    // Check if the "name" and "age" values are present in the $_POST array
    if (isset($_POST["name"]) && isset($_POST["age"])) {
        $name = htmlspecialchars($_POST["name"]);
        $age = (int)$_POST["age"];
        echo "<p>You are</p>";
        echo "<p>$name</p>";
        echo "<p>$age years old</p>";
    } else {
        echo "<p>Name and/or age not provided</p>";
    }
    ?>

    <form method="post" action="index.php">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
        <br>
        <label for="age">Age:</label>
        <input type="text" name="age" id="age">
        <br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>