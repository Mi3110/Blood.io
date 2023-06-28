<!DOCTYPE html>
<html>
<head>
    <title>Blood Bank Management System</title>
    <style>
        /* CSS styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        ul.navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        ul.navbar li {
            float: left;
        }

        ul.navbar li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        ul.navbar li a:hover {
            background-color: #111;
        }

        form {
            margin-top: 20px;
        }

        form input {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Blood Bank Management System</h1>

    <ul class="navbar">
        <li><a href="#home">Home</a></li>
        <li><a href="#signup">Sign Up</a></li>
        <li><a href="#signin">Sign In</a></li>
        <li><a href="#donors">Donors</a></li>
        <li><a href="#requests">Requests</a></li>
    </ul>

    <div id="home">
        <h2>Welcome to the Blood Bank Management System</h2>
        <!-- Home page content -->
    </div>

    <div id="signup">
        <h2>Sign Up</h2>
        <form action="signup.php" method="post">
            <input type="text" name="name" placeholder="Full Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="text" name="bloodType" placeholder="Blood Type" required><br>
            <input type="submit" value="Sign Up">
        </form>
    </div>

    <div id="signin">
        <h2>Sign In</h2>
        <form action="signin.php" method="post">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="submit" value="Sign In">
        </form>
    </div>

    <div id="donors">
        <h2>Donors</h2>
        <!-- Display donors from the database -->
    </div>

    <div id="requests">
        <h2>Requests</h2>
        <!-- Display blood requests from the database -->
    </div>

    <!-- SQL Database Integration -->
    <?php
        // Connect to the SQL database
        $servername = "localhost";
        $username = "your_username";
        $password = "your_password";
        $database = "blood_bank";

        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Insert new donor into the database
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["bloodType"])) {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $bloodType = $_POST["bloodType"];

            $sql = "INSERT INTO donors (name, email, password, blood_type) VALUES ('$name', '$email', '$password', '$bloodType')";

            if ($conn->query($sql) === TRUE) {
                echo "New donor created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Sign in authentication
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["password"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];

            $sql = "SELECT * FROM donors WHERE email='$email' AND password='$password'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "Sign in successful";
                // Store session information or redirect to a new page
            } else {
                echo "Invalid email or password";
            }
        }

        $conn->close();
    ?>
</body>
</html>
