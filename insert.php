
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить</title>
</head>
<body>
    <h3 class="hello-text">Добавить данные</h3>
    <form method="POST" action="insert_data.php">
    <b>Имя документ</b><br>
    <input type="text" name="name"><br>
    <b>Текст документа</b><br>
    <input type="text" name="text"><br>
    <b>Тип документа</b><br>
    <input type="text" name="type">
    <br>
    <br>
    <input type="submit" value="Отправить">
</body>
</html>