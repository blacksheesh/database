<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторы</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Cormorant Garamond', serif;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: black;
            color: white;
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

        table {
            width: 80%;
            max-width: 600px;
            border-collapse: collapse;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: rgba(255, 0, 0, 0.4);
        }

        td {
            background-color: rgba(0, 0, 0, 0.6);
        }

        #addAuthorForm, .editAuthorForm, .authorSelectionForm {
            display: none;
            margin-top: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            color: white;
        }

        input[type="text"],
        input[type="email"],
        input[type="submit"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Cormorant Garamond', serif;
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
        /* Стили для модального окна */
        .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
        }

        /* Стили для контента модального окна */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%; /* Уменьшаем ширину модального окна */
            color: black; /* Изменяем цвет текста на черный */
        }
        /* Применяем стили кнопок к кнопке "OK" */
        #okButton {
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

        #okButton:hover {
            background-color: rgba(255, 0, 0, 0.6);
        }

        #okButton:active {
            background-color: rgba(255, 0, 0, 1);
        }
        #showAuthorButton {
    color: white;
    background-color: rgba(255, 0, 0, 0.4);
    font-family: 'Cormorant Garamond', serif;
    font-weight: 700;
    font-size: 20px;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    margin-top: 10px; /* Добавляем отступ сверху */
    border-radius: 15px;
}

#showAuthorButton:hover {
    background-color: rgba(255, 0, 0, 0.6);
}

#showAuthorButton:active {
    background-color: rgba(255, 0, 0, 1);
}
#saveAuthorButton {
    color: white;
    background-color: rgba(255, 0, 0, 0.4);
    font-family: 'Cormorant Garamond', serif;
    font-weight: 700;
    font-size: 20px;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    margin-top: 10px; /* Добавляем отступ сверху */
    border-radius: 15px;
}

#saveAuthorButton:hover {
    background-color: rgba(255, 0, 0, 0.6);
}

#saveAuthorButton:active {
    background-color: rgba(255, 0, 0, 1);
}


    </style>
</head>
<body>
    <video id="video-background" autoplay muted loop>
        <source src="1.mp4" type="video/mp4">
        Ваш браузер не поддерживает тег видео.
    </video>

    <?php
    require_once("connect.php");
    echo '<table border="1">';
    echo '<tr><th>#</th><th>Автор</th><th>Email</th><th>Действия</th></tr>';
    $sql = "SELECT ida, name, email FROM authors";
    if ($result = mysqli_query($conn, $sql)) {
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr>';
            echo '<td>' . $row["ida"] . '</td>';
            echo '<td>' . $row["name"] . '</td>';
            echo '<td>' . $row["email"] . '</td>';
            echo '<td><button class="editAuthorButton" data-id="' . $row["ida"] . '">Изменить</button>';
            echo '</tr>';
        }
    }
    echo '</table>';
    mysqli_close($conn);
    ?>

    <div id="addAuthorForm">
        <h3>Добавить автора</h3>
        <form id="authorForm">
            <b>Имя автора</b><br>
            <input type="text" name="name" required><br>
            <b>Email</b><br>
            <input type="email" name="email" required><br>
            <input type="submit" value="Отправить">
        </form>
    </div>

    <div class="editAuthorForm" style="display: none;">
    <h3>Изменить email автора</h3>
    <form id="editAuthorForm">
        <input type="hidden" name="authorId">
        <b>Email</b><br>
        <input type="email" name="email" required><br>
        <button type="submit" id="saveAuthorButton">Сохранить</button>
    </form>
</div>


    <div class="authorSelectionForm" style="display: none;">
    <h3>Выбрать автора</h3>
    <form id="selectAuthorForm">
        <b>Введите ID автора:</b><br>
        <input type="text" name="authorId" required><br>
        <input type="submit" value="Отобразить" id="showAuthorButton">

    </form>
</div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <p>Содержимое модального окна</p>
            <button id="okButton">OK</button>
        </div>
    </div>

    <div id="documentsTable"></div>

    <button id="showAddFormButton">Добавить автора</button>
    <button id="showAuthorSelectionFormButton">Отобразить</button>
    <script>
    // Показать/скрыть форму добавления автора
    $("#showAddFormButton").click(function() {
        $("#addAuthorForm").toggle();
    });

    // Показать/скрыть форму выбора автора
    $("#showAuthorSelectionFormButton").click(function() {
        $(".authorSelectionForm").toggle();
        $(".editAuthorButton").unbind("click"); // Отключаем существующие обработчики кнопки "Изменить"
        $(".editAuthorButton").click(function() { // Прикрепляем новый обработчик для кнопки "Изменить"
            var authorId = $(this).data('id');
            $('.editAuthorForm input[name="authorId"]').val(authorId);
            $('.editAuthorForm').show();
        });
    });

    // Обработка отправки формы добавления автора
    $("#authorForm").submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: 'insert_author.php', // Путь к файлу для вставки нового автора
            type: 'POST',
            data: $(this).serialize(), // Сериализуем данные формы
            success: function(response) {
                location.reload(); // Перезагрузка страницы для обновления таблицы с авторами
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

// Обработка отправки формы выбора автора
$("#selectAuthorForm").submit(function(event) {
    event.preventDefault();

    $.ajax({
        url: 'get_documents_by_author.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            $('#documentsTable').html(response);
            $(".authorSelectionForm").hide(); // Скрыть форму выбора автора после успешного получения данных
        },
        error: function(xhr,status, error) {
            console.error(xhr.responseText);
        }
    });
});
// Обработка нажатия кнопки "Отобразить"
$("#showAuthorButton").click(function(event) {
    event.preventDefault();

    $.ajax({
        url: 'get_documents_by_author.php',
        type: 'POST',
        data: $("#selectAuthorForm").serialize(),
        success: function(response) {
            $('#documentsTable').html(response);
            $(".authorSelectionForm").hide(); // Скрыть форму выбора автора после успешного получения данных
        },
        error: function(xhr,status, error) {
            console.error(xhr.responseText);
        }
    });
});


    // Обработчик для кнопки "Изменить"
    $(".editAuthorButton").click(function() {
        var authorId = $(this).data('id');
        $('.editAuthorForm input[name="authorId"]').val(authorId);
        $('.editAuthorForm').show();
    });

    // Обработка отправки формы изменения email
    $("#editAuthorForm").submit(function(event) {
        event.preventDefault();

        $.ajax({
            url: 'update_author.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert('Email автора успешно изменен.');
                $('.editAuthorForm').hide();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Показать модальное окно
    function showModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
    }

    // Скрыть модальное окно
    function hideModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }

    // Обработчик для кнопки "OK"
    $("#okButton").click(function() {
        hideModal();
    });

    // Закрыть модальное окно при клике на крестик
    $(".close").click(function() {
        hideModal();
    });

    // Закрыть модальное окно при клике вне окна
    window.onclick = function(event) {
        var modal = document.getElementById("myModal");
        if (event.target == modal) {
            hideModal();
        }
    };
</script>

</body>
</html>
