<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Категории</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        #video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            object-fit: cover;
        }

        #content {
            position: relative;
            z-index: 1;
        }

        #addcategoryForm, #showDocumentForm, #documentTable {
            display: none;
            margin-top: 20px;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 700;
            font-size: 22px;
            overflow: hidden;
            color: white;
        }

        .content {
            text-align: center;
            color: white;
            position: relative;
            top: -30vh;
        }

        .hello-text {
            font-size: 48px;
            margin-bottom: 20px;
            color: black;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border: 0px solid #ddd;
        }

        th {
            background-color: rgba(255, 0, 0, 0.4);
        }

        td {
            background-color: rgba(0, 0, 0, 0.6);
        }

        button {
            color: white;
            background-color: rgba(255, 0, 0, 0.4);
            font-family: 'Cormorant Garamond', serif;
            font-weight: 700;
            font-size: 20px;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin: 5px;
            border-radius: 15px;
        }

        button:hover {
            background-color: rgba(255, 0, 0, 0.6);
        }

        button:active {
            background-color: rgba(255, 0, 0, 1);
        }

        h3, b {
            text-align: center;
            color: black;
        }

        input[type="submit"] {
            color: white;
            background-color: rgba(255, 0, 0, 0.4);
            font-family: 'Cormorant Garamond', serif;
            font-weight: 700;
            font-size: 16px;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin: 5px;
            border-radius: 15px;
        }

        input[type="submit"]:hover {
            background-color: rgba(255, 0, 0, 0.6);
        }

        input[type="submit"]:active {
            background-color: rgba(255, 0, 0, 1);
        }

        #noDocumentsModal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            color: black;
            text-align: center;
            z-index: 10001;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        #modalBackground {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 10000;
        }

        #noDocumentsModal button {
            background-color: rgba(255, 0, 0, 0.4);
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
        }

        #noDocumentsModal button:hover {
            background-color: rgba(255, 0, 0, 0.6);
        }

        #noDocumentsModal button:active {
            background-color: rgba(255, 0, 0, 1);
        }

        #documentTable {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: transparent;
            color: white;
            border-collapse: collapse;
            z-index: 100;
        }

        #documentTable th, #documentTable td {
            padding: 10px;
            border: 1px solid white;
        }

        #documentTable th {
            background-color: rgba(255, 0, 0, 0.4);
        }

        #documentTable td {
            background-color: transparent;
        }

        /* Стиль для ссылки "подробнее" */
        .details-link {
            color: white !important; /* Установим белый цвет текста ссылки */
            text-decoration: none;
        }

        .details-link:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <video id="video-background" autoplay muted loop>
        <source src="1.mp4" type="video/mp4">
        Ваш браузер не поддерживает тег видео.
    </video>

    <div id="content">
        <h3 style="color: black;">Категории</h3>
        <!-- Ваш существующий контент здесь -->
        <?php
        require_once("connect.php");
        echo '<table border="1">';
        echo '<tr><th>№</th><th>Категория</th></tr>';
        $sql = "SELECT * FROM category";
        if ($result = mysqli_query($conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<tr>';
                echo '<td>' . $row["idc"] . '</td>'; // Название столбца 'idc'
                echo '<td>' . $row["cname"] . '</td>'; // Название столбца 'cname'
                echo '</tr>';
            }
        }
        echo '</table>';
        mysqli_close($conn);
        ?>

        <br>
        <button id="showFormButton">Добавить</button>
        <button id="showDocumentButton">Вывести</button>

        <div id="addcategoryForm">
            <h3>Добавить категорию</h3>
            <form id="categoryForm">
                <b>Название категории</b><br>
                <input type="text" name="cname" required><br>
                <input type="submit" value="Отправить">
            </form>
        </div>

        <div id="showDocumentForm">
            <h3>Выберите категорию для вывода документов</h3>
            <form id="documentCategoryForm">
                <b>Название категории</b><br>
                <input type="text" name="category" required><br>
                <input type="submit" value="Вывести">
            </form>
        </div>
    </div>

    <div id="documentTable"></div>

    <div id="modalBackground"></div>
    <div id="noDocumentsModal">
        <h3>Нет документов по выбранной категории</h3>
        <button onclick="$('#noDocumentsModal, #modalBackground').hide()">Закрыть</button>
    </div>

    <script>
        // Показать/скрыть форму добавления категории
        $("#showFormButton").click(function() {
            $("#addcategoryForm").toggle();
        });

        // Показать/скрыть форму выбора категории для вывода документов
        $("#showDocumentButton").click(function() {
            $("#showDocumentForm").toggle();
        });

        // Обработка отправки формы добавления категории
        $("#categoryForm").submit(function(event) {
            event.preventDefault();
            
            $.ajax({
                url: 'insert_category.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Добавление новой строки в таблицу
                    $("table").append(response);
                    // Скрытие формы
                    $("#addcategoryForm").hide();
                    // Очистка формы
                    $("#categoryForm")[0].reset();
                }
            });
        });

        // Обработка отправки формы выбора категории для вывода документов
        $("#documentCategoryForm").submit(function(event) {
            event.preventDefault();
            
            var category = $("input[name='category']").val();

            // Отправляем запрос на сервер для получения документов по выбранной категории
            $.ajax({
                url: 'get_documents_by_category.php',
                type: 'POST',
                data: { category: category },
                success: function(response) {
                    if(response.trim() === "") {
                        // Если ответ пустой, показываем модальное окно о отсутствии документов
                        $("#modalBackground").show();
                        $("#noDocumentsModal").show();
                    } else {
                        // Заполнение таблицы с документами
                        $("#documentTable").html(response);
                        $("#documentTable").show();
                    }
                    // Скрытие формы
                    $("#showDocumentForm").hide();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
</body>
</html>
