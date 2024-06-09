<?php

require_once("connect.php");

$id = $_POST["id"];

$sql = "DELETE FROM documents WHERE id = '$id'";

$result = mysqli_query($conn, $sql);

if(!$result){
    echo "Пользователя с таким ID не существует!";
}

mysqli_close($conn);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление данных</title>
</head>
<body>
    <h3 class="hello-text">Удаление данных(ID)</h3>
    <form action="delete.php" method="POST">
        <b>ID</b><br>
        <input type="text" name="id"><br>
        <input type="submit" value="отправить">
    </form>
</body>
</html>