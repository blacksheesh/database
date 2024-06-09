<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;700&display=swap&subset=cyrillic" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Cormorant Garamond', serif; /* Устанавливаем новый шрифт для всей страницы */
            font-weight: 700; /* Устанавливаем жирность для всего текста */
        }

        .video-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .content {
            position: relative;
            z-index: 1;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: -40vh; /* Смещаем контент вверх */
        }

        .hello-text {
            color: black; /* Цвет текста "Авторизация" черный */
            font-size: 24px; /* Размер текста */
        }

        form {
            background: rgba(0, 0, 0, 0.5); /* Полупрозрачный черный фон для формы */
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
        }

        form b {
            color: white; /* Цвет текста "Логин" и "Пароль" белый */
            font-size: 20px; /* Увеличиваем размер текста */
        }

        input[type="text"], input[type="password"], input[type="submit"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-family: 'Cormorant Garamond', serif; /* Устанавливаем новый шрифт для полей ввода */
            font-weight: 700; /* Устанавливаем жирность для полей ввода */
            font-size: 20px; /* Размер текста */
        }

        input[type="text"], input[type="password"] {
            margin-bottom: 15px; /* Устанавливаем расстояние между полями ввода */
        }

        input[type="submit"] {
            background-color: rgba(255, 0, 0, 0.4); /* Красный цвет с прозрачностью */
            color: white; /* Цвет текста на кнопке */
            padding: 15px 20px; /* Размер кнопки */
            font-size: 20px; /* Размер текста на кнопке */
            cursor: pointer; /* Изменение курсора при наведении */
            transition: background-color 0.3s; /* Плавный переход цвета при наведении */
        }

        input[type="submit"]:hover {
            background-color: rgba(255, 0, 0, 0.6); /* Изменяем цвет кнопки на более светлый при наведении */
        }
        
        input[type="submit"]:active {
            background-color: rgba(255, 0, 0, 1); /* Изменяем цвет кнопки на еще более светлый при нажатии */
        }

        .error-message {
            color: white;
            background-color: rgba(255, 0, 0, 0.7);
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 20px;
            display: none;
        }
    </style>
</head>
<body>
    <video autoplay muted loop class="video-bg">
        <source src="1.mp4" type="video/mp4">
        Ваш браузер не поддерживает тег видео.
    </video>

    <div class="content">
        <h3 class="hello-text">Авторизация</h3>
        <form id="login-form" method="POST" action="authr.php">
            <b>Логин</b><br>
            <input type="text" name="login"><br>
            <b>Пароль</b><br>
            <input type="password" name="password"><br><br>
            <input type="submit" value="Отправить">
        </form>
        <div id="error-message" class="error-message"></div>
    </div>

<script>
    const form = document.getElementById('login-form');
    const errorMessage = document.getElementById('error-message');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Отменяем стандартное поведение формы

        const login = form.elements['login'].value;
        const password = form.elements['password'].value;

        if (!login || !password) {
            errorMessage.textContent = 'Заполните все поля!';
            errorMessage.style.display = 'block';
        } else {
            // Отправляем запрос на сервер
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'authr.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        // Если авторизация прошла успешно, перенаправляем на admin.php
                        window.location.href = 'admin.php';
                    } else if (response.status === 'invalid_login') {
                        // Показываем окно с сообщением о неверном логине
                        errorMessage.textContent = response.message;
                        errorMessage.style.display = 'block';
                    } else if (response.status === 'invalid_password') {
                        // Показываем окно с сообщением о неверном пароле
                        errorMessage.textContent = response.message;
                        errorMessage.style.display = 'block';
                    }
                }
            };
            const data = 'login=' + encodeURIComponent(login) + '&password=' + encodeURIComponent(password);
            xhr.send(data);
        }
    });
</script>



</body>
</html>
