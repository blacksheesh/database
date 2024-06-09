<?php
// Подключаемся к базе данных
require_once("connect.php");

// Получаем категорию из POST-запроса
$category = $_POST['category'];

// Формируем SQL-запрос для выборки документов по категории
$sql = "SELECT documents.idd, documents.title, authors.name AS author, DATE_FORMAT(documents.datacreated, '%Y-%m-%d %H:%i') AS datacreated,
DATE_FORMAT(documents.dataupdated, '%Y-%m-%d %H:%i') AS dataupdated, documents.content
        FROM documents
        JOIN category ON documents.categoryid = category.idc
        JOIN authors ON documents.authorid = authors.ida
        WHERE category.cname = '$category'";

// Выполняем запрос к базе данных
if ($result = mysqli_query($conn, $sql)) {
    // Проверяем, есть ли документы
    if (mysqli_num_rows($result) > 0) {
        // Выводим заголовок для таблицы документов
        echo '<h3>Документы по категории "' . $category . '"</h3>';
        echo '<table border="1">';
        echo '<tr><th>№</th><th>Название</th><th>Автор</th><th>Дата создания</th><th>Последнее изменение</th><th>Действия</th></tr>';
        
        // Выводим каждый документ в таблице
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
            echo '<td>' . $row["idd"] . '</td>';
            echo '<td>' . $row["title"] . '</td>';
            echo '<td>' . $row["author"] . '</td>';
            echo '<td>' . $row["datacreated"] . '</td>';
            echo '<td>' . $row["dataupdated"] . '</td>';
            echo '<td><a href="document_details.php?idd=' . $row["idd"] . '" class="details-link">Подробнее</a></td>';
            echo '</tr>';
        }
        
        echo '</table>';
    } else {
        // Если нет документов по выбранной категории, выводим модальное окно
        echo '<script>$("#noDocumentsModal").show();</script>';
    }
} else {
    // Если возникла ошибка при выполнении запроса, выводим сообщение об ошибке
    echo '<p>Ошибка: ' . mysqli_error($conn) . '</p>';
}

// Закрываем соединение с базой данных
mysqli_close($conn);
?>
