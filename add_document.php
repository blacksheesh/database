<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить документ</title>
</head>
<body>
    <h3 class="hello-text">Добавить данные</h3>
    <form method="POST" action="insert_data.php">
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
</body>
</html>
