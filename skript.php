<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webbserverprogrammering";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    $login_success = false;
    $full_name = "";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { //så länge den kör
            if (
                $row["userId"] == $_POST["username"] &&
                $row["passwd"] == $_POST["password"]
            ) {
                $login_success = true;
                $full_name = $row["firstname"] . " " .
                    $row["lastname"];
            }
        }
    } else {
        echo "0 results";
    }
    if ($full_name) {
        echo "Hej " . $full_name . ", du är inloggad i sidan. <br>";
    } else {
        echo "Tyvärr, gick det inte att logga in i sidan, försök igen.";
    }

    $conn->close();


    if ($login_success) {
        session_start();
        $_SESSION["username"] = $_POST["username"];
        echo "<form action='loggaut.php' method='post'> <input type='submit' value='logga ut'></form>";
    }

    ?>

</body>

</html>