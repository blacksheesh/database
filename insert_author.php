<?php
require_once("connect.php");

$name = $_POST['name'];
$email = $_POST['email'];

$sql = "INSERT INTO authors (name, email) VALUES ('$name', '$email')";

if (mysqli_query($conn, $sql)) {
    // Получить последний вставленный ID
    $last_id = mysqli_insert_id($conn);
    // Вернуть новую строку для добавления в таблицу
    echo '<tr>';
    echo '<td>' . $last_id . '</td>';
    echo '<td>' . $name . '</td>';
    echo '<td>' . $email . '</td>';
    echo '</tr>';
} else {
    echo "Ошибка: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
