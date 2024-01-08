<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
</head>

<body>

    <?php
    include 'db/config.php';
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Retrieve form data
        $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
        $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // Validate the form data (you can add more validation as needed)
        if (empty($username) || empty($email) || empty($password)) {
            echo '<p style="color: red;">All fields are required!</p>';
        } else {
            $e_check_query = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if (mysqli_num_rows($e_check_query) > 0 ) {
               echo '<p style="color: red;">User with same email already exists. </p>';
            }
            else {
                $ran_id = rand(time(), 100000000);
                $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password)VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$password}')");
                if ($insert_query) {
                    echo '<p style="color: green;">Signup successful!</p>';
                    echo '<p style="color: green;">Now You can <a href="login.php">Login</a> </p>';
                    exit();
                }
            }

            // //Process the form data (you can add database interactions here)
            // echo '<p style="color: green;">Signup successful!</p>';
            // echo '<p>Username: ' . $fname . '</p>';
            // echo '<p>Email: ' . $email . '</p>';
            // // Note: In a real application, you should hash the password before storing it
            // echo '<p>Password: ' . $password . '</p>';
    
        }
    }
    
    ?>

    <!-- HTML form -->
    <form method="post" action="">
        <label for="fname">First name:</label>
        <input type="text" name="fname" id="fname" required><br>

        <label for="lname">Last name:</label>
        <input type="text" name="lname" id="lname" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <input type="submit" name="submit" value="Signup">
    </form>

</body>

</html>