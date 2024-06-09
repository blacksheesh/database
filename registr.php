<?php
require_once("connect.php");

$id = $_POST["login"];
$login = $_POST["login"];
$email = $_POST["email"];
$password = $_POST["password"];

$sql = "INSERT INTO accounts (login, password, email) VALUES ('$login', '$email', '$password')";
$result = mysqli_query($conn, $sql);
if(mb_strlen($login) < 5 || mb_strlen($login) > 90){
    echo "Длина логина неверная";
    exit();
}
if(mb_strlen($email) < 5 || mb_strlen($email) > 90){
    echo "Длина почты неверная";
    exit();
}
if(!$result){
    echo "Не удалось зарегистрироваться!";
}  

header("Location: index.php");
?>