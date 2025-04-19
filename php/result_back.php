<?php
    // Step 1: Connect to your database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbase = "sanggunian";

    $conn = new mysqli($servername, $username, $password, $dbase);


    $sql_select = "SELECT * FROM tbl_request";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Name</th><th>Password</th><th>Email</th><th>Message</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["password"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["message"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No results found";
    }


    $conn->close();
    ?>