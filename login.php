<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login Form</title>
</head>

<body>

    <?php
    session_start();
    include 'db/config.php';
    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        // Retrieve form data
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // Validate the form data (you can add more validation as needed)
        if (empty($email) || empty($password)) {
            echo '<p style="color: red;">All fields are required!</p>';
        } else {
            $e_check_query = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' and password = '{$password}' ");
            if (mysqli_num_rows($e_check_query) > 0) {
                $result = mysqli_fetch_assoc($e_check_query);
                $_SESSION['unique_id'] = $result['unique_id'];
                $_SESSION['name'] = $result['fname']." ".$result['lname'];
                echo '<p style="color: red;">Login Success </p>';
                header('location: dashboard.php');
            } else {
                echo '<p style="color: red;">Sorry wrong E-mail or password. </p>';
            }    
        }
    }

    ?>

    <!-- HTML form -->
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br>

        <input type="submit" name="submit" value="Login">
    </form>

</body>

</html>