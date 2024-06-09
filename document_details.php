<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Детали документа</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;700&display=swap&subset=cyrillic" rel="stylesheet">
    <style>
         body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            flex-direction: column;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 700;
        }

        body {
            background-color: #f0f0f0;
            color: #333;
            overflow: hidden;
        }

        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .document_details-container {
    width: 100%;
    max-width: 800px;
    margin: auto;
    text-align: center;
    padding: 20px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: center; /* Центрирование по вертикали */
    align-items: center; /* Центрирование по горизонтали */
}


        .document_details-heading {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .document_details-author {
            font-size: 22px; /* Увеличиваем размер надписи "Автор" */
            margin-bottom: 10px; /* Уменьшаем отступ после надписи "Автор" */
        }

        .document_details-text {
            background-color: rgba(0, 0, 0, 0.7); /* Черный полупрозрачный фон */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: justify;
            font-size: 20px;
            line-height: 1.6;
            color: white; /* Белый текст */
            word-wrap: break-word; /* Перенос слов при необходимости */
        }
        
    </style>
</head>
<body>
<video autoplay muted loop class="video-bg">
    <source src="1.mp4" type="video/mp4">
    Ваш браузер не поддерживает тег видео.
</video>

<div class="document_details-container">
    <?php
    require_once("connect.php");

    // Получаем идентификатор документа из параметра запроса GET
    $idd = $_GET['idd'];

    // Выполняем запрос к базе данных для получения данных о документе и его авторе
    $sql = "SELECT documents.idd, documents.title, documents.content, authors.name AS author_name 
            FROM documents 
            JOIN authors ON documents.authorid = authors.ida 
            WHERE documents.idd = $idd";

    $result = mysqli_query($conn, $sql);

    // Проверяем, есть ли данные
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Используем данные из результата запроса для вывода на страницу
        echo "<h1 class='document_details-heading'>{$row['title']}</h1>";
        echo "<p class='document_details-author'>Автор: {$row['author_name']}</p>"; // Выводим имя автора
        echo "<p class='document_details-text'>{$row['content']}</p>";
        // Здесь вы можете продолжить вывод остальных данных о документе
    } else {
        echo "Документ не найден";
    }

    mysqli_close($conn);
    ?>
</div>

<script>
    $(document).on('click', '.detailsButton', function() {
        var idd = $(this).data('id');
        window.location.href = 'document_details.php?idd=' + idd;
    });
</script>

</body>
</html>
