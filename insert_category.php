<?php
require_once("connect.php");

$cname = $_POST['cname'];

$sql = "INSERT INTO category (cname) VALUES ('$cname')";
if (mysqli_query($conn, $sql)) {
    $last_id = mysqli_insert_id($conn);
    echo '<tr>';
    echo '<td>' . $last_id . '</td>';
    echo '<td>' . $cname . '</td>';
    echo '</tr>';
} else {
    echo "Ошибка: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
