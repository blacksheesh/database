<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Чернышова Лиза</title>
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
            color: black; /* Цвет текста */
            position: relative;
            top: -30vh; /* Смещаем контент выше */
        }

        .hello-text {
            font-size: 36px; /* Увеличиваем размер текста */
            color: black; /* Цвет текста */
            margin-bottom: 20px; /* Отступ снизу */
        }

        .button {
            background-color: rgba(255, 0, 0, 0.4); /* Красный цвет с прозрачностью */
            color: white; /* Цвет текста на кнопке */
            padding: 20px 30px; /* Увеличиваем размер кнопки */
            font-size: 24px; /* Увеличиваем размер текста на кнопке */
            cursor: pointer; /* Изменение курсора при наведении */
            transition: background-color 0.3s; /* Плавный переход цвета при наведении */
            border: none; /* Убираем границу */
            border-radius: 15px; /* Скругляем углы */
            margin: 10px; /* Отступы между кнопками */
            text-decoration: none; /* Убираем подчеркивание текста */
            display: inline-block; /* Делаем элементы строчно-блочными */
        }

        .button:hover {
            background-color: rgba(255, 0, 0, 0.6); /* Изменяем цвет кнопки на более светлый при наведении */
        }

        .button:active {
            background-color: rgba(255, 0, 0, 1); /* Изменяем цвет кнопки на еще более светлый при нажатии */
        }
    </style>
</head>
<body>
    <video autoplay muted loop class="video-bg">
        <source src="1.mp4" type="video/mp4">
        Ваш браузер не поддерживает видео в формате MP4.
    </video>

    <div class="content">
        <h3 class="hello-text">Добро пожаловать!</h3>
        <a href="reg.php" class="button">Регистрация</a>
        <a href="auth.php" class="button">Авторизация</a>
    </div>
</body>
</html>
