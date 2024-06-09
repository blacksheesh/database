<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Документы</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;700&display=swap&subset=cyrillic" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 700;
            font-size: 22px;
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
        .settingsMenu {
            display: none;
            position: absolute;
            background-color: rgba(0,0,0,0);
            min-width: 80px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0);
            z-index: 1;
        }

        .settingsButton {
        background-color: rgba(255, 0, 0, 0); /* Устанавливаем прозрачный цвет фона */
        opacity: 0.4; /* Устанавливаем прозрачность кнопки */
        
        }
        .settingsButton:hover {
        background-color: rgba(255, 0, 0, 0); /* Устанавливаем прозрачный цвет фона */
        opacity: 0.6; /* Устанавливаем прозрачность кнопки */
        }
        .settingsButton:active {
        background-color: rgba(255, 0, 0, 0); /* Устанавливаем прозрачный цвет фона */
        opacity: 1; /* Устанавливаем прозрачность кнопки */
        }

        .settingsMenu button {
            background-color: rgba(255, 0, 0, 0.5)!important;
            width: 100%;
            text-align: left;
            padding: 8px 16px;
            border: none;
            background-color: inherit;
            cursor: pointer;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 700;
            font-size: 22px;
        }

        .settingsMenu button:hover {
            background-color: rgba(255, 0, 0, 0.6)!important;
        }
        
        .settingsMenu button:active {
            background-color: rgba(255, 0, 0, 1)!important;
        }
        .detailsButton.button {
            background-color: rgba(255, 0, 0, 0.4)!important;
        }

        .button, input[type="submit"], .settingsButton, .editDocument, .deleteDocument {
        background-color: rgba(255, 0, 0, 0.4)!important;
        color: white;
        padding: 10px 20px; /* Уменьшаем вертикальный и горизонтальный отступ */
        font-size: 18px; /* Уменьшаем размер текста */
        cursor: pointer;
        transition: background-color 0.3s!important;
        border: none;
        border-radius: 15px;
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
        font-family: 'Cormorant Garamond', serif;
        font-weight: 700;
        }


        .button:hover, input[type="submit"]:hover, .detailsButton, .settingsButton, .editDocument, .deleteDocument  {
            background-color: rgba(255, 0, 0, 0.6)!important;
        }

        .button:active, input[type="submit"]:active, .detailsButton, .settingsButton, .editDocument, .deleteDocument  {
            background-color: rgba(255, 0, 0, 1)!important;
        }

        form {
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
        }

        form b {
            color: white;
            font-size: 28px;
        }

        input[type="text"], textarea {
            width: calc(100% - 20px);
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 700;
            font-size: 22px;
            margin-bottom: 15px;
        }

        textarea {
            height: 100px;
        }
        .custom-confirm {
            display: none; /* Скрываем модальное окно при загрузке страницы */
            display: none; /* Изначально скрыто */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            color: black;
            align-items: center;
        }

        .custom-confirm-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
        }

        .custom-confirm-content p {
            margin-bottom: 10px;
        }

        .custom-confirm-content button {
            margin-right: 10px;
            padding: 10px 20px; /* Увеличиваем размер кнопок */
            border: none;
            background-color: rgba(255, 0, 0, 0.4);
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-family: 'Cormorant Garamond', serif; /* Применяем шрифт */
            font-weight: 700;
            font-size: 22px; /* Увеличиваем размер текста */
        }

        .custom-confirm-content button:hover {
            background-color: rgba(255, 0, 0, 0.6);
        }

        .custom-confirm-content button:active {
            background-color: rgba(255, 0, 0, 1);
        }

        #custom-confirm {
    display: none;
        }


    </style>
</head>
<body>
    
    <video autoplay muted loop class="video-bg">
        <source src="1.mp4" type="video/mp4">
        Ваш браузер не поддерживает видео в формате MP4.
    </video>

    <div class="content">
        <h3 class="hello-text">Документы</h3>
        <table border="1" id="documentsTable">
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>Автор</th>
                <th>Категория</th>
                <th>Дата создания</th>
                <th>Последнее изменение</th>
                <th>Содержание</th>
                <th>Настройки</th>
            </tr>
            <?php
            require_once("connect.php");
            $sql = "SELECT documents.idd, documents.title, authors.name AS author_name, category.cname AS category_name, documents.datacreated, documents.dataupdated, documents.content
                    FROM documents
                    JOIN authors ON documents.authorid = authors.ida
                    JOIN category ON documents.categoryid = category.idc";
            if ($result = mysqli_query($conn, $sql)) {
                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr data-id="' . $row["idd"] . '">';
                    echo '<td>' . $row["idd"] . '</td>';
                    echo '<td class="title">' . $row["title"] . '</td>';
                    echo '<td class="author_name">' . $row["author_name"] . '</td>';
                    echo '<td class="category_name">' . $row["category_name"] . '</td>';
                    echo '<td>' . date('Y-m-d H:i', strtotime($row["datacreated"])) . '</td>';
                    echo '<td>' . date('Y-m-d H:i', strtotime($row["dataupdated"])) . '</td>';
                    echo '<td><button class="detailsButton button" data-id="' . $row["idd"] . '">Подробнее</button></td>';
                    echo '<td class="settingsColumn"><button class="settingsButton">&#8942;</button>
                            <div class="settingsMenu">
                                <button class="editDocument">Изменить</button>
                                <button class="deleteDocument">Удалить</button>
                            </div>
                        </td>';
                    echo '</tr>';
                }
            }
            mysqli_close($conn);
            ?>
        </table>

        <br>
        <button id="showFormButton" class="button">Добавить</button>

        <div id="addDocumentForm" style="display: none;">
            <h3 class="hello-text">Добавить данные</h3>
            <form id="documentForm">
                <b>Название документа</b><br>
                <input type="text" name="title" required><br>
                <b>Текст документа</b><br>
                <textarea name="content" required></textarea><br>
                <b>Автор документа</b><br>
                <input type="text" name="author" required><br>
                <b>Категория документа</b><br>
                <input type="text" name="category" required><br>
                <br>
                <input type="submit" value="Отправить">
            </form>
        </div>

        <div id="editDocumentForm" style="display: none;">
            <h3 class="hello-text">Изменить данные</h3>
            <form id="editForm">
                <input type="hidden" name="idd" id="edit_idd">
                <b>Название документа</b><br>
                <input type="text" name="title" id="edit_title" required><br>
                <b>Текст документа</b><br>
                <textarea name="content" id="edit_content" required></textarea><br>
                <b>Автор документа</b><br>
                <input type="text" name="author" id="edit_author" required><br>
                <b>Категория документа</b><br>
                <input type="text" name="category" id="edit_category" required><br>
                <br>
                <input type="submit" value="Сохранить">
            </form>
        </div>
                <div id="custom-confirm" class="custom-confirm">
            <div class="custom-confirm-content">
                <p>Вы уверены, что хотите удалить этот документ?</p>
                <button id="confirm-yes">Да</button>
                <button id="confirm-no">Нет</button>
            </div>
        </div>

    <script>
        $(document).ready(function() {
            // Показать/скрыть меню при клике на вертикальные точки
            $(document).on('click', '.settingsButton', function(event) {
                event.stopPropagation(); // Предотвращаем закрытие меню при клике на него

                var settingsMenu = $(this).next('.settingsMenu');
                $('.settingsMenu').not(settingsMenu).hide(); // Скрыть другие меню, если они открыты
                settingsMenu.toggle(); // Показать или скрыть текущее меню
            });

            // Закрыть меню при клике вне него
            $(document).click(function(event) {
                if (!$(event.target).closest('.settingsColumn').length) {
                    $('.settingsMenu').hide();
                }
            });

            // Показать/скрыть форму добавления
            $("#showFormButton").click(function() {
                $("#addDocumentForm").toggle();
            });

            // Обработка отправки формы добавления документа
            $("#documentForm").submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: 'insert_data.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        location.reload(); // Перезагрузка страницы после добавления документа
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            // Показать форму редактирования с текущими данными
            $(document).on('click', '.editDocument', function() {
                var row = $(this).closest('tr');
                var idd = row.data('id');
                var title = row.find('.title').text();
                var author = row.find('.author_name').text();
                var category = row.find('.category_name').text();
                var content = row.find('.content').text();

                $("#edit_idd").val(idd);
                $("#edit_title").val(title);
                $("#edit_author").val(author);
                $("#edit_category").val(category);
                $("#edit_content").val(content);

                $("#editDocumentForm").show();
                $('.settingsMenu').hide(); // Скрыть все меню настройки
            });

            // Обработка отправки формы редактирования документа
            $("#editForm").submit(function(event) {
                event.preventDefault();

                $.ajax({
                    url: 'edit_document.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (!data.error) {
                            var row = $('tr[data-id="' + data.idd + '"]');
                            row.find('.title').text(data.title);
                            row.find('.author_name').text(data.author_name);
                            row.find('.category_name').text(data.category_name);
                            row.find('.dataupdated').text(data.dataupdated); // Обновляем дату последнего изменения
                            row.find('.content').text(data.content);
                            $("#editDocumentForm").hide();
                        } else {
                            console.error(data.error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
            $(document).ready(function() {
    // Показать модальное окно при нажатии на кнопку удаления
    $('.deleteDocument').click(function() {
        var idd = $(this).closest('tr').data('id');
        $('#confirm-yes').data('idd', idd); // Устанавливаем idd в кнопку "Да"
        $('#custom-confirm').fadeIn();
    });

    // Закрыть модальное окно при нажатии на "Нет"
    $('#confirm-no').click(function() {
        $('#custom-confirm').fadeOut();
    });

    // Обработка нажатия "Да"
    $('#confirm-yes').click(function() {
        var idd = $(this).data('idd');

        $.ajax({
            url: 'delete_document.php',
            type: 'POST',
            data: { idd: idd },
            success: function(response) {
                var data = JSON.parse(response);
                if (data.success) {
                    location.reload(); // Перезагрузка страницы после успешного удаления
                } else {
                    console.error(data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});




            // Показать подробности о документе
            $(document).on('click', '.detailsButton', function() {
                var idd = $(this).closest('tr').data('id');
                window.location.href = 'document_details.php?idd=' + idd;
            });
        });
    </script>
</body>
</html>
