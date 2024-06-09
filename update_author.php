<?php
// Подключаемся к базе данных
require_once("connect.php");

// Получаем данные из POST-запроса
$authorId = $_POST['authorId'];
$email = $_POST['email'];

// Готовим SQL-запрос для обновления email автора
$sql = "UPDATE authors SET email = '$email' WHERE ida = $authorId";

// Выполняем SQL-запрос
if (mysqli_query($conn, $sql)) {
    // Если запрос выполнен успешно, перенаправляем на страницу снова
    header("Location: authors.php");
    exit(); // Важно завершить выполнение скрипта после перенаправления
} else {
    // Если произошла ошибка, выводим сообщение об ошибке
    echo "Ошибка: " . mysqli_error($conn);
}

// Закрываем соединение с базой данных
mysqli_close($conn);
?>
