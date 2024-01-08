<?php
include 'db/config.php';
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: index.php");
}
$uid = $_SESSION['unique_id'];
$name = $_SESSION['name'];
echo "Welcome " . $name . " your unique id is " . $uid;

?>
<style>
    .apple{
        text-align: center;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
<p>Start your own<a href="cag.php">Group</a>today</p>
<p>Join an <a href="jag.php">Group </a> today</p>
<?php
$group_data = mysqli_query($conn, "SELECT * FROM group_info WHERE g_created_by = '{$uid}' ");
if (mysqli_num_rows($group_data) > 0) {
    echo "<h2 class='apple'>Your created groups</h2>";
    echo "<table>";
    echo "<tr><th>Serial Number</th><th>Group Id</th><th>Group Name</th><th>Group Type</th><th>Group Join Id</th></tr>";

    $serialNumber = 1;

    // Output data of each row
    while ($row = mysqli_fetch_assoc($group_data)) {
        echo "<tr>";
        echo "<td>" . $serialNumber++ . "</td>";
        echo "<td>" . $row["g_id"] . "</td>";
        echo "<td>" . $row["g_name"] . "</td>";
        if ($row["g_type"] == '1') {
            echo "<td> Anonymous Group </td>";  
        }
        else{
            echo "<td> Known Group </td>"; 
        }
        // echo "<td>" . $row["g_type"] . "</td>";
        echo "<td>" . $row["g_join_id"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No results found in the database.";
}
