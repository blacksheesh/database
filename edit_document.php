<?php
require_once("connect.php");

if (isset($_POST['idd']) && isset($_POST['title']) && isset($_POST['content']) && isset($_POST['author']) && isset($_POST['category'])) {
    $idd = $_POST['idd'];
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

    // Обновляем документ
    $sql = "UPDATE documents SET title = '$title', content = '$content', authorid = '$author_id', categoryid = '$category_id', dataupdated = NOW() WHERE idd = '$idd'";
    if (mysqli_query($conn, $sql)) {
        $sql = "SELECT documents.idd, documents.title, authors.name AS author_name, category.cname AS category_name, documents.datacreated, documents.dataupdated, documents.content
                FROM documents
                JOIN authors ON documents.authorid = authors.ida
                JOIN category ON documents.categoryid = category.idc
                WHERE documents.idd = '$idd'";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            echo json_encode($row);
        } else {
            echo json_encode(["error" => "Error fetching updated document data"]);
        }
    } else {
        echo json_encode(["error" => "Ошибка при обновлении документа: " . mysqli_error($conn)]);
    }
} else {
    echo json_encode(["error" => "Необходимо предоставить все данные для редактирования документа."]);
}

mysqli_close($conn);
?>
