<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Таблицы</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;700&display=swap&subset=cyrillic" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 700;
            color: white; /* Белый текст */
        }

        body {
            background-color: #f0f0f0;
            color: #333;
            overflow: hidden;
            position: relative;
        }

        video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }

        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -80%);
            text-align: center;
            padding: 20px;
        }

        .hello-text {
            font-size: 30px;
            margin-bottom: 20px;
        }

        .links-container {
            display: flex;
            justify-content: center;
        }

        .exit-link {
            margin-top: 20px; /* Отступ от других ссылок */
            display: block; /* Превращаем в блочный элемент для выравнивания по центру */
        }

        a {
            color: white; /* Белый текст */
            text-decoration: none;
            font-size: 20px;
            transition: color 0.3s ease;
            margin: 0 10px; /* Расстояние между ссылками */
            padding: 10px 20px; /* Поля вокруг текста */
            background-color: rgba(0, 0, 0, 0.7); /* Черный полупрозрачный фон */
            border-radius: 15px; /* Закругленные углы */
        }

        a:hover {
            background-color: rgba(0, 0, 0, 0.5); /* Черный полупрозрачный фон при наведении */
        }

        a:active {
            background-color: rgba(0, 0, 0, 1); /* Черный полупрозрачный фон при наведении */
        }

        .image-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .image-container img {
            width: 100px; /* Задаем размер изображений */
            margin: 0 10px; /* Расстояние между изображениями */
        }
    </style>
</head>
<body>

<video autoplay muted loop>
    <source src="1.mp4" type="video/mp4">
    Ваш браузер не поддерживает тег видео.
</video>

<div class="content">
    <h3 class="hello-text">Выберите таблицу</h3>
    <div class="image-container">
        <img src="11.png" alt="Image 1">
        <img src="22.png" alt="Image 2">
        <img src="33.png" alt="Image 3">
    </div>
    <div class="links-container">
        <a href="document.php">Документы</a>
        <a href="category.php">Категории</a>
        <a href="author.php">Авторы</a>
    </div>
    <a href="index.php" class="exit-link">Выйти</a>
</div>

</body>
</html>
