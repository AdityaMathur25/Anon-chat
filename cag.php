<h1>Create Anonymous Group</h1>
<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}
include 'db/config.php';
// Check if the form is submitted



if (isset($_POST['submit'])) {
    // Retrieve form data
    function generateRandomWord($length)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $randomWord = '';

        for ($i = 0; $i < $length; $i++) {
            $randomWord .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomWord;
    }
    $g_name = isset($_POST['group_name']) ? $_POST['group_name'] : '';
    $g_type = isset($_POST['group_type']) ? $_POST['group_type'] : '';

    // Validate the form data (you can add more validation as needed)
    if (empty($g_name) || empty($g_type)) {
        echo '<p style="color: red;">All fields are required!</p>';
    } else {
        $g_check_query = mysqli_query($conn, "SELECT * FROM group_info WHERE g_name = '{$g_name}' ");
        if (mysqli_num_rows($g_check_query) > 0) {
            echo '<p style="color: red;">Group with same name aldready exists. </p>';
        } else {
            $g_id = rand(time(), 100000000);
            $g_created_by = $_SESSION['unique_id'];

            $g_join_id = generateRandomWord(9);
            $create_query = mysqli_query($conn, "INSERT INTO group_info (g_id, g_name, g_created_by, g_type, g_join_id)VALUES ({$g_id}, '{$g_name}',{$g_created_by},'{$g_type}', '{$g_join_id}')");
            if ($create_query) {
                # code...
                echo '<p style="color: green;">Group created successfully </p>';
            } else {
                echo '<p style="color: red;">Some error occur contact developer </p>';
            }

            // header('location: dashboard.php');
        }
    }
}

?>

<!-- HTML form -->
<form method="post" action="">
    <label for="group_name">Group Name:</label>
    <input type="text" name="group_name" id="group_name" required><br>

    <label for="group_type">Group Type:</label>
    <select name="group_type" id="group_type">
        <option value="1">Anonymous Group</option>
        <option value="2">known Group</option>
    </select>

    <input type="submit" name="submit" value="Create Group">
</form>