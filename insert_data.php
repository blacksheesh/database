<?php
require_once("connect.php");

$title = $_POST['title'];
$content = $_POST['content'];
$author = $_POST['author'];
$category = $_POST['category'];

// Проверяем, существует ли автор
$sql = "SELECT ida FROM authors WHERE name = '$author'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
    // Если автора нет, добавляем его
    $sql = "INSERT INTO authors (name) VALUES ('$author')";
    mysqli_query($conn, $sql);
    $author_id = mysqli_insert_id($conn);
} else {
    // Если автор существует, получаем его id
    $row = mysqli_fetch_assoc($result);
    $author_id = $row['ida'];
}

// Проверяем, существует ли категория
$sql = "SELECT idc FROM category WHERE cname = '$category'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
    // Если категории нет, добавляем ее
    $sql = "INSERT INTO category (cname) VALUES ('$category')";
    mysqli_query($conn, $sql);
    $category_id = mysqli_insert_id($conn);
} else {
    // Если категория существует, получаем ее id
    $row = mysqli_fetch_assoc($result);
    $category_id = $row['idc'];
}

// Добавляем документ
$sql = "INSERT INTO documents (title, content, authorid, categoryid, datacreated, dataupdated) 
        VALUES ('$title', '$content', '$author_id', '$category_id', NOW(), NOW())";
if (mysqli_query($conn, $sql)) {
    echo "Документ успешно добавлен.";
} else {
    echo "Ошибка при добавлении документа: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
