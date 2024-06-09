<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Получить документы по автору</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <label for="authorId">Введите ID автора:</label>
    <input type="text" id="authorId" name="authorId">
    <button id="getDocumentsButton">Получить документы</button>

    <div id="documentsTable"></div>

    <script>
        $(document).ready(function() {
            $("#getDocumentsButton").click(function() {
                var authorId = $("#authorId").val();
                if (authorId !== "") {
                    $("#authorId").hide(); // Скрываем строку ввода ID автора
                    $("#getDocumentsButton").hide(); // Скрываем кнопку "Получить документы"
                    $.ajax({
                        url: 'get_documents_by_author.php',
                        type: 'POST',
                        data: { authorId: authorId },
                        success: function(response) {
                            $("#documentsTable").html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    alert("Пожалуйста, введите ID автора.");
                }
            });
        });
    </script>

    <?php
    require_once("connect.php");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Получаем ID автора из POST-запроса
        $authorId = $_POST['authorId'];

        // Формируем SQL-запрос для выборки документов с выбранным автором
        $sql = "SELECT documents.idd, documents.title, authors.name AS author, 
                DATE_FORMAT(documents.datacreated, '%Y-%m-%d %H:%i') AS datacreated,
                DATE_FORMAT(documents.dataupdated, '%Y-%m-%d %H:%i') AS dataupdated,
                documents.content
                FROM documents
                JOIN authors ON documents.authorid = authors.ida
                WHERE documents.authorid = '$authorId'";

        // Выполняем запрос к базе данных
        if ($result = mysqli_query($conn, $sql)) {
            // Проверяем, есть ли документы
            if (mysqli_num_rows($result) > 0) {
                // Выводим заголовок для таблицы документов
                echo '<table border="1">';
                echo '<tr><th>#</th><th>Название</th><th>Автор</th><th>Дата создания</th><th>Последнее изменение</th><th>Содержание</th></tr>';
                
                // Выводим каждый документ в таблице
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td>' . $row["idd"] . '</td>';
                    echo '<td>' . $row["title"] . '</td>';
                    echo '<td>' . $row["author"] . '</td>';
                    echo '<td>' . $row["datacreated"] . '</td>';
                    echo '<td>' . $row["dataupdated"] . '</td>';
                    echo '<td>' . $row["content"] . '</td>';
                    echo '</tr>';
                }
                
                echo '</table>';
            } else {
                // Если нет документов с выбранным автором, выводим сообщение
                echo '<p>Нет документов с выбранным автором.</p>';
            }
        } else {
            // Если возникла ошибка при выполнении запроса, выводим сообщение об ошибке
            echo '<p>Ошибка: ' . mysqli_error($conn) . '</p>';
        }

        // Закрываем соединение с базой данных
        mysqli_close($conn);
    }
    ?>
</body>
</html>
