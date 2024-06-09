<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вывод данных</title>
</head>
<body>
<?php
require_once("connect.php");
echo '<table border="1">';
echo '<tr><th>ID</th><th>Name</th><th>Text</th><th>Type</th/>';
$sql = "SELECT *FROM  documents";
if($result = mysqli_query($conn, $sql)){
    while($row = mysqli_fetch_array($result)){
        echo '<tr>';
        echo '<td>' . $row["id"] . '</td>';
        echo '<td>' . $row["name"] . '</td>';
        echo '<td>' . $row["text"] . '</td>';
        echo '<td>' . $row["type"] . '</td>';
        echo '</tr>';
    } 
} 



echo '</table>';
mysqli_close($conn);
?>
</body>
</html>