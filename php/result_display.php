<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Results</title>
    <style>

        	
     
      ul {
			position: -webkit-sticky; /* Safari */
			position: sticky;
			top: 0;
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
			background-color: rgba(255, 255, 255, 0.2); /* Setting opacity to 50% */
        }

        li {
            float: right;
        }


        li a {
            font-family: Century Gothic;
            display: block;
            color: #324163;
            text-align: center;
            padding: 18px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #B1B9C2;
        }
		
		.title{
		font-size: 20px;
		margin: 17px;
		color: #324163;
		font-weight: bold;
		position: absolute;
		}

        body {
			background-image: url('newbg.png');
			background-size: cover;
			background-repeat: no-repeat;
			background-attachment: fixed;
		}

        p{
            text-align: center;
            font-family: Century Gothic;
            font-size: 30px;
            color: #324163;
        }


        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            justify-content: center;
        }

        th, td {
            font-family: century gothic;
            font-size: 13px;
            padding: 12px 15px;
            border-bottom: 1px solid #f2f2f2;
            text-align: center;
         
        }

        th {
            background-color: #324163;
            color: #fff;
        }

        tr {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #B1B9C2;
        }
    </style>
</head>
<body>

<ul>
		
		<p class="title"> Sangguniang Kabataan ng Barangay Santolan </p>
        <li><a href="webpage.html">ABOUT</a></li>
        <li><a href="login.html">LOGIN</a></li>
        <li><a href="contacts.html">CONTACTS</a></li>
        <li><a href="home.html">HOME</a></li>
    </ul>

  

    <?php
    // Step 1: Connect to your database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbase = "sanggunian";

    $conn = new mysqli($servername, $username, $password, $dbase);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Step 2: Handle form submission
    if (isset($_POST['sub'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $request = $_POST['request'];
        $others = $_POST['others'];

        // Step 3: Construct SQL query for insertion
        $sql = "INSERT INTO tbl_request (name, address, contact, email, request, others) VALUES ('$name', '$address', '$contact', '$email', '$request','$others')";

        // Step 4: Execute SQL query
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Successfully Added!')</script>";
            // Redirect back to webpage.html after successful submission
            header("Location: webpage.html");
            exit(); // Ensure that subsequent code is not executed after redirection
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Step 5: Fetch and display existing data
    $sql_select = "SELECT * FROM tbl_request";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        
        echo "<table>";
        echo "<tr><th>Name</th>
        <th>Address</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Request</th>
        <th>Others</th>
        
        </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["contact"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["request"] . "</td>";
            echo "<td>" . $row["others"] . "</td>";
    
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No results found";
    }

    $conn->close();
    ?>

</body>
</html>