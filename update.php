<?php

require_once("connect.php");

$id = $_POST["id"]; 
$name = $_POST["name"];
$text = $_POST["text"];
$type = $_POST["type"];

$sql = "UPDATE documents SET name='$name', text='$text', type='$type' WHERE id='$id'";
mysqli_query($conn, $sql);

if($result = mysqli_query($conn, $sql)){
    echo "успешно: " . mysqli_error($conn);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Обновение</title>
</head>
<body>
    <h3 class="hello-text">Изменение данных</h3>
    <form method="POST" action="update.php">
    <b>ID</b><br>
    <input type="text" name="id"><br>
    <b>Name</b><br>
    <input type="text" name="name"><br>
    <b>Text</b><br>
    <input type="text" name="text"><br>
    <b>Type</b><br>
    <input type="text" name="type"><br>

    <input type="submit" value="отправить">
</form>
</body>
</html>